<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queuely - Sistem Antrian Online UMKM</title>

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
            background-color: #fefefe;
            padding-bottom: 80px;
            /* Tambah padding untuk footer sticky */
        }

        /* Header Atas */
        .top-header {
            padding: 15px 0;
            background-color: white;
            position: relative;
            z-index: 1030;
            border-bottom: 1px solid var(--color-light);
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--color-dark);
            text-decoration: none;
        }

        .logo span {
            color: var(--color-brown);
        }

        .location-btn {
            background-color: transparent;
            border: none;
            padding: 8px 0;
            font-weight: 500;
            color: var(--color-dark);
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .location-btn:hover {
            color: var(--color-brown);
        }

        .location-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        /* Banner Promo */
        .promo-banner {
            background-color: var(--color-dark);
            color: white;
            padding: 0;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            height: 180px;
        }

        .promo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.9;
        }

        .promo-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            background: linear-gradient(to right, rgba(73, 54, 40, 0.8), rgba(73, 54, 40, 0.5));
        }

        .promo-content h2 {
            font-weight: 800;
            font-size: 1.8rem;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .promo-content p {
            font-size: 1rem;
            margin-bottom: 0;
            max-width: 600px;
        }

        /* Search Bar Container - STICKY */
        .search-container {
            background-color: white;
            padding: 15px 0 10px 0;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .search-container.sticky {
            position: sticky;
            top: 0;
            z-index: 1020;
            box-shadow: var(--shadow);
            padding: 12px 0 7px 0;
        }

        .search-box {
            background-color: var(--color-light);
            border-radius: 50px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border: 1px solid var(--color-beige);
            transition: all 0.3s;
        }

        .search-box:focus-within {
            background-color: white;
            box-shadow: 0 0 0 2px rgba(171, 136, 109, 0.3);
            border-color: var(--color-brown);
        }

        .search-box i {
            color: var(--color-brown);
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .search-input {
            border: none;
            background: transparent;
            flex-grow: 1;
            font-size: 1rem;
            outline: none;
            color: var(--color-dark);
        }

        .search-input::placeholder {
            color: #888;
        }

        .search-btn {
            background-color: var(--color-dark);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background-color: var(--color-brown);
        }

        /* Countdown Antrian - UPDATED */
        .queue-countdown {
            background-color: var(--color-beige);
            border-radius: 10px;
            padding: 20px;
            margin: 15px 0 25px 0;
            box-shadow: var(--shadow);
        }

        .queue-countdown h4 {
            color: var(--color-dark);
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
        }

        .queue-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-box {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            border: 2px solid var(--color-beige);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--color-dark);
            font-family: monospace;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--color-brown);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .queue-progress {
            margin: 20px 0;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .progress-label {
            color: var(--color-dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .progress-percentage {
            color: var(--color-brown);
            font-weight: 700;
            font-size: 0.9rem;
        }

        .progress-bar-container {
            height: 12px;
            background-color: var(--color-light);
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--color-brown);
            border-radius: 6px;
            transition: width 0.5s ease;
        }

        .queue-estimation {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            border: 2px solid var(--color-beige);
            text-align: center;
        }

        .estimation-time {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--color-dark);
            margin-bottom: 5px;
        }

        .estimation-label {
            color: var(--color-brown);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .queue-info {
            font-size: 0.9rem;
            color: var(--color-dark);
            margin-top: 15px;
            text-align: center;
        }

        .queue-btn {
            background-color: var(--color-dark);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s;
            width: 100%;
            max-width: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .queue-btn:hover {
            background-color: var(--color-brown);
            transform: translateY(-2px);
        }

        /* Kategori */
        .categories-section {
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--color-dark);
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--color-beige);
        }

        .category-card {
            text-align: center;
            padding: 12px 5px;
            border-radius: 10px;
            transition: all 0.3s;
            cursor: pointer;
            color: var(--color-dark);
            margin-bottom: 10px;
        }

        .category-card:hover {
            background-color: var(--color-light);
            transform: translateY(-3px);
        }

        .category-card.active {
            background-color: var(--color-beige);
            color: var(--color-dark);
            font-weight: 600;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--color-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            color: var(--color-dark);
            font-size: 1.3rem;
            transition: all 0.3s;
        }

        .category-card:hover .category-icon {
            background-color: var(--color-beige);
        }

        .category-card.active .category-icon {
            background-color: var(--color-dark);
            color: white;
        }

        /* Rekomendasi Tempat - Layout Baru dengan Logo */
        .place-card-new {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 25px;
            transition: all 0.3s;
            background-color: white;
            border: 1px solid var(--color-light);
            display: block;
        }

        .place-card-new:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
            border-color: var(--color-beige);
        }

        .place-header {
            padding: 15px 15px 10px 15px;
            border-bottom: 1px solid var(--color-light);
            display: flex;
            align-items: flex-start;
        }

        .place-logo {
            width: 70px;
            height: 70px;
            border-radius: 10px;
            overflow: hidden;
            margin-right: 15px;
            flex-shrink: 0;
            border: 2px solid var(--color-beige);
            background-color: white;
        }

        .place-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .place-info {
            flex: 1;
        }

        .place-name {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--color-dark);
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .place-location {
            color: var(--color-brown);
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .place-location i {
            margin-right: 5px;
        }

        .place-category {
            display: inline-block;
            background-color: var(--color-light);
            color: var(--color-dark);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* STATUS HANYA BUKA/TUTUP */
        .place-status {
            background-color: var(--color-light);
            color: var(--color-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
            text-align: center;
            min-width: 70px;
        }

        .place-status.open {
            background-color: #d4edda;
            color: #155724;
        }

        .place-status.closed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .place-promo-section {
            padding: 15px;
            background-color: rgba(214, 192, 179, 0.1);
            border-bottom: 1px solid var(--color-light);
        }

        .promo-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .promo-items {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 10px;
        }

        .promo-item {
            flex: 0 0 auto;
            width: 200px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--color-beige);
        }

        .promo-item-image {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .promo-item-content {
            padding: 10px;
        }

        .promo-item-name {
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 5px;
            font-size: 0.95rem;
        }

        .promo-item-price {
            font-weight: 800;
            color: var(--color-brown);
            font-size: 1rem;
        }

        .promo-item-old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 0.8rem;
            margin-left: 5px;
        }

        .place-footer {
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .view-outlets {
            color: var(--color-brown);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .view-outlets i {
            margin-left: 5px;
            transition: transform 0.3s;
        }

        .view-outlets:hover {
            color: var(--color-dark);
        }

        .view-outlets:hover i {
            transform: translateX(5px);
        }

        .place-distance {
            color: var(--color-dark);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .visit-btn-new {
            background-color: var(--color-dark);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .visit-btn-new:hover {
            background-color: var(--color-brown);
        }

        /* Responsif */
        @media (max-width: 768px) {
            .promo-banner {
                height: 150px;
            }

            .promo-content h2 {
                font-size: 1.5rem;
            }

            .promo-content p {
                font-size: 0.9rem;
            }

            .stat-value {
                font-size: 1.8rem;
            }

            .place-name {
                font-size: 1.2rem;
            }

            .place-logo {
                width: 60px;
                height: 60px;
            }

            .promo-item {
                width: 180px;
            }

            .location-btn span {
                display: none;
            }

            .location-btn strong {
                margin-left: 5px;
            }
        }

        @media (max-width: 576px) {
            .promo-banner {
                height: 130px;
            }

            .promo-content h2 {
                font-size: 1.3rem;
            }

            .search-btn {
                padding: 10px 15px;
                font-size: 0.9rem;
            }

            .queue-stats {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .stat-value {
                font-size: 1.6rem;
            }

            .place-name {
                font-size: 1.1rem;
                flex-direction: column;
                align-items: flex-start;
            }

            .place-logo {
                width: 50px;
                height: 50px;
                margin-right: 10px;
            }

            .place-status {
                margin-top: 5px;
            }

            .promo-item {
                width: 160px;
            }

            .promo-item-image {
                height: 100px;
            }
        }

        /* Efek untuk sticky search bar */
        .sticky-padding {
            height: 0;
            transition: height 0.3s ease;
        }

        .sticky-padding.active {
            height: 60px;
        }

        /* Scrollbar untuk promo items */
        .promo-items::-webkit-scrollbar {
            height: 5px;
        }

        .promo-items::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .promo-items::-webkit-scrollbar-thumb {
            background: var(--color-beige);
            border-radius: 10px;
        }

        .promo-items::-webkit-scrollbar-thumb:hover {
            background: var(--color-brown);
        }
    </style>
</head>

<body>
    <!-- Header Atas -->
    <div class="container-fluid top-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('dashboard.index') }}" class="logo">Queue<span>ly</span></a>
                <button class="location-btn">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Lokasi:</span>
                    <strong>Jakarta Pusat</strong>
                </button>
            </div>
        </div>
    </div>

    <!-- Banner Promo -->
    <div class="container-fluid promo-banner">
        <!-- Ganti URL gambar dengan gambar promo UMKM yang Anda sediakan -->
        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80"
            class="promo-image" alt="Promo Antrian Online">
        <div class="promo-content">
            <h2>Sistem Antrian Online UMKM</h2>
            <p>Atur antrian dengan mudah, tanpa biaya besar</p>
        </div>
    </div>

    <!-- Search Bar Container (STICKY) -->
    <div class="container-fluid search-container" id="searchContainer">
        <div class="container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Cari UMKM, makanan, atau lokasi...">
                <button class="search-btn">Cari</button>
            </div>
        </div>
    </div>

    <!-- Padding untuk efek saat search bar sticky -->
    <div class="sticky-padding" id="stickyPadding"></div>

    <!-- Konten Utama -->
    <div class="container">
        <!-- Countdown Antrian - UPDATED -->
        @if($activeQueue)
            <div class="queue-countdown">
                <h4>Status Antrian Anda</h4>

                <div class="queue-stats">
                    <div class="stat-box">
                        <div class="stat-value">{{ $servingQueue }}</div>
                        <div class="stat-label">Sedang Dilayani</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-value">{{ $activeQueue->queue_number }}</div>
                        <div class="stat-label">Nomor Antrian Anda</div>
                    </div>
                </div>

                <div class="queue-progress">
                    <div class="progress-info">
                        <div class="progress-label">Proses Antrian</div>
                        <div class="progress-percentage">
                            @if($peopleAhead == 0 && $activeQueue->status == 'processing')
                                100%
                            @else
                                {{ $peopleAhead > 0 ? 'Menunggu' : 'Persiapan' }}
                            @endif
                        </div>
                    </div>
                    <!-- Simple progress bar visual: Full if processing, half if pending -->
                    <div class="progress-bar-container">
                        <div class="progress-bar"
                            style="width: {{ $activeQueue->status == 'processing' ? '100%' : '30%' }};"></div>
                    </div>
                </div>

                <div class="queue-estimation">
                    <div class="estimation-time">{{ $peopleAhead }}</div>
                    <div class="estimation-label">Orang di Depan Anda</div>
                </div>

                <div class="queue-info">
                    <p><strong>Estimasi Waktu Tunggu:</strong> <span>≈ {{ ($peopleAhead + 1) * 5 }} menit</span></p>
                    <p><strong>UMKM:</strong> {{ $activeQueue->umkm->nama_umkm }}</p>
                    <p><strong>Lokasi:</strong> {{ $activeQueue->umkm->alamat }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($activeQueue->status) }}</span></p>
                </div>

                <a href="{{ route('orders.index') }}" class="queue-btn text-decoration-none text-center">Lihat Detail
                    Pesanan</a>
            </div>
        @else
            <!-- No Active Queue Banner -->
            <div class="queue-countdown text-center py-5">
                <h4 class="mb-3">Belum ada antrian aktif</h4>
                <p class="text-muted mb-4">Cari UMKM favoritmu dan mulai pesanan sekarang!</p>
                <button class="queue-btn"
                    onclick="document.getElementById('searchContainer').scrollIntoView({behavior: 'smooth'})">Mulai Cari
                    Makanan</button>
            </div>
        @endif

        <!-- Kategori UMKM -->
        <div class="categories-section">
            <h3 class="section-title">Kategori UMKM</h3>
            <div class="row">
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card active" onclick="filterCategory('all')">
                        <div class="category-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <div>Semua</div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card" onclick="filterCategory('food')">
                        <div class="category-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div>Makanan</div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card" onclick="filterCategory('drink')">
                        <div class="category-icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <div>Minuman</div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card" onclick="filterCategory('snack')">
                        <div class="category-icon">
                            <i class="fas fa-cookie-bite"></i>
                        </div>
                        <div>Snack</div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card" onclick="filterCategory('service')">
                        <div class="category-icon">
                            <i class="fas fa-cut"></i>
                        </div>
                        <div>Jasa</div>
                    </div>
                </div>
                <div class="col-4 col-md-3 col-lg-2">
                    <div class="category-card" onclick="filterCategory('other')">
                        <div class="category-icon">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div>Lainnya</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekomendasi Tempat Baru -->
        <div>
            <div class="d-flex justify-content-between align-items-end mb-3">
                <h3 class="section-title mb-0">Rekomendasi Tempat Baru</h3>
                <a href="#" class="text-decoration-none"
                    style="color: var(--color-brown); font-weight: 600; font-size: 0.9rem;">Lihat Semua</a>
            </div>

            @forelse($newUmkms as $umkm)
                <!-- Place Card -->
                <a href="{{ route('shop.show', $umkm->id) }}" class="place-card-new text-decoration-none">
                    <div class="place-header">
                        <div class="place-logo">
                            @if($umkm->logo)
                                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama_umkm }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-secondary">
                                    <i class="fas fa-store fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="place-info">
                            <div class="place-name">
                                <span>{{ $umkm->nama_umkm }}</span>
                                <div class="place-status open">Buka</div>
                            </div>
                            <div class="place-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $umkm->kota }}
                            </div>
                            <span class="place-category">{{ $umkm->kategori }}</span>
                        </div>
                    </div>

                    <div class="place-footer">
                        <div class="view-outlets">
                            Lihat Menu <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="place-distance">
                            <small class="text-muted">Baru gabung</small>
                        </div>
                    </div>
                </a>
            @empty
                <div class="text-center py-5">
                    <p class="text-muted">Belum ada UMKM yang tersedia saat ini.</p>
                </div>
            @endforelse

        </div>

        <!-- Rekomendasi Tempat dengan Layout Baru dan Logo -->
        <h3 class="section-title">Rekomendasi Tempat untuk Anda</h3>
        <div id="placesContainer">
            @forelse($recommendedUmkms as $umkm)
                <!-- Place Card -->
                <div class="place-card-new mb-4" data-category="{{ $umkm->kategori }}">
                    <div class="place-header">
                        <div class="place-logo">
                            @if($umkm->logo)
                                <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->nama_umkm }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100 bg-light text-secondary">
                                    <i class="fas fa-store fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="place-info">
                            <div class="place-name">
                                <div>{{ $umkm->nama_umkm }}</div>
                                <div class="place-status open">BUKA</div>
                            </div>
                            <div class="place-location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $umkm->alamat }}
                            </div>
                            <div class="place-category">{{ $umkm->kategori }}</div>
                        </div>
                    </div>

                    <div class="place-footer">
                        <a href="{{ route('shop.show', $umkm->id) }}" class="view-outlets">
                            Lihat Menu Lengkap >
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>

                    <div style="padding: 0 15px 15px 15px;">
                        <a href="{{ route('shop.show', $umkm->id) }}"
                            class="visit-btn-new text-decoration-none text-center d-block">Lihat Antrian & Menu</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-store-slash fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada rekomendasi tempat saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
    @include('components.bottom-nav')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Script untuk sticky search bar
        document.addEventListener('DOMContentLoaded', function () {
            const searchContainer = document.getElementById('searchContainer');
            const stickyPadding = document.getElementById('stickyPadding');

            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 150) {
                    searchContainer.classList.add('sticky');
                    stickyPadding.classList.add('active');
                } else {
                    searchContainer.classList.remove('sticky');
                    stickyPadding.classList.remove('active');
                }
            }

            window.addEventListener('scroll', handleScroll);
            handleScroll();

            // Sistem Antrian - JS REMOVED FOR REAL DATA INTEGRATION
            // Code has been replaced by server-side rendering in the view above.

            // Filter kategori
            window.filterCategory = function (category) {
                // Update active category
                document.querySelectorAll('.category-card').forEach(card => {
                    card.classList.remove('active');
                });

                event.currentTarget.classList.add('active');

                // Filter tempat berdasarkan kategori
                const places = document.querySelectorAll('.place-card-new');
                places.forEach(place => {
                    if (category === 'all' || place.getAttribute('data-category') === category) {
                        place.style.display = 'block';
                    } else {
                        place.style.display = 'none';
                    }
                });
            };

            // Simulasi klik kategori untuk inisialisasi
            document.querySelector('.category-card.active').click();
        });
    </script>
</body>

</html>