<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quotation;
use App\QuotationProduct;
use Carbon\Carbon;

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
     
             return view('admin.quotations.createfacturar',compact('quotation','product_quotations','datenow'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
 
 
    }
}
