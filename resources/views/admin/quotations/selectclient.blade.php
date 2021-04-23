@extends('layouts.dashboard')

@section('content')


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
                    
                </tr>
                </thead>
                
                <tbody>
                    @if (empty($clients))
                    @else  
                        @foreach ($clients as $client)
                            <tr>
                                <td>
                                    <a href="{{ route('quotations.createquotationclient',$client->id) }}" title="Editar" style="color: black">{{$client->code_client}}</a>
                                </td>
                               
                                <td>{{$client->razon_social}}</td>
                                <td>{{$client->name}}</td>
                                <td>{{$client->cedula_rif}}</td>
                                <td>{{$client->direction}}</td>
                                <td>{{$client->city}}</td>
                                <td>{{$client->country}}</td>
                                <td>{{$client->phone1}}</td>
                                <td>{{$client->phone2}}</td>
                                
                            </tr>     
                        @endforeach   
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


    
@endsection
