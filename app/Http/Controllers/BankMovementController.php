<?php

namespace App\Http\Controllers;

use App\BankMovement;
use Illuminate\Http\Request;


use App\Account;
use App\BankVoucher;
use App\Client;
use App\DetailVoucher;
use App\Segment;
use App\Subsegment;
use App\UnitOfMeasure;
use App\Vendor;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BankMovementController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        
        $accounts = $this->calculation();

        
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.bankmovements.index',compact('accounts'));
   }

   public function indexmovement()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        
        $detailvouchers = DetailVoucher::where('id_bank_voucher','<>',null)->orderby('created_at','asc')->get();

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.bankmovements.indexmovement',compact('detailvouchers'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function createdeposit($id)
   {
    
   
        $account = Account::find($id);

      
        if(isset($account)){   
            
            $contrapartidas     = Account::where('code_one', '<>',0)
                                            ->where('code_two', '<>',0)
                                            ->where('code_three', '<>',0)
                                            ->where('code_four', '=',0)
                                        ->orderBY('description','asc')->pluck('description','id')->toArray();
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            return view('admin.bankmovements.createdeposit',compact('account','datenow','contrapartidas'));

        }else{
            return redirect('/bankmovements')->withDanger('No existe la Cuenta!');
       }
   }

   public function createretirement($id)
   {
        $account = Account::find($id);

        if(isset($account)){   

            $contrapartidas     = Account::where('code_one', '<>',0)
                                            ->where('code_two', '<>',0)
                                            ->where('code_three', '<>',0)
                                            ->where('code_four', '=',0)
                                        ->orderBY('description','asc')->pluck('description','id')->toArray();
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            return view('admin.bankmovements.createretirement',compact('account','datenow','contrapartidas'));

        }else{
            return redirect('/bankmovements')->withDanger('No existe la Cuenta!');
       }
   }

   public function createtransfer($id)
   {
        $account = Account::find($id);

        if(isset($account)){   

            $counterparts     = Account::where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->whereIn('code_three', [1,2])
                                            ->where('code_four','<>',0)
                                        ->orderBY('description','asc')->get();
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            return view('admin.bankmovements.createtransfer',compact('account','datenow','counterparts'));

        }else{
            return redirect('/bankmovements')->withDanger('No existe la Cuenta!');
       }
   }

   
    public function store(Request $request)
    {


        $data = request()->validate([
            
        
            'id_account'        =>'required',
            'Subcontrapartida'  =>'required',
            'user_id'           =>'required',
            'amount'            =>'required',
            
            'date'              =>'required',
        
        
        ]);
        
        $account = request('id_account');
        $contrapartida = request('Subcontrapartida');

        if($account != $contrapartida){

            $amount = str_replace(',', '.', str_replace('.', '', request('amount')));

            $check_amount = $this->check_amount($contrapartida);

            if($check_amount->saldo_actual >= $amount){
                $var = new BankVoucher();

                $var->id_user = request('user_id');
                $var->description = request('description');
                $var->type_movement = request('type_movement');
                $var->date = request('date');
                $var->reference = request('reference');
                $var->status =  1;
            
                $var->save();


                $movement = new DetailVoucher();

                $movement->id_account = $contrapartida;
                $movement->id_bank_voucher = $var->id;
                $movement->user_id = request('user_id');
                $movement->debe = 0;
                $movement->haber = $amount;
                $movement->status = "C";
            
                $movement->save();

                $movement_counterpart = new DetailVoucher();
                $movement_counterpart->id_account = $account;
                $movement_counterpart->id_bank_voucher = $var->id;
                $movement_counterpart->user_id = request('user_id');
                $movement_counterpart->debe = $amount;
                $movement_counterpart->haber = 0;
                $movement_counterpart->status = "C";

                $movement_counterpart->save();



                $verification = Account::findOrFail($account);

                if($verification->status != "M"){
                    $verification->status = "M";
                    $verification->save();
                }

                $verification2 = Account::findOrFail($contrapartida);

                if($verification2->status != "M"){
                    $verification2->status = "M";
                    $verification2->save();
                }

                
                return redirect('/bankmovements')->withSuccess('Registro Exitoso!');

            }else{
                return redirect('/bankmovements/registerdeposit/'.request('id_account').'')->withDanger('El saldo de la Cuenta '.$check_amount->description.' es menor al monto del deposito!');
            }
            
        }else{
            return redirect('/bankmovements/registerdeposit/'.request('id_account').'')->withDanger('No se puede hacer un movimiento a la misma cuenta!');
        }
    }



    public function storeretirement(Request $request)
    {

       
        $data = request()->validate([
            
        
            'id_account'        =>'required',
            'Subcontrapartida'  =>'required',

            'beneficiario'      =>'required',
            'Subbeneficiario'      =>'required',

            'user_id'           =>'required',
            'amount'            =>'required',
            
            'date'              =>'required',
        
        
        ]);
        
        $account = request('id_account');
        $contrapartida = request('Subcontrapartida');

        if($account != $contrapartida){

            $amount = str_replace(',', '.', str_replace('.', '', request('amount')));

            $check_amount = $this->check_amount($account);

            if($check_amount->saldo_actual >= $amount){
                $var = new BankVoucher();

                /*$var->id_account = $contrapartida;
            
                $var->id_counterpart = $account;*/
            
                if(request('beneficiario') == 1){
                    $var->id_client = request('Subbeneficiario');
                    
                }else{
                    $var->id_provider = request('Subbeneficiario');
                }

                $var->id_user = request('user_id');
                $var->description = request('description');
                $var->type_movement = request('type_movement');
                $var->date = request('date');
                $var->reference = request('reference');
                $var->status =  1;
            
                $var->save();


                $movement = new DetailVoucher();

                $movement->id_account = $account;
                $movement->id_bank_voucher = $var->id;
                $movement->user_id = request('user_id');
                $movement->debe = 0;
                $movement->haber = $amount;
                $movement->status = "C";
            
                $movement->save();

                $movement_counterpart = new DetailVoucher();
                $movement_counterpart->id_account = $contrapartida;
                $movement_counterpart->id_bank_voucher = $var->id;
                $movement_counterpart->user_id = request('user_id');
                $movement_counterpart->debe = $amount;
                $movement_counterpart->haber = 0;
                $movement_counterpart->status = "C";

                $movement_counterpart->save();


                $verification = Account::findOrFail($account);

                if($verification->status != "M"){
                    $verification->status = "M";
                    $verification->save();
                }

                $verification2 = Account::findOrFail($contrapartida);

                if($verification2->status != "M"){
                    $verification2->status = "M";
                    $verification2->save();
                }

                return redirect('/bankmovements')->withSuccess('Registro Exitoso!');

            }else{
                return redirect('/bankmovements/registerretirement/'.request('id_account').'')->withDanger('El saldo de la Cuenta '.$check_amount->description.' es menor al monto del deposito!');
            }

        }else{
            return redirect('/bankmovements/registerretirement/'.request('id_account').'')->withDanger('No se puede hacer un movimiento a la misma cuenta!');
        }
    }


    public function storetransfer(Request $request)
    {
       
        $data = request()->validate([
            
        
            'id_account'        =>'required',
            'id_counterpart'  =>'required',

            'user_id'           =>'required',
            'amount'            =>'required',
            
            'date'              =>'required',
        
        
        ]);
        
        $account = request('id_account');
        $contrapartida = request('id_counterpart');

        if($account != $contrapartida){

            $amount = str_replace(',', '.', str_replace('.', '', request('amount')));

            $check_amount = $this->check_amount($account);

            if($check_amount->saldo_actual >= $amount){
                $var = new BankVoucher();

                $var->id_user = request('user_id');
                $var->description = request('description');
                $var->type_movement = request('type_movement');
                $var->date = request('date');
                $var->reference = request('reference');
                $var->status =  1;
            
                $var->save();


                $movement = new DetailVoucher();

                $movement->id_account = $account;
                $movement->id_bank_voucher = $var->id;
                $movement->user_id = request('user_id');
                $movement->debe = 0;
                $movement->haber = $amount;
                $movement->status = "C";
            
                $movement->save();

                $movement_counterpart = new DetailVoucher();
                $movement_counterpart->id_account = $contrapartida;
                $movement_counterpart->id_bank_voucher = $var->id;
                $movement_counterpart->user_id = request('user_id');
                $movement_counterpart->debe = $amount;
                $movement_counterpart->haber = 0;
                $movement_counterpart->status = "C";

                $movement_counterpart->save();


                $verification = Account::findOrFail($account);

                if($verification->status != "M"){
                    $verification->status = "M";
                    $verification->save();
                }

                $verification2 = Account::findOrFail($contrapartida);

                if($verification2->status != "M"){
                    $verification2->status = "M";
                    $verification2->save();
                }


                return redirect('/bankmovements')->withSuccess('Registro Exitoso!');

            }else{
                return redirect('/bankmovements/registertransfer/'.request('id_account').'')->withDanger('El saldo de la Cuenta '.$check_amount->description.' es menor al monto del deposito!');
            }

        }else{
            return redirect('/bankmovements/registertransfer/'.request('id_account').'')->withDanger('No se puede hacer un movimiento a la misma cuenta!');
        }
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
   public function calculation()
    {       $accounts = DB::table('accounts')->where('code_one', 1)
            ->where('code_four','<>',0)
            ->where('code_two', 1)
            ->whereIn('code_three', [1,2])
            ->get();

                      
       if(isset($accounts)) {
           foreach ($accounts as $var) {

                   
               if($var->code_one != 0){
                   
                   if($var->code_two != 0){
   
   
                       if($var->code_three != 0){
   
   
                           if($var->code_four != 0){
                             
                            /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                            $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');   
                            /*---------------------------------------------------*/

                                $var->debe = $total_debe;
                                $var->haber = $total_haber;
  
                            
                                                          
   
                           }else{
                              
                             
                         
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */ 
                           $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                           $total_haber =  DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');      
                        /*---------------------------------------------------*/                               
  
                        
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;       
                                          
                     
                           
                   }
                       }else{
                           
                      
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                   
                           $total_debe = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('debe');
   
                         
                           $total_haber = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('haber');
                        /*---------------------------------------------------*/
                                 
                       
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;
                    
                       
                       }
                   }else{
                       //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                     /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                        
                          
                           $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');
                    /*---------------------------------------------------*/

                        
                        $var->debe = $total_debe;
                        $var->haber = $total_haber;           
                      
   
                   }
               }else{
                   return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
               }
           } 
       }  else{
           return redirect('/accounts')->withDanger('No hay Cuentas');
       }              

      
       
        return $accounts;
    }
   

    public function check_amount($id_account)
    {       
        
        $var = Account::find($id_account);

                      
       if(isset($var)) {
               
               if($var->code_one != 0){
                   
                   if($var->code_two != 0){
   
   
                       if($var->code_three != 0){
   
   
                           if($var->code_four != 0){
                             
                            /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                            $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');   
                            /*---------------------------------------------------*/

                            
                                $var->debe = $total_debe;
                                $var->haber = $total_haber;
                                $var->saldo_actual = ($var->balance_previus + $var->debe) - $var->haber;

                           }else{
                              
                             
                         
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */ 
                           $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                           $total_haber =  DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');      
                        /*---------------------------------------------------*/                               
  
                        
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;       
                            $var->saldo_actual = ($var->balance_previus + $var->debe) - $var->haber;
                                  
                   }
                       }else{
                           
                      
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                   
                           $total_debe = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('debe');
   
                         
                           $total_haber = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('haber');
                      

                            $var->debe = $total_debe;
                            $var->haber = $total_haber;
                            $var->saldo_actual = ($var->balance_previus + $var->debe) - $var->haber;
                                  
                       }
                   }else{
                       //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                     /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                        
                          
                           $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');
                   


                       
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;           
                            $var->saldo_actual = ($var->balance_previus + $var->debe) - $var->haber;
                                  
                   }
               }else{
                   return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
               }
           } 
       
      
       
        return $var;
    }
   
    public function calculation2()
    {       $accounts = DB::table('accounts')->where('code_one', 1)
            ->where('code_four','<>',0)
            ->where('code_two', 1)
            ->whereIn('code_three', [1,2])
            ->get();

                      
       if(isset($accounts)) {
           foreach ($accounts as $var) {

                   
               if($var->code_one != 0){
                   
                   if($var->code_two != 0){
   
   
                       if($var->code_three != 0){
   
   
                           if($var->code_four != 0){
                             
                            /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                            $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('accounts.code_four', $var->code_four)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');   
                            /*---------------------------------------------------*/

                          

                           
                                $var->debe = $total_debe;
                                $var->haber = $total_haber;
  
                            
                                                          
   
                           }else{
                              
                             
                         
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */ 
                           $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                           $total_haber =  DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('accounts.code_two', $var->code_two)
                                                       ->where('accounts.code_three', $var->code_three)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');      
                        /*---------------------------------------------------*/                               
  
                      
                            $var->debe = $total_debe;
                       
                            $var->haber = $total_haber;       
                                          
                     
                           
                   }
                       }else{
                           
                      
                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                   
                           $total_debe = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('debe');
   
                         
                           $total_haber = DB::table('accounts')
                                                           ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                           ->where('accounts.code_one', $var->code_one)
                                                           ->where('accounts.code_two', $var->code_two)
                                                           ->where('detail_vouchers.status', 'C')
                                                           ->sum('haber');
                        /*---------------------------------------------------*/
                                 
                        /*CALCULA LOS MONTOS REALIZADOS POR MOVIMIENTOS BANCARIOS */  
                        $total_amount_bank = DB::table('accounts')
                                                ->join('bank_movements', 'bank_movements.id_account', '=', 'accounts.id')
                                                ->where('accounts.code_one', $var->code_one)
                                                ->where('accounts.code_two', $var->code_two)
                                                ->where('accounts.code_three', $var->code_three)
                                                ->where('accounts.code_four', $var->code_four)
                                                ->sum('amount');
                        $total_amount_bank_counterpart = DB::table('accounts')
                                                ->join('bank_movements', 'bank_movements.id_counterpart', '=', 'accounts.id')
                                                ->where('accounts.code_one', $var->code_one)
                                                ->where('accounts.code_two', $var->code_two)
                                                ->where('accounts.code_three', $var->code_three)
                                                ->where('accounts.code_four', $var->code_four)
                                                ->sum('amount');
                        /*---------------------------------------------------*/


                        
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;
                    
                       
                       }
                   }else{
                       //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                     /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */
                            $total_debe = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('debe');
   
                        
                          
                           $total_haber = DB::table('accounts')
                                                       ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                       ->where('accounts.code_one', $var->code_one)
                                                       ->where('detail_vouchers.status', 'C')
                                                       ->sum('haber');
                    /*---------------------------------------------------*/

                        /*CALCULA LOS MONTOS REALIZADOS POR MOVIMIENTOS BANCARIOS */ 
                            $total_amount_bank = DB::table('accounts')
                                                ->join('bank_movements', 'bank_movements.id_account', '=', 'accounts.id')
                                                ->where('accounts.code_one', $var->code_one)
                                                ->where('accounts.code_two', $var->code_two)
                                                ->where('accounts.code_three', $var->code_three)
                                                ->where('accounts.code_four', $var->code_four)
                                                ->sum('amount');

                            $total_amount_bank_counterpart = DB::table('accounts')
                                                ->join('bank_movements', 'bank_movements.id_counterpart', '=', 'accounts.id')
                                                ->where('accounts.code_one', $var->code_one)
                                                ->where('accounts.code_two', $var->code_two)
                                                ->where('accounts.code_three', $var->code_three)
                                                ->where('accounts.code_four', $var->code_four)
                                                ->sum('amount');
                        /*---------------------------------------------------*/


                        
                        $var->debe = $total_debe;
                        $var->haber = $total_haber;           
                      
   
                   }
               }else{
                   return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
               }
           } 
       }  else{
           return redirect('/accounts')->withDanger('No hay Cuentas');
       }              

      
       
        return $accounts;
    }
   

  
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $bankmovement = BankMovement::find($id);
       
     
        return view('admin.bankmovements.edit',compact('bankmovement','modelos','colors'));
  
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

    $vars =  BankMovement::find($id);

    $vars_status = $vars->status;
   
    $data = request()->validate([
        
       
        'account_code_one'         =>'required',
        'account_code_two'         =>'required',
        'account_code_three'         =>'required',
        'account_code_four'         =>'required',
        'account_period'         =>'required',

        'counterpart_code_one'         =>'required',
        'counterpart_code_two'         =>'required',
        'counterpart_code_three'         =>'required',
        'counterpart_code_four'         =>'required',
        'counterpart_period'         =>'required',

        'id_header'         =>'required',
        'id_client'         =>'required',
        'id_vendor'         =>'required',
        'user_id'         =>'required',

        'description'         =>'required',
        'type_movement'         =>'required',
        'date'         =>'required',

        'reference'         =>'required',
       
       
    ]);

    $var = BankMovement::findOrFail($id);

    $var->account_code_one = request('account_code_one');
    $var->account_code_two = request('account_code_two');
    $var->account_code_three = request('account_code_three');
    $var->account_code_four = request('account_code_four');
    $var->account_period = request('account_period');

    $var->counterpart_code_one = request('counterpart_code_one');
    $var->counterpart_code_two = request('counterpart_code_two');
    $var->counterpart_code_three = request('counterpart_code_three');
    $var->counterpart_code_four = request('counterpart_code_four');
    $var->counterpart_period = request('counterpart_period');

    $var->id_header = request('id_header');
    $var->id_client = request('id_client');
    $var->id_vendor = request('id_vendor');
    $var->user_id = request('user_id');

    $var->description = request('description');
    $var->type_movement = request('type_movement');
   
    $var->date = request('date');
    $var->reference = request('reference');


   
    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/bankmovements')->withSuccess('Actualizacion Exitosa!');
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

   public function listbeneficiario(Request $request, $id_var = null){
    //validar si la peticion es asincrona
    if($request->ajax()){
        try{
            
            if(strcmp($id_var, "Cliente") == 0){
                $respuesta = Client::select('id','name')->orderBy('name','asc')->get();
            }else{
               $respuesta = Vendor::select('id','name')->orderBy('name','asc')->get();
             }
           
            return response()->json($respuesta,200);
        }catch(Throwable $th){
            return response()->json(false,500);
        }
    }
    
}


 public function list(Request $request, $id_var = null){
    //validar si la peticion es asincrona
    if($request->ajax()){
        try{
            
            $account = Account::find($id_var);
            $subcontrapartidas = Account::select('id','description')->where('code_one',$account->code_one)
                                                                    ->where('code_two',$account->code_two)
                                                                    ->where('code_three',$account->code_three)
                                                                    ->where('code_four','<>',0)
                                                                    ->orderBy('description','asc')->get();
            return response()->json($subcontrapartidas,200);
        }catch(Throwable $th){
            return response()->json(false,500);
        }
    }
    
}




}
