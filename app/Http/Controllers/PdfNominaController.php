<?php

namespace App\Http\Controllers;

use App;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PdfNominaController extends Controller
{
    function imprimirVacaciones(Request $request){
      
        $guardar = request('guardar');

        $pdf = App::make('dompdf.wrapper');

        $employee = Employee::find(request('id_employee'));

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');
        

        if(isset($employee)){

            $employee->date_begin = request('date_begin');
            $employee->date_end = request('date_end');
            $employee->days = request('days');
            $employee->bono = request('bono');
            //SE CALCULA LA CANTIDAD DE DIAS SABADOS, DOMINGOS Y FERIADOS

            $enable_holidays = request('enable_holidays');

            if(isset($enable_holidays)){
                $total_feriados = $this->calcular_cantidad_de_feriados($employee->date_begin,$employee->date_end);
                $employee->holidays = $total_feriados;
            }
            
            //---------------------------------
            $employee->mondays = request('monday');
            

            $sin_formato_lph = str_replace(',', '.', str_replace('.', '', request('lph')));

            $employee->lph = $sin_formato_lph;

            $pdf = $pdf->loadView('pdf.bono_vacaciones',compact('employee','datenow'));

            if(isset($guardar)){
                return $pdf->download('invoice.pdf');
            }
            
            return $pdf->stream();
    
        }else{
            return redirect('/nominas')->withDanger('El empleado no existe');
        } 
            
    }

    function imprimirPrestaciones(Request $request){
      
        $pdf = App::make('dompdf.wrapper');

        $employee = Employee::find(request('id_employee'));

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');
        

        if(isset($employee)){

            $employee->date_begin = request('date_begin');
           
         
            $pdf = $pdf->loadView('pdf.prestaciones',compact('employee','datenow'));
            return $pdf->stream();
    
        }else{
            return redirect('/nominas')->withDanger('El empleado no existe');
        } 
            
    }


    public function calcular_cantidad_de_feriados($date_begin,$date_end)
    {
        $fechaInicio= strtotime($date_begin);
        $fechaFin= strtotime($date_end);
       
        $cantidad_de_dias_lunes = 0;
        //Recorro las fechas y con la función strotime obtengo los lunes
        for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
            //Sacar el dia de la semana con el modificador N de la funcion date
            
            $dia = date('N', $i);
            if($dia==7){
                $cantidad_de_dias_lunes += 1;
            }
            if($dia==6){
                $cantidad_de_dias_lunes += 1;
            }
        }

        return $cantidad_de_dias_lunes;
    }
}
