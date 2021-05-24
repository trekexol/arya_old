<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
 
    public function index()
    {
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $inventories_quotations = DB::table('products')->join('inventories', 'products.id', '=', 'inventories.product_id')
                                                            ->join('quotation_products', 'inventories.id', '=', 'quotation_products.id_inventory')
                                                            ->select('products.description', DB::raw('count(*) as amount_sales'),'products.type','inventories.code','inventories.amount')
                                                            ->groupBy('products.description','products.type','inventories.code','inventories.amount')
                                                            ->get(); 
                                                            
                
         }elseif($users_role == '2'){
            return view('admin.index');
        }
 
        return view('admin.sales.index',compact('inventories_quotations'));
    }
 
}
