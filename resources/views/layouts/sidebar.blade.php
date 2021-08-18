<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="home" class="brand-link">
                <img src="{{asset('template')}}/dist/img/starbhak.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">SIAKAD</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{Auth::user()->foto}}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @if(Auth::check())
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link" id="Dashboard">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->role == 'Admin')
                        <li class="nav-item">
                            <a href="{{route('admin.home')}}" class="nav-link" id="AdminDashboard">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                   Admin Dashboard
                                </p>
                            </a>
                        </li>
                        @endif

                        <!-- Modal Penilaian -->
                        <li class="nav-header" style="font-weight:bold;">MENU SIAKAD</li>

                        @if(Auth::user()->role == 'Admin')
                        <!-- Menu Modul Umum -->
                        <li class="nav-item menu-close" id="liMasterData">
                            <a href="#" class="nav-link" id="MasterData">
                                <i class="fas fa-sliders-h"></i>
                                <p>
                                    Data Master
                                    <i class="right fas fa-angle-left float-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Role Admin -->
                                
                                <li class="nav-item">
                                    <a href="{{route('guru.index')}}" class="nav-link" id="DataGuru">
                                        <i class="nav-icon fas fa-file-signature"></i>
                                        <p>
                                            Data Guru/Karyawan
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('kelas.index')}}" class="nav-link" id="DataKelas">
                                        <i class="nav-icon fas fa-file-signature"></i>
                                        <p>
                                            Data Kelas
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('siswa.index')}}" class="nav-link" id="DataSiswa">
                                        <i class="nav-icon fas fa-file-signature"></i>
                                        <p>
                                            Data Siswa
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('mapel.index')}}" class="nav-link" id="DataMapel">
                                        <i class="nav-icon fas fa-book"></i>
                                        <p>
                                            Data Mapel
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Guru' || Auth::user()->role == 'Siswa' || Auth::user()->role == 'Wali Kelas')
                        <!-- Menu Modul Adm Guru -->
                        <li class="nav-item menu-close" id="liKompetensiDasar">
                            <a href="#" class="nav-link" id="KompetensiDasar">
                                <i class="fab fa-bandcamp"></i>
                                <p>
                                    Modul Adm Guru
                                    <i class="right fas fa-angle-left float-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <!-- Role Admin -->
                                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Guru' || Auth::user()->role == 'Siswa')
                                <li class="nav-item">
                                    <a href="{{route('KD.index')}}" class="nav-link" id="DataKD">
                                        <i class="nav-icon far fa-bookmark"></i>
                                        <p>
                                            Kompetensi Dasar
                                        </p>
                                    </a>
                                </li>
                                @endif
                                
                            </ul>
                        </li>
                        @endif

                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>