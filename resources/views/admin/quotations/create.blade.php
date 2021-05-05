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
                <div class="card-header" >Registro de Cotización</div>

                <div class="card-body" >
                   
                       
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
                            <label for="date" class="col-md-2 col-form-label text-md-right"><h6>Total de la<br> Cotización</h6></label>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="description" id="total"><h3></h3></label>
                            </div>
                        </div>
                        
                        <br>
                        <form method="POST" action="{{ route('quotations.storeproduct') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="id_quotation" type="hidden" class="form-control @error('id_quotation') is-invalid @enderror" name="id_quotation" value="{{ $quotation->id ?? -1}}" readonly required autocomplete="id_quotation">
                            <input id="id_product" type="hidden" class="form-control @error('id_product') is-invalid @enderror" name="id_product" value="{{ $product->id ?? -1 }}" readonly required autocomplete="id_product">
                       
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-1">
                                        <label for="description" >Código</label>
                                        <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $product->code_comercial ?? old('code') }}" readonly required autocomplete="code" autofocus>
                                    </div>
                                   
                                    <div class="form-group col-md-1">
                                        <a href="{{ route('quotations.selectproduct',$quotation->id) }}" title="Productos"><i class="fa fa-eye"></i></a>  
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="description" >Descripción</label>
                                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description ?? old('description') }}" readonly required autocomplete="description">
        
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="amount" >Cantidad</label>
                                        <input id="amount" id="cantidadproducto" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount"  required autocomplete="amount">
        
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-1">
                                        @if (empty($product))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" disabled id="gridCheck">
                                                <label class="form-check-label" for="gridCheck">
                                                    Exento
                                                </label>
                                            </div>
                                        @else  
                                            <div class="form-check">
                                                @if($product->exento == 1)
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
                                        <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $product->price ?? old('cost') ?? '' }}" readonly required autocomplete="cost">
        
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
                                        <label for="description" id="totalproducto" readonly class="form-control">0$</label>
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
                                        <th>Descuento</th>
                                        <th>Sub Total</th>
                                        <th><i class="fas fa-cog"></i></th>
                                      
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @if (empty($product_quotations))
                                        @else
                                        <?php
                                            $suma = 0;
                                        ?>
                                            @foreach ($product_quotations as $key => $var)
                                                <tr>
                                                <td style="text-align: right">{{ $var->products['code_comercial']}}</td>
                                                <td style="text-align: right">{{ $var->products['description']}}</td>
                                                <td style="text-align: right">{{ $var->amount}}</td>
                                                <td style="text-align: right">{{ $var->products['price']}}$</td>
                                                <td style="text-align: right">{{ $var->discount}}$</td>
                                                <td style="text-align: right">{{ ($var->products['price'] * $var->amount) - $var->discount}}$</td>
                                                <?php
                                                    $suma += ($var->products['price'] * $var->amount) - $var->discount;
                                                ?>
                                                    <td style="text-align: right">
                                                    <a  title="Editar"><i class="fa fa-edit"></i></a>  
                                                    </td>
                                            
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">-------------</td>
                                                <td style="text-align: right">Total de Cotización</td>
                                                <td style="text-align: right">{{ $suma }}$</td>
                                                
                                                <td style="text-align: right">-------------</td>
                                            
                                                </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <a href="" id="btnimprimir" name="btnimprimir" class="btn btn-info" title="imprimir">Imprimir Factura</a>  
                            <a href="{{ route('quotations.createfacturar',$quotation->id ?? -1) }}" id="btnfacturar" name="btnfacturar" class="btn btn-success" title="facturar">Facturar</a>  
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

<script>

    
$('#dataTable').DataTable({
    "order": []
});

document.querySelector('#total').innerText = {{ $suma }}+'$';

</script> 

@endsection         