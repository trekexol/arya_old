<?php

namespace App\Http\Controllers;

use App\BankMovement;
use Illuminate\Http\Request;


use App\Account;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BankMovementController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        
        $accounts = $this->calculation();

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.bankmovements.index',compact('accounts'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function createdeposit($code_one,$code_two,$code_three,$code_four)
   {
    
        $account = DB::table('accounts')->where('code_one', $code_one)
                                ->where('code_two', $code_two)
                                ->where('code_three', $code_three)
                                ->where('code_four', $code_four)
                                ->first();

        if(isset($account)){   

            
            $contrapartidas     = Account::where('code_one', '<>',0)
                                            ->where('code_two', '<>',0)
                                            ->where('code_three', '<>',0)
                                            ->where('code_four', '=',0)
                                        ->orderBY('description','asc')->pluck('description','id')->toArray();
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            return view('admin.bankmovements.createdeposit',compact('account','datenow','contrapartidas'));

        }else{
            return redirect('/bankmovements')->withDanger('No existe la Cuenta!');
       }
   }

   public function createretirement($code_one,$code_two,$code_three,$code_four)
   {
    
        $account = DB::table('accounts')->where('code_one', $code_one)
                                ->where('code_two', $code_two)
                                ->where('code_three', $code_three)
                                ->where('code_four', $code_four)
                                ->first();

        if(isset($account)){   

            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');  

            return view('admin.bankmovements.createdeposit',compact('account','datenow'));

        }else{
            return redirect('/bankmovements')->withDanger('No existe la Cuenta!');
       }
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
        
       
        'account_code_one'         =>'required',
        'account_code_two'         =>'required',
        'account_code_three'         =>'required',
        'account_code_four'         =>'required',
        'account_period'         =>'required',

        'counterpart_code_one'         =>'required',
        'counterpart_code_two'         =>'required',
        'counterpart_code_three'         =>'required',
        'counterpart_code_four'         =>'required',
        'counterpart_period'         =>'required',

        'id_header'         =>'required',
        'id_client'         =>'required',
        'id_vendor'         =>'required',
        'user_id'         =>'required',

        'description'         =>'required',
        'type_movement'         =>'required',
        'date'         =>'required',

        'reference'         =>'required',
       
       
    ]);

    $var = new BankMovement();

    $var->account_code_one = request('account_code_one');
    $var->account_code_two = request('account_code_two');
    $var->account_code_three = request('account_code_three');
    $var->account_code_four = request('account_code_four');
    $var->account_period = request('account_period');

    $var->counterpart_code_one = request('counterpart_code_one');
    $var->counterpart_code_two = request('counterpart_code_two');
    $var->counterpart_code_three = request('counterpart_code_three');
    $var->counterpart_code_four = request('counterpart_code_four');
    $var->counterpart_period = request('counterpart_period');

    $var->id_header = request('id_header');
    $var->id_client = request('id_client');
    $var->id_vendor = request('id_vendor');
    $var->user_id = request('user_id');

    $var->description = request('description');
    $var->type_movement = request('type_movement');
   
    $var->date = request('date');
    $var->reference = request('reference');

    $var->status =  1;
  
    $var->save();

    return redirect('/bankmovements')->withSuccess('Registro Exitoso!');
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
   public function calculation()
   {
       
     /*  $details = DetailVoucher::orderBy('code_one', 'asc')
                        ->orderBy('code_two', 'asc')
                        ->orderBy('code_three', 'asc')
                        ->orderBy('code_four', 'asc')
                        ->get();*/

      $accounts = DB::table('accounts')->where('code_one', 1)
                         ->where('code_two', 1)
                         ->where('code_four','<>',0)
                         ->where('code_three', 1)
                         ->orWhere('code_three', 2)
                         ->get();

        foreach ($accounts as $var) {

                   
            if($var->code_one != 0){
                
                if($var->code_two != 0){


                    if($var->code_three != 0){


                        if($var->code_four != 0){
                           $total_debe = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                                   ->where('code_two', $var->code_two)
                                                                   ->where('code_three', $var->code_three)
                                                                   ->where('code_four', $var->code_four)
                                                                   ->where('status', 'C')
                                                                   ->sum('debe');

                           $total_haber = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                                       ->where('code_two', $var->code_two)
                                                                       ->where('code_three', $var->code_three)
                                                                       ->where('code_four', $var->code_four)
                                                                       ->where('status', 'C')
                                                                       ->sum('haber');      
                                                                       
                           $var->debe = $total_debe;

                           $var->haber = $total_haber;

                           /* $account = DB::table('accounts')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('code_three', $var->code_three)
                                                        ->where('code_four', $var->code_four)
                                                        
                                                        ->update(['debe' => $total_debe,'haber' => $total_haber]);*/
                         
                                                       

                        }else{
                           
                          
                       $total_debe = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('code_three', $var->code_three)
                                                        ->where('status', 'C')
                                                        ->sum('debe');

                       $total_haber = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('code_three', $var->code_three)
                                                        ->where('status', 'C')
                                                        ->sum('haber');     

                       $var->debe = $total_debe;
                       $var->haber = $total_haber;       
                                       
                   /* $account = DB::table('accounts')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('code_three', $var->code_three)
                                                        ->where('code_four', $var->code_four)
                                                        
                                                        ->update(['debe' => $total_debe,'haber' => $total_haber]); */
                        
                }
                    }else{
                        
                    $total_debe = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('status', 'C')
                                                        ->sum('debe');

                    $total_haber = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('status', 'C')
                                                        ->sum('haber'); 
                                                        
                       $var->debe = $total_debe;

                       $var->haber = $total_haber;
                   /* $account = DB::table('accounts')->where('code_one', $var->code_one)
                                                        ->where('code_two', $var->code_two)
                                                        ->where('code_three', $var->code_three)
                                                        ->where('code_four', $var->code_four)
                                                        
                                                        ->update(['debe' => $total_debe,'haber' => $total_haber]); */
                    
                    }
                }else{
                    //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                  
                       $total_debe = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                                   ->where('status', 'C')
                                                             ->sum('debe');

                       $total_haber = DB::table('detail_vouchers')->where('code_one', $var->code_one)
                                                                   ->where('status', 'C')
                                                                ->sum('haber');   
                                                                
                       $var->debe = $total_debe;

                       $var->haber = $total_haber;           
                   /* $account = DB::table('accounts')->where('code_one', $var->code_one)
                                                  ->where('code_two', $var->code_two)
                                                  ->where('code_three', $var->code_three)
                                                  ->where('code_four', $var->code_four)
                                                  
                                                  ->update(['debe' => $total_debe,'haber' => $total_haber]); */

                }
            }else{
                return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
            }
        } 
       
        return $accounts;
    }
   
   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
        $bankmovement = BankMovement::find($id);
       
     
        return view('admin.bankmovements.edit',compact('bankmovement','modelos','colors'));
  
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

    $vars =  BankMovement::find($id);

    $vars_status = $vars->status;
   
    $data = request()->validate([
        
       
        'account_code_one'         =>'required',
        'account_code_two'         =>'required',
        'account_code_three'         =>'required',
        'account_code_four'         =>'required',
        'account_period'         =>'required',

        'counterpart_code_one'         =>'required',
        'counterpart_code_two'         =>'required',
        'counterpart_code_three'         =>'required',
        'counterpart_code_four'         =>'required',
        'counterpart_period'         =>'required',

        'id_header'         =>'required',
        'id_client'         =>'required',
        'id_vendor'         =>'required',
        'user_id'         =>'required',

        'description'         =>'required',
        'type_movement'         =>'required',
        'date'         =>'required',

        'reference'         =>'required',
       
       
    ]);

    $var = BankMovement::findOrFail($id);

    $var->account_code_one = request('account_code_one');
    $var->account_code_two = request('account_code_two');
    $var->account_code_three = request('account_code_three');
    $var->account_code_four = request('account_code_four');
    $var->account_period = request('account_period');

    $var->counterpart_code_one = request('counterpart_code_one');
    $var->counterpart_code_two = request('counterpart_code_two');
    $var->counterpart_code_three = request('counterpart_code_three');
    $var->counterpart_code_four = request('counterpart_code_four');
    $var->counterpart_period = request('counterpart_period');

    $var->id_header = request('id_header');
    $var->id_client = request('id_client');
    $var->id_vendor = request('id_vendor');
    $var->user_id = request('user_id');

    $var->description = request('description');
    $var->type_movement = request('type_movement');
   
    $var->date = request('date');
    $var->reference = request('reference');


   
    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/bankmovements')->withSuccess('Actualizacion Exitosa!');
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

   public function list(Request $request, $id_var = null){
    //validar si la peticion es asincrona
    if($request->ajax()){
        try{
            $account = Account::find($id_var);
            $subcontrapartidas = Account::select('id','description')->where('code_one',$account->code_one)
                                                                    ->where('code_two',$account->code_two)
                                                                    ->where('code_three',$account->code_three)
                                                                    ->where('code_four','<>',0)
                                                                    ->orderBy('description','asc')->get();
            return response()->json($subcontrapartidas,200);
        }catch(Throwable $th){
            return response()->json(false,500);
        }
    }
    
}


}
