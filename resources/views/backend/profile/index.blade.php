<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - AntriUMKM</title>
    
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
        
        .profile-header {
            text-align: center;
            padding: 30px 20px;
            background-color: white;
            border-bottom: 1px solid var(--color-light);
        }
        
        .profile-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--color-beige);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--color-dark);
            font-size: 2.5rem;
            border: 4px solid white;
            box-shadow: var(--shadow);
        }
        
        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 5px;
        }
        
        .profile-status {
            display: inline-block;
            background-color: #f8d7da;
            color: #721c24;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .profile-edit-btn {
            background-color: transparent;
            border: 2px solid var(--color-brown);
            color: var(--color-brown);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .profile-edit-btn:hover {
            background-color: var(--color-brown);
            color: white;
        }
        
        /* Login Banner */
        .login-banner {
            background-color: var(--color-dark);
            color: white;
            border-radius: 10px;
            padding: 25px 20px;
            margin: 25px 0;
            text-align: center;
            box-shadow: var(--shadow);
        }
        
        .login-banner h4 {
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .login-banner p {
            font-size: 0.9rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        
        .login-btn {
            background-color: white;
            color: var(--color-dark);
            border: none;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .login-btn:hover {
            background-color: var(--color-beige);
        }
        
        /* Profile Menu Sections */
        .profile-section {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: var(--shadow);
        }
        
        /* DIV 1: Order & Coupons */
        .section-divider {
            margin: 30px 0;
            position: relative;
            text-align: center;
        }
        
        .section-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--color-light);
            z-index: 1;
        }
        
        .section-divider-text {
            background-color: #f8f9fa;
            padding: 0 15px;
            position: relative;
            z-index: 2;
            color: var(--color-brown);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* Menu Items */
        .menu-section {
            border-bottom: 1px solid var(--color-light);
        }
        
        .menu-section:last-child {
            border-bottom: none;
        }
        
        .section-title {
            padding: 15px 20px;
            font-weight: 700;
            color: var(--color-dark);
            background-color: rgba(214, 192, 179, 0.1);
            font-size: 1rem;
        }
        
        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            text-decoration: none;
            color: var(--color-dark);
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover {
            background-color: rgba(214, 192, 179, 0.1);
            border-left-color: var(--color-brown);
        }
        
        .menu-item i {
            width: 24px;
            margin-right: 15px;
            color: var(--color-brown);
            font-size: 1.1rem;
        }
        
        .menu-item-text {
            flex-grow: 1;
        }
        
        .menu-item-text small {
            display: block;
            color: #888;
            font-size: 0.8rem;
            margin-top: 2px;
        }
        
        .menu-item-badge {
            background-color: var(--color-brown);
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 10px;
            margin-left: 10px;
        }
        
        .menu-item-arrow {
            color: #ccc;
        }
        
        /* Coupons Container */
        .coupons-container {
            padding: 20px;
        }
        
        .coupon-card {
            background: linear-gradient(to right, var(--color-beige), var(--color-light));
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid var(--color-brown);
        }
        
        .coupon-title {
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 5px;
        }
        
        .coupon-desc {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
        }
        
        .coupon-code {
            background-color: white;
            border: 1px dashed var(--color-brown);
            padding: 5px 10px;
            border-radius: 5px;
            font-family: monospace;
            font-weight: 600;
            color: var(--color-dark);
            display: inline-block;
        }
        
        .no-coupons {
            text-align: center;
            padding: 30px 20px;
            color: #888;
        }
        
        .no-coupons i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--color-beige);
        }
        
        .version-info {
            text-align: center;
            color: #888;
            font-size: 0.8rem;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--color-light);
        }
        
        /* Footer Sticky dengan Ikon */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: white;
            border-top: 1px solid var(--color-light);
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
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
            padding: 5px 10px;
            border-radius: 8px;
        }

        .nav-icon:hover, .nav-icon.active {
            color: var(--color-brown);
            background-color: var(--color-light);
        }

        .nav-icon i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .nav-icon span {
            font-size: 0.7rem;
            font-weight: 500;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .profile-header {
                padding: 25px 15px;
            }
            
            .profile-icon {
                width: 90px;
                height: 90px;
                font-size: 2.2rem;
            }
            
            .nav-icon span {
                font-size: 0.65rem;
            }
        }

        @media (max-width: 576px) {
            .profile-icon {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
            
            .profile-name {
                font-size: 1.3rem;
            }
            
            .section-title {
                padding: 12px 15px;
                font-size: 0.95rem;
            }
            
            .menu-item {
                padding: 12px 15px;
            }
            
            .nav-icon i {
                font-size: 1.3rem;
            }
            
            .nav-icon span {
                font-size: 0.6rem;
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
                <div style="width: 80px;"></div> <!-- Spacer untuk balance layout -->
            </div>
        </div>
    </div>
    
    <!-- Profil Header -->
    <div class="container">
        <div class="profile-header">
            <div class="profile-icon">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="profile-name">Guest User</h2>
            <div class="profile-status">Belum Login</div>
            <button class="profile-edit-btn">
                <i class="fas fa-edit me-1"></i> Edit Profil
            </button>
        </div>
        
        <!-- Login Banner (untuk user belum login) -->
        <div class="login-banner">
            <h4>Hi</h4>
            <p>You haven't logged in yet.</p>
            <button class="login-btn">Login / Register</button>
        </div>
        
        <!-- DIV 1: Order & Coupons -->
        <div class="profile-section">
            <div class="section-title">Pesanan & Voucher</div>
            
            <a href="#" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <div class="menu-item-text">Pesanan Saya</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            
            <a href="#" class="menu-item">
                <i class="fas fa-tag"></i>
                <div class="menu-item-text">Voucher Saya</div>
                <div class="menu-item-badge">3</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
        </div>
        
        <!-- Coupons List -->
        <div class="profile-section">
            <div class="section-title">Voucher Tersedia</div>
            
            <div class="coupons-container">
                <div class="coupon-card">
                    <div class="coupon-title">Diskon 20% UMKM Baru</div>
                    <div class="coupon-desc">Berlaku untuk semua menu di UMKM yang baru bergabung</div>
                    <div class="coupon-code">ANTRI20</div>
                </div>
                
                <div class="coupon-card">
                    <div class="coupon-title">Gratis Ongkir</div>
                    <div class="coupon-desc">Minimal pembelian Rp 50.000</div>
                    <div class="coupon-code">GRATISONGKIR</div>
                </div>
                
                <div class="coupon-card">
                    <div class="coupon-title">Cashback 10%</div>
                    <div class="coupon-desc">Khusus pembelian melalui aplikasi AntriUMKM</div>
                    <div class="coupon-code">CASHBACK10</div>
                </div>
            </div>
        </div>
        
        <!-- Section Divider -->
        <div class="section-divider">
            <span class="section-divider-text">Pengaturan & Lainnya</span>
        </div>
        
        <!-- DIV 2: Pengaturan & Lainnya -->
        <div class="profile-section">
            <div class="section-title">Untuk UMKM</div>
            
            <a href="#" class="menu-item">
                <i class="fas fa-list-alt"></i>
                <div class="menu-item-text">Daftarkan Menu Online</div>
                <div class="menu-item-text small">Buat menu online untuk UMKM Anda</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            
            <div class="section-title" style="margin-top: 10px;">Akun & Pengaturan</div>
            
            <a href="#" class="menu-item">
                <i class="fas fa-heart"></i>
                <div class="menu-item-text">Favorit Saya</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            
            <a href="#" class="menu-item">
                <i class="fas fa-star"></i>
                <div class="menu-item-text">Ulasan Saya</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            
            <a href="#" class="menu-item">
                <i class="fas fa-question-circle"></i>
                <div class="menu-item-text">Pusat Bantuan</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
            
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                <div class="menu-item-text">Pengaturan</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
        </div>
        
        <!-- Version Info -->
        <div class="version-info">
            AntriUMKM Version 42.19.4.0
        </div>
    </div>
    
    <!-- INCLUDE FOOTER -->
    @include('components.bottom-nav')

    {{-- <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="container">
            <div class="nav-icons">
                <a href="{{ route('dashboard.index') }}" class="nav-icon">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
                <a href="#" class="nav-icon">
                    <i class="fas fa-tv"></i>
                    <span>Video</span>
                </a>
                <a href="#" class="nav-icon">
                    <i class="fas fa-qrcode"></i>
                    <span>Scan QR</span>
                </a>
                <a href="#" class="nav-icon">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('profile.index') }}" class="nav-icon active">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </div> --}}
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan event listeners untuk menu items
            document.querySelectorAll('.menu-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    const itemText = this.querySelector('.menu-item-text').textContent;
                    
                    // Simulasi aksi untuk setiap menu
                    if (itemText.includes('Pesanan Saya')) {
                        alert('Navigasi ke halaman Pesanan Saya');
                    } else if (itemText.includes('Voucher Saya')) {
                        alert('Navigasi ke halaman Voucher Saya');
                    } else if (itemText.includes('Daftarkan Menu Online')) {
                        alert('Navigasi ke halaman Daftarkan Menu Online - Fitur untuk UMKM membuat menu online');
                    } else if (itemText.includes('Favorit Saya')) {
                        alert('Navigasi ke halaman Favorit Saya');
                    } else if (itemText.includes('Ulasan Saya')) {
                        alert('Navigasi ke halaman Ulasan Saya');
                    } else if (itemText.includes('Pusat Bantuan')) {
                        alert('Navigasi ke halaman Pusat Bantuan');
                    } else if (itemText.includes('Pengaturan')) {
                        alert('Navigasi ke halaman Pengaturan');
                    }
                });
            });
            
            // Login button
            document.querySelector('.login-btn').addEventListener('click', function() {
                alert('Navigasi ke halaman Login / Register');
            });
            
            // Edit profile button
            document.querySelector('.profile-edit-btn').addEventListener('click', function() {
                alert('Membuka form edit profil');
            });
            
            // Copy coupon code on click
            document.querySelectorAll('.coupon-code').forEach(codeElement => {
                codeElement.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const code = this.textContent;
                    navigator.clipboard.writeText(code).then(() => {
                        const originalText = this.textContent;
                        this.textContent = 'Tersalin!';
                        this.style.backgroundColor = '#d4edda';
                        this.style.color = '#155724';
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.style.backgroundColor = 'white';
                            this.style.color = 'var(--color-dark)';
                        }, 1500);
                    });
                });
            });
        });
    </script>
</body>
</html>