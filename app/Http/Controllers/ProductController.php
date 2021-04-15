<?php

namespace App\Http\Controllers;

use App\Product;
use App\Segment;
use App\Subsegment;
use App\UnitOfMeasure;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $products = Product::orderBy('id' ,'DESC')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.products.index',compact('products'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {


        $segments     = Segment::orderBY('description','asc')->pluck('description','id')->toArray();
      
        $subsegments  = Subsegment::all();
     
        $unitofmeasures   = UnitOfMeasure::all();

        return view('admin.products.create',compact('segments','subsegments','unitofmeasures'));
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
        
       
        'segment'         =>'required',
        'Subsegment'         =>'required',
        'unit_of_measure_id'         =>'required',


        'type'         =>'required',
        'description'         =>'required',
      
        'price'         =>'required',
        'price_buy'         =>'required',
        'cost_average'         =>'required',

        'money'         =>'required',
       
        'special_impuesto'         =>'required',
        'status'         =>'required',
       
    ]);

    $var = new Product();

    $var->segment_id = request('segment');
    $var->subsegment_id= request('Subsegment');
    $var->unit_of_measure_id = request('unit_of_measure_id');
    $var->code_comercial = request('code_comercial');
    $var->type = request('type');
    $var->description = request('description');
    $var->price = request('price');
    $var->price_buy = request('price_buy');
    $var->cost_average = request('cost_average');
    $var->money = request('money');
    $var->photo_product = request('photo_product');

    $exento = request('exento');
    if($exento == null){
        $var->exento = false;
    }else{
        $var->exento = true;
    }
    
    $islr = request('islr');
    if($islr == null){
        $var->islr = false;
    }else{
        $var->islr = true;
    }

    $var->special_impuesto = request('special_impuesto');
    $var->status =  request('status');
  
    $var->save();

    return redirect('/products')->withSuccess('Registro Exitoso!');
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
        $product = Product::find($id);
       
        $segments    = Segment::all();
        $subsegments  = Subsegment::all();
     
        $unitofmeasures   = UnitOfMeasure::all();
       
        return view('admin.products.edit',compact('product','segments','subsegments','unitofmeasures'));
  
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

    $vars =  Product::find($id);

    $vars_status = $vars->status;
    $vars_exento = $vars->exento;
    $vars_islr = $vars->islr;
  
    $data = request()->validate([
        
       
        'segment_id'         =>'required',
        'sub_segment_id'         =>'required',
        'unit_of_measure_id'         =>'required',


        'type'         =>'required',
        'description'         =>'required',
      
        'price'         =>'required',
        'price_buy'         =>'required',
        'cost_average'         =>'required',

        'money'         =>'required',
      
        'special_impuesto'         =>'required',
        'status'         =>'required',
       
    ]);

    $var = Product::findOrFail($id);

    $var->segment_id = request('segment_id');
    $var->subsegment_id= request('sub_segment_id');
    $var->unit_of_measure_id = request('unit_of_measure_id');

    $var->code_comercial = request('code_comercial');
    $var->type = request('type');
    $var->description = request('description');
    
    $var->price = request('price');
    $var->price_buy = request('price_buy');
   
    $var->cost_average = request('cost_average');
    $var->photo_product = request('photo_product');

    $var->money = request('money');


    $var->special_impuesto = request('special_impuesto');

    if(request('exento') == null){
        $var->exento = "0";
    }else{
        $var->exento = "1";
    }
    if(request('islr') == null){
        $var->islr = "0";
    }else{
        $var->islr = "1";
    }
   

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/products')->withSuccess('Actualizacion Exitosa!');
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
