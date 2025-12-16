<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - UMKM Panel Queuely</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --color-light: #E4E0E1;
            --color-beige: #D6C0B3;
            --color-brown: #AB886D;
            --color-dark: #493628;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
            color: var(--color-dark);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, var(--color-dark), #3a2c20);
            color: white;
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .sidebar-brand span {
            color: var(--color-brown);
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: var(--color-brown);
        }

        .nav-link.active {
            color: white;
            background-color: rgba(171, 136, 109, 0.2);
            border-left-color: var(--color-brown);
        }

        .nav-link i {
            width: 24px;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Topbar */
        .topbar {
            background-color: white;
            padding: 15px 25px;
            border-bottom: 1px solid var(--color-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            color: var(--color-dark);
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            color: var(--color-dark);
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--color-brown);
        }

        .logout-btn {
            background-color: transparent;
            border: 2px solid var(--color-brown);
            color: var(--color-brown);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background-color: var(--color-brown);
            color: white;
        }

        /* Content */
        .content-wrapper {
            padding: 25px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--color-light);
            padding: 15px 20px;
            font-weight: 700;
            color: var(--color-dark);
            border-radius: 10px 10px 0 0 !important;
        }

        .card-body {
            padding: 20px;
        }

        /* Stats Cards */
        .stats-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: white;
            margin-bottom: 20px;
        }

        .stats-card.blue {
            background: linear-gradient(135deg, var(--color-dark), #3a2c20);
        }

        .stats-card.green {
            background: linear-gradient(135deg, var(--color-brown), #8d6e53);
        }

        .stats-card.orange {
            background: linear-gradient(135deg, #d6c0b3, #c4a99b);
            color: var(--color-dark);
        }

        .stats-card.purple {
            background: linear-gradient(135deg, #7d6b5d, #5d4d41);
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--color-dark);
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('umkm.dashboard') }}" class="sidebar-brand">
                Queue<span>ly</span>
            </a>
            <p class="small mt-2 mb-0" style="opacity: 0.7;">UMKM Panel</p>
        </div>

        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('umkm.dashboard') }}"
                        class="nav-link @if(Route::is('umkm.dashboard')) active @endif">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('umkm.menu.index') }}"
                        class="nav-link @if(in_array(Route::currentRouteName(), ['umkm.menu.index', 'umkm.menu.create', 'umkm.menu.edit'])) active @endif">
                        <i class="fas fa-utensils"></i>
                        <span>Menu & Produk</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('umkm.videos.index') }}"
                        class="nav-link @if(Route::is('umkm.videos.*')) active @endif">
                        <i class="fas fa-video"></i>
                        <span>Video / Shorts</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('umkm.orders.index') }}"
                        class="nav-link @if(Route::is('umkm.orders.index')) active @endif">
                        <i class="fas fa-receipt"></i>
                        <span>Pesanan Masuk</span>
                    </a>
                </li>

                <li class="nav-item">
                    {{-- Placeholder link for History --}}
                    <a href="{{ route('umkm.orders.history') }}"
                        class="nav-link @if(Route::is('umkm.orders.history')) active @endif">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Pesanan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('umkm.edit') }}" class="nav-link @if(Route::is('umkm.edit')) active @endif">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan UMKM</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-circle fa-2x" style="color: var(--color-brown);"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <div class="small" style="opacity: 0.7;">Pemilik UMKM</div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="mobile-menu-btn me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title">
                    <h1>@yield('title', 'Dashboard')</h1>
                </div>
            </div>

            <div class="user-menu">
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ Auth::user()->umkm->nama_umkm ?? 'Pemilik UMKM' }}</div>
                </div>
                <form action="{{ route('profile.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !toggleBtn.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function () {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @yield('scripts')
</body>

</html>