<?php

namespace App\Http\Controllers;

use App\HeaderVoucher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HeaderVoucherController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
        $headervouchers = HeaderVoucher::All();
        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.headervouchers.index',compact('headervouchers'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.headervouchers.create',compact('datenow'));
   }

  

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
    {
         $data = request()->validate([
                
                

                'reference'            =>'required',
                'description'       =>'required',
                'date'              =>'required',
               
            
            ]);

            $var = new HeaderVoucher();

            $var->reference = request('reference');
            $var->description = request('description');
            $var->date = request('date');
           
            $var->status =  "1";
        
            $var->save();

            return redirect('/headervouchers')->withSuccess('Registro Exitoso!');

       
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
        $var = HeaderVoucher::find($id);
       
        return view('admin.headervouchers.edit',compact('var'));
  
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

    $vars =  HeaderVoucher::find($id);

    $vars_status = $vars->status;
  
    $data = request()->validate([
                
                

        'reference'            =>'required',
        'description'       =>'required',
        'date'              =>'required',
       
    
    ]);

    $var = HeaderVoucher::findOrFail($id);

    $var->reference = request('reference');
    $var->description = request('description');
    $var->date = request('date');
    

    if(request('status') == null){
        $var->status = $vars_status;
    }else{
        $var->status = request('status');
    }
   
    $var->save();

    return redirect('/headervouchers')->withSuccess('Actualizacion Exitosa!');
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
