<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user= auth()->user();

       $clients = Client::orderBy('id' ,'DESC')->get();
       //dd($user->estado_id);

       //$rol = $user->roles();
       //dd($rol);
       //$persons = Person::where('estado_id', $user->estado_id)
                           //->orderBy('id', 'DESC')
                           //->get();
       // dd($persons);
       return view('admin.clients.index',compact('clients'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {

      
       return view('admin.clients.create');
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
        'code_client'         =>'required|max:20',
        'razon_social'         =>'required|max:80',
        'name'         =>'required|max:80',
        'cedula_rif'         =>'required|max:20',
        'direction'         =>'required|max:100',

        'city'         =>'required|max:20',
        'country'         =>'required|max:20',
        'phone1'         =>'required|max:20',
        'phone2'         =>'required|max:20',

        
        'days_credit'         =>'required|integer',
        'amount_max_credit'    =>'required|numeric',
        'balance'         =>'required|numeric',

        'retencion_iva'    =>'required|numeric',
        'retencion_islr'         =>'required|numeric',
        
        
        'seller'         =>'required|max:25',
       
       
    ]);

    $users = new client();

    
    $users->code_client = request('code_client');
    $users->razon_social = request('razon_social');

    $users->name = request('name');
    $users->cedula_rif = request('cedula_rif');
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
    
    $users->days_credit = request('days_credit');
    $users->amount_max_credit = request('amount_max_credit');
    $users->balance = request('balance');

    $users->retencion_iva = request('retencion_iva');


    $users->retencion_islr = request('retencion_islr');
    $users->select_balance = 0;
    $users->seller = request('seller');
    $users->status =  request('status');
   
    $users->save();

    return redirect('/clients')->withSuccess('Registro Exitoso!');
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
        $var = client::find($id);
        
     
      

        return view('admin.clients.edit',compact('var'));
  
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

    $users =  client::find($id);
   
    $data = request()->validate([
        'code_client'         =>'required|max:20',
        'razon_social'         =>'required|max:80',
        'name'         =>'required|max:80',
        'cedula_rif'         =>'required|max:20',
        'direction'         =>'required|max:20',

        'city'         =>'required|max:20',
        'country'         =>'required|max:20',
        'phone1'         =>'required|max:20',
        'phone2'         =>'required|max:20',

        
        'days_credit'         =>'required|integer',
        'amount_max_credit'    =>'required|numeric',
        'balance'         =>'required|numeric',

        'retencion_iva'    =>'required|numeric',
        'retencion_islr'         =>'required|numeric',
        
        
        'seller'         =>'required|max:25',
       
       
    ]);

    $users = client::findOrFail($id);

    
    $users->code_client = request('code_client');
    $users->razon_social = request('razon_social');

    $users->name = request('name');
    $users->cedula_rif = request('cedula_rif');
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
    
    $users->days_credit = request('days_credit');
    $users->amount_max_credit = request('amount_max_credit');
    $users->balance = request('balance');

    $users->retencion_iva = request('retencion_iva');


    $users->retencion_islr = request('retencion_islr');
    $users->select_balance = 0;
    $users->seller = request('seller');
    $users->status =  request('status');

  
      

    $users->save();

    return redirect('/clients')->withSuccess('Actualizacion Exitosa!');
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
