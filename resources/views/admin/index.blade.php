@extends('layouts.dashboard')

@section('content')

{{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}


    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
               
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
                        <div class="col-xs-4 col-sm-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-primary text-center" style="padding: 0;" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home"><font size="-1">Balance General</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 2% 0;" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile"><font size="-1">Activo <br>144.500.000,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" style="padding: 2% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Pasivo <br>-11.400.000,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 2% 0;" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings"><font size="-1">Capital <br>133.100.000,00</font></li>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-danger text-center" style="padding: 0;" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home"><font size="-1">Ganancias y Pérdidas</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 5% 0;" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile"><font size="-1">Ingresos 49.225.211,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" style="padding: 5% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Egresos 15.262.427,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 5% 0;" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings"><font size="-1">Gastos 3.309.615,40</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-warning text-center" style="padding: 5% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Total 30.653.168,60</font></li>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-info text-center" style="padding: 0;" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home"><font size="-1">Saldos Pendientes</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 2% 0;" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile"><font size="-1">Cuentas por Cobrar <br>-500,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" style="padding: 2% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Cuentas por Pagar <br>-2.552.873,40</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 2% 0;" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings"><font size="-1">Préstamos Bancarios<br> 0,00</font></li>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="list-group" id="list-tab" role="tablist">
                            <li class="list-group-item list-group-item-action list-group-item-success text-center" style="padding: 0;" id="list-home-list" data-bs-toggle="list" role="tab" aria-controls="home"><font size="-1">Balance de Bancos</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 5% 0;" id="list-profile-list" data-bs-toggle="list"  role="tab" aria-controls="profile"><font size="-1">Banesco -41.420.670,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-ligh text-center" style="padding: 5% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Exterior 8.120.000,00</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-light text-center" style="padding: 5% 0;" id="list-settings-list" data-bs-toggle="list" role="tab" aria-controls="settings"><font size="-1">Mercantil 8.010.810,40</font></li>
                            <li class="list-group-item list-group-item-action list-group-item-warning text-center" style="padding: 5% 0;" id="list-messages-list" data-bs-toggle="list"  role="tab" aria-controls="messages"><font size="-1">Total -25.289.860,00</font></li>
                          </div>
                        </div>
                        
                  </div>
               <br>
              
                  <div class="row justify-content-center">
                      <div class="card shadow mb-2"  style="background-color: white">
                        <div class="card-header py-2" style="background-color: rgb(255, 185, 81)">
                            <h6 class="m-0 font-weight-bold text-center">Ingresos Correspondientes al periodo 2021</h6>
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
                      <div class="col-3" >
                          <div class="card shadow" style="background-color: white">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header"  style="background-color: rgb(255, 185, 81)">
                                <h6 class="m-0 font-weight-bold text-center">Reporte de Ingresos,<br> Egresos y Gastos</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body" >
                                <div class="chart-pie pt-1" >
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <hr><h6>Styling for the bar chart can be found in the</h6>
                          
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
