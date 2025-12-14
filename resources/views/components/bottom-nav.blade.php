<!-- Bottom Navigation Component -->
<style>
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

    /* Responsif untuk footer */
    @media (max-width: 768px) {
        .nav-icon span {
            font-size: 0.65rem;
        }
    }

    @media (max-width: 576px) {
        .nav-icon i {
            font-size: 1.3rem;
        }
        
        .nav-icon span {
            font-size: 0.6rem;
        }
    }
</style>

<div class="bottom-nav">
    <div class="container">
        <div class="nav-icons">
            <a href="{{ route('dashboard.index') }}" class="nav-icon {{ Request::routeIs('dashboard.index') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('videos.index') }}" class="nav-icon {{ Request::routeIs('videos.*') ? 'active' : '' }}">
                <i class="fas fa-tv"></i>
                <span>Video</span>
            </a>
            <a href="{{ route('qr.scan') }}" class="nav-icon {{ Request::routeIs('qr.*') ? 'active' : '' }}">
                <i class="fas fa-qrcode"></i>
                <span>Scan QR</span>
            </a>
            <a href="{{ route('orders.index') }}" class="nav-icon {{ Request::routeIs('orders.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i>
                <span>Pesanan</span>
            </a>
            <a href="{{ route('profile.index') }}" class="nav-icon {{ Request::routeIs('profile.*') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </div>
    </div>
</div>