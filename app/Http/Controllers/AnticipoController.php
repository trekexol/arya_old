<?php

namespace App\Http\Controllers;

use App\Account;
use App\Anticipo;
use App\Client;
use App\Color;
use App\DetailVoucher;
use App\HeaderVoucher;
use App\Modelo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnticipoController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
       
        $anticipos = Anticipo::where('status',1)->orderBy('id','desc')->get();
        

        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.anticipos.index',compact('anticipos'));
   }

   public function indexhistoric()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
       
        $anticipos = Anticipo::where('status','C')->orderBy('id','desc')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.anticipos.index',compact('anticipos'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function selectclient($id_anticipo = null)
    {
        $clients = Client::orderBy('id' ,'DESC')->get();

        return view('admin.anticipos.selectclient',compact('clients','id_anticipo'));
    }
    
  

   public function create()
   {
        $accounts = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three', 1)
                                            ->where('code_four', 1)
                                            ->where('code_five', '<>',0)
                                            ->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    
        $bcv = $this->search_bcv();

        return view('admin.anticipos.create',compact('datenow','accounts','bcv'));
   }

   public function createclient($id_client)
   {

        $client =  Client::find($id_client);
        $accounts = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three',1)
                                            ->whereIn('code_four', [1, 2])
                                            ->where('code_five', '<>',0)
                                            ->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    
        $bcv = $this->search_bcv();

        return view('admin.anticipos.create',compact('datenow','client','accounts','bcv'));
   }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
    {
   
        
        $data = request()->validate([
            
        
            'date_begin'         =>'required',
            'id_client'         =>'required',
            'id_account'         =>'required',
            'id_user'         =>'required',

            'amount'         =>'required',
            'rate'         =>'required',
            'coin'         =>'required',

        ]);

        $var = new Anticipo();

        $var->date = request('date_begin');
        $var->id_client = request('id_client');
        $var->id_account = request('id_account');
        $var->id_user = request('id_user');
        $var->coin = request('coin');

        if($var->id_client == -1){
            return redirect('/anticipos/register')->withDanger('Debe Seleccionar un Cliente!');
        }
        
        $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));
        $valor_sin_formato_rate = str_replace(',', '.', str_replace('.', '', request('rate')));

        if($var->coin != 'Bolivares'){
            $var->amount = $valor_sin_formato_amount * $valor_sin_formato_rate; 
            $var->rate = $valor_sin_formato_rate;
        }else{
            $var->amount = $valor_sin_formato_amount;
            $var->rate = $valor_sin_formato_rate;
        }

        
        $var->reference = request('reference');
        
    
        $var->status = 1;

        $var->save();

        /*Aplicamos el movimiento contable*/
        $header_voucher  = new HeaderVoucher();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');
        $header_voucher->id_anticipo =  $var->id;
        $header_voucher->description = "Anticipo";
        $header_voucher->date = $datenow;
        $header_voucher->status =  "1";
        $header_voucher->save();

        $this->add_movement($header_voucher->id,$var->id_account,$var->id_user,$var->amount,0,$var->rate);


        $account_anticipo = Account::where('description', 'like', 'Anticipos Clientes Nacionales')->first();  
            
        if(isset($account_anticipo)){
            $this->add_movement($header_voucher->id,$account_anticipo->id,$var->id_user,0,$var->amount,$var->rate);
        }
        


        return redirect('/anticipos')->withSuccess('Registro Exitoso!');
    }

  



    public function add_movement($id_header,$id_account,$id_user,$debe,$haber,$tasa){

       

        $detail = new DetailVoucher();

        $detail->id_account = $id_account;
        $detail->id_header_voucher = $id_header;
        $detail->user_id = $id_user;

        $detail->debe = $debe;
        $detail->haber = $haber;
        $detail->tasa = $tasa;
      
        $detail->status =  "C";

         /*Le cambiamos el status a la cuenta a M, para saber que tiene Movimientos en detailVoucher */
         
            $account = Account::findOrFail($detail->id_account);

            if($account->status != "M"){
                $account->status = "M";
                $account->save();
            }
         
    
        $detail->save();

    }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id,$id_client = null)
   {
        $anticipo = Anticipo::find($id);

        if(isset($id_client)){
            $client = Client::find($id_client);
        }else{
            $client = null;
        }
        

        $accounts = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three',1)
                                            ->whereIn('code_four', [1, 2])
                                            ->where('code_five', '<>',0)
                                            ->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    
        $bcv = $this->search_bcv();

        if($anticipo->coin != 'Bolivares'){
            
            $anticipo->amount = $anticipo->amount / $anticipo->rate;
            
        }
      
        return view('admin.anticipos.edit',compact('anticipo','accounts','datenow','bcv','client'));
  
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {

        $data = request()->validate([
                
            
            'date_begin'         =>'required',
            'id_client'         =>'required',
            'id_account'         =>'required',
            'id_user'         =>'required',

            'amount'         =>'required',
            'rate'         =>'required',
            'coin'         =>'required',

        ]);

        


        $var = Anticipo::findOrFail($id);

       
        $var->date = request('date_begin');
        $var->id_client = request('id_client');
        $var->id_account = request('id_account');
        $var->id_user = request('id_user');
        $var->coin = request('coin');

        if($var->id_client == -1){
            return redirect('/anticipos/edit/'.$id.'')->withDanger('Debe Seleccionar un Cliente!');
        }
        
        $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));
        $valor_sin_formato_rate = str_replace(',', '.', str_replace('.', '', request('rate')));

        if($var->coin != 'Bolivares'){
            $var->amount = $valor_sin_formato_amount * $valor_sin_formato_rate; 
            $var->rate = $valor_sin_formato_rate;
        }else{
            $var->amount = $valor_sin_formato_amount;
            $var->rate = $valor_sin_formato_rate;
        }

        
        $var->reference = request('reference');
        
        if(request('status') != null){
            $var->status = request('status');
        }
    
        DB::table('detail_vouchers as d')
                        ->join('header_vouchers as h', 'h.id', '=', 'd.id_header_voucher')
                        ->where('h.id_anticipo',$var->id)
                        ->where('d.haber',0)
                        ->update([ 'd.debe' => $var->amount, 'd.tasa' => $var->rate,'d.id_account' => $var->id_account]);
        
        DB::table('detail_vouchers as d')
                        ->join('header_vouchers as h', 'h.id', '=', 'd.id_header_voucher')
                        ->where('h.id_anticipo',$var->id)
                        ->where('d.debe',0)
                        ->update([ 'd.haber' => $var->amount , 'd.tasa' => $var->rate]);

        

        //$header_voucher->date = $datenow;
       
        $var->save();

        return redirect('/anticipos')->withSuccess('Actualizacion Exitosa!');
    }


   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       //
   }


   public function search_bcv()
    {
        /*Buscar el indice bcv*/
        $urlToGet ='http://www.bcv.org.ve/tasas-informativas-sistema-bancario';
        $pageDocument = @file_get_contents($urlToGet);
        preg_match_all('|<div class="col-sm-6 col-xs-6"><strong> (.*?) </strong> </div>|s', $pageDocument, $cap);

        if ($cap[0] == array()){ // VALIDAR Concidencia
            $titulo = '0,00';
        } else {
            $titulo = $cap[1][2];
        }

        $bcv_con_formato = $titulo;
        $bcv = str_replace(',', '.', str_replace('.', '',$bcv_con_formato));


        /*-------------------------- */
        return $bcv;

    }
}

