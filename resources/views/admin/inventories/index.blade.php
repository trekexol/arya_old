@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
       
        <div class="col-md-3">
            <a href="{{ route('products.create')}}" class="btn btn-warning  float-md-right " role="button" aria-pressed="true">Registrar un Producto Nuevo</a>
          </div>
       
        <div class="col-md-2 dropdown mb-4">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Imprimir
            </button>
            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                
                <a class="dropdown-item" onclick="pdfinventory();" style="color: rgb(4, 119, 252)"> <i class="fas fa-download fa-sm fa-fw mr-2 text-blue-400"></i><strong>Imprimir Inventario Actual</strong></a>
                <br>
                <a class="dropdown-item" href="" style="color: rgb(4, 119, 252)"> <i class="fas fa-file-export fa-sm fa-fw mr-2 text-blue-400"></i><strong>Imprimir Historial del Inventario</strong></a>
                
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
        <h3 class="m-0 font-weight-bold">Inventario</h3>
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
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                <a href="{{ route('inventories.create_increase_inventory',$var->id) }}" style="color: blue;" title="Aumentar Inventario"><i class="fa fa-plus"></i></a>
                                <a href="{{ route('inventories.create_decrease_inventory',$var->id) }}" style="color: rgb(248, 62, 62);" title="Disminuir Inventario"><i class="fa fa-minus"></i></a>
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

@section('javascript1')

    <script type="text/javascript">
            function pdfinventory() {
                
                var nuevaVentanainventory = window.open("{{ route('pdf.inventory')}}","ventana","left=800,top=800,height=800,width=1000,scrollbar=si,location=no ,resizable=si,menubar=no");
        
            }
    </script>
     <script>
        $('#dataTable').DataTable({
            "order": [],
            'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]],
            'iDisplayLength': '50'
        });
        </script> 
@endsection
