<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
             <div class="sidebar-brand-icon">
            
            </div>
            <div class="sidebar-brand-text mx-3">
                <img src="{{asset('vendor/sb-admin/img/arya-logo.png')}}" style="width: 160px;height:80px;" alt="Google">
                
            </div>
        
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading 
    <div class="sidebar-heading">
        Interface
    </div>-->
@if (Auth::user()->role_id  == '1')
    

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminitracion"
        aria-expanded="true" aria-controls="collapseAdminitracion">
        <i class="fas fa-fw fa-user"></i>
        <span>Administración</span>
    </a>
    <div id="collapseAdminitracion" class="collapse" aria-labelledby="headingAdminitracion" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
      
            
            <a class="collapse-item" href="{{ route('users')}}">Usuarios</a>
            <a class="collapse-item" href="{{ route('companies')}}">Compañias</a>
            <a class="collapse-item" href="{{ route('branches')}}">Sucursales</a>
            <a class="collapse-item" href="{{ route('positions')}}">Cargos</a>
            <a class="collapse-item" href="{{ route('academiclevels')}}">Niveles Académicos</a>
            <a class="collapse-item" href="{{ route('professions') }}">Profesiones</a>
            <a class="collapse-item" href="{{ route('salarytypes') }}">Tipos de Salarios</a>
            <a class="collapse-item" href="{{ route('nominatypes') }}">Tipos de Nóminas</a>
            <a class="collapse-item" href="{{ route('comisiontypes') }}">Tipos de Comisión</a>
            <a class="collapse-item" href="{{ route('paymenttypes') }}">Tipos de Pagos</a>
            <a class="collapse-item" href="{{ route('segments') }}">Segmentos</a>
            <a class="collapse-item" href="{{ route('subsegment') }}">Sub Segmentos</a>
            <a class="collapse-item" href="{{ route('unitofmeasures') }}">Unidades de Medida</a>
           <a class="collapse-item" href="{{ route('receiptvacations') }}">Recibo de Vacaciones</a>
            <a class="collapse-item" href="{{ route('modelos') }}">Modelos</a>
            <a class="collapse-item" href="{{ route('colors') }}">Colores</a>
            <a class="collapse-item" href="{{ route('transports') }}">Transportes</a>
            <a class="collapse-item" href="{{ route('historictransports') }}">Historial de Transporte</a>
        </div>
    </div>
</li>

  
    <!-- 
    <a class="collapse-item" href="{{ route('clients')}}">Clientes</a>
    <a class="collapse-item" href="{{ route('vendors') }}">Vendedores</a>
     <a class="collapse-item" href="{{ route('providers')}}">Proveedores</a>
            <a class="collapse-item" href="{{ route('inventories')}}">Inventario</a>
               <a class="collapse-item" href="{{ route('products')}}">Productos</a>
                <a class="collapse-item" href="{{ route('indexbcvs') }}">Indices BCV</a>
            <a class="collapse-item" href="{{ route('employees') }}">Empleados</a>
            
         
           
-->


 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Facturación</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
           
              <a  class="collapse-header" href="{{route('billings')}}">Facturacion</a>
                 <a class="collapse-item" href="{{route('clients')}}">Clientes</a>
                <a class="collapse-item" href="{{route('vendors')}}">Vendedores</a>
                <a  class="collapse-header" href="{{route('billings')}}">Ventas</a>
              <!--      <a class="collapse-item" href="buttons.html">Listar Factura</a>
                    <a class="collapse-item" href="buttons.html">Notas de Entrega</a>
                    <a class="collapse-item" href="buttons.html">Notas de Crédito</a>
                    <a class="collapse-item" href="buttons.html">Notas de Débito</a>
                <a class="collapse-header" href="buttons.html">Anticipo Clientes</a>
                    <a class="collapse-item" href="buttons.html">Listar Anticipo Clientes</a>
                    <a class="collapse-item" href="buttons.html">Ver Saldos de Clientes</a>
                <a class="collapse-header" href="buttons.html">Cobros</a>
                    <a class="collapse-item" href="buttons.html">Listar Cobros</a>
                    <a class="collapse-item" href="buttons.html">Cobrar Facturas de Ventas</a>
                <a class="collapse-header" href="buttons.html">Recibos de Cobros</a>
                    <a class="collapse-item" href="buttons.html">Listar Recibos de Cobros</a>
                <a class="collapse-header" href="buttons.html">Productos y Servicios</a> -->
            </div>
        </div>
    </li>

    @endif

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGastos"
            aria-expanded="true" aria-controls="collapseGastos">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Gastos y Compras</span>
        </a>
        <div id="collapseGastos" class="collapse" aria-labelledby="headingGastos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
           
             <!-- <a  class="collapse-header" href="buttons.html">Gastos y Compras</a> -->
                <a class="collapse-item" href="{{ route('providers')}}">Proveedores</a>
                
              <!--  <a  class="collapse-header" href="buttons.html">Compras</a>
                    <a class="collapse-item" href="buttons.html">Listar Compras</a>
                    <a class="collapse-item" href="buttons.html">Notas de Crédito</a>
                    <a class="collapse-item" href="buttons.html">Notas de Débito</a>
                <a class="collapse-header" href="buttons.html">Anticipo Proveedores</a>
                    <a class="collapse-item" href="buttons.html">Listar Anticipo Proveedores</a>
                    <a class="collapse-item" href="buttons.html">Ver Saldos de Proveedores</a>
                <a class="collapse-header" href="buttons.html">Pagos</a>
                    <a class="collapse-item" href="buttons.html">Listar Pagos</a>
                    <a class="collapse-item" href="buttons.html">Ordenes de Pago</a>
                    <a class="collapse-item" href="buttons.html">Pagar Facturas de Compra</a>-->
                <a class="collapse-header" href="{{ route('products')}}">Productos y Servicios</a> 
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNomina"
            aria-expanded="true" aria-controls="collapseNomina">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Nómina</span>
        </a>
        <div id="collapseNomina" class="collapse" aria-labelledby="collapseNomina" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
              <!--<a  class="collapse-header" href="buttons.html">Nómina</a>-->
                <a class="collapse-item" href="{{ route('employees') }}">Empleados</a>
               <!-- <a class="collapse-item" href="buttons.html">Generar Nómina</a>
                <a class="collapse-item" href="buttons.html">Prestaciones Sociales</a>-->
                <a class="collapse-item" href="{{ route('indexbcvs') }}">Indices BCV</a>
            </div>
        </div>
    </li>
<!--
 <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaccion"
            aria-expanded="true" aria-controls="collapseTransaccion">
            <i class="fas fa-fw fa-credit-card"></i>
            <span>Transacción</span>
        </a>
        <div id="collapseTransaccion" class="collapse" aria-labelledby="headingTransaccion" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
            <a  class="collapse-header" href="buttons.html">Transacción</a>
            <a  class="collapse-header" href="buttons.html">Bancos</a>
                <a class="collapse-item" href="buttons.html">Depósitos Bancarios</a>
                <a class="collapse-item" href="buttons.html">Movimientos Bancarios</a>
                <a class="collapse-item" href="buttons.html">Importar <br> Bancarios</a>
            <a  class="collapse-header" href="buttons.html">Ventas</a>
            <a  class="collapse-header" href="buttons.html">Gastos y Compras</a>
            <a  class="collapse-header" href="buttons.html">Plan de Cuentas</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContabilidad"
            aria-expanded="true" aria-controls="collapseContabilidad">
            <i class="fas fa-fw fa-book"></i>
            <span>Contabilidad</span>
        </a>
        <div id="collapseContabilidad" class="collapse" aria-labelledby="headingContabilidad" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
            <a  class="collapse-header" href="buttons.html">Contabilidad</a>
                <a class="collapse-item" href="buttons.html">Plan de Cuentas</a>
                <a class="collapse-item" href="buttons.html">Ajustes Contables</a>
                <a class="collapse-item" href="buttons.html">Balance General</a>
                <a class="collapse-item" href="buttons.html">Ingresos y Egresos</a>
                <a class="collapse-item" href="buttons.html">Listado Diario</a>
                <a class="collapse-item" href="buttons.html">Ejercicio Anterior</a>
           
            </div>
        </div>
    </li>
-->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('inventories')}}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventario</span></a>
    </li>
   <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>Usuarios</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-wrench"></i>
            <span>General</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-home"></i>
            <span>Sucursal</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImpuestos"
            aria-expanded="true" aria-controls="collapseImpuestos">
            <i class="fas fa-fw fa-gavel"></i>
            <span>Impuestos</span>
        </a>
        <div id="collapseImpuestos" class="collapse" aria-labelledby="headingImpuestos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
            <a  class="collapse-header" href="buttons.html">Impuestos</a>
                <a class="collapse-item" href="buttons.html">Pago de IVA</a>
                <a class="collapse-item" href="buttons.html">Pago de IVA Retenido - <br> Terceros</a>
                <a class="collapse-item" href="buttons.html">Pago de ISLR</a>
                <a class="collapse-item" href="buttons.html">Pago de ISLR Retenido</a>
                
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-clone"></i>
            <span>Reportes</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGraficos"
            aria-expanded="true" aria-controls="collapseGraficos">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Gráficos</span>
        </a>
        <div id="collapseGraficos" class="collapse" aria-labelledby="headingGraficos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            
            <a  class="collapse-header" href="buttons.html">Gráficos</a>
                <a class="collapse-item" href="buttons.html">Gráficos de Pastel</a>
                <a class="collapse-item" href="buttons.html">Gráficos de Barra</a>
            </div>
        </div>
    </li>
    -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Salir</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
    </li>

    


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->


</ul>