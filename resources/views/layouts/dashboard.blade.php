<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    @yield('header')

    <!-- Custom fonts for this template INDEX-->
    <link href="{{asset('vendor/sb-admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{asset('vendor/sb-admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!--End INDEX--> 

    <link href="{{asset('vendor/sb-admin/css/carlos.css')}}" rel="stylesheet">
    
   
    <link href="{{asset('css/watch.css')}}" rel="stylesheet">
      <!-- Custom fonts for this template TABLES-->   
   
    <link href="{{asset('vendor/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!--End TABLES-->   
    <style>

        body {
         
          zoom: 80%;
        }
      
      </style>
</head>

<body id="page-top">
    <body onload="startTime()">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.dashboard_sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" >

                <!-- Topbar -->
                @include('layouts.dashboard_topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                @yield('content')
               
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

   <!-- END SCRIPTS INDEX -->
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('vendor/sb-admin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('vendor/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="v{{asset('vendor/sb-admin/endor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('vendor/sb-admin/js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('vendor/sb-admin/vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('vendor/sb-admin/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('vendor/sb-admin/js/demo/chart-pie-demo.js')}}"></script>
    <!-- END SCRIPTS INDEX -->

     <!-- SCRIPTS FOR TABLES-->
        <!-- Page level plugins -->
        <script src="{{asset('vendor/sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('vendor/sb-admin/js/demo/datatables-demo.js')}}"></script>
    <!-- END SCRIPTS FOR TABLES -->

        <script src="{{asset('js/formulario.js')}}"></script>

        <!-- Para las mascaras -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

  @yield('javascript1') 
  @yield('validacionbtn')
  @yield('validacionbtn2')
  @yield('consulta')  
  @yield('javascript')  
  @yield('javascript_edit')
  @yield('js_charts')
  
  @yield('consultadeposito')  

  @yield('validacion_usuario')



  @yield('validacion')

  @yield('validacionExpense')
  
  <script>
    function soloNumeros(idCampo){
    $('#'+idCampo).keyup(function (){
          this.value = (this.value + '').replace(/[^0-9]/g, '');
      });  
    }
  </script>
  <script>
    function soloLetras(idCampo){
    $('#'+idCampo).keyup(function (){
          this.value = (this.value + '').replace(/[^a-zA-Z\s]/g, '');
      });  
    }
  </script>
    <script>
        function soloAlfaNumerico(idCampo){
        $('#'+idCampo).keyup(function (){
              this.value = (this.value + '').replace(/[^a-zA-Z0-9\s]/g, '');
          });  
        }
      </script>
      <script>
        function soloNumeroPunto(idCampo){
        $('#'+idCampo).keyup(function (){
              this.value = (this.value + '').replace(/[^0-9.]/g, '');
          });  
        }
      </script>


   
</body>

</html>