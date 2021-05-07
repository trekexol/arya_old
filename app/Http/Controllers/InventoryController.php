<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
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

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */


    public function selectproduct()
    {
 
         $products    = Product::all();
 
         return view('admin.inventories.selectproduct',compact('products'));
    }
 
   public function create($id)
   {

       
        $product = Product::find($id);

        return view('admin.inventories.create',compact('product'));
   }

   public function create_increase_inventory()
   {

       
        $products = Inventory::orderBY('description','desc')->get();

        //dd($products);

        return view('admin.inventories.create_increase_inventory',compact('products'));
   }

   public function create_increase_inventory_with_product($id_inventory)
   {

       
       // $products = Inventory::orderBY('description','desc')->get();

        $inventories = DB::table('inventories')
                        ->join('products', 'products.id', '=', 'inventories.product_id')
                        ->orderBy('products.description', 'desc')
                        ->select('products.*')
                        ->get();

        
        $inventory = Inventory::find($id_inventory);

      
        return view('admin.inventories.create_increase_inventory',compact('inventories','inventory'));
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
        'status'        =>'required',
       
    ]);

    $var = new Inventory();

    $var->product_id = request('product_id');

    $var->code = request('code');
   
    $var->amount = request('amount');
    
    $var->status =  request('status');
  
    $var->save();

    return redirect('/inventories')->withSuccess('Registro Exitoso!');
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
