@extends('admin.layouts.dashboard')

@section('content')
  
    <!-- container-fluid -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row py-lg-2">
            <div class="col-md-6">
                <h2>Editar Cuenta</h2>
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

    <div class="card shadow mb-4 ">
        <div class="card-body ">
            <form  method="POST"   action="{{ route('accounts.update',$var->id) }}" enctype="multipart/form-data" >
                @method('PATCH')
                @csrf()
                <div class="container py-2">
                    <div class="row ">
                        <div class="col-12 ">
                                <div class="form-group row ">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">Descripción</label>
        
                                    <div class="col-md-4">
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $var->description }}" required autocomplete="description">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="balance_previus" class="col-md-4 col-form-label text-md-right">Balance Previo</label>
        
                                    <div class="col-md-4">
                                        <input id="balance_previus" type="text" class="form-control @error('balance_previus') is-invalid @enderror" name="balance_previus" value="{{ $var->balance_previus }}" required autocomplete="balance_previus">
        
                                        @error('balance_previus')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="segmento" class="col-md-4 col-form-label text-md-right">Moneda</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="coin" name="coin" title="coin">
                                            @if($var->coin == '$')
                                                <option value="$">Dolar</option>
                                            @else
                                                <option value="BsS">Bolivares</option>
                                            @endif
                                            <option value="nulo">----------------</option>
                                            
                                            <div class="dropdown">
                                                <option value="$">Dolar</option>
                                                <option value="BsS">Bolivares</option>
                                            </div>
                                            
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="rate_form">
                                    <label for="rate" id="rate_label" class="col-md-4 col-form-label text-md-right">Tasa del Dia</label>
        
                                    <div class="col-md-4">
                                        <input id="rate" type="text" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ $rate }}" autocomplete="rate">
        
                                        @error('rate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="segmento" class="col-md-4 col-form-label text-md-right">Status</label>
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
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                           Actualizar Cuenta
                                        </button>
                                        <a href="{{ route('accounts') }}" name="danger" type="button" class="btn btn-danger">Cancelar</a>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
@endsection

@section('validacion_usuario')
<script>
     

    $(function(){
        soloAlfaNumerico('description');
    });

    $(document).ready(function () {
        $("#balance_previus").mask('000.000.000.000.000.000.000,00', { reverse: true });
        
    });
    $(document).ready(function () {
        $("#rate").mask('000.000.000.000.000.000.000,00', { reverse: true });
        
    });
    
    /*$("#rate_form").hide();
   

    $("#coin").on('change',function(){
        var coin = $(this).val();
 
         if(coin == '$'){
             $("#rate_form").show();
            
             
         }else{
             $("#rate_form").hide();
            
         }
    });*/

</script>

@endsection
            