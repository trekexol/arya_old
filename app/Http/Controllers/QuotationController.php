<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Quotation;
use App\QuotationProduct;
use App\Transport;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $quotations = Quotation::orderBy('id' ,'DESC')
                                ->where('date_billing','=',null)
                                ->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.quotations.index',compact('quotations'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    
public function createquotation()
   {
   /* $clients     = Client::all();
  
    $vendors     = Vendor::all();*/

    $transports     = Transport::all();

    $date = Carbon::now();
    $datenow = $date->format('Y-m-d');    

    return view('admin.quotations.createquotation',compact('datenow','transports'));
}

public function createquotationclient($id_client)
   {
    $client = null;
            
    if(isset($id_client)){
        $client = Client::find($id_client);
    }
    if(isset($client)){

       /* $vendors     = Vendor::all();*/

        $transports     = Transport::all();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.quotations.createquotation',compact('client','datenow','transports'));

    }else{
        return redirect('/quotations')->withDanger('El Cliente no existe');
    } 
}

public function createquotationvendor($id_client,$id_vendor)
   {
    $client = null;
            
    if(isset($id_client)){
        $client = Client::find($id_client);
    }
    if(isset($client)){

        $vendor = null;
            
        if(isset($id_vendor)){
            $vendor = Vendor::find($id_vendor);
        }
        if(isset($vendor)){

            /* $vendors     = Vendor::all();*/

            $transports     = Transport::all();

            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    

            return view('admin.quotations.createquotation',compact('client','vendor','datenow','transports'));

        }else{
            return redirect('/quotations')->withDanger('El Vendedor no existe');
        } 

    }else{
        return redirect('/quotations')->withDanger('El Cliente no existe');
    } 
}



   public function create($id_quotation)
   {
        $quotation = null;
            
        if(isset($id_quotation)){
            $quotation = Quotation::find($id_quotation);
        }

        if(isset($quotation)){
            $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
           
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
    
            return view('admin.quotations.create',compact('quotation','product_quotations','datenow'));
        }else{
            return redirect('/quotations')->withDanger('La cotizacion no existe');
        } 
        


   }
   public function createproduct($id_quotation,$id_product)
   {
    $quotation = null;
            
    if(isset($id_quotation)){
        $quotation = Quotation::find($id_quotation);
    }

    if(isset($quotation)){
        $product_quotations = QuotationProduct::where('id_quotation',$quotation->id)->get();
            $product = null;
            
            if(isset($id_product)){
                $product = Product::find($id_product);
            }
            if(isset($product)){

                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');    

                return view('admin.quotations.create',compact('quotation','product_quotations','product','datenow'));

            }else{
                return redirect('/quotations')->withDanger('El Producto no existe');
            } 
    }else{
        return redirect('/quotations')->withDanger('La cotizacion no existe');
    } 

   }

   public function selectproduct($id_quotation)
   {
        $products     = Product::all();
      
        return view('admin.quotations.selectproduct',compact('products','id_quotation'));
   }


   public function createvendor($id_product,$id_vendor)
   {

        $vendor = null;
        
        if(isset($id_vendor)){
            $vendor = vendor::find($id_vendor);
        }

        $clients     = Client::all();
      
        $vendors     = Vendor::all();

        $transports     = Transport::all();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.quotations.create',compact('clients','vendors','datenow','transports','vendor'));
   }

   public function selectvendor($id_client)
   {
        if($id_client != -1){

            $vendors     = vendor::all();

            
      
            return view('admin.quotations.selectvendor',compact('vendors','id_client'));

        }else{
            return redirect('/quotations/registerquotation')->withDanger('Seleccione un Cliente primero');
        }

       
   }

   public function selectclient()
   {


        $clients     = Client::all();
      
        return view('admin.quotations.selectclient',compact('clients'));
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
        
       
        'id_client'         =>'required',
        'id_vendor'         =>'required',
        'id_transport'         =>'required',
        'id_user'         =>'required',
      
        'serie'         =>'required',
        'date_quotation'         =>'required',
       
    ]);

    $var = new Quotation();

    $var->id_client = request('id_client');
    $var->id_vendor = request('id_vendor');
    $var->id_transport = request('id_transport');
    $var->id_user = request('id_user');
    $var->serie = request('serie');
    $var->date_quotation = request('date_quotation');

    $var->observation = request('observation');
    $var->note = request('note');

    $var->status =  1;
  
    $var->save();

    return redirect('quotations/register/'.$var->id.'');
    }


    public function storeproduct(Request $request)
    {
   
    $data = request()->validate([
        
       
        'id_quotation'         =>'required',
        'id_product'         =>'required',
        'amount'         =>'required',
        'discount'         =>'required',
      
       
    ]);

    $var = new QuotationProduct();

    $var->id_quotation = request('id_quotation');
    $var->id_product = request('id_product');
    $var->amount = request('amount');

    $var->discount = request('discount');
    
    $var->status =  1;
  
    $var->save();

    return redirect('quotations/register/'.$var->id_quotation.'')->withSuccess('Producto agregado Exitosamente!');
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
        $quotation = quotation::find($id);
       
        /*$segments    = Segment::all();
        $subsegments  = Subsegment::all();
     
        $unitofmeasures   = UnitOfMeasure::all();*/
       
        return view('admin.quotations.edit',compact('quotation','segments','subsegments','unitofmeasures'));
  
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

    $vars =  Quotation::find($id);

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

    $var = Quotation::findOrFail($id);

    $var->segment_id = request('segment_id');
    $var->subsegment_id= request('sub_segment_id');
    $var->unit_of_measure_id = request('unit_of_measure_id');

    $var->code_comercial = request('code_comercial');
    $var->type = request('type');
    $var->description = request('description');
    
    $var->price = request('price');
    $var->price_buy = request('price_buy');
   
    $var->cost_average = request('cost_average');
    $var->photo_quotation = request('photo_quotation');

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

    return redirect('/quotations')->withSuccess('Actualizacion Exitosa!');
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


   public function listproduct(Request $request, $var = null){
    //validar si la peticion es asincrona
    if($request->ajax()){
        try{
            
            $respuesta = Product::select('id')->where('code_comercial',$var)->orderBy('description','asc')->get();
            return response()->json($respuesta,200);

        }catch(Throwable $th){
            return response()->json(false,500);
        }
    }
    
}




}