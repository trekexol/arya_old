<?php

namespace App\Http\Controllers;

use App\Anticipo;
use App\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnticipoController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
       
        $anticipos = Anticipo::where('status',1)->orderBy('id','desc')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.anticipos.index',compact('anticipos'));
   }

   public function indexhistoric()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
       
        $anticipos = Anticipo::where('status','C')->orderBy('id','desc')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.anticipos.index',compact('anticipos'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function selectclient()
    {
        $clients = Client::orderBy('id' ,'DESC')->get();

         return view('admin.anticipos.selectclient',compact('clients'));
    }
    
  

   public function create()
   {
        $accounts = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->where('code_three', 2)
                                            ->where('code_four', '<>',0)
                                            ->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.anticipos.create',compact('datenow','accounts'));
   }

   public function createclient($id_client)
   {

        $client =  Client::find($id_client);
        $accounts = DB::table('accounts')->where('code_one', 1)
                                            ->where('code_two', 1)
                                            ->whereIn('code_three', [1, 2])
                                            ->where('code_four', '<>',0)
                                            ->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.anticipos.create',compact('datenow','client','accounts'));
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
        
       
        'date_begin'         =>'required',
        'id_client'         =>'required',
        'id_account'         =>'required',
        'id_user'         =>'required',

        'amount'         =>'required',

    ]);

    $var = new anticipo();

    $var->date = request('date_begin');
    $var->id_client = request('id_client');
    $var->id_account = request('id_account');
    $var->id_user = request('id_user');
    
    $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));
        

    $var->amount = $valor_sin_formato_amount;
    $var->reference = request('reference');
   
    $var->status = 1;

    $var->save();

    return redirect('/anticipos')->withSuccess('Registro Exitoso!');
    }

  

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $anticipo = anticipo::find($id);
       
        $modelos     = Modelo::orderBY('description','asc')->pluck('description','id')->toArray();
      
        $colors     = Color::orderBY('description','asc')->pluck('description','id')->toArray();
      
        return view('admin.anticipos.edit',compact('anticipo','modelos','colors'));
  
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

    $vars =  anticipo::find($id);

    $vars_status = $vars->status;
    $vars_exento = $vars->exento;
    $vars_islr = $vars->islr;
  
    $data = request()->validate([
        
       
        'modelo_id'         =>'required',
        'color_id'         =>'required',
        'user_id'         =>'required',

        'type'         =>'required',
        'placa'         =>'required',
        'photo_anticipo'         =>'required',

        'status'         =>'required',
       
    ]);

    $var = anticipo::findOrFail($id);

    $var->modelo_id = request('modelo_id');
    $var->color_id = request('color_id');
    $var->user_id = request('user_id');
    $var->type = request('type');
   
    $var->placa = request('placa');
    $var->photo_anticipo = request('photo_anticipo');

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/anticipos')->withSuccess('Actualizacion Exitosa!');
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

