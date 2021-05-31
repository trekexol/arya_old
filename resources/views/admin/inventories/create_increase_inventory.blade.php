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
    <div class="row py-lg-2 justify-content-center">
        <div class="col-md-6">
            <h2>Aumentar el Inventario de un Producto</h2>
        </div>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('inventories.store_increase_inventory') }}" enctype="multipart/form-data">
                        @csrf

                        <input id="id_inventory" type="hidden" class="form-control @error('id_inventory') is-invalid @enderror" name="id_inventory" value="{{ $inventory->id }}" readonly required autocomplete="id_inventory">
                       
                        <input id="amount_old" type="hidden" class="form-control @error('amount_old') is-invalid @enderror" name="amount_old" value="{{ $inventory->amount }}" readonly required autocomplete="amount_old">
                       

                        <div class="form-group row">
                            <label for="name_product" class="col-md-2 col-form-label text-md-right">Nombre del Producto</label>

                            <div class="col-md-9">
                                <input id="name_product" type="text" class="form-control @error('name_product') is-invalid @enderror" name="name_product" value="{{ $inventory->products['description'] }}" readonly required autocomplete="name_product">

                                @error('name_product')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-2 col-form-label text-md-right">Código</label>

                            <div class="col-md-4">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $inventory->code }}" required readonly autocomplete="code">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> <label for="cantidad" class="col-md-2 col-form-label text-md-right">Cantidad</label>
                            <div class="col-md-3">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $inventory->amount }}" required autocomplete="amount">

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
                                <input id="price" type="text" readonly class="form-control @error('price') is-invalid @enderror" value="{{ number_format($inventory->products['price'], 2, ',', '.')}}" name="price" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="money" class="col-md-2 col-form-label text-md-right">Moneda</label>

                            @if (!empty($inventory))
                            <div class="col-md-3">
                                @if($inventory->products['money'] == "D")
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
                            <div class="form-group row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Inventario
                                     </button>  
                                </div>
                               
                                <div class="col-md-2">
                                    <a href="{{ route('inventories') }}" id="btnreturn" name="btnreturn" class="btn btn-danger" title="facturar">Regresar</a>  
                                </div>
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
            $("#amount").mask('000.000.000', { reverse: true });
            
        });
        

    </script>
@endsection

@section('javascript1')
    <script>
            
          
</script>
@endsection