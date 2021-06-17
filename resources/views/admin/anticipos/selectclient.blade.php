@extends('layouts.dashboard')

@section('content')


  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
  <!-- Page Heading -->
  <div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Seleccionar Cliente</h2>
    </div>
    
  </div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr> 
                    <th></th>
                   
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
                                    <a href="{{ route('anticipos.createclient',$client->id) }}"  title="Seleccionar"><i class="fa fa-check"></i></a>
                               </td>
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
