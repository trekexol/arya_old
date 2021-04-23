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
            <div class="card" style="width: 70rem;">
                <div class="card-header">Registro de Cotización</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('quotations.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <input id="id_user" type="hidden" class="form-control @error('id_user') is-invalid @enderror" name="id_user" value="{{ Auth::user()->id }}" readonly required autocomplete="id_user">
                       
                        
                        <div class="form-group row">
                            <label for="date_quotation" class="col-md-2 col-form-label text-md-right">Fecha de Cotización</label>
                            <div class="col-md-4">
                                <input id="date_quotation" type="date" class="form-control @error('date_quotation') is-invalid @enderror" name="date_quotation" value="{{ $quotation->date_quotation ?? $datenow }}" readonly required autocomplete="date_quotation">
    
                                @error('date_quotation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="client" class="col-md-2 col-form-label text-md-right">Cliente</label>
                            <div class="col-md-4">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $quotation->clients['name'] ?? $datenow }}" readonly required autocomplete="client">
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="serie" class="col-md-2 col-form-label text-md-right">N° de Control/Serie:</label>

                            <div class="col-md-3">
                                <input id="serie" type="text" class="form-control @error('serie') is-invalid @enderror" name="serie" value="{{ $quotation->serie ?? old('serie') }}" readonly required autocomplete="serie">

                                @error('serie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="vendor" class="col-md-3 col-form-label text-md-right">Vendedor</label>
                            <div class="col-md-4">
                                <input id="vendor" type="text" class="form-control @error('vendor') is-invalid @enderror" name="vendor" value="{{ $quotation->vendors['name'] ?? old('vendor') }}" readonly required autocomplete="vendor">
                                @error('vendor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="transports" class="col-md-2 col-form-label text-md-right">Transporte</label>
                            <div class="col-md-4">
                                <input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport" value="{{ $quotation->transports['placa'] ?? old('transport') }}" readonly required autocomplete="transport"> 
                           
                                @error('transport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="observation" class="col-md-2 col-form-label text-md-right">Observaciones</label>

                            <div class="col-md-4">
                                <input id="observation" type="text" class="form-control @error('observation') is-invalid @enderror" name="observation" value="{{ $quotation->observation ?? old('observation') }}" readonly required autocomplete="observation">

                                @error('observation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="note" class="col-md-2 col-form-label text-md-right">Nota Pie de Factura </label>

                            <div class="col-md-4">
                                <input id="note" type="number" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $quotation->note ?? old('note') }}" readonly required autocomplete="note">

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="date" class="col-md-2 col-form-label text-md-right"><h6>Total de la Cotización</h6></label>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="description" ><h6>200$</h6></label>
                            </div>
                        </div>
                        
                        <br>
                       
                                
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-1">
                                        <label for="description" >Código</label>
                                        <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $product->code_comercial ?? old('code') }}" required autocomplete="code" autofocus>
                                    </div>
                                   
                                    <div class="form-group col-md-1">
                                        <a href="{{ route('quotations.selectproduct') }}" title="Editar"><i class="fa fa-eye"></i></a>  
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="description" >Descripción</label>
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description ?? old('description') }}" required autocomplete="description">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="amount" >Cantidad</label>
                                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"  required autocomplete="amount">
        
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                          <input class="form-check-input" type="checkbox" id="gridCheck">
                                          <label class="form-check-label" for="gridCheck">
                                            Exento
                                          </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cost" >Precio</label>
                                        <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $product->price ?? old('cost') }}" required autocomplete="cost">
        
                                        @error('cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="discount" >Descuento</label>
                                        <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="0.00" required autocomplete="discount">
        
                                        @error('discount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1" style="text-align: center">
                                        <label for="date" >Total</label>
                                        <label for="description"  class="form-control">0$</label>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="submit" title="Agregar"><i class="fa fa-plus"></i></button>  
                                    </div>
                                </div>    
                        </form>      
                               <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                       
                                        <th>Opciones</th>
                                      
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (empty($product_quotations))
                                        @else
                                           
                                            @foreach ($product_quotations as $key => $var)
                                            <tr>
                                           
                                              
                                            <td>{{$var->description}}</td>
                        
                                            <?php
                                                $suma_debe += $var->debe;
                                                $suma_haber += $var->haber;
                                            ?>
                                            <td>{{$var->amount}}</td>
                                            <td>{{$var->cost}}</td>
                                            
                                                <td>
                                                <a href="{{route('product_quotations.edit',$var->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
                                                </td>
                                           
                                            </tr>
                                            @endforeach
                                            <tr>
                                                
                                                @if($suma_debe == $suma_haber)
                                                    <td style="color: rgb(84, 196, 84)">El comprobante está cuadrado</td>
                                                    <td>Total</td>
                                                    <td>{{$suma_debe}}</td>
                                                    <td>{{$suma_haber}}</td>
                                                @else
                                                    <td style="color: red">El comprobante está descuadrado</td>
                                                    <td>Total</td>
                                                    @if ($suma_debe > $suma_haber)
                                                        <td>{{$suma_debe}}  <br><div style="color: red"> - {{$suma_debe - $suma_haber}}</div></td>
                                                        <td>{{$suma_haber}}</td>
                                                    @else
                                                        <td>{{$suma_debe}}</td>
                                                        <td>{{$suma_haber}} <br><div style="color: red"> - {{$suma_haber - $suma_debe}}</div></td>
                                                    @endif
                                                    
                                                @endif
                                                
                            
                                                
                                                
                                                    <td>
                                                    <a href="{{route('detailvouchers.edit',$var->id ?? '') }}" title="Editar"><i class="fa fa-edit"></i></a>  
                                                    </td>
                                               
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                   
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
