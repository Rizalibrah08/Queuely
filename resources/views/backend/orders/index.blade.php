<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan - AntriUMKM</title>
    
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

        .nav-icon:hover, .nav-icon.active {
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
    
    <!-- Tabs Navigation -->
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
    
    <!-- Tab Content -->
    <div class="container">
        <div class="tab-content-wrapper">
            <!-- Tab Aktif -->
            <div class="tab-content active" id="active-content">
                <!-- Queue Status -->
                <div class="queue-status">
                    <div class="queue-header">
                        <div class="queue-title">Antrian Aktif</div>
                        <div class="queue-number">A-016</div>
                    </div>
                    
                    <div class="queue-progress">
                        <div class="progress-info">
                            <div class="progress-label">Proses Antrian</div>
                            <div class="progress-value">4 orang di depan</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar" id="queueProgressBar" style="width: 20%;"></div>
                        </div>
                    </div>
                    
                    <div class="queue-estimation">
                        <div class="estimation-time" id="estimationTime">≈ 20 menit</div>
                        <div class="estimation-label">Estimasi Waktu Tunggu</div>
                    </div>
                    
                    <div class="queue-update">
                        <i class="fas fa-info-circle"></i> Sedang dilayani: <strong id="currentQueueNum">A-012</strong>
                    </div>
                </div>
                
                <!-- Active Orders -->
                <div class="order-section">
                    <h3 class="section-title">Pesanan Aktif</h3>
                    
                    <!-- Order 1 -->
                    <div class="order-card active">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0012</div>
                                <div class="order-date">12 Mar 2024, 14:30</div>
                            </div>
                            <div class="order-status status-active">Dalam Antrian</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Warung Sederhana">
                            </div>
                            <div class="merchant-info">
                                <h4>Warung Makan Sederhana</h4>
                                <p>Jl. Mangga Besar No. 45, Jakarta Pusat</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-utensils"></i> 3 item
                            </div>
                            <div class="order-total">Rp 35.000</div>
                        </div>
                        
                        <div class="order-actions">
                            <button class="order-btn btn-primary">Lihat Status Antrian</button>
                            <button class="order-btn btn-outline">Detail Pesanan</button>
                        </div>
                    </div>
                    
                    <!-- Order 2 -->
                    <div class="order-card active">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0011</div>
                                <div class="order-date">11 Mar 2024, 10:15</div>
                            </div>
                            <div class="order-status status-pending">Menunggu Konfirmasi</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Kopi Teman Sejati">
                            </div>
                            <div class="merchant-info">
                                <h4>Kopi Teman Sejati</h4>
                                <p>Jl. Sudirman No. 78, Jakarta Selatan</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-coffee"></i> 2 item
                            </div>
                            <div class="order-total">Rp 43.000</div>
                        </div>
                        
                        <div class="order-actions">
                            <button class="order-btn btn-outline">Batalkan Pesanan</button>
                            <button class="order-btn btn-primary">Hubungi Penjual</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tab Selesai -->
            <div class="tab-content" id="completed-content">
                <div class="order-section">
                    <h3 class="section-title">Pesanan Selesai</h3>
                    
                    <!-- Order 1 -->
                    <div class="order-card completed">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0010</div>
                                <div class="order-date">10 Mar 2024, 18:45</div>
                            </div>
                            <div class="order-status status-completed">Selesai</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/5f/KFC_logo_%282015%29.svg/2560px-KFC_logo_%282015%29.svg.png" alt="KFC">
                            </div>
                            <div class="merchant-info">
                                <h4>KFC - PASARAYA MANGGARAI</h4>
                                <p>Jl. Pasaraya Manggarai No. 12, Jakarta Selatan</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-hamburger"></i> 2 item
                            </div>
                            <div class="order-total">Rp 105.000</div>
                        </div>
                        
                        <div class="order-actions">
                            <button class="order-btn btn-outline">Beri Ulasan</button>
                            <button class="order-btn btn-primary">Pesan Lagi</button>
                        </div>
                    </div>
                    
                    <!-- Order 2 -->
                    <div class="order-card completed">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0009</div>
                                <div class="order-date">9 Mar 2024, 12:20</div>
                            </div>
                            <div class="order-status status-completed">Selesai</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Warung Sederhana">
                            </div>
                            <div class="merchant-info">
                                <h4>Warung Makan Sederhana</h4>
                                <p>Jl. Mangga Besar No. 45, Jakarta Pusat</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-utensils"></i> 2 item
                            </div>
                            <div class="order-total">Rp 43.000</div>
                        </div>
                        
                        <div class="order-actions">
                            <button class="order-btn btn-outline">Lihat Ulasan</button>
                            <button class="order-btn btn-primary">Pesan Lagi</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tab Semua -->
            <div class="tab-content" id="all-content">
                <!-- Order Aktif -->
                <div class="order-section">
                    <h3 class="section-title">Pesanan Aktif</h3>
                    
                    <div class="order-card active">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0012</div>
                                <div class="order-date">12 Mar 2024, 14:30</div>
                            </div>
                            <div class="order-status status-active">Dalam Antrian</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Warung Sederhana">
                            </div>
                            <div class="merchant-info">
                                <h4>Warung Makan Sederhana</h4>
                                <p>Jl. Mangga Besar No. 45, Jakarta Pusat</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-utensils"></i> 3 item
                            </div>
                            <div class="order-total">Rp 35.000</div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Selesai -->
                <div class="order-section">
                    <h3 class="section-title">Pesanan Selesai</h3>
                    
                    <div class="order-card completed">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0010</div>
                                <div class="order-date">10 Mar 2024, 18:45</div>
                            </div>
                            <div class="order-status status-completed">Selesai</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/5f/KFC_logo_%282015%29.svg/2560px-KFC_logo_%282015%29.svg.png" alt="KFC">
                            </div>
                            <div class="merchant-info">
                                <h4>KFC - PASARAYA MANGGARAI</h4>
                                <p>Jl. Pasaraya Manggarai No. 12, Jakarta Selatan</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-hamburger"></i> 2 item
                            </div>
                            <div class="order-total">Rp 105.000</div>
                        </div>
                    </div>
                    
                    <!-- Order Dibatalkan -->
                    <div class="order-card cancelled">
                        <div class="order-header">
                            <div>
                                <div class="order-id">ORD-2024-0008</div>
                                <div class="order-date">8 Mar 2024, 16:10</div>
                            </div>
                            <div class="order-status status-cancelled">Dibatalkan</div>
                        </div>
                        
                        <div class="order-merchant">
                            <div class="merchant-logo">
                                <img src="https://images.unsplash.com/photo-1565299585323-38d6b0865b47?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80" alt="Martabak">
                            </div>
                            <div class="merchant-info">
                                <h4>Martabak Manis 89</h4>
                                <p>Jl. Sudirman No. 123, Jakarta Selatan</p>
                            </div>
                        </div>
                        
                        <div class="order-summary">
                            <div class="items-count">
                                <i class="fas fa-cookie-bite"></i> 1 item
                            </div>
                            <div class="order-total">Rp 45.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- INCLUDE FOOTER -->
    @include('components.bottom-nav')
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                link.addEventListener('click', function() {
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
            
            // Simulasi update antrian
            let currentQueue = 12;
            let myQueue = 16;
            let peopleAhead = myQueue - currentQueue;
            let progressPercentage = Math.min(Math.round((1 - (peopleAhead / (peopleAhead + 5))) * 100), 100);
            
            function updateQueueStatus() {
                const progressBar = document.getElementById('queueProgressBar');
                const progressValue = document.querySelector('.progress-value');
                const estimationTime = document.getElementById('estimationTime');
                const queueNumber = document.querySelector('.queue-number');
                const currentQueueNum = document.getElementById('currentQueueNum');
                
                if (peopleAhead > 0) {
                    peopleAhead--;
                    currentQueue++;
                    progressPercentage = Math.min(Math.round((1 - (peopleAhead / (peopleAhead + 5))) * 100), 100);
                    
                    // Update UI
                    if (progressBar) progressBar.style.width = `${progressPercentage}%`;
                    if (progressValue) progressValue.textContent = `${peopleAhead} orang di depan`;
                    if (estimationTime) estimationTime.textContent = `≈ ${peopleAhead * 5} menit`;
                    if (queueNumber) queueNumber.textContent = `A-${myQueue.toString().padStart(3, '0')}`;
                    if (currentQueueNum) currentQueueNum.textContent = `A-${currentQueue.toString().padStart(3, '0')}`;
                    
                    // Jika sudah sampai nomor kita
                    if (peopleAhead === 0) {
                        if (progressValue) progressValue.textContent = "SELANJUTNYA!";
                        if (estimationTime) estimationTime.textContent = "Giliran Anda";
                        clearInterval(queueInterval);
                    }
                }
            }
            
            // Update antrian setiap 30 detik (simulasi)
            const queueInterval = setInterval(updateQueueStatus, 30000);
            
            // Event listeners untuk tombol aksi
            document.querySelectorAll('.order-btn').forEach(btn => {
                btn.addEventListener('click', function() {
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
                document.getElementById('orderDetailModal').addEventListener('hidden.bs.modal', function() {
                    this.remove();
                });
            }
        });
    </script>
</body>
</html>