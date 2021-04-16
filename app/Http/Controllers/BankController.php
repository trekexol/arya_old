<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
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
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
           $banks      =   Bank::orderBy('id', 'asc')->get();
        }elseif($users_role == '2'){
            return view('admin.index');
        }

    
        return view('admin.banks.index',compact('banks'));
      
    }

    public function create()
    {

        

        return view('admin.banks.create');
    }

    public function store(Request $request)
    {
        
        $data = request()->validate([
           
          
            'description'         =>'required|max:255',
            'status'         =>'required|max:1',
           
        ]);

        $users = new Bank();

        $users->description = request('description');
        $users->status = request('status');
        

        $users->save();

        return redirect('/banks')->withSuccess('Registro Exitoso!');
    }



    public function edit($id)
    {

        $var   = Bank::find($id);
        
        return view('admin.banks.edit',compact('var'));
    }

   


    public function update(Request $request,$id)
    {
        $vars =  Bank::find($id);

        $var_status = $vars->status;

        $request->validate([
          
            'description'      =>'required|string|max:100',
            'status'    =>'required|max:1',
        ]);

        

        $var          = Bank::findOrFail($id);
        $var->description        = request('description');
       
        if(request('status') == null){
            $var->status = $var_status;
        }else{
            $var->status = request('status');
        }
       

        $var->save();


        return redirect('/banks')->withSuccess('Registro Guardado Exitoso!');

    }


}
