@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Proveedores</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('providers.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar Cliente</a>
      </div>
    </div>
</div>
  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Proveedores</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr> 
                    <th>Código Proveedor</th>
                    <th>Razón Social</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Pais</th>
                    <th>Telefono</th>
                    <th>Telefono 2</th>
                    <th>Tiene Crédito</th>
                    <th>Dias de Crédito</th>
                    <th>Monto Máximo de Crédito</th>
                    <th>Porcentaje de Retención de Iva</th>
                    <th>Retiene ISLR</th>
                    <th>Saldo</th>
                    <th>Status</th>
                    <th>Tools</th>
                </tr>
                </thead>
                
                <tbody>
                    @if (empty($providers))
                    @else  
                        @foreach ($providers as $var)
                            <tr>
                                <td>{{$var->code_provider}}</td>
                                <td>{{$var->razon_social}}</td>
                                <td>{{$var->direction}}</td>
                                <td>{{$var->city}}</td>
                                <td>{{$var->country}}</td>
                                <td>{{$var->phone1}}</td>
                                <td>{{$var->phone2}}</td>
                                <td>{{$var->has_credit}}</td>
                                <td>{{$var->days_credit}}</td>
                                <td>{{$var->amount_max_credit}}</td>
                                <td>{{$var->porc_retencion_iva}}</td>
                                <td>{{$var->retiene_islr}}</td>
                                <td>{{$var->balance}}</td>
                                <td>{{$var->status}}</td>
                                
                                <td>
                                    <a href="providers/{{$var->id }}/edit" title="Editar"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>     
                        @endforeach   
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


    
@endsection
