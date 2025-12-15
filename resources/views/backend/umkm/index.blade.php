<!-- resources/views/backend/admin/umkm/index.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola UMKM - AntriUMKM Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --color-light: #E4E0E1;
            --color-beige: #D6C0B3;
            --color-brown: #AB886D;
            --color-dark: #493628;
            --shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
            color: var(--color-dark);
            min-height: 100vh;
        }
        
        .sidebar {
            background-color: var(--color-dark);
            color: white;
            min-height: 100vh;
            padding: 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 0;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            text-decoration: none;
        }
        
        .logo span {
            color: var(--color-beige);
        }
        
        .sidebar-menu {
            padding: 15px 0;
        }
        
        .menu-item {
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--color-beige);
        }
        
        .menu-item i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 0;
            width: calc(100% - 250px);
        }
        
        .content-header {
            background-color: white;
            padding: 20px 30px;
            border-bottom: 1px solid var(--color-light);
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        
        .page-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 5px;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--color-brown), var(--color-dark));
            border: none;
            color: white;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-primary-custom:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            border-left: 4px solid var(--color-brown);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-dark);
            line-height: 1;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .action-btn {
            padding: 5px 10px;
            margin: 0 2px;
            font-size: 0.8rem;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(214, 192, 179, 0.1);
        }
        
        .dataTables_wrapper {
            margin-top: 20px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px 10px;
            margin-left: 5px;
            border-radius: 5px;
            border: 1px solid var(--color-light);
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--color-brown), var(--color-dark)) !important;
            color: white !important;
            border: none;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: var(--color-beige) !important;
            color: var(--color-dark) !important;
        }
        
        .search-box {
            max-width: 300px;
        }
        
        .search-box .form-control {
            border: 2px solid var(--color-light);
            border-radius: 8px;
            padding: 10px 15px;
        }
        
        .search-box .form-control:focus {
            border-color: var(--color-brown);
            box-shadow: 0 0 0 0.2rem rgba(171, 136, 109, 0.25);
        }
        
        .filter-dropdown .dropdown-toggle {
            background-color: white;
            border: 2px solid var(--color-light);
            color: var(--color-dark);
            font-weight: 600;
        }
        
        .filter-dropdown .dropdown-menu {
            border: 1px solid var(--color-light);
            box-shadow: var(--shadow);
        }
        
        .filter-dropdown .dropdown-item.active {
            background-color: var(--color-brown);
            color: white;
        }
        
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--color-beige);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-dark);
            font-weight: 600;
        }
        
        /* Modal Styles */
        .modal-umkm .modal-dialog {
            max-width: 600px;
        }
        
        .modal-umkm .modal-header {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border-bottom: none;
            padding: 20px 30px;
        }
        
        .modal-umkm .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .modal-umkm .modal-body {
            padding: 30px;
        }
        
        .modal-umkm .form-label {
            color: var(--color-dark);
            font-weight: 600;
        }
        
        .modal-umkm .form-control {
            border: 2px solid var(--color-light);
            border-radius: 8px;
            padding: 10px 15px;
        }
        
        .modal-umkm .form-control:focus {
            border-color: var(--color-brown);
            box-shadow: 0 0 0 0.2rem rgba(171, 136, 109, 0.25);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            border: none;
        }
        
        .btn-delete:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            color: white;
        }
        
        /* Alert Styles */
        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-header .logo span,
            .menu-item span:not(.badge),
            .admin-profile span {
                display: none;
            }
            
            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
            
            .menu-item {
                text-align: center;
                padding: 15px 10px;
            }
            
            .menu-item i {
                margin-right: 0;
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 15px;
            }
            
            .content-header {
                padding: 15px 20px;
            }
            
            .search-box {
                max-width: 100%;
                margin-top: 10px;
            }
        }
        
        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .mobile-menu-btn {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1000;
                background-color: var(--color-dark);
                color: white;
                border: none;
                border-radius: 5px;
                padding: 8px 12px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button (Hanya tampil di mobile) -->
    <button class="mobile-menu-btn d-none" id="mobileMenuBtn">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <i class="fas fa-store me-2"></i>
                <span>AntriUMKM</span>
            </a>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('admin.dashboard') }}" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.umkm.index') }}" class="menu-item active">
                <i class="fas fa-store"></i>
                <span>Kelola UMKM</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Pengguna</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="menu-item">
                <i class="fas fa-clipboard-list"></i>
                <span>Pesanan</span>
            </a>
            <a href="{{ route('admin.menu.index') }}" class="menu-item">
                <i class="fas fa-utensils"></i>
                <span>Menu Online</span>
            </a>
            <a href="{{ route('admin.reports.index') }}" class="menu-item">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
            
            <div style="padding: 20px; margin-top: 30px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                <div class="admin-profile">
                    <div class="admin-avatar">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 0.9rem;">{{ auth()->user()->name }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">Admin</div>
                    </div>
                </div>
                
                <a href="{{ route('logout') }}" class="menu-item" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   style="margin-top: 15px;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">Kelola UMKM</h1>
                    <p class="text-muted mb-0">Kelola semua UMKM yang terdaftar di sistem AntriUMKM</p>
                </div>
                <a href="{{ route('admin.umkm.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i> Tambah UMKM
                </a>
            </div>
            
            <!-- Search and Filter -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: var(--color-beige); border-color: var(--color-light);">
                                <i class="fas fa-search" style="color: var(--color-dark);"></i>
                            </span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Cari UMKM berdasarkan nama, pemilik, atau lokasi...">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex gap-2">
                        <div class="filter-dropdown">
                            <button class="btn dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-2"></i> Filter Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item active" href="#" data-filter="all">Semua</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="active">Aktif</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="pending">Menunggu</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="inactive">Nonaktif</a></li>
                            </ul>
                        </div>
                        <button class="btn" style="background-color: var(--color-beige); color: var(--color-dark);">
                            <i class="fas fa-download me-2"></i> Export
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['total_umkm'] ?? 0 }}</div>
                        <div class="stat-label">Total UMKM</div>
                        <small class="text-muted">Semua UMKM terdaftar</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['active_umkm'] ?? 0 }}</div>
                        <div class="stat-label">UMKM Aktif</div>
                        <small class="text-muted">Sedang beroperasi</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['pending_umkm'] ?? 0 }}</div>
                        <div class="stat-label">Menunggu Verifikasi</div>
                        <small class="text-muted">Perlu persetujuan</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">{{ $stats['inactive_umkm'] ?? 0 }}</div>
                        <div class="stat-label">Tidak Aktif</div>
                        <small class="text-muted">Berhenti beroperasi</small>
                    </div>
                </div>
            </div>
            
            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-custom">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-error alert-custom">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float: right;"></button>
                </div>
            @endif
            
            <!-- UMKM Table -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="umkmTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama UMKM</th>
                                    <th>Pemilik</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($umkmList as $umkm)
                                <tr>
                                    <td>{{ $loop->iteration + ($umkmList->currentPage() - 1) * $umkmList->perPage() }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $umkm->name }}</div>
                                        <small class="text-muted">ID: {{ $umkm->umkm_code ?? 'UMKM-' . str_pad($umkm->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </td>
                                    <td>
                                        <div>{{ $umkm->user->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $umkm->user->email ?? '' }}</small>
                                    </td>
                                    <td>
                                        @if($umkm->category)
                                            <span class="badge rounded-pill" style="background-color: var(--color-beige); color: var(--color-dark);">
                                                {{ $umkm->category }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $umkm->city ?? 'N/A' }}
                                        <br>
                                        <small class="text-muted">{{ $umkm->address ?? '' }}</small>
                                    </td>
                                    <td>
                                        @if($umkm->status == 'active')
                                            <span class="status-badge badge-active">Aktif</span>
                                        @elseif($umkm->status == 'pending')
                                            <span class="status-badge badge-pending">Menunggu</span>
                                        @else
                                            <span class="status-badge badge-inactive">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($umkm->created_at)->format('d/m/Y') }}
                                        <br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($umkm->created_at)->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('admin.umkm.show', $umkm->id) }}" class="btn btn-sm btn-outline-primary action-btn" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn btn-sm btn-outline-success action-btn" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger action-btn delete-btn" 
                                                    data-id="{{ $umkm->id }}" 
                                                    data-name="{{ $umkm->name }}"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($umkmList->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $umkmList->firstItem() }} - {{ $umkmList->lastItem() }} dari {{ $umkmList->total() }} UMKM
                        </div>
                        <nav>
                            {{ $umkmList->links() }}
                        </nav>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Aksi Cepat</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn" style="background-color: var(--color-beige); color: var(--color-dark);">
                                    <i class="fas fa-file-excel me-2"></i> Export Excel
                                </button>
                                <button class="btn" style="background-color: var(--color-light); color: var(--color-dark);">
                                    <i class="fas fa-file-pdf me-2"></i> Export PDF
                                </button>
                                <button class="btn" style="background-color: var(--color-brown); color: white;">
                                    <i class="fas fa-check-circle me-2"></i> Verifikasi Semua
                                </button>
                                <button class="btn btn-delete">
                                    <i class="fas fa-trash me-2"></i> Hapus Nonaktif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade modal-umkm" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: #dc3545;"></i>
                    </div>
                    <p class="text-center">Apakah Anda yakin ingin menghapus UMKM <strong id="deleteUmkmName"></strong>?</p>
                    <p class="text-danger text-center"><strong>Tindakan ini tidak dapat dibatalkan!</strong></p>
                    <p class="text-muted text-center small">Semua data terkait (menu, pesanan, dll) juga akan dihapus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#mobileMenuBtn').click(function() {
                $('#sidebar').toggleClass('show');
                $(this).toggleClass('open');
            });
            
            // Initialize DataTable
            $('#umkmTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                },
                pageLength: 10,
                order: [[6, 'desc']],
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
                columnDefs: [
                    { orderable: false, targets: [0, 7] }
                ]
            });
            
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const table = $('#umkmTable').DataTable();
                table.search(this.value).draw();
            });
            
            // Filter by status
            $('[data-filter]').click(function(e) {
                e.preventDefault();
                
                const filter = $(this).data('filter');
                const table = $('#umkmTable').DataTable();
                
                // Update active class
                $('[data-filter]').removeClass('active');
                $(this).addClass('active');
                
                // Update dropdown text
                $('#filterDropdown').html('<i class="fas fa-filter me-2"></i> ' + $(this).text());
                
                if (filter === 'all') {
                    table.column(5).search('').draw();
                } else {
                    table.column(5).search('^' + filter + '$', true, false).draw();
                }
            });
            
            // Delete button handler
            $('.delete-btn').click(function() {
                const umkmId = $(this).data('id');
                const umkmName = $(this).data('name');
                const deleteUrl = "{{ route('admin.umkm.destroy', ':id') }}".replace(':id', umkmId);
                
                $('#deleteUmkmName').text(umkmName);
                $('#deleteForm').attr('action', deleteUrl);
                $('#deleteModal').modal('show');
            });
            
            // Status change handler
            $('.status-badge').click(function() {
                const row = $(this).closest('tr');
                const umkmId = row.find('.delete-btn').data('id');
                const currentStatus = $(this).text().toLowerCase().includes('aktif') ? 'active' : 
                                    $(this).text().toLowerCase().includes('menunggu') ? 'pending' : 'inactive';
                
                const newStatus = prompt('Ubah status UMKM:\n1. active\n2. pending\n3. inactive\n\nMasukkan status baru:', currentStatus);
                
                if (newStatus && ['active', 'pending', 'inactive'].includes(newStatus)) {
                    $.ajax({
                        url: "{{ route('admin.umkm.update-status', ':id') }}".replace(':id', umkmId),
                        method: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: newStatus
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                alert('Gagal mengubah status: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat mengubah status');
                        }
                    });
                }
            });
            
            // Auto hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
            
            // Responsive adjustments
            function adjustLayout() {
                if ($(window).width() <= 576) {
                    $('#mobileMenuBtn').removeClass('d-none');
                    $('#sidebar').removeClass('show');
                } else {
                    $('#mobileMenuBtn').addClass('d-none');
                    $('#sidebar').addClass('show');
                }
            }
            
            adjustLayout();
            $(window).resize(adjustLayout);
        });
    </script>
</body>
</html>