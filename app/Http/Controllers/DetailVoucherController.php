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
        $detailvouchers = DetailVoucher::All();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.detailvouchers.index',compact('detailvouchers'));
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
        $detailvouchers = DetailVoucher::All();

        return view('admin.detailvouchers.create',compact('datenow','detailvouchers'));
   }
   public function createselect($id_header)
   {
        $header = HeaderVoucher::find($id_header); 
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        $detailvouchers = DetailVoucher::All();

        return view('admin.detailvouchers.create',compact('header','datenow','detailvouchers'));
   }

   public function createselectaccount($id_header,$code_one,$code_two,$code_three,$code_four,$period)
   {
        $header = HeaderVoucher::find($id_header); 

        $account = DB::table('accounts')->where('code_one', $code_one)
                                ->where('code_two', $code_two)
                                ->where('code_three', $code_three)
                                ->where('code_four', $code_four)
                                ->where('period', $period)->first();

        $detailvouchers = DetailVoucher::All();

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
        $headervouchers = HeaderVoucher::All();
        

        return view('admin.detailvouchers.selectheadervouche',compact('headervouchers'));
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
                
                

                'code_one'      =>'required',
                'code_two'      =>'required',
                'code_three'    =>'required',
                'code_four'     =>'required',
                'period'        =>'required',
                'id_header_voucher'     =>'required',
                'debe'                  =>'required',
                'haber'                 =>'required',
                
               
            
            ]);

            $var = new DetailVoucher();

            $var->code_one = request('code_one');
            $var->code_two = request('code_two');
            $var->code_three = request('code_three');
            $var->code_four = request('code_four');
            $var->period = request('period');
            $var->id_header_voucher = request('id_header_voucher');
            $var->debe = request('debe');
            $var->haber = request('haber');
            $var->ref = request('ref');
          
            $var->status =  "1";
        
            $var->save();

            return redirect('/detailvouchers/register')->withSuccess('Registro Exitoso!');

       
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
}
