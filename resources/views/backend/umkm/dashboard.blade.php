@extends('backend.umkm.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @if($umkm->logo)
                                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="Logo" class="rounded-circle" width="60"
                                    height="60" style="object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="fas fa-store fa-2x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-1">Selamat Datang, {{ Auth::user()->name }}!</h4>
                            <p class="text-muted mb-0">Kelola {{ $umkm->nama_umkm }} dari sini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="col-md-3 col-6">
            <div class="stats-card purple">
                <div class="stats-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stats-number">{{ $todayOrdersCount }}</div>
                <div class="stats-label">Pesanan Hari Ini</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stats-card orange">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-number">{{ $pendingOrdersCount }}</div>
                <div class="stats-label">Menunggu Konfirmasi</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stats-card green">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-number">{{ $completedOrdersCount }}</div>
                <div class="stats-label">Pesanan Selesai</div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stats-card blue">
                <div class="stats-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <div class="stats-number">{{ $totalMenus }}</div>
                <div class="stats-label">Total Menu</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h5 class="mb-0">Pesanan Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 ps-4">ID Pesanan</th>
                                    <th class="border-0">Pelanggan</th>
                                    <th class="border-0">Menu</th>
                                    <th class="border-0">Total</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0 pe-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td class="ps-4 fw-bold">ORD-{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                                        <td>
                                            @foreach($order->items as $item)
                                                <div class="small">{{ $item->menu->nama_menu ?? $item->menu_name }}
                                                    (x{{ $item->quantity }})</div>
                                            @endforeach
                                        </td>
                                        <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $order->status == 'completed' ? 'bg-success' : ($order->status == 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="{{ route('umkm.orders.index') }}" class="btn btn-sm btn-light">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-clipboard-list fa-3x mb-3 opacity-50"></i>
                                            <p>Belum ada pesanan terbaru saat ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Status -->
        <div class="col-lg-4">
            <!-- Shop Status -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Status Toko</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span>Status Operasional</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Buka</label>
                        </div>
                    </div>
                    <p class="text-muted small mb-0">
                        <i class="fas fa-info-circle me-1"></i>
                        Matikan tombol ini jika Anda ingin menutup toko sementara. Pelanggan tidak akan bisa membuat pesanan
                        baru.
                    </p>
                </div>
            </div>

            <!-- Quick Menu -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <div class="d-grid gap-2">
                            <a href="{{ route('umkm.menu.create') }}" class="btn btn-outline-primary text-start">
                                <i class="fas fa-plus-circle me-2"></i> Tambah Menu Baru
                            </a>
                            <a href="{{ route('umkm.edit') }}" class="btn btn-outline-secondary text-start">
                                <i class="fas fa-edit me-2"></i> Edit Profil Toko
                            </a>
                            <a href="{{ route('umkm.qrcode') }}" class="btn btn-outline-info text-start">
                                <i class="fas fa-qrcode me-2"></i> Lihat QR Code Toko
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection