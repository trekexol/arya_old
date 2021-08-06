<?php

namespace App\Http\Controllers;

use App;
use App\Company;
use App\DetailVoucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyListingController extends Controller
{
    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');
        $detailvouchers = DB::table('detail_vouchers')
                            ->join('header_vouchers', 'header_vouchers.id', '=', 'detail_vouchers.id_header_voucher')
                            ->join('accounts', 'accounts.id', '=', 'detail_vouchers.id_account')
                            ->where('header_vouchers.date', $datenow)
                            ->select('detail_vouchers.*','header_vouchers.*'
                            ,'accounts.description as account_description')->get();
            
                            
        }elseif($users_role == '2'){
            return view('admin.index',compact('detailvouchers'));
        }
 
        return view('admin.daily_listing.index',compact('detailvouchers','datenow'));
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            
        
            'date_begin'        =>'required',
            'date_end'  =>'required',
           
        
        
        ]);
        
        $date_begin = request('date_begin');
        $date_end = request('date_end');

        $detailvouchers =  DB::table('detail_vouchers')
                                ->join('header_vouchers', 'header_vouchers.id', '=', 'detail_vouchers.id_header_voucher')
                                ->join('accounts', 'accounts.id', '=', 'detail_vouchers.id_account')
                                ->whereBetween('header_vouchers.date', [$date_begin, $date_end])
                                ->select('detail_vouchers.*','header_vouchers.*'
                                ,'accounts.description as account_description')->get();
                
        return view('admin.daily_listing.index',compact('detailvouchers','date_begin','date_end'));
   
    }

    public function print_journalbook(Request $request)
    {
       

        $date_begin = request('date_begin');
        $date_end = request('date_end');

        $date = Carbon::now();
        $datenow = $date->format('d-m-Y');

        $pdf = App::make('dompdf.wrapper');

        $company = Company::find(1);

        $detailvouchers =  DB::table('detail_vouchers')
                            ->join('header_vouchers', 'header_vouchers.id', '=', 'detail_vouchers.id_header_voucher')
                            ->join('accounts', 'accounts.id', '=', 'detail_vouchers.id_account')
                            ->whereBetween('header_vouchers.date', [$date_begin, $date_end])
                            ->select('detail_vouchers.*','header_vouchers.*'
                            ,'accounts.description as account_description'
                            ,'header_vouchers.id as id_header'
                            ,'header_vouchers.description as header_description')->get();

        
        //dd($detailvouchers);
        $date_begin = Carbon::parse($date_begin)->format('d-m-Y');

        $date_end = Carbon::parse($date_end)->format('d-m-Y');

        $pdf = $pdf->loadView('admin.reports.journal_book',compact('company','detailvouchers'
                                ,'datenow','date_begin','date_end'));
        return $pdf->stream();
    }

   

}
