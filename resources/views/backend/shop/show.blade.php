<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $umkm->nama_umkm }} - Queuely</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            color: var(--color-dark);
            background-color: #f8f9fa;
            padding-bottom: 80px;
        }

        .cover-image {
            height: 250px;
            width: 100%;
            object-fit: cover;
            background-color: var(--color-dark);
        }

        .shop-header {
            margin-top: -60px;
            position: relative;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--color-light);
            background-color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        .shop-logo {
            width: 100px;
            height: 100px;
            border-radius: 15px;
            border: 4px solid white;
            object-fit: cover;
            background-color: white;
            box-shadow: var(--shadow);
            margin-top: -70px;
        }

        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            transition: transform 0.2s;
            border: 1px solid var(--color-light);
        }

        .menu-card:hover {
            transform: translateY(-3px);
            border-color: var(--color-beige);
        }

        .menu-image {
            height: 150px;
            width: 100%;
            object-fit: cover;
        }

        .menu-price {
            color: var(--color-brown);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .btn-add {
            background-color: var(--color-dark);
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .btn-add:hover {
            background-color: var(--color-brown);
        }

        .category-title {
            font-weight: 700;
            color: var(--color-dark);
            margin: 30px 0 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--color-beige);
        }
    </style>
</head>

<body>

    <!-- Cover Image -->
    @if($umkm->cover)
        <img src="{{ asset('storage/' . $umkm->cover) }}" class="cover-image" alt="Cover">
    @else
        <div class="cover-image d-flex align-items-center justify-content-center text-white display-1">
            <i class="fas fa-store"></i>
        </div>
    @endif

    <div class="container mb-5">
        <!-- Shop Header -->
        <div class="shop-header">
            <div class="d-flex align-items-start gap-3">
                @if($umkm->logo)
                    <img src="{{ asset('storage/' . $umkm->logo) }}" class="shop-logo" alt="Logo">
                @else
                    <div
                        class="shop-logo d-flex align-items-center justify-content-center text-secondary bg-light display-4">
                        <i class="fas fa-store"></i>
                    </div>
                @endif

                <div class="pt-2">
                    <h1 class="h3 fw-bold mb-1">{{ $umkm->nama_umkm }}</h1>
                    <p class="text-muted mb-2"><i class="fas fa-map-marker-alt me-1"></i> {{ $umkm->alamat }}</p>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success">Buka</span>
                        <span class="badge bg-secondary">{{ $umkm->kategori }}</span>
                    </div>
                </div>
            </div>

            <hr class="my-3">
            <p class="mb-0 text-muted">{{ $umkm->deskripsi }}</p>
        </div>

        <form action="{{ route('orders.checkout') }}" method="POST" id="orderForm">
            @csrf
            <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">

            <!-- Menu List -->
            @forelse($menus as $category => $items)
                <h3 class="category-title">{{ $category }}</h3>
                <div class="row">
                    @foreach($items as $menu)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="menu-card h-100 d-flex flex-column">
                                @if($menu->image)
                                    <img src="{{ asset('storage/' . $menu->image) }}" class="menu-image" alt="{{ $menu->name }}">
                                @else
                                    <div
                                        class="menu-image d-flex align-items-center justify-content-center bg-light text-secondary">
                                        <i class="fas fa-utensils fa-2x"></i>
                                    </div>
                                @endif

                                <div class="p-3 d-flex flex-column flex-grow-1">
                                    <h5 class="fw-bold mb-1" style="font-size: 1rem;">{{ $menu->name }}</h5>
                                    <p class="text-muted small mb-2 flex-grow-1">{{ Str::limit($menu->description, 50) }}</p>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>

                                        <!-- Quantity Control -->
                                        <div class="quantity-control d-flex align-items-center gap-2">
                                            <button type="button" class="btn-qty btn-minus" data-id="{{ $menu->id }}"
                                                onclick="updateQty(this, -1, {{ $menu->price }})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" name="items[{{ $menu->id }}]"
                                                class="form-control qty-input p-1 text-center" value="0" min="0"
                                                style="width: 40px; height: 30px;" readonly>
                                            <button type="button" class="btn-qty btn-plus" data-id="{{ $menu->id }}"
                                                onclick="updateQty(this, 1, {{ $menu->price }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-utensils fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada menu yang tersedia.</p>
                </div>
            @endforelse
        </form>
    </div>

    <!-- Bottom Cart Bar -->
    <div class="cart-bar" id="cartBar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold" id="totalItems">0 Item</div>
                    <div class="small">Total: <span class="fw-bold" id="totalPrice">Rp 0</span></div>
                </div>
                <button type="button" onclick="submitOrder()" class="btn btn-light fw-bold text-dark px-4">
                    Lanjut Bayar <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Include Bottom Nav -->
    <div style="margin-bottom: 140px;"></div> <!-- Adjusted Spacer -->
    @include('components.bottom-nav')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .btn-qty {
            width: 28px;
            height: 28px;
            padding: 0;
            border-radius: 50%;
            border: 1px solid var(--color-brown);
            background: white;
            color: var(--color-brown);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .btn-qty:hover {
            background: var(--color-brown);
            color: white;
        }

        .btn-qty.active {
            background: var(--color-brown);
            color: white;
        }

        .qty-input {
            border: none;
            background: transparent;
            font-weight: 600;
        }

        .cart-bar {
            position: fixed;
            bottom: 85px;
            /* Just above standard bottom nav */
            left: 20px;
            right: 20px;
            width: auto;
            border-radius: 50px;
            /* Pill shape */
            background-color: var(--color-dark);
            color: white;
            padding: 15px 0;
            z-index: 1050;
            /* Ensure on top */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out;
        }

        .cart-bar.visible {
            opacity: 1;
            visibility: visible;
        }
    </style>

    <script>
        let totalItems = 0;
        let totalPrice = 0;

        function updateQty(btn, change, price) {
            const container = btn.parentElement;
            const input = container.querySelector('.qty-input');
            let currentValue = parseInt(input.value);
            let newValue = currentValue + change;

            if (newValue < 0) newValue = 0;

            // Update UI
            input.value = newValue;

            // Highlight buttons if active
            const minusBtn = container.querySelector('.btn-minus');
            const plusBtn = container.querySelector('.btn-plus');

            if (newValue > 0) {
                minusBtn.classList.add('active');
                plusBtn.classList.add('active');
            } else {
                minusBtn.classList.remove('active');
                plusBtn.classList.remove('active');
            }

            // Update Totals
            if (currentValue !== newValue) {
                totalItems += change;
                totalPrice += change * price;
                updateCartBar();
            }
        }

        function updateCartBar() {
            const bar = document.getElementById('cartBar');
            const itemsText = document.getElementById('totalItems');
            const priceText = document.getElementById('totalPrice');

            itemsText.textContent = totalItems + ' Item';
            priceText.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');

            if (totalItems > 0) {
                bar.classList.add('visible');
            } else {
                bar.classList.remove('visible');
            }
        }

        function submitOrder() {
            if (totalItems === 0) {
                alert('Pilih minimal 1 menu');
                return;
            }
            document.getElementById('orderForm').submit();
        }
    </script>
</body>

</html>