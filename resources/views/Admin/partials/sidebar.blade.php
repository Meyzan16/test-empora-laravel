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

                    @if (auth()->user()->roles == '0')
                    <li class="sidebar-item  {{ request()->is('user') ? 'active' : '' }} ">
                        <a href="{{route('dashboard-user')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @else
                    <li class="sidebar-item  {{ request()->is('admin') ? 'active' : '' }} ">
                        <a href="{{route('dashboard-admin')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                        
                    </li>
                    @endif
                
                @can('admin')
                    <li class="sidebar-item {{ request()->is('admin/master*') ? 'active' : '' }} has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>Setting</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="">Master Buku</a>
                            </li>
                            <li class="submenu-item  {{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                <a href="{{ route('akun')}}">Master Anggota</a>
                            </li>
                            </li>
                        </ul>
                    </li>
                @endcan

                @if (auth()->user()->roles == '0')
                     <li class="sidebar-item {{ request()->is('user/pengajuan-peminjaman') ? 'active' : '' }} ">
                        <a href="{{route('pengajuan')}}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Pengajuan buku</span>
                        </a>
                    </li>
                @else
                        <li class="sidebar-item {{ request()->is('admin/list-pengajuan*') ? 'active' : '' }} ">
                            <a href="{{route('list-pengajuan-admin')}}"  class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>List Pengajuan</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item {{ request()->is('admin/list-peminjaman*') ? 'active' : '' }} ">
                            <a href="{{route('list-peminjaman-admin')}}"  class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>List Peminjaman</span>
                            </a>
                        </li>
                        
                    @endif
                
                

              


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>