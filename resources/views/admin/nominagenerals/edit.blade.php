@extends('admin.layouts.dashboard')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-center font-weight-bold h3">Datos Generales</div>

                    <div class="card-body">
                            <form  method="POST"   action="{{ route('nominagenerals.update',$var->id) }}" enctype="multipart/form-data" >
                            @method('PATCH')
                            @csrf()
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="unidad_tributaria">Unidad Tributaria:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="unidad_tributaria" name="Unidad_Tributaria" value="{{ $var->unit_tributary}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">UT</div>
                                        </div>
                                    </div>
                                </div>
                                @error('unidad_tributaria')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="dias_utilidad">Días Utilidades:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="dias_utilidad" name="Dias_Utilidad" value="{{ $var->day_utility}}" required >
                                </div>
                                @error('dias_utilidad')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="dias_bono_vacacional">Días Bono Vanacional:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="dias_bono_vacacional" name="Dias_Bono_Vacacional" value="{{ $var->day_bonus_vacation}}" required >
                                </div>
                                @error('dias_bono_vacacional')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="dias_vacaciones">Días Vacaciones:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="dias_vacaciones" name="Dias_Vacaciones" value="{{ $var->day_vacation}}" required >
                                </div>
                                @error('dias_vacaciones')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="sso_id">S.S.O:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sso_id" name="SSO" value="{{ $var->sso}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('sso_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="faov_id">F.A.O.V:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sso_id" name="FAOV" value="{{ $var->faov}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('faov_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="pie_id">P.I.E:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pie_id" name="PIE" value="{{ $var->pie}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('pie_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="sso_empresa">S.S.O Empresa:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="sso_empresa" name="SSO_EMPRESA" value="{{ $var->sso_company}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('sso_empresa')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="faov_empresa">F.A.O.V Empresa:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="faov_empresa" name="FAOV_EMPRESA" value="{{ $var->faov_company}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('faov_empresa')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="pie_empresa">P.I.E Empresa:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pie_empresa" name="PIE_EMPRESA" value="{{ $var->pie_company}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('pie_empresa')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="tasa_prestacion">Tasa Prestaciones:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tasa_prestacion" name="Tasa_Prestaciones" value="{{ $var->rate_benefit}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">%</div>
                                        </div>
                                    </div>
                                </div>
                                @error('tasa_prestacion')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="dias_prestacion">Días Prestaciones:</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="dias_prestacion" name="Dia_Prestaciones" value="{{ $var->day_cenefit}}"  required>
                                </div>
                                @error('dias_prestacion')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="cestaticket_id">Cestatickets:</label>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cestaticket_id" name="Cestatickets" value=" {{ $var->cestaticket}}" required >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" id="btnGroupAddon">UT</div>
                                        </div>
                                    </div>
                                </div>
                                @error('cestaticket_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-sm-2">
                                    <label for="monto_cestaticket">Monto Cestatickets :</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="monto_cestaticket" name="Monto_Cestatickets" value="{{ $var->amount_cestaticket}}" required >
                                </div>
                                @error('monto_cestaticket')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Modificar Datos
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('validacion')
    <script>
        $(function(){
            soloAlfaNumerico('name');
            soloAlfaNumerico('description');
        });
    </script>
@endsection
