@extends('layouts.dashboard')

@section('content')

@section('header')


<!-- CSS media query within a style sheet -->
<style>

  body {
   
    zoom: 90%;
  }

</style>
@endsection

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



<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-12" >
            <div class="card" style="width: 70rem;" >
                <div class="card-header" ><h3>Registro de Cotización</h3></div>

                <div class="card-body" >
                   
                       
                        <input id="id_user" type="hidden" class="form-control @error('id_user') is-invalid @enderror" name="id_user" value="{{ Auth::user()->id }}" readonly required autocomplete="id_user">
                       
                        
                        <div class="form-group row">
                            <label for="date_quotation" class="col-md-2 col-form-label text-md-right">Fecha de Cotización:</label>
                            <div class="col-md-4">
                                <input id="date_quotation" type="date" class="form-control @error('date_quotation') is-invalid @enderror" name="date_quotation" value="{{ $quotation->date_quotation ?? $datenow }}" readonly required autocomplete="date_quotation">
    
                                @error('date_quotation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="client" class="col-md-2 col-form-label text-md-right">Cliente:</label>
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
                            <label for="vendor" class="col-md-3 col-form-label text-md-right">Vendedor:</label>
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
                            <label for="transports" class="col-md-2 col-form-label text-md-right">Transporte:</label>
                            <div class="col-md-4">
                                <input id="transport" type="text" class="form-control @error('transport') is-invalid @enderror" name="transport" value="{{ $quotation->transports['placa'] ?? old('transport') }}" readonly required autocomplete="transport"> 
                           
                                @error('transport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="observation" class="col-md-2 col-form-label text-md-right">Observaciones:</label>

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
                            <label for="note" class="col-md-2 col-form-label text-md-right">Nota Pie de Factura:</label>

                            <div class="col-md-4">
                                <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $quotation->note ?? old('note') }}" readonly required autocomplete="note">

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label  class="col-md-2 col-form-label text-md-right"><h6>Total de la<br> Cotización:</h6></label>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="description" id="total"><h3></h3></label>
                            </div>

                        </div>
                        <div class="form-group row" id="formcoin">
                            <label id="coinlabel" for="coin" class="col-md-2 col-form-label text-md-right">Moneda:</label>

                            <div class="col-md-2">
                                <select class="form-control" name="coin" id="coin">
                                    <option value="Dolares">Dolares</option>
                                    <option value="Bolivares">Bolívares</option>
                                    
                                    
                                </select>
                            </div>
                        </div>
                        <br>
                        <form method="POST" action="{{ route('quotations.storeproduct') }}" enctype="multipart/form-data" onsubmit="return validacion()">
                            @csrf
                            <input id="id_quotation" type="hidden" class="form-control @error('id_quotation') is-invalid @enderror" name="id_quotation" value="{{ $quotation->id ?? -1}}" readonly required autocomplete="id_quotation">
                            <input id="id_inventory" type="hidden" class="form-control @error('id_inventory') is-invalid @enderror" name="id_inventory" value="{{ $inventory->id ?? -1 }}" readonly required autocomplete="id_inventory">
                       
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-2">
                                        <label for="description" >Código</label>
                                        <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $inventory->code ?? old('code') }}" required autocomplete="code" autofocus>
                                    </div>
                                   
                                    <div class="form-group col-md-1">
                                        
                                        <a href="" title="Buscar Producto Por Codigo" onclick="searchCode()"><i class="fa fa-search"></i></a>  
                                    
                                            <a href="{{ route('quotations.selectproduct',$quotation->id) }}" title="Productos"><i class="fa fa-eye"></i></a>  
                                        
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label for="description" >Descripción</label>
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $inventory->products['description'] ?? old('description') }}" readonly required autocomplete="description">
        
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
                                                <input class="form-check-input" type="checkbox" disabled id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Exento
                                                </label>
                                            </div>
                                        @else  
                                            <div class="form-check">
                                                @if($inventory->products['exento'] == 1)
                                                    <input class="form-check-input" type="checkbox" disabled checked id="gridCheck">
                                                @else
                                                    <input class="form-check-input" type="checkbox" disabled id="gridCheck">
                                                @endif
                                                <label class="form-check-label" for="gridCheck">
                                                    Exento
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cost" >Precio</label>
                                        <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $inventory->products['price']  ?? '' }}" readonly required autocomplete="cost">
        
                                        @error('cost')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="discount" >Descuento</label>
                                        <input id="discount_product" type="text" class="form-control  @error('discount') is-invalid @enderror" name="discount" value="0" required autocomplete="discount">
        
                                        @error('discount')
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
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Sub Total</th>
                                        <th><i class="fas fa-cog"></i></th>
                                      
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (empty($inventories_quotations))
                                        @else
                                        <?php
                                            $suma = 0.00;
                                        ?>
                                            @foreach ($inventories_quotations as $var)

                                            <?php
                                            $percentage = (($var->price * $var->amount_quotation) * $var->discount)/100;

                                            $total_less_percentage = ($var->price * $var->amount_quotation) - $percentage;
                                            ?>
                                                <tr>
                                                <td style="text-align: right">{{ $var->code}}</td>
                                                @if($var->exento == 1)
                                                    <td style="text-align: right">{{ $var->description}} (E)</td>
                                                @else
                                                    <td style="text-align: right">{{ $var->description}}</td>
                                                @endif
                                                
                                                <td style="text-align: right">{{ $var->amount_quotation}}</td>
                                                <td style="text-align: right">{{number_format($var->price, 2, ',', '.')}}</td>
                                                <td style="text-align: right">{{number_format($var->discount, 0, '', '.')}}%</td>
                                                <td style="text-align: right">{{number_format($total_less_percentage, 2, ',', '.')}}</td>
                                                <?php
                                                    $suma += $total_less_percentage;
                                                ?>
                                                    <td style="text-align: right">
                                                    <a href="{{ route('quotations.productedit',$var->quotation_products_id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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
                                    <a onclick="deliveryNote()" id="btnNote" name="btnfacturar" class="btn btn-info" title="facturar">Procesar como Nota de Entrega</a>  
                                    <a onclick="deliveryNoteSend()" id="btnSendNote" name="btnfacturar" class="btn btn-info" title="facturar">Nota de Entrega</a>  
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('quotations.createfacturar',$quotation->id ?? -1) }}" id="btnfacturar" name="btnfacturar" class="btn btn-success" title="facturar">Facturar</a>  
                                </div>
                               
                            </div>
                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

    <script>

        $(document).ready(function () {
            $("#discount_product").mask('000', { reverse: true });
            
        });
        
        $(document).ready(function () {
            $("#amount_product").mask('00000', { reverse: true });
            
        });


        $('#dataTable').DataTable({
            "order": []
        });

       // document.querySelector('#total').innerText = {{number_format($suma, 2, ',', '.')}};
       
        document.querySelector('#total').innerText = {{$suma * 100}};

        $(document).ready(function () {
            $("#total").mask('000.000.000.000.000,00', { reverse: true });
            
        });

    </script> 

@endsection         

@section('validacion')

    <script>
    var coin = "Bolivares";

    $("#coin").on('change',function(){
        
         coin = $(this).val();
       
    });

    function deliveryNoteSend() {
       
       window.location = "{{route('quotations.createdeliverynote', [$quotation->id,''])}}"+"/"+coin;
                          
    }


    function validacion() {

        let amount = document.getElementById("amount_product").value; 

        if (amount < 1) {
        
        alert('La cantidad del Producto debe ser mayor a 1');
        return false;
        }
        else {
            return true;
        }
    
    
        
    }
    </script> 

@endsection    

@section('consulta')
    <script>
        $("#formcoin").hide();
        $("#btnSendNote").hide();

        function deliveryNote(){
            $("#formcoin").show();
            $("#btnSendNote").show();
            $("#btnNote").hide();
        }

        function searchCode(){
            
            let reference_id = document.getElementById("code").value; 
            
            
            $.ajax({
                
                url:"{{ route('quotations.listinventory') }}" + '/' + reference_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                 
                    
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,description,date} = item;
                          
                           window.location = "{{route('quotations.createproduct', [$quotation->id,''])}}"+"/"+id;
                           //inputDescription.value = description;
                           //inputDate.value = date;
                        });
                    }else{
                        alert('No se Encontro este numero de Referencia');
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                   
                   
                
                },
                error:(xhr)=>{
                    alert('Presentamos Inconvenientes');
                }
            })
        }

    </script>
@endsection

