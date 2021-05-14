@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Seleccione un Producto</h2>
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
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr> 
                <th>Seleccionar</th>
                <th>Segmento</th>
                <th>Sub Segmento</th>
                <th>Unidad de Medida</th>
                <th>Código Comercial</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Precio de Compra</th>
                <th>Costo Promedio</th>
                <th>Foto del Producto</th>
                <th>Moneda</th>
                <th>Exento</th>
                <th>ISLR</th>
                <th>Impuesto Especial</th>
                <th>Status</th>
               
                <th>Tools</th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($products))
                @else  
                    @foreach ($products as $product)
                        <tr>
                            <td>
                            <a href="{{$product->id}}/create" title="Editar"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>{{$product->segments['description']}}</td>
                            <td>{{$product->subsegments['description']}}</td> 
                            <td>{{$product->unitofmeasures['description']}}</td> 
                            <td>{{$product->code_comercial}}</td>
                            <td>{{$product->type}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->price_buy}}</td>
                            <td>{{$product->cost_average}}</td>
                            <td><img src="{{ asset('/storage/descarga.jpg') }} " ></td>

                            @if($product->money == "D")
                                <td>Dolar</td>
                            @else
                                <td>Bolívar</td>
                            @endif
                            @if($product->exento == "1")
                                <td>Si</td>
                            @else
                                <td>No</td>
                            @endif
                            @if($product->islr == "1")
                                <td>Si</td>
                            @else
                                <td>No</td>
                            @endif
                            
                            <td>{{$product->special_impuesto}}</td>
                           
                            
                            @if($product->status == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            
                            <td>
                                <a href="{{$product->id}}/create" title="Editar"><i class="fa fa-edit"></i></a>
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
