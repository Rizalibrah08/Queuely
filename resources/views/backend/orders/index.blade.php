<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - Queuely</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
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
            padding-top: 0;
            color: var(--color-dark);
            background-color: #f8f9fa;
            padding-bottom: 80px;
        }

        /* Header Atas */
        .top-header {
            padding: 12px 0;
            background-color: white;
            position: relative;
            z-index: 1030;
            border-bottom: 1px solid var(--color-light);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--color-dark);
            text-decoration: none;
        }

        .logo span {
            color: var(--color-brown);
        }

        /* Page Header */
        .page-header {
            background-color: white;
            padding: 20px 0 10px 0;
            position: relative;
            z-index: 1020;
        }

        .page-title-section {
            padding-bottom: 5px;
        }

        .page-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 4px;
            font-size: 1.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 0.9rem;
            font-weight: 400;
        }

        /* Tabs Navigation */
        .orders-tabs-container {
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 1010;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border-bottom: 1px solid var(--color-light);
        }

        .orders-tabs {
            display: flex;
            padding: 0;
            margin: 0;
            list-style: none;
            position: relative;
        }

        .orders-tabs::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--color-light);
            z-index: 1;
        }

        .tab-item {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .tab-link {
            display: block;
            padding: 16px 10px;
            text-decoration: none;
            color: #888;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
            position: relative;
            z-index: 2;
        }

        .tab-link:hover {
            color: var(--color-dark);
        }

        .tab-link.active {
            color: var(--color-dark);
        }

        .tab-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20%;
            right: 20%;
            height: 3px;
            background-color: var(--color-brown);
            border-radius: 3px 3px 0 0;
            z-index: 3;
        }

        .tab-indicator {
            position: absolute;
            bottom: 0;
            height: 3px;
            background-color: var(--color-brown);
            border-radius: 3px 3px 0 0;
            transition: all 0.3s ease;
            z-index: 2;
        }

        /* Order Cards */
        .order-section {
            padding: 20px 0;
        }

        .section-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 15px;
            padding-left: 10px;
            position: relative;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: var(--color-brown);
            border-radius: 2px;
        }

        .order-card {
            background-color: white;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 15px;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--color-brown);
            transition: all 0.3s;
        }

        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .order-card.active {
            border-left-color: #28a745;
        }

        .order-card.completed {
            border-left-color: #6c757d;
        }

        .order-card.cancelled {
            border-left-color: #dc3545;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .order-id {
            font-weight: 700;
            color: var(--color-dark);
            font-size: 0.95rem;
            margin-bottom: 3px;
        }

        .order-date {
            color: #888;
            font-size: 0.8rem;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            text-align: center;
            min-width: 75px;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #e2e3e5;
            color: #383d41;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .order-merchant {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--color-light);
        }

        .merchant-logo {
            width: 45px;
            height: 45px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 10px;
            border: 2px solid var(--color-beige);
            flex-shrink: 0;
        }

        .merchant-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .merchant-info {
            flex: 1;
            min-width: 0;
        }

        .merchant-info h4 {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 3px;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .merchant-info p {
            color: #666;
            font-size: 0.75rem;
            margin-bottom: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .order-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .items-count {
            color: #666;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
        }

        .items-count i {
            margin-right: 5px;
            color: var(--color-brown);
            font-size: 0.9rem;
        }

        .order-total {
            font-weight: 700;
            color: var(--color-dark);
            font-size: 1.05rem;
        }

        .order-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .order-btn {
            flex: 1;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--color-dark);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--color-brown);
            color: white;
        }

        .btn-outline {
            background-color: transparent;
            border: 1.5px solid var(--color-brown);
            color: var(--color-brown);
        }

        .btn-outline:hover {
            background-color: var(--color-brown);
            color: white;
        }

        /* Queue Status */
        .queue-status {
            background-color: white;
            border-radius: 12px;
            padding: 18px;
            margin: 15px 0 20px 0;
            box-shadow: var(--shadow);
        }

        .queue-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .queue-title {
            font-weight: 700;
            color: var(--color-dark);
            font-size: 1.05rem;
        }

        .queue-number {
            background-color: var(--color-beige);
            color: var(--color-dark);
            padding: 4px 12px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .queue-progress {
            margin-bottom: 15px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .progress-label {
            color: var(--color-dark);
            font-weight: 600;
            font-size: 0.8rem;
        }

        .progress-value {
            color: var(--color-brown);
            font-weight: 700;
            font-size: 0.8rem;
        }

        .progress-bar-container {
            height: 6px;
            background-color: var(--color-light);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--color-brown);
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .queue-estimation {
            background-color: rgba(214, 192, 179, 0.1);
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            margin-bottom: 12px;
        }

        .estimation-time {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--color-dark);
            margin-bottom: 3px;
        }

        .estimation-label {
            color: var(--color-brown);
            font-weight: 600;
            font-size: 0.8rem;
        }

        .queue-update {
            color: #666;
            font-size: 0.75rem;
            text-align: center;
        }

        .queue-update i {
            margin-right: 4px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .empty-icon {
            font-size: 2.2rem;
            color: var(--color-beige);
            margin-bottom: 15px;
        }

        .empty-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .empty-description {
            color: #666;
            margin-bottom: 20px;
            max-width: 280px;
            margin-left: auto;
            margin-right: auto;
            font-size: 0.85rem;
        }

        .explore-btn {
            background-color: var(--color-dark);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .explore-btn:hover {
            background-color: var(--color-brown);
        }

        /* Footer Sticky dengan Ikon */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            border-top: 1px solid var(--color-light);
            padding: 8px 0;
            z-index: 1000;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.08);
        }

        .nav-icons {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .nav-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--color-dark);
            transition: all 0.3s;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .nav-icon:hover,
        .nav-icon.active {
            color: var(--color-brown);
            background-color: var(--color-light);
        }

        .nav-icon i {
            font-size: 1.2rem;
            margin-bottom: 3px;
        }

        .nav-icon span {
            font-size: 0.65rem;
            font-weight: 500;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .order-actions {
                flex-direction: column;
            }

            .nav-icon span {
                font-size: 0.6rem;
            }

            .tab-link {
                font-size: 0.9rem;
                padding: 14px 8px;
            }
        }

        @media (max-width: 576px) {
            .top-header {
                padding: 10px 0;
            }

            .logo {
                font-size: 1.4rem;
            }

            .page-header {
                padding: 15px 0 8px 0;
            }

            .page-title {
                font-size: 1.3rem;
                margin-bottom: 3px;
            }

            .page-subtitle {
                font-size: 0.85rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-status {
                margin-top: 8px;
                align-self: flex-start;
            }

            .merchant-info h4 {
                font-size: 0.85rem;
            }

            .order-total {
                font-size: 1rem;
            }

            .nav-icon i {
                font-size: 1.1rem;
            }

            .nav-icon span {
                font-size: 0.55rem;
            }

            .tab-link {
                font-size: 0.85rem;
                padding: 12px 6px;
            }

            .tab-link.active::after {
                left: 15%;
                right: 15%;
            }

            .queue-title {
                font-size: 0.95rem;
            }

            .queue-number {
                font-size: 0.85rem;
                padding: 3px 10px;
            }
        }

        @media (max-width: 380px) {
            .tab-link {
                font-size: 0.8rem;
                padding: 10px 4px;
            }

            .nav-icon {
                padding: 3px 6px;
            }

            .nav-icon i {
                font-size: 1rem;
            }
        }

        /* Tab Content Toggle */
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Header Atas -->
    <div class="container-fluid top-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.index') }}" class="logo">Queue<span>ly</span></a>
                <div style="width: 60px;"></div> <!-- Spacer untuk balance layout -->
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="container-fluid page-header">
        <div class="container page-title-section">
            <h1 class="page-title">Pesanan Saya</h1>
            <p class="page-subtitle">Kelola pesanan dan pantau antrian Anda</p>
        </div>
    </div>

    <!-- Tabs Navigation (Only if Logged in AND has orders) -->
    @if(Auth::check() && $allOrders->isNotEmpty())
        <div class="container-fluid orders-tabs-container">
            <div class="container">
                <div class="orders-tabs-wrapper">
                    <ul class="orders-tabs" id="ordersTabs">
                        <li class="tab-item">
                            <button class="tab-link active" data-target="active">Aktif</button>
                        </li>
                        <li class="tab-item">
                            <button class="tab-link" data-target="completed">Selesai</button>
                        </li>
                        <li class="tab-item">
                            <button class="tab-link" data-target="all">Semua</button>
                        </li>
                    </ul>
                    <div class="tab-indicator" id="tabIndicator"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="container">

        <!-- Guest or Empty State -->
        @if(!Auth::check())
            <div class="empty-state mt-5">
                <div class="empty-icon text-muted mb-4">
                    <i class="fas fa-lock fa-3x"></i>
                </div>
                <h4 class="empty-title mb-3">Anda belum login</h4>
                <p class="empty-description mb-4">Silakan login untuk melihat riwayat pesanan dan status antrian Anda.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('profile.index') }}" class="btn btn-primary px-4">Login / Register</a>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary px-4">Kembali ke Beranda</a>
                </div>
            </div>
        @elseif($allOrders->isEmpty())
            <div class="empty-state mt-5">
                <div class="empty-icon text-muted mb-4">
                    <i class="fas fa-clipboard-list fa-3x"></i>
                </div>
                <h4 class="empty-title mb-3">Belum ada pesanan</h4>
                <p class="empty-description mb-4">Anda belum pernah melakukan pemesanan. Mulai pesan sekarang!</p>
                <a href="{{ route('dashboard.index') }}" class="explore-btn px-4 py-2">Mulai Pesan</a>
            </div>
        @else

            <div class="tab-content-wrapper">
                <!-- Tab Aktif -->
                <div class="tab-content active" id="active-content">
                    <!-- Queue Status -->
                    <div class="queue-status">
                        @if($activeOrders->isEmpty())
                            <div class="text-center py-4">
                                <h4 class="text-muted"><i class="fas fa-check-circle me-2"></i>Tidak ada antrian aktif</h4>
                                <p class="text-muted small">Semua pesanan Anda telah selesai.</p>
                            </div>
                        @else
                            @php $activeOrder = $activeOrders->first(); @endphp
                            <div class="queue-header">
                                <div class="queue-title">Antrian Aktif</div>
                                <div class="queue-number">{{ $activeOrder->queue_number }}</div>
                            </div>

                            <div class="queue-progress">
                                <div class="progress-info">
                                    <div class="progress-label">Proses Antrian</div>
                                    <div class="progress-value">
                                        @if($queueStats['peopleAhead'] == 0 && $activeOrder->status == 'processing')
                                            Giliran Anda!
                                        @else
                                            {{ $queueStats['peopleAhead'] }} orang di depan
                                        @endif
                                    </div>
                                </div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar"
                                        style="width: {{ $activeOrder->status == 'processing' ? '100%' : '30%' }};"></div>
                                </div>
                            </div>

                            <div class="queue-estimation">
                                <div class="estimation-time">≈ {{ $queueStats['estimatedWait'] }} menit</div>
                                <div class="estimation-label">Estimasi Waktu Tunggu</div>
                            </div>

                            <div class="queue-update">
                                <i class="fas fa-info-circle"></i> Sedang dilayani:
                                <strong>{{ $queueStats['servingQueue'] }}</strong>
                            </div>
                        @endif
                    </div>

                    <!-- Active Orders -->
                    <div class="order-section">
                        <h3 class="section-title">Pesanan Aktif</h3>

                        @forelse($activeOrders as $order)
                            <!-- Order Card -->
                            <div class="order-card active">
                                <div class="order-header">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="order-id">ORD-{{ $order->id }}</div>
                                            <span class="badge bg-secondary"
                                                style="font-size: 0.7rem;">{{ $order->queue_number }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div
                                        class="order-status @if($order->status == 'pending') status-pending @elseif($order->status == 'processing') status-active @endif">
                                        {{ ucfirst($order->status) }}
                                    </div>
                                </div>

                                <div class="order-merchant">
                                    <div class="merchant-logo">
                                        @if($order->umkm->logo)
                                            <img src="{{ asset('storage/' . $order->umkm->logo) }}"
                                                alt="{{ $order->umkm->nama_umkm }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center h-100 w-100">
                                                <i class="fas fa-store text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="merchant-info">
                                        <h4>{{ $order->umkm->nama_umkm }}</h4>
                                        <p>{{ $order->umkm->alamat }}</p>
                                    </div>
                                </div>

                                <div class="order-summary">
                                    <div class="items-count">
                                        <i class="fas fa-utensils"></i> {{ $order->items->sum('quantity') }} item
                                    </div>
                                    <div class="order-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>

                                <div class="order-actions">
                                    <button class="order-btn btn-primary">Lihat Status Antrian</button>
                                    <button class="order-btn btn-outline">Detail Pesanan</button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h5 class="empty-title">Tidak ada pesanan aktif</h5>
                                <p class="empty-description">Anda belum memiliki pesanan yang sedang berjalan saat ini.</p>
                                <a href="{{ route('dashboard.index') }}" class="explore-btn">Mulai Pesan</a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab Selesai -->
                <div class="tab-content" id="completed-content">
                    <div class="order-section">
                        <h3 class="section-title">Pesanan Selesai</h3>

                        @forelse($completedOrders as $order)
                            <div class="order-card completed">
                                <div class="order-header">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="order-id">ORD-{{ $order->id }}</div>
                                            <span class="badge bg-secondary"
                                                style="font-size: 0.7rem;">{{ $order->queue_number }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="order-status status-completed">Selesai</div>
                                </div>

                                <div class="order-merchant">
                                    <div class="merchant-logo">
                                        @if($order->umkm->logo)
                                            <img src="{{ asset('storage/' . $order->umkm->logo) }}"
                                                alt="{{ $order->umkm->nama_umkm }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center h-100 w-100">
                                                <i class="fas fa-store text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="merchant-info">
                                        <h4>{{ $order->umkm->nama_umkm }}</h4>
                                        <p>{{ $order->umkm->alamat }}</p>
                                    </div>
                                </div>

                                <div class="order-summary">
                                    <div class="items-count">
                                        <i class="fas fa-utensils"></i> {{ $order->items->sum('quantity') }} item
                                    </div>
                                    <div class="order-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>

                                <div class="order-actions">
                                    <button class="order-btn btn-primary">Pesan Lagi</button>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <h5 class="empty-title">Belum ada pesanan selesai</h5>
                                <p class="empty-description">Riwayat pesanan yang telah selesai akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab Semua -->
                <div class="tab-content" id="all-content">
                    <div class="order-section">
                        <h3 class="section-title">Semua Pesanan</h3>

                        @forelse($allOrders as $order)
                            <div
                                class="order-card {{ $order->status == 'completed' ? 'completed' : ($order->status == 'cancelled' ? 'cancelled' : 'active') }}">
                                <div class="order-header">
                                    <div>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="order-id">ORD-{{ $order->id }}</div>
                                            <span class="badge bg-secondary"
                                                style="font-size: 0.7rem;">{{ $order->queue_number }}</span>
                                        </div>
                                        <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div
                                        class="order-status {{ $order->status == 'completed' ? 'status-completed' : ($order->status == 'cancelled' ? 'status-cancelled' : 'status-active') }}">
                                        {{ ucfirst($order->status) }}
                                    </div>
                                </div>

                                <div class="order-merchant">
                                    <div class="merchant-logo">
                                        @if($order->umkm->logo)
                                            <img src="{{ asset('storage/' . $order->umkm->logo) }}"
                                                alt="{{ $order->umkm->nama_umkm }}">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center h-100 w-100">
                                                <i class="fas fa-store text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="merchant-info">
                                        <h4>{{ $order->umkm->nama_umkm }}</h4>
                                        <p>{{ $order->umkm->alamat }}</p>
                                    </div>
                                </div>

                                <div class="order-summary">
                                    <div class="items-count">
                                        <i class="fas fa-utensils"></i> {{ $order->items->sum('quantity') }} item
                                    </div>
                                    <div class="order-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <h5 class="empty-title">Belum ada riwayat pesanan</h5>
                                <p class="empty-description">Semua riwayat pesanan Anda akan muncul di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- INCLUDE FOOTER -->
    @include('components.bottom-nav')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tab Navigation
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');
            const tabIndicator = document.getElementById('tabIndicator');

            // Set initial indicator position
            function setIndicatorPosition() {
                const activeTab = document.querySelector('.tab-link.active');
                if (activeTab && tabIndicator) {
                    const tabItem = activeTab.closest('.tab-item');
                    const tabRect = tabItem.getBoundingClientRect();
                    const tabsRect = document.querySelector('.orders-tabs').getBoundingClientRect();

                    tabIndicator.style.left = `${tabRect.left - tabsRect.left}px`;
                    tabIndicator.style.width = `${tabRect.width}px`;
                }
            }

            // Tab switching
            tabLinks.forEach(link => {
                link.addEventListener('click', function () {
                    const target = this.getAttribute('data-target');

                    // Update active tab
                    tabLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    // Update indicator position
                    setIndicatorPosition();

                    // Show target content
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === `${target}-content`) {
                            content.classList.add('active');
                        }
                    });
                });
            });

            // Initialize indicator position
            setTimeout(setIndicatorPosition, 100);
            window.addEventListener('resize', setIndicatorPosition);

            // Simulasi update antrian REMOVED (Real Data Connected)

            // Event listeners untuk tombol aksi
            document.querySelectorAll('.order-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const btnText = this.textContent;
                    const orderCard = this.closest('.order-card');
                    const orderId = orderCard.querySelector('.order-id').textContent;
                    const merchantName = orderCard.querySelector('.merchant-info h4').textContent;

                    if (btnText.includes('Lihat Status Antrian')) {
                        alert(`Melihat status antrian untuk ${orderId} - ${merchantName}`);
                    } else if (btnText.includes('Detail Pesanan')) {
                        // Tampilkan modal detail pesanan
                        showOrderDetailModal(orderCard);
                    } else if (btnText.includes('Batalkan Pesanan')) {
                        if (confirm(`Apakah Anda yakin ingin membatalkan pesanan ${orderId}?`)) {
                            orderCard.classList.remove('active');
                            orderCard.classList.add('cancelled');
                            orderCard.querySelector('.order-status').className = 'order-status status-cancelled';
                            orderCard.querySelector('.order-status').textContent = 'Dibatalkan';

                            // Update tombol aksi
                            const actionsDiv = orderCard.querySelector('.order-actions');
                            actionsDiv.innerHTML = `
                                <button class="order-btn btn-outline">Lihat Detail</button>
                                <button class="order-btn btn-primary">Pesan Lagi</button>
                            `;

                            alert(`Pesanan ${orderId} berhasil dibatalkan`);
                        }
                    } else if (btnText.includes('Hubungi Penjual')) {
                        alert(`Membuka chat dengan ${merchantName} untuk pesanan ${orderId}`);
                    } else if (btnText.includes('Beri Ulasan')) {
                        alert(`Membuka form ulasan untuk ${merchantName}`);
                    } else if (btnText.includes('Pesan Lagi')) {
                        alert(`Memulai pesanan baru dari ${merchantName}`);
                    } else if (btnText.includes('Lihat Ulasan')) {
                        alert(`Melihat ulasan untuk ${merchantName}`);
                    } else if (btnText.includes('Lihat Detail')) {
                        showOrderDetailModal(orderCard);
                    }
                });
            });

            // Fungsi untuk menampilkan modal detail pesanan
            function showOrderDetailModal(orderCard) {
                const orderId = orderCard.querySelector('.order-id').textContent;
                const merchantName = orderCard.querySelector('.merchant-info h4').textContent;
                const merchantAddress = orderCard.querySelector('.merchant-info p').textContent;
                const orderDate = orderCard.querySelector('.order-date').textContent;
                const orderStatus = orderCard.querySelector('.order-status').textContent;
                const orderTotal = orderCard.querySelector('.order-total').textContent;

                // Data dummy detail item pesanan
                const orderItems = {
                    'ORD-2024-0012': [
                        { name: 'Nasi Goreng Spesial', qty: 1, price: 25000 },
                        { name: 'Es Teh Manis', qty: 2, price: 10000 },
                        { name: 'Biaya Antrian', qty: 1, price: 0 }
                    ],
                    'ORD-2024-0011': [
                        { name: 'Espresso Double', qty: 1, price: 25000 },
                        { name: 'Croissant', qty: 1, price: 18000 }
                    ],
                    'ORD-2024-0010': [
                        { name: 'Super Treat', qty: 1, price: 90000 },
                        { name: 'Extra Cola', qty: 1, price: 15000 }
                    ],
                    'ORD-2024-0009': [
                        { name: 'Ayam Bakar', qty: 1, price: 35000 },
                        { name: 'Es Jeruk', qty: 1, price: 8000 }
                    ],
                    'ORD-2024-0008': [
                        { name: 'Martabak Coklat Keju', qty: 1, price: 45000 }
                    ]
                };

                // Buat modal HTML
                const modalHTML = `
                    <div class="modal fade" id="orderDetailModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header" style="border-bottom-color: var(--color-beige);">
                                    <h5 class="modal-title" style="font-weight: 700; color: var(--color-dark);">Detail Pesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <h6 style="font-weight: 600; color: var(--color-dark);">${orderId}</h6>
                                        <p class="mb-1" style="color: #666; font-size: 0.9rem;">${orderDate}</p>
                                        <span class="badge ${orderCard.querySelector('.order-status').className}" style="font-size: 0.75rem;">${orderStatus}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <h6 style="font-weight: 600; color: var(--color-dark);">${merchantName}</h6>
                                        <p style="color: #666; font-size: 0.9rem;">${merchantAddress}</p>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <h6 style="font-weight: 600; color: var(--color-dark); border-bottom: 1px solid var(--color-light); padding-bottom: 5px;">Item Pesanan</h6>
                                        <div id="orderItemsList">
                                            ${orderItems[orderId] ? orderItems[orderId].map(item => `
                                                <div class="d-flex justify-content-between py-2 border-bottom" style="border-bottom-color: #f0f0f0 !important;">
                                                    <div>
                                                        <div style="font-weight: 500; color: var(--color-dark);">${item.name}</div>
                                                        <small style="color: #888;">${item.qty}x</small>
                                                    </div>
                                                    <div style="font-weight: 600; color: var(--color-dark);">
                                                        Rp ${item.price.toLocaleString('id-ID')}
                                                    </div>
                                                </div>
                                            `).join('') : '<p class="text-center py-3">Detail item tidak tersedia</p>'}
                                        </div>
                                    </div>
                                    
                                    <div class="pt-2 border-top" style="border-top-color: var(--color-beige) !important;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="font-weight: 700; color: var(--color-dark); font-size: 1.1rem;">Total</div>
                                            <div style="font-weight: 800; color: var(--color-dark); font-size: 1.2rem;">${orderTotal}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top-color: var(--color-light);">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: var(--color-brown); color: var(--color-brown);">Tutup</button>
                                    ${orderStatus === 'Selesai' ?
                        '<button type="button" class="btn btn-primary" style="background-color: var(--color-dark); border-color: var(--color-dark);" onclick="alert(\'Membuka form ulasan\')">Beri Ulasan</button>' :
                        orderStatus === 'Dalam Antrian' ?
                            '<button type="button" class="btn btn-primary" style="background-color: var(--color-dark); border-color: var(--color-dark);" onclick="alert(\'Melihat status antrian\')">Lihat Antrian</button>' :
                            ''
                    }
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Tambahkan modal ke body
                const modalContainer = document.createElement('div');
                modalContainer.innerHTML = modalHTML;
                document.body.appendChild(modalContainer.firstElementChild);

                // Tampilkan modal
                const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
                modal.show();

                // Hapus modal setelah ditutup
                document.getElementById('orderDetailModal').addEventListener('hidden.bs.modal', function () {
                    this.remove();
                });
            }
        });
    </script>
</body>

</html>