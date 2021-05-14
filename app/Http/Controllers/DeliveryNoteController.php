<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryNoteController extends Controller
{

    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         $quotations = Quotation::orderBy('id' ,'DESC')
                                 ->where('date_delivery_note','<>',null)
                                 ->get();
                                 
         }elseif($users_role == '2'){
            return view('admin.index');
        }
 
        return view('admin.quotations.indexdeliverynote',compact('quotations'));
    }
 




    public function createdeliverynote($id_quotation,$coin)
    {
         $quotation = null;
             
         if(isset($id_quotation)){
            $quotation = Quotation::findOrFail($id_quotation);
            
            $quotation->coin = $coin;
            
            $quotation->save();
         }
 
         if(isset($quotation)){
             $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
            // $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

           
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
     
             return view('admin.quotations.createdeliverynote',compact('quotation','product_quotations','datenow'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }
}
