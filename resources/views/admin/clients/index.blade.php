@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Clientes</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('clients.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar Cliente</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Clientes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr> 
                    <th>Código Cliente</th>
                    <th>Razón Social</th>
                    <th>Nombre</th>
                    <th>Cedula o Rif</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Pais</th>
                    <th>Telefono</th>
                    <th>Telefono 2</th>
                    <th>Tiene Crédito</th>
                    <th>Dias de Crédito</th>
                    <th>Monto Máximo de Crédito</th>
                    <th>Saldo</th>
                    <th>Retención de Iva</th>
                    <th>Retención de ISLR</th>
                    <th>Vendedor</th>
                    <th>Status</th>
                    <th>Tools</th>
                </tr>
                </thead>
                
                <tbody>
                    @if (empty($clients))
                    @else  
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{$client->code_client}}</td>
                                <td>{{$client->razon_social}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->cedula_rif}}</td>
                                <td>{{$client->direction}}</td>
                                <td>{{$client->city}}</td>
                                <td>{{$client->country}}</td>
                                <td>{{$client->phone1}}</td>
                                <td>{{$client->phone2}}</td>
                                
                                <td>{{$client->has_credit}}</td>
                                <td>{{$client->days_credit}}</td>

                                <td>{{$client->amount_max_credit}}</td>
                                <td>{{$client->balance}}</td>
                                <td>{{$client->retencion_iva}}</td>
                                <td>{{$client->retencion_islr}}</td>
                                <td>{{$client->seller}}</td>

                                <td>{{$client->status}}</td>
                                
                                <td>
                                    <a href="clients/{{$client->id }}/edit" title="Editar"><i class="fa fa-edit"></i></a>
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
