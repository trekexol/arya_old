<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PdfNominaController extends Controller
{
    function imprimirFactura(Request $request){
      
        dd($request);
        $pdf = App::make('dompdf.wrapper');

        
            /* $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){

                 $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }


                 $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                            ->where('quotation_products.id_quotation',$quotation->id)
                                                            ->select('products.*','quotation_products.discount as discount',
                                                            'quotation_products.amount as amount_quotation')
                                                            ->get(); 

            
                $total= 0;
                $base_imponible= 0;
                $ventas_exentas= 0;
                foreach($inventories_quotations as $var){
                    //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $total += ($var->price * $var->amount_quotation) - $percentage;
                    //----------------------------- 

                    if($var->exento == 0){

                        $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                        $base_imponible += ($var->price * $var->amount_quotation) - $percentage; 

                    }
                    if($var->exento == 1){
    
                        $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;
    
                        $ventas_exentas += ($var->price * $var->amount_quotation) - $percentage; 
    
                    }
                }
    
               
    
                 $quotation->sub_total_factura = $total;
                 $quotation->base_imponible = $base_imponible;
                 $quotation->ventas_exentas = $ventas_exentas;

                
                 $pdf = $pdf->loadView('pdf.factura',compact('quotation','inventories_quotations','payment_quotations'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        
*/
        
    }
}
