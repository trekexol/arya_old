<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Quotation;
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
        $quotations = Quotation::orderBy('id' ,'DESC')->get();
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
    $clients     = Client::all();
  
    $vendors     = Vendor::all();

    $transports     = Transport::all();

    $date = Carbon::now();
    $datenow = $date->format('Y-m-d');    

    return view('admin.quotations.createquotation',compact('clients','vendors','datenow','transports'));
}

public function createquotationclient($id_client)
   {
    $client = null;
            
    if(isset($id_client)){
        $client = client::find($id_client);
    }
    if(isset($client)){

        $vendors     = Vendor::all();

        $transports     = Transport::all();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.quotations.createquotation',compact('client','vendors','datenow','transports'));

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
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
    
            return view('admin.quotations.create',compact('quotation','datenow'));
        }else{
            return redirect('/quotations')->withDanger('La cotizacion no existe');
        } 
        


   }
   public function createproduct($id_product)
   {

        $product = null;
        
        if(isset($id_product)){
            $product = Product::find($id_product);
        }

        $clients     = Client::all();
      
        $vendors     = Vendor::all();

        $transports     = Transport::all();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.quotations.create',compact('clients','vendors','datenow','transports','product'));
   }

   public function selectproduct()
   {


        $products     = Product::all();
      
        return view('admin.quotations.selectproduct',compact('products'));
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
}