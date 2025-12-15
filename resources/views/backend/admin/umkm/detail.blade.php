<!-- resources/views/backend/admin/umkm/detail.blade.php -->
@extends('backend.admin.layout')

@section('title', 'Detail UMKM - ' . $umkm->nama_umkm)

@section('content')
    <div class="container-fluid">
        <!-- Header Actions -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Detail UMKM</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.umkm') }}">UMKM</a></li>
                        <li class="breadcrumb-item active">{{ $umkm->nama_umkm }}</li>
                    </ol>
                </nav>
            </div>

            <div class="d-flex gap-2">
                @if($umkm->status == 'pending')
                    <button class="btn btn-success" onclick="verifyUmkm({{ $umkm->id }})">
                        <i class="fas fa-check-circle me-1"></i> Verifikasi
                    </button>
                @endif

                <a href="{{ route('umkm.edit', $umkm->id) }}" class="btn btn-admin">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>

                <button class="btn btn-danger" onclick="confirmDelete({{ $umkm->id }}, '{{ $umkm->nama_umkm }}')">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>

                @if($umkm->status == 'approved')
                    <button class="btn btn-warning" onclick="updateStatus({{ $umkm->id }}, 'inactive')">
                        <i class="fas fa-power-off me-1"></i> Nonaktifkan
                    </button>
                @elseif($umkm->status == 'inactive')
                    <button class="btn btn-success" onclick="updateStatus({{ $umkm->id }}, 'approved')">
                        <i class="fas fa-play-circle me-1"></i> Aktifkan
                    </button>
                @endif
            </div>
        </div>

        <!-- Alert Messages -->
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

        <!-- Profile Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="mb-3">
                            @if($umkm->logo)
                                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama_umkm }}"
                                    class="img-fluid rounded-circle"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid var(--color-beige);">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto"
                                    style="width: 150px; height: 150px; border: 3px solid var(--color-beige);">
                                    <i class="fas fa-store fa-3x text-secondary"></i>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            @if($umkm->status == 'approved')
                                <span class="badge bg-success p-2"><i class="fas fa-check-circle me-1"></i> Aktif</span>
                            @elseif($umkm->status == 'pending')
                                <span class="badge bg-warning p-2"><i class="fas fa-clock me-1"></i> Menunggu</span>
                            @else
                                <span class="badge bg-danger p-2"><i class="fas fa-times-circle me-1"></i> Nonaktif</span>
                            @endif
                        </div>

                        <div class="text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i>
                            Bergabung: {{ $umkm->created_at->format('d M Y') }}
                        </div>

                        <div class="text-muted small">
                            <i class="fas fa-id-card me-1"></i>
                            ID: {{ $umkm->kode_umkm ?? 'UMKM-' . $umkm->id }}
                        </div>
                    </div>

                    <div class="col-md-9">
                        <h3 class="mb-3">{{ $umkm->nama_umkm }}</h3>
                        <p class="text-muted mb-4">{{ $umkm->deskripsi }}</p>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i class="fas fa-user me-2 text-brown"></i> Pemilik:</strong>
                                    <p class="mb-0">{{ $umkm->user->name ?? 'N/A' }}</p>
                                    @if($umkm->user)
                                        <small class="text-muted">{{ $umkm->user->email }}</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-tag me-2 text-brown"></i> Kategori:</strong>
                                    <p class="mb-0">{{ $umkm->kategori ?? '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-phone me-2 text-brown"></i> Telepon:</strong>
                                    <p class="mb-0">{{ $umkm->telepon ?? $umkm->user->phone ?? '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-envelope me-2 text-brown"></i> Email:</strong>
                                    <p class="mb-0">{{ $umkm->email ?? $umkm->user->email ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong><i class="fas fa-map-marker-alt me-2 text-brown"></i> Alamat:</strong>
                                    <p class="mb-0">{{ $umkm->alamat ?? '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-city me-2 text-brown"></i> Kota:</strong>
                                    <p class="mb-0">{{ $umkm->kota ?? '-' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong><i class="fas fa-clock me-2 text-brown"></i> Jam Operasi:</strong>
                                    <p class="mb-0">{{ $umkm->jam_buka ?? '08:00' }} - {{ $umkm->jam_tutup ?? '21:00' }}</p>
                                </div>

                                @if($umkm->website || $umkm->instagram)
                                    <div class="mb-3">
                                        <strong><i class="fas fa-link me-2 text-brown"></i> Media Sosial:</strong>
                                        <p class="mb-0">
                                            @if($umkm->website)
                                                <a href="{{ $umkm->website }}" target="_blank" class="me-2">
                                                    <i class="fas fa-globe"></i> Website
                                                </a>
                                            @endif
                                            @if($umkm->instagram)
                                                <a href="https://instagram.com/{{ $umkm->instagram }}" target="_blank">
                                                    <i class="fab fa-instagram"></i> Instagram
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-6">
                <div class="card stats-card blue">
                    <div class="card-body text-center">
                        <div class="stats-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stats-number">{{ $stats['total_orders'] ?? 0 }}</div>
                        <div class="stats-label">Total Pesanan</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="card stats-card green">
                    <div class="card-body text-center">
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stats-number">Rp {{ number_format($stats['total_revenue'] ?? 0, 0, ',', '.') }}</div>
                        <div class="stats-label">Pendapatan</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="card stats-card orange">
                    <div class="card-body text-center">
                        <div class="stats-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="stats-number">{{ $stats['menu_count'] ?? 0 }}</div>
                        <div class="stats-label">Menu</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-6">
                <div class="card stats-card purple">
                    <div class="card-body text-center">
                        <div class="stats-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stats-number">{{ number_format($stats['avg_rating'] ?? 0, 1) }}</div>
                        <div class="stats-label">Rating</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs mb-4" id="umkmTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">
                    <i class="fas fa-info-circle me-2"></i> Informasi Lengkap
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" type="button">
                    <i class="fas fa-utensils me-2"></i> Menu
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button">
                    <i class="fas fa-clipboard-list me-2"></i> Pesanan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents" type="button">
                    <i class="fas fa-file-alt me-2"></i> Dokumen
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="umkmTabContent">
            <!-- Tab 1: Informasi Lengkap -->
            <div class="tab-pane fade show active" id="info" role="tabpanel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-id-card me-2"></i> Informasi Legal
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>NIB (Nomor Induk Berusaha):</strong>
                                    <p class="mb-0">{{ $umkm->nib ?? 'Belum diisi' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong>SIUP:</strong>
                                    <p class="mb-0">{{ $umkm->siup ?? 'Belum diisi' }}</p>
                                </div>

                                <div class="mb-3">
                                    <strong>NPWP:</strong>
                                    <p class="mb-0">{{ $umkm->npwp ?? 'Belum diisi' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- System Info -->
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-database me-2"></i> Informasi Sistem
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong>ID UMKM:</strong>
                                            <p class="mb-0">{{ $umkm->id }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong>Kode UMKM:</strong>
                                            <p class="mb-0">{{ $umkm->kode_umkm ?? 'UMKM-' . $umkm->id }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong>Dibuat Pada:</strong>
                                            <p class="mb-0">{{ $umkm->created_at->format('d F Y H:i:s') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <strong>Diperbarui Pada:</strong>
                                            <p class="mb-0">{{ $umkm->updated_at->format('d F Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Coordinates -->
                        @if($umkm->latitude && $umkm->longitude)
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-map-marked-alt me-2"></i> Koordinat Lokasi
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <strong>Latitude:</strong>
                                                <p class="mb-0">{{ $umkm->latitude }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <strong>Longitude:</strong>
                                                <p class="mb-0">{{ $umkm->longitude }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="https://maps.google.com/?q={{ $umkm->latitude }},{{ $umkm->longitude }}"
                                            target="_blank" class="btn btn-sm btn-admin">
                                            <i class="fas fa-external-link-alt me-1"></i> Lihat di Google Maps
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Actions -->
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-bolt me-2"></i> Aksi Cepat
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('menu.create', ['umkm_id' => $umkm->id]) }}" class="btn btn-admin">
                                        <i class="fas fa-plus me-2"></i> Tambah Menu
                                    </a>
                                    <a href="{{ route('admin.pesanan.create', ['umkm_id' => $umkm->id]) }}"
                                        class="btn btn-outline-secondary">
                                        <i class="fas fa-plus-circle me-2"></i> Buat Pesanan
                                    </a>
                                    <button class="btn btn-outline-success" onclick="printUmkmInfo()">
                                        <i class="fas fa-print me-2"></i> Cetak Info
                                    </button>
                                    <button class="btn btn-outline-primary" onclick="exportUmkmData()">
                                        <i class="fas fa-download me-2"></i> Export Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Menu -->
            <div class="tab-pane fade" id="menu" role="tabpanel">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-utensils me-2"></i> Daftar Menu
                            <span class="badge bg-secondary ms-2">{{ $menus->count() }} menu</span>
                        </div>
                        <a href="{{ route('admin.menu.create', ['umkm_id' => $umkm->id]) }}" class="btn btn-sm btn-admin">
                            <i class="fas fa-plus me-1"></i> Tambah Menu
                        </a>
                    </div>
                    <div class="card-body">
                        @if($menus->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Nama Menu</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($menus as $menu)
                                            <tr>
                                                <td>
                                                    @if($menu->gambar)
                                                        <img src="{{ asset('storage/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}"
                                                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <i class="fas fa-utensils fa-lg text-muted"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $menu->nama_menu }}</strong><br>
                                                    <small class="text-muted">{{ Str::limit($menu->deskripsi, 50) }}</small>
                                                </td>
                                                <td>{{ $menu->kategori ?? '-' }}</td>
                                                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                                <td>
                                                    @if($menu->status == 'tersedia')
                                                        <span class="badge bg-success">Tersedia</span>
                                                    @else
                                                        <span class="badge bg-danger">Habis</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('admin.menu.edit', $menu->id) }}"
                                                            class="btn btn-outline-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button class="btn btn-outline-danger"
                                                            onclick="deleteMenu({{ $menu->id }}, '{{ $menu->nama_menu }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($menus->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $menus->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                                <h5>Belum ada menu</h5>
                                <p class="text-muted mb-3">UMKM ini belum menambahkan menu apapun</p>
                                <a href="{{ route('admin.menu.create', ['umkm_id' => $umkm->id]) }}" class="btn btn-admin">
                                    <i class="fas fa-plus me-2"></i> Tambah Menu Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tab 3: Pesanan -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-clipboard-list me-2"></i> Riwayat Pesanan Terbaru
                    </div>
                    <div class="card-body">
                        @if($recentOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <th>Pelanggan</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td><strong>#{{ $order->kode_pesanan }}</strong></td>
                                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                                <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending' => 'warning',
                                                            'proses' => 'info',
                                                            'selesai' => 'success',
                                                            'batal' => 'danger'
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.pesanan.show', $order->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3 text-end">
                                <a href="{{ route('admin.pesanan', ['umkm_id' => $umkm->id]) }}" class="btn btn-admin">
                                    Lihat Semua Pesanan <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <h5>Belum ada pesanan</h5>
                                <p class="text-muted">UMKM ini belum menerima pesanan apapun</p>
                                <a href="{{ route('admin.pesanan.create', ['umkm_id' => $umkm->id]) }}" class="btn btn-admin">
                                    <i class="fas fa-plus me-2"></i> Buat Pesanan Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tab 4: Dokumen -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-file-alt me-2"></i> Dokumen UMKM
                    </div>
                    <div class="card-body">
                        @if($umkm->dokumen && count(json_decode($umkm->dokumen)) > 0)
                            <div class="row">
                                @foreach(json_decode($umkm->dokumen) as $doc)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border">
                                            <div class="card-body text-center">
                                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                                <h6>{{ $doc->nama }}</h6>
                                                <small class="text-muted">Ukuran: {{ round($doc->size / 1024, 2) }} KB</small><br>
                                                <small class="text-muted">Diunggah:
                                                    {{ \Carbon\Carbon::parse($doc->tanggal)->format('d/m/Y') }}</small>
                                                <div class="mt-3">
                                                    <a href="{{ asset('storage/' . $doc->path) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary me-2">
                                                        <i class="fas fa-eye"></i> Lihat
                                                    </a>
                                                    <a href="{{ asset('storage/' . $doc->path) }}" download
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-download"></i> Unduh
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                <h5>Belum ada dokumen</h5>
                                <p class="text-muted">UMKM ini belum mengunggah dokumen apapun</p>
                                <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-upload me-2"></i> Upload Dokumen
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                    </div>
                    <p class="text-center">Apakah Anda yakin ingin menghapus UMKM <strong id="deleteUmkmName"></strong>?</p>
                    <p class="text-danger text-center small">Semua data terkait (menu, pesanan, dll) juga akan dihapus!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Menu Modal -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apakah Anda yakin ingin menghapus menu <strong id="deleteMenuName"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteMenuForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Delete Confirmation for UMKM
        function confirmDelete(id, name) {
            document.getElementById('deleteUmkmName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/umkm/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Delete Confirmation for Menu
        function deleteMenu(menuId, menuName) {
            document.getElementById('deleteMenuName').textContent = menuName;
            document.getElementById('deleteMenuForm').action = `/admin/menu/${menuId}`;
            new bootstrap.Modal(document.getElementById('deleteMenuModal')).show();
        }

        // Verify UMKM
        function verifyUmkm(id) {
            if (confirm('Verifikasi UMKM ini?')) {
                fetch(`/admin/umkm/${id}/verify`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('UMKM berhasil diverifikasi!');
                            location.reload();
                        } else {
                            alert('Gagal memverifikasi: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memverifikasi');
                    });
            }
        }

        // Update Status
        function updateStatus(id, status) {
            const action = status === 'approved' ? 'mengaktifkan' : 'menonaktifkan';
            if (confirm(`Apakah Anda yakin ingin ${action} UMKM ini?`)) {
                fetch(`/admin/umkm/${id}/status`, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ status: status })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(`Status berhasil diubah menjadi ${status}`);
                            location.reload();
                        } else {
                            alert('Gagal mengubah status: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengubah status');
                    });
            }
        }

        // Print UMKM Info
        function printUmkmInfo() {
            const printContent = `
                    <html>
                    <head>
                        <title>Detail UMKM - {{ $umkm->nama_umkm }}</title>
                        <style>
                            body { font-family: Arial; padding: 20px; }
                            .header { text-align: center; margin-bottom: 30px; }
                            .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                            .info-table td { padding: 8px; border-bottom: 1px solid #ddd; }
                            .info-table tr:last-child td { border-bottom: none; }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h1>Detail UMKM - {{ $umkm->nama_umkm }}</h1>
                            <p>Dicetak pada: ${new Date().toLocaleString()}</p>
                        </div>

                        <table class="info-table">
                            <tr><td><strong>Nama UMKM:</strong></td><td>{{ $umkm->nama_umkm }}</td></tr>
                            <tr><td><strong>Kategori:</strong></td><td>{{ $umkm->kategori }}</td></tr>
                            <tr><td><strong>Pemilik:</strong></td><td>{{ $umkm->user->name ?? 'N/A' }}</td></tr>
                            <tr><td><strong>Telepon:</strong></td><td>{{ $umkm->telepon }}</td></tr>
                            <tr><td><strong>Email:</strong></td><td>{{ $umkm->email }}</td></tr>
                            <tr><td><strong>Alamat:</strong></td><td>{{ $umkm->alamat }}</td></tr>
                            <tr><td><strong>Kota:</strong></td><td>{{ $umkm->kota }}</td></tr>
                            <tr><td><strong>Jam Operasi:</strong></td><td>{{ $umkm->jam_buka }} - {{ $umkm->jam_tutup }}</td></tr>
                            <tr><td><strong>Status:</strong></td><td>{{ ucfirst($umkm->status) }}</td></tr>
                            <tr><td><strong>Bergabung:</strong></td><td>{{ $umkm->created_at->format('d F Y') }}</td></tr>
                        </table>

                        <p style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
                            Dicetak dari Sistem AntriUMKM Admin
                        </p>
                    </body>
                    </html>
                `;

            const printWindow = window.open('', '_blank');
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.print();
        }

        // Export UMKM Data
        function exportUmkmData() {
            window.open(`/admin/umkm/{{ $umkm->id }}/export/pdf`, '_blank');
        }

        // Tab persistence
        document.addEventListener('DOMContentLoaded', function () {
            const tabEl = document.querySelector('button[data-bs-toggle="tab"]');
            if (tabEl) {
                tabEl.addEventListener('shown.bs.tab', function (e) {
                    localStorage.setItem('activeTab', e.target.getAttribute('data-bs-target'));
                });

                const activeTab = localStorage.getItem('activeTab');
                if (activeTab) {
                    const triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
                    if (triggerEl) {
                        new bootstrap.Tab(triggerEl).show();
                    }
                }
            }
        });
    </script>
@endsection