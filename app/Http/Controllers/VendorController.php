<?php

namespace App\Http\Controllers;

use App\ComisionType;
use App\Employee;
use App\Estado;
use App\Municipio;
use App\Parroquia;
use App\User;
use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $vendors = Vendor::orderBy('id' ,'DESC')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.vendors.index',compact('vendors'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {


     
       $estados     = Estado::orderBY('descripcion','asc')->pluck('descripcion','id')->toArray();
       $municipios  = Municipio::all();
       $parroquias  = Parroquia::all();
     
       $comisions   = ComisionType::all();
       $employees   = Employee::all();

       

       return view('admin.vendors.create',compact('estados','municipios','parroquias','comisions','employees'));
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
        
        'Parroquia'         =>'required',
        'comision_id'         =>'required',
        'employee_id'         =>'required',
        'user_id'         =>'required',


        'code'         =>'required',
        'cedula_rif'         =>'required',
        'name'         =>'required',
        'surname'         =>'required',
        'email'         =>'required',
        'phone'         =>'required',
       
        'comision'         =>'required',
      
       
    ]);

    $var = new Vendor();

    
    $var->parroquia_id = request('Parroquia');
    $var->comision_id = request('comision_id');
    $var->employee_id= request('employee_id');
    $var->user_id = request('user_id');

    $var->code = request('code');
    $var->cedula_rif = request('cedula_rif');
    $var->name = request('name');
    $var->surname = request('surname');

    $var->email = request('email');
    $var->phone = request('phone');
    $var->phone2 = request('phone2');

    $sin_formato_comision = str_replace(',', '.', str_replace('.', '', request('comision')));

    $var->comision = $sin_formato_comision;
    $var->instagram = request('instagram');

    $var->facebook = request('facebook');


    $var->twitter = request('twitter');
    $var->especification = request('especification');
    $var->observation = request('observation');
    $var->status =  1;
  
    $var->save();

    return redirect('/vendors')->withSuccess('Registro Exitoso!');
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
        $var = vendor::find($id);
        
        $estados            = Estado::all();
        $municipios         = Municipio::all();
        $parroquias         = Parroquia::all();
      

        $comisions   = ComisionType::all();
        $employees   = Employee::all();
       
        return view('admin.vendors.edit',compact('var','estados','municipios','parroquias','comisions','employees'));
  
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
    $vars =  Vendor::find($id);

    $vars_status = $vars->status;
  
    
   
    $data = request()->validate([
        
        'Parroquia'         =>'required',
        'comision_id'         =>'required',
        'employee_id'         =>'required',
        'user_id'         =>'required',


        'code'         =>'required',
        'cedula_rif'         =>'required',
        'name'         =>'required',
        'surname'         =>'required',
        'email'         =>'required',
        'phone'         =>'required',
        'phone2'         =>'required',
        'comision'         =>'required',
        'instagram'         =>'required',
        'facebook'         =>'required',
        'twitter'         =>'required',
        'especification'         =>'required',
        'observation'         =>'required',
        'status'         =>'required',
       
    ]);

    $var = Vendor::findOrFail($id);
    
    $var->parroquia_id = request('Parroquia');
    $var->comision_id = request('comision_id');
    $var->employee_id= request('employee_id');
    $var->user_id = request('user_id');

    $var->code = request('code');
    $var->cedula_rif = request('cedula_rif');
    $var->name = request('name');
    $var->surname = request('surname');

    $var->email = request('email');
    $var->phone = request('phone');
    $var->phone2 = request('phone2');
    $var->comision = request('comision');
    $var->instagram = request('instagram');

    $var->facebook = request('facebook');


    $var->twitter = request('twitter');
    $var->especification = request('especification');
    $var->observation = request('observation');

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   

    $var->save();

    return redirect('/vendors')->withSuccess('Actualizacion Exitosa!');
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
