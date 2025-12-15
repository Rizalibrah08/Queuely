<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR - Queuely</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- QR Scanner Library -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .help-btn {
            background: none;
            border: none;
            color: var(--color-dark);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .help-btn:hover {
            color: var(--color-brown);
        }

        /* Page Header */
        .page-header {
            background-color: white;
            padding: 20px 0 15px 0;
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
            text-align: center;
        }

        .page-subtitle {
            color: #666;
            font-size: 0.9rem;
            font-weight: 400;
            text-align: center;
        }

        /* Scan Section */
        .scan-section {
            padding: 20px 0;
        }

        .scan-container {
            background-color: white;
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .scan-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .scan-title i {
            color: var(--color-brown);
        }

        .scan-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 25px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        /* QR Scanner Area */
        .qr-scanner-area {
            position: relative;
            margin: 0 auto 25px auto;
            max-width: 500px;
            border-radius: 12px;
            overflow: hidden;
            background-color: #000;
            aspect-ratio: 1 / 1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        #qr-reader {
            width: 100% !important;
            height: 100% !important;
        }

        #qr-reader__scan_region {
            width: 100% !important;
            height: 100% !important;
        }

        #qr-reader__dashboard_section {
            background-color: rgba(0, 0, 0, 0.7) !important;
            padding: 15px !important;
            border-radius: 0 0 12px 12px !important;
        }

        .scanner-frame {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            height: 70%;
            border: 3px solid var(--color-brown);
            border-radius: 12px;
            box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
            z-index: 1;
            pointer-events: none;
        }

        .scanner-corner {
            position: absolute;
            width: 30px;
            height: 30px;
            border-color: var(--color-brown);
            border-width: 4px;
        }

        .corner-tl {
            top: -3px;
            left: -3px;
            border-top-left-radius: 8px;
            border-right: none;
            border-bottom: none;
        }

        .corner-tr {
            top: -3px;
            right: -3px;
            border-top-right-radius: 8px;
            border-left: none;
            border-bottom: none;
        }

        .corner-bl {
            bottom: -3px;
            left: -3px;
            border-bottom-left-radius: 8px;
            border-right: none;
            border-top: none;
        }

        .corner-br {
            bottom: -3px;
            right: -3px;
            border-bottom-right-radius: 8px;
            border-left: none;
            border-top: none;
        }

        /* Camera Controls */
        .camera-controls {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .camera-btn {
            background-color: white;
            border: 2px solid var(--color-brown);
            color: var(--color-brown);
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .camera-btn:hover {
            background-color: var(--color-brown);
            color: white;
        }

        .camera-btn.active {
            background-color: var(--color-dark);
            border-color: var(--color-dark);
            color: white;
        }

        .camera-btn i {
            font-size: 1rem;
        }

        /* Alternative Section */
        .alternative-section {
            background-color: white;
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .alternative-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 15px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .alternative-title i {
            color: var(--color-brown);
        }

        .code-input-container {
            max-width: 400px;
            margin: 0 auto 20px auto;
        }

        .code-input-label {
            text-align: left;
            color: var(--color-dark);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .code-input {
            width: 100%;
            padding: 14px 15px;
            border: 2px solid var(--color-light);
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-align: center;
            color: var(--color-dark);
            transition: all 0.3s;
            font-family: monospace;
        }

        .code-input:focus {
            outline: none;
            border-color: var(--color-brown);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.2);
        }

        .code-input::placeholder {
            letter-spacing: 1px;
            color: #aaa;
        }

        .code-submit-btn {
            background-color: var(--color-dark);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 40px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            max-width: 400px;
        }

        .code-submit-btn:hover {
            background-color: var(--color-brown);
        }

        .code-example {
            margin-top: 15px;
            color: #666;
            font-size: 0.85rem;
        }

        .code-example span {
            font-family: monospace;
            background-color: #f5f5f5;
            padding: 3px 8px;
            border-radius: 4px;
            color: var(--color-dark);
            font-weight: 600;
        }

        /* How to Section */
        .how-to-section {
            background-color: white;
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }

        .how-to-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 20px;
            font-size: 1.2rem;
            text-align: center;
        }

        .how-to-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .step-card {
            background-color: #f9f9f9;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            border-left: 4px solid var(--color-brown);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background-color: var(--color-brown);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0 auto 15px auto;
        }

        .step-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .step-description {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        /* Scan Result Modal */
        .scan-result {
            background-color: white;
            border-radius: 16px;
            padding: 25px 20px;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
            text-align: center;
            display: none;
        }

        .scan-result.show {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .result-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
        }

        .result-success {
            color: #28a745;
        }

        .result-error {
            color: #dc3545;
        }

        .result-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 10px;
            font-size: 1.3rem;
        }

        .result-message {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 25px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        .result-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .result-btn {
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background-color: var(--color-dark);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--color-brown);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--color-brown);
            color: var(--color-brown);
        }

        .btn-outline:hover {
            background-color: var(--color-brown);
            color: white;
        }

        /* Permissions Info */
        .permissions-info {
            background-color: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            border-radius: 10px;
            padding: 15px;
            margin: 20px auto;
            max-width: 600px;
            display: none;
        }

        .permissions-info.show {
            display: block;
        }

        .permissions-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .permissions-header i {
            color: #ffc107;
            font-size: 1.2rem;
        }

        .permissions-title {
            font-weight: 700;
            color: var(--color-dark);
            font-size: 0.95rem;
        }

        .permissions-text {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.5;
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

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .qr-scanner-area {
                max-width: 400px;
            }

            .how-to-steps {
                grid-template-columns: 1fr;
            }

            .camera-controls {
                gap: 10px;
            }

            .camera-btn {
                padding: 8px 15px;
                font-size: 0.85rem;
            }

            .nav-icon span {
                font-size: 0.6rem;
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
                padding: 15px 0 10px 0;
            }

            .page-title {
                font-size: 1.3rem;
                margin-bottom: 3px;
            }

            .page-subtitle {
                font-size: 0.85rem;
            }

            .qr-scanner-area {
                max-width: 320px;
            }

            .code-input {
                padding: 12px 15px;
                font-size: 1rem;
            }

            .code-submit-btn {
                padding: 12px 20px;
                font-size: 0.95rem;
            }

            .nav-icon i {
                font-size: 1.1rem;
            }

            .nav-icon span {
                font-size: 0.55rem;
            }

            .scan-title,
            .alternative-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 380px) {
            .qr-scanner-area {
                max-width: 280px;
            }

            .nav-icon {
                padding: 3px 6px;
            }

            .nav-icon i {
                font-size: 1rem;
            }

            .camera-btn {
                padding: 7px 12px;
                font-size: 0.8rem;
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
                <div class="header-actions">
                    <button class="help-btn" id="helpBtn">
                        <i class="fas fa-question-circle"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="container-fluid page-header">
        <div class="container page-title-section">
            <h1 class="page-title">Scan QR Code</h1>
            <p class="page-subtitle">Pindai QR Code UMKM untuk memulai antrian atau pemesanan</p>
        </div>
    </div>

    <!-- Permissions Info -->
    <div class="container">
        <div class="permissions-info" id="permissionsInfo">
            <div class="permissions-header">
                <i class="fas fa-info-circle"></i>
                <div class="permissions-title">Perizinan Kamera Diperlukan</div>
            </div>
            <div class="permissions-text">
                Untuk menggunakan pemindai QR Code, izinkan akses kamera perangkat Anda. Jika tidak ada kamera atau
                mengalami masalah, Anda dapat menggunakan kode unik sebagai alternatif.
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Scan Section -->
        <div class="scan-section">
            <div class="scan-container">
                <div class="scan-title">
                    <i class="fas fa-qrcode"></i>
                    Pindai QR Code
                </div>

                <div class="scan-description">
                    Arahkan kamera ke QR Code yang tersedia di UMKM untuk mendapatkan menu dan mengambil nomor antrian.
                </div>

                <!-- QR Scanner Area -->
                <div class="qr-scanner-area" id="qrScannerArea">
                    <div id="qr-reader"></div>
                    <div class="scanner-frame">
                        <div class="scanner-corner corner-tl"></div>
                        <div class="scanner-corner corner-tr"></div>
                        <div class="scanner-corner corner-bl"></div>
                        <div class="scanner-corner corner-br"></div>
                    </div>
                </div>

                <!-- Camera Controls -->
                <div class="camera-controls">
                    <button class="camera-btn active" id="startScannerBtn">
                        <i class="fas fa-play"></i> Mulai Scan
                    </button>
                    <button class="camera-btn" id="stopScannerBtn">
                        <i class="fas fa-stop"></i> Stop Scan
                    </button>
                    <button class="camera-btn" id="switchCameraBtn">
                        <i class="fas fa-sync-alt"></i> Ganti Kamera
                    </button>
                    <button class="camera-btn" id="toggleFlashBtn">
                        <i class="fas fa-lightbulb"></i> Flash
                    </button>
                </div>
            </div>

            <!-- Alternative Section -->
            <div class="alternative-section">
                <div class="alternative-title">
                    <i class="fas fa-keyboard"></i>
                    Masukkan Kode Unik
                </div>

                <p class="scan-description">
                    Tidak ada kamera atau QR Code rusak? Masukkan kode unik yang diberikan oleh UMKM.
                </p>

                <div class="code-input-container">
                    <div class="code-input-label">Kode Unik UMKM</div>
                    <input type="text" class="code-input" id="codeInput" placeholder="Misal: ANTRI123" maxlength="20">
                </div>

                <button class="code-submit-btn" id="submitCodeBtn">
                    <i class="fas fa-paper-plane me-2"></i> Submit Kode
                </button>

                <div class="code-example">
                    Contoh kode: <span>ANTRI123</span> atau <span>UMKM456</span>
                </div>
            </div>

            <!-- Scan Result -->
            <div class="scan-result" id="scanResult">
                <div class="result-icon result-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="result-title">Berhasil Memindai!</div>
                <div class="result-message" id="resultMessage">
                    QR Code berhasil dipindai. Mengarahkan ke halaman UMKM...
                </div>
                <div class="result-actions">
                    <button class="result-btn btn-primary" id="goToMerchantBtn">Lihat Menu UMKM</button>
                    <button class="result-btn btn-outline" id="scanAgainBtn">Scan Lagi</button>
                </div>
            </div>

            <!-- How to Section -->
            <div class="how-to-section">
                <div class="how-to-title">Cara Menggunakan Scan QR</div>
                <div class="how-to-steps">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-title">Izinkan Akses Kamera</div>
                        <div class="step-description">
                            Pastikan Anda mengizinkan akses kamera saat diminta oleh browser. Ini diperlukan untuk
                            memindai QR Code.
                        </div>
                    </div>

                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-title">Arahkan ke QR Code</div>
                        <div class="step-description">
                            Arahkan kamera ke QR Code yang ditempel di UMKM. Pastikan QR Code berada dalam kotak
                            pemindaian.
                        </div>
                    </div>

                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-title">Tunggu Hasil Scan</div>
                        <div class="step-description">
                            Sistem akan otomatis memindai dan mengarahkan Anda ke halaman menu atau antrian UMKM.
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
        document.addEventListener('DOMContentLoaded', function () {
            // Elements
            const qrScannerArea = document.getElementById('qrScannerArea');
            const permissionsInfo = document.getElementById('permissionsInfo');
            const scanResult = document.getElementById('scanResult');
            const resultMessage = document.getElementById('resultMessage');
            const codeInput = document.getElementById('codeInput');
            const helpBtn = document.getElementById('helpBtn');

            // Buttons
            const startScannerBtn = document.getElementById('startScannerBtn');
            const stopScannerBtn = document.getElementById('stopScannerBtn');
            const switchCameraBtn = document.getElementById('switchCameraBtn');
            const toggleFlashBtn = document.getElementById('toggleFlashBtn');
            const submitCodeBtn = document.getElementById('submitCodeBtn');
            const goToMerchantBtn = document.getElementById('goToMerchantBtn');
            const scanAgainBtn = document.getElementById('scanAgainBtn');

            // QR Scanner variables
            let html5QrCode = null;
            let currentCameraId = null;
            let isScannerActive = false;
            let isFlashOn = false;

            // Dummy UMKM data for simulation
            const merchantData = {
                'ANTRI123': {
                    id: 'UMKM001',
                    name: 'Warung Makan Sederhana',
                    type: 'Makanan',
                    code: 'ANTRI123'
                },
                'UMKM456': {
                    id: 'UMKM002',
                    name: 'Kopi Teman Sejati',
                    type: 'Minuman',
                    code: 'UMKM456'
                },
                'QR789': {
                    id: 'UMKM003',
                    name: 'KFC - PASARAYA MANGGARAI',
                    type: 'Fast Food',
                    code: 'QR789'
                }
            };

            // Initialize QR Scanner
            function initQRScanner() {
                // Check if browser supports camera
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    showPermissionsInfo('Browser Anda tidak mendukung akses kamera. Gunakan kode unik sebagai alternatif.');
                    return;
                }

                html5QrCode = new Html5Qrcode("qr-reader");

                // Configure scanner
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    rememberLastUsedCamera: true,
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                };

                // Get available cameras
                Html5Qrcode.getCameras().then(cameras => {
                    if (cameras && cameras.length) {
                        currentCameraId = cameras[0].id;
                        console.log(`${cameras.length} kamera tersedia`);
                    } else {
                        showPermissionsInfo('Tidak ada kamera yang terdeteksi. Gunakan kode unik sebagai alternatif.');
                    }
                }).catch(err => {
                    console.error("Error getting cameras:", err);
                    showPermissionsInfo('Tidak dapat mengakses kamera. Gunakan kode unik sebagai alternatif.');
                });
            }

            // Start QR Scanner
            async function startScanner() {
                if (!html5QrCode || isScannerActive) return;

                try {
                    await html5QrCode.start(
                        currentCameraId,
                        config,
                        onScanSuccess,
                        onScanFailure
                    );

                    isScannerActive = true;
                    startScannerBtn.classList.remove('active');
                    stopScannerBtn.classList.add('active');
                    qrScannerArea.classList.add('pulse');

                    console.log("QR Scanner started");
                } catch (err) {
                    console.error("Error starting scanner:", err);
                    showPermissionsInfo('Gagal mengakses kamera. Izinkan akses kamera atau gunakan kode unik.');
                }
            }

            // Stop QR Scanner
            function stopScanner() {
                if (!html5QrCode || !isScannerActive) return;

                html5QrCode.stop().then(() => {
                    isScannerActive = false;
                    startScannerBtn.classList.add('active');
                    stopScannerBtn.classList.remove('active');
                    qrScannerArea.classList.remove('pulse');

                    console.log("QR Scanner stopped");
                }).catch(err => {
                    console.error("Error stopping scanner:", err);
                });
            }

            // Switch between front/back camera
            async function switchCamera() {
                if (!html5QrCode) return;

                try {
                    const cameras = await Html5Qrcode.getCameras();
                    if (cameras.length < 2) {
                        alert('Hanya satu kamera yang tersedia');
                        return;
                    }

                    // Find current camera index
                    const currentIndex = cameras.findIndex(cam => cam.id === currentCameraId);
                    const nextIndex = (currentIndex + 1) % cameras.length;
                    const nextCameraId = cameras[nextIndex].id;

                    // Stop and restart with new camera
                    if (isScannerActive) {
                        await html5QrCode.stop();
                        currentCameraId = nextCameraId;
                        await startScanner();
                    } else {
                        currentCameraId = nextCameraId;
                    }

                    console.log(`Switched to camera: ${cameras[nextIndex].label}`);
                } catch (err) {
                    console.error("Error switching camera:", err);
                }
            }

            // Toggle flash/torch (simulated)
            function toggleFlash() {
                isFlashOn = !isFlashOn;

                if (isFlashOn) {
                    toggleFlashBtn.innerHTML = '<i class="fas fa-lightbulb"></i> Flash On';
                    toggleFlashBtn.classList.add('active');
                    // In a real implementation, you would control the torch here
                } else {
                    toggleFlashBtn.innerHTML = '<i class="fas fa-lightbulb"></i> Flash';
                    toggleFlashBtn.classList.remove('active');
                }

                console.log(`Flash ${isFlashOn ? 'ON' : 'OFF'}`);
            }

            // QR Scan Success Callback
            function onScanSuccess(decodedText, decodedResult) {
                console.log(`QR Scan berhasil: ${decodedText}`);

                // Stop scanner
                stopScanner();

                // Process the scanned data
                processScannedData(decodedText);
            }

            // QR Scan Failure Callback
            function onScanFailure(error) {
                // Expected failure, usually due to no QR code in view
                // Don't show error messages for normal operation
            }

            // Process scanned data
            function processScannedData(data) {
                let merchant = null;

                // Check if scanned data matches any known merchant code
                for (const code in merchantData) {
                    if (data.includes(code) || data === code) {
                        merchant = merchantData[code];
                        break;
                    }
                }

                // If no direct match, try to parse URL
                if (!merchant) {
                    try {
                        const url = new URL(data);
                        const params = new URLSearchParams(url.search);
                        const code = params.get('code') || params.get('umkm') || params.get('id');

                        if (code && merchantData[code]) {
                            merchant = merchantData[code];
                        }
                    } catch (e) {
                        // Not a URL, treat as direct code
                        if (merchantData[data]) {
                            merchant = merchantData[data];
                        }
                    }
                }

                // Show result
                if (merchant) {
                    showScanResult(
                        true,
                        `Berhasil memindai QR Code untuk <strong>${merchant.name}</strong>.`,
                        merchant
                    );
                } else {
                    showScanResult(
                        false,
                        `QR Code tidak dikenali. Kode: <strong>${data.substring(0, 20)}...</strong><br>Pastikan Anda memindai QR Code yang valid dari UMKM terdaftar.`
                    );
                }
            }

            // Show scan result
            function showScanResult(success, message, merchant = null) {
                const icon = scanResult.querySelector('.result-icon');
                const title = scanResult.querySelector('.result-title');

                if (success) {
                    icon.className = 'result-icon result-success';
                    icon.innerHTML = '<i class="fas fa-check-circle"></i>';
                    title.textContent = 'Berhasil Memindai!';

                    // Store merchant data for navigation
                    if (merchant) {
                        goToMerchantBtn.dataset.merchant = JSON.stringify(merchant);
                    }
                } else {
                    icon.className = 'result-icon result-error';
                    icon.innerHTML = '<i class="fas fa-exclamation-circle"></i>';
                    title.textContent = 'Gagal Memindai';
                }

                resultMessage.innerHTML = message;
                scanResult.classList.add('show');

                // Scroll to result
                scanResult.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Submit manual code
            function submitManualCode() {
                const code = codeInput.value.trim().toUpperCase();

                if (!code) {
                    alert('Masukkan kode unik terlebih dahulu');
                    codeInput.focus();
                    return;
                }

                // Check if code exists
                if (merchantData[code]) {
                    const merchant = merchantData[code];
                    showScanResult(
                        true,
                        `Kode unik valid untuk <strong>${merchant.name}</strong>.`,
                        merchant
                    );
                } else {
                    showScanResult(
                        false,
                        `Kode <strong>${code}</strong> tidak ditemukan.<br>Pastikan Anda memasukkan kode yang benar dari UMKM.`
                    );
                }

                // Clear input
                codeInput.value = '';
            }

            // Show permissions info
            function showPermissionsInfo(message) {
                if (message) {
                    const permissionsText = permissionsInfo.querySelector('.permissions-text');
                    permissionsText.textContent = message;
                }
                permissionsInfo.classList.add('show');
            }

            // Navigate to merchant page
            function goToMerchant() {
                const merchantDataStr = goToMerchantBtn.dataset.merchant;

                if (merchantDataStr) {
                    const merchant = JSON.parse(merchantDataStr);

                    // In a real app, you would redirect to merchant page
                    alert(`Mengarahkan ke halaman: ${merchant.name}\nKode: ${merchant.code}\nID: ${merchant.id}`);

                    // Simulate redirect
                    setTimeout(() => {
                        scanResult.classList.remove('show');
                        stopScanner();
                    }, 1000);
                }
            }

            // Event Listeners
            startScannerBtn.addEventListener('click', startScanner);
            stopScannerBtn.addEventListener('click', stopScanner);
            switchCameraBtn.addEventListener('click', switchCamera);
            toggleFlashBtn.addEventListener('click', toggleFlash);
            submitCodeBtn.addEventListener('click', submitManualCode);
            goToMerchantBtn.addEventListener('click', goToMerchant);
            scanAgainBtn.addEventListener('click', () => {
                scanResult.classList.remove('show');
                startScanner();
            });

            codeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    submitManualCode();
                }
            });

            helpBtn.addEventListener('click', () => {
                alert('Bantuan Scan QR:\n\n1. Izinkan akses kamera saat diminta\n2. Arahkan kamera ke QR Code UMKM\n3. Sistem akan otomatis memindai\n4. Jika tidak ada kamera, gunakan kode unik\n\nPastikan pencahayaan cukup dan QR Code tidak rusak.');
            });

            // Initialize scanner on page load
            initQRScanner();

            // Auto-start scanner (optional)
            // setTimeout(startScanner, 1000);
        });
    </script>
</body>

</html>