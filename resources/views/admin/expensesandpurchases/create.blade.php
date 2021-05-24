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
                <div class="card-header text-lg font-weight-bold">Registro de Gastos y Compras</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('expensesandpurchases.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <input id="id_user" type="hidden" class="form-control @error('id_user') is-invalid @enderror" name="id_user" value="{{ Auth::user()->id }}" required  readonly autocomplete="id_user">
                        <input id="id_provider" type="hidden" class="form-control @error('id_provider') is-invalid @enderror" name="id_provider" value="{{ $provider->id ?? ''  }}" required readonly autocomplete="id_provider">
                       
                        
                        <div class="form-group row">
                            <label for="providers" class="col-md-2 col-form-label text-md-right">Proveedor</label>
                            <div class="col-md-3">
                                <input id="provider" type="text" class="form-control @error('provider') is-invalid @enderror" name="provider" value="{{ $provider->razon_social ?? '' }}" readonly required autocomplete="provider">
    
                                @error('provider')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-1">
                                <a href="{{ route('expensesandpurchases.selectprovider') }}" title="Seleccionar Proveedor"><i class="fa fa-eye"></i></a>  
                            </div>
                            <label for="date-begin" class="col-md-2 col-form-label text-md-right">Fecha de Factura</label>
                            <div class="col-md-3">
                                <input id="date-begin" type="date" class="form-control @error('date-begin') is-invalid @enderror" name="date-begin" value="{{ $datenow }}" readonly autocomplete="date-begin">
    
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice" class="col-md-2 col-form-label text-md-right">Factura de Compra:</label>

                            <div class="col-md-3">
                                <input id="invoice" type="text" class="form-control @error('invoice') is-invalid @enderror" name="invoice" value="{{ old('invoice') }}" readonly autocomplete="invoice">

                                @error('invoice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="serie" class="col-md-3 col-form-label text-md-right">N° de Control/Serie:</label>

                            <div class="col-md-3">
                                <input id="serie" type="text" class="form-control @error('serie') is-invalid @enderror" name="serie" value="{{ old('serie') }}" readonly autocomplete="serie">

                                @error('serie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                           
                            <label for="observation" class="col-md-2 col-form-label text-md-right">Observaciones:</label>

                            <div class="col-md-4">
                                <input id="observation" type="text" class="form-control @error('observation') is-invalid @enderror" name="observation" value="{{ old('observation') }}" readonly autocomplete="observation">

                                @error('observation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
                        
                        <form method="POST" action="{{ route('quotations.storeproduct') }}" enctype="multipart/form-data" onsubmit="return validacion()">
                            @csrf
                            <input id="id_quotation" type="hidden" class="form-control @error('id_quotation') is-invalid @enderror" name="id_quotation" value="{{ $quotation->id ?? -1}}" readonly required autocomplete="id_quotation">
                            <input id="id_inventory" type="hidden" class="form-control @error('id_inventory') is-invalid @enderror" name="id_inventory" value="{{ $inventory->id ?? -1 }}" readonly required autocomplete="id_inventory">
                       
                                <div class="form-group row">
                                    <label for="type" class="col-md-2 col-form-label text-md-right">Tipo de Compra</label>
                                
                                    <div class="col-md-4">
                                        <select id="type_form"  name="type_form" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            <option value="1">Inventario de Mercancia</option>
                                            <option value="2">Activos Fijos</option>
                                            <option value="3">Costos</option>
                                            <option value="4">Gastos - Personal</option>
                                            <option value="5">Gastos - Tributos</option>
                                            <option value="6">Gastos - Municipales</option>
                                            <option value="7">Gastos - Administración</option>
                                        </select>
                                    </div>
                                    
                                        <label id="code_inventary_label" for="code_inventary" class="col-md-2 col-form-label text-md-right">Código Inventario:</label>
                                        
                                        <label id="centro_costo_label" for="centro_costo" class="col-md-2 col-form-label text-md-right">Centro Costo:</label>
                                        
                                        <div class="col-md-2">
                                            <input id="code_inventary" type="text" class="form-control @error('code_inventary') is-invalid @enderror" name="code_inventary" value="{{ old('code_inventary') }}"  autocomplete="code_inventary">
            
                                            @error('code_inventary')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <select class="form-control" id="centro_costo" name="centro_costo" title="centro_costo">
                                                <option value="Ninguno">Ninguno</option>
                                                <option value="Matriz">Matriz</option>
                                                <option value="GTI">GTI</option>
                                                <option value="YRE">YRE</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <a id="btn_code_inventary" href="{{ route('expensesandpurchases.selectprovider') }}" title="Buscar un Producto del Inventario"><i class="fa fa-eye"></i></a>  
                                        </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="account" class="col-md-2 col-form-label text-md-right">Cargar a Cuenta</label>
                                
                                    <div class="col-md-4">
                                        <select  id="account"  name="Account" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                        </select>

                                        @if ($errors->has('account'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('account') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="description" >Descripción</label>
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $inventory->products['description'] ?? old('description') }}"  required autocomplete="description">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="amount" >Cantidad</label>
                                        <input id="amount_product"  type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="0" required autocomplete="amount">
        
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        @if (empty($inventory))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Exento
                                                </label>
                                            </div>
                                        @else  
                                            <div class="form-check">
                                                @if($inventory->products['exento'] == 1)
                                                    <input class="form-check-input" type="checkbox" checked id="gridCheck">
                                                @else
                                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                                @endif
                                                <label class="form-check-label" for="gridCheck">
                                                    Exento
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-2">
                                        @if (empty($inventory))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                                <label class="form-check-label" for="gridCheck2">
                                                    Retiene ISLR
                                                </label>
                                            </div>
                                        @else  
                                            <div class="form-check">
                                                @if($inventory->products['exento'] == 1)
                                                    <input class="form-check-input" type="checkbox" checked id="gridCheck2">
                                                @else
                                                    <input class="form-check-input" type="checkbox" id="gridCheck2">
                                                @endif
                                                <label class="form-check-label" for="gridCheck2">
                                                    Retiene ISLR
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="cost" >Precio</label>
                                        <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $inventory->products['price']  ?? '' }}"  required autocomplete="cost">
        
                                        @error('cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                  
                                   
                                    <div class="form-group col-md-1">
                                        <button type="submit" title="Agregar"><i class="fa fa-plus"></i></button>  
                                    </div>
                                </div>    
                        </form>      





                               <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Sub Total</th>
                                        <th><i class="fas fa-cog"></i></th>
                                      
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (empty($expenses_details))
                                        @else
                                        <?php
                                            $suma = 0.00;
                                        ?>
                                            @foreach ($expenses_details as $var)

                                           
                                                <tr>
                                               
                                                @if($var->exento == 1)
                                                    <td style="text-align: right">{{ $var->description}} (E)</td>
                                                @else
                                                    <td style="text-align: right">{{ $var->description}}</td>
                                                @endif
                                                
                                                <td style="text-align: right">{{ $var->amount}}</td>
                                                <td style="text-align: right">{{number_format($var->price, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($var->price * $var->amount, 2, ',', '.')}}</td>
                                                <?php
                                                    $suma += $var->price * $var->amount;
                                                ?>
                                                    <td style="text-align: right">
                                                    <a href="{{ route('quotations.productedit',$var->id_expense) }}" title="Editar"><i class="fa fa-edit"></i></a>  
                                                    </td>
                                            
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">Total</td>
                                                <td style="text-align: right">{{number_format($suma, 2, ',', '.')}}</td>
                                                
                                                <td style="text-align: right">-------------</td>
                                            
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                
                                <div class="col-md-4">
                                    <a id="btnNote" name="btnfacturar" class="btn btn-info" title="facturar">Registrar</a>  
                                </div>
                                
                            </div>
                           
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('consulta')
    <script>
        $("#code_inventary_label").hide();
        $("#code_inventary").hide();
        $("#btn_code_inventary").hide();
        $("#centro_costo_label").hide();
        $("#centro_costo").hide();

        $("#type_form").on('change',function(){
                var type_var = $(this).val();
                
                if(type_var == 1){
                    $("#code_inventary_label").show();
                    $("#code_inventary").show();
                    $("#btn_code_inventary").show();
                    $("#centro_costo_label").hide();
                    $("#centro_costo").hide();
                    
                }else if(type_var != 2){
                    $("#code_inventary_label").hide();
                    $("#code_inventary").hide();
                    $("#btn_code_inventary").hide();
                    $("#centro_costo_label").show();
                    $("#centro_costo").show();
                   
                }else{
                    $("#code_inventary_label").hide();
                    $("#code_inventary").hide();
                    $("#btn_code_inventary").hide();
                    $("#centro_costo_label").hide();
                    $("#centro_costo").hide();
                }
               
               
                searchCode(type_var);
        });

        function searchCode(type_var){

            $.ajax({
                
                url:"{{ route('expensesandpurchases.listaccount') }}" + '/' + type_var,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let account = $("#account");
                    let htmlOptions = `<option value='' >Seleccione..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        
                        response.forEach((item, index, object)=>{
                            let {id,description} = item;
                            htmlOptions += `<option value='${id}' {{ old('Account') == '${id}' ? 'selected' : '' }}>${description}</option>`

                        });
                    }
                    account.html('');
                    account.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos Inconvenientes');
                }
            })
        }
            $("#account").on('change',function(){
                
                var e = document.getElementById("account");
                var text = e.options[e.selectedIndex].text;

                document.getElementById("description").value = text;
                /*var account = $(this).val();
                var segment_id    = document.getElementById("segment").value;*/
                
            });

    </script>
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
    $('#dataTable').dataTable( {
      "ordering": false,
      "order": [],
        'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]],
        'iDisplayLength': '50',
        });
</script>
    
@endsection



