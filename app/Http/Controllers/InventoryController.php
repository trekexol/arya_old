<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use App\QuotationProduct;
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

       

        return view('admin.inventories.create_increase_inventory',compact('inventory'));
   }

   public function create_decrease_inventory($id_inventory)
   {

       
        $inventory = Inventory::find($id_inventory);

        $accounts_contrapart = DB::table('accounts')->where('code_one', 6)
                                            ->where('code_two', 1)
                                            ->where('code_three', 5)
                                            ->where('code_four', '<>',0)
                                            ->get();
       

        return view('admin.inventories.create_decrease_inventory',compact('inventory','accounts_contrapart'));
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
        
    ]);

    $amount_old = request('amount_old');

    $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));

    $id_inventory = request('id_inventory');

    if($amount_old <  $valor_sin_formato_amount){

        

        $var = Inventory::findOrFail($id_inventory);
    
        $var->code = request('code');
        
        $var->amount = $valor_sin_formato_amount;
        
       
      
        $var->save();
    
        return redirect('/inventories')->withSuccess('Actualizado el inventario del producto: '.$var->products['description'].' Exitosamente!');
   
    }else{
        return redirect('/inventories/createincreaseinventory/'.$id_inventory.'')->withDanger('La cantidad nueva debe ser mayor a la cantidad antigua');

    }

    
    }



    public function store_decrease_inventory(Request $request)
    {
   
    $data = request()->validate([
        
        'id_inventory'    =>'required',
        'code'          =>'required',
        'amount'        =>'required',
        
    ]);

    $amount_old = request('amount_old');

    $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));

    $id_inventory = request('id_inventory');

    if($amount_old >  $valor_sin_formato_amount){

        

        $var = Inventory::findOrFail($id_inventory);
    
        $var->code = request('code');
        
        $var->amount = $valor_sin_formato_amount;
        
       
      
        $var->save();
    
        return redirect('/inventories')->withSuccess('Actualizado el inventario del producto: '.$var->products['description'].' Exitosamente!');
    }else{
        return redirect('/inventories/createdecreaseinventory/'.$id_inventory.'')->withDanger('La cantidad nueva debe ser menor a la cantidad antigua');

    }

    
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
}
