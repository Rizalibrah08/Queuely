<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan UMKM - Queuely</title>

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
            font-family: 'Segoe UI', system-ui, sans-serif;
            background-color: #f8f9fa;
            color: var(--color-dark);
            margin: 0;
            padding: 0;
        }

        /* FIX: Header tanpa jarak */
        .umkm-header {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }

        .umkm-header h1 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .umkm-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto 50px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: var(--color-dark);
            border-bottom: 2px solid var(--color-beige);
            padding-bottom: 10px;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 1.3rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid var(--color-light);
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--color-brown);
            box-shadow: 0 0 0 3px rgba(171, 136, 109, 0.2);
        }

        .file-upload {
            border: 2px dashed var(--color-light);
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background-color: #fafafa;
        }

        .file-upload:hover {
            border-color: var(--color-brown);
            background-color: rgba(171, 136, 109, 0.05);
        }

        .file-upload i {
            font-size: 2rem;
            color: var(--color-brown);
            margin-bottom: 10px;
        }

        .file-upload p {
            margin-bottom: 5px;
            font-weight: 500;
        }

        .file-upload .small {
            font-size: 0.8rem;
            color: #888;
        }

        .file-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            margin-top: 10px;
            border: 2px solid var(--color-light);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin: 0 auto 40px;
            position: relative;
            max-width: 800px;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 10%;
            right: 10%;
            height: 2px;
            background-color: var(--color-light);
            z-index: 1;
        }

        .step {
            text-align: center;
            position: relative;
            z-index: 2;
            flex: 1;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background-color: white;
            border: 2px solid var(--color-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: 600;
            color: var(--color-dark);
            font-size: 0.9rem;
        }

        .step.active .step-number {
            background-color: var(--color-brown);
            border-color: var(--color-brown);
            color: white;
        }

        .step-text {
            font-size: 0.85rem;
            color: var(--color-dark);
            font-weight: 500;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-next,
        .btn-prev {
            background-color: var(--color-beige);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            color: var(--color-dark);
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-next:hover,
        .btn-prev:hover {
            background-color: var(--color-brown);
            color: white;
        }

        .form-navigation {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .required::after {
            content: " *";
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 0 15px 30px;
            }

            .umkm-header {
                padding: 25px 0;
            }

            .umkm-header h1 {
                font-size: 1.5rem;
            }

            .step-indicator {
                padding: 0 15px;
            }

            .step-indicator::before {
                left: 15%;
                right: 15%;
            }
        }

        @media (max-width: 576px) {
            .step-indicator::before {
                display: none;
            }

            .step {
                margin-bottom: 15px;
            }

            .file-upload {
                padding: 20px;
            }
        }

        .back-btn {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s;
        }

        .back-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }
    </style>
</head>

<body>
    <!-- Header - FIXED: No gap -->
    <div class="umkm-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-store me-2"></i>Daftarkan Bisnis Makanan/Minuman Anda</h1>
                    <p class="mb-0">Buat menu online & sistem antrian untuk coffee shop, warung makan, restoran, dll</p>
                </div>
                <a href="{{ url('/profile') }}" class="back-btn">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Step Indicator -->
    <div class="container">
        <div class="step-indicator">
            <div class="step active" data-step="1">
                <div class="step-number">1</div>
                <div class="step-text">Data Bisnis</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-number">2</div>
                <div class="step-text">Data Pemilik</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-number">3</div>
                <div class="step-text">Konfirmasi</div>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="container">
        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" id="umkmForm">
            @csrf

            <!-- Step 1: Data Bisnis -->
            <div class="form-container step-content active" id="step1">
                <h3 class="section-title"><i class="fas fa-store me-2"></i>Data Bisnis Makanan/Minuman</h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_umkm" class="form-label required">Nama Bisnis</label>
                        <input type="text" class="form-control" id="nama_umkm" name="nama_umkm" required
                            placeholder="Contoh: Kopi Kenangan, Warung Makan Sederhana">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label required">Jenis Bisnis</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Pilih Jenis Bisnis</option>
                            <option value="Coffee Shop">Coffee Shop / Kedai Kopi</option>
                            <option value="Restoran">Restoran</option>
                            <option value="Warung Makan">Warung Makan</option>
                            <option value="Kafe">Kafe</option>
                            <option value="Bakery">Bakery / Toko Roti</option>
                            <option value="Minuman">Kedai Minuman / Bubble Tea</option>
                            <option value="Makanan Cepat Saji">Makanan Cepat Saji</option>
                            <option value="Catering">Catering</option>
                            <option value="Street Food">Street Food / Food Truck</option>
                            <option value="Dessert Shop">Toko Dessert / Ice Cream</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label required">Deskripsi Bisnis</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required
                        placeholder="Deskripsikan bisnis Anda, menu andalan, konsep, jam operasional, dll."></textarea>
                    <div class="form-text">Contoh: "Coffee shop dengan konsep cozy, menyajikan kopi specialty dari
                        berbagai daerah. Buka jam 07:00-22:00."</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telepon" class="form-label required">Telepon Bisnis</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" required
                            placeholder="Contoh: 081234567890">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label required">Email Bisnis</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            placeholder="bisnis@email.com">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label required">Alamat Lengkap</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required
                        placeholder="Alamat lengkap termasuk nomor, RT/RW, komplek (jika ada)"></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kota" class="form-label required">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota" required
                            placeholder="Contoh: Jakarta Selatan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="provinsi" class="form-label required">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" required
                            placeholder="Contoh: DKI Jakarta">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kodepos" class="form-label required">Kode Pos</label>
                        <input type="text" class="form-control" id="kodepos" name="kodepos" required
                            placeholder="Contoh: 12345">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Website/Instagram (opsional)</label>
                    <input type="url" class="form-control" id="website" name="website"
                        placeholder="https://instagram.com/namabisnis atau https://websitemu.com">
                    <div class="form-text">Link ke Instagram atau website bisnis Anda</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="file-upload" onclick="document.getElementById('logo').click()">
                            <i class="fas fa-image"></i>
                            <p>Logo Bisnis (Opsional)</p>
                            <p class="small">Akan ditampilkan di menu online</p>
                            <input type="file" id="logo" name="logo" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'logoPreview')">
                            <img id="logoPreview" class="file-preview d-none">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="file-upload" onclick="document.getElementById('cover').click()">
                            <i class="fas fa-images"></i>
                            <p>Foto Tempat (Opsional)</p>
                            <p class="small">Foto interior/exterior bisnis Anda</p>
                            <input type="file" id="cover" name="cover" accept="image/*" style="display: none"
                                onchange="previewImage(this, 'coverPreview')">
                            <img id="coverPreview" class="file-preview d-none">
                        </div>
                    </div>
                </div>

                <div class="form-navigation">
                    <div></div>
                    <button type="button" class="btn-next" onclick="nextStep(2)">
                        Data Pemilik <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>

            <!-- Step 2: Data Pemilik -->
            <div class="form-container step-content" id="step2">
                <h3 class="section-title"><i class="fas fa-user me-2"></i>Data Pemilik Bisnis</h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_pemilik" class="form-label required">Nama Lengkap Pemilik</label>
                        <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nik_pemilik" class="form-label required">NIK Pemilik</label>
                        <input type="text" class="form-control" id="nik_pemilik" name="nik_pemilik" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label required">Foto KTP Pemilik</label>
                    <div class="file-upload" onclick="document.getElementById('foto_ktp').click()">
                        <i class="fas fa-id-card"></i>
                        <p>Upload Foto KTP (Wajib)</p>
                        <p class="small">Untuk verifikasi identitas</p>
                        <input type="file" id="foto_ktp" name="foto_ktp" accept="image/*" style="display: none"
                            onchange="previewImage(this, 'ktpPreview')" required>
                        <img id="ktpPreview" class="file-preview d-none">
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" onclick="prevStep(1)">
                        <i class="fas fa-arrow-left me-1"></i> Data Bisnis
                    </button>
                    <button type="button" class="btn-next" onclick="nextStep(3)">
                        Konfirmasi <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>

            <!-- Step 3: Konfirmasi -->
            <div class="form-container step-content" id="step3">
                <h3 class="section-title"><i class="fas fa-check-circle me-2"></i>Konfirmasi Pendaftaran</h3>

                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Keuntungan Bergabung:</strong><br>
                    1. Menu online gratis<br>
                    2. Sistem antrian digital<br>
                    3. Dashboard untuk kelola menu & pesanan<br>
                    4. Tampil di aplikasi Queuely
                </div>

                <div class="mb-3">
                    <label for="npwp" class="form-label">NPWP (Opsional)</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Jika memiliki NPWP">
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="siup" class="form-label">SIUP (Opsional)</label>
                        <input type="text" class="form-control" id="siup" name="siup">
                    </div>

                    <div class="col-md-6">
                        <label for="tdp" class="form-label">TDP (Opsional)</label>
                        <input type="text" class="form-control" id="tdp" name="tdp">
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                    <label class="form-check-label" for="agreeTerms">
                        Saya menyetujui <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                        dan menyatakan bahwa data yang saya berikan adalah benar.
                    </label>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Data yang sudah disubmit akan diverifikasi dalam 1-2 hari kerja.
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn-prev" onclick="prevStep(2)">
                        <i class="fas fa-arrow-left me-1"></i> Data Pemilik
                    </button>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i> Daftarkan Bisnis
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Step navigation
        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.remove('active');
            });

            // Show selected step
            document.getElementById(`step${step}`).classList.add('active');

            // Update step indicator
            document.querySelectorAll('.step').forEach(stepEl => {
                stepEl.classList.remove('active');
            });
            document.querySelector(`.step[data-step="${step}"]`).classList.add('active');

            // Scroll to top of form
            window.scrollTo({ top: 150, behavior: 'smooth' });
        }

        function nextStep(next) {
            // Basic validation for current step
            const currentStep = Array.from(document.querySelectorAll('.step')).findIndex(step => step.classList.contains('active')) + 1;

            if (currentStep === 1 && !validateStep1()) {
                return;
            }
            if (currentStep === 2 && !validateStep2()) {
                return;
            }

            goToStep(next);
        }

        function prevStep(prev) {
            goToStep(prev);
        }

        // Validation functions
        function validateStep1() {
            const requiredFields = ['nama_umkm', 'kategori', 'deskripsi', 'telepon', 'email', 'alamat', 'kota', 'provinsi', 'kodepos'];
            let isValid = true;

            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                const label = field.previousElementSibling?.textContent?.replace(' *', '') || fieldId;

                if (!field.value.trim()) {
                    alert(`Harap isi "${label}"`);
                    field.focus();
                    isValid = false;
                }
            });

            return isValid;
        }

        function validateStep2() {
            const namaPemilik = document.getElementById('nama_pemilik');
            const nikPemilik = document.getElementById('nik_pemilik');
            const fotoKtp = document.getElementById('foto_ktp');

            if (!namaPemilik.value.trim()) {
                alert('Harap isi nama pemilik');
                namaPemilik.focus();
                return false;
            }

            if (!nikPemilik.value.trim()) {
                alert('Harap isi NIK pemilik');
                nikPemilik.focus();
                return false;
            }

            if (!fotoKtp.files.length) {
                alert('Harap upload foto KTP');
                return false;
            }

            return true;
        }

        // Image preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('Harap pilih file gambar (JPG, PNG)');
                    input.value = '';
                    return;
                }

                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    input.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }

        // Form submission
        document.getElementById('umkmForm').addEventListener('submit', function (e) {
            // Check terms agreement
            if (!document.getElementById('agreeTerms').checked) {
                e.preventDefault();
                alert('Harap setujui Syarat & Ketentuan');
                goToStep(3);
                return;
            }

            // Final validation
            if (!validateStep1() || !validateStep2()) {
                e.preventDefault();
                alert('Harap lengkapi semua data yang diperlukan');
                goToStep(1);
                return;
            }

            // Show loading
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mendaftarkan...';
            submitBtn.disabled = true;
        });

        // Auto-format phone number
        document.getElementById('telepon').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (!value.startsWith('0') && !value.startsWith('62')) {
                    value = '0' + value;
                }
                e.target.value = value;
            }
        });

        // Auto-format NIK
        document.getElementById('nik_pemilik').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 16);
        });
    </script>
</body>

</html>