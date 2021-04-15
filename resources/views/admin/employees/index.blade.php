@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Empleados</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('employees.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar Empleado</a>
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
        <h6 class="m-0 font-weight-bold text-primary">Empleado</h6>
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
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Código de Empleado</th>
                <th>Monto de Utilidades</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Egreso</th>
                <th>Fecha.Nac</th>
                <th>Dirección</th>
                <th>Monto de Pago</th>
                <th>Correo Electronico</th>
                <th>Acumulado Prestaciones</th>
                <th>Acumulado Utilidades</th>
                <th>Status</th>
                <th>Centro Costo</th>
                <th>Tools</th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($employees))
                @else  
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{$employee->id_empleado}}</td>
                            <td>{{$employee->nombres}}</td>
                            <td>{{$employee->apellidos}}</td>
                            <td>{{$employee->telefono1}}</td>
                            <td>{{$employee->code_employee}}</td>

                            @if($employee->amount_utilities == "Ma")
                                <td>Máximo</td>
                            @else
                                <td>Mínimo</td>
                            @endif

                            <td>{{$employee->fecha_ingreso}}</td>
                            <td>{{$employee->fecha_egreso}}</td>
                            <td>{{$employee->fecha_nacimiento}}</td>
                            <td>{{$employee->direccion}}</td>
                            <td>{{$employee->monto_pago}}</td>
                            <td>{{$employee->email}}</td>
                            
                            <td>{{$employee->acumulado_prestaciones}}</td>
                            <td>{{$employee->acumulado_utilidades}}</td>
                            
                            @if($employee->status == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            
                            <td>{{$employee->centro_cos}}</td>
                            <td>
                                <a href="employees/{{$employee->id }}" title="Ver"><i class="fas fa-file-alt"></i></a>
                                <a href="employees/{{$employee->id }}/edit" title="Editar"><i class="fa fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#deleteModal" data-employeeid="{{$employee->id }}"><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>     
                    @endforeach   
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
@if (empty($employee->id)) 
@else
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estás segura de que quieres eliminar esto?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">Seleccione "eliminar" si realmente desea eliminar este Militante.</div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form method="POST" action="/employees/{{ $employee->id }}">
            @method('DELETE')
            @csrf
            <input type="hidden" id="employee_id" name="employee_id" value="">
            <a class="btn btn-primary"  onclick="$(this).closest('form').submit();">Confirmar</a>
        </form>
        </div>
    </div>
</div>
@endif

    
@endsection
@section('js_modal_employees')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var employee_id = button.data('employeeid') // Extract info from data-* attributes
        // console.log(post_id)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-footer #employee_id').val(employee_id)
        });
        $(document).ready(function() {
            $('#example').DataTable( {
                "order": [[ 5, "desc" ]]
            } );
        } );
   
    </script>
@endsection