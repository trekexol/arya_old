@extends('layouts.dashboard')

@section('content')



    {{-- VALIDACIONES-RESPUESTA--}}
    @include('admin.layouts.success')   {{-- SAVE --}}
    @include('admin.layouts.danger')    {{-- EDITAR --}}
    @include('admin.layouts.delete')    {{-- DELELTE --}}
    {{-- VALIDACIONES-RESPUESTA --}}
    
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Cliente</div>

                <div class="card-body">
                    <form  method="POST"   action="{{ route('clients.update',$var->id) }}" enctype="multipart/form-data" >
                        @method('PATCH')
                        @csrf()
                        
                        <div class="form-group row">
                            <label for="code_client" class="col-md-2 col-form-label text-md-right">Código Cliente</label>

                            <div class="col-md-4">
                                <input id="code_client" type="text" class="form-control @error('code_client') is-invalid @enderror" name="code_client" value="{{ $var->code_client }}" required autocomplete="code_client" autofocus>

                                @error('code_client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="razon_social" class="col-md-2 col-form-label text-md-right">Razón Social</label>

                            <div class="col-md-4">
                                <input id="razon_social" type="text" class="form-control @error('razon_social') is-invalid @enderror" name="razon_social" value="{{ $var->razon_social }}" required autocomplete="razon_social">

                                @error('razon_social')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $var->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="cedula_rif" class="col-md-2 col-form-label text-md-right">Cédula o Rif</label>

                            <div class="col-md-4">
                                <input id="cedula_rif" type="text" class="form-control @error('cedula_rif') is-invalid @enderror" name="cedula_rif" value="{{ $var->cedula_rif }}" required autocomplete="cedula_rif">

                                @error('cedula_rif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-2 col-form-label text-md-right">Pais</label>

                            <div class="col-md-4">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $var->country }}" required autocomplete="country">

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="city" class="col-md-2 col-form-label text-md-right">Ciudad</label>

                            <div class="col-md-4">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $var->city }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="direction" class="col-md-2 col-form-label text-md-right">Dirección</label>

                            <div class="col-md-4">
                                <input id="direction" type="text" class="form-control @error('direction') is-invalid @enderror" name="direction" value="{{ $var->direction }}" required autocomplete="direction">

                                @error('direction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="balance" class="col-md-2 col-form-label text-md-right">Saldo</label>

                            <div class="col-md-4">
                                <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ $var->balance }}" required autocomplete="balance">

                                @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone1" class="col-md-2 col-form-label text-md-right">Teléfono</label>

                            <div class="col-md-4">
                                <input id="phone1" type="text" class="form-control @error('phone1') is-invalid @enderror" name="phone1" value="{{ $var->phone1 }}" required autocomplete="phone1">

                                @error('phone1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="phone2" class="col-md-2 col-form-label text-md-right">Teléfono 2</label>

                            <div class="col-md-4">
                                <input id="phone2" type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ $var->phone2 }}" required autocomplete="phone2">

                                @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Tiene Crédito</label>

                            <div class="form-check">
                                @if($var->has_credit == 1)
                                    <input class="form-check-input position-static" type="checkbox" id="has_credit" name="has_credit" value="true" checked aria-label="...">
                                @else
                                    <input class="form-check-input position-static" type="checkbox" id="has_credit" name="has_credit"  aria-label="...">
                                @endif
                            </div>
                              
                              <label for="days_credit" class="col-md-2 col-form-label text-md-right">Dias de Crédito</label>

                              <div class="col-md-2">
                                  <input id="days_credit" type="number" class="form-control @error('days_credit') is-invalid @enderror" name="days_credit" value="{{ $var->days_credit }}" required autocomplete="days_credit">
  
                                  @error('days_credit')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount_max_credit" class="col-md-2 col-form-label text-md-right">Monto Máximo de Crédito</label>

                            <div class="col-md-4">
                                <input id="amount_max_credit" type="number" class="form-control @error('amount_max_credit') is-invalid @enderror" name="amount_max_credit" value="{{ $var->amount_max_credit }}" required autocomplete="amount_max_credit">

                                @error('amount_max_credit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                              
                              <label for="balance" class="col-md-2 col-form-label text-md-right">Saldo</label>

                              <div class="col-md-4">
                                  <input id="balance" type="number" class="form-control @error('balance') is-invalid @enderror" name="balance" value="{{ $var->balance }}" required autocomplete="balance">
  
                                  @error('balance')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="retencion_iva" class="col-md-2 col-form-label text-md-right">Retención <br>de Iva</label>

                            <div class="col-md-4">
                                <input id="retencion_iva" type="number" class="form-control @error('retencion_iva') is-invalid @enderror" name="retencion_iva" value="{{ $var->retencion_iva }}" required autocomplete="retencion_iva">

                                @error('retencion_iva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                              
                              <label for="retencion_islr" class="col-md-2 col-form-label text-md-right">Retención de ISLR</label>

                              <div class="col-md-4">
                                  <input id="retencion_islr" type="number" class="form-control @error('retencion_islr') is-invalid @enderror" name="retencion_islr" value="{{ $var->retencion_islr }}" required autocomplete="retencion_islr">
  
                                  @error('retencion_islr')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                        </div>
                        <div class="form-group row">
                            <label for="seller" class="col-md-2 col-form-label text-md-right">Vendedor</label>

                            <div class="col-md-4">
                                <input id="seller" type="text" class="form-control @error('seller') is-invalid @enderror" name="seller" value="{{ $var->seller }}" required autocomplete="seller" autofocus>

                                @error('seller')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                              
                            <label for="segmento" class="col-md-2 col-form-label text-md-right">Status</label>
                            <div class="col-md-4">
                                <select class="form-control" id="status" name="status" title="status">
                                    @if($var->status == 1)
                                        <option value="1">Activo</option>
                                    @else
                                        <option value="0">Inactivo</option>
                                    @endif
                                    <option value="nulo">----------------</option>
                                    
                                    <div class="dropdown">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </div>
                                    
                                    
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="form-group col-sm-2">
                            </div>    
                            <div class="form-group col-sm-4">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-send-o"></i>Actualizar</button>
                            </div>
                            <div class="form-group col-sm-4">
                                <a href="{{ route('clients') }}" name="danger" type="button" class="btn btn-danger btn-block">Cancelar</a>
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
        soloAlfaNumerico('code_client');
        soloAlfaNumerico('razon_social');
        sololetras('name');
        soloNumeros('cedula_rif');
        sololetras('country');
        sololetras('city');
        soloAlfaNumerico('direction');
        soloNumeros('phone1');
        soloNumeros('phone2');
        sololetras('seller');
    });
    </script>
@endsection