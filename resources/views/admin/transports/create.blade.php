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
                <div class="card-header">Registro de Transporte</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('transports.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <input id="user_id" type="hidden" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ Auth::user()->id }}" required autocomplete="user_id">

                        <div class="form-group row">
                            
                            <label for="modelo" class="col-md-2 col-form-label text-md-right">Modelo</label>

                            <div class="col-md-4">
                            <select class="form-control" id="modelo_id" name="modelo_id">
                                @foreach($modelos as $var)
                                    <option value="{{ $var->id }}">{{ $var->description }}</option>
                                @endforeach
                              
                            </select>
                            </div>
                            <label for="color" class="col-md-2 col-form-label text-md-right">Color</label>

                            <div class="col-md-4">
                            <select class="form-control" id="color_id" name="color_id">
                                @foreach($colors as $var)
                                    <option value="{{ $var->id }}">{{ $var->description }}</option>
                                @endforeach
                              
                            </select>
                            </div>
                        </div>
                        
                       
                        <div class="form-group row">
                            <label for="rol" class="col-md-2 col-form-label text-md-right">Tipo</label>

                            <div class="col-md-4">
                            <select class="form-control" name="type" id="type">
                                <option value="Carro">Carro</option>
                                <option value="Camioneta">Camioneta</option>
                                <option value="Camion">Camión</option>
                            </select>
                            </div>
                            <label for="placa" class="col-md-2 col-form-label text-md-right">Placa</label>

                            <div class="col-md-4">
                                <input id="placa" type="text" class="form-control @error('placa') is-invalid @enderror" name="placa" value="{{ old('placa') }}" required autocomplete="placa">

                                @error('placa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="photo_transport" class="col-md-2 col-form-label text-md-right">Foto Transporte</label>

                            <div class="col-md-4">
                                <input id="photo_transport" type="text" class="form-control @error('photo_transport') is-invalid @enderror" name="photo_transport" value="{{ old('photo_transport') }}" required autocomplete="photo_transport">

                                @error('photo_transport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="rol" class="col-md-2 col-form-label text-md-right">Status</label>

                            <div class="col-md-4">
                            <select class="form-control" name="status" id="status">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            </div>
                        </div>
                        
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar Transporte
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
        soloAlfaNumerico('placa');
       
    });
    </script>
@endsection
@section('javascript1')
    <script>
            
            $("#estado").on('change',function(){
                var estado_id = $(this).val();
                $("#municipio").val("");
                $("#parroquia").val("");
                // alert(estado_id);
                getMunicipios(estado_id);
            });

        function getMunicipios(estado_id){
            // alert(`../municipio/list/${estado_id}`);
            $.ajax({
                url:`../municipio/list/${estado_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    let municipio = $("#municipio");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,descripcion} = item;
                            htmlOptions += `<option value='${id}' {{ old('Municipio') == '${id}' ? 'selected' : '' }}>${descripcion}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                    municipio.html('');
                    municipio.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        $("#municipio").on('change',function(){
                var municipio_id = $(this).val();
                var estado_id    = document.getElementById("estado").value;
                getParroquias(municipio_id,estado_id);
            });

        function getParroquias(municipio_id,estado_id){
            // alert(`../parroquia/list/${municipio_id}/${estado_id}`);
            $.ajax({
                url:`../parroquia/list/${municipio_id}/${estado_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    let parroquia = $("#parroquia");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,descripcion} = item;
                            htmlOptions += `<option value='${id}' {{ old('Parroquia') == '${descripcion}' ? 'selected' : '' }} >${descripcion}</option>`

                        });
                    }
                    // console.clear();
                    // console.log(htmlOptions);
                    parroquia.html('');
                    parroquia.html(htmlOptions);
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }
	$(function(){
        soloNumeros('xtelf_local');
        soloNumeros('xtelf_cel');
    });
    
 



    </script>
@endsection
