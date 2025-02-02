<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Inventaris Restoran')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" media="all" rel="stylesheet"/>
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" media="all" rel="stylesheet"/>
    <link href="{{ asset('vendor/select2/select2.min.css') }}" media="all" rel="stylesheet"/>
    <link href="{{ asset('vendor/datepicker/daterangepicker.css') }}" media="all" rel="stylesheet"/>
    <link href="{{ asset('css/main.css') }}" media="all" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f6fa;
            overflow-x: hidden;
        }

        /* Mode Gelap */
        .dark-mode {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        /* Mode Gelap untuk Sidebar */
        .dark-mode-sidebar {
            background-color: #2c2c2c !important;
            color: #ffffff !important;
        }

        .dark-mode-sidebar:active {
            color: #2c2c2c !important;
        }

        /* Mode Gelap untuk Navbar */
        .dark-mode .navbar {
            background-color: #2c2c2c !important;
            color: #ffffff !important;
        }

        /* Navbar Link */
        .dark-mode .navbar a,
        .dark-mode .navbar .nav-link {
            color: #ffffff !important;
        }

        /* Sidebar Link */
        .dark-mode .sidebar .nav-link {
            color: #ffffff !important;
        }

        .dark-mode .sidebar .nav-link:hover {
            background-color: #444 !important;
        }

        /* Mode Gelap untuk Form */
        .dark-mode .form-control::placeholder {
            color: #bbbbbb !important;
        }

        .dark-mode .btn-primary {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .dark-mode .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
        }

        /* Notifikasi */
        .dark-mode .badge {
            background-color: #007bff !important;
            color: #ffffff !important;
        }

        /* Breadcrumb */
        .dark-mode .breadcrumb {
            background-color: #2c2c2c !important;
            color: #ffffff !important;
        }

        .dark-mode .breadcrumb-item a {
            color: #ffffff !important;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.98);
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1030;
        }

        .sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .sidebar .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .sidebar .sidebar-header img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .sidebar .sidebar-header h4 {
            color: #3f51b5;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar .menu-title {
            font-size: 12px;
            color: #6c757d;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            border-radius: 5px;
            font-weight: bold;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .sidebar .nav-link.active {
            background-color: #e0e7ff;
            color: #3f51b5;
        }

        .sidebar .nav-link.active i {
            color: #3f51b5;
        }

        .sidebar .nav-link:hover {
            background-color: #e0e7ff;
            color: #5A6ACF;
        }

        .submenu .nav-link {
            font-weight: normal;
        }

        .submenu {
            margin-left: 20px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        .chevron {
            margin-left: auto;
            transition: transform 0.3s ease-in-out;
        }

        .collapse.show + .chevron {
            transform: rotate(90deg);
        }

        .collapse {
            transition: height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
            height: 0;
            overflow: hidden;
        }

        .collapse.show {
            opacity: 1;
            height: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                border-radius: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        .input-group-text {
            background-color: white;
            border-right: 0;
        }

        .form-control {
            border-left: 0;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .actions-cell .btn-group .btn {
            margin-right: 5px;
        }

        .table-hover tbody tr:hover {
            background-color: rgb(255, 0, 0);
        }

        .search-box {
            background-color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            flex-grow: 1;
            width: 100%;
            height: 50px;
        }

        .search-box input {
            border: none;
            outline: none;
            flex-grow: 1;
            margin-left: 10px;
        }

        .search-box i {
            color: #6c757d;
        }

        .input-group-text {
            background-color: white;
            border: none;
        }

        .form-select-wrapper {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 50px;
        }

        .form-select {
            width: auto;
            background-color: transparent;
            margin-left: 10px;
            display: flex;
            align-items: center;
        }

        .category-box {
            display: flex;
            align-items: center;
            margin-left: 10px;
            height: 50px;
        }

        .category-box i {
            color: #6c757d;
        }

        .pagination {
            justify-content: center;
        }

        .page-item .page-link {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
        }

        .page-item.active .page-link {
            background-color: #4285f4;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img alt="Company logo with a stylized tree" src="{{ asset('/images/logo.png') }}"/>
            <h4>OLTREE.co</h4>
        </div>
        <div class="menu-title">Menu</div>
        <nav>
            <!-- Dashboard -->
            <a class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <!-- Data Barang -->
            <div>
                <a aria-controls="barangSubmenu" aria-expanded="true" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#barangSubmenu">
                    <div>
                        <i class="fas fa-box"></i>
                        <span>Data Barang</span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </a>
                <div class="submenu collapse" id="barangSubmenu">
                    <a class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}" href="{{ route('items.index') }}">Lihat Barang</a>
                    <a class="nav-link {{ request()->routeIs('items.create') ? 'active' : '' }}" href="{{ route('items.create') }}">Tambah Barang</a>
                </div>
            </div>
            <!-- Pengeluaran -->
            <div>
                <a aria-controls="pengeluaranSubmenu" aria-expanded="false" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#pengeluaranSubmenu">
                    <div>
                        <i class="fas fa-receipt"></i>
                        <span>Pengeluaran</span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </a>
                <div class="collapse submenu" id="pengeluaranSubmenu">
                    <a class="nav-link {{ request()->routeIs('expenses.index') ? 'active' : '' }}" href="{{ route('expenses.index') }}">Daftar Pengeluaran</a>
                    <a class="nav-link {{ request()->routeIs('expenses.create') ? 'active' : '' }}" href="{{ route('expenses.create') }}">Tambah Pengeluaran</a>
                </div>
            </div>
            <!-- Barang Masuk -->
            <div>
                <a aria-controls="barangMasukSubmenu" aria-expanded="false" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#barangMasukSubmenu">
                    <div>
                        <i class="fas fa-arrow-down"></i>
                        <span>Barang Masuk</span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </a>
                <div class="collapse submenu" id="barangMasukSubmenu">
                    <a class="nav-link {{ request()->routeIs('incoming_items.index') ? 'active' : '' }}" href="{{ route('incoming_items.index') }}">Lihat History</a>
                    <a class="nav-link {{ request()->routeIs('incoming_items.create') ? 'active' : '' }}" href="{{ route('incoming_items.create') }}">Tambah Barang</a>
                </div>
            </div>
            <!-- QR Code -->
            <div>
                <a aria-controls="qrSubmenu" aria-expanded="false" class="nav-link d-flex justify-content-between align-items-center collapsed" data-bs-toggle="collapse" href="#qrSubmenu">
                    <div>
                        <i class="fas fa-qrcode"></i>
                        <span>QR Code</span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </a>
                <div class="submenu collapse" id="qrSubmenu">
                    <a class="nav-link {{ request()->routeIs('qrcode.create') ? 'active' : '' }}" href="{{ route('qrcode.create') }}">Tambah QR Code</a>
                    <a class="nav-link {{ request()->routeIs('qrcode.scan') ? 'active' : '' }}" href="{{ route('qrcode.scan') }}">Scan QR Code</a>
                </div>
            </div>
            <!-- Supplier -->
            <div>
                <a aria-controls="supplierSubmenu" aria-expanded="false" class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#supplierSubmenu">
                    <div>
                        <i class="fas fa-truck"></i>
                        <span>Supplier</span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </a>
                <div class="collapse submenu" id="supplierSubmenu">
                    <a class="nav-link {{ request()->routeIs('suppliers.index') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">Data Supplier</a>
                    <a class="nav-link {{ request()->routeIs('suppliers.create') ? 'active' : '' }}" href="{{ route('suppliers.create') }}">Tambah Supplier</a>
                </div>
            </div>
            <!-- Other -->
            <div class="menu-title mt-4">Other</div>
            <a class="nav-link d-flex align-items-center" href="{{ route('settings') }}">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            <!-- Profile -->
            <a class="nav-link d-flex align-items-center">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <!-- Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <a class="nav-link d-flex align-items-center" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <div class="menu-title mt-4">Tampilan</div>
                <a class="nav-link d-flex align-items-center" href="#" id="darkModeToggle"><i class="fas fa-moon"></i> Mode Gelap</a>
            </form>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="content" id="content">
        @yield('content')
    </div>
    <script src="{{ asset('js/notifications.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (localStorage.getItem("theme") === "dark") {
                document.body.classList.add("dark-mode");
            }
        });
    </script>
    //darkmode
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log("Script dimuat!"); // Debugging

        const body = document.body;
        const sidebar = document.getElementById("sidebar");
        const darkModeToggleSidebar = document.getElementById("darkModeToggle"); // Link di sidebar
        const darkModeToggleSettings = document.getElementById("darkModeCheckbox"); // Checkbox di settings
        const darkModeLabel = document.getElementById("darkModeLabel");

        function updateDarkMode(state) {
            if (state === "enabled") {
                body.classList.add("dark-mode");
                if (sidebar) sidebar.classList.add("dark-mode-sidebar");
                localStorage.setItem("darkMode", "enabled");

                if (darkModeToggleSidebar) darkModeToggleSidebar.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
                if (darkModeToggleSettings) {
                    darkModeToggleSettings.checked = true;
                    darkModeLabel.textContent = "Mode Terang";
                }
            } else {
                body.classList.remove("dark-mode");
                if (sidebar) sidebar.classList.remove("dark-mode-sidebar");
                localStorage.setItem("darkMode", "disabled");

                if (darkModeToggleSidebar) darkModeToggleSidebar.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
                if (darkModeToggleSettings) {
                    darkModeToggleSettings.checked = false;
                    darkModeLabel.textContent = "Mode Gelap";
                }
            }
        }

        // Periksa mode gelap dari localStorage saat halaman dimuat
        const darkModeStatus = localStorage.getItem("darkMode");
        if (darkModeStatus === "enabled") {
            updateDarkMode("enabled");
        } else {
            updateDarkMode("disabled");
        }

        // Event listener untuk sidebar (link)
        if (darkModeToggleSidebar) {
            darkModeToggleSidebar.addEventListener("click", function (e) {
                e.preventDefault();
                updateDarkMode(body.classList.contains("dark-mode") ? "disabled" : "enabled");
            });
        }

        // Event listener untuk settings (checkbox)
        if (darkModeToggleSettings) {
            darkModeToggleSettings.addEventListener("change", function () {
                updateDarkMode(this.checked ? "enabled" : "disabled");
            });
        }
    });
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById('sidebar');
            if (!sidebar) return;

            const collapseElements = sidebar.querySelectorAll('.collapse');

            collapseElements.forEach(collapse => {
                const collapseId = collapse.id;
                const chevron = collapse.previousElementSibling ? collapse.previousElementSibling.querySelector('.chevron') : null;

                const storedState = localStorage.getItem(collapseId);
                if (storedState === 'true') {
                    collapse.classList.add('show');
                    if (chevron) chevron.style.transform = "rotate(90deg)";
                } else {
                    collapse.classList.remove('show');
                    if (chevron) chevron.style.transform = "rotate(0deg)";
                }

                collapse.addEventListener('show.bs.collapse', () => {
                    localStorage.setItem(collapseId, 'true');
                    if (chevron) chevron.style.transform = "rotate(90deg)";
                });

                collapse.addEventListener('hide.bs.collapse', () => {
                    localStorage.setItem(collapseId, 'false');
                    if (chevron) chevron.style.transform = "rotate(0deg)";
                });
            });
        });
    </script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/datepicker/daterangepicker.js') }}"> </script>
  <script src="{{ asset('js/global.js') }}">
  </script>
  @stack('scripts')
 </body>
</html>
