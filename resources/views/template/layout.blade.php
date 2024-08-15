<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAKA | @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    {{-- @notifyCss --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>

<body>
    
    <div class="wrapper">
        {{-- <x-notify::notify /> --}}
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">
                        <img src="/image/logo_taka2.png" style="width: 200px;">
                    </a>
                </div>

                {{-- ADMIN --}}
                @if (auth()->check())
                    @if (Auth::user()->position_id === 1)
                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Admin Elements
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard" class="sidebar-link">
                                <i class="fa-solid fa-list pe-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <hr>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                Master Data
                            </a>
                            <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/jabatan" class="sidebar-link">Jabatan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/karyawan" class="sidebar-link">Karyawan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="" class="sidebar-link">Pengguna</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#absensi" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                                Absensi
                            </a>
                            <ul id="absensi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/shift" class="sidebar-link">Shift</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/shift-karyawan" class="sidebar-link">Jam Kerja</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/absensi/riwayat" class="sidebar-link">Laporan Absensi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-warehouse pe-2"></i>
                                Product
                            </a>
                            <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/product" class="sidebar-link">Stok Barang</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/supplier" class="sidebar-link">Supplier</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/order" class="sidebar-link">Order</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/predictions" class="sidebar-link">Prediksi Stok Barang</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-coins pe-2"></i>
                                Keuangan
                            </a>
                            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/laporan-harian" class="sidebar-link">Laporan Harian</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/laporan-bulanan" class="sidebar-link">Laporan Bulanan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/laporan-tahunan" class="sidebar-link">Laporan Tahunan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#opt" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-money-bills pe-2"></i>
                                Gaji
                            </a>
                            <ul id="opt" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/gaji" class="sidebar-link">Gaji Karyawan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/report-gaji" class="sidebar-link">Laporan Gaji</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-target="#laporan" data-bs-toggle="collapse"
                                aria-expanded="false"><i class="fa-solid fa-money-bills pe-2"></i>
                                Laporan
                            </a>
                            <ul id="laporan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                <li class="sidebar-item">
                                    <a href="/pendapatan" class="sidebar-link">Laporan Pendapatan</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/pengeluaran" class="sidebar-link">Laporan Pengeluaran</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/laba-rugi" class="sidebar-link">Laporan Laba - Rugi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                @endif

                {{-- KARYAWAN --}}
                @if (Auth::user()->position_id === 2)
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        <h1 class="text" style="font-size: 20px">{{Auth::user()->name}}</h1>
                    </li>
                    <li class="sidebar-item">
                        <a href="/dashboard" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Absensi
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/absensi" class="sidebar-link">Absensi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Laporan
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="/pendapatan" class="sidebar-link">Pendapatan</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="/pengeluaran" class="sidebar-link">Pengeluaran</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endif
                
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="/image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="/" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <main class="content px-3 py-2">
                        <div class="container-fluid">
                            <div class="mb-3">
                                <h4>@yield('name-content')</h4>
                            </div>                            
                        </div>                        
                    @yield('content')
                    </main>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/script.js"></script>

    @notifyJs
</body>

</html>
