<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
               
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    @if (auth()->user()->roles == '0')
                        <a href="{{route('dashboard-user')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                @else
                        <a href="{{route('dashboard-admin')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                        
                    @endif
                </li>
                
                @if(auth()->user()->roles == '1')
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="">Master Buku</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('akun')}}">Master Anggota</a>
                        </li>
                        </li>
                    </ul>
                </li>
                @endif

                
                <li class="sidebar-item">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Pengajuan Buku</span>
                    </a>
                </li>

              


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>