<?php

namespace App\Http\Controllers;

use App\Account;
use App\DetailVoucher;
use App\HeaderVoucher;
use App\Inventory;
use App\Product;
use App\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $inventories = Inventory::orderBy('id' ,'DESC')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.inventories.index',compact('inventories'));
   }

   public function indexmovements()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){

        $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                        ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                        ->join('quotations', 'quotations.id', '=', 'quotation_products.id_quotation')
                                                        ->where('quotations.date_billing','<>',null)
                                                        ->orwhere('quotations.date_delivery_note','<>',null)
                                                        ->select('products.*','quotation_products.discount as discount',
                                                        'quotation_products.amount as amount_quotation',
                                                        'quotation_products.id_quotation as id_quotation',
                                                        'quotations.date_billing as date_billing',
                                                        'quotations.date_delivery_note as date_delivery_note',
                                                        'quotations.id as id_quotation','quotations.coin as coin_quotation',
                                                        'inventories.amount as amount_inventory'
                                                        )
                                                        ->orderBy('quotations.id','desc')
                                                        ->get(); 

       

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.inventories.indexmovement',compact('inventories_quotations'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */


    public function selectproduct()
    {
 
         $products    = Product::orderBy('description','asc')->get();
 
         return view('admin.inventories.selectproduct',compact('products'));
    }
 
   public function create($id)
   {
        $product = Product::find($id);

        return view('admin.inventories.create',compact('product'));
   }

   public function create_increase_inventory($id_inventory)
   {

       
        $inventory = Inventory::find($id_inventory);

        $bcv = $this->search_bcv();

        /*$accounts = DB::table('accounts')->where('code_one', 3)
                                            ->where('code_two', 1)
                                            ->where('code_three', 1)
                                            ->where('code_four',1)
                                            ->where('code_five', '<>',0)
                                            ->get();*/

        return view('admin.inventories.create_increase_inventory',compact('inventory','bcv'));
   }

   public function create_decrease_inventory($id_inventory)
   {
        $inventory = Inventory::find($id_inventory);
        $bcv = $this->search_bcv();

        return view('admin.inventories.create_decrease_inventory',compact('inventory','bcv'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        
        $data = request()->validate([
            
            'product_id'    =>'required',
            'code'          =>'required',
            'amount'        =>'required',
            
        ]);
        $var = new Inventory;
        
        $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));

        $var->amount = $valor_sin_formato_amount;

        $var->product_id = request('product_id');

        $var->id_user = request('id_user');

        $var->code = request('code');

        $var->status = "1";
        
        $var->save();
        
        return redirect('/inventories')->withSuccess('El inventario del producto: '.$var->products['description'].' fue registrado Exitosamente!');
    

    
    }



    public function store_increase_inventory(Request $request)
    {
        
        $data = request()->validate([
            
            'id_inventory'    =>'required',
            'code'          =>'required',
            'amount'        =>'required',
            'rate'        =>'required',
            'amount_new'        =>'required',
            'price_buy'        =>'required',
            
        ]);
        
        $amount_old = request('amount_old');
        $id_user = request('id_user');

        $valor_sin_formato_amount_new = str_replace(',', '.', str_replace('.', '', request('amount_new')));
        $valor_sin_formato_rate = str_replace(',', '.', str_replace('.', '', request('rate')));
        $valor_sin_formato_price_buy = str_replace(',', '.', str_replace('.', '', request('price_buy')));


        $id_inventory = request('id_inventory');

        if($valor_sin_formato_amount_new > 0){

            

            $var = Inventory::findOrFail($id_inventory);
        
            $var->code = request('code');
            
            
            $var->amount = $amount_old + $valor_sin_formato_amount_new;
            
            $var->save();

            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');   

            $header_voucher  = new HeaderVoucher();

            $header_voucher->description = "Incremento de Inventario";
            $header_voucher->date = $datenow;
            
        
            $header_voucher->status =  "1";
        
            $header_voucher->save();

            $total = $valor_sin_formato_amount_new * $valor_sin_formato_price_buy;

           //$account = request('account');
            $account_mecancia_para_venta = Account::where('code_one',1)->where('code_two',1)->where('code_three',3)->where('code_four',1)->where('code_five',1)->first();  

            $this->add_movement($valor_sin_formato_rate,$header_voucher->id,$account_mecancia_para_venta->id,
                                $id_user,$total,0);

            $account_gastos_ajuste_inventario = Account::where('code_one',6)->where('code_two',1)->where('code_three',3)->where('code_four',2)->where('code_five',1)->first();  

            $this->add_movement($valor_sin_formato_rate,$header_voucher->id,$account_gastos_ajuste_inventario->id,
                                $id_user,0,$total);
        
            return redirect('/inventories')->withSuccess('Actualizado el inventario del producto: '.$var->products['description'].' Exitosamente!');
    
        }else{
            return redirect('/inventories/createincreaseinventory/'.$id_inventory.'')->withDanger('La cantidad nueva debe ser mayor a cero!');

        }

    
    }



    public function store_decrease_inventory(Request $request)
    {
   
        $data = request()->validate([
            
            'id_inventory'  =>'required',
            'code'          =>'required',
            'amount'        =>'required',

            'rate'          =>'required',
            'amount_new'    =>'required',
            'price_buy'     =>'required',
            
        ]);

        $amount_old = request('amount_old');
        $id_user = request('id_user');

        $valor_sin_formato_amount_new = str_replace(',', '.', str_replace('.', '', request('amount_new')));
        $valor_sin_formato_rate = str_replace(',', '.', str_replace('.', '', request('rate')));
        $valor_sin_formato_price_buy = str_replace(',', '.', str_replace('.', '', request('price_buy')));
        
        $id_inventory = request('id_inventory');

        if($valor_sin_formato_amount_new > 0){
            if($valor_sin_formato_amount_new < $amount_old){

                $var = Inventory::findOrFail($id_inventory);
            
                $var->code = request('code');
                
                $var->amount = $amount_old - $valor_sin_formato_amount_new;
                
                $var->save();

                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');   

                $header_voucher  = new HeaderVoucher();

                $header_voucher->description = "Disminucion de Inventario";
                $header_voucher->date = $datenow;
                
            
                $header_voucher->status =  "1";
            
                $header_voucher->save();

                $total = $valor_sin_formato_amount_new * $valor_sin_formato_price_buy;

            //$account = request('account');
                $account_mecancia_para_venta = Account::where('code_one',1)->where('code_two',1)->where('code_three',3)->where('code_four',1)->where('code_five',1)->first();  

                $this->add_movement($valor_sin_formato_rate,$header_voucher->id,$account_mecancia_para_venta->id,
                                    $id_user,0,$total);

                $account_gastos_ajuste_inventario = Account::where('code_one',6)->where('code_two',1)->where('code_three',3)->where('code_four',2)->where('code_five',1)->first();  

                $this->add_movement($valor_sin_formato_rate,$header_voucher->id,$account_gastos_ajuste_inventario->id,
                                    $id_user,$total,0);
            
                return redirect('/inventories')->withSuccess('Actualizado el inventario del producto: '.$var->products['description'].' Exitosamente!');
            
            }else{
                return redirect('/inventories/createdecreaseinventory/'.$id_inventory.'')->withDanger('La cantidad a disminuir no puede ser mayor a la cantidad antigua!');

            }
        }else{
            return redirect('/inventories/createdecreaseinventory/'.$id_inventory.'')->withDanger('La cantidad nueva debe ser mayor a cero!');

        }

    
    }


    public function add_movement($tasa,$id_header,$id_account,$id_user,$debe,$haber){

        $detail = new DetailVoucher();

        $detail->id_account = $id_account;
        $detail->id_header_voucher = $id_header;
        $detail->user_id = $id_user;
        $detail->tasa = $tasa;

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



   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $inventory = Inventory::find($id);
       
        $products   = Product::all();
       
        return view('admin.inventories.edit',compact('inventory','products'));
  
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {

    $vars =  Inventory::find($id);

    $vars_status = $vars->status;
   
  
    $data = request()->validate([
        
       
        'code'         =>'required',
      
        'amount'         =>'required',

        'status'         =>'required',
       
    ]);

    $var = Inventory::findOrFail($id);

    $var->code = request('code');
   
    $var->amount = request('amount');
    
    $var->status =  request('status');


   
    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/inventories')->withSuccess('Actualizacion Exitosa!');
    }


   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       //
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

}
