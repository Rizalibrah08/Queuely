<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $umkm->nama_umkm }}</title>
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
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--color-dark);
        }

        .section-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--color-light);
        }

        .btn-pay {
            background-color: var(--color-dark);
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-weight: 700;
            width: 100%;
            border: none;
            transition: all 0.3s;
        }

        .btn-pay:hover {
            background-color: var(--color-brown);
        }

        .payment-option {
            border: 1px solid var(--color-light);
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .payment-option.active {
            border-color: var(--color-brown);
            background-color: rgba(214, 192, 179, 0.1);
        }
    </style>
</head>

<body>
    <div class="container py-4" style="max-width: 600px;">
        <h4 class="fw-bold mb-4"><i class="fas fa-arrow-left me-2" onclick="history.back()"
                style="cursor: pointer;"></i> Konfirmasi Pesanan</h4>

        <div class="section-box">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Ringkasan Pesanan</h5>
            <div class="mb-3">
                <h6 class="fw-bold">{{ $umkm->nama_umkm }}</h6>
                <p class="text-muted small mb-0">{{ $umkm->alamat }}</p>
            </div>

            <div class="order-items">
                @php $itemsJson = []; @endphp
                @foreach($orderItems as $item)
                    @php
                        $itemsJson[] = [
                            'id' => $item['menu']->id,
                            'name' => $item['menu']->name,
                            'qty' => $item['quantity'],
                            'price' => $item['menu']->price
                        ];
                    @endphp
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <span class="fw-bold">{{ $item['quantity'] }}x</span> {{ $item['menu']->name }}
                        </div>
                        <div>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                    </div>
                @endforeach
            </div>

            <div class="border-top pt-3 mt-3">
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total Pembayaran</span>
                    <span style="color: var(--color-brown);">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="umkm_id" value="{{ $umkm->id }}">
            <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
            <input type="hidden" name="items" value="{{ json_encode($itemsJson) }}">

            <div class="section-box">
                <h5 class="fw-bold mb-3">Metode Pembayaran</h5>

                <div class="mb-3">
                    <label class="payment-option d-flex align-items-center w-100" onclick="selectPayment(this)">
                        <input type="radio" name="payment_method" value="qris" class="me-3" checked>
                        <div>
                            <div class="fw-bold">QRIS</div>
                            <small class="text-muted">Scan QR Code (Gopay, OVO, Dana)</small>
                        </div>
                        <i class="fas fa-qrcode ms-auto fs-3 text-secondary"></i>
                    </label>
                </div>

                <div class="mb-0">
                    <label class="payment-option d-flex align-items-center w-100" onclick="selectPayment(this)">
                        <input type="radio" name="payment_method" value="cash" class="me-3">
                        <div>
                            <div class="fw-bold">Tunai / Cash</div>
                            <small class="text-muted">Bayar di kasir saat pengambilan</small>
                        </div>
                        <i class="fas fa-money-bill-wave ms-auto fs-3 text-secondary"></i>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-pay">
                Bayar & Ambil Antrian
            </button>
        </form>
    </div>

    <script>
        function selectPayment(element) {
            document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
            element.querySelector('input').checked = true;
        }
        // Init active state
        document.querySelector('input:checked').closest('.payment-option').classList.add('active');
    </script>
</body>

</html>