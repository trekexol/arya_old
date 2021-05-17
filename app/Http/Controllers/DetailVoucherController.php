<?php

namespace App\Http\Controllers;

use App\Account;
use App\DetailVoucher;
use App\HeaderVoucher;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class DetailVoucherController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
       // $detailvouchers = DetailVoucher::All();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.detailvouchers.index');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    
       // $detailvouchers = DetailVoucher::All();

        return view('admin.detailvouchers.create',compact('datenow'));
   }
   public function createselect($id_header)
   {
        $header = HeaderVoucher::find($id_header); 

        if(isset($header)){
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
    
            $detailvouchers = DetailVoucher::where('id_header_voucher',$id_header)->get();
    
            return view('admin.detailvouchers.create',compact('header','datenow','detailvouchers'));
        }else{
            return redirect('/detailvouchers/register')->withDanger('No existe el Header!');
        }
        
   }

   public function createselectaccount($id_header,$code_one,$code_two,$code_three,$code_four,$period)
   {
        $header = HeaderVoucher::find($id_header); 

        $account = DB::table('accounts')->where('code_one', $code_one)
                                ->where('code_two', $code_two)
                                ->where('code_three', $code_three)
                                ->where('code_four', $code_four)
                                ->where('period', $period)->first();

        $detailvouchers = DetailVoucher::where('id_header_voucher',$id_header)->get();

        if(isset($header)){                           
            if(isset($account)){     

                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');    

                return view('admin.detailvouchers.create',compact('header','account','datenow','detailvouchers'));
        
            }else{
                return redirect('/detailvouchers/register')->withDanger('No existe la Cuenta!');
        }
        }else{
            return redirect('/detailvouchers/register')->withDanger('No existe el Header!');
        }

   }


   public function selectaccount($id_header)
   {
       if($id_header != -1){

            $header = HeaderVoucher::find($id_header);
            $accounts = Account::All();
            

            return view('admin.detailvouchers.selectaccount',compact('accounts','header'));

       }else{
        return redirect('/detailvouchers/register')->withDanger('Seleccione informacion de Cabecera!');
       }
        
   }
   
   public function selectheader()
   {
        $headervouchers = HeaderVoucher::where('status','LIKE','U')->get();
        

        return view('admin.detailvouchers.selectheadervouche',compact('headervouchers'));
   }


   public function contabilizar($id_header)
   {

  //  dd($id_header);
    $header = HeaderVoucher::find($id_header); 

    if(isset($header)){  

           
            
            $affected = DB::table('detail_vouchers')->where('id_header_voucher', '=', $id_header)->update(array('status' => 'C'));

            $detailvouchers = DetailVoucher::where('id_header_voucher',$id_header)->get();

           
             /*Le cambiamos el status a la cuenta a M, para saber que tiene Movimientos en detailVoucher */
             foreach($detailvouchers as $var){
                 
                $account = Account::findOrFail($var->id_account);

                if($account->status != "M"){
                    $account->status = "M";
                    $account->save();
                }
             }
            
             /*----------------------------- */


                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');    
                                
                    return view('admin.detailvouchers.create',compact('header','datenow','detailvouchers'));
                                        
            
            }else{
                return redirect('/detailvouchers/register')->withDanger('No existe el Header!');
            }                              

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
                
                

                
                'id_account'     =>'required',
               
                'id_header_voucher'     =>'required',
                'debe'                  =>'required',
                'haber'                 =>'required',
                
               
            
            ]);

            $var = new DetailVoucher();

            
            $var->id_account = request('id_account');
            $var->id_header_voucher = request('id_header_voucher');
            $var->user_id = request('id_user');

            $valor_sin_formato_debe = str_replace(',', '.', str_replace('.', '', request('debe')));
            $valor_sin_formato_haber = str_replace(',', '.', str_replace('.', '', request('haber')));


            $var->debe = $valor_sin_formato_debe;
            $var->haber = $valor_sin_formato_haber;
           
          
            $var->status =  "N";
        
            $var->save();

            return redirect('/detailvouchers/register/'.$var->id_header_voucher.'');
           /* $account = DB::table('accounts')->where('code_one', $var->code_one)
                                ->where('code_two', $var->code_two)
                                ->where('code_three', $var->code_three)
                                ->where('code_four', $var->code_four)
                                ->where('period', $var->period)->first();


           return redirect('/detailvouchers/register/'.$var->id_header_voucher.'')->with('detail',$var)->with('accountdetail',$account);
           */
          /* return redirect('/detailvouchers/register/'.$var->id_header_voucher.'
            /'.$var->code_one.'/'.$var->code_two.'/'.$var->code_three.'/'.$var->code_four.'
            /'.$var->period.'');*/
    }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $var = DetailVoucher::find($id);
       
        return view('admin.detailvouchers.edit',compact('var'));
  
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

    $vars =  DetailVoucher::find($id);

    $vars_status = $vars->status;
  
    $data = request()->validate([
                
                

        'code_one'      =>'required',
        'code_two'      =>'required',
        'code_three'    =>'required',
        'code_four'     =>'required',
        'period'        =>'required',
        'id_header_voucher'     =>'required',
        'debe'                  =>'required',
        'haber'                 =>'required',
        'ref'                   =>'required',
       
    
    ]);

    $var = DetailVoucher::findOrFail($id);

    $var->code_one = request('code_one');
    $var->code_two = request('code_two');
    $var->code_three = request('code_three');
    $var->code_four = request('code_four');
    $var->period = request('period');
    $var->id_header_voucher = request('id_header_voucher');
    $var->debe = request('debe');
    $var->haber = request('haber');
    $var->ref = request('ref');
    
    

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/detailvouchers')->withSuccess('Actualizacion Exitosa!');
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


   public function listheader(Request $request, $var = null){
    //validar si la peticion es asincrona
    if($request->ajax()){
        try{
            
            $respuesta = HeaderVoucher::select('id','description','amount')->where('reference',$var)->orderBy('description','asc')->get();
            return response()->json($respuesta,200);
        }catch(Throwable $th){
            return response()->json(false,500);
        }
    }
    
}



}
