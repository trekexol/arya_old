@extends('admin.layouts.dashboard')

@section('content')


<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        
        <div class="col-sm-2  dropdown mb-4">
            <button class="btn btn-light2 text-dark " type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false"
                aria-expanded="false">
                <div class="small"><i class="fas fa-bars"></i>
                Opciones
                </div>
            </button>
            <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Bajar Cuentas a Excel</a>
                <a class="dropdown-item" href="#">Imprimir Cuentas</a>
            </div>
        </div> 
       
            <div class="col-sm-2">
                <a href="#" class="btn btn-light2 text-dark">
                    <div class="small"><i class="fas fa-times" ></i>
                    Cierre de Ejercicio
                    </div>
                </a>
            </div>
            
            <div class="col-sm-3">
                <a href="{{ route('accounts.create')}}" class="btn btn-light2 text-dark" role="button" aria-pressed="true">
                    
                    <div class="small"><i class="fas fa-pencil-alt" ></i>Registrar una Cuenta</div>
                    
                </a>
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="coin" id="coin">
                    @if(isset($coin))
                        <option disabled selected value="{{ $coin }}">{{ $coin }}</option>
                        <option disabled  value="{{ $coin }}">-----------</option>
                    @else
                        <option disabled selected value="bolivares">Moneda</option>
                    @endif
                    
                    <option  value="bolivares">Bolívares</option>
                    <option value="dolares">Dólares</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="level" id="level">
                    @if(isset($level))
                        <option disabled selected value="{{ $level }}">Nivel {{ $level }}</option>
                        <option disabled  value="{{ $level }}">-----------</option>
                    @else
                        <option disabled selected value="4">Niveles</option>
                    @endif
                    
                    <option  value="1">Nivel 1</option>
                    <option value="2">Nivel 2</option>
                    <option  value="3">Nivel 3</option>
                    <option value="4">Todos</option>
                </select>
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
            <tr > 
               
                <th style="text-align: right;">Código</th>
                <th style="text-align: right;">Descripción</th>
                <th style="text-align: right;">Nivel</th>
                <th style="text-align: right;">Tipo</th>
                
                <th style="text-align: right;">Saldo Anterior</th>
                <th style="text-align: right;">Debe</th>
                <th style="text-align: right;">Haber</th>
                <th style="text-align: right;">Saldo Actual</th>
               
                <th style="text-align: right;"></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($accounts))
                @else  
                    @foreach ($accounts as $account)
                    @if(isset($level))
                        @if($level >= $account->level)
                        <tr>
                            <td style="text-align:right; color:black; font-weight: bold;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="text-align:right; color:black; ">{{$account->description}}</td>
                            <td style="text-align:right; color:black; ">{{$account->level}}</td>
                            <td style="text-align:right; color:black; ">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                           @if ($account->status == "M")
                            <td style="text-align:right; color:black; font-weight: bold;">
                            <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold; text-decoration: underline black;" title="Ver Movimientos">{{number_format($account->debe, 2, ',', '.')}}</a>
                       
                            </td>
                            <td style="text-align:right; color:black; ">
                                <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold; text-decoration: underline black;" title="Ver Movimientos">{{number_format($account->haber, 2, ',', '.')}}</a>
                            </td>
                           @else
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->debe, 2, ',', '.')}}</td>
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->haber, 2, ',', '.')}}</td>
                           @endif
                            

                            
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                            
                                <td style="text-align:right; color:black; ">  
                                    @if($account->code_four == 0)
                                    <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus" style="color: orangered"></i></a>
                                    @endif
                                </td>
                        </tr>   
                        @endif
                    @else
                        <tr>
                            <td style="text-align:right; color:black; font-weight: bold;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="text-align:right; color:black; ">{{$account->description}}</td>
                            <td style="text-align:right; color:black; ">{{$account->level}}</td>
                            <td style="text-align:right; color:black; ">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                            @if ($account->status == "M")
                            <td style="text-align:right; color:black; font-weight: bold;">
                            <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold; text-decoration: underline black;" title="Ver Movimientos">{{number_format($account->debe, 2, ',', '.')}}</a>
                    
                            </td>
                            <td style="text-align:right; color:black; ">
                                <a href="{{ route('accounts.movements',$account->id) }}" style="color: black; font-weight: bold; text-decoration: underline black;" title="Ver Movimientos">{{number_format($account->haber, 2, ',', '.')}}</a>
                            </td>
                            @else
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->debe, 2, ',', '.')}}</td>
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->haber, 2, ',', '.')}}</td>
                            @endif
                            

                            
                            <td style="text-align:right; color:black; font-weight: bold;">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                            
                                <td style="text-align:right; color:black; ">  
                                    @if($account->code_four == 0)
                                    <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus" style="color: orangered"></i></a>
                                    @endif
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
   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Seguro que desea realizar el Cierre del Ejercicio?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">×</span>
               </button>
           </div>
           <div class="modal-body">Seleccione "Cerrar Ejercicio" si desea salir de Arya Software</div>
           <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
               <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
               Cerrar Ejercicio
              </a>
           </div>
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

    $("#coin").on('change',function(){
        var coin = $(this).val();
        var level = document.getElementById("level").value; 
        window.location = "{{route('accounts', ['',''])}}"+"/"+coin+"/"+level;
    });
    $("#level").on('change',function(){
        var level = $(this).val();
        var coin = document.getElementById("coin").value; 
        window.location = "{{route('accounts', ['',''])}}"+"/"+coin+"/"+level;
    });
    </script> 

@endsection