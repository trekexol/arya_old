<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;


use App;
use App\Account;
use App\DetailVoucher;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    public function index()
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
            $detail_old = DetailVoucher::orderBy('created_at','asc')->first();

        }elseif($users_role == '2'){
            return view('admin.index');
        }

        
    
        return view('admin.reports.index_balance_general',compact('datenow','detail_old'));
      
    }

    public function index_ingresos()
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    
            $detail_old = DetailVoucher::orderBy('created_at','asc')->first();

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
        $detail_old = DetailVoucher::orderBy('created_at','asc')->first();

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

       
        

        $pdf = $pdf->loadView('admin.reports.balance_general',compact('datenow','accounts','level','detail_old','date_begin','date_end'));
        return $pdf->stream();
                 
    }

    function balance_ingresos_pdf($date_begin = null,$date_end = null,$level = null){
      
        $pdf = App::make('dompdf.wrapper');

        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 
        $period = $date->format('Y'); 
        $detail_old = DetailVoucher::orderBy('created_at','asc')->first();

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
        $accounts = Account::orderBy('code_one', 'asc')
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
                                                        /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                                        $total_debe = DB::table('accounts')
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
                                                        
                                                       

                                                        $total_haber = DB::table('accounts')
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
                                                
                                                }else
                                                {
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                                   
                                                    $total_debe = DB::table('accounts')
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
                    
                                                    $total_haber = DB::table('accounts')
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
                                                    /*---------------------------------------------------*/
                 
                                           
                 
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;
                   
                                                }
                                                                           
                    
                                            }else{
                                               
                                              
                                          
                                         /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */ 
                                            $total_debe = DB::table('accounts')
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
                                
                                                        $total_haber =  DB::table('accounts')
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
                                                    /*---------------------------------------------------*/                               
                            
                                                    
                            
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;       
                                                                    
                                                
                                                        
                                                }
                                                    }else{
                                                        
                                                
                                                    /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */                                   
                                                        $total_debe = DB::table('accounts')
                                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                        ->where('accounts.code_one', $var->code_one)
                                                                                        ->where('accounts.code_two', $var->code_two)
                                                                                        ->where('detail_vouchers.status', 'C')
                                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                    ->    whereRaw(
            "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
            [$date_begin, $date_end])
                                                                                        ->sum('debe');
                                
                                                    
                                                        $total_haber = DB::table('accounts')
                                                                                        ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                        ->where('accounts.code_one', $var->code_one)
                                                                                        ->where('accounts.code_two', $var->code_two)
                                                                                        ->where('detail_vouchers.status', 'C')
                                                                                        //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                    ->    whereRaw(
            "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
            [$date_begin, $date_end])
                                                                                        ->sum('haber');
                                                    /*---------------------------------------------------*/
                                                    
                                                    $var->debe = $total_debe;
                                                    $var->haber = $total_haber;
                                                
                                                    
                                                    }
                                                }else{
                                                    //Cuentas NIVEL 2 EJEMPLO 1.0.0.0
                                                /*CALCULA LOS SALDOS DESDE DETALLE COMPROBANTE */
                                                        $total_debe = DB::table('accounts')
                                                                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                    ->where('accounts.code_one', $var->code_one)
                                                                                    ->where('detail_vouchers.status', 'C')
                                                                                    //->whereBetween('detail_vouchers.created_at', [$date_begin, $date_end])
                                                                                    ->whereRaw(
            "(DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') >= ? AND DATE_FORMAT(detail_vouchers.created_at, '%Y-%m-%d') <= ?)", 
            [$date_begin, $date_end])
                                                                                    ->sum('debe');
                                
                                                    
                                                    
                                                        $total_haber = DB::table('accounts')
                                                                                    ->join('detail_vouchers', 'detail_vouchers.id_account', '=', 'accounts.id')
                                                                                    ->where('accounts.code_one', $var->code_one)
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
                                            }else{
                                                return redirect('/accounts')->withDanger('El codigo uno es igual a cero!');
                                            }
                                        } 
                                    }  else{
                                        return redirect('/accounts')->withDanger('No hay Cuentas');
                                    }              
                 
       
        
         return $accounts;
    }



    
}
