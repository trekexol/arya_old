<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\ExpensePayment;
use App\ExpensesAndPurchase;
use App\ExpensesDetail;
use App\Inventory;
use App\Quotation;
use App\QuotationPayment;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{

    function imprimirFactura($id_quotation,$coin = null){
      

        $pdf = App::make('dompdf.wrapper');

        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){

                 $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                    if($coin == 'dolares'){
                        $var->amount = $var->amount / $var->rate;
                    }
                 }


                 $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                            ->where('quotation_products.id_quotation',$quotation->id)
                                                            ->select('products.*','quotation_products.price as price','quotation_products.rate as rate','quotation_products.discount as discount',
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
                 

                if($coin == 'bolivares'){
                    $bcv = null;
                    
                }else{
                    $bcv = $this->search_bcv();
                }

                
                 $pdf = $pdf->loadView('pdf.factura',compact('quotation','inventories_quotations','payment_quotations','bcv'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        

        
    }


    function deliverynote($id_quotation,$coin,$iva){
      

        $pdf = App::make('dompdf.wrapper');
        $bcv = $this->search_bcv();


      //  $id_quotation = request('id_quotation');
        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::findOrFail($id_quotation);

                 if(!(isset($quotation->date_delivery_note))){
                    $date = Carbon::now();
                    $datenow = $date->format('Y-m-d');   
   
                    $quotation->iva_percentage = $iva;
   
                    $quotation->date_delivery_note = $datenow;
   
                    if(isset($bcv)){
                       $quotation->bcv = $bcv;
                    }
   
                    $quotation->save();
   
                    $this->discount_inventory($id_quotation);
                 }else{
                    if(isset($quotation->bcv)){
                        $bcv = $quotation->bcv;
                     }
                 }
                 
                                     
             }else{
                return redirect('/quotations')->withDanger('No llega el numero de la cotizacion');
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

                if($quotation->coin == 'dolares'){
                    $bcv = null;
                }

                
                 $pdf = $pdf->loadView('pdf.deliverynote',compact('quotation','inventories_quotations','bcv'));
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



    
    function imprimirinventory(){
      
        

        $pdf_inventory = App::make('dompdf.wrapper');

        $inventories = Inventory::orderBy('id','desc')->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $pdf_inventory = $pdf_inventory->loadView('pdf.inventory',compact('inventories','datenow'));
        return $pdf_inventory->stream();
                 
    }


    function imprimirFactura_media($id_quotation,$coin = null){
      

        $pdf = App::make('dompdf.wrapper');

        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){

                 $payment_quotations = QuotationPayment::where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                    if($coin = 'dolares'){
                        $var->amount = $var->amount / $var->rate;
                    }
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

                    if(($coin == 'bolivares') || (!isset($coin)) ){
                        $bcv = $this->search_bcv();
                    }else{
                        $bcv = null;
                    }

                
                 $pdf = $pdf->loadView('pdf.factura_media',compact('quotation','inventories_quotations','payment_quotations','bcv'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        

        
    }



    function imprimirExpense($id_expense){
      

        $pdf = App::make('dompdf.wrapper');

        
             $expense = null;
                 
             if(isset($id_expense)){
                 $expense = ExpensesAndPurchase::find($id_expense);
              
                                     
             }else{
                return redirect('/expensesandpurchases')->withDanger('No llega el numero del Gasto o Compra');
                } 
     
             if(isset($expense)){

                 $payment_expenses = ExpensePayment::where('id_expense',$expense->id)->get();
                 
                 foreach($payment_expenses as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }


                $inventories_expenses = ExpensesDetail::where('id_expense',$expense->id)->get();
            
                $total= 0;
                $base_imponible= 0;
                $ventas_exentas= 0;
                foreach($inventories_expenses as $var){
                   
                    $total += ($var->price * $var->amount);
                    //----------------------------- 

                    if($var->exento == 0){
                        $base_imponible += ($var->price * $var->amount); 

                    }
                    if($var->exento == 1){
                        $ventas_exentas += ($var->price * $var->amount); 
    
                    }
                }
    
                 $expense->sub_total = $total;
                 $expense->base_imponible = $base_imponible;
                 $expense->ventas_exentas = $ventas_exentas;

                 
                 $pdf = $pdf->loadView('pdf.expense',compact('expense','inventories_expenses','payment_expenses'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/expensesandpurchases')->withDanger('La Compra no existe');
             } 
             
        

        
    }

    function imprimirExpenseMedia($id_expense){
      

        $pdf = App::make('dompdf.wrapper');

        
             $expense = null;
                 
             if(isset($id_expense)){
                 $expense = ExpensesAndPurchase::find($id_expense);
              
                                     
             }else{
                return redirect('/expensesandpurchases')->withDanger('No llega el numero del Gasto o Compra');
                } 
     
             if(isset($expense)){

                 $payment_expenses = ExpensePayment::where('id_expense',$expense->id)->get();

                 foreach($payment_expenses as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }


                $inventories_expenses = ExpensesDetail::where('id_expense',$expense->id)->get();
            
                $total= 0;
                $base_imponible= 0;
                $ventas_exentas= 0;
                foreach($inventories_expenses as $var){

                    $total += ($var->price * $var->amount);
                    //----------------------------- 

                    if($var->exento == 0){

                        $base_imponible += ($var->price * $var->amount); 

                    }
                    if($var->exento == 1){
    
                        $ventas_exentas += ($var->price * $var->amount); 
    
                    }
                }
    
                 $expense->sub_total = $total;
                 $expense->base_imponible = $base_imponible;
                 $expense->ventas_exentas = $ventas_exentas;

                
                 $pdf = $pdf->loadView('pdf.expense',compact('expense','inventories_expenses','payment_expenses'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/expensesandpurchases')->withDanger('La Compra no existe');
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
        } else {
            $titulo = $cap[1][2];
        }

        $bcv_con_formato = $titulo;
        $bcv = str_replace(',', '.', str_replace('.', '',$bcv_con_formato));


        /*-------------------------- */
        return $bcv;

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
                        //REVISO QUE SEA MAYOR EL MONTO DEL INVENTARIO Y LUEGO DESCUENTO
                        if($inventory->amount >= $quotation_product->amount){
                            $inventory->amount -= $quotation_product->amount;
                            $inventory->save();

                            //CAMBIAMOS EL ESTADO PARA SABER QUE ESE PRODUCTO YA SE COBRO Y SE RESTO DEL INVENTARIO
                            $quotation_product->status = 'C';  
                            $quotation_product->save();

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

}
