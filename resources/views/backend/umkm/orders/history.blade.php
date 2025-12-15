@extends('backend.umkm.layout')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-0">Riwayat Pesanan</h2>
            <p class="text-muted mb-0">Arsip pesanan yang telah selesai atau dibatalkan</p>
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
                                    @if($order->status == 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="text-end pe-4">
                                    <!-- Future functionality: Detail or Re-print -->
                                    <button class="btn btn-sm btn-outline-secondary rounded-circle" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3 opacity-25">
                                        <i class="fas fa-history fa-4x"></i>
                                    </div>
                                    <h5 class="text-muted">Belum ada riwayat pesanan</h5>
                                    <p class="text-muted small">Pesanan yang selesai atau dibatalkan akan muncul di sini</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection