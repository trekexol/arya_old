<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyListingController extends Controller
{
    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
         
         }elseif($users_role == '2'){
            return view('admin.index');
        }
 
        return view('admin.quotations.indexdeliverynote');
    }
}
