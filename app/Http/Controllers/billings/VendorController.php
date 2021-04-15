<?php

namespace App\Http\Controllers\billings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('billings/vendor');

        //return view('admin/home');
    }

    public function create()
    {
        return view('billings/vendorcreate');
    }
}
