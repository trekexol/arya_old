@extends('layouts.dashboard')

@section('content')

 {{-- VALIDACIONES-RESPUESTA--}}
 @include('admin.layouts.success')   {{-- SAVE --}}
 @include('admin.layouts.danger')    {{-- EDITAR --}}
 @include('admin.layouts.delete')    {{-- DELELTE --}}
 {{-- VALIDACIONES-RESPUESTA --}}
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold h3">
                    Agregar Concepto
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nominacalculations.store') }}">
                        @csrf

                        <input type="hidden" name="id_nomina" value="{{$nomina->id}}" readonly>
                        <input type="hidden" name="id_employee" value="{{$employee->id}}" readonly>
                        

                        <div class="form-group row">
                            <label for="nominaconcept" class="col-md-2 col-form-label text-md-right">Concepto:</label>
                            <div class="col-md-4">
                                <select  id="id_nomina_concept"  name="id_nomina_concept" class="form-control">
                                    @foreach($nominaconcepts as $nominaconcept)
                                            <option selected value="{{$nominaconcept->id}}">{{ $nominaconcept->abbreviation  }} - {{ $nominaconcept->description }}</option>
                                       @endforeach
                                   
                                </select>
                            </div>
                           
                        </div>
                        <div class="form-group row">
                            <label for="hours" class="col-md-2 col-form-label text-md-right">Horas:</label>

                            <div class="col-md-4">
                                <input id="hours" type="text" class="form-control @error('hours') is-invalid @enderror" name="hours"  required autocomplete="hours">

                                @error('hours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="days" class="col-md-2 col-form-label text-md-right">Dias:</label>

                            <div class="col-md-4">
                                <input id="days" type="text" class="form-control @error('days') is-invalid @enderror" name="days"  required autocomplete="days">

                                @error('days')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cantidad" class="col-md-2 col-form-label text-md-right">Cantidad:</label>

                            <div class="col-md-4">
                                <input id="cantidad" type="text" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"  required autocomplete="cantidad">

                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="amount" class="col-md-2 col-form-label text-md-right">Monto:</label>

                            <div class="col-md-4">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="0,00" required autocomplete="amount">

                                @error('amount')
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
                                   Registrar Concepto
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

        $(document).ready(function () {
            $("#amount").mask('000.000.000.000.000,00', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#hours").mask('000', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#days").mask('000', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#cantidad").mask('000.000', { reverse: true });
            
        });
    </script>
@endsection 
