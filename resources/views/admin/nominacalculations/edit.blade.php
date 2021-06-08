@extends('layouts.dashboard')

@section('content')
  
    <!-- container-fluid -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>Editar Nómina</h2>
            </div>

        </div>
    </div>
    <!-- /container-fluid -->

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

    <div class="card shadow mb-4">
        <div class="card-body">
            <form  method="POST"   action="{{ route('nominas.update',$var->id) }}" enctype="multipart/form-data" >
                @method('PATCH')
                @csrf()
                <div class="container py-2">
                    <div class="row">
                        <div class="col-12 ">
                           
                           
                                <div class="form-group row">
                                    <label for="description" class="col-md-2 col-form-label text-md-right">Concepto</label>
        
                                    <div class="col-md-4">
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $var->nominaconcepts['abbreviation'] }}" maxlength="60" required autocomplete="description">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="hours" class="col-md-2 col-form-label text-md-right">Horas</label>
        
                                    <div class="col-md-4">
                                        <input id="hours" type="text" class="form-control @error('hours') is-invalid @enderror" name="hours" value="{{ $var->hours ?? 0 }}" maxlength="60" required autocomplete="hours">
        
                                        @error('hours')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="days" class="col-md-2 col-form-label text-md-right">Dias</label>
        
                                    <div class="col-md-4">
                                        <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ $var->days ?? 0 }}" maxlength="60" required autocomplete="days">
        
                                        @error('days')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="days" class="col-md-2 col-form-label text-md-right">Dias</label>
        
                                    <div class="col-md-4">
                                        <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days" value="{{ $var->days ?? 0 }}" maxlength="60" required autocomplete="days">
        
                                        @error('days')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                               
                            <br>
                                <div class="form-group row justify-content-center">
                                    <div class="form-group col-sm-2">
                                        <button type="submit" class="btn btn-info btn-block"><i class="fa fa-send-o"></i>Registrar</button>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <a href="{{ route('nominas') }}" name="danger" type="button" class="btn btn-danger btn-block">Cancelar</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    @endsection

                    @section('validacion')
                    <script>    
                    $(function(){
                        soloAlfaNumerico('description');
                       
                    });
                    </script>
                @endsection