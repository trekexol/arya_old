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
                <div class="card-header">Registro de Productos</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group row">
                            <label for="prueba" class="col-md-2 col-form-label text-md-right">Prueba</label>

                            <div class="col-md-4">
                                <input id="prueba" type="text" class="form-control @error('prueba') is-invalid @enderror" name="prueba" value="{{ old('prueba') }}" required autocomplete="prueba">

                                @error('prueba')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                                    
                            <label for="segment" class="col-md-2 col-form-label text-md-right">Segmento</label>
                        
                            <div class="col-md-4">
                            <select id="segment"  name="segment" class="form-control" required>
                                <option value="">Seleccione un Segmento</option>
                                @foreach($segments as $index => $value)
                                    <option value="{{ $index }}" {{ old('Segment') == $index ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                                </select>

                                @if ($errors->has('segment_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('segment_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                       
                            <label for="subsegment" class="col-md-2 col-form-label text-md-right">Sub Segmento</label>
                        
                            <div class="col-md-4">
                                <select  id="subsegment"  name="Subsegment" class="form-control" required>
                                    <option value="">Selecciona un Sub Segmento</option>
                                </select>

                                @if ($errors->has('subsegment_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subsegment_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  

                       
                        <div class="form-group row">
                            <label for="unitofmeasure" class="col-md-2 col-form-label text-md-right">Unidad de Medida</label>

                            <div class="col-md-4">
                            <select class="form-control" id="unit_of_measure_id" name="unit_of_measure_id">
                                @foreach($unitofmeasures as $var)
                                    <option value="{{ $var->id }}">{{ $var->description }}</option>
                                @endforeach
                              
                            </select>
                            </div>
                            <label for="code_comercial" class="col-md-2 col-form-label text-md-right">Código Comercial</label>

                            <div class="col-md-4">
                                <input id="code_comercial" type="text" class="form-control @error('code_comercial') is-invalid @enderror" name="code_comercial" value="{{ old('code_comercial') }}" required autocomplete="code_comercial">

                                @error('code_comercial')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label text-md-right">Tipo</label>
                            <div class="col-md-4">
                            <select class="form-control" name="type" id="type">
                                <option value="MERCANCIA">Mercancía</option>
                                <option value="SERVICIO">Servicio</option>
                            </select>
                            </div>
                            <label for="description" class="col-md-2 col-form-label text-md-right">descripción</label>

                            <div class="col-md-4">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">Precio</label>

                            <div class="col-md-4">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="price_buy" class="col-md-2 col-form-label text-md-right">Precio Compra</label>

                            <div class="col-md-4">
                                <input id="price_buy" type="number" class="form-control @error('price_buy') is-invalid @enderror" name="price_buy" value="{{ old('price_buy') }}" required autocomplete="price_buy">

                                @error('price_buy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="cost_average" class="col-md-2 col-form-label text-md-right">Costo Promedio</label>

                            <div class="col-md-4">
                                <input id="cost_average" type="number" class="form-control @error('cost_average') is-invalid @enderror" name="cost_average" value="{{ old('cost_average') }}" required autocomplete="cost_average">

                                @error('cost_average')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="photo_product" class="col-md-2 col-form-label text-md-right">Foto del Producto</label>

                            <div class="col-md-4">
                                <input type="image" src="" alt="" width="48" height="48">
                                @error('photo_product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="money" class="col-md-2 col-form-label text-md-right">Moneda</label>

                            <div class="col-md-4">
                                <select class="form-control" name="money" id="money">
                                    <option value="D">Dolar</option>
                                    <option value="Bs">Bolívares</option>
                                </select>
                            </div>
                            <label for="exento" class="col-md-2 col-form-label text-md-right">exento</label>
                            
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="exento" name="exento" value="1" aria-label="...">
                            </div>
                            <label for="islr" class="col-md-1 col-form-label text-md-right">Islr</label>
                            
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="islr" name="islr" value="1" aria-label="...">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="special_impuesto" class="col-md-2 col-form-label text-md-right">Impuesto Especial</label>

                            <div class="col-md-4">
                                <input id="special_impuesto" type="number" class="form-control @error('special_impuesto') is-invalid @enderror" name="special_impuesto" value="{{ old('special_impuesto') }}" required autocomplete="special_impuesto">

                                @error('special_impuesto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            
                        </div>
                        <p id="valueInput"></p> 
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar Producto
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
        soloAlfaNumerico('code_comercial');
        soloAlfaNumerico('description');
    });
    </script>
@endsection

@section('javascript')
    <script>
            
            $("#segment").on('change',function(){
                var segment_id = $(this).val();
                $("#subsegment").val("");
               
                // alert(segment_id);
                getSubsegment(segment_id);
            });

        function getSubsegment(segment_id){
            // alert(`../subsegment/list/${segment_id}`);
            $.ajax({
                url:`../subsegment/list/${segment_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    let subsegment = $("#subsegment");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            htmlOptions += `<option value='${id}' {{ old('Subsegment') == '${id}' ? 'selected' : '' }}>${description}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                    subsegment.html('');
                    subsegment.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        $("#subsegment").on('change',function(){
                var subsegment_id = $(this).val();
                var segment_id    = document.getElementById("segment").value;
                
            });

        
	$(function(){
        soloNumeros('xtelf_local');
        soloNumeros('xtelf_cel');
    });
    
 



    </script>
@endsection

@section('consulta')
    <script>
            
            $("#prueba").on('keyup',function(){
               /* let inputValue = document.getElementById("prueba").value; 
                document.getElementById("valueInput").innerHTML = inputValue; */
                var segment_id = $(this).val();
                $("#subsegment").val("");
               
                // alert(segment_id);
                getSubsegment(segment_id);
            });

        function getSubsegment(segment_id){
            // alert(`../subsegment/list/${segment_id}`);
            $.ajax({
                url:`../subsegment/list/${segment_id}`,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                    let subsegment = $("#subsegment");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            htmlOptions += `<option value='${id}' {{ old('Subsegment') == '${id}' ? 'selected' : '' }}>${description}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                    subsegment.html('');
                    subsegment.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        $("#subsegment").on('change',function(){s
                var subsegment_id = $(this).val();
                var segment_id    = document.getElementById("prueba").value;
                
            });

        
	$(function(){
        soloNumeros('xtelf_local');
        soloNumeros('xtelf_cel');
    });
    
 



    </script>
@endsection

