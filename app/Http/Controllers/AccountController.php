<?php

namespace App\Http\Controllers;

use App\Account;
use App\DetailVoucher;
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
       
        $accounts = $this->calculation();
      
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

   public function createlevel($code_one,$code_two,$code_three,$code_four,$period)
   {
    
    $var = DB::table('accounts')->where('code_one', $code_one)
                                ->where('code_two', $code_two)
                                ->where('code_three', $code_three)
                                ->where('code_four', $code_four)
                                ->where('period', $period)->first();
                            
    if(isset($var)){          
                     
            if($code_one != 0){
                
                if($code_two != 0){


                    if($code_three != 0){


                        if($code_four != 0){

                        }else{
                           
                            $level = DB::table('accounts')->where('code_one', $code_one)
                                                        ->where('code_two', $code_two)
                                                        ->where('code_three', $code_three)
                                                  ->max('code_four');
                            $var->code_four = $level + 1;
                            $var->level = 4;
                        
                        }
                    }else{
                        
                        $level = DB::table('accounts')->where('code_one', $code_one)
                                                        ->where('code_two', $code_two)
                                                  ->max('code_three');
                        $var->code_three = $level + 1;
                        $var->level = 3;
                    
                    }
                }else{
                    //Cuentas NIVEL 2
                   //level trae el valor de code_two mas alto
                    $level = DB::table('accounts')->where('code_one', $code_one)
                                                  ->max('code_two');
                    
                    //luego que tenemos el valor del codigo two mas alto, le sumamos uno para crear el proximo
                    $var->code_two = $level + 1;
                    $var->level = 2;
                    
                
                }
            }else{
                return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
            }
        

        $date = Carbon::now();
        $datenow = $date->format('Y');

        
       
        return view('admin.accounts.createlevel',compact('var','datenow'));

    }else{
        return redirect('/accounts')->withDanger('No existe la Cuenta!');
   }
    }

    public function calculation()
    {
        
      /*  $details = DetailVoucher::orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
                         ->get();*/

        $accounts = Account::orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
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
    
 


   public function store(Request $request)
    {

        $exist = DB::table('accounts')->where('code_one', request('code_one'))
                                ->where('code_two', request('code_two'))
                                ->where('code_three', request('code_three'))
                                ->where('code_four', request('code_four'))
                                ->where('period', request('period'))->first();

    if(!isset($exist)){

    
            $data = request()->validate([
                
                

                'period'            =>'required',
                'description'       =>'required',
                'type'              =>'required',
                'level'             =>'required',
                'balance_previus'   =>'required',
               
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
            
            if(request('debe') == null){
                $var->debe = request('debe');
            }
            else{
                $var->debe = 0; 
            }
            if(request('haber') == null){
                $var->haber = request('haber');
            }
            else{
                $var->haber = 0; 
            }
           

            $var->status =  "1";
        
            $var->save();

            return redirect('/accounts')->withSuccess('Registro Exitoso!');

        }else{
            return redirect('/accounts')->withDanger('La Cuenta ya existe!');
       }
    }


    public function storeNewLevel(Request $request)
    {

        $exist = DB::table('accounts')->where('code_one', request('code_one'))
                                ->where('code_two', request('code_two'))
                                ->where('code_three', request('code_three'))
                                ->where('code_four', request('code_four'))
                                ->where('period', request('period'))->first();

    if(!isset($exist)){

    
            $data = request()->validate([
                
                

                'period'            =>'required',
                'description'       =>'required',
                'type'              =>'required',
                'level'             =>'required',
                
               
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
            $var->balance_previus = 0; 

            $var->balance_previus = request('balance_previus');

            $var->debe = 0;
            $var->haber = 0;
          
          

            $var->status =  "1";
        
            $var->save();
            

            return redirect('/accounts')->withSuccess('Registro Exitoso!');

        }else{
            return redirect('/accounts')->withDanger('La Cuenta ya existe!');
       }
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