@extends('layouts.dashboard')

@section('content')

<?php
$suma_debe = 0;
$suma_haber = 0;
?>

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
                <div class="card-header">Registro Comprobante Detalle</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('headervouchers.store') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group row">
                            <label for="reference" class="col-md-2 col-form-label text-md-right">Referencia</label>

                            <div class="col-md-4">
                                <input id="reference" type="number" class="form-control @error('reference') is-invalid @enderror" name="reference" value="{{ $header->reference ?? old('reference') }}" required autocomplete="reference">

                                @error('reference')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('detailvouchers.selectheadervouche') }}" title="Editar"><i class="fa fa-eye"></i></a>    
                                <a href="" title="Editar"><i class="fa fa-trash-alt"></i></a>  
                           
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-4">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $header->description ?? old('description') }}" required autocomplete="description" >
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="date" class="col-md-2 col-form-label text-md-right">Fecha del Comprobante</label>

                            <div class="col-md-4">
                                <input id="date_begin" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $header->date ?? $datenow }}" required autocomplete="date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 offset-md-4">
                                    <button type="submit" class="btn btn-info btn-icon-split">
                                      Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                            <label for="date" class="col-md-2 col-form-label text-md-right"><h5>Total</h5></label>
                            <div class="col-md-2 col-form-label text-md-left">
                                <label for="description" ><h6>{{ $suma_debe - $suma_haber }}</h6></label>
                            </div>
                        </div>
                       
                        
                <form method="POST" action="{{ route('detailvouchers.store') }}" enctype="multipart/form-data">
                    @csrf
                        
                        <input type="hidden" name="id_header_voucher" value="{{$header->id ?? ''}}" readonly>
                        <input type="hidden" name="period" value="{{$account->period ?? ''}}" readonly>
                       
                        <div class="form-row">
                            
                            <div class="form-group col-md-1">
                                <label for="description" >Cuenta</label>
                                <input id="code_one" type="number" class="form-control @error('code_one') is-invalid @enderror" name="code_one" value="{{ $account->code_one ?? old('code_one') }}" required autocomplete="code_one" autofocus>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="description" >.</label>
                                <input id="code_two" type="number" class="form-control @error('code_two') is-invalid @enderror" name="code_two" value="{{ $account->code_two ?? old('code_two') }}" required autocomplete="code_two" autofocus>
                            </div> 
                            <div class="form-group col-md-1">
                                <label for="description" >.</label>
                              <input id="code_three" type="number" class="form-control @error('code_three') is-invalid @enderror" name="code_three" value="{{ $account->code_three ?? old('code_three') }}" required autocomplete="code_three" autofocus>
                            </div>   
                            <div class="form-group col-md-1">
                                <label for="description" >.</label>
                                 <input id="code_four" type="number" class="form-control @error('code_four') is-invalid @enderror" name="code_four" value="{{ $account->code_four ?? old('code_four') }}" required autocomplete="code_four" autofocus>
                            </div>
                            <div class="form-group col-md-1">
                                <a href="{{ route('detailvouchers.selectaccount',$header->id ?? -1) }}" title="Editar"><i class="fa fa-eye"></i></a>  
                            </div>
                            <div class="form-group col-md-2">
                                <label for="description" >Descripción</label>
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $account->description ?? old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="debe" >Debe</label>
                                <input id="debe" type="text" class="form-control @error('debe') is-invalid @enderror" name="debe" value="0.00" required autocomplete="debe">

                                @error('debe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2">
                                <label for="haber" >Haber</label>
                                <input id="haber" type="text" class="form-control @error('haber') is-invalid @enderror" name="haber" value="0.00" required autocomplete="haber">

                                @error('haber')
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Cuenta</th>
                                <th>Descripción</th>
                                <th>Debe</th>
                                <th>Haber</th>
                               
                                <th>Opciones</th>
                              
                            </tr>
                            </thead>
                            
                            <tbody>
                                @if (empty($detailvouchers))
                                @else
                                   
                                    @foreach ($detailvouchers as $key => $var)
                                    <tr>
                                   
                                        @if($var->status == 'N')
                                            <td><i class="fa fa-circle" style="color: rgb(252, 128, 128)"></i> {{$var->code_one}}.{{$var->code_two}}.{{$var->code_three}}.{{$var->code_four}}</td>
                                        @else
                                            <td><i class="fa fa-circle" style="color: rgb(84, 196, 84)"></i> {{$var->code_one}}.{{$var->code_two}}.{{$var->code_three}}.{{$var->code_four}}</td>
                                        @endif

                                    <td>{{$var->description}}</td>
                
                                    <?php
                                        $suma_debe += $var->debe;
                                        $suma_haber += $var->haber;
                                    ?>
                                    <td>{{$var->debe}}</td>
                                    <td>{{$var->haber}}</td>
                                    
                                        <td>
                                        <a href="{{route('detailvouchers.edit',$var->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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

                    <div class="form-group row">
                        <label for="reference" class="col-md-2 col-form-label text-md-right"><i class="fa fa-circle" style="color: rgb(84, 196, 84)"><strong> Contabilizado</strong></i></label>
                        <label for="reference" class="col-md-2 col-form-label text-md-right"><i class="fa fa-circle" style="color: rgb(255, 94, 94)"><strong> No Contabilizado</strong></i></label>
                    </div>

                    <a href="{{route('detailvouchers.contabilizar',$header->id ?? -1) }}" class="btn btn-success" title="Contabilizar">Contabilizar</a>  
                                            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

                       