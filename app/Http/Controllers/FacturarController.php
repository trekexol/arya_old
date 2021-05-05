<?php

namespace App\Http\Controllers;

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
                $total += ($var->products['price'] * $var->amount) - $var->discount;

                if($var->products['exento'] == 1){
                    $base_imponible= ($var->products['price'] * $var->amount) - $var->discount;
                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    
     
             return view('admin.quotations.createfacturar',compact('quotation','product_quotations','payment_quotations', 'accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','datenow'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }

    public function storefactura(Request $request)
    {
       
        $data = request()->validate([
            
        
        
        ]);

        $quotation = Quotation::find(request('id_quotation'));

        $var = new QuotationPayment();

        $amount_pay = request('amount_pay');

        $account_bank = request('account_bank');
        $account_efectivo = request('account_efectivo');
        $account_punto_de_venta = request('account_punto_de_venta');

        $payment_type = request('payment_type');

        if(isset($amount_pay)){

            if(isset($payment_type)){

                $var->id_quotation = request('id_quotation');

                //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                if( $account_bank != 0 ){
    
                    $var->id_account = $account_bank;
    
                }else if( $account_efectivo != 0 ){
    
                    $var->id_account = $account_efectivo;
    
                }else if( $account_punto_de_venta != 0 ){
    
                    $var->id_account = $account_punto_de_venta;
                }
    
                $var->payment_type = request('payment_type');
                $var->amount = $amount_pay;
                
                $var->credit_days = request('credit_days');
                $var->reference = request('reference');
                
                $var->status =  1;
            
                
                $var->save();
            }else{
                return redirect('quotations/facturar/'.$quotation->id.'')->withDanger('Debe seleccionar un Tipo de Pago!');
            }

           
        }

        

        return redirect('quotations/facturado/'.$quotation->id.'')->withSuccess('Factura Guardada con Exito!');
    }


    public function createfacturado($id_quotation)
    {
         $quotation = null;
             
         if(isset($id_quotation)){
             $quotation = Quotation::find($id_quotation);
         }
 
         if(isset($quotation)){
             $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
             $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

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
                $total += ($var->products['price'] * $var->amount) - $var->discount;

                if($var->products['exento'] == 1){
                    $base_imponible= ($var->products['price'] * $var->amount) - $var->discount;
                }
             }

             $quotation->total_factura = $total;
             $quotation->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    
     
             return view('admin.quotations.createfacturado',compact('quotation','product_quotations','payment_quotations', 'accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','datenow'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }
}
