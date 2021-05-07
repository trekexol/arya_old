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
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Aumentar Inventario de un Producto</h2>
        </div>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('inventories.store_increase_inventory') }}" enctype="multipart/form-data">
                        @csrf

                        @if (empty($inventary))
                        <div class="form-group row">
                                <label for="inventaries" class="col-md-2 col-form-label text-md-right">Inventario</label>

                                <div class="col-md-4">
                                    <select class="form-control" id="inventaries" name="inventaries">
                                        <option value="-1">Seleccione un Inventario</option>
                                        @foreach($inventaries as $var)
                                            <option value="{{ $var->id }}">{{ $var->description }}</option>
                                        @endforeach
                                    
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="products" class="col-md-2 col-form-label text-md-right">Productos</label>
                                    <div class="col-md-4">
                                        <select id="products"  name="products" class="form-control">
                                                <option selected style="backgroud-color:blue;" value="{{$product->id}}"><strong>{{ $product->description }}</strong></option>
                                            
                                            <option class="hidden" disabled data-color="#A0522D" value="-1">------------------</option>
                                            @foreach($products as $var)
                                                <option value="{{ $var->id }}" > {{ $var->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> 
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="code" class="col-md-2 col-form-label text-md-right">Código</label>

                            <div class="col-md-4">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $product->code_comercial ?? ''}}" required autocomplete="code">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> <label for="cantidad" class="col-md-2 col-form-label text-md-right">Cantidad</label>
                            <div class="col-md-3">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="" required autocomplete="amount">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                        </div>

                       
                           
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">Precio</label>

                            <div class="col-md-4">
                                <input id="price" type="text" readonly class="form-control @error('price') is-invalid @enderror" name="price" value="{{number_format($product->price ?? 0, 2, ',', '.')}} " required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="money" class="col-md-2 col-form-label text-md-right">Moneda</label>

                            @if (!empty($product))
                            <div class="col-md-3">
                                @if($product->money == "D")
                                    <input id="money" type="text" readonly class="form-control @error('money') is-invalid @enderror" name="money" value="Dolar" required autocomplete="money">
                                @else
                                    <input id="money" type="text" readonly class="form-control @error('money') is-invalid @enderror" name="money" value="Bolívares" required autocomplete="money">
                                @endif
                                @error('money')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @endif
                        </div>

                        
                     
                        
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Actualizar Inventario
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
        soloAlfaNumerico('code');
       
    });
    </script>
@endsection

@section('javascript')
    <script>
            
            $("#products").on('change',function(){
                var producto_id = $(this).val();

                //document.getElementById("code").value = producto_id; 
                
                window.location = "{{route('inventories.create_increase_inventory_with_product', '')}}"+"/"+producto_id;
                          
            });
</script>
@endsection