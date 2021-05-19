@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro de Anticipo</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('anticipos.store') }}">
                        @csrf
                        
                        <input id="id_user" type="hidden" class="form-control @error('id_user') is-invalid @enderror" name="id_user" value="{{ Auth::user()->id }}" required autocomplete="id_user">
                        <input id="id_client" type="hidden" class="form-control @error('id_client') is-invalid @enderror" name="id_client" value="{{ $client->id ?? -1 }}" required autocomplete="id_client">
                       
                        <div class="form-group row">
                            <label for="clients" class="col-md-3 col-form-label text-md-right">Cliente</label>
                            <div class="col-md-6">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $client->name ?? '' }}" readonly required autocomplete="client">
    
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a href="{{ route('anticipos.selectclient') }}" title="Seleccionar Cliente"><i class="fa fa-eye"></i></a>  
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="clients" class="col-md-3 col-form-label text-md-right">Cuentas</label>
                            <div class="col-md-6">
                                <select  id="id_account"  name="id_account" class="form-control">
                                    <option selected value="0">Seleccione una Opcion</option>
                                    @foreach($accounts as $account)
                                            <option  value="{{$account->id}}">{{ $account->description }}</option>
                                    @endforeach
                                
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_begin" class="col-md-3 col-form-label text-md-right">Fecha de Inicio</label>

                            <div class="col-md-6">
                                <input id="date_begin" type="date" class="form-control @error('date_begin') is-invalid @enderror" name="date_begin" value="{{ $datenow }}" required autocomplete="date_begin">

                                @error('date_begin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="amount" class="col-md-3 col-form-label text-md-right">Monto</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" placeholder="0,00" required autocomplete="amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reference" class="col-md-3 col-form-label text-md-right">Referencia</label>

                            <div class="col-md-6">
                                <input id="reference" type="text" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ old('reference') }}" required autocomplete="reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                    <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                   Registrar Anticipo
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





	$(function(){
        soloAlfaNumerico('description');
       
    });
    </script>
@endsection