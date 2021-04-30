<?php

namespace App\Http\Controllers;

use App\NominaConcept;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NominaConceptController extends Controller
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
           $nominaconcepts      =   NominaConcept::orderBy('id', 'asc')->get();
        }elseif($users_role == '2'){
            return view('admin.index');
        }

    
        return view('admin.nominaconcepts.index',compact('nominaconcepts'));
      
    }

    public function create()
    {
        $professions = Profession::orderBY('name','asc')->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');

        return view('admin.nominaconcepts.create',compact('professions','datenow'));
    }

    public function store(Request $request)
    {
       
        $data = request()->validate([
           
            'order'         =>'required',
            'description'   =>'required|max:60',
            'type'          =>'required',
            'sign'          =>'required',

            'calculate'     =>'required',
           

            'minimum'     =>'required',
            'maximum'     =>'required',
            
            
           
        ]);

        $users = new NominaConcept();

        $users->order = request('order');
        $users->description = request('description');
        $users->type = request('type');
       
        $users->sign = request('sign');
        
        $users->calculate = request('calculate');
        $users->formula_m = request('formula_m');
        $users->formula_s = request('formula_s');
        $users->formula_q = request('formula_q');

        $users->minium = request('minium');
        $users->maximum = request('maximum');


        $users->status =  "1";
       
       

        $users->save();

        return redirect('/nominaconcepts')->withSuccess('Registro Exitoso!');
    }



    public function edit($id)
    {

        $var  = NominaConcept::find($id);

        $professions = Profession::orderBY('name','asc')->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');

        
        return view('admin.nominaconcepts.edit',compact('var','professions','datenow'));
        
    }

   


    public function update(Request $request,$id)
    {
       
        $vars =  NominaConcept::find($id);
        $var_status = $vars->status;
      

        $data = request()->validate([
           
            'id_profession'         =>'required',
            'description'         =>'required|max:255',
            'type'         =>'required',
            'date_begin'         =>'required|max:255',
            
            
           
        ]);

        $var          = NominaConcept::findOrFail($id);

        $var->id_profession = request('id_profession');
        $var->description = request('description');
        $var->type = request('type');
        $var->date_begin = request('date_begin');
        $var->date_end = request('date_end');
       
        if(request('status') == null){
            $var->status = $var_status;
        }else{
            $var->status = request('status');
        }
       

        $var->save();


        return redirect('/nominaconcepts')->withSuccess('Registro Guardado Exitoso!');

    }


}
