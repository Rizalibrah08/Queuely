<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Queuely</title>

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
            position: relative;
            overflow: hidden;
        }

        .profile-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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

        .profile-status.logged-in {
            background-color: #d4edda;
            color: #155724;
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
            cursor: pointer;
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
            font-size: 1rem;
            cursor: pointer;
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
            border-bottom: 1px solid var(--color-light);
            cursor: pointer;
        }

        .menu-item:last-child {
            border-bottom: none;
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

        /* Voucher Kosong */
        .no-coupons {
            text-align: center;
            padding: 40px 20px;
            color: #888;
        }

        .no-coupons i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--color-beige);
            opacity: 0.6;
        }

        .no-coupons h5 {
            color: var(--color-dark);
            font-weight: 600;
            margin-bottom: 10px;
        }

        .no-coupons p {
            font-size: 0.9rem;
            max-width: 300px;
            margin: 0 auto;
            line-height: 1.5;
        }

        .version-info {
            text-align: center;
            color: #888;
            font-size: 0.8rem;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--color-light);
        }

        /* Modal Login - DIPERBAIKI */
        .modal-login .modal-dialog {
            max-width: 400px;
        }

        .modal-login .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(73, 54, 40, 0.15);
            overflow: hidden;
        }

        .modal-login .modal-header {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border-bottom: none;
            padding: 25px 30px;
            text-align: center;
        }

        .modal-login .modal-title {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
        }

        .modal-login .modal-header .btn-close {
            filter: invert(1) brightness(2);
            opacity: 0.8;
        }

        .modal-login .modal-body {
            padding: 30px;
            background-color: white;
        }

        /* Tabs Custom */
        .modal-login .nav-tabs {
            border-bottom: 2px solid var(--color-beige);
            margin-bottom: 25px;
        }

        .modal-login .nav-tabs .nav-link {
            color: var(--color-dark);
            font-weight: 600;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 12px 20px;
            transition: all 0.3s;
        }

        .modal-login .nav-tabs .nav-link:hover {
            color: var(--color-brown);
            background-color: rgba(214, 192, 179, 0.1);
        }

        .modal-login .nav-tabs .nav-link.active {
            color: var(--color-brown);
            background-color: transparent;
            border-bottom: 3px solid var(--color-brown);
        }

        /* Form Controls */
        .modal-login .form-label {
            color: var(--color-dark);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .modal-login .form-control {
            border: 2px solid var(--color-light);
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s;
            color: var(--color-dark);
        }

        .modal-login .form-control:focus {
            border-color: var(--color-brown);
            box-shadow: 0 0 0 0.2rem rgba(171, 136, 109, 0.25);
        }

        .modal-login .form-check-input:checked {
            background-color: var(--color-brown);
            border-color: var(--color-brown);
        }

        .modal-login .form-check-label {
            color: var(--color-dark);
        }

        /* Buttons */
        .modal-login .btn-login {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .modal-login .btn-login:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .modal-login .btn-register {
            background: linear-gradient(135deg, var(--color-brown), #C9A688);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
            margin-top: 10px;
        }

        .modal-login .btn-register:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Links */
        .modal-login .forgot-password {
            color: var(--color-brown);
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .modal-login .forgot-password:hover {
            text-decoration: underline;
        }

        /* Divider */
        .modal-login .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
            color: var(--color-dark);
        }

        .modal-login .divider::before,
        .modal-login .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--color-light);
        }

        .modal-login .divider span {
            padding: 0 15px;
            color: var(--color-dark);
            font-size: 0.9rem;
        }

        /* Social Login */
        .modal-login .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .modal-login .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            transition: all 0.3s;
            border: none;
        }

        .modal-login .social-btn:hover {
            transform: translateY(-3px);
        }

        .modal-login .btn-google {
            background-color: #DB4437;
        }

        .modal-login .btn-facebook {
            background-color: #4267B2;
        }

        /* Modal Edit Profil */
        .modal-edit-profile .modal-dialog {
            max-width: 500px;
        }

        .modal-edit-profile .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-edit-profile .modal-header {
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border-bottom: none;
            padding: 25px 30px;
        }

        .modal-edit-profile .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .modal-edit-profile .modal-body {
            padding: 30px;
        }

        .avatar-upload {
            text-align: center;
            margin-bottom: 25px;
        }

        .avatar-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: var(--color-beige);
            margin: 0 auto 15px;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: var(--shadow);
            position: relative;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-change-btn {
            background-color: var(--color-light);
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            color: var(--color-dark);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .avatar-change-btn:hover {
            background-color: var(--color-beige);
        }

        .btn-update-profile {
            width: 100%;
            background: linear-gradient(135deg, var(--color-dark), var(--color-brown));
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-update-profile:hover {
            opacity: 0.9;
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

            .modal-login .modal-dialog {
                margin: 20px;
            }

            .modal-edit-profile .modal-body {
                padding: 20px;
            }

            .avatar-preview {
                width: 100px;
                height: 100px;
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

            .modal-login .modal-dialog {
                margin: 10px;
            }

            .modal-login .modal-body {
                padding: 20px;
            }

            .modal-edit-profile .modal-dialog {
                margin: 10px;
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
                <div style="width: 80px;"></div>
            </div>
        </div>
    </div>

    <!-- Profil Header -->
    <div class="container">
        <div class="profile-header">
            <div class="profile-icon">
                @if(auth()->check() && auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Profile" id="profileAvatar">
                @else
                    <i class="fas fa-user" id="profileIcon"></i>
                @endif
            </div>
            <h2 class="profile-name" id="userName">
                {{ auth()->check() ? auth()->user()->name : 'Guest User' }}
            </h2>
            <div class="profile-status {{ auth()->check() ? 'logged-in' : '' }}" id="userStatus">
                {{ auth()->check() ? 'Telah Login' : 'Belum Login' }}
            </div>
            @auth
                <button class="profile-edit-btn" id="editProfileBtn" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal">
                    <i class="fas fa-edit me-1"></i> Edit Profil
                </button>
                <form action="{{ route('profile.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="profile-edit-btn"
                        style="margin-left: 10px; border-color: #dc3545; color: #dc3545;">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            @endauth
        </div>

        @guest
            <!-- Login Banner (untuk user belum login) -->
            <div class="login-banner">
                <h4>Hi</h4>
                <p>You haven't logged in yet.</p>
                <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login / Register</button>
            </div>
        @endguest

        <!-- DIV 1: Order & Coupons -->
        <div class="profile-section">
            <div class="section-title">Pesanan & Voucher</div>

            @auth
                <a href="{{ route('orders.index') }}" class="menu-item">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="menu-item-text">Pesanan Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @else
                <a href="#" class="menu-item" onclick="showLoginAlert('pesanan')">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="menu-item-text">Pesanan Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @endauth

            @auth
                <a href="#" class="menu-item" onclick="showComingSoon('voucher')">
                    <i class="fas fa-tag"></i>
                    <div class="menu-item-text">Voucher Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @else
                <a href="#" class="menu-item" onclick="showLoginAlert('voucher')">
                    <i class="fas fa-tag"></i>
                    <div class="menu-item-text">Voucher Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @endauth
        </div>

        <!-- Voucher Tersedia -->
        <div class="profile-section">
            <div class="section-title">Voucher Tersedia</div>
            <div class="no-coupons">
                <i class="fas fa-tag"></i>
                <h5>Belum Ada Voucher</h5>
                <p>Voucher akan muncul di sini setelah Anda melakukan transaksi</p>
            </div>
        </div>

        <!-- DIV 2: Pengaturan & Lainnya -->
        <div class="profile-section">
            <div class="section-title">Untuk UMKM</div>

            @auth
                @if(auth()->user()->isUmkm())
                    <a href="{{ route('umkm.dashboard') }}" class="menu-item">
                        <i class="fas fa-store"></i>
                        <div class="menu-item-text">Dashboard Anda</div>
                        <div class="menu-item-text small">Kelola UMKM dan pesanan Anda</div>
                        <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                    </a>
                @elseif(auth()->user()->hasPendingUmkm())
                    <a href="{{ route('umkm.status') }}" class="menu-item">
                        <i class="fas fa-clock"></i>
                        <div class="menu-item-text">Status Pendaftaran</div>
                        <div class="menu-item-text small">Menunggu persetujuan admin</div>
                        <div class="menu-item-badge">Pending</div>
                        <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                    </a>
                @else
                    <a href="{{ route('umkm.create') }}" class="menu-item">
                        <i class="fas fa-list-alt"></i>
                        <div class="menu-item-text">Daftarkan Menu Online</div>
                        <div class="menu-item-text small">Buat menu online untuk UMKM Anda</div>
                        <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                    </a>
                @endif
            @else
                <a href="#" class="menu-item" onclick="showLoginAlert('umkm')">
                    <i class="fas fa-list-alt"></i>
                    <div class="menu-item-text">Daftarkan Menu Online</div>
                    <div class="menu-item-text small">Buat menu online untuk UMKM Anda</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @endauth

            <div class="section-title" style="margin-top: 10px;">Akun & Pengaturan</div>

            @auth
                <a href="#" class="menu-item" onclick="showComingSoon('favorit')">
                    <i class="fas fa-heart"></i>
                    <div class="menu-item-text">Favorit Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @else
                <a href="#" class="menu-item" onclick="showLoginAlert('favorit')">
                    <i class="fas fa-heart"></i>
                    <div class="menu-item-text">Favorit Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @endauth

            @auth
                <a href="#" class="menu-item" onclick="showComingSoon('ulasan')">
                    <i class="fas fa-star"></i>
                    <div class="menu-item-text">Ulasan Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @else
                <a href="#" class="menu-item" onclick="showLoginAlert('ulasan')">
                    <i class="fas fa-star"></i>
                    <div class="menu-item-text">Ulasan Saya</div>
                    <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            @endauth

            <a href="#" class="menu-item" onclick="showComingSoon('bantuan')">
                <i class="fas fa-question-circle"></i>
                <div class="menu-item-text">Pusat Bantuan</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>

            <a href="#" class="menu-item" onclick="showComingSoon('pengaturan')">
                <i class="fas fa-cog"></i>
                <div class="menu-item-text">Pengaturan</div>
                <div class="menu-item-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>
        </div>

        <!-- Version Info -->
        <div class="version-info">
            Queuely Version 1.0.0
        </div>
    </div>

    <!-- INCLUDE FOOTER -->
    @include('components.bottom-nav')

    <!-- Modal Login/Register - DIPERBAIKI -->
    <div class="modal fade modal-login" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Selamat Datang di Queuely</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Login/Register Tabs -->
                    <ul class="nav nav-tabs" id="loginTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login"
                                type="button" role="tab">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register"
                                type="button" role="tab">
                                <i class="fas fa-user-plus me-2"></i>Daftar
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="loginTabContent">
                        <!-- Login Form -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form action="{{ route('profile.login') }}" method="POST" id="loginForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email"
                                        placeholder="masukkan email anda" required>
                                </div>

                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password"
                                        placeholder="masukkan password" required>
                                    <div class="form-text text-end">
                                        <a href="#" class="forgot-password">Lupa Password?</a>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                                    <label class="form-check-label" for="rememberMe">Ingat saya</label>
                                </div>

                                <button type="submit" class="btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                </button>
                            </form>

                            <div class="divider">
                                <span>Atau masuk dengan</span>
                            </div>

                            <div class="social-login">
                                <button type="button" class="social-btn btn-google">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="social-btn btn-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form action="{{ route('profile.register') }}" method="POST" id="registerForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="registerName" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="registerName" name="name"
                                            placeholder="nama anda" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="registerPhone" class="form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="registerPhone" name="phone"
                                            placeholder="08xxxx" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="registerEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="registerEmail" name="email"
                                        placeholder="email@contoh.com" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="registerPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="registerPassword"
                                            name="password" placeholder="min. 8 karakter" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="registerPasswordConfirmation" class="form-label">Ulangi
                                            Password</label>
                                        <input type="password" class="form-control" id="registerPasswordConfirmation"
                                            name="password_confirmation" placeholder="ulangi password" required>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agreeTerms" name="terms"
                                        required>
                                    <label class="form-check-label" for="agreeTerms">
                                        Saya setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a>
                                    </label>
                                </div>

                                <button type="submit" class="btn-register">
                                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                </button>
                            </form>

                            <p class="text-center mt-3" style="font-size: 0.9rem; color: var(--color-dark);">
                                Sudah punya akun?
                                <a href="#" class="text-primary" onclick="switchToLogin()">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Profil -->
    <div class="modal fade modal-edit-profile" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" enctype="multipart/form-data">
                        @csrf
                        <div class="avatar-upload">
                            <div class="avatar-preview">
                                @if(auth()->check() && auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" id="avatarPreview">
                                @else
                                    <i class="fas fa-user" id="avatarIcon" style="font-size: 3rem; line-height: 112px;"></i>
                                @endif
                            </div>
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none;">
                            <button type="button" class="avatar-change-btn"
                                onclick="document.getElementById('avatarInput').click()">
                                <i class="fas fa-camera me-1"></i> Ganti Foto
                            </button>
                        </div>

                        <div class="mb-3">
                            <label for="editName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="editName" name="name"
                                value="{{ auth()->user()->name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="editPhone" name="phone"
                                value="{{ auth()->user()->phone ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail"
                                value="{{ auth()->user()->email ?? '' }}" disabled>
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>

                        <button type="submit" class="btn-update-profile">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk show login alert
        function showLoginAlert(menuType) {
            const menuNames = {
                'pesanan': 'Pesanan Saya',
                'voucher': 'Voucher Saya',
                'umkm': 'Daftarkan Menu Online',
                'favorit': 'Favorit Saya',
                'ulasan': 'Ulasan Saya'
            };

            // Tampilkan modal login langsung
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();

            // Tampilkan pesan di console (opsional)
            console.log('Silakan login untuk mengakses: ' + menuNames[menuType]);
        }

        // Fungsi untuk beralih ke tab login
        function switchToLogin() {
            const loginTab = document.querySelector('#login-tab');
            if (loginTab) {
                loginTab.click();
            }
        }

        // Fungsi untuk show coming soon alert
        function showComingSoon(menuType) {
            const menuNames = {
                'pesanan': 'Pesanan Saya',
                'voucher': 'Voucher Saya',
                'umkm': 'Daftarkan Menu Online',
                'favorit': 'Favorit Saya',
                'ulasan': 'Ulasan Saya',
                'bantuan': 'Pusat Bantuan',
                'pengaturan': 'Pengaturan'
            };

            alert('Halaman ' + menuNames[menuType] + ' akan segera tersedia!');
        }

        // Preview avatar saat dipilih
        document.getElementById('avatarInput')?.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    if (document.getElementById('avatarPreview')) {
                        document.getElementById('avatarPreview').src = e.target.result;
                        document.getElementById('avatarPreview').style.display = 'block';
                        document.getElementById('avatarIcon').style.display = 'none';
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Submit edit profile form dengan AJAX
        document.getElementById('editProfileForm')?.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            // Show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

            try {
                const response = await fetch('{{ route("profile.update") }}', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    alert('Profil berhasil diperbarui!');
                    location.reload();
                } else {
                    if (data.errors) {
                        let errorMsg = 'Gagal memperbarui profil:\n';
                        Object.values(data.errors).forEach(errors => {
                            errorMsg += errors.join('\n') + '\n';
                        });
                        alert(errorMsg);
                    } else {
                        alert(data.message || 'Gagal memperbarui profil');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memperbarui profil');
            } finally {
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });

        // Validasi form register
        document.getElementById('registerForm')?.addEventListener('submit', function (e) {
            const password = document.getElementById('registerPassword').value;
            const confirmPassword = document.getElementById('registerPasswordConfirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                return false;
            }

            if (password.length < 8) {
                e.preventDefault();
                alert('Password harus minimal 8 karakter!');
                return false;
            }

            return true;
        });

        // Tampilkan pesan dari session
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif

        @if(session('error'))
            alert('{{ session('error') }}');
        @endif

        @if(session('info'))
            alert('{{ session('info') }}');
        @endif

        // Animasi untuk modal
        document.addEventListener('DOMContentLoaded', function () {
            // Auto focus pada email field saat modal login terbuka
            const loginModal = document.getElementById('loginModal');
            if (loginModal) {
                loginModal.addEventListener('shown.bs.modal', function () {
                    const activeTab = this.querySelector('.nav-link.active');
                    if (activeTab.id === 'login-tab') {
                        document.getElementById('loginEmail').focus();
                    } else {
                        document.getElementById('registerName').focus();
                    }
                });
            }
        });
    </script>
</body>

</html>