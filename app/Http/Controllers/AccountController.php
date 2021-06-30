<?php

namespace App\Http\Controllers;

use App\Account;
use App\BankMovement;
use App\DetailVoucher;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class AccountController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index($coin = null,$level = null)
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        
        
        if($coin == null){
            $coin = 'bolivares';
        }
            $accounts = $this->calculation($coin);


        if(($coin == null) || ($coin == 'bolivares')){
            $bcv = $this->search_bcv();
        }else{
            $bcv = null;
        }
            

        
        }else if($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.accounts.index',compact('accounts','coin','level','bcv'));
   }


   public function movements($id_account)
    {
        

        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
             
            $detailvouchers = DetailVoucher::where('id_account',$id_account)->orderBy('id','desc')->get();
            $account = Account::find($id_account);

         }else if($users_role == '2'){
            return view('admin.index');
        }
        
        return view('admin.accounts.index_account_movement',compact('detailvouchers','account'));
    }

    public function header_movements($id_account,$type)
    {
        

        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
             
            if($type == 'bank'){

                $detailvouchers = BankMovement::where('id_account',$id_account)->orderBy('id','desc')->get();
            
            }
            $detailvouchers = DetailVoucher::where('id_account',$id_account)->orderBy('id','desc')->get();
            $account = Account::find($id_account);

         }else if($users_role == '2'){
            return view('admin.index');
        }
        
        return view('admin.accounts.index_account_movement',compact('detailvouchers','account'));
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
                return redirect('/accounts/menu')->withDanger('El codigo uno es igual a cero!');
            }
        

        $date = Carbon::now();
        $datenow = $date->format('Y');

        
       
        return view('admin.accounts.createlevel',compact('var','datenow'));

    }else{
        return redirect('/accounts/menu')->withDanger('No existe la Cuenta!');
   }
    }

  /*  public function calculation($coin)
    {
        
        $accounts = Account::orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
                         ->get();

                       
                         if(isset($accounts)) {
                            foreach ($accounts as $var) {
                 
                                    
                                if($var->code_one != 0){
                                    
                                    if($var->code_two != 0){
                    
                    
                                        if($var->code_three != 0){
                    
                    
                                            if($var->code_four != 0){
                                              
                                             /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                         /* $total_debe = DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('accounts.code_four', $var->code_four)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('debe');
                                            if($coin == 'bolivares'){
                                            $total_debe =   DB::select('SELECT SUM(d.debe) AS debe
                                                            FROM accounts a
                                                            INNER JOIN detail_vouchers d 
                                                                ON d.id_account = a.id
                                                            WHERE a.code_one = ? AND
                                                            a.code_two = ? AND
                                                            a.code_three = ? AND
                                                            a.code_four = ? AND
                                                            d.status = ?
                                                            LIMIT 1'
                                                            , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                            }else{
                                                $total_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS debe
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                a.code_three = ? AND
                                                a.code_four = ? AND
                                                d.status = ?
                                                LIMIT 1'
                                                , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                 
                                            }
                                            $total_debe = $total_debe[0]->debe;
                                             
                                            $total_haber = DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('accounts.code_four', $var->code_four)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('haber');   
                                             /*--------------------------------------------------
                 
                                             /*CALCULA LOS MONTOS REALIZADOS POR MOVIMIENTOS BANCARIOS                                
                                             $total_amount_bank = DB::table('accounts')
                                                                 ->join('bank_movements', 'bank_movements.id_account', '=', 'accounts.id')
                                                                 ->where('accounts.code_one', $var->code_one)
                                                                 ->where('accounts.code_two', $var->code_two)
                                                                 ->where('accounts.code_three', $var->code_three)
                                                                 ->where('accounts.code_four', $var->code_four)
                                                                 ->sum('amount');
                 
                                             $total_amount_bank_counterpart = DB::table('accounts')
                                                                 ->join('bank_movements', 'bank_movements.id_counterpart', '=', 'accounts.id')
                                                                 ->where('accounts.code_one', $var->code_one)
                                                                 ->where('accounts.code_two', $var->code_two)
                                                                 ->where('accounts.code_three', $var->code_three)
                                                                 ->where('accounts.code_four', $var->code_four)
                                                                 ->sum('amount');
                                            /*---------------------------------------------------
                 
                                                 $var->debe = $total_debe;
                                                 $var->haber = $total_haber;
                   
                                             
                                                                           
                    
                                            }else{
                                               
                                              
                                          
                                         /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE 
                                            $total_debe = DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('debe');
                                           
                                            $total_haber =  DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('haber');      
                                         /*---------------------------------------------------                             
                   
                                          
                 
                                        $var->debe = $total_debe;
                                        $var->haber = $total_haber;       
                                                           
                                      
                                            
                                    }
                                        }else{
                                            
                                       
                                         /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE                                 
                                            $total_debe = DB::table('accounts')
                                                                            ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                            ->where('accounts.code_one', $var->code_one)
                                                                            ->where('accounts.code_two', $var->code_two)
                                                                            ->where('detail_vouchers.status', 'C')
                                                                            ->sum('debe');
                    
                                          
                                            $total_haber = DB::table('accounts')
                                                                            ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                            ->where('accounts.code_one', $var->code_one)
                                                                            ->where('accounts.code_two', $var->code_two)
                                                                            ->where('detail_vouchers.status', 'C')
                                                                            ->sum('haber');
                                         /*---------------------------------------------------
                                        
                                        $var->debe = $total_debe;
                                        $var->haber = $total_haber;
                                     
                                        
                                        }
                                    }else{
                                        //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                                      /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE 
                                             $total_debe = DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('debe');
                    
                                         
                                           
                                            $total_haber = DB::table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        ->sum('haber');
                                     /*---------------------------------------------------
                 
                                        
                                        $var->debe = $total_debe;
                                        $var->haber = $total_haber;           
                                       
                    
                                    }
                                }else{
                                    return redirect('/accounts/menu')->withDanger('El codigo uno es igual a cero!');
                                }
                            } 
                        }  else{
                            return redirect('/accounts/menu')->withDanger('No hay Cuentas');
                        }              
                 
       
        
         return $accounts;
    }
    */
 
    public function calculation($coin)
    {
        
        $accounts = Account::orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
                         ->get();

                       
        if(isset($accounts)) {
            foreach ($accounts as $var) 
            {
                if($var->code_one != 0)
                {
                    if($var->code_two != 0)
                    {
                        if($var->code_three != 0)
                        {
                            if($var->code_four != 0)
                            {
                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                
                                    if($coin == 'bolivares'){
                                    $total_debe =   DB::select('SELECT SUM(d.debe) AS debe
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    LIMIT 1'
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                    $total_haber =   DB::select('SELECT SUM(d.haber) AS haber
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    LIMIT 1'
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                    $total_dolar_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS dolar
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    LIMIT 1'
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);

                                    $total_dolar_haber =   DB::select('SELECT SUM(d.haber/d.tasa) AS dolar
                                                    FROM accounts a
                                                    INNER JOIN detail_vouchers d 
                                                        ON d.id_account = a.id
                                                    WHERE a.code_one = ? AND
                                                    a.code_two = ? AND
                                                    a.code_three = ? AND
                                                    a.code_four = ? AND
                                                    d.status = ?
                                                    LIMIT 1'
                                                    , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                
                                    }else{
                                        $total_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS debe
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        a.code_four = ? AND
                                        d.status = ?
                                        LIMIT 1'
                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                                        
                                        $total_haber =   DB::select('SELECT SUM(d.haber/d.tasa) AS haber
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        a.code_four = ? AND
                                        d.status = ?
                                        LIMIT 1'
                                        , [$var->code_one,$var->code_two,$var->code_three,$var->code_four,'C']);
                    
                                    }
                                    $total_debe = $total_debe[0]->debe;
                                    $total_haber = $total_haber[0]->haber;
                                    if(isset($total_dolar_debe[0]->dolar)){
                                        $total_dolar_debe = $total_dolar_debe[0]->dolar;
                                        $var->dolar_debe = $total_dolar_debe;
                                    }
                                    if(isset($total_dolar_haber[0]->dolar)){
                                        $total_dolar_haber = $total_dolar_haber[0]->dolar;
                                        $var->dolar_haber = $total_dolar_haber;
                                    }
                                
                                    $var->debe = $total_debe;
                                    $var->haber = $total_haber;
                                    
                            }else{          
                            
                                if($coin == 'bolivares'){
                                $total_debe =   DB::select('SELECT SUM(d.debe) AS debe
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                a.code_three = ? AND
                                                
                                                d.status = ?
                                                LIMIT 1'
                                                , [$var->code_one,$var->code_two,$var->code_three,'C']);
                                $total_haber =   DB::select('SELECT SUM(d.haber) AS haber
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                a.code_three = ? AND
                                                
                                                d.status = ?
                                                LIMIT 1'
                                                , [$var->code_one,$var->code_two,$var->code_three,'C']);
                                
                                }else{
                                        $total_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS debe
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        
                                        d.status = ?
                                        LIMIT 1'
                                        , [$var->code_one,$var->code_two,$var->code_three,'C']);
                                        
                                        $total_haber =   DB::select('SELECT SUM(d.haber/d.tasa) AS haber
                                        FROM accounts a
                                        INNER JOIN detail_vouchers d 
                                            ON d.id_account = a.id
                                        WHERE a.code_one = ? AND
                                        a.code_two = ? AND
                                        a.code_three = ? AND
                                        
                                        d.status = ?
                                        LIMIT 1'
                                        , [$var->code_one,$var->code_two,$var->code_three,'C']);
                        
                                    }
                                    $total_debe = $total_debe[0]->debe;
                                    $total_haber = $total_haber[0]->haber;
                                
                                    $var->debe = $total_debe;
                                    $var->haber = $total_haber;
                                      
                                            
                            }           
                        }else{
                                            
                            if($coin == 'bolivares'){
                                $total_debe =   DB::select('SELECT SUM(d.debe) AS debe
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                d.status = ?
                                                LIMIT 1'
                                                , [$var->code_one,$var->code_two,'C']);
                                $total_haber =   DB::select('SELECT SUM(d.haber) AS haber
                                                FROM accounts a
                                                INNER JOIN detail_vouchers d 
                                                    ON d.id_account = a.id
                                                WHERE a.code_one = ? AND
                                                a.code_two = ? AND
                                                d.status = ?
                                                LIMIT 1'
                                                , [$var->code_one,$var->code_two,'C']);
                                
                                }else{
                                    $total_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS debe
                                    FROM accounts a
                                    INNER JOIN detail_vouchers d 
                                        ON d.id_account = a.id
                                    WHERE a.code_one = ? AND
                                    a.code_two = ? AND
                                    d.status = ?
                                    LIMIT 1'
                                    , [$var->code_one,$var->code_two,'C']);
                                    
                                    $total_haber =   DB::select('SELECT SUM(d.haber/d.tasa) AS haber
                                    FROM accounts a
                                    INNER JOIN detail_vouchers d 
                                        ON d.id_account = a.id
                                    WHERE a.code_one = ? AND
                                    a.code_two = ? AND
                                    d.status = ?
                                    LIMIT 1'
                                    , [$var->code_one,$var->code_two,'C']);
                    
                                }
                                $total_debe = $total_debe[0]->debe;
                                $total_haber = $total_haber[0]->haber;
                                $var->debe = $total_debe;
                                $var->haber = $total_haber;
                        
                        }
                    }else{
                        if($coin == 'bolivares'){
                            $total_debe =   DB::select('SELECT SUM(d.debe) AS debe
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            d.status = ?
                                            LIMIT 1'
                                            , [$var->code_one,'C']);
                            $total_haber =   DB::select('SELECT SUM(d.haber) AS haber
                                            FROM accounts a
                                            INNER JOIN detail_vouchers d 
                                                ON d.id_account = a.id
                                            WHERE a.code_one = ? AND
                                            d.status = ?
                                            LIMIT 1'
                                            , [$var->code_one,'C']);
                            
                            }else{
                                $total_debe =   DB::select('SELECT SUM(d.debe/d.tasa) AS debe
                                FROM accounts a
                                INNER JOIN detail_vouchers d 
                                    ON d.id_account = a.id
                                WHERE a.code_one = ? AND
                                d.status = ?
                                LIMIT 1'
                                , [$var->code_one,'C']);
                                
                                $total_haber =   DB::select('SELECT SUM(d.haber/d.tasa) AS haber
                                FROM accounts a
                                INNER JOIN detail_vouchers d 
                                    ON d.id_account = a.id
                                WHERE a.code_one = ? AND
                                d.status = ?
                                LIMIT 1'
                                , [$var->code_one,'C']);
                
                            }
                            $total_debe = $total_debe[0]->debe;
                            $total_haber = $total_haber[0]->haber;
                            $var->debe = $total_debe;
                            $var->haber = $total_haber;
                    

                    }
                }else{
                    return redirect('/accounts/menu')->withDanger('El codigo uno es igual a cero!');
                }
            } 
        }else{
            return redirect('/accounts/menu')->withDanger('No hay Cuentas');
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
            
           
           

            $var->status =  "1";
        
            $var->save();

            return redirect('/accounts/menu')->withSuccess('Registro Exitoso!');

        }else{
            return redirect('/accounts/menu')->withDanger('La Cuenta ya existe!');
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

            $valor_sin_formato = str_replace(',', '.', str_replace('.', '', request('balance_previus')));

            $var->balance_previus =$valor_sin_formato;

           

            $var->status =  "1";
        
            $var->save();
            

            return redirect('/accounts/menu')->withSuccess('Registro Exitoso!');

        }else{
            return redirect('/accounts/menu')->withDanger('La Cuenta ya existe!');
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

        $rate = $this->search_bcv();
       
        return view('admin.accounts.edit',compact('var','rate'));
  
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
            'description'       =>'required',
            'balance_previus'   =>'required',
        
        ]);

        $var = Account::findOrFail($id);

        $sin_formato_balance_previus = str_replace(',', '.', str_replace('.', '', request('balance_previus')));
        $sin_formato_rate = str_replace(',', '.', str_replace('.', '', request('rate')));
            
        $var->description = request('description');
        $var->balance_previus = $sin_formato_balance_previus;

        if(request('coin') != 'BsS'){
            $var->coin = request('coin');
            
        }
        $var->rate = $sin_formato_rate;

        if(request('status') == null){
            $var->status = $vars_status;
        }else{
            $var->status = request('status');
        }
    
        $var->save();

        return redirect('/accounts/menu')->withSuccess('Actualizacion Exitosa!');
    }

    public function search_bcv()
    {
        /*Buscar el indice bcv*/
        $urlToGet ='http://www.bcv.org.ve/tasas-informativas-sistema-bancario';
        $pageDocument = @file_get_contents($urlToGet);
        preg_match_all('|<div class="col-sm-6 col-xs-6"><strong> (.*?) </strong> </div>|s', $pageDocument, $cap);

        if ($cap[0] == array()){ // VALIDAR Concidencia
            $titulo = '0,00';
        }else {
            $titulo = $cap[1][2];
        }

        $bcv_con_formato = $titulo;
        $bcv = str_replace(',', '.', str_replace('.', '',$bcv_con_formato));


        /*-------------------------- */
        return $bcv;

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