<nav class="navbar navbar-expand navbar-dark bg-light topbar mb-4 static-top shadow" >
   
                   
                   
                    <nav class="navbar navbar-light bg-light ">
                        <a class="navbar-brand text-secondary" href="#">
                            <img src="{{ asset('img/northdelivery.jpg') }}" width="90" height="30" class="d-inline-block align-top" alt="">                
                            North Delivery
                        </a>
                      </nav>
                     
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark small">{{ Auth::user()->name }}</span>
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
                                    Configuraci??n
                                </a>
                                <div class="dropdown-divider"></div>
                               
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                          Cerrar Sesi??n
                                      </a>
                                  
                                </div>
                        </li>

                    </ul>

</nav>

