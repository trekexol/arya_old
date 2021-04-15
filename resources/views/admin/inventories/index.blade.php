@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Inventario</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('inventories.select')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar un Inventario</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Inventario</h6>
    </div>
    <div class="card-body">
        <div class="container">
            @if (session('flash'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('flash')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times; </span>
                </button>
            </div>   
        @endif
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr> 
                <th>Código</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Código Comercial</th>
                <th>Tipo</th>
                
                <th>Precio</th>
               
                <th>Foto del Producto</th>
                <th>Moneda</th>
              
                <th>Status</th>
               
                <th>Tools</th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($inventories))
                @else  
                    @foreach ($inventories as $var)
                        <tr>
                            <td>{{ $var->code }}</td>
                            <td>{{ $var->products['description']}}</td>
                            <td>{{ $var->amount }}</td> 

                            <td>{{ $var->products['code_comercial']}}</td>
                            <td>{{ $var->products['type']}}</td>
                            <td>{{ $var->products['price']}}</td>
                            <td>{{ $var->products['photo_product']}}</td> 
                            
                            @if($var->products['money'] == "D")
                            <td>Dolar</td>
                            @else
                            <td>Bolívar</td>
                            @endif

                            @if($var->status == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            
                            <td>
                                <a href="inventories/{{$var->id }}/edit" title="Editar"><i class="fa fa-edit"></i></a>
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
