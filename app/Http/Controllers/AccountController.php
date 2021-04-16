<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $accounts = Account::orderBy('id' ,'DESC')->get();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.accounts.index',compact('accounts'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {

        return view('admin.accounts.create');
   }

   public function createlevel($id)
   {
        $var = Account::find($id);
        $code = $var->code;


        for($i=0;$i<strlen($code);$i++)
        {
           
        }
       
        return view('admin.accounts.createlevel',compact('var'));
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
        
       
        'period'            =>'required',
        'code'              =>'required',
        'description'       =>'required',
        'type'              =>'required',
        'level'             =>'required',
        'balance_previus'   =>'required',
        'debe'              =>'required',
        'haber'             =>'required',
        
       
    ]);

    $var = new Account();

    $var->period = request('period');
    $var->code = request('code');
    $var->description = request('description');
    $var->type = request('type');
    $var->level = request('level');
    $var->balance_previus = request('balance_previus');
    $var->debe = request('debe');
    $var->haber = request('haber');

    $var->status =  "1";
  
    $var->save();

    return redirect('/accounts')->withSuccess('Registro Exitoso!');
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
        $var = Account::find($id);
       
        return view('admin.accounts.edit',compact('var'));
  
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

    $vars =  Account::find($id);

    $vars_status = $vars->status;
  
    $data = request()->validate([
        
       
        'period'            =>'required',
        'code'              =>'required',
        'description'       =>'required',
        'type'              =>'required',
        'level'             =>'required',
        'balance_previus'   =>'required',
        'debe'              =>'required',
        'haber'             =>'required',
        
       
    ]);
    $var = Account::findOrFail($id);

    $var->period = request('period');
    $var->code = request('code');
    $var->type = request('type');
    $var->description = request('description');
    $var->level = request('level');
    $var->balance_previus = request('balance_previus');
    $var->debe = request('debe');
    $var->haber = request('haber');

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/accounts')->withSuccess('Actualizacion Exitosa!');
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