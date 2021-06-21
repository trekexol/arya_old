<?php

namespace App\Http\Controllers;

use App\Company;
use App\InventaryType;
use App\RateType;
use App\UserCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
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
            $user_companies = UserCompany::where('id_user',Auth::id())->first();
            $users      =   Company::on($user_companies->name_connection)->orderBy('id', 'asc')->get();
        
        }elseif($users_role == '2'){
            return view('admin.index');
        }
        return view('admin.companies.index',compact('users'));
    }

    public function create()
    {
        

        $urlToGet ='http://www.bcv.org.ve/tasas-informativas-sistema-bancario';
        $pageDocument = @file_get_contents($urlToGet);
        preg_match_all('|<div class="col-sm-6 col-xs-6"><strong> (.*?) </strong> </div>|s', $pageDocument, $cap);

        if ($cap[0] == array()){ // VALIDAR Concidencia
            $titulo = '0,00';
        } else {
            $titulo = $cap[1][2];
        }

        $bcv            = $titulo;
        $date           = Carbon::now();
        $periodo        = $date->format('Y');

        $tipoinvs       = InventaryType::orderBY('description','asc')->pluck('description','id')->toArray();
        $tiporates      = RateType::orderBY('description','asc')->pluck('description','id')->toArray();

        return view('admin.companies.create',compact('periodo','tipoinvs','tiporates','bcv'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'Login'             =>'required|max:191',
            'Email'             =>'required|max:255',
            'Codigo'            =>'required|max:160',
            'Razon_Social'      =>'required|max:160',
            'Telefono'          =>'required|max:11',
            'Franqueo_Postal'   =>'required|max:255',
            'Direccion'         =>'required|max:255',
            'Impuesto'          =>'required|max:255',
            'Impuesto_2'        =>'max:3',
            'Impuesto_3'        =>'max:3',
            'Retencion_ISRL'    =>'max:3',
            'Tipo_Inventario'   =>'required|integer|not_in:0',
            'Tipo_Tasa'         =>'required|integer|not_in:0',
            'Tasa'              =>'required|max:255',
            'Tasa_Petro'        =>'required|max:255',
            'Periodo'           =>'required|max:4',

        ]);

        $razon_social           = strtoupper(request('Razon_Social'));
        $email                  = strtoupper(request('Email'));
        $direccion              = strtoupper(request('Direccion'));
        $tasa                   = request('Tasa');
        $rate_number            = str_replace(".","",$tasa);
        $rate_number_2          = str_replace(",",".",$rate_number);

        $companies  = new Company();

        $user_companies = UserCompany::where('id_user',Auth::id())->first();
        $companies->setConnection($user_companies->name_connection);

        $companies->login           = request('Login');
        $companies->email           = $email;
        $companies->code_rif        = request('Codigo');
        $companies->razon_social    = $razon_social;
        $companies->phone           = request('Telefono');
        $companies->franqueo_postal = request('Franqueo_Postal');
        $companies->address         = $direccion;
        $companies->tax_1           = request('Impuesto');
        $companies->tax_2           = request('Impuesto_2');
        $companies->tax_3           = request('Impuesto_3');;
        $companies->retention_islr  = request('Retencion_ISRL');
        $companies->tipoinv_id      = request('Tipo_Inventario');
        $companies->tiporate_id     = request('Tipo_Tasa');
        $companies->rate            = $rate_number_2;
        $companies->rate_petro      = request('Tasa_Petro');
        $companies->foto_company    = "default";
        $companies->period          = request('Periodo');

        $companies->status          = '1';

        $companies->save();
        return redirect('/companies')->withSuccess('Registro Exitoso!');
    }

    public function edit($id)
    {
        $company            = Company::find($id);

        $urlToGet ='http://www.bcv.org.ve/tasas-informativas-sistema-bancario';
        $pageDocument = @file_get_contents($urlToGet);
        preg_match_all('|<div class="col-sm-6 col-xs-6"><strong> (.*?) </strong> </div>|s', $pageDocument, $cap);

        if ($cap[0] == array()){ // VALIDAR Concidencia
            $titulo = '0,00';
        } else {
            $titulo = $cap[1][2];
        }

        $bcv            = $titulo;
        $date           = Carbon::now();
        $periodo        = $date->format('Y');
        $tipoinvs       = InventaryType::orderBY('description','asc')->pluck('description','id')->toArray();
        $tiporates      = RateType::orderBY('description','asc')->pluck('description','id')->toArray();


        return view('admin.companies.edit',compact('company','bcv','periodo','tipoinvs','tiporates'));
    }

    public function update(Request $request,$id)
    {
        $validar              =  Company::find($id);

        $request->validate([
            'Nombre'         =>'required|max:191,'.$validar->id,
            'Email'          =>'required|max:255,'.$validar->id,
            'Codigo'         =>'required|max:4',
            'Razon_Social'   =>'required|max:160,'.$validar->id,
            'Descripcion'    =>'required|max:255',
            'Estado'         =>'required|max:2',
        ]);

        $nombre              = strtoupper(request('Nombre'));
        $email               = strtoupper(request('Email'));
        $descripcion         = strtoupper(request('Descripcion'));
        $codigo              = strtoupper(request('Codigo'));
        $razon_social        = strtoupper(request('Razon_Social'));
        $resul_social        = $codigo.$razon_social;

        $companies          = Company::findOrFail($id);
        $companies->name                = $nombre;
        $companies->email               = $email;
        $companies->description         = $descripcion;
        $companies->razon_social        = $resul_social;
        $companies->status              = request('Estado');

        $companies->save();
        return redirect('/companies')->withSuccess('Registro Guardado Exitoso!');

    }

    public function destroy(Request $request)
    {
        //find the Division
        $user = User::find($request->user_id);

        //Elimina el Division
        $user->delete();
        return redirect('users')->withDelete('Registro Eliminado Exitoso!');
    }
}
