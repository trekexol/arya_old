@extends('layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}


  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menú Principal</div>
  
                <div class="card-body">
  

             
                 
                  <!--  <div class="list-group">
                      <a href="#" class="list-group-item list-group-item-action">A simple default list group item</a>
                    
                      <a href="#" class="list-group-item list-group-item-action list-group-item-primary">A simple primary list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">A simple secondary list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-success">A simple success list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-danger">A simple danger list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-warning">A simple warning list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-info">A simple info list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-light">A simple light list group item</a>
                      <a href="#" class="list-group-item list-group-item-action list-group-item-dark">A simple dark list group item</a>
                    </div> -->
                    
                      <div class="row justify-content-center">
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-primary text-center" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home">Balance General</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile">Activo 144.500.000,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Pasivo -11.400.000,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings">Capital 133.100.000,00</li>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-danger text-center" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home">Ganancias y Pérdidas</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile">Ingresos 49.225.211,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Egresos 15.262.427,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings">Gastos 3.309.615,40</li>
                            <li class="list-group-item list-group-item-action list-group-item-warning text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Total 30.653.168,60</li>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-info text-center" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home">Saldos Pendientes</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile">Cuentas por Cobrar -500,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Cuentas por Pagar -2.552.873,40</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings">Préstamos Bancarios 0,00</li>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-success text-center" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home">Balance de Bancos</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile">Banesco -41.420.670,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Exterior 8.120.000,00</li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings">Mercantil 8.010.810,40</li>
                            <li class="list-group-item list-group-item-action list-group-item-warning text-center" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages">Total -25.289.860,00</li>
                          </div>
                        </div>
                  </div>
                <br><br>
              
                <div class="row justify-content-center">
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ingresos Correspondientes al periodo 2021</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>
                            <hr>
                            Styling for the bar chart can be found in the
                            <code>/js/demo/chart-bar-demo.js</code> file.
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4">
                        <div class="card shadow mb-3">
                          <!-- Card Header - Dropdown -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Reporte de Ingresos,<br> Egresos y Gastos</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                              
                            </div>
                        </div>
                      </div>

                </div>
               



              </div>
          </div>
      </div>
  </div>
</div>
@endsection



@section('javascript')
     
      <!-- Page level custom scripts -->
      <script src="{{asset('vendor/sb-admin/js/demo/chart-area-demo.js')}}"></script>
      <script src="{{asset('vendor/sb-admin/js/demo/chart-pie-demo.js')}}"></script>
      <script src="{{asset('vendor/sb-admin/js/demo/chart-bar-demo.js')}}"></script>
@endsection
