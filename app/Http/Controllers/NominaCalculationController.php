<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Nomina;
use App\NominaCalculation;
use App\NominaConcept;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NominaCalculationController extends Controller
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
    public function index($id_nomina,$id_employee)
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
            $nomina      =   Nomina::find($id_nomina);
            $employee    =   Employee::find($id_employee);
            if(isset($nomina)){
                if(isset($employee)){

                        $nominacalculations   =   NominaCalculation::where('id_nomina', $id_nomina)
                                                                    ->where('id_employee', $id_employee)
                                                                    ->orderby('id','desc')
                                                                    ->get();

                        $new_format = Carbon::parse($nomina->date_begin);
                        
                        
                        $nomina->date_format = $new_format->format('M Y');    
                        
                        $nomina->date_begin = $new_format->format('d-m-Y');   

                    return view('admin.nominacalculations.index',compact('nominacalculations','nomina','employee'));

                }else{
                    return redirect('/nominacalculations')->withDanger('No se encuentra al Empleado!');
                }
            }else{
                return redirect('/nominacalculations')->withDanger('No se encuentra la Nomina!');
            }
           
        }elseif($users_role == '2'){
            return view('admin.index');
        }

    
        
      
    }

    

    public function create($id_nomina,$id_employee)
    {
       
        $nomina      =   Nomina::find($id_nomina);
        $employee    =   Employee::find($id_employee);

        if(isset($nomina)){
            if(isset($employee)){

                $nominaconcepts   =   NominaConcept::orderBy('description','asc')->get();
               
                return view('admin.nominacalculations.create',compact('nominaconcepts','nomina','employee'));

            }else{
                return redirect('/nominacalculations')->withDanger('No se encuentra al Empleado!');
            }
        }else{
            return redirect('/nominacalculations')->withDanger('No se encuentra la Nomina!');
        }
    }

    public function selectemployee($id)
    {

        $var  = NominaCalculation::find($id);

        $employees = Employee::where('profession_id',$var->id_profession)->get();

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');

       // dd($var);
        return view('admin.nominacalculations.selectemployee',compact('var','employees','datenow'));
        
    }

    public function store(Request $request)
    {
       // dd($request);
       
        $data = request()->validate([
           
            'id_nomina'     =>'required',
            'id_nomina_concept'       =>'required|max:60',
            'id_employee'              =>'required',
            
            'amount'       =>'required|max:60',
            'hours'              =>'required',
            'days'        =>'required',
            
            'cantidad'              =>'required',
            
            
           
        ]);

        $users = new NominaCalculation();

        $users->id_nomina = request('id_nomina');
        $users->id_nomina_concept = request('id_nomina_concept');
        $users->id_employee = request('id_employee');
       
        $users->number_receipt = 0;
        
        $users->type = 'No';

        $valor_sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('amount')));
        $users->amount = $valor_sin_formato_amount;

        $users->hours = request('hours');
        $users->days = request('days');

        $users->cantidad = request('cantidad');
        $users->voucher = 0;


        $users->status =  "1";
       
       

        $users->save();

        return redirect('/nominacalculations/'.$users->id_nomina.'/'.$users->id_employee.'')->withSuccess('Registro Exitoso!');
    }



    public function edit($id)
    {

        $var  = NominaCalculation::find($id);

        $professions = Profession::orderBY('name','asc')->get();
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');

        
        return view('admin.nominacalculations.edit',compact('var','professions','datenow'));
        
    }

   


    public function update(Request $request,$id)
    {
       
        $vars =  NominaCalculation::find($id);
        $var_status = $vars->status;
      

        $data = request()->validate([
           
            'id_profession'         =>'required',
            'description'         =>'required|max:255',
            'type'         =>'required',
            'date_begin'         =>'required|max:255',
            
            
           
        ]);

        $var          = NominaCalculation::findOrFail($id);

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


        return redirect('/nominacalculations')->withSuccess('Registro Guardado Exitoso!');

    }


}
