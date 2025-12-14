<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video - AntriUMKM</title>
    
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
            color: white;
            background-color: #000;
            padding-bottom: 0;
            overflow-x: hidden;
        }
        
        /* Header Atas */
        .top-header {
            padding: 12px 0;
            background-color: rgba(0, 0, 0, 0.9);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            color: white;
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
        
        .search-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .search-btn:hover {
            color: var(--color-brown);
        }
        
        /* Video Feed Container */
        .video-feed-container {
            position: relative;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Video Player */
        .video-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
        }
        
        .video-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 1;
        }
        
        .video-item.active {
            opacity: 1;
            z-index: 2;
        }
        
        .video-element {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 30%, transparent 70%, rgba(0,0,0,0.8) 100%);
            pointer-events: none;
        }
        
        /* Video Controls */
        .video-controls {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 15px;
            z-index: 10;
            padding: 0 20px;
        }
        
        .control-btn {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }
        
        .control-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        .control-btn.active {
            background-color: var(--color-brown);
        }
        
        /* Video Info - Right Side */
        .video-info-right {
            position: absolute;
            right: 20px;
            bottom: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            z-index: 10;
        }
        
        .action-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .action-button:hover {
            transform: scale(1.1);
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 8px;
            backdrop-filter: blur(10px);
        }
        
        .action-count {
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .action-button.liked .action-icon {
            background-color: rgba(255, 59, 92, 0.2);
            color: #ff3b5c;
        }
        
        /* Video Info - Left Side */
        .video-info-left {
            position: absolute;
            left: 20px;
            bottom: 120px;
            max-width: 70%;
            z-index: 10;
        }
        
        .video-merchant {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }
        
        .merchant-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            flex-shrink: 0;
        }
        
        .merchant-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .merchant-info {
            flex: 1;
        }
        
        .merchant-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 3px;
        }
        
        .merchant-category {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }
        
        .follow-btn {
            background-color: var(--color-brown);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 6px 15px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .follow-btn:hover {
            background-color: var(--color-dark);
        }
        
        .follow-btn.following {
            background-color: transparent;
            border: 1px solid white;
        }
        
        .video-caption {
            font-size: 0.95rem;
            line-height: 1.4;
            margin-bottom: 10px;
            max-height: 100px;
            overflow: hidden;
        }
        
        .video-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }
        
        .video-tag {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .video-tag:hover {
            background-color: var(--color-brown);
        }
        
        /* Video Navigation Dots */
        .video-nav-dots {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 10;
        }
        
        .nav-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .nav-dot.active {
            background-color: white;
            transform: scale(1.2);
        }
        
        .nav-dot.watched {
            background-color: var(--color-brown);
        }
        
        /* Comments Panel */
        .comments-panel {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.95);
            z-index: 1000;
            transition: right 0.3s ease;
            backdrop-filter: blur(10px);
            border-left: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .comments-panel.show {
            right: 0;
        }
        
        .comments-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .comments-title {
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .close-comments {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .comments-list {
            height: calc(100vh - 180px);
            overflow-y: auto;
            padding: 20px;
        }
        
        .comment-item {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            flex-shrink: 0;
        }
        
        .comment-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .comment-content {
            flex: 1;
        }
        
        .comment-author {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .comment-text {
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 8px;
        }
        
        .comment-time {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }
        
        .comment-actions {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }
        
        .comment-action {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .comment-action:hover {
            color: white;
        }
        
        .comment-action.liked {
            color: #ff3b5c;
        }
        
        .comment-input-container {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.9);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .comment-input-wrapper {
            display: flex;
            gap: 10px;
        }
        
        .comment-input {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 12px 20px;
            color: white;
            font-size: 0.9rem;
        }
        
        .comment-input:focus {
            outline: none;
            border-color: var(--color-brown);
        }
        
        .comment-submit {
            background-color: var(--color-brown);
            color: white;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .comment-submit:hover {
            background-color: var(--color-dark);
        }
        
        /* Share Modal */
        .share-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1100;
            display: none;
            justify-content: center;
            align-items: center;
        }
        
        .share-modal.show {
            display: flex;
        }
        
        .share-container {
            background-color: rgba(30, 30, 30, 0.95);
            border-radius: 20px;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .share-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .share-options {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .share-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .share-option:hover {
            transform: scale(1.1);
        }
        
        .share-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .share-icon.whatsapp {
            background-color: #25D366;
        }
        
        .share-icon.facebook {
            background-color: #1877F2;
        }
        
        .share-icon.instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        }
        
        .share-icon.twitter {
            background-color: #1DA1F2;
        }
        
        .share-icon.link {
            background-color: var(--color-brown);
        }
        
        .share-icon.copy {
            background-color: #666;
        }
        
        .share-icon.save {
            background-color: #FF9500;
        }
        
        .share-option-name {
            font-size: 0.8rem;
            text-align: center;
        }
        
        .share-link-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .share-link {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 15px;
            color: white;
            font-size: 0.9rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .share-copy-btn {
            background-color: var(--color-brown);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 0 20px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .share-copy-btn:hover {
            background-color: var(--color-dark);
        }
        
        .close-share {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
            padding: 12px 0;
            width: 100%;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .close-share:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 8px 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
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
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .nav-icon:hover, .nav-icon.active {
            color: var(--color-brown);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-icon i {
            font-size: 1.2rem;
            margin-bottom: 3px;
        }

        .nav-icon span {
            font-size: 0.65rem;
            font-weight: 500;
        }
        
        /* Loading Spinner */
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--color-brown);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .comments-panel {
                width: 100%;
                right: -100%;
            }
            
            .video-info-right {
                right: 15px;
                bottom: 100px;
                gap: 15px;
            }
            
            .video-info-left {
                left: 15px;
                bottom: 100px;
            }
            
            .action-icon {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .control-btn {
                width: 45px;
                height: 45px;
            }
            
            .share-options {
                grid-template-columns: repeat(3, 1fr);
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
            
            .video-info-right {
                right: 12px;
                bottom: 90px;
                gap: 12px;
            }
            
            .video-info-left {
                left: 12px;
                bottom: 90px;
            }
            
            .merchant-avatar {
                width: 45px;
                height: 45px;
            }
            
            .merchant-name {
                font-size: 1rem;
            }
            
            .video-caption {
                font-size: 0.9rem;
            }
            
            .action-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .action-count {
                font-size: 0.75rem;
            }
            
            .nav-icon i {
                font-size: 1.1rem;
            }
            
            .nav-icon span {
                font-size: 0.55rem;
            }
            
            .share-container {
                padding: 20px;
            }
            
            .share-options {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
        }
        
        @media (max-width: 380px) {
            .video-info-right {
                right: 10px;
                gap: 10px;
            }
            
            .video-info-left {
                left: 10px;
            }
            
            .merchant-avatar {
                width: 40px;
                height: 40px;
            }
            
            .action-icon {
                width: 35px;
                height: 35px;
                font-size: 0.9rem;
            }
            
            .nav-icon {
                padding: 3px 6px;
            }
            
            .nav-icon i {
                font-size: 1rem;
            }
            
            .follow-btn {
                padding: 5px 12px;
                font-size: 0.75rem;
            }
        }
        
        /* Hide scrollbar but keep functionality */
        .comments-list::-webkit-scrollbar {
            width: 5px;
        }
        
        .comments-list::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .comments-list::-webkit-scrollbar-thumb {
            background: var(--color-brown);
            border-radius: 10px;
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
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Video Feed -->
    <div class="video-feed-container" id="videoFeed">
        <!-- Video items will be inserted here by JavaScript -->
    </div>
    
    <!-- Video Navigation Dots -->
    <div class="video-nav-dots" id="navDots">
        <!-- Dots will be inserted here by JavaScript -->
    </div>
    
    <!-- Comments Panel -->
    <div class="comments-panel" id="commentsPanel">
        <div class="comments-header">
            <div class="comments-title">Komentar</div>
            <button class="close-comments" id="closeCommentsBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="comments-list" id="commentsList">
            <!-- Comments will be loaded here -->
        </div>
        
        <div class="comment-input-container">
            <div class="comment-input-wrapper">
                <input type="text" class="comment-input" id="commentInput" placeholder="Tulis komentar...">
                <button class="comment-submit" id="commentSubmitBtn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Share Modal -->
    <div class="share-modal" id="shareModal">
        <div class="share-container">
            <div class="share-title">Bagikan Video</div>
            
            <div class="share-options">
                <button class="share-option" data-share="whatsapp">
                    <div class="share-icon whatsapp">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="share-option-name">WhatsApp</div>
                </button>
                
                <button class="share-option" data-share="facebook">
                    <div class="share-icon facebook">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="share-option-name">Facebook</div>
                </button>
                
                <button class="share-option" data-share="instagram">
                    <div class="share-icon instagram">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <div class="share-option-name">Instagram</div>
                </button>
                
                <button class="share-option" data-share="twitter">
                    <div class="share-icon twitter">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="share-option-name">Twitter</div>
                </button>
                
                <button class="share-option" data-share="link">
                    <div class="share-icon link">
                        <i class="fas fa-link"></i>
                    </div>
                    <div class="share-option-name">Salin Link</div>
                </button>
                
                <button class="share-option" data-share="copy">
                    <div class="share-icon copy">
                        <i class="fas fa-copy"></i>
                    </div>
                    <div class="share-option-name">Salin Video</div>
                </button>
                
                <button class="share-option" data-share="save">
                    <div class="share-icon save">
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="share-option-name">Simpan</div>
                </button>
            </div>
            
            <div class="share-link-container">
                <div class="share-link" id="shareLinkText">https://antriumkm.id/video/123</div>
                <button class="share-copy-btn" id="copyLinkBtn">Salin</button>
            </div>
            
            <button class="close-share" id="closeShareBtn">Tutup</button>
        </div>
    </div>
    
    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="container">
            <div class="nav-icons">
                <a href="{{ route('dashboard.index') }}" class="nav-icon">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('videos.index') }}" class="nav-icon active">
                    <i class="fas fa-tv"></i>
                    <span>Video</span>
                </a>
                <a href="{{ route('qr.scan') }}" class="nav-icon">
                    <i class="fas fa-qrcode"></i>
                    <span>Scan QR</span>
                </a>
                <a href="{{ route('orders.index') }}" class="nav-icon">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Pesanan</span>
                </a>
                <a href="{{ route('profile.index') }}" class="nav-icon">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video Data
            const videos = [
                {
                    id: 1,
                    title: "Cara membuat Kopi Special",
                    description: "Lihat bagaimana kami membuat kopi special dengan teknik manual brew yang sempurna. Cocok untuk pecinta kopi! ☕",
                    merchant: {
                        id: "UMKM001",
                        name: "Kopi Teman Sejati",
                        category: "Coffee Shop",
                        avatar: "https://images.unsplash.com/photo-1567306226416-28f0efdc88ce?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        followers: 12500,
                        isFollowing: false
                    },
                    videoUrl: "https://assets.mixkit.co/videos/preview/mixkit-coffee-being-poured-into-a-cup-1291-large.mp4",
                    likes: 2450,
                    comments: 89,
                    shares: 120,
                    isLiked: false,
                    tags: ["#kopi", "#coffeeshop", "#umkm", "#kuliner"],
                    duration: 15
                },
                {
                    id: 2,
                    title: "Proses Pembuatan Martabak",
                    description: "Dari adonan sampai matang, lihat proses pembuatan martabak manis yang lezat dan menggiurkan! 🥞",
                    merchant: {
                        id: "UMKM002",
                        name: "Martabak Manis 89",
                        category: "Street Food",
                        avatar: "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        followers: 8500,
                        isFollowing: true
                    },
                    videoUrl: "https://assets.mixkit.co/videos/preview/mixkit-cooking-pancakes-in-a-pan-4151-large.mp4",
                    likes: 3200,
                    comments: 145,
                    shares: 210,
                    isLiked: true,
                    tags: ["#martabak", "#streetfood", "#makanan", "#enak"],
                    duration: 20
                },
                {
                    id: 3,
                    title: "Warung Makan Spesial Nasi Goreng",
                    description: "Nasi goreng spesial dengan bumbu rahasia turun temurun. Bikin ngiler! 😋",
                    merchant: {
                        id: "UMKM003",
                        name: "Warung Makan Sederhana",
                        category: "Indonesian Food",
                        avatar: "https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        followers: 18900,
                        isFollowing: false
                    },
                    videoUrl: "https://assets.mixkit.co/videos/preview/mixkit-woman-cooking-eggs-on-the-stove-1568-large.mp4",
                    likes: 4120,
                    comments: 210,
                    shares: 350,
                    isLiked: false,
                    tags: ["#nasigoreng", "#indonesianfood", "#warung", "#kulinerindonesia"],
                    duration: 18
                },
                {
                    id: 4,
                    title: "Tutorial Barista Basic",
                    description: "Belajar dasar-dasar menjadi barista dengan alat sederhana. Cocok untuk UMKM coffee shop!",
                    merchant: {
                        id: "UMKM004",
                        name: "Coffee Lab Jakarta",
                        category: "Coffee Training",
                        avatar: "https://images.unsplash.com/photo-1511537190424-bbbab87ac5eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        followers: 25600,
                        isFollowing: true
                    },
                    videoUrl: "https://assets.mixkit.co/videos/preview/mixkit-pouring-milk-into-a-coffee-1749-large.mp4",
                    likes: 5200,
                    comments: 310,
                    shares: 420,
                    isLiked: false,
                    tags: ["#barista", "#tutorial", "#coffee", "#umkmsukses"],
                    duration: 25
                },
                {
                    id: 5,
                    title: "Cara Membuat Kue Tradisional",
                    description: "Melestarikan kue tradisional Indonesia dengan sentuhan modern. Enak dan bernostalgia! 🍰",
                    merchant: {
                        id: "UMKM005",
                        name: "Kue Nusantara",
                        category: "Traditional Cake",
                        avatar: "https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        followers: 9600,
                        isFollowing: false
                    },
                    videoUrl: "https://assets.mixkit.co/videos/preview/mixkit-homemade-cake-being-decorated-4156-large.mp4",
                    likes: 3800,
                    comments: 178,
                    shares: 290,
                    isLiked: true,
                    tags: ["#kuetradisional", "#nusantara", "#kue", "#indonesia"],
                    duration: 22
                }
            ];

            // Comments Data
            const comments = [
                {
                    id: 1,
                    user: {
                        name: "Budi Santoso",
                        avatar: "https://randomuser.me/api/portraits/men/32.jpg"
                    },
                    text: "Wah kopinya kelihatan enak banget! Lokasinya dimana ya?",
                    time: "2 jam yang lalu",
                    likes: 24,
                    isLiked: false,
                    replies: 3
                },
                {
                    id: 2,
                    user: {
                        name: "Sari Dewi",
                        avatar: "https://randomuser.me/api/portraits/women/44.jpg"
                    },
                    text: "Saya sudah coba, emang enak banget! Recommended 👍",
                    time: "5 jam yang lalu",
                    likes: 18,
                    isLiked: true,
                    replies: 1
                },
                {
                    id: 3,
                    user: {
                        name: "Ahmad Fauzi",
                        avatar: "https://randomuser.me/api/portraits/men/67.jpg"
                    },
                    text: "Harganya bersahabat nggak nih? Mau coba weekend ini",
                    time: "1 hari yang lalu",
                    likes: 12,
                    isLiked: false,
                    replies: 0
                },
                {
                    id: 4,
                    user: {
                        name: "Maya Indah",
                        avatar: "https://randomuser.me/api/portraits/women/68.jpg"
                    },
                    text: "Teknik brew-nya menarik, mau coba praktek di rumah",
                    time: "2 hari yang lalu",
                    likes: 31,
                    isLiked: false,
                    replies: 5
                },
                {
                    id: 5,
                    user: {
                        name: "Rizky Pratama",
                        avatar: "https://randomuser.me/api/portraits/men/75.jpg"
                    },
                    text: "Wah UMKM lokal keren! Support terus produk dalam negeri",
                    time: "3 hari yang lalu",
                    likes: 45,
                    isLiked: true,
                    replies: 2
                }
            ];

            // State
            let currentVideoIndex = 0;
            let videoElements = [];
            let isPlaying = true;
            let currentVideoElement = null;

            // DOM Elements
            const videoFeed = document.getElementById('videoFeed');
            const navDots = document.getElementById('navDots');
            const commentsPanel = document.getElementById('commentsPanel');
            const commentsList = document.getElementById('commentsList');
            const shareModal = document.getElementById('shareModal');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const searchBtn = document.querySelector('.search-btn');

            // Initialize videos
            function initVideos() {
                videos.forEach((video, index) => {
                    // Create video item
                    const videoItem = document.createElement('div');
                    videoItem.className = `video-item ${index === 0 ? 'active' : ''}`;
                    videoItem.dataset.id = video.id;
                    
                    const videoHTML = `
                        <video class="video-element" loop muted playsinline>
                            <source src="${video.videoUrl}" type="video/mp4">
                        </video>
                        <div class="video-overlay"></div>
                        
                        <!-- Right Side Actions -->
                        <div class="video-info-right">
                            <button class="action-button like-btn ${video.isLiked ? 'liked' : ''}" data-id="${video.id}">
                                <div class="action-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="action-count">${formatNumber(video.likes)}</div>
                            </button>
                            
                            <button class="action-button comment-btn" data-id="${video.id}">
                                <div class="action-icon">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="action-count">${formatNumber(video.comments)}</div>
                            </button>
                            
                            <button class="action-button share-btn" data-id="${video.id}">
                                <div class="action-icon">
                                    <i class="fas fa-share"></i>
                                </div>
                                <div class="action-count">${formatNumber(video.shares)}</div>
                            </button>
                            
                            <button class="action-button save-btn" data-id="${video.id}">
                                <div class="action-icon">
                                    <i class="fas fa-bookmark"></i>
                                </div>
                                <div class="action-count">Save</div>
                            </button>
                        </div>
                        
                        <!-- Left Side Info -->
                        <div class="video-info-left">
                            <div class="video-merchant">
                                <div class="merchant-avatar">
                                    <img src="${video.merchant.avatar}" alt="${video.merchant.name}">
                                </div>
                                <div class="merchant-info">
                                    <div class="merchant-name">${video.merchant.name}</div>
                                    <div class="merchant-category">${video.merchant.category}</div>
                                </div>
                                <button class="follow-btn ${video.merchant.isFollowing ? 'following' : ''}" data-id="${video.merchant.id}">
                                    ${video.merchant.isFollowing ? 'Following' : 'Follow'}
                                </button>
                            </div>
                            
                            <div class="video-caption">${video.description}</div>
                            
                            <div class="video-tags">
                                ${video.tags.map(tag => `<a href="#" class="video-tag">${tag}</a>`).join('')}
                            </div>
                        </div>
                    `;
                    
                    videoItem.innerHTML = videoHTML;
                    videoFeed.appendChild(videoItem);
                    
                    // Create nav dot
                    const navDot = document.createElement('div');
                    navDot.className = `nav-dot ${index === 0 ? 'active' : ''}`;
                    navDot.dataset.index = index;
                    navDots.appendChild(navDot);
                    
                    // Store video element
                    const videoEl = videoItem.querySelector('.video-element');
                    videoElements.push(videoEl);
                });
                
                // Set current video element
                currentVideoElement = videoElements[0];
                
                // Play first video
                setTimeout(() => {
                    playCurrentVideo();
                    loadingSpinner.style.display = 'none';
                }, 1000);
            }

            // Format number (1.2k, 3.4M)
            function formatNumber(num) {
                if (num >= 1000000) {
                    return (num / 1000000).toFixed(1) + 'M';
                } else if (num >= 1000) {
                    return (num / 1000).toFixed(1) + 'k';
                }
                return num.toString();
            }

            // Play current video
            function playCurrentVideo() {
                if (currentVideoElement) {
                    currentVideoElement.play().catch(e => {
                        console.log("Autoplay prevented, waiting for interaction");
                    });
                }
            }

            // Pause current video
            function pauseCurrentVideo() {
                if (currentVideoElement) {
                    currentVideoElement.pause();
                }
            }

            // Switch to video by index
            function switchVideo(index) {
                if (index < 0 || index >= videos.length) return;
                
                // Pause current video
                pauseCurrentVideo();
                
                // Update UI
                document.querySelectorAll('.video-item').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelectorAll('.nav-dot').forEach(dot => {
                    dot.classList.remove('active');
                });
                
                // Show loading
                loadingSpinner.style.display = 'block';
                
                // Switch after delay
                setTimeout(() => {
                    document.querySelector(`.video-item[data-id="${videos[index].id}"]`).classList.add('active');
                    document.querySelectorAll('.nav-dot')[index].classList.add('active');
                    document.querySelectorAll('.nav-dot')[currentVideoIndex].classList.add('watched');
                    
                    currentVideoIndex = index;
                    currentVideoElement = videoElements[index];
                    
                    // Play new video
                    playCurrentVideo();
                    
                    // Hide loading
                    setTimeout(() => {
                        loadingSpinner.style.display = 'none';
                    }, 500);
                }, 300);
            }

            // Load comments for current video
            function loadComments() {
                commentsList.innerHTML = '';
                
                comments.forEach(comment => {
                    const commentItem = document.createElement('div');
                    commentItem.className = 'comment-item';
                    
                    commentItem.innerHTML = `
                        <div class="comment-avatar">
                            <img src="${comment.user.avatar}" alt="${comment.user.name}">
                        </div>
                        <div class="comment-content">
                            <div class="comment-author">${comment.user.name}</div>
                            <div class="comment-text">${comment.text}</div>
                            <div class="comment-time">${comment.time}</div>
                            <div class="comment-actions">
                                <button class="comment-action like-comment ${comment.isLiked ? 'liked' : ''}" data-id="${comment.id}">
                                    <i class="fas fa-heart"></i> ${comment.likes}
                                </button>
                                <button class="comment-action reply-comment" data-id="${comment.id}">
                                    Balas
                                </button>
                            </div>
                        </div>
                    `;
                    
                    commentsList.appendChild(commentItem);
                });
            }

            // Toggle like for video
            function toggleVideoLike(videoId) {
                const video = videos.find(v => v.id === videoId);
                if (!video) return;
                
                video.isLiked = !video.isLiked;
                video.likes += video.isLiked ? 1 : -1;
                
                // Update UI
                const likeBtn = document.querySelector(`.like-btn[data-id="${videoId}"]`);
                const likeCount = likeBtn.querySelector('.action-count');
                
                likeBtn.classList.toggle('liked');
                likeCount.textContent = formatNumber(video.likes);
            }

            // Toggle follow for merchant
            function toggleFollow(merchantId) {
                const video = videos.find(v => v.merchant.id === merchantId);
                if (!video) return;
                
                video.merchant.isFollowing = !video.merchant.isFollowing;
                video.merchant.followers += video.merchant.isFollowing ? 1 : -1;
                
                // Update UI
                const followBtn = document.querySelector(`.follow-btn[data-id="${merchantId}"]`);
                followBtn.classList.toggle('following');
                followBtn.textContent = video.merchant.isFollowing ? 'Following' : 'Follow';
            }

            // Show comments panel
            function showComments() {
                loadComments();
                commentsPanel.classList.add('show');
                pauseCurrentVideo();
            }

            // Hide comments panel
            function hideComments() {
                commentsPanel.classList.remove('show');
                if (isPlaying) {
                    playCurrentVideo();
                }
            }

            // Show share modal
            function showShareModal() {
                const video = videos[currentVideoIndex];
                const shareLink = `https://antriumkm.id/video/${video.id}`;
                document.getElementById('shareLinkText').textContent = shareLink;
                shareModal.classList.add('show');
            }

            // Hide share modal
            function hideShareModal() {
                shareModal.classList.remove('show');
            }

            // Copy share link
            function copyShareLink() {
                const link = document.getElementById('shareLinkText').textContent;
                navigator.clipboard.writeText(link).then(() => {
                    alert('Link berhasil disalin!');
                });
            }

            // Handle share option
            function handleShareOption(platform) {
                const video = videos[currentVideoIndex];
                const shareUrl = `https://antriumkm.id/video/${video.id}`;
                const shareText = `Lihat video ${video.title} dari ${video.merchant.name} di AntriUMKM!`;
                
                let shareLink = '';
                
                switch (platform) {
                    case 'whatsapp':
                        shareLink = `https://wa.me/?text=${encodeURIComponent(shareText + ' ' + shareUrl)}`;
                        break;
                    case 'facebook':
                        shareLink = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`;
                        break;
                    case 'twitter':
                        shareLink = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(shareUrl)}`;
                        break;
                    case 'instagram':
                        alert('Share ke Instagram: Buka aplikasi Instagram dan bagikan link ini');
                        break;
                    case 'link':
                        copyShareLink();
                        return;
                    case 'copy':
                        alert('Fitur salin video akan datang!');
                        return;
                    case 'save':
                        alert('Video berhasil disimpan (simulasi)');
                        return;
                }
                
                if (shareLink) {
                    window.open(shareLink, '_blank');
                }
            }

            // Event Listeners
            document.addEventListener('click', function(e) {
                // Like button
                if (e.target.closest('.like-btn')) {
                    const videoId = parseInt(e.target.closest('.like-btn').dataset.id);
                    toggleVideoLike(videoId);
                }
                
                // Comment button
                if (e.target.closest('.comment-btn')) {
                    showComments();
                }
                
                // Share button
                if (e.target.closest('.share-btn')) {
                    showShareModal();
                }
                
                // Follow button
                if (e.target.closest('.follow-btn')) {
                    const merchantId = e.target.closest('.follow-btn').dataset.id;
                    toggleFollow(merchantId);
                }
                
                // Save button
                if (e.target.closest('.save-btn')) {
                    const btn = e.target.closest('.save-btn');
                    btn.classList.toggle('active');
                    alert(btn.classList.contains('active') ? 'Video disimpan' : 'Video dihapus dari simpanan');
                }
                
                // Nav dots
                if (e.target.classList.contains('nav-dot')) {
                    const index = parseInt(e.target.dataset.index);
                    switchVideo(index);
                }
                
                // Like comment
                if (e.target.closest('.like-comment')) {
                    const btn = e.target.closest('.like-comment');
                    btn.classList.toggle('liked');
                }
            });

            // Close comments button
            document.getElementById('closeCommentsBtn').addEventListener('click', hideComments);

            // Comment submit
            document.getElementById('commentSubmitBtn').addEventListener('click', function() {
                const input = document.getElementById('commentInput');
                const text = input.value.trim();
                
                if (text) {
                    // Add new comment
                    const newComment = {
                        id: comments.length + 1,
                        user: {
                            name: "Anda",
                            avatar: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                        },
                        text: text,
                        time: "Baru saja",
                        likes: 0,
                        isLiked: false,
                        replies: 0
                    };
                    
                    comments.unshift(newComment);
                    loadComments();
                    input.value = '';
                    
                    // Update comment count
                    videos[currentVideoIndex].comments++;
                    const commentBtn = document.querySelector(`.comment-btn[data-id="${videos[currentVideoIndex].id}"]`);
                    const commentCount = commentBtn.querySelector('.action-count');
                    commentCount.textContent = formatNumber(videos[currentVideoIndex].comments);
                }
            });

            // Comment input enter key
            document.getElementById('commentInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    document.getElementById('commentSubmitBtn').click();
                }
            });

            // Share modal events
            document.getElementById('closeShareBtn').addEventListener('click', hideShareModal);
            document.getElementById('copyLinkBtn').addEventListener('click', copyShareLink);

            // Share options
            document.querySelectorAll('.share-option').forEach(option => {
                option.addEventListener('click', function() {
                    const platform = this.dataset.share;
                    handleShareOption(platform);
                });
            });

            // Search button
            searchBtn.addEventListener('click', function() {
                alert('Fitur pencarian video akan datang!');
            });

            // Swipe/Scroll navigation
            let touchStartY = 0;
            let touchEndY = 0;

            videoFeed.addEventListener('touchstart', function(e) {
                touchStartY = e.changedTouches[0].screenY;
            });

            videoFeed.addEventListener('touchend', function(e) {
                touchEndY = e.changedTouches[0].screenY;
                const diff = touchStartY - touchEndY;
                
                // Minimum swipe distance
                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        // Swipe up - next video
                        switchVideo(currentVideoIndex + 1);
                    } else {
                        // Swipe down - previous video
                        switchVideo(currentVideoIndex - 1);
                    }
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowUp') {
                    switchVideo(currentVideoIndex - 1);
                } else if (e.key === 'ArrowDown') {
                    switchVideo(currentVideoIndex + 1);
                } else if (e.key === ' ') {
                    // Space to play/pause
                    if (isPlaying) {
                        pauseCurrentVideo();
                        isPlaying = false;
                    } else {
                        playCurrentVideo();
                        isPlaying = true;
                    }
                }
            });

            // Initialize
            initVideos();
        });
    </script>
</body>
</html>