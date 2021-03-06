@extends('admin.layouts.dashboard')

@section('content')

<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="home-tab"  href="{{ route('expensesandpurchases') }}" role="tab" aria-controls="home" aria-selected="true">Gastos y Compras</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('expensesandpurchases.index_historial') }}" role="tab" aria-controls="profile" aria-selected="false">Historial</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link active font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('anticipos.index_provider') }}" role="tab" aria-controls="profile" aria-selected="false">Anticipo a Proveedores</a>
    </li>
</ul>

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-4 h4">
            Anticipos a Proveedores
        </div>
        @if ($control != 'index')
            <div class="col-md-2 offset-md-3">
                <a href="{{ route('anticipos.index_provider')}}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="text">Anticipos</span>
                </a>
            </div>
        @else
            <div class="col-md-4 offset-md-1">
                <a href="{{ route('anticipos.historic_provider')}}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-book"></i>
                    </span>
                    <span class="text">Ver Historico de Anticipos</span>
                </a>
            </div>
        @endif
        
        
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-3">
            <a href="{{ route('anticipos.create_provider')}}" class="btn btn-primary" role="button" aria-pressed="true">Registrar un Anticipo</a>
         
        </div>
        @endif
       
            
       
    </div>

  </div>

  {{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th class="text-center">Cliente</th>
                <th class="text-center">Caja/Banco</th>
                <th class="text-center">Fecha del Anticipo</th>
                <th class="text-center">Referencia</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Moneda</th>
               <th class="text-center"></th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($anticipos))
                @else
                    @foreach ($anticipos as $key => $anticipo)
                    <?php 
                        if($anticipo->coin != 'bolivares'){
                            $anticipo->amount = $anticipo->amount / $anticipo->rate;
                        }
                    ?>
                    <tr>
                    <td class="text-center">{{$anticipo->clients['name'] ?? $anticipo->providers['razon_social'] ?? ''}}</td>
                    <td class="text-center">{{$anticipo->accounts['description'] ?? ''}}</td>
                    <td class="text-center">{{$anticipo->date}}</td>
                    <td class="text-center">{{$anticipo->reference ?? ''}}</td>
                    <td class="text-right">{{number_format($anticipo->amount, 2, ',', '.')}}</td>
                    <td class="text-center">{{$anticipo->coin}}</td>
                   
                    @if (Auth::user()->role_id  == '1')
                        <td>
                            <a href="{{ route('anticipos.edit',$anticipo->id) }}"  title="Editar"><i class="fa fa-edit"></i></a>
                        </td>
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
        'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]]
    });
    </script> 
@endsection