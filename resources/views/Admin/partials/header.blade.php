<div id="main" class='layout-navbar'>
    <header class='mb-3'>
        <nav class="navbar navbar-expand navbar-light ">
            <div class="container-fluid">
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        
                       
                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                 

                                    @if(auth()->user()->roles == '0')
                                    <p class="mb-0 text-sm text-gray-600"> Pengguna</p>
                                    @endif

                                    @if(auth()->user()->roles == '1')
                                    <p class="mb-0 text-sm text-gray-600">Admin</p>
                                    @endif

                                 
                                    

                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="/template-admin/demo/assets/images/faces/1.jpg">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                          
                          
                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a>
                                            </ul>
                                    </button>
                                  </form>
                               
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>