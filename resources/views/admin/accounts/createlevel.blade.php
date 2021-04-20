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
                <div class="card-header">Insertar una nueva Cuenta</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                       
                        <div class="form-group row">
                            <label for="code" class="col-md-2 col-form-label text-md-right">Código</label>

                            <div class="col-md-4">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{$var->code_one}}.{{$var->code_two}}.{{$var->code_three}}.{{$var->code_four}}" required autocomplete="code" readonly autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="level" class="col-md-2 col-form-label text-md-right">Nivel</label>

                            <div class="col-md-4">
                                <input id="level" type="number" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ $var->level+1 }}" required autocomplete="level">

                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-4">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="type" class="col-md-2 col-form-label text-md-right">Tipo</label>

                            <div class="col-md-4">
                            <select class="form-control" name="type" id="type">
                                <option value="Debe">Debe</option>
                                <option value="Haber">Haber</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                           
                            <label for="balance_previus" class="col-md-2 col-form-label text-md-right">Balance Previo</label>

                            <div class="col-md-4">
                                <input id="balance_previus" type="number" class="form-control @error('balance_previus') is-invalid @enderror" name="balance_previus" value="{{ old('balance_previus') }}" required autocomplete="balance_previus">

                                @error('balance_previus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label for="debe" class="col-md-2 col-form-label text-md-right">Debe</label>

                            <div class="col-md-4">
                                <input id="debe" type="number" class="form-control @error('debe') is-invalid @enderror" name="debe" value="{{ old('debe') }}" required autocomplete="debe">

                                @error('debe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="haber" class="col-md-2 col-form-label text-md-right">Haber</label>

                            <div class="col-md-4">
                                <input id="haber" type="number" class="form-control @error('haber') is-invalid @enderror" name="haber" value="{{ old('haber') }}" required autocomplete="haber">

                                @error('haber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar Cuenta
                                </button>
                                <a href="{{ route('accounts') }}" name="danger" type="button" class="btn btn-danger">Cancelar</a>
                           
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('validacion_usuario')
<script>
    
$(function(){
    soloNumeroPunto('code');
    soloAlfaNumerico('description');
    
});

</script>
@endsection