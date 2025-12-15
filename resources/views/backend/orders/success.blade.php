<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil - Queuely</title>
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
            background-color: var(--color-dark);
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket-card {
            background: white;
            color: var(--color-dark);
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .ticket-header {
            background-color: var(--color-beige);
            padding: 20px;
            text-align: center;
            border-bottom: 2px dashed var(--color-brown);
        }

        .queue-number {
            font-size: 4rem;
            font-weight: 800;
            color: var(--color-dark);
            line-height: 1;
            margin: 10px 0;
        }

        .ticket-body {
            padding: 30px;
            text-align: center;
        }

        .info-label {
            color: #888;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-value {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .home-btn {
            background-color: var(--color-dark);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .home-btn:hover {
            background-color: var(--color-brown);
            color: white;
        }

        .punch-hole {
            width: 30px;
            height: 30px;
            background-color: var(--color-dark);
            border-radius: 50%;
            position: absolute;
            top: 105px;
            /* Adjust according to header height */
        }

        .punch-left {
            left: -15px;
        }

        .punch-right {
            right: -15px;
        }
    </style>
</head>

<body>
    <div class="container p-3">
        <div class="ticket-card mx-auto">
            <div class="ticket-header">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h4 class="fw-bold mb-0">Pesanan Berhasil!</h4>
                <p class="mb-0 text-dark">{{ $order->umkm->nama_umkm }}</p>
            </div>

            <div class="punch-hole punch-left"></div>
            <div class="punch-hole punch-right"></div>

            <div class="ticket-body">
                <div class="info-label">Nomor Antrian Anda</div>
                <div class="queue-number">{{ $order->queue_number }}</div>

                <div class="row mt-4">
                    <div class="col-6 border-end">
                        <div class="info-label">Estimasi</div>
                        <div class="info-value">≈ {{ $estimatedWait }} mnt</div>
                    </div>
                    <div class="col-6">
                        <div class="info-label">Antrian</div>
                        <div class="info-value">{{ $peopleAhead }} Orang</div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <p class="text-muted small mb-3">Silakan tunggu notifikasi atau cek status antrian di dashboard.</p>
                    <a href="{{ route('dashboard.index') }}" class="home-btn">
                        Ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>