<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Nomina;
use App\NominaCalculation;
use App\NominaConcept;
use App\Profession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            
        ]);

        $users = new NominaCalculation();


        $users->id_nomina = request('id_nomina');
        $users->id_nomina_concept = request('id_nomina_concept');
        $users->id_employee = request('id_employee');
       
        $users->number_receipt = 0;
        
        $users->type = 'No';

        $nomina = Nomina::find($users->id_nomina);
        $employee = Employee::find($users->id_employee);
        $nomina_concept = NominaConcept::find($users->id_nomina_concept);

        $amount = $this->addNominaCalculation($nomina,$nomina_concept,$employee);

        if(isset($amount)){
            $users->amount = $amount;
        }else{
            $users->amount = 0;
        }
        

        $users->hours = 0;
        $users->days = 0;

        $users->cantidad = 0;
        $users->voucher = 0;


        $users->status =  "1";
       
       

        $users->save();

        return redirect('/nominacalculations/index/'.$users->id_nomina.'/'.$users->id_employee.'')->withSuccess('Registro Exitoso!');
    }

    public function formula($id_formula,$employee,$nomina)
    {

        $lunes = 0;
        $horas = 0;
        $dias = 0;
        $dias_feriados = 0;
        $cestaticket = 0;
        $dias_faltados = 0;

        if($id_formula == 1){
            //{{sueldo}} * 12 / 52 * {{lunes}} * 0.04
            $total = ($employee->monto_pago * 12)/52 * 0.04;
            
        }else if($id_formula == 2){
            //{{sueldo}} * 12 / 52 * {{lunes}} * 0.04 * 5 / 5
            $lunes = $this->calcular_cantidad_de_lunes($nomina);
            $total = (($employee->monto_pago * 12)/52) * (($lunes * 0.04) * 5)/5 ;
            
        }else if($id_formula == 3){
            //{{sueldo}} / 30 * 7.5
            $total = ($employee->monto_pago * 30) * 7.5 ;
            
        }else if($id_formula == 4){
            //{{sueldo}} * 0.01 / 2
            $total = ($employee->monto_pago * 0.01)/2 ;
            
        }else if($id_formula == 5){
            //{{sueldo}} * 0.01 / 4
            $total = ($employee->monto_pago * 0.01) / 4 ;
            
        }else if($id_formula == 6){
            //{{sueldo}} / 2
            $total = ($employee->monto_pago)/2 ;
            
        }else if($id_formula == 7){
            //{{sueldo}} 
            $total = ($employee->monto_pago) ;
            
        }else if($id_formula == 8){
            //{{sueldo}} / 30 / 8 * 1.6 / {{horas}} 
            $total = (($employee->monto_pago * 30)/8 * 1.6) * $horas ;
            
        }else if($id_formula == 9){
            //{{sueldo}} / 30 / 8 * 1.8 / {{horas}}
            $total = (($employee->monto_pago * 30)/8 * 1.8) * $horas ;
            
        }else if($id_formula == 10){
            //{{sueldo}} / 30*1.5 *{{dias}}
            $total = ($employee->monto_pago / 30) * 1.5 * $dias;
            
        }else if($id_formula == 11){
            //{{sueldo}} / 30 * 1.5 * {{diasferiados}}
            $total = ($employee->monto_pago / 30) * 1.5 * $dias_feriados;
            
        }else if($id_formula == 12){
            //{{cestaticket}} / 2
            $total = $cestaticket / 2;
            
        }else if($id_formula == 13){
            //{{sueldo}} * 0.03
            $total = $employee->monto_pago * 0.03;
            
        }else if($id_formula == 14){
            //{{sueldo}} * 12 / 52 * {{lunes}} * 0.005
            $lunes = $this->calcular_cantidad_de_lunes($nomina);
            $total = ($employee->monto_pago * 12)/52 * $lunes * 0.005;
            
        }else if($id_formula == 15){
            //{{sueldo}} * 12 / 52 * {{lunes}} * 0.004
            $lunes = $this->calcular_cantidad_de_lunes($nomina);
            $total = ($employee->monto_pago * 12)/52 * $lunes * 0.004;
            
        }else if($id_formula == 16){
            //{{sueldo}} / 30 * {{dias_faltados}}
            
            $total = ($employee->monto_pago / 30) * $dias_faltados;
            
        }else{
            return -1;
        }
        return $total;
    }

    public function calcular_cantidad_de_lunes($nomina)
    {
        $fechaInicio= strtotime($nomina->date_begin);
        $fechaFin= strtotime($nomina->date_end);
       
        $cantidad_de_dias_lunes = 0;
        //Recorro las fechas y con la función strotime obtengo los lunes
        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
            //Sacar el dia de la semana con el modificador N de la funcion date
            
            $dia = date('N', $i);
            if($dia==1){
                $cantidad_de_dias_lunes += 1;
            }
        }
        return $cantidad_de_dias_lunes;
    }

 

    public function addNominaCalculation($nomina,$nominaconcept,$employee)
    {
        
            if(($nomina->type == "Primera Quincena") || ($nomina->type == "Segunda Quincena")){
                if(isset($nominaconcept->id_formula_q)){
                    $amount = $this->formula($nominaconcept->id_formula_q,$employee,$nomina);
                }
                
            }else if(($nomina->type == "Mensual")){
                if(isset($nominaconcept->id_formula_m)){
                    $amount = $this->formula($nominaconcept->id_formula_m,$employee,$nomina);
                }

            }else if(($nomina->type == "Semanal")){
                if(isset($nominaconcept->id_formula_s)){
                    $amount = $this->formula($nominaconcept->id_formula_s,$employee,$nomina);
                }
            }

           return $amount;
        
        
    }






    public function edit($id)
    {

        $var  = NominaCalculation::find($id);

        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');

        
        return view('admin.nominacalculations.edit',compact('var','datenow'));
        
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



    public function listformula(Request $request, $id_concept = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $formula_q = DB::table('nomina_concepts')
                                                        ->join('nomina_formulas', 'nomina_formulas.id', '=', 'nomina_concepts.id_formula_q')
                                                        ->where('nomina_concepts.id', $id_concept)
                                                        ->select('nomina_formulas.description as description')
                                                        ->get(); 
                                                      
                return response()->json($formula_q,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
    public function listformulamensual(Request $request, $id_concept = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $formula_q = DB::table('nomina_concepts')
                                                        ->join('nomina_formulas', 'nomina_formulas.id', '=', 'nomina_concepts.id_formula_m')
                                                        ->where('nomina_concepts.id', $id_concept)
                                                        ->select('nomina_formulas.description as description')
                                                        ->get(); 
                                                   
                return response()->json($formula_q,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
    public function listformulasemanal(Request $request, $id_concept = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                $formula_q = DB::table('nomina_concepts')
                                                        ->join('nomina_formulas', 'nomina_formulas.id', '=', 'nomina_concepts.id_formula_s')
                                                        ->where('nomina_concepts.id', $id_concept)
                                                        ->select('nomina_formulas.description as description')
                                                        ->get(); 
                                                   
                return response()->json($formula_q,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }
}
