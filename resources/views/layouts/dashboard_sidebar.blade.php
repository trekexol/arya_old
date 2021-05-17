<ul  class="navbar-nav  bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!--style="width:200px !important;"-->
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="background-color: black;" href="index.html">
             <div class="sidebar-brand-icon">
            
            </div>
            <div class="sidebar-brand-text mx-3">
                <img src="{{asset('img/logo.png')}}" style="width: 160px;height:80px;" alt="Google">
                
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
        <i class="fas fa-fw fa-user" style="color: rgb(250, 119, 58);"></i>
        <span>Administración</span>
    </a>
    <div id="collapseAdminitracion" class="collapse" aria-labelledby="headingAdminitracion" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
      
            
            <a class="collapse-item" href="{{ route('users')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-user fa-sm fa-fw mr-2 text-blue-400"></i><strong>Usuarios</strong></strong></a>
            <a class="collapse-item" href="{{ route('companies')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-building fa-sm fa-fw mr-2 text-blue-400"></i><strong>Compañias</strong></a>
            <a class="collapse-item" href="{{ route('branches')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-code-branch fa-sm fa-fw mr-2 text-blue-400"></i><strong>Sucursales</strong></a>
            <a class="collapse-item" href="{{ route('positions')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-blue-400"></i><strong>Cargos</strong></a>
            <a class="collapse-item" href="{{ route('academiclevels')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-graduation-cap fa-sm fa-fw mr-2 text-blue-400"></i><strong>Niveles Académicos</strong></a>
            <a class="collapse-item" href="{{ route('professions') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-blue-400"></i><strong>Profesiones</strong></a>
            <a class="collapse-item" href="{{ route('salarytypes') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-business-time fa-sm fa-fw mr-2 text-blue-400"></i><strong>Tipos de Salarios</strong></a>
            <a class="collapse-item" href="{{ route('nominatypes') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-book fa-sm fa-fw mr-2 text-blue-400"></i><strong>Tipos de Nóminas</strong></a>
            <a class="collapse-item" href="{{ route('comisiontypes') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-address-card fa-sm fa-fw mr-2 text-blue-400"></i><strong>Tipos de Comisión</strong></a>
            <a class="collapse-item" href="{{ route('paymenttypes') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-credit-card fa-sm fa-fw mr-2 text-blue-400"></i><strong>Tipos de Pagos</strong></a>
            <a class="collapse-item" href="{{ route('segments') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-cog fa-sm fa-fw mr-2 text-blue-400"></i><strong>Segmentos</strong></a>
            <a class="collapse-item" href="{{ route('subsegment') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-cogs fa-sm fa-fw mr-2 text-blue-400"></i><strong>Sub Segmentos</strong></a>
            <a class="collapse-item" href="{{ route('unitofmeasures') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-balance-scale fa-sm fa-fw mr-2 text-blue-400"></i><strong>Unidades de Medida</strong></a>
            <a class="collapse-item" href="{{ route('receiptvacations') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-plane-departure fa-sm fa-fw mr-2 text-blue-400"></i><strong>Recibo de Vacaciones</strong></a>
            <a class="collapse-item" href="{{ route('modelos') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-clipboard-list fa-sm fa-fw mr-2 text-blue-400"></i><strong>Modelos</strong></a>
            <a class="collapse-item" href="{{ route('colors') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-palette fa-sm fa-fw mr-2 text-blue-400"></i><strong>Colores</strong></a>
            <a class="collapse-item" href="{{ route('transports') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-car-side fa-sm fa-fw mr-2 text-blue-400"></i><strong>Transportes</strong></a>
            <a class="collapse-item" href="{{ route('historictransports') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-archive fa-sm fa-fw mr-2 text-blue-400"></i><strong>Historial de<br> <div style="text-indent: 22px;">Transporte</div></strong></a>
            <a class="collapse-item" href="{{ route('tasas') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-blue-400"></i><strong>Tasa del Día</strong></a>
           
        </div>
    </div>
</li>

  


 
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-file-alt" style="color: rgb(250, 119, 58);"></i>
            <span>Facturación</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
           
                <a class="collapse-item" href="{{route('quotations')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-pencil-alt fa-sm fa-fw mr-2 text-blue-400"></i><strong>Cotizaciones</strong></a>
                <a class="collapse-item" href="{{route('invoices')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-blue-400"></i><strong>Facturas</strong></a>
                <a class="collapse-item" href="{{route('quotations.indexdeliverynote')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-sort-amount-up-alt fa-sm fa-fw mr-2 text-blue-400"></i><strong>Notas de Entrega</strong></a>
                <a class="collapse-item" href="{{route('clients')}}" style="color: rgb(255, 81, 0)"><i class="fas fa-user fa-sm fa-fw mr-2 text-blue-400"></i><strong>Clientes</strong></a>
                <a class="collapse-item" href="{{route('vendors')}}" style="color: rgb(255, 81, 0)"><i class="fas fa-user fa-sm fa-fw mr-2 text-blue-400"></i><strong>Vendedores</strong></a>
                <a class="collapse-item" href="{{route('billings')}}" style="color: rgb(255, 81, 0)"><i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-blue-400"></i><strong>Ventas</strong></a>
                <a class="collapse-item" href="{{route('anticipos')}}" style="color: rgb(255, 81, 0)"><i class="fas fa-hand-holding-usd fa-sm fa-fw mr-2 text-blue-400"></i><strong>Anticipos Clientes</strong></a>
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
            <i class="fas fa-fw fa-address-book" style="color: rgb(250, 119, 58);"></i>
            <span>Gastos y Compras</span>
        </a>
        <div id="collapseGastos" class="collapse" aria-labelledby="headingGastos" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
           
             <!-- <a  class="collapse-header" href="buttons.html">Gastos y Compras</a> -->
                <a class="collapse-item" href="{{ route('providers')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-black-400"></i><strong>Proveedores</strong></a>
                
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
                <a class="collapse-item" href="{{ route('products')}}" style="color: rgb(255, 81, 0)"><i class="fab fa-product-hunt fa-sm fa-fw mr-2 text-black-400"></i><strong>Productos y Servicios</strong></a> 
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNomina"
            aria-expanded="true" aria-controls="collapseNomina">
            <i class="fas fa-fw fa-user-check" style="color: rgb(250, 119, 58)"></i>
            <span>Nómina</span>
        </a>
        <div id="collapseNomina" class="collapse" aria-labelledby="collapseNomina" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
              <!--<a  class="collapse-header" href="buttons.html">Nómina</a>-->  
                <a class="collapse-item" href="{{ route('nominas') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-book fa-sm fa-fw mr-2 text-black-400"></i><strong>Nóminas</strong></a>
                <a class="collapse-item" href="{{ route('nominaconcepts') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-book fa-sm fa-fw mr-2 text-black-400"></i><strong>Concepto de Nóminas</strong></a>
                <a class="collapse-item" href="{{ route('employees') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-users fa-sm fa-fw mr-2 text-black-400"></i><strong>Empleados</strong></a>
               <!-- <a class="collapse-item" href="buttons.html">Generar Nómina</a>
                <a class="collapse-item" href="buttons.html">Prestaciones Sociales</a>-->
                <a class="collapse-item" href="{{ route('indexbcvs') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-black-400"></i><strong>Indices BCV</strong></a>
            </div>
        </div>
    </li>

 <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaccion"
            aria-expanded="true" aria-controls="collapseTransaccion">
            <i class="fas fa-fw fa-credit-card" style="color: rgb(250, 119, 58)"></i>
            <span>Transacción</span>
        </a>
        <div id="collapseTransaccion" class="collapse" aria-labelledby="headingTransaccion" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
           
            <a  class="collapse-item" href="{{ route('bankmovements') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-coins fa-sm fa-fw mr-2 text-black-400"></i><strong>Bancos</strong></a>
            <a  class="collapse-item" href="{{ route('bankmovements.indexmovement') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-hand-holding-usd fa-sm fa-fw mr-2 text-black-400"></i><strong>Movimientos <br> <div style="text-indent: 22px;"> Bancarios</div></strong></a>
               
       <!--     <a  class="collapse-header" href="buttons.html">Ventas</a>
            <a  class="collapse-header" href="buttons.html">Gastos y Compras</a>
            <a  class="collapse-header" href="buttons.html">Plan de Cuentas</a>
            </div>
        </div>
    </li>
-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContabilidad"
            aria-expanded="true" aria-controls="collapseContabilidad">
            <i class="fas fa-fw fa-book" style="color: rgb(250, 119, 58)"></i>
            <span>Contabilidad</span>
        </a>
        <div id="collapseContabilidad" class="collapse" aria-labelledby="headingContabilidad" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
             
           <!-- <a  class="collapse-header" href="">Contabilidad</a>-->
                <a class="collapse-item" href="{{ route('accounts')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-coins fa-sm fa-fw mr-2 text-black-400"></i><strong>Plan de Cuentas</strong></a>
                <a class="collapse-item" href="{{ route('detailvouchers.create')}}" style="color: rgb(255, 81, 0)"> <i class="fas fa-coins fa-sm fa-fw mr-2 text-black-400"></i><strong>Ajustes Contables</strong></a>
                <a class="collapse-item" href="{{ route('headervouchers') }}" style="color: rgb(255, 81, 0)"> <i class="fas fa-clipboard-check fa-sm fa-fw mr-2 text-blue-400"></i><strong>Comprobante<br> <div style="text-indent: 22px;">Cabecera</div></strong></a>
           
               <!-- <a class="collapse-item" href="buttons.html">Balance General</a>
                <a class="collapse-item" href="buttons.html">Ingresos y Egresos</a>
                <a class="collapse-item" href="buttons.html">Listado Diario</a>
                <a class="collapse-item" href="buttons.html">Ejercicio Anterior</a>
            -->
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link" href="{{ route('inventories')}}">
            <i class="fas fa-fw fa-boxes" style="color: rgb(250, 119, 58)"></i>
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
            <i class="fas fa-fw fa-sign-out-alt" style="color: rgb(250, 119, 58)"></i>
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

    <!-- Saltos de linea para que al hacer zoom, el navbar no quede pequeno -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</ul>