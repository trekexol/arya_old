<?php

namespace App\Http\Controllers;

use App\Client;
use App\Vendor;
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
        $vendors = Vendor::orderBy('name','asc');
      
       return view('admin.clients.create',compact('vendors'));
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
            'type_code'         =>'required|max:20',
            
            'name'         =>'required|max:80',
            'cedula_rif'         =>'required|max:20',
            'direction'         =>'required|max:100',
    
            'city'         =>'required|max:20',
            'country'         =>'required|max:20',
            'phone1'         =>'required|max:20',
            'days_credit'         =>'required|integer',
            
    
           
        ]);

    $users = new client();

    $users->id_vendor = request('id_vendor');

    $users->type_code = request('type_code');
   
    $users->name = request('name');
    $users->cedula_rif = request('cedula_rif');
    $users->direction = request('direction');
    $users->city = request('city');
    $users->country = request('country');
    $users->phone1 = request('phone1');
    $users->phone2 = request('phone2');
    
    $users->days_credit = request('days_credit');
    $users->amount_max_credit = request('amount_max_credit');
    
    $users->percentage_retencion_iva = request('percentage_retencion_iva');
    $users->percentage_retencion_islr = request('percentage_retencion_islr');
   
    $users->status =  1;
   
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

    $vars =  client::find($id);
    $vars_status = $vars->status;
   
    $data = request()->validate([
        'type_code'         =>'required|max:20',
        
        'name'         =>'required|max:80',
        'cedula_rif'         =>'required|max:20',
        'direction'         =>'required|max:100',

        'city'         =>'required|max:20',
        'country'         =>'required|max:20',
        'phone1'         =>'required|max:20',
        

        
        'days_credit'         =>'required|integer',
        

       
    ]);

    $users = client::findOrFail($id);
    
    $users->id_vendor = request('id_vendor');

    $users->type_code = request('type_code');
   
    $users->name = request('name');
    $users->cedula_rif = request('cedula_rif');
    $users->direction = request('direction');
    $users->city = request('city');
    $users->country = request('country');
    $users->phone1 = request('phone1');
    $users->phone2 = request('phone2');
    
    $users->days_credit = request('days_credit');
    $users->amount_max_credit = request('amount_max_credit');
    
    $users->percentage_retencion_iva = request('percentage_retencion_iva');
    $users->percentage_retencion_islr = request('percentage_retencion_islr');

    if(request('status') == null){
        $users->status = $vars_status;
    }else{
        $users->status = request('status');
    }
   
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
