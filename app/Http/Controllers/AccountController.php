<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

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
        $accounts = Account::All();
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

        $date = Carbon::now();
        $datenow = $date->format('Y');

        return view('admin.accounts.create',compact('datenow'));
   }

   public function createlevel($code_one,$code_two,$code_three,$code_four)
   {
        if($code_one != 0){

            if($code_two != 0){


                if($code_three != 0){


                    if($code_four != 0){

                    }
                }
            }
        }
        $var = DB::table('accounts')->where('code_one', $code_one)
                                    ->where('code_two', $code_two)
                                    ->where('code_three', $code_three)
                                    ->where('code_four', $code_four)->first();

        $date = Carbon::now();
        $datenow = $date->format('Y');
       
        return view('admin.accounts.createlevel',compact('var','datenow'));
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
        'description'       =>'required',
        'type'              =>'required',
        'level'             =>'required',
        'balance_previus'   =>'required',
        'debe'              =>'required',
        'haber'             =>'required',
        
       
    ]);

    $var = new Account();

    $var->code_one = request('code_one');
    $var->code_two = request('code_two');
    $var->code_three = request('code_three');
    $var->code_four = request('code_four');

    $var->period = request('period');
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