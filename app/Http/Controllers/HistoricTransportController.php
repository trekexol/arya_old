<?php

namespace App\Http\Controllers;

use App\Employee;
use App\HistoricTransport;
use App\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoricTransportController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        //$historictransports = HistoricTransport::orderBy('id' ,'DESC')->get();
        $employees = Employee::with('transports')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.historictransports.index',compact('employees'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function selecttransport()
    {
        $transports = Transport::orderBy('id' ,'DESC')->get();

         return view('admin.historictransports.selecttransport',compact('transports'));
    }
    public function selectemployee($transport_id)
    {
        $employees = Employee::orderBy('nombres' ,'DESC')->get();

 
        return view('admin.historictransports.selectemployee',compact('employees','transport_id'));
    }
  

   public function create($transport_id,$employee_id)
   {
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.historictransports.create',compact('datenow','transport_id','employee_id'));
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
        
       
        'employee_id'         =>'required',
        'transport_id'         =>'required',
        'user_id'         =>'required',
        'date_begin'         =>'required',

    ]);

    $var = new HistoricTransport();

    $var->employee_id = request('employee_id');
    $var->transport_id = request('transport_id');
    $var->user_id = request('user_id');
    $var->date_begin = request('date_begin');
    $var->date_end = null;
   
    $var->save();

    return redirect('/historictransports')->withSuccess('Registro Exitoso!');
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
        $historictransport = HistoricTransport::find($id);
       
        $modelos     = Modelo::orderBY('description','asc')->pluck('description','id')->toArray();
      
        $colors     = Color::orderBY('description','asc')->pluck('description','id')->toArray();
      
        return view('admin.historictransports.edit',compact('historictransport','modelos','colors'));
  
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

    $vars =  HistoricTransport::find($id);

    $vars_status = $vars->status;
    $vars_exento = $vars->exento;
    $vars_islr = $vars->islr;
  
    $data = request()->validate([
        
       
        'modelo_id'         =>'required',
        'color_id'         =>'required',
        'user_id'         =>'required',

        'type'         =>'required',
        'placa'         =>'required',
        'photo_historictransport'         =>'required',

        'status'         =>'required',
       
    ]);

    $var = HistoricTransport::findOrFail($id);

    $var->modelo_id = request('modelo_id');
    $var->color_id = request('color_id');
    $var->user_id = request('user_id');
    $var->type = request('type');
   
    $var->placa = request('placa');
    $var->photo_historictransport = request('photo_historictransport');

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/historictransports')->withSuccess('Actualizacion Exitosa!');
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
