@extends('layouts.dashboard')

@section('content')

   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Fórmulas de Nóminas Registradas</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('nominaformulas.create')}}" class="btn btn-primary float-md-right" role="button" aria-pressed="true">Registrar una Fórmula</a>
         
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
                
                <th>Descripción</th>
                <th>Tipo de Fórmula</th>
                <th></th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($nomina_formulas))
                @else
                    @foreach ($nomina_formulas as $key => $nomina_formula)
                    <tr>
                    
                    <td>{{$nomina_formula->description}}</td>
                    <td>{{$nomina_formula->type}}</td>
                    
                    @if (Auth::user()->role_id  == '1')
                        <td>
                            <a href="{{route('nominaformulas.edit',$nomina_formula->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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
        'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]],
        'iDisplayLength': '50'
    });
    </script> 
@endsection