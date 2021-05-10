<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Quotation;
use App\QuotationPayment;
use App\QuotationProduct;

class PDFController extends Controller
{

    function imprimirFactura($id_quotation){
      

        $pdf = App::make('dompdf.wrapper');

        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){
                 $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
                 $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }
    
                 $total= 0;
                 $base_imponible= 0;
                 foreach($product_quotations as $var){
                    $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;

                    $total += ($var->products['price'] * $var->amount) - $percentage; 
    
                    if($var->products['exento'] == 1){
    
                        $percentage = (($var->products['price'] * $var->amount) * $var->discount)/100;
    
                        $base_imponible= ($var->products['price'] * $var->amount) - $percentage; 
    
                    }
                 }
    
                 $quotation->total_factura = $total;
                 $quotation->base_imponible = $base_imponible;

                
                 $pdf = $pdf->loadView('pdf.factura',compact('quotation','product_quotations','payment_quotations'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        

        
    }

    
    function asignar_payment_type($type){
      
        if($type == 1){
            return "Cheque";
        }
        if($type == 2){
            return "Contado";
        }
        if($type == 3){
            return "Contra Anticipo";
        }
        if($type == 4){
            return "Crédito";
        }
        if($type == 5){
            return "Depósito Bancario";
        }
        if($type == 6){
            return "Efectivo";
        }
        if($type == 7){
            return "Indeterminado";
        }
        if($type == 8){
            return "Tarjeta Coorporativa";
        }
        if($type == 9){
            return "Tarjeta de Crédito";
        }
        if($type == 10){
            return "Tarjeta de Débito";
        }
        if($type == 11){
            return "Transferencia";
        }
    }

}
