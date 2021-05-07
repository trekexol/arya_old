@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
       
       
        <div class="col-md-2 dropdown mb-4">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Imprimir
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                
                <a class="dropdown-item" href="" style="color: rgb(4, 119, 252)"> <i class="fas fa-download fa-sm fa-fw mr-2 text-blue-400"></i><strong>Imprimir Inventario Actual</strong></a>
                <br>
                <a class="dropdown-item" href="" style="color: rgb(4, 119, 252)"> <i class="fas fa-file-export fa-sm fa-fw mr-2 text-blue-400"></i><strong>Imprimir Historial del Inventario</strong></a>
                
            </div>
        </div>
     
        <div class="col-md-3 dropdown mb-4">
            <button class="btn btn-primary dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Modificar Inventario
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                
                <a class="dropdown-item" href="{{ route('products.create') }}" style="color: rgb(252, 124, 4)"> <i class="fas fa-plus-circle fa-sm fa-fw mr-2 text-blue-400"></i><strong>Añadir Nuevo Producto</strong></a>
                <br>
                <a class="dropdown-item" href="{{ route('inventories.create_increase_inventory') }}" style="color: rgb(252, 124, 4)"> <i class="fas fa-plus fa-sm fa-fw mr-2 text-blue-400"></i><strong>Sumar Cantidad de un Producto</strong></a>
                <br>
                <a class="dropdown-item" href="" style="color: rgb(252, 124, 4)"> <i class="fas fa-minus fa-sm fa-fw mr-2 text-blue-400"></i><strong>Restar Cantidad de un Producto</strong></a>
                
            </div>
        </div>
        
        
       
         
            <div class="col-md-6">
                <a href="{{ route('inventories.select')}}" class="btn btn-success  float-md-right " role="button" aria-pressed="true">Registrar un Inventario</a>
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
                <th>SKU</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Costo</th>
                
                <th>Foto del Producto</th>
                <th>Moneda</th>
              
                
                <th></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($inventories))
                @else  
                    @foreach ($inventories as $var)
                        <tr>
                            <td>{{ $var->code }}</td>
                            <td>{{ $var->products['description']}}</td>
                            <td style="text-align: right">{{ $var->amount }}</td> 
                            <td style="text-align: right">{{number_format($var->products['price'], 2, ',', '.')}}</td>
                            
                            
                            
                            <td>{{ $var->products['photo_product']}}</td> 
                            
                            @if($var->products['money'] == "D")
                            <td>Dolar</td>
                            @else
                            <td>Bolívar</td>
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
