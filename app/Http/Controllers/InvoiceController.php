<?php

namespace App\Http\Controllers;

use App\DetailVoucher;
use App\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    
 
    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         $quotations = Quotation::on(Auth::user()->database_name)->orderBy('id' ,'desc')
                                        ->where('date_billing','<>',null)
                                        ->get();
         }elseif($users_role == '2'){
            return view('admin.index');
        }
 
        return view('admin.invoices.index',compact('quotations'));
    }

    public function movementsinvoice($id_invoice,$coin = null)
    {
        

        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $quotation = Quotation::on(Auth::user()->database_name)->find($id_invoice);
            $detailvouchers = DetailVoucher::on(Auth::user()->database_name)->where('id_invoice',$id_invoice)->get();

            if(!isset($coin)){
                $coin = 'bolivares';
            }

           
         }elseif($users_role == '2'){
            return view('admin.index');
        }
        
        return view('admin.invoices.index_detail_movement',compact('detailvouchers','quotation','coin'));
    }
 
}
