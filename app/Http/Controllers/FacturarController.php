<?php

namespace App\Http\Controllers;

use App\Anticipo;
use Illuminate\Http\Request;

use App\Quotation;
use App\QuotationPayment;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FacturarController extends Controller
{
    public function createfacturar($id_quotation)
    {
         $quotation = null;
             
         if(isset($id_quotation)){
             $quotation = Quotation::find($id_quotation);
         }
 
         if(isset($quotation)){
             $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
             $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

             $anticipos_sum = Anticipo::where('status',1)->where('id_client',$quotation->id_client)->sum('amount');

             $accounts_bank = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three', 2)
                                            ->where('code_four', '<>',0)
                                            ->get();
             $accounts_efectivo = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three', 1)
                                            ->where('code_four', '<>',0)
                                            ->get();
             $accounts_punto_de_venta = DB::table('accounts')->where('description','LIKE', 'Punto de Venta%')
                                            ->get();

             $total= 0;
             $base_imponible= 0;
             foreach($product_quotations as $var){
                 //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;

                    $total += ($var->products['price'] * $var->amount) - $percentage;
                //----------------------------- 

                if($var->products['exento'] == 0){

                    $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;

                    $base_imponible += ($var->products['price'] * $var->amount) - $percentage; 

                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
     
             return view('admin.quotations.createfacturar',compact('quotation','product_quotations','payment_quotations', 'accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','datenow','anticipos_sum'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }

    public function storefactura(Request $request)
    {
       
        $data = request()->validate([
            
        
        
        ]);

        

       // dd($request);
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 
        
        $total_pay = 0;

        //Saber cuantos pagos vienen
        $come_pay = request('amount_of_payments');

        /*Validar cuales son los pagos a guardar */
            $validate_boolean1 = false;
            $validate_boolean2 = false;
            $validate_boolean3 = false;
            $validate_boolean4 = false;
            $validate_boolean5 = false;
            $validate_boolean6 = false;
            $validate_boolean7 = false;

        //-----------------------

        $quotation = Quotation::findOrFail(request('id_quotation'));

     

     if($come_pay >= 1){

          /*-------------PAGO NUMERO 1----------------------*/

          $var = new QuotationPayment();

          $amount_pay = request('amount_pay');
  
          if(isset($amount_pay)){
              
              $valor_sin_formato_amount_pay = str_replace(',', '.', str_replace('.', '', $amount_pay));
          }else{
              return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 1!');
          }
              
  
          $account_bank = request('account_bank');
          $account_efectivo = request('account_efectivo');
          $account_punto_de_venta = request('account_punto_de_venta');
  
          $credit_days = request('credit_days');
  
          $payment_type = request('payment_type');
  
          $reference = request('reference');
  
          if($valor_sin_formato_amount_pay != 0){
  
              if($payment_type != 0){
  
                  $var->id_quotation = request('id_quotation');
  
                  //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                  if($payment_type == 1 || $payment_type == 11 || $payment_type == 5 ){
                      //CUENTAS BANCARIAS
                      if(($account_bank != 0)){
                          if(isset($reference)){
  
                              $var->id_account = $account_bank;
  
                              $var->reference = $reference;
  
                          }else{
                              return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria!');
                          }
                      }else{
                          return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria!');
                      }
                  }
                  if($payment_type == 4){
                      //DIAS DE CREDITO
                      if(isset($credit_days)){
  
                          $var->credit_days = $credit_days;
  
                      }else{
                          return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito!');
                      }
                  }
  
                  if($payment_type == 6){
                      //DIAS DE CREDITO
                      if(($account_efectivo != 0)){
  
                          $var->id_account = $account_efectivo;
  
                      }else{
                          return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo!');
                      }
                  }
  
                  if($payment_type == 9 || $payment_type == 10){
                       //CUENTAS PUNTO DE VENTA
                      if(($account_punto_de_venta != 0)){
                          $var->id_account = $account_punto_de_venta;
                      }else{
                          return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta!');
                      }
                  }
  
                      
             
  
                      $var->payment_type = request('payment_type');
                      $var->amount = $valor_sin_formato_amount_pay;
                      
                      
                      $var->status =  1;
                  
                      $total_pay += $valor_sin_formato_amount_pay;
  
                      $validate_boolean1 = true;
  
                  
              }else{
                  return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 1!');
              }
  
             
          }else{
                  return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago debe ser distinto de Cero!');
              }
      /*--------------------------------------------*/
     }   

    if($come_pay >= 2){

       /*-------------PAGO NUMERO 2----------------------*/

       $var2 = new QuotationPayment();

       $amount_pay2 = request('amount_pay2');

       if(isset($amount_pay2)){
           
           $valor_sin_formato_amount_pay2 = str_replace(',', '.', str_replace('.', '', $amount_pay2));
       }else{
           return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 2!');
       }
           

       $account_bank2 = request('account_bank2');
       $account_efectivo2 = request('account_efectivo2');
       $account_punto_de_venta2 = request('account_punto_de_venta2');

       $credit_days2 = request('credit_days2');

       $payment_type2 = request('payment_type2');

       $reference2 = request('reference2');

       if($valor_sin_formato_amount_pay2 != 0){

           if($payment_type2 != 0){

               $var2->id_quotation = request('id_quotation');

               //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
               if($payment_type2 == 1 || $payment_type2 == 11 || $payment_type2 == 5 ){
                   //CUENTAS BANCARIAS
                   if(($account_bank2 != 0)){
                       if(isset($reference2)){

                           $var2->id_account = $account_bank2;

                           $var2->reference = $reference2;

                       }else{
                           return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 2!');
                       }
                   }else{
                       return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 2!');
                   }
               }
               if($payment_type2 == 4){
                   //DIAS DE CREDITO
                   if(isset($credit_days2)){

                       $var2->credit_days = $credit_days2;

                   }else{
                       return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 2!');
                   }
               }

               if($payment_type2 == 6){
                   //DIAS DE CREDITO
                   if(($account_efectivo2 != 0)){

                       $var2->id_account = $account_efectivo2;

                   }else{
                       return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 2!');
                   }
               }

               if($payment_type2 == 9 || $payment_type2 == 10){
                    //CUENTAS PUNTO DE VENTA
                   if(($account_punto_de_venta2 != 0)){
                       $var2->id_account = $account_punto_de_venta2;
                   }else{
                       return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 2!');
                   }
               }

                   
          

                   $var2->payment_type = request('payment_type2');
                   $var2->amount = $valor_sin_formato_amount_pay2;
                   
                   
                   $var2->status =  1;
               
                   $total_pay += $valor_sin_formato_amount_pay2;

                   $validate_boolean2 = true;

               
           }else{
               return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 2!');
           }

          
       }else{
               return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 2 debe ser distinto de Cero!');
           }
   /*--------------------------------------------*/
    } 
        
    if($come_pay >= 3){

            /*-------------PAGO NUMERO 3----------------------*/

            $var3 = new QuotationPayment();

            $amount_pay3 = request('amount_pay3');

            if(isset($amount_pay3)){
                
                $valor_sin_formato_amount_pay3 = str_replace(',', '.', str_replace('.', '', $amount_pay3));
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 3!');
            }
                

            $account_bank3 = request('account_bank3');
            $account_efectivo3 = request('account_efectivo3');
            $account_punto_de_venta3 = request('account_punto_de_venta3');

            $credit_days3 = request('credit_days3');

            $payment_type3 = request('payment_type3');

            $reference3 = request('reference3');

            if($valor_sin_formato_amount_pay3 != 0){

                if($payment_type3 != 0){

                    $var3->id_quotation = request('id_quotation');

                    //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                    if($payment_type3 == 1 || $payment_type3 == 11 || $payment_type3 == 5 ){
                        //CUENTAS BANCARIAS
                        if(($account_bank3 != 0)){
                            if(isset($reference3)){

                                $var3->id_account = $account_bank3;

                                $var3->reference = $reference3;

                            }else{
                                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 3!');
                            }
                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 3!');
                        }
                    }
                    if($payment_type3 == 4){
                        //DIAS DE CREDITO
                        if(isset($credit_days3)){

                            $var3->credit_days = $credit_days3;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 3!');
                        }
                    }

                    if($payment_type3 == 6){
                        //DIAS DE CREDITO
                        if(($account_efectivo3 != 0)){

                            $var3->id_account = $account_efectivo3;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 3!');
                        }
                    }

                    if($payment_type3 == 9 || $payment_type3 == 10){
                        //CUENTAS PUNTO DE VENTA
                        if(($account_punto_de_venta3 != 0)){
                            $var3->id_account = $account_punto_de_venta3;
                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 3!');
                        }
                    }

                  
                

                        $var3->payment_type = request('payment_type3');
                        $var3->amount = $valor_sin_formato_amount_pay3;
                        
                        
                        $var3->status =  1;
                    
                        $total_pay += $valor_sin_formato_amount_pay3;

                        $validate_boolean3 = true;

                    
                }else{
                    return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 3!');
                }

                
            }else{
                    return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 3 debe ser distinto de Cero!');
                }
            /*--------------------------------------------*/
    }
        
    if($come_pay >= 4){

            /*-------------PAGO NUMERO 4----------------------*/

            $var4 = new QuotationPayment();

            $amount_pay4 = request('amount_pay4');

            if(isset($amount_pay4)){
                
                $valor_sin_formato_amount_pay4 = str_replace(',', '.', str_replace('.', '', $amount_pay4));
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 4!');
            }
                

            $account_bank4 = request('account_bank4');
            $account_efectivo4 = request('account_efectivo4');
            $account_punto_de_venta4 = request('account_punto_de_venta4');

            $credit_days4 = request('credit_days4');

            $payment_type4 = request('payment_type4');

            $reference4 = request('reference4');

            if($valor_sin_formato_amount_pay4 != 0){

                if($payment_type4 != 0){

                    $var4->id_quotation = request('id_quotation');

                    //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                    if($payment_type4 == 1 || $payment_type4 == 11 || $payment_type4 == 5 ){
                        //CUENTAS BANCARIAS
                        if(($account_bank4 != 0)){
                            if(isset($reference4)){

                                $var4->id_account = $account_bank4;

                                $var4->reference = $reference4;

                            }else{
                                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 4!');
                            }
                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 4!');
                        }
                    }
                    if($payment_type4 == 4){
                        //DIAS DE CREDITO
                        if(isset($credit_days4)){

                            $var4->credit_days = $credit_days4;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 4!');
                        }
                    }

                    if($payment_type4 == 6){
                        //DIAS DE CREDITO
                        if(($account_efectivo4 != 0)){

                            $var4->id_account = $account_efectivo4;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 4!');
                        }
                    }

                    if($payment_type4 == 9 || $payment_type4 == 10){
                        //CUENTAS PUNTO DE VENTA
                        if(($account_punto_de_venta4 != 0)){
                            $var4->id_account = $account_punto_de_venta4;
                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 4!');
                        }
                    }

                
                

                        $var4->payment_type = request('payment_type4');
                        $var4->amount = $valor_sin_formato_amount_pay4;
                        
                        
                        $var4->status =  1;
                    
                        $total_pay += $valor_sin_formato_amount_pay4;

                        $validate_boolean4 = true;

                    
                }else{
                    return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 4!');
                }

                
            }else{
                    return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 4 debe ser distinto de Cero!');
                }
            /*--------------------------------------------*/
    } 
    if($come_pay >= 5){

        /*-------------PAGO NUMERO 5----------------------*/

        $var5 = new QuotationPayment();

        $amount_pay5 = request('amount_pay5');

        if(isset($amount_pay5)){
            
            $valor_sin_formato_amount_pay5 = str_replace(',', '.', str_replace('.', '', $amount_pay5));
        }else{
            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 5!');
        }
            

        $account_bank5 = request('account_bank5');
        $account_efectivo5 = request('account_efectivo5');
        $account_punto_de_venta5 = request('account_punto_de_venta5');

        $credit_days5 = request('credit_days5');

        $payment_type5 = request('payment_type5');

        $reference5 = request('reference5');

        if($valor_sin_formato_amount_pay5 != 0){

            if($payment_type5 != 0){

                $var5->id_quotation = request('id_quotation');

                //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                if($payment_type5 == 1 || $payment_type5 == 11 || $payment_type5 == 5 ){
                    //CUENTAS BANCARIAS
                    if(($account_bank5 != 0)){
                        if(isset($reference5)){

                            $var5->id_account = $account_bank5;

                            $var5->reference = $reference5;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 5!');
                        }
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 5!');
                    }
                }
                if($payment_type5 == 4){
                    //DIAS DE CREDITO
                    if(isset($credit_days5)){

                        $var5->credit_days = $credit_days5;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 5!');
                    }
                }

                if($payment_type5 == 6){
                    //DIAS DE CREDITO
                    if(($account_efectivo5 != 0)){

                        $var5->id_account = $account_efectivo5;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 5!');
                    }
                }

                if($payment_type5 == 9 || $payment_type5 == 10){
                    //CUENTAS PUNTO DE VENTA
                    if(($account_punto_de_venta5 != 0)){
                        $var5->id_account = $account_punto_de_venta5;
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 5!');
                    }
                }

            
            

                    $var5->payment_type = request('payment_type5');
                    $var5->amount = $valor_sin_formato_amount_pay5;
                    
                    
                    $var5->status =  1;
                
                    $total_pay += $valor_sin_formato_amount_pay5;

                    $validate_boolean5 = true;

                
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 5!');
            }

            
        }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 5 debe ser distinto de Cero!');
            }
        /*--------------------------------------------*/
    } 
    if($come_pay >= 6){

        /*-------------PAGO NUMERO 6----------------------*/

        $var6 = new QuotationPayment();

        $amount_pay6 = request('amount_pay6');

        if(isset($amount_pay6)){
            
            $valor_sin_formato_amount_pay6 = str_replace(',', '.', str_replace('.', '', $amount_pay6));
        }else{
            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 6!');
        }
            

        $account_bank6 = request('account_bank6');
        $account_efectivo6 = request('account_efectivo6');
        $account_punto_de_venta6 = request('account_punto_de_venta6');

        $credit_days6 = request('credit_days6');

        $payment_type6 = request('payment_type6');

        $reference6 = request('reference6');

        if($valor_sin_formato_amount_pay6 != 0){

            if($payment_type6 != 0){

                $var6->id_quotation = request('id_quotation');

                //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                if($payment_type6 == 1 || $payment_type6 == 11 || $payment_type6 == 5 ){
                    //CUENTAS BANCARIAS
                    if(($account_bank6 != 0)){
                        if(isset($reference6)){

                            $var6->id_account = $account_bank6;

                            $var6->reference = $reference6;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 6!');
                        }
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 6!');
                    }
                }
                if($payment_type6 == 4){
                    //DIAS DE CREDITO
                    if(isset($credit_days6)){

                        $var6->credit_days = $credit_days6;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 6!');
                    }
                }

                if($payment_type6 == 6){
                    //DIAS DE CREDITO
                    if(($account_efectivo6 != 0)){

                        $var6->id_account = $account_efectivo6;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 6!');
                    }
                }

                if($payment_type6 == 9 || $payment_type6 == 10){
                    //CUENTAS PUNTO DE VENTA
                    if(($account_punto_de_venta6 != 0)){
                        $var6->id_account = $account_punto_de_venta6;
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 6!');
                    }
                }

            
            

                    $var6->payment_type = request('payment_type6');
                    $var6->amount = $valor_sin_formato_amount_pay6;
                    
                    
                    $var6->status =  1;
                
                    $total_pay += $valor_sin_formato_amount_pay6;

                    $validate_boolean6 = true;

                
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 6!');
            }

            
        }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 6 debe ser distinto de Cero!');
            }
        /*--------------------------------------------*/
    } 
    if($come_pay >= 7){

        /*-------------PAGO NUMERO 7----------------------*/

        $var7 = new QuotationPayment();

        $amount_pay7 = request('amount_pay7');

        if(isset($amount_pay7)){
            
            $valor_sin_formato_amount_pay7 = str_replace(',', '.', str_replace('.', '', $amount_pay7));
        }else{
            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar un monto de pago 7!');
        }
            

        $account_bank7 = request('account_bank7');
        $account_efectivo7 = request('account_efectivo7');
        $account_punto_de_venta7 = request('account_punto_de_venta7');

        $credit_days7 = request('credit_days7');

        $payment_type7 = request('payment_type7');

        $reference7 = request('reference7');

        if($valor_sin_formato_amount_pay7 != 0){

            if($payment_type7 != 0){

                $var7->id_quotation = request('id_quotation');

                //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                if($payment_type7 == 1 || $payment_type7 == 11 || $payment_type7 == 5 ){
                    //CUENTAS BANCARIAS
                    if(($account_bank7 != 0)){
                        if(isset($reference7)){

                            $var7->id_account = $account_bank7;

                            $var7->reference = $reference7;

                        }else{
                            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 7!');
                        }
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 7!');
                    }
                }
                if($payment_type7 == 4){
                    //DIAS DE CREDITO
                    if(isset($credit_days7)){

                        $var7->credit_days = $credit_days7;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 7!');
                    }
                }

                if($payment_type7 == 6){
                    //DIAS DE CREDITO
                    if(($account_efectivo7 != 0)){

                        $var7->id_account = $account_efectivo7;

                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 7!');
                    }
                }

                if($payment_type7 == 9 || $payment_type7 == 10){
                    //CUENTAS PUNTO DE VENTA
                    if(($account_punto_de_venta7 != 0)){
                        $var7->id_account = $account_punto_de_venta7;
                    }else{
                        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 7!');
                    }
                }

            
            

                    $var7->payment_type = request('payment_type7');
                    $var7->amount = $valor_sin_formato_amount_pay7;
                    
                    
                    $var7->status =  1;
                
                    $total_pay += $valor_sin_formato_amount_pay7;

                    $validate_boolean7 = true;

                
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago 7!');
            }

            
        }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('El pago 7 debe ser distinto de Cero!');
            }
        /*--------------------------------------------*/
    } 

    $total_pay_form = request('total_pay_form');

    //VALIDA QUE LA SUMA MONTOS INGRESADOS SEAN IGUALES AL MONTO TOTAL DEL PAGO
    if($total_pay == $total_pay_form){

        if($validate_boolean1 == true){
            $var->save();
        }
        
        if($validate_boolean2 == true){
            $var2->save();
        }
        
        if($validate_boolean3 == true){
            $var3->save();
        }
        if($validate_boolean4 == true){
            $var4->save();
        }
        if($validate_boolean5 == true){
            $var5->save();
        }
        if($validate_boolean6 == true){
            $var6->save();
        }
        if($validate_boolean7 == true){
            $var7->save();
        }
       
        /*Modifica la cotizacion */
            $quotation->date_billing = $datenow;

            $quotation->date_billing = $datenow;

            $quotation->iva_percentage = request('iva_form');

            $anticipo = request('anticipo_form');

            

            if(isset($anticipo)){
                $valor_sin_formato_anticipo = str_replace(',', '.', str_replace('.', '', $anticipo));
                $quotation->anticipo =  $valor_sin_formato_anticipo;
            }else{
                $quotation->anticipo = 0;
            }

            

            $quotation->save();

            
        /*---------------------- */

           /*Verificamos si el cliente tiene anticipos activos */

           DB::table('anticipos')->where('id_client', '=', $quotation->id_client)
           ->where('status', '=', 1)
           ->update(array('status' => 'C'));



            /*------------------------------------------------- */

    }else{
        return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('La suma de los pagos es diferente al monto Total a Pagar!');
    }

        

        return redirect('quotations/facturado/'.$quotation->id.'')->withSuccess('Factura Guardada con Exito!');
    }


















    public function createfacturado($id_quotation)
    {
         $quotation = null;
             
         if(isset($id_quotation)){
             $quotation = Quotation::where('date_billing', '<>', null)->find($id_quotation);
          /* $quotation = DB::table('clients')
                                    ->join('quotations', 'quotations.id_client', '=', 'clients.id')
                                    ->where('quotations.id', '=',$id_quotation)
                                    ->where('date_billing', '<>', null)
                                    ->select('quotations.*','clients.cedula_rif as cedula_client')
                                   
                                   ->first();

                                   dd($quotation);*/
                                 
         }
 
         if(isset($quotation)){
             $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
             $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

           

             $total= 0;
             $base_imponible= 0;
             foreach($product_quotations as $var){
                $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;

                $total += ($var->products['price'] * $var->amount) - $percentage; 

                if($var->products['exento'] == 0){

                    $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;

                    $base_imponible += ($var->products['price'] * $var->amount) - $percentage; 

                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    
     
             return view('admin.quotations.createfacturado',compact('quotation','product_quotations','payment_quotations', 'datenow'));
            }else{
             return redirect('/invoices')->withDanger('La factura no existe');
         } 
         
    }
}
