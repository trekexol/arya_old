<?php

namespace App\Http\Controllers;

use App\Account;
use App\BankMovement;
use App\BankVoucher;
use App\Branch;
use App\Client;
use App\DetailVoucher;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectPaymentOrderController extends Controller
{
    public function createretirement()
   {
        $accounts = DB::table('accounts')->where('code_one', 1)
                                        ->where('code_four','<>',0)
                                        ->where('code_two', 1)
                                        ->whereIn('code_three', [1,2])
                                        ->orderBY('description','asc')->pluck('description','id')->toArray();


        if(isset($accounts)){   

            $contrapartidas     = Account::where('code_one', '<>',0)
                                            ->where('code_two', '<>',0)
                                            ->where('code_three', '<>',0)
                                            ->where('code_four', '=',0)
                                        ->orderBY('description','asc')->pluck('description','id')->toArray();
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            $branches = Branch::orderBY('description','asc')->get();

           return view('admin.directpaymentorder.createretirement',compact('accounts','datenow','contrapartidas','branches'));

        }else{
            return redirect('/directpaymentorders')->withDanger('No hay Cuentas!');
       }
   }


    public function store(Request $request)
    {

       
        $data = request()->validate([
            
        
            'account'        =>'required',
            'Subcontrapartida'  =>'required',

            'beneficiario'      =>'required',
            'Subbeneficiario'      =>'required',

            'user_id'           =>'required',
            'amount'            =>'required',
            
            'date'              =>'required',
        
        
        ]);
        
        $account = request('account');
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

                return redirect('/directpaymentorders')->withSuccess('Registro Exitoso!');

            }else{
                return redirect('/directpaymentorders'.request('id_account').'')->withDanger('El saldo de la Cuenta '.$check_amount->description.' es menor al monto del retiro!');
            }

        }else{
            return redirect('/directpaymentorders'.request('id_account').'')->withDanger('No se puede hacer un movimiento a la misma cuenta!');
        }
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
                        /*---------------------------------------------------*/
                                 
                       


                      
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
                    /*---------------------------------------------------*/

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

    public function listbeneficiary(Request $request, $id_var = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                
                if($id_var == 1){
                    $clients = Client::orderBy('name','asc')->get();
                    return response()->json($clients,200);
                }else{
                    $providers = Provider::orderBy('razon_social','asc')->get();
                    return response()->json($providers,200);
                }
               
                
                
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }

    public function listcontrapartida(Request $request, $id_var = null){
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
