@extends('admin.layouts.dashboard')

@section('content')

   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Segmentos Registrados</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('segments.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar un Segmento</a>
         
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
                <th>Id</th>
                <th>Descripción</th>
               <th>Opciones</th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($segments))
                @else
                    @foreach ($segments as $key => $segment)
                    <tr>
                    <td>{{$segment->id}}</td>
                    <td>{{$segment->description}}</td>
                   
                   
                    @if (Auth::user()->role_id  == '1')
                        <td>
                        <a href="{{route('segments.edit',$segment->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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
