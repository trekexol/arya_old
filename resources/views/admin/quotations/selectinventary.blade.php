@extends('layouts.dashboard')

@section('content')

<div class="container-fluid">
    <div class="row py-lg-2">
       
        <div class="col-md-6">
            <h2>Seleccione un Producto del Inventario</h2>
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
                <th></th>
                <th>SKU</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Costo</th>
                
                <th>Foto del Producto</th>
                <th>Moneda</th>
              
                
                
            </tr>
            </thead>
            
            <tbody>
                @if (empty($inventories))
                @else  
                    @foreach ($inventories as $var)
                        <tr>
                            <td>
                                <a href="{{ route('quotations.createproduct',[$id_quotation,$var->id]) }}" title="Seleccionar"><i class="fa fa-check"></i></a>
                            </td>
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

                           
                            
                        </tr>     
                    @endforeach   
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
  
@endsection
@section('javascript')
     <script>
        $('#dataTable').DataTable({
            "ordering": false,
            "order": [],
            'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]],
            'iDisplayLength': '50'
        });
        </script> 
@endsection
