<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status UMKM - Queuely</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --color-light: #E4E0E1;
            --color-beige: #D6C0B3;
            --color-brown: #AB886D;
            --color-dark: #493628;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
            color: var(--color-dark);
            padding-top: 50px;
        }

        .status-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .status-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .status-pending {
            color: #ffc107;
        }

        .status-approved {
            color: #28a745;
        }

        .status-rejected {
            color: #dc3545;
        }

        .btn-dashboard {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-dashboard:hover {
            opacity: 0.9;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="status-container">
            @if($umkm->status === 'pending')
                <div class="status-icon status-pending">
                    <i class="fas fa-clock"></i>
                </div>
                <h2>Menunggu Verifikasi</h2>
                <p class="lead">Pendaftaran UMKM Anda sedang dalam proses verifikasi oleh admin.</p>
                <p>Biasanya proses verifikasi memakan waktu 1-3 hari kerja.</p>
                <div class="alert alert-warning mt-4">
                    <i class="fas fa-info-circle me-2"></i>
                    Anda akan mendapat notifikasi via email ketika UMKM Anda disetujui.
                </div>
            @elseif($umkm->status === 'approved')
                <div class="status-icon status-approved">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2>UMKM Disetujui!</h2>
                <p class="lead">Selamat! UMKM Anda telah disetujui.</p>
                <p>Anda sekarang dapat mengakses dashboard UMKM.</p>
                <a href="{{ route('umkm.dashboard') }}" class="btn-dashboard">
                    <i class="fas fa-tachometer-alt me-2"></i> Masuk Dashboard
                </a>
            @elseif($umkm->status === 'rejected')
                <div class="status-icon status-rejected">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h2>Pendaftaran Ditolak</h2>
                <p class="lead">Maaf, pendaftaran UMKM Anda ditolak.</p>
                @if($umkm->alasan_penolakan)
                    <div class="alert alert-danger mt-3">
                        <strong>Alasan penolakan:</strong><br>
                        {{ $umkm->alasan_penolakan }}
                    </div>
                @endif
                <a href="{{ route('umkm.edit') }}" class="btn-dashboard mt-3">
                    <i class="fas fa-edit me-2"></i> Perbaiki Data
                </a>
            @endif

            <div class="mt-4">
                <a href="{{ url('/profile') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Profil
                </a>
            </div>
        </div>
    </div>
</body>

</html>