<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Account;
use App\AccountHistorial;
use App\Client;
use App\Company;
use App\ExpensePayment;
use App\ExpensesAndPurchase;
use App\ExpensesDetail;
use App\Inventory;
use App\Quotation;
use App\QuotationPayment;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{

    function imprimirFactura($id_quotation,$coin = null){
      

        $pdf = App::make('dompdf.wrapper');

        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::on(Auth::user()->database_name)->where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){

                 $payment_quotations = QuotationPayment::on(Auth::user()->database_name)->where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                    if($coin == 'dolares'){
                        $var->amount = $var->amount / $var->rate;
                    }
                 }


                 $inventories_quotations = DB::connection(Auth::user()->database_name)->table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                                ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                                ->where('quotation_products.id_quotation',$quotation->id)
                                                                ->select('products.*','quotation_products.price as price','quotation_products.rate as rate','quotation_products.discount as discount',
                                                                'quotation_products.amount as amount_quotation','quotation_products.retiene_iva as retiene_iva_quotation'
                                                                ,'quotation_products.retiene_islr as retiene_islr_quotation')
                                                                ->get(); 

            
                if($coin == 'bolivares'){
                    $bcv = null;
                    
                }else{
                    $bcv = $quotation->bcv;
                }

                $company = Company::on(Auth::user()->database_name)->find(1);
                
                 $pdf = $pdf->loadView('pdf.factura',compact('company','quotation','inventories_quotations','payment_quotations','bcv'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        

        
    }


    function deliverynote($id_quotation,$coin,$iva){
      

        $pdf = App::make('dompdf.wrapper');
    
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::on(Auth::user()->database_name)->findOrFail($id_quotation);

                 if(!(isset($quotation->date_delivery_note))){


                    $retorno = $this->discount_inventory($id_quotation);

                    if($retorno != 'exito'){
                        return redirect('quotations/register/'.$id_quotation.'/'.$coin.'')->withDanger($retorno);                     
                    }

                    $date = Carbon::now();
                    $datenow = $date->format('Y-m-d');   
   
                    $quotation->iva_percentage = $iva;
   
                    $quotation->date_delivery_note = $datenow;

                    $quotation->save();
   
                    


                 }else{
                    if(isset($quotation->bcv)){
                        $bcv = $quotation->bcv;
                     }
                 }
                 
                                     
             }else{
                return redirect('/quotations')->withDanger('No llega el numero de la cotizacion');
                } 
     
             if(isset($quotation)){
               
                $inventories_quotations = DB::connection(Auth::user()->database_name)->table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                                ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                                ->where('quotation_products.id_quotation',$quotation->id)
                                                                ->select('products.*','quotation_products.price as price','quotation_products.rate as rate','quotation_products.discount as discount',
                                                                'quotation_products.amount as amount_quotation','quotation_products.retiene_iva as retiene_iva_quotation'
                                                                ,'quotation_products.retiene_islr as retiene_islr_quotation')
                                                                ->get(); 

                $total= 0;
                $base_imponible= 0;
                $price_cost_total= 0;

                //este es el total que se usa para guardar el monto de todos los productos que estan exentos de iva, osea retienen iva
                $total_retiene_iva = 0;
                $retiene_iva = 0;

                $total_retiene_islr = 0;
                $retiene_islr = 0;

                foreach($inventories_quotations as $var){
                    //Se calcula restandole el porcentaje de descuento (discount)
                    $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                    $total += ($var->price * $var->amount_quotation) - $percentage;
                    //----------------------------- 

                    if($var->retiene_iva_quotation == 0){

                        $base_imponible += ($var->price * $var->amount_quotation) - $percentage; 

                    }else{
                        $retiene_iva += ($var->price * $var->amount_quotation) - $percentage; 
                    }

                    if($var->retiene_islr_quotation == 1){

                        $retiene_islr += ($var->price * $var->amount_quotation) - $percentage; 

                    }

                
                }

                $quotation->total_factura = $total;
                $quotation->base_imponible = $base_imponible;

                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');    
                $anticipos_sum = 0;
                if(isset($coin)){
                    if($coin == 'bolivares'){
                        $bcv = null;
                    }else{
                        $bcv = $quotation->bcv;
                    }
                }else{
                    $bcv = null;
                }


                /*Aqui revisamos el porcentaje de retencion de iva que tiene el cliente, para aplicarlo a productos que retengan iva */
                $client = Client::on(Auth::user()->database_name)->find($quotation->id_client);

                if($client->percentage_retencion_iva != 0){
                $total_retiene_iva = ($retiene_iva * $client->percentage_retencion_iva) /100;
                }


                if($client->percentage_retencion_islr != 0){
                $total_retiene_islr = ($retiene_islr * $client->percentage_retencion_islr) /100;
                }

                /*-------------- */

    
                $company = Company::on(Auth::user()->database_name)->find(1);
                
                $pdf = $pdf->loadView('pdf.deliverynote',compact('quotation','inventories_quotations','bcv','company'
                                                                ,'total_retiene_iva','total_retiene_islr'));
                return $pdf->stream();
         
            }else{
                return redirect('/invoices')->withDanger('La nota de entrega no existe');
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
            return "Cr??dito";
        }
        if($type == 5){
            return "Dep??sito Bancario";
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
            return "Tarjeta de Cr??dito";
        }
        if($type == 10){
            return "Tarjeta de D??bito";
        }
        if($type == 11){
            return "Transferencia";
        }
    }



    
    function imprimirinventory(){
      
        

        $pdf_inventory = App::make('dompdf.wrapper');

        $inventories = Inventory::on(Auth::user()->database_name)->orderBy('id','desc')->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $company = Company::on(Auth::user()->database_name)->find(1);

        $pdf_inventory = $pdf_inventory->loadView('pdf.inventory',compact('inventories','datenow','company'));
        return $pdf_inventory->stream();
                 
    }


    function imprimirFactura_media($id_quotation,$coin = null){
      

        $pdf = App::make('dompdf.wrapper');

        
             $quotation = null;
                 
             if(isset($id_quotation)){
                 $quotation = Quotation::on(Auth::user()->database_name)->where('date_billing', '<>', null)->find($id_quotation);
              
                                     
             }else{
                return redirect('/invoices')->withDanger('No llega el numero de la factura');
                } 
     
             if(isset($quotation)){

                 $payment_quotations = QuotationPayment::on(Auth::user()->database_name)->where('id_quotation',$quotation->id)->get();

                 foreach($payment_quotations as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                    if($coin == 'dolares'){
                        $var->amount = $var->amount / $var->rate;
                    }
                 }
                 
                 $inventories_quotations = DB::connection(Auth::user()->database_name)->table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                                ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                                ->where('quotation_products.id_quotation',$quotation->id)
                                                                ->select('products.*','quotation_products.price as price','quotation_products.rate as rate','quotation_products.discount as discount',
                                                                'quotation_products.amount as amount_quotation','quotation_products.retiene_iva as retiene_iva_quotation'
                                                                ,'quotation_products.retiene_islr as retiene_islr_quotation')
                                                                ->get(); 
                 
                 if($coin == 'bolivares'){
                    $bcv = null;
                    
                }else{
                    $bcv = $quotation->bcv;
                }

                $company = Company::on(Auth::user()->database_name)->find(1);                
                
                 $pdf = $pdf->loadView('pdf.factura_media',compact('quotation','inventories_quotations','payment_quotations','bcv','company'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/invoices')->withDanger('La factura no existe');
             } 
             
        

        
    }



    function imprimirExpense($id_expense,$coin){
      

        $pdf = App::make('dompdf.wrapper');

        
             $expense = null;
                 
             if(isset($id_expense)){
                 $expense = ExpensesAndPurchase::on(Auth::user()->database_name)->find($id_expense);
              
                                     
             }else{
                return redirect('/expensesandpurchases')->withDanger('No llega el numero del Gasto o Compra');
                } 
     
             if(isset($expense)){

                 $payment_expenses = ExpensePayment::on(Auth::user()->database_name)->where('id_expense',$expense->id)->get();
                 
                 foreach($payment_expenses as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }


                $inventories_expenses = ExpensesDetail::on(Auth::user()->database_name)->where('id_expense',$expense->id)->get();
            
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
                if($coin != 'bolivares'){
                    $total = $total / $expense->rate;
                    $base_imponible = $base_imponible / $expense->rate;
                    $ventas_exentas = $ventas_exentas / $expense->rate;
                }
                 $expense->sub_total = $total;
                 $expense->base_imponible = $base_imponible;
                 $expense->ventas_exentas = $ventas_exentas;

                 $company = Company::on(Auth::user()->database_name)->find(1);

                 $pdf = $pdf->loadView('pdf.expense',compact('coin','expense','inventories_expenses','payment_expenses','company'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/expensesandpurchases')->withDanger('La Compra no existe');
             } 
             
        

        
    }

    function imprimirExpenseMedia($id_expense,$coin){
      

        $pdf = App::make('dompdf.wrapper');

        
             $expense = null;
                 
             if(isset($id_expense)){
                 $expense = ExpensesAndPurchase::on(Auth::user()->database_name)->find($id_expense);
              
                                     
             }else{
                return redirect('/expensesandpurchases')->withDanger('No llega el numero del Gasto o Compra');
                } 
     
             if(isset($expense)){

                 $payment_expenses = ExpensePayment::on(Auth::user()->database_name)->where('id_expense',$expense->id)->get();

                 foreach($payment_expenses as $var){
                    $var->payment_type = $this->asignar_payment_type($var->payment_type);
                 }


                $inventories_expenses = ExpensesDetail::on(Auth::user()->database_name)->where('id_expense',$expense->id)->get();
            
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

                if($coin != 'bolivares'){
                    $total = $total / $expense->rate;
                    $base_imponible = $base_imponible / $expense->rate;
                    $ventas_exentas = $ventas_exentas / $expense->rate;
                }
    
                 $expense->sub_total = $total;
                 $expense->base_imponible = $base_imponible;
                 $expense->ventas_exentas = $ventas_exentas;

                 $company = Company::on(Auth::user()->database_name)->find(1);

                 $pdf = $pdf->loadView('pdf.expense_media',compact('coin','expense','inventories_expenses','payment_expenses','company'));
                 return $pdf->stream();
         
                }else{
                 return redirect('/expensesandpurchases')->withDanger('La Compra no existe');
             } 
             
        

        
    }


    function print_previousexercise($date_begin,$date_end){
      
        $pdf = App::make('dompdf.wrapper');

        $account_historial = AccountHistorial::on(Auth::user()->database_name)->where('date_begin',$date_begin)->where('date_end',$date_end)->orderBy('id','asc')->get();
        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $company = Company::on(Auth::user()->database_name)->find(1);

        $pdf = $pdf->loadView('pdf.previousexercise',compact('account_historial','datenow','company'));
        return $pdf->stream();
                 
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



    public function discount_inventory($id_quotation)
    {
            /*Primero Revisa que todos los productos tengan inventario suficiente*/
            $no_hay_cantidad_suficiente = DB::connection(Auth::user()->database_name)->table('inventories')
                                    ->join('quotation_products', 'quotation_products.id_inventory','=','inventories.id')
                                    ->where('quotation_products.id_quotation','=',$id_quotation)
                                    ->where('quotation_products.amount','<','inventories.amount')
                                    ->select('inventories.code as code','quotation_products.id_quotation as id_quotation','quotation_products.discount as discount',
                                    'quotation_products.amount as amount_quotation')
                                    ->first(); 
        
            if(isset($no_hay_cantidad_suficiente)){
                return "no_hay_cantidad_suficiente";
            }

            /*Luego, descuenta del Inventario*/
                $inventories_quotations = DB::connection(Auth::user()->database_name)->table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                ->where('quotation_products.id_quotation',$id_quotation)
                ->select('products.*','quotation_products.id as id_quotation','quotation_products.discount as discount',
                'quotation_products.amount as amount_quotation')
                ->get(); 

            foreach($inventories_quotations as $inventories_quotation){

                $quotation_product = QuotationProduct::on(Auth::user()->database_name)->findOrFail($inventories_quotation->id_quotation);

                if(isset($quotation_product)){
                    $inventory = Inventory::on(Auth::user()->database_name)->findOrFail($quotation_product->id_inventory);

                    if(isset($inventory)){
                        //REVISO QUE SEA MAYOR EL MONTO DEL INVENTARIO Y LUEGO DESCUENTO
                        if($inventory->amount >= $quotation_product->amount){
                            $inventory->amount -= $quotation_product->amount;
                            $inventory->save();

                            //CAMBIAMOS EL ESTADO PARA SABER QUE ESE PRODUCTO YA SE COBRO Y SE RESTO DEL INVENTARIO
                            $quotation_product->status = 'C';  
                            $quotation_product->save();

                        }else{
                            return 'El Inventario de Codigo: '.$inventory->code.' no tiene Cantidad suficiente!';
                        }
                        
                    }else{
                        return 'El Inventario no existe!';
                    }
                }else{
                return 'El Inventario de la cotizacion no existe!';
                }

            }

            return "exito";

    }


    public function calculation($coin)
    {
        
        $accounts = Account::on(Auth::user()->database_name)->orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
                         ->orderBy('code_five', 'asc')
                         ->get();
        
                       
        if(isset($accounts)) {
            
            foreach ($accounts as $var) 
            {
                if($var->code_one != 0)
                {
                    if($var->code_two != 0)
                    {
                        if($var->code_three != 0)
                        {
                            if($var->code_four != 0)
                            {
                                if($var->code_five != 0)
                                {
                                     /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                
                                     if($coin == 'bolivares'){
                                        $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe) AS debe
                                                        FROM accounts a
                                                        INNER JOIN detail_vouchers d 
                                                            ON d.id_account = a.id
                                                        WHERE a.code_one = ? AND
                                                        a.code_two = ? AND
                                                        a.code_three = ? AND
                                                        a.code_four = ? AND
                                                        a.code_five = ? AND
                                                        d.status = ?
                                                        '
                                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
                                        $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber) AS haber
                                                        FROM accounts a
                                                        INNER JOIN detail_vouchers d 
                                                            ON d.id_account = a.id
                                                        WHERE a.code_one = ? AND
                                                        a.code_two = ? AND
                                                        a.code_three = ? AND
                                                        a.code_four = ? AND
                                                        a.code_five = ? AND
                                                        d.status = ?
                                                        '
                                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
    
                                        $total_dolar_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS dolar
                                                        FROM accounts a
                                                        INNER JOIN detail_vouchers d 
                                                            ON d.id_account = a.id
                                                        WHERE a.code_one = ? AND
                                                        a.code_two = ? AND
                                                        a.code_three = ? AND
                                                        a.code_four = ? AND
                                                        a.code_five = ? AND
                                                        d.status = ?
                                                        '
                                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
    
                                        $total_dolar_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS dolar
                                                        FROM accounts a
                                                        INNER JOIN detail_vouchers d 
                                                            ON d.id_account = a.id
                                                        WHERE a.code_one = ? AND
                                                        a.code_two = ? AND
                                                        a.code_three = ? AND
                                                        a.code_four = ? AND
                                                        a.code_five = ? AND
                                                        d.status = ?
                                                        '
                                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
    
                                                        $var->balance =  $var->balance_previus;
    
                                       
                                        }else{
                                            $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS debe
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            a.code_two = ? AND
                                            a.code_three = ? AND
                                            a.code_four = ? AND
                                            a.code_five = ? AND
                                            d.status = ?
                                            '
                                            , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
                                            
                                            $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS haber
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            a.code_two = ? AND
                                            a.code_three = ? AND
                                            a.code_four = ? AND
                                            a.code_five = ? AND
                                            d.status = ?
                                            '
                                            , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,$var->code_five,'C']);
    
                                           
                                            
                                            
                                        }
                                        $total_debe = $total_debe[0]->debe;
                                        $total_haber = $total_haber[0]->haber;
                                        if(isset($total_dolar_debe[0]->dolar)){
                                            $total_dolar_debe = $total_dolar_debe[0]->dolar;
                                            $var->dolar_debe = $total_dolar_debe;
                                        }
                                        if(isset($total_dolar_haber[0]->dolar)){
                                            $total_dolar_haber = $total_dolar_haber[0]->dolar;
                                            $var->dolar_haber = $total_dolar_haber;
                                        }
                                    
                                        $var->debe = $total_debe;
                                        $var->haber = $total_haber;

                                        if(($var->balance_previus != 0) && ($var->rate !=0)){
                                            $var->balance =  $var->balance_previus;
                                        }
                                
                                }else{
                            
                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                
                                    if($coin == 'bolivares'){
                                    $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe) AS debe
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                    $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber) AS haber
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                    $total_dolar_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS dolar
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                    $total_dolar_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS dolar
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                                    $var->balance =  $var->balance_previus;

                                    $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus) AS balance
                                                    FROM accounts a
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ?  AND
                                                    a.code_three = ? AND
                                                    a.code_four = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four]);
                                
                                    }else{
                                        $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS debe
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        a.code_four = ? AND
                                        d.status = ?
                                        '
                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                        
                                        $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS haber
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        a.code_four = ? AND
                                        d.status = ?
                                        '
                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                        $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus/a.rate) AS balance
                                                    FROM accounts a
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ?  AND
                                                    a.code_three = ? AND
                                                    a.code_four = ?
                                                    '
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four]);

                                        /*if(($var->balance_previus != 0) && ($var->rate !=0))
                                        $var->balance =  $var->balance_previus / $var->rate;*/
                                    }
                                    $total_debe = $total_debe[0]->debe;
                                    $total_haber = $total_haber[0]->haber;
                                    if(isset($total_dolar_debe[0]->dolar)){
                                        $total_dolar_debe = $total_dolar_debe[0]->dolar;
                                        $var->dolar_debe = $total_dolar_debe;
                                    }
                                    if(isset($total_dolar_haber[0]->dolar)){
                                        $total_dolar_haber = $total_dolar_haber[0]->dolar;
                                        $var->dolar_haber = $total_dolar_haber;
                                    }
                                
                                    $var->debe = $total_debe;
                                    $var->haber = $total_haber;

                                    $total_balance = $total_balance[0]->balance;
                                    $var->balance = $total_balance;
                                }  
                            }else{          
                            
                                if($coin == 'bolivares'){
                                $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe) AS debe
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                a.code_three = ? AND
                                                
                                                d.status = ?
                                                '
                                                , [$var->code_one,$var->code_two,$var->code_three,'C']);
                                $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber) AS haber
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                a.code_three = ? AND
                                                
                                                d.status = ?
                                                '
                                                , [$var->code_one,$var->code_two,$var->code_three,'C']);

                                $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ? AND
                                            a.code_two = ?  AND
                                            a.code_three = ?
                                            '
                                            , [$var->code_one,$var->code_two,$var->code_three]);
                                
                                }else{
                                        $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS debe
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        
                                        d.status = ?
                                        '
                                        , [$var->code_one,$var->code_two,$var->code_three,'C']);
                                        
                                        $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS haber
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        
                                        d.status = ?
                                        '
                                        , [$var->code_one,$var->code_two,$var->code_three,'C']);
                        
                                        $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus/a.rate) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ? AND
                                            a.code_two = ? AND
                                            a.code_three = ?
                                            '
                                            , [$var->code_one,$var->code_two,$var->code_three]);

                                    }
                                    $total_debe = $total_debe[0]->debe;
                                    $total_haber = $total_haber[0]->haber;
                                
                                    $var->debe = $total_debe;
                                    $var->haber = $total_haber;

                                    

                                    $total_balance = $total_balance[0]->balance;
                                    $var->balance = $total_balance;
                                      
                                            
                            }           
                        }else{
                                            
                            if($coin == 'bolivares'){
                                $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe) AS debe
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                d.status = ?
                                                '
                                                , [$var->code_one,$var->code_two,'C']);
                                $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber) AS haber
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                d.status = ?
                                                '
                                                , [$var->code_one,$var->code_two,'C']);
                                
                                $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ? AND
                                            a.code_two = ?
                                            '
                                            , [$var->code_one,$var->code_two]);
                                
                                }else{
                                    $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS debe
                                    FROM accounts a
                                    INNER JOIN detail_vouchers d 
                                        ON d.id_account = a.id
                                    WHERE a.code_one = ? AND
                                    a.code_two = ? AND
                                    d.status = ?
                                    '
                                    , [$var->code_one,$var->code_two,'C']);
                                    
                                    $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS haber
                                    FROM accounts a
                                    INNER JOIN detail_vouchers d 
                                        ON d.id_account = a.id
                                    WHERE a.code_one = ? AND
                                    a.code_two = ? AND
                                    d.status = ?
                                    '
                                    , [$var->code_one,$var->code_two,'C']);

                                    $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus/a.rate) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ? AND
                                            a.code_two = ?
                                            '
                                            , [$var->code_one,$var->code_two]);
                    
                                }
                                
                                $total_debe = $total_debe[0]->debe;
                                $total_haber = $total_haber[0]->haber;
                                $var->debe = $total_debe;
                                $var->haber = $total_haber;

                                

                                $total_balance = $total_balance[0]->balance;
                                $var->balance = $total_balance;
                        }
                    }else{
                        if($coin == 'bolivares'){
                            $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe) AS debe
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            d.status = ?
                                            '
                                            , [$var->code_one,'C']);
                            $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber) AS haber
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            d.status = ?
                                            '
                                            , [$var->code_one,'C']);

                            $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ?
                                            '
                                            , [$var->code_one]);
                            
                            }else{
                                $total_debe =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.debe/d.tasa) AS debe
                                FROM accounts a
                                INNER JOIN detail_vouchers d 
                                    ON d.id_account = a.id
                                WHERE a.code_one = ? AND
                                d.status = ?
                                '
                                , [$var->code_one,'C']);
                                
                                $total_haber =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(d.haber/d.tasa) AS haber
                                FROM accounts a
                                INNER JOIN detail_vouchers d 
                                    ON d.id_account = a.id
                                WHERE a.code_one = ? AND
                                d.status = ?
                                '
                                , [$var->code_one,'C']);

                                $total_balance =   DB::connection(Auth::user()->database_name)->select('SELECT SUM(a.balance_previus/a.rate) AS balance
                                            FROM accounts a
                                            WHERE a.code_one = ?
                                            '
                                            , [$var->code_one]);
                
                            }
                            $total_debe = $total_debe[0]->debe;
                            $total_haber = $total_haber[0]->haber;
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;

                            $total_balance = $total_balance[0]->balance;

                            $var->balance = $total_balance;

                    }
                }else{
                    return redirect('/accounts/menu')->withDanger('El codigo uno es igual a cero!');
                }
            } 
        
        }else{
            return redirect('/accounts/menu')->withDanger('No hay Cuentas');
        }              
                 
       
        
         return $accounts;
    }
}
