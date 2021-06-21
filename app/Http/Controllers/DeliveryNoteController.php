<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryNoteController extends Controller
{

    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         $quotations = Quotation::orderBy('id' ,'DESC')
                                 ->where('date_delivery_note','<>',null)
                                 ->where('date_billing',null)
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


             $bcv = $this->search_bcv();

             
     
             return view('admin.quotations.createdeliverynote',compact('quotation','datenow','bcv'));
         }else{
             return redirect('/quotations')->withDanger('La cotizacion no existe');
         } 
         
    }



    public function search_bcv()
    {
        /*Buscar el indice bcv*/
        $urlToGet ='http://www.bcv.org.ve/tasas-informativas-sistema-bancario';
        $pageDocument = @file_get_contents($urlToGet);
        preg_match_all('|<div class="col-sm-6 col-xs-6"><strong> (.*?) </strong> </div>|s', $pageDocument, $cap);

        if ($cap[0] == array()){ // VALIDAR Concidencia
            $titulo = '0,00';
        }else {
            $titulo = $cap[1][2];
        }

        $bcv_con_formato = $titulo;
        $bcv = str_replace(',', '.', str_replace('.', '',$bcv_con_formato));


        /*-------------------------- */
        return $bcv;

    }
}
