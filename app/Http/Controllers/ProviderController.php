<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user= auth()->user();

       $providers = Provider::orderBy('id' ,'DESC')->get();
      
       return view('admin.providers.index',compact('providers'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {

      
       return view('admin.providers.create');
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
        'code_provider'         =>'required|max:20',
        'razon_social'         =>'required|max:80',
        'direction'         =>'required|max:100',

        'city'         =>'required|max:20',
        'country'         =>'required|max:20',
        'phone1'         =>'required|max:20',
        'phone2'         =>'required|max:20',

        
        'days_credit'         =>'required|integer',
        'amount_max_credit'    =>'required',
        'porc_retencion_iva'    =>'required',
        
        'balance'         =>'required',
        
       
       
    ]);

    $users = new Provider();

    
    $users->code_provider = request('code_provider');
    $users->razon_social = request('razon_social');
    $users->direction = request('direction');
    $users->city = request('city');
    $users->country = request('country');
    $users->phone1 = request('phone1');
    $users->phone2 = request('phone2');

    $has_credit = request('has_credit');
    if($has_credit == null){
        $users->has_credit = false;
    }else{
        $users->has_credit = true;
    }
    
    $retiene_islr = request('retiene_islr');
    if($retiene_islr == null){
        $users->retiene_islr = false;
    }else{
        $users->retiene_islr = true;
    }

    $users->days_credit = request('days_credit');

    $sin_formato_amount_max_credit = str_replace(',', '.', str_replace('.', '', request('amount_max_credit')));
    $sin_formato_balance = str_replace(',', '.', str_replace('.', '', request('balance')));
   
    
    $users->amount_max_credit = $sin_formato_amount_max_credit;
    $users->porc_retencion_iva = request('porc_retencion_iva');
    
    $users->balance = $sin_formato_balance;
    $users->select_balance = 0;
    $users->status =  1;
   
    $users->save();

    return redirect('/providers')->withSuccess('Registro Exitoso!');
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
        $var = Provider::find($id);
        
     
      

        return view('admin.providers.edit',compact('var'));
  
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

   
    $data = request()->validate([
        'code_provider'         =>'required|max:20',
        'razon_social'         =>'required|max:80',
        'direction'         =>'required|max:100',

        'city'         =>'required|max:20',
        'country'         =>'required|max:20',
        'phone1'         =>'required|max:20',
        'phone2'         =>'required|max:20',

        
        'days_credit'         =>'required|integer',
        'amount_max_credit'    =>'required|numeric',
        'porc_retencion_iva'    =>'required|numeric',
        
        'balance'         =>'required|numeric',
        
       
       
    ]);

    $users = Provider::findOrFail($id);

    
   
    $users->code_provider = request('code_provider');
    $users->razon_social = request('razon_social');
    $users->direction = request('direction');
    $users->city = request('city');
    $users->country = request('country');
    $users->phone1 = request('phone1');
    $users->phone2 = request('phone2');

    $has_credit = request('has_credit');
    if($has_credit == null){
        $users->has_credit = false;
    }else{
        $users->has_credit = true;
    }
    
    $retiene_islr = request('retiene_islr');
    if($retiene_islr == null){
        $users->retiene_islr = false;
    }else{
        $users->retiene_islr = true;
    }
    
    $users->days_credit = request('days_credit');
    $users->amount_max_credit = request('amount_max_credit');
    $users->porc_retencion_iva = request('porc_retencion_iva');
    
    $users->balance = request('balance');
    $users->select_balance = 0;
    $users->status =  request('status');
   

  
      

    $users->save();

    return redirect('/providers')->withSuccess('Actualizacion Exitosa!');
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
