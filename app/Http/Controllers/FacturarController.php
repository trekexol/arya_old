<?php

namespace App\Http\Controllers;

use App\Account;
use App\Anticipo;
use App\DetailVoucher;
use App\HeaderVoucher;
use App\Inventory;
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
             //$product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
             
                                                            
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

            $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                            ->where('quotation_products.id_quotation',$quotation->id)
                                                            ->select('products.*','quotation_products.discount as discount',
                                                            'quotation_products.amount as amount_quotation')
                                                            ->get(); 

             $total= 0;
             $base_imponible= 0;

             foreach($inventories_quotations as $var){
                 //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $total += ($var->price * $var->amount_quotation) - $percentage;
                //----------------------------- 

                if($var->exento == 0){

                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $base_imponible += ($var->price * $var->amount_quotation) - $percentage; 

                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
     
             return view('admin.quotations.createfacturar',compact('quotation','payment_quotations', 'accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','datenow','anticipos_sum'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }
    public function storefacturacredit(Request $request)
    {
       

        $sin_formato_base_imponible = str_replace(',', '.', str_replace('.', '', request('base_imponible')));
        $sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('total_factura')));
        $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount')));
        $sin_formato_amount_with_iva = str_replace(',', '.', str_replace('.', '', request('grand_total')));
         

        $id_quotation = request('id_quotation');

        $quotation = Quotation::findOrFail($id_quotation);

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $quotation->date_billing = $datenow;

        $quotation->base_imponible = $sin_formato_base_imponible;
        $quotation->amount =  $sin_formato_amount;
        $quotation->amount_iva =  $sin_formato_amount_iva;
        $quotation->amount_with_iva =  $sin_formato_amount_with_iva;

        $credit = request('credit');

        $quotation->iva_percentage = request('iva');

        $quotation->credit_days = $credit;

        $quotation->save();

        return redirect('quotations/facturado/'.$quotation->id.'')->withSuccess('Factura Guardada con Exito!');
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


        $user_id = request('user_id');

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

     
        $payment_type = request('payment_type');
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
        $payment_type2 = request('payment_type2');
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
        $payment_type3 = request('payment_type3');   
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
        $payment_type4 = request('payment_type4');
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
        $payment_type5 = request('payment_type5');
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
        $payment_type6 = request('payment_type6');
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
        $payment_type7 = request('payment_type7');
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

            /*descontamos el inventario*/
            $retorno = $this->discount_inventory($quotation->id);

            if($retorno != "exito"){
                return redirect('quotations/facturar/'.$quotation->id.'');
            }
        
            /*---------------- */

                $header_voucher  = new HeaderVoucher();


                $header_voucher->description = "Cobro de Bienes o servicios.";
                $header_voucher->date = $datenow;
                
            
                $header_voucher->status =  "1";
            
                $header_voucher->save();

            /*TERMINAR ESTO */
            if($validate_boolean1 == true){
                $var->save();

              
                    $this->add_pay_movement($payment_type,$header_voucher->id,$var->id_account,$quotation->id,$user_id,$var->amount,0);
                

                //LE PONEMOS STATUS C, DE COBRADO
                $quotation->status = "C";
            }
            
            if($validate_boolean2 == true){
                $var2->save();
               
                $this->add_pay_movement($payment_type2,$header_voucher->id,$var2->id_account,$quotation->id,$user_id,$var2->amount,0);
                
            }
            
            if($validate_boolean3 == true){
                $var3->save();

                $this->add_pay_movement($payment_type3,$header_voucher->id,$var3->id_account,$quotation->id,$user_id,$var3->amount,0);
            
                
            }
            if($validate_boolean4 == true){
                $var4->save();

                $this->add_pay_movement($payment_type4,$header_voucher->id,$var4->id_account,$quotation->id,$user_id,$var4->amount,0);
            
            }
            if($validate_boolean5 == true){
                $var5->save();

                $this->add_pay_movement($payment_type5,$header_voucher->id,$var5->id_account,$quotation->id,$user_id,$var5->amount,0);
             
            }
            if($validate_boolean6 == true){
                $var6->save();

                $this->add_pay_movement($payment_type6,$header_voucher->id,$var6->id_account,$quotation->id,$user_id,$var6->amount,0);
            
            }
            if($validate_boolean7 == true){
                $var7->save();

                $this->add_pay_movement($payment_type7,$header_voucher->id,$var7->id_account,$quotation->id,$user_id,$var7->amount,0);
            
            }

            //Al final de agregar los movimientos de los pagos, agregamos el monto total de los pagos a cuentas por cobrar clientes
            $account_cuentas_por_cobrar = Account::where('description', 'like', 'Cuentas por Cobrar Clientes')->first(); 
            
            if(isset($account_cuentas_por_cobrar)){
                $this->add_movement($header_voucher->id,$account_cuentas_por_cobrar->id,$quotation->id,$user_id,0,$total_pay_form);
            }
            

            $sin_formato_base_imponible = str_replace(',', '.', str_replace('.', '', request('base_imponible_form')));
            $sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('sub_total_form')));
            $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount_form')));
            $sin_formato_amount_with_iva = str_replace(',', '.', str_replace('.', '', request('total_pay_form')));

            $quotation->base_imponible = $sin_formato_base_imponible;
            $quotation->amount =  $sin_formato_amount;
            $quotation->amount_iva =  $sin_formato_amount_iva;
            $quotation->amount_with_iva =  $sin_formato_amount_with_iva;
         
            $iva_percentage = request('iva_form');
        
            /*Modifica la cotizacion */
                $quotation->date_billing = $datenow;

                $quotation->date_billing = $datenow;

                $quotation->iva_percentage = $iva_percentage;

                $anticipo = request('anticipo_form');


                
                

                if(isset($anticipo)){
                   // $valor_sin_formato_anticipo = str_replace(',', '.', str_replace('.', '', $anticipo));
                    $quotation->anticipo =  $anticipo;
                }else{
                    $quotation->anticipo = 0;
                }

                $quotation->amount_with_iva = $total_pay_form;

                

                $quotation->save();

            /*---------------------- */

            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');   

            $sub_total = request('sub_total_form');

            $base_imponible = request('base_imponible_form');


            /*Aplicamos los movimientos Contables */

                $header_voucher  = new HeaderVoucher();


                $header_voucher->description = "Ventas de Bienes o servicios.";
                $header_voucher->date = $datenow;
                
            
                $header_voucher->status =  "1";
            
                $header_voucher->save();

                /*Busqueda de Cuentas*/

                //Cuentas por Cobrar Clientes

                $account_cuentas_por_cobrar = Account::where('description', 'like', 'Cuentas por Cobrar Clientes')->first();  
            
                if(isset($account_cuentas_por_cobrar)){
                    $this->add_movement($header_voucher->id,$account_cuentas_por_cobrar->id,$quotation->id,$user_id,$total_pay_form,0);
                }

                //Ingresos por SubSegmento de Bienes

                $account_subsegmento = Account::where('description', 'like', 'Ingresos por SubSegmento de Bienes')->first();

                if(isset($account_cuentas_por_cobrar)){
                    $this->add_movement($header_voucher->id,$account_subsegmento->id,$quotation->id,$user_id,0,$sub_total);
                }

                //Debito Fiscal IVA por Pagar

                $account_debito_iva_fiscal = Account::where('description', 'like', 'Debito Fiscal IVA por Pagar')->first();
                
                if($base_imponible != 0){
                    $total_iva = ($base_imponible * $iva_percentage)/100;

                    if(isset($account_cuentas_por_cobrar)){
                        $this->add_movement($header_voucher->id,$account_debito_iva_fiscal->id,$quotation->id,$user_id,0,$total_iva);
                    }
                }
                
                //Mercancia para la Venta
                
                $account_mercancia_venta = Account::where('description', 'like', 'Mercancia para la Venta')->first();

                if(isset($account_cuentas_por_cobrar)){
                    $this->add_movement($header_voucher->id,$account_mercancia_venta->id,$quotation->id,$user_id,0,$sub_total);
                }

                //Costo de Mercancia

                $account_costo_mercancia = Account::where('description', 'like', 'Costo de Mercancia')->first();

                if(isset($account_cuentas_por_cobrar)){
                    $this->add_movement($header_voucher->id,$account_costo_mercancia->id,$quotation->id,$user_id,$sub_total,0);
                }
                /*----------- */


            

            /*------------------------------------------------- */

            

            /*Verificamos si el cliente tiene anticipos activos */

            if($anticipo != 0){
                    DB::table('anticipos')->where('id_client', '=', $quotation->id_client)
                    ->where('status', '=', '1')
                    ->update(['status' => 'C']);
        
            }

            


                /*------------------------------------------------- */

        }else{
            return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('La suma de los pagos es diferente al monto Total a Pagar!');
        }

        

        return redirect('quotations/facturado/'.$quotation->id.'')->withSuccess('Factura Guardada con Exito!');
    }





    public function add_movement($id_header,$id_account,$id_invoice,$id_user,$debe,$haber){

        $detail = new DetailVoucher();

        $detail->id_account = $id_account;
        $detail->id_header_voucher = $id_header;
        $detail->user_id = $id_user;

        $detail->id_invoice = $id_invoice;

      /*  $valor_sin_formato_debe = str_replace(',', '.', str_replace('.', '', $debe));
        $valor_sin_formato_haber = str_replace(',', '.', str_replace('.', '', $haber));*/


        $detail->debe = $debe;
        $detail->haber = $haber;
       
      
        $detail->status =  "C";

         /*Le cambiamos el status a la cuenta a M, para saber que tiene Movimientos en detailVoucher */
         
            $account = Account::findOrFail($detail->id_account);

            if($account->status != "M"){
                $account->status = "M";
                $account->save();
            }
         
    
        $detail->save();

    }



    public function discount_inventory($id_quotation){
            /*Primero Revisa que todos los productos tengan inventario suficiente*/
            $no_hay_cantidad_suficiente = DB::table('inventories')
                                    ->join('quotation_products', 'quotation_products.id_inventory','=','inventories.id')
                                    ->where('quotation_products.id_quotation','=',$id_quotation)
                                    ->where('quotation_products.amount','<','inventories.amount')
                                    ->select('inventories.code as code','quotation_products.id_quotation as id_quotation','quotation_products.discount as discount',
                                    'quotation_products.amount as amount_quotation')
                                    ->first(); 
        
            if(isset($no_hay_cantidad_suficiente)){
                return redirect('quotations/facturar/'.$id_quotation.'')->withDanger('En el Inventario de Codigo: '.$no_hay_cantidad_suficiente->code.' no hay Cantidad suficiente!');
            }

        /*Luego, descuenta del Inventario*/
            $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
            ->where('quotation_products.id_quotation',$id_quotation)
            ->select('products.*','quotation_products.id as id_quotation','quotation_products.discount as discount',
            'quotation_products.amount as amount_quotation')
            ->get(); 

                foreach($inventories_quotations as $inventories_quotation){

                    $quotation_product = QuotationProduct::findOrFail($inventories_quotation->id_quotation);

                    if(isset($quotation_product)){
                    $inventory = Inventory::findOrFail($quotation_product->id_inventory);

                        if(isset($inventory)){
                            if($inventory->amount >= $quotation_product->amount){
                                $inventory->amount -= $quotation_product->amount;
                                $inventory->save();

                            }else{
                                return redirect('quotations/facturar/'.$id_quotation.'')->withDanger('El Inventario de Codigo: '.$inventory->code.' no tiene Cantidad suficiente!');
                            }
                            
                        }else{
                            return redirect('quotations/facturar/'.$id_quotation.'')->withDanger('El Inventario no existe!');
                        }
                    }else{
                    return redirect('quotations/facturar/'.$id_quotation.'')->withDanger('El Inventario de la cotizacion no existe!');
                    }

                }

                return "exito";

    }





    public function add_pay_movement($payment_type,$header_voucher,$id_account,$quotation_id,$user_id,$amount_debe,$amount_haber){


            //Cuentas por Cobrar Clientes

                //AGREGA EL MOVIMIENTO DE LA CUENTA CON LA QUE SE HIZO EL PAGO
                if(isset($id_account)){
                    $this->add_movement($header_voucher,$id_account,$quotation_id,$user_id,$amount_debe,0);
                
                }//SIN DETERMINAR
                else if($payment_type == 7){
                    
                    $account_sin_determinar = Account::where('description', 'like', 'Sin determinar')->first(); 
            
                    if(isset($account_sin_determinar)){
                        $this->add_movement($header_voucher,$account_sin_determinar->id,$quotation_id,$user_id,$amount_debe,0);
                    }
                }//PAGO DE CONTADO
                else if($payment_type == 2){
                    
                    $account_contado = Account::where('description', 'like', 'Caja Chica')->first(); 
            
                    if(isset($account_contado)){
                        $this->add_movement($header_voucher,$account_contado->id,$quotation_id,$user_id,$amount_debe,0);
                    }
                }//CONTRA ANTICIPO
                else if($payment_type == 3){
                    
                    $account_contra_anticipo = Account::where('description', 'like', 'Anticipos a Proveedores Nacionales')->first(); 
            
                    if(isset($account_contra_anticipo)){
                        $this->add_movement($header_voucher,$account_contra_anticipo->id,$quotation_id,$user_id,$amount_debe,0);
                    }
                } 
                //Tarjeta Corporativa 
                else if($payment_type == 8){
                    
                    $account_contra_anticipo = Account::where('description', 'like', 'Tarjeta Corporativa')->first(); 
            
                    if(isset($account_contra_anticipo)){
                        $this->add_movement($header_voucher,$account_contra_anticipo->id,$quotation_id,$user_id,$amount_debe,0);
                    }
                } 

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
                // $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
                $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

           
                $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                                ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                                ->where('quotation_products.id_quotation',$quotation->id)
                                                                ->select('products.*','quotation_products.discount as discount',
                                                                'quotation_products.amount as amount_quotation')
                                                                ->get(); 

                $total= 0;
                $base_imponible= 0;

                foreach($inventories_quotations as $var){
                    //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $total += ($var->price * $var->amount_quotation) - $percentage;
                    //----------------------------- 

                    if($var->exento == 0){

                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $base_imponible += ($var->price * $var->amount_quotation) - $percentage; 

                    }
                }


             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
             return view('admin.quotations.createfacturado',compact('quotation','payment_quotations', 'datenow'));
            }else{
             return redirect('/invoices')->withDanger('La factura no existe');
         } 
         
    }


    public function createfacturar_after($id_quotation)
    {
         $quotation = null;
             
         if(isset($id_quotation)){
             $quotation = Quotation::find($id_quotation);
         }
 
         if(isset($quotation)){
                                                                       
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

            $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                            ->where('quotation_products.id_quotation',$quotation->id)
                                                            ->select('products.*','quotation_products.discount as discount',
                                                            'quotation_products.amount as amount_quotation')
                                                            ->get(); 

             $total= 0;
             $base_imponible= 0;

             foreach($inventories_quotations as $var){
                 //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $total += ($var->price * $var->amount_quotation) - $percentage;
                //----------------------------- 

                if($var->exento == 0){

                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $base_imponible += ($var->price * $var->amount_quotation) - $percentage; 

                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
     
             return view('admin.quotations.createfacturar_after',compact('quotation','payment_quotations', 'accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','datenow','anticipos_sum'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }
   
}
