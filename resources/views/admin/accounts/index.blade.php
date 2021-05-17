@extends('layouts.dashboard')

@section('content')

@section('header')
<!-- CSS media query within a style sheet -->
<style>

  body {
   
    zoom: 80%;
  }

</style>
@endsection
<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col dropdown mb-4">
            <button class="btn btn-light2 dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-code-branch"></i>
                &nbsp Niveles
            </button>
            <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Nivel 1</a>
                <a class="dropdown-item" href="#">Nivel 2</a>
                <a class="dropdown-item" href="#">Nivel 3</a>
                <a class="dropdown-item" href="#">Todos</a>
            </div>
        </div>
        <div class="col dropdown mb-4">
            <button class="btn btn-light2 dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fas fa-bars"></i>
                &nbsp Opciones de Cuentas
            </button>
            <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Listado de Cuentas</a>
                <a class="dropdown-item" href="#">Bajar Cuentas a Excel</a>
                <a class="dropdown-item" href="#">Imprimir Cuentas</a>
                <a class="dropdown-item" href="#">Subir Cuentas</a>
            </div>
        </div> 
        <div class="col">
            <a href="#" class="btn btn-light2"><i class="fas fa-eye" ></i>
                &nbsp Ver Ejercicio Anterior
            </a>
        </div>
            <div class="col">
                <a href="#" class="btn btn-light2"><i class="fas fa-times" ></i>
                    &nbsp Cierre de Ejercicio
                </a>
            </div>
            <div class="col">
                <a href="{{ route('accounts.create')}}" class="btn btn-light2" role="button" aria-pressed="true">
                    <i class="fas fa-pencil-alt" ></i>
                    &nbsp Registrar una Cuenta
                </a>
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
               
                <th style="text-align: right; ">Código</th>
                <th style="text-align: right; ">Descripción</th>
                <th style="text-align: right; ">Nivel</th>
                <th style="text-align: right; ">Tipo</th>
                
                <th style="text-align: right; ">Saldo Anterior</th>
                <th style="text-align: right; ">Debe</th>
                <th style="text-align: right; ">Haber</th>
                <th style="text-align: right; ">Saldo Actual</th>
               
                <th style="text-align: right; "></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($accounts))
                @else  
                <?php
                    $intercalar = true;
                ?>
               
                    @foreach ($accounts as $account)
                        <tr>
                        @if($intercalar)
                        <?php $intercalar = false;?>
                            <td style="text-align:right; color:black; font-weight: bold;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="text-align:right; color:black; ">{{$account->description}}</td>
                            <td style="text-align:right; color:black; ">{{$account->level}}</td>
                            <td style="text-align:right; color:black; ">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black; ">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                           @if ($account->status == "M")
                            <td style="text-align:right; color:black; ">
                            <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold;" title="Ver Movimientos">{{number_format($account->debe, 2, ',', '.')}}</a>
                       
                            </td>
                            <td style="text-align:right; color:black; ">
                                <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold;" title="Ver Movimientos">{{number_format($account->haber, 2, ',', '.')}}</a>
                            </td>
                           @else
                            <td style="text-align:right; color:black;">{{number_format($account->debe, 2, ',', '.')}}</td>
                            <td style="text-align:right; color:black;">{{number_format($account->haber, 2, ',', '.')}}</td>
                           @endif
                            

                            
                            <td style="text-align:right; color:black; ">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                            
                            <td style="text-align:right; color:black; ">  
                                <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>   

                        @else
                            <?php $intercalar = true; ?>

                            <td style="text-align:right; color:black; font-weight: bold;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="text-align:right; color:black;">{{$account->description}}</td>
                            <td style="text-align:right; color:black;">{{$account->level}}</td>
                            <td style="text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black;">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                            @if ($account->status == "M")
                                <td style="text-align:right; color:black; ">
                                <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold;" title="Ver Movimientos">{{number_format($account->debe, 2, ',', '.')}}</a>
                        
                                </td>
                                <td style="text-align:right; color:black; ">
                                    <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold;" title="Ver Movimientos">{{number_format($account->haber, 2, ',', '.')}}</a>
                                </td>
                            @else
                                <td style="text-align:right; color:black;">{{number_format($account->debe, 2, ',', '.')}}</td>
                                <td style="text-align:right; color:black;">{{number_format($account->haber, 2, ',', '.')}}</td>
                            @endif

                            <td style="text-align:right; color:black;">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                                <td style="text-align:right; color:black;">
                                <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus"></i></a>
                             </td>
                        </tr>   
                        @endif  
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
        "order": []
    });
    </script> 
@endsection