@extends('backend.umkm.layout')

@section('title', 'Pesanan Masuk')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-0">Pesanan Masuk</h2>
            <p class="text-muted mb-0">Kelola pesanan yang masuk ke toko Anda</p>
        </div>
        <div class="col-md-6 text-md-end">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary active">Semua</button>
                <button type="button" class="btn btn-outline-secondary">Perlu Diproses</button>
                <button type="button" class="btn btn-outline-secondary">Selesai</button>
            </div>
        </div>
    </div>

    <!-- Statistik Ringkas -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white"
                style="background: linear-gradient(135deg, #AB886D 0%, #C9A688 100%);">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50">Pesanan Baru</h6>
                            <h3 class="mb-0 fw-bold">{{ $activeOrders->count() }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-bell fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Pendapatan</h6>
                            <h3 class="mb-0 fw-bold text-dark">Rp
                                {{ number_format($orders->where('status', 'completed')->sum('total_amount'), 0, ',', '.') }}
                            </h3>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 text-success">
                            <i class="fas fa-coins fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Selesai Hari Ini</h6>
                            <h3 class="mb-0 fw-bold text-dark">{{ $completedOrders->count() }}</h3>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 text-info">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">ID Pesanan</th>
                            <th class="py-3">Pelanggan</th>
                            <th class="py-3">Menu Dipesan</th>
                            <th class="py-3">Total</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Waktu</th>
                            <th class="text-end pe-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold">#{{ $order->id }}</span>
                                    @if($order->queue_number)
                                        <br><small class="text-muted">Antrian: {{ $order->queue_number }}</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                            style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-secondary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $order->user->name }}</div>
                                            <small class="text-muted">{{ $order->user->phone }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach($order->items as $item)
                                            <li>{{ $item->quantity }}x {{ $item->menu_name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-primary">Sedang Diproses</span>
                                    @elseif($order->status == 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $order->created_at->diffForHumans() }}
                                </td>
                                <td class="text-end pe-4">
                                    @if($order->status == 'pending')
                                        <form action="{{ route('umkm.orders.update-status', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="processing">
                                            <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">
                                                <i class="fas fa-check me-1"></i> Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('umkm.orders.update-status', $order->id) }}" method="POST"
                                            class="d-inline ms-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                title="Tolak">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif($order->status == 'processing')
                                        <form action="{{ route('umkm.orders.update-status', $order->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">
                                                <i class="fas fa-check-double me-1"></i> Selesai
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3 opacity-25">
                                        <i class="fas fa-receipt fa-4x"></i>
                                    </div>
                                    <h5 class="text-muted">Belum ada pesanan masuk</h5>
                                    <p class="text-muted small">Pesanan dari pelanggan akan muncul di sini</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection