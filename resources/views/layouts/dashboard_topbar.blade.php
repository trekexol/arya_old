<nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow" >
   
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                
                                <a class="nav-link" href="#">
                                  <i class="fas fa-bell fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Tutoriales<span class="sr-only">(current)</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">
                                  <i class="fas fa-check fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Legal
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#">
                                  <i class="fas fa-globe-americas fa-sm fa-fw mr-2 text-gray-400"></i>
                                  Contácto
                                </a>
                              </li>

                              <div class="topbar-divider d-none d-sm-block"></div>

                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Facturación
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{route('clients')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Clientes
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Facturas
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-tag fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cobros
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-sort-amount-up-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Notas<br><div class="text-center"> de Entrega</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fab fa-product-hunt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Productos <br><div class="text-center"> y Servicios</div>
                                  </a>
                                </div>
                              </li>
                            
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Proveedores
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-file-invoice-dollar fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Gastos y<br><div class="text-center"> Compras</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-book fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Órdenes<br><div class="text-center"> de Compra</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-dollar-sign fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pagos
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-search-dollar fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Órdenes <br><div class="text-center">de Pago</div>
                                  </a>
                                 
                                </div>
                              </li>
                             
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Nómina
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('employees') }}">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Empleados
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-chart-line fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Generar Nómina
                                  </a>
                                  <a class="dropdown-item" href="{{ route('indexbcvs') }}">
                                    <i class="fas fa-money-bill fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Índices BCV
                                  </a>
                                </div>
                              </li>
                             
                              <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Otros
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-coins fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Depósitos<br><div class="text-center"> Bancarios</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-hand-holding-usd fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Movimientos<br><div class="text-center"> Bancarios</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-wallet fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Plan <br><div class="text-center">de Cuentas</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-laptop fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ajuste <br><div class="text-center">Contable</div>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ejercicio <br><div class="text-center">Anterior</div>
                                  </a>
                                </div>
                              </li>
                             
                            </ul>
                           
                          </div>
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('vendor/sb-admin/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <a class="dropdown-item" href="{{route('users.create')}}">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Register
                                </a>
                                <div class="dropdown-divider"></div>
                               
                                    <a class="dropdown-item"  href="{{ route('logout') }}"
                                   
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                        </li>

                    </ul>

</nav>

