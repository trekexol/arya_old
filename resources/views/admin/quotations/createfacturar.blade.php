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



<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-12" >
            <div class="card" style="width: 70rem;" >
                <div class="card-header" >Facturar</div>

                <div class="card-body" >
                        <div class="form-group row">
                            <label for="date_quotation" class="col-md-2 col-form-label text-md-right">CI/Rif Cliente:</label>
                            <div class="col-md-4">
                                <input id="date_quotation" type="text" class="form-control @error('date_quotation') is-invalid @enderror" name="date_quotation" value="{{ number_format($quotation->clients['cedula_rif'], 0, ',', '.')  ?? '' }}" readonly required autocomplete="date_quotation">

                                @error('date_quotation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="client" class="col-md-2 col-form-label text-md-right">N° de Control/Serie:</label>
                            <div class="col-md-3">
                                <input id="client" type="text" class="form-control @error('client') is-invalid @enderror" name="client" value="{{ $quotation->serie ?? '' }}" readonly required autocomplete="client">
                                @error('client')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="total_factura" class="col-md-2 col-form-label text-md-right">Total Factura:</label>
                            <div class="col-md-4">
                                <input id="total_factura" type="text" class="form-control @error('total_factura') is-invalid @enderror" name="total_factura" value="{{ number_format($quotation->total_factura, 2, ',', '.') ?? 0 }}$" readonly required autocomplete="total_factura">
    
                                @error('total_factura')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="base_imponible" class="col-md-2 col-form-label text-md-right">Base Imponible:</label>
                            <div class="col-md-3">
                                <input id="base_imponible" type="text" class="form-control @error('base_imponible') is-invalid @enderror" name="base_imponible" value="{{ $quotation->base_imponible ?? 0 }}" readonly required autocomplete="base_imponible">
                                @error('base_imponible')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grand_totals" class="col-md-2 col-form-label text-md-right">Total General</label>
                            <div class="col-md-4">
                                <input id="grand_total" type="text" class="form-control @error('grand_total') is-invalid @enderror" name="grand_total" value="{{ $quotation->grand_total ?? old('grand_total') }}" readonly required autocomplete="grand_total"> 
                           
                                @error('grand_total')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="iva" class="col-md-2 col-form-label text-md-right">IVA:</label>
                            <div class="col-md-2">
                            <select class="form-control" name="iva" id="iva">
                                <option value="16">16%</option>
                                <option value="12">12%</option>
                            </select>
                            </div>
                            
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="anticipo" class="col-md-2 col-form-label text-md-right">Menos Anticipo:</label>
                            <div class="col-md-2">
                                <input id="anticipo" type="text" class="form-control @error('anticipo') is-invalid @enderror" name="anticipo" value="{{ old('anticipo') }}" readonly required autocomplete="anticipo"> 
                           
                                @error('anticipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="observation" class="col-md-2 col-form-label text-md-right">Retencion IVA:</label>

                            <div class="col-md-2">
                                <input id="observation" type="text" class="form-control @error('observation') is-invalid @enderror" name="observation" value="{{ old('observation') }}" readonly required autocomplete="observation">

                                @error('observation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="note" class="col-md-2 col-form-label text-md-right">Retencion ISLR:</label>

                            <div class="col-md-2">
                                <input id="note" type="number" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" readonly required autocomplete="note">

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                       
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                                <a href="" id="btnimprimir" name="btnimprimir" class="btn btn-info" title="imprimir">Imprimir Factura</a>  
                            </div>
                            <div class="col-md-4">
                                <a href="" id="btnfacturar" name="btnfacturar" class="btn btn-success" title="facturar">Imprimir Factura Media Carta</a>  
                            </div>
                            <div class="col-md-2">
                                <a href="" id="btnfacturar" name="btnfacturar" class="btn btn-danger" title="facturar">Volver</a>  
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

    
$('#dataTable').DataTable({
    "order": []
});

document.querySelector('#iva').innerText = {{ $quotation->base_imponible }};
</script> 

@endsection         