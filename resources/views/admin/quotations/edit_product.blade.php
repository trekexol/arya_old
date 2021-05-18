@extends('layouts.dashboard')

@section('content')
  
   

    {{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>Editar Producto Cotizado</h2></div>
    
                    <div class="card-body">
            <form  method="POST"   action="{{ route('quotations.productupdate',$quotation_product->id) }}" enctype="multipart/form-data" onsubmit="return validacion()">
                @method('PATCH')
                @csrf()
                    <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">Código</label>
                        <div class="col-md-4">
                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ $quotation_product->inventories['code'] ?? old('code') }}" readonly required autocomplete="code" autofocus>
                        </div>
                        <label for="description"  class="col-md-2 col-form-label text-md-right">Descripción</label>
                        <div class="col-md-3">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $inventory->products['description'] ?? old('description') }}" readonly required autocomplete="description">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="cost" class="col-md-2 col-form-label text-md-right">Precio</label>
                        <div class="col-md-4">
                            <input id="cost" type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ $inventory->products['price'] }}" readonly required autocomplete="cost">
                        </div>  
                        <label for="exento" class="col-md-2 col-form-label text-md-right">Exento</label>
                        <div class="col-md-3">
                            @if($inventory->products['exento'] == 1)
                                <input id="exento" type="text" class="form-control @error('exento') is-invalid @enderror" name="exento" value="Si" readonly required autocomplete="exento">
                       
                            @else
                                <input id="exento" type="text" class="form-control @error('exento') is-invalid @enderror" name="exento" value="No" readonly required autocomplete="exento">
                            @endif
                         </div>  
                    </div>
                    
                    
                                <div class="form-group row">
                                    <label for="amount" class="col-md-2 col-form-label text-md-right">Cantidad</label>
        
                                    <div class="col-md-4">
                                        <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ number_format($quotation_product->amount, 0, ',', '.') }}" required autocomplete="amount">
        
                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="discount" class="col-md-2 col-form-label text-md-right">Descuento</label>
        
                                    <div class="col-md-3">
                                        <input id="discount" type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ number_format($quotation_product->discount, 0, ',', '.') }}" required autocomplete="discount">
        
                                        @error('discount')
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
                                           Actualizar Producto Cotizado
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
            $("#discount").mask('000', { reverse: true });
            
        });
        $(document).ready(function () {
            $("#amount").mask('000000000000', { reverse: true });
            
        });


        function validacion() {

            let amount = document.getElementById("amount").value; 

            if (amount < 1) {

                alert('La cantidad del Producto debe ser mayor a 1');
                return false;
            }

            var discount = document.getElementById("discount").value; 

            if ((discount < 0) || (discount > 100)) {

                alert('El descuento debe estar entre 0% y 100%');
                return false;
            }
            
                return true;
           



        }

    </script>
@endsection

