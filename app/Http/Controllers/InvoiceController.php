<?php

namespace App\Http\Controllers;

use App\Quotation;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
 
    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         $quotations = Quotation::orderBy('id' ,'DESC')
                                        ->where('date_billing','<>',null)
                                        ->get();
         }elseif($users_role == '2'){
            return view('admin.index');
        }
 
        return view('admin.invoices.index',compact('quotations'));
    }
 
}
