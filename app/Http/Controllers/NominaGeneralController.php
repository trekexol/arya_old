<?php

namespace App\Http\Controllers;
use App\NominaGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NominaGeneralController extends Controller
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

        $user= auth()->user();
        $users_role =   $user->role_id;
        try{
            if ($users_role == '1'){
                $nominaGenerals =NominaGeneral::on(Auth::user()->database_name)->first();
                if(empty($nominaGenerals) ){
                    return view('admin.nominagenerals.create');
                }else{
                    $nominaGenerals = NominaGeneral::orderBy('id', 'asc')->first();
                    return redirect()->route('nominagenerals.edit',$nominaGenerals->id);
                }
            }else{
                return redirect('/');
            }
        }catch(\Illuminate\Database\QueryException $qry_ex){//capturar excepciones de consultas en BD
            return redirect('/');
        }catch(Throwable $th){//Capturar errores en General.
            return redirect('/');
        }
    }

    public function create()
    {



        return view('admin.nominatypes.create');
    }

    public function store(Request $request)
    {

        $Unidad_Tributaria          =  request('Unidad_Tributaria');
        $Dias_Utilidad              =  request('Dias_Utilidad');
        $Dias_Bono_Vacacional       =  request('Dias_Bono_Vacacional');
        $Dias_Vacaciones            =  request('Dias_Vacaciones');
        $SSO                        =  request('SSO');
        $FAOV                       =  request('FAOV');
        $PIE                        =  request('PIE');
        $SSO_EMPRESA                =  request('SSO_EMPRESA');
        $FAOV_EMPRESA               =  request('FAOV_EMPRESA');
        $PIE_EMPRESA                =  request('PIE_EMPRESA');
        $Tasa_Prestaciones          =  request('Tasa_Prestaciones');
        $Dia_Prestaciones           =  request('Dia_Prestaciones');
        $Cestatickets               =  request('Cestatickets');
        $Monto_Cestatickets         =  request('Monto_Cestatickets');

        if($Unidad_Tributaria == '0' || $Unidad_Tributaria == '' || $Unidad_Tributaria == ' ' || $Unidad_Tributaria == null){
            $Unidad_Tributaria = '0';
        }
        if($Dias_Utilidad == '0' || $Dias_Utilidad == '' || $Dias_Utilidad == ' ' || $Dias_Utilidad == null){
            $Dias_Utilidad = '0';
        }
        if($Dias_Bono_Vacacional == '0' || $Dias_Bono_Vacacional == '' || $Dias_Bono_Vacacional == ' ' || $Dias_Bono_Vacacional == null ){
            $Dias_Bono_Vacacional = '0';
        }
        if($Dias_Vacaciones == '0' || $Dias_Vacaciones == '' || $Dias_Vacaciones == ' ' || $Dias_Vacaciones == null){
            $Dias_Vacaciones = '0';
        }
        if($SSO == '0' || $SSO == '' || $SSO == ' ' || $SSO == null){
            $SSO = '0';
        }
        if($FAOV == '0' || $FAOV == '' || $FAOV == ' ' || $FAOV == null){
            $FAOV = '0';
        }
        if($PIE == '0' || $PIE == '' || $PIE == ' ' || $PIE == null){
            $PIE = '0';
        }
        if($SSO_EMPRESA == '0' || $SSO_EMPRESA == '' || $SSO_EMPRESA == ' ' || $SSO_EMPRESA == null){
            $SSO_EMPRESA = '0';
        }
        if($FAOV_EMPRESA == '0' || $FAOV_EMPRESA == '' || $FAOV_EMPRESA == ' ' || $FAOV_EMPRESA == null){
            $FAOV_EMPRESA = '0';
        }
        if($PIE_EMPRESA == '0' || $PIE_EMPRESA == '' || $PIE_EMPRESA == ' ' || $PIE_EMPRESA == null){
            $PIE_EMPRESA = '0';
        }
        if($Tasa_Prestaciones == '0' || $Tasa_Prestaciones == '' || $Tasa_Prestaciones == ' ' || $Tasa_Prestaciones == null){
            $Tasa_Prestaciones = '0';
        }
        if($Cestatickets == '0' || $Cestatickets == '' || $Cestatickets == ' ' || $Cestatickets == null){
            $Cestatickets = '0';
        }
        if($Dia_Prestaciones == '0' || $Dia_Prestaciones == '' || $Dia_Prestaciones == ' ' || $Dia_Prestaciones == null ){
            $Dia_Prestaciones = '0';
        }
        if($Monto_Cestatickets == '0' || $Monto_Cestatickets == '' || $Monto_Cestatickets == ' ' ||  $Monto_Cestatickets == null){
            $Monto_Cestatickets = '0';
        }

        $nominagenerals = new NominaGeneral();
        $nominagenerals->setConnection(Auth::user()->database_name);

        $nominagenerals->unit_tributary      =  request('Unidad_Tributaria');
        $nominagenerals->day_utility         = request('Dias_Utilidad');
        $nominagenerals->day_bonus_vacation  =  request('Dias_Bono_Vacacional');
        $nominagenerals->day_vacation        = request('Dias_Vacaciones');
        $nominagenerals->sso                 =  request('SSO');
        $nominagenerals->faov                = request('FAOV');
        $nominagenerals->pie                 =  request('PIE');
        $nominagenerals->sso_company         = request('SSO_EMPRESA');
        $nominagenerals->faov_company        =  request('FAOV_EMPRESA');
        $nominagenerals->pie_company         =  request('PIE_EMPRESA');
        $nominagenerals->rate_benefit        = request('Tasa_Prestaciones');
        $nominagenerals->day_cenefit         =  request('Dia_Prestaciones');
        $nominagenerals->cestaticket         = request('Cestatickets');
        $nominagenerals->amount_cestaticket  =  request('Monto_Cestatickets');

        $nominagenerals->save();
        $nominaGenerals = NominaGeneral::orderBy('id', 'asc')->first();
        return redirect()->route('nominagenerals.edit',$nominaGenerals->id);
    }

    public function edit($id)
    {

        $var = NominaGeneral::on(Auth::user()->database_name)->find($id);

        return view('admin.nominagenerals.edit',compact('var'));
    }

    public function update(Request $request,$id)
    {

        $nominagenerals =  NominaGeneral::on(Auth::user()->database_name)->findOrFail($id);
        $nominagenerals->unit_tributary      =  request('Unidad_Tributaria');
        $nominagenerals->day_utility         = request('Dias_Utilidad');
        $nominagenerals->day_bonus_vacation  =  request('Dias_Bono_Vacacional');
        $nominagenerals->day_vacation        = request('Dias_Vacaciones');
        $nominagenerals->sso                 =  request('SSO');
        $nominagenerals->faov                = request('FAOV');
        $nominagenerals->pie                 =  request('PIE');
        $nominagenerals->sso_company         = request('SSO_EMPRESA');
        $nominagenerals->faov_company        =  request('FAOV_EMPRESA');
        $nominagenerals->pie_company         =  request('PIE_EMPRESA');
        $nominagenerals->rate_benefit        = request('Tasa_Prestaciones');
        $nominagenerals->day_cenefit         =  request('Dia_Prestaciones');
        $nominagenerals->cestaticket         = request('Cestatickets');
        $nominagenerals->amount_cestaticket  =  request('Monto_Cestatickets');
        $nominagenerals->save();

        $nominaGenerals = NominaGeneral::orderBy('id', 'asc')->first();
        return redirect()->route('nominagenerals.edit',$nominaGenerals->id);

    }


}
