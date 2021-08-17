<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;


use App;
use App\Account;
use App\DetailVoucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
    public function index()
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
            $detail_old = DetailVoucher::on(Auth::user()->database_name)->orderBy('created_at','asc')->first();
            $date_begin = $detail_old;

        }elseif($users_role == '2'){
            return view('admin.index');
        }

        
    
        return view('admin.reports.index_balance_general',compact('datenow','detail_old','date_begin'));
      
    }

    public function index_ingresos()
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
            $detail_old = DetailVoucher::on(Auth::user()->database_name)->orderBy('created_at','asc')->first();

        }elseif($users_role == '2'){
            return view('admin.index');
        }

        return view('admin.reports.index_ingresos_egresos',compact('datenow','detail_old'));
      
    }

    public function store(Request $request)
    {
        
        $date_begin = request('date_begin');
        $date_end = request('date_end');
        $level = request('level');
        
        $pdf = App::make('dompdf.wrapper');
        

        return view('admin.reports.index_balance_general',compact('date_begin','date_end','level'));
    }

    function balance_pdf($date_begin = null,$date_end = null,$level = null)
    {
      
        $pdf = App::make('dompdf.wrapper');

        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 
        $period = $date->format('Y'); 
        $detail_old = DetailVoucher::on(Auth::user()->database_name)->orderBy('created_at','asc')->first();

        if(isset($date_begin)){
            $from = $date_begin;
        }else{
            $from = $detail_old->created_at->format('Y-m-d');
        }
        if(isset($date_end)){
            $to = $date_end;
        }else{
            $to = $datenow;
        }
        if(isset($level)){
            
        }else{
            $level = 5;
        }

        $accounts_all = $this->calculation($from,$to);

        $accounts = $accounts_all->filter(function($account)
        {
            if($account->code_one <= 3){
                $total = $account->balance_previus + $account->debe - $account->haber;
                if ($total != 0) {
                    return $account;
                }
            }
            
        });

        $pdf = $pdf->loadView('admin.reports.balance_general',compact('datenow','accounts','level','detail_old','date_begin','date_end'));
        return $pdf->stream();
                 
    }

    function balance_ingresos_pdf($date_begin = null,$date_end = null,$level = null){
      
        $pdf = App::make('dompdf.wrapper');

        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 
        $period = $date->format('Y'); 
        $detail_old = DetailVoucher::on(Auth::user()->database_name)->orderBy('created_at','asc')->first();

        if(isset($date_begin)){
            $from = $date_begin;
        }else{
            $from = $detail_old->created_at->format('Y-m-d');
        }
        if(isset($date_end)){
            $to = $date_end;
        }else{
            $to = $datenow;
        }
        if(isset($level)){
            
        }else{
            $level = 5;
        }

        $accounts = $this->calculation($from,$to);

        $pdf = $pdf->loadView('admin.reports.ingresos_egresos',compact('datenow','accounts','level','detail_old','date_begin','date_end'));
        return $pdf->stream();
                 
    }

    //agregar que retorne el monto en dolares
    public function calculation($date_begin,$date_end)
    {
        
        //dd($date_begin);
        $accounts = Account::on(Auth::user()->database_name)->orderBy('code_one', 'asc')
                         ->orderBy('code_two', 'asc')
                         ->orderBy('code_three', 'asc')
                         ->orderBy('code_four', 'asc')
                         ->orderBy('code_five', 'asc')
                         ->get();

                       
                         if(isset($accounts)) {
                            foreach ($accounts as $var) {
                 
                                    
                                if($var->code_one != 0){
                                    
                                    if($var->code_two != 0){
                    
                    
                                        if($var->code_three != 0){
                    
                    
                                            if($var->code_four != 0){

                                                if($var->code_five != 0){
                                                    //Calculo de superavit
                                                    if(($var->code_one == 3) && ($var->code_two == 2) && ($var->code_three == 1) && 
                                                    ($var->code_four == 1) && ($var->code_five == 1) ){
                                                        $var = $this->calculation_superavit($var,4,'bolivares',$date_begin,$date_end);
                                                    }else{
                                                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                                        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                        ->where('accounts.code_one', $var->code_one)
                                                        ->where('accounts.code_two', $var->code_two)
                                                        ->where('accounts.code_three', $var->code_three)
                                                        ->where('accounts.code_four', $var->code_four)
                                                        ->where('accounts.code_five', $var->code_five)
                                                        ->where('detail_vouchers.status', 'C')
                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                        ->whereRaw(
                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                        [$date_begin, $date_end])
                                                        ->sum('debe');
                                                        
                                                       

                                                        $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                        ->where('accounts.code_one', $var->code_one)
                                                        ->where('accounts.code_two', $var->code_two)
                                                        ->where('accounts.code_three', $var->code_three)
                                                        ->where('accounts.code_four', $var->code_four)
                                                        ->where('accounts.code_five', $var->code_five)
                                                        ->where('detail_vouchers.status', 'C')
                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                        ->whereRaw(
                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                        [$date_begin, $date_end])
                                                        ->sum('haber');   

                                                        
                                                        /*---------------------------------------------------*/

                                                

                                                        $var->debe = $total_debe;
                                                        $var->haber = $total_haber;
                                                    }
                                                }else
                                                {
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                                    $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('accounts.code_four', $var->code_four)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                        ->whereRaw(
                                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                    [$date_begin, $date_end])
                                                                        ->sum('debe');
                    
                                                    $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('accounts.code_four', $var->code_four)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                        ->whereRaw(
                                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                    [$date_begin, $date_end])
                                                                        ->sum('haber');   

                                                    $total_balance = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('accounts.code_four', $var->code_four)
                                                                        ->sum('balance_previus');   
                                                    /*---------------------------------------------------*/
                 
                                           
                 
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;
                                                    $var->balance_previus = $total_balance;
                   
                                                }
                                                                           
                    
                                            }else{
                                               
                                              
                                          
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */ 
                                                        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                        ->whereRaw(
                                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                        [$date_begin, $date_end])
                                                                        ->sum('debe');
                                
                                                        $total_haber =  DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->where('detail_vouchers.status', 'C')
                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                        ->whereRaw(
                                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                        [$date_begin, $date_end])
                                                                        ->sum('haber');    
                                                                        
                                                                        $total_balance = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                        ->where('accounts.code_one', $var->code_one)
                                                                        ->where('accounts.code_two', $var->code_two)
                                                                        ->where('accounts.code_three', $var->code_three)
                                                                        ->sum('balance_previus');   
                                                    /*---------------------------------------------------*/                               
                            
                                                    
                            
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;       
                                                    $var->balance_previus = $total_balance;
                                                
                                                        
                                                }
                                                    }else{
                                                        
                                                
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                   
                                                        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                        ->where('accounts.code_one', $var->code_one)
                                                                                        ->where('accounts.code_two', $var->code_two)
                                                                                        ->where('detail_vouchers.status', 'C')
                                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                        ->whereRaw(
                                                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                                        [$date_begin, $date_end])
                                                                                        ->sum('debe');
                                
                                                    
                                                        $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                        ->where('accounts.code_one', $var->code_one)
                                                                                        ->where('accounts.code_two', $var->code_two)
                                                                                        ->where('detail_vouchers.status', 'C')
                                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                        ->whereRaw(
                                                                                        "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                                        [$date_begin, $date_end])
                                                                                        ->sum('haber');

                                                        $total_balance = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                        ->where('accounts.code_one', $var->code_one)
                                                                                        ->where('accounts.code_two', $var->code_two)
                                                                                        ->sum('balance_previus'); 
                                                    /*---------------------------------------------------*/
                                                    
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;
                                                    $var->balance_previus = $total_balance;
                                                    
                                                    }
                                                }else{
                                                    //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */
                                                    if($var->code_one == 3){
                                                        $var = $this->calculation_capital($var,'bolivares',$date_begin,$date_end);
                                                    
                                                    }else{
                                                        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                    ->where('accounts.code_one', $var->code_one)
                                                                                    ->where('detail_vouchers.status', 'C')
                                                                                    //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                    ->whereRaw(
                                                                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                                    [$date_begin, $date_end])
                                                                                    ->sum('debe');
                                
                                                    
                                                    
                                                        $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                    ->where('accounts.code_one', $var->code_one)
                                                                                    ->where('detail_vouchers.status', 'C')
                                                                                    //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                    ->whereRaw(
                                                                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                                                                    [$date_begin, $date_end])
                                                                                    ->sum('haber');
                                                        $total_balance = DB::connection(Auth::user()->database_name)->table('accounts')
                                                                                    ->where('accounts.code_one', $var->code_one)
                                                                                    ->sum('balance_previus'); 
                                                        /*---------------------------------------------------*/
                            
                                                    
                                                        $var->debe = $total_debe;
                                                        $var->haber = $total_haber;           
                                                        $var->balance_previus = $total_balance;
                                                    }
                                                }
                                            }else{
                                                return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
                                            }
                                        } 
                                    }  else{
                                        return redirect('/accounts')->withDanger('No hay Cuentas');
                                    }              
                 
       
        
         return $accounts;
    }


    public function calculation_capital($var,$coin,$date_begin,$date_end)
    {
        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                    ->where('accounts.code_one','>=', $var->code_one)
                                    ->where('detail_vouchers.status', 'C')
                                    //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                    ->whereRaw(
                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                    [$date_begin, $date_end])
                                    ->sum('debe');

    
    
        $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                    ->where('accounts.code_one','>=', $var->code_one)
                                    ->where('detail_vouchers.status', 'C')
                                    //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                    ->whereRaw(
                                    "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                                    [$date_begin, $date_end])
                                    ->sum('haber');
        $total_balance = DB::connection(Auth::user()->database_name)->table('accounts')
                                    ->where('accounts.code_one', $var->code_one)
                                    ->sum('balance_previus'); 
        /*---------------------------------------------------*/

    
        $var->debe = $total_debe;
        $var->haber = $total_haber;           
        $var->balance_previus = $total_balance;

        return $var;
    }

    public function calculation_superavit($var,$code,$coin,$date_begin,$date_end)
    {
        $total_debe = DB::connection(Auth::user()->database_name)->table('accounts')
                ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                ->where('accounts.code_one','>=', $code)
                ->where('detail_vouchers.status', 'C')
                ->whereRaw(
                "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                [$date_begin, $date_end])
                ->sum('debe');



        $total_haber = DB::connection(Auth::user()->database_name)->table('accounts')
                ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                ->where('accounts.code_one','>=', $code)
                ->where('detail_vouchers.status', 'C')
                //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                ->whereRaw(
                "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
                [$date_begin, $date_end])
                ->sum('haber');


        $var->debe = $total_debe;
        $var->haber = $total_haber;    
        
 
         return $var;
 
    }
 
    
}
