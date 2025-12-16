<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video & Shorts - Queuely</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Force body to be exactly viewport height and hidden overflow */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            overflow: hidden;
            /* Prevent body scroll */
            width: 100%;
        }

        /* Container acts as the scrollable viewport */
        .video-container {
            width: 100%;
            max-width: 480px;
            height: 100%;
            margin: 0 auto;

            /* Scroll Snap Properties */
            overflow-y: auto;
            scroll-snap-type: y mandatory;
            scroll-behavior: smooth;

            /* Hide Scrollbar */
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;
            /* IE/Edge */
        }

        .video-container::-webkit-scrollbar {
            display: none;
            /* Chrome/Safari */
        }

        /* Individual Video Item */
        .video-card {
            position: relative;
            width: 100%;
            height: 100%;
            /* Occupy full container height */
            background: #000;

            /* Snap Point */
            scroll-snap-align: start;
            scroll-snap-stop: always;
            /* Force stop at this element */

            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .video-card video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Video Info Overlay */
        .video-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            padding-bottom: 80px;
            /* Space for bottom nav */
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
            z-index: 2;
            pointer-events: none;
            /* Let clicks pass through to video */
        }

        .video-info * {
            pointer-events: auto;
            /* Re-enable for links */
        }

        .umkm-name {
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        .caption {
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.4;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Action Buttons */
        .action-bar {
            position: absolute;
            right: 15px;
            bottom: 100px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            z-index: 3;
        }

        .action-btn {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            backdrop-filter: blur(5px);
            transition: all 0.2s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: scale(1.1);
        }

        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            backdrop-filter: blur(5px);
        }

        /* Styling for Bottom Nav in Dark Mode */
        .bottom-nav {
            background-color: rgba(0, 0, 0, 0.9) !important;
            border-top: 1px solid #333 !important;
            backdrop-filter: blur(10px);
        }

        .nav-icon {
            color: #888 !important;
        }

        .nav-icon.active {
            color: #AB886D !important;
            background-color: rgba(171, 136, 109, 0.2) !important;
        }

        .nav-icon:hover {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
    </style>
</head>

<body>
    <a href="{{ url('/') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="video-container">
        @forelse($videos as $video)
            <div class="video-card">
                <video src="{{ asset('storage/' . $video->video_path) }}" loop playsinline
                    controlsList="nodownload"></video>

                <div class="video-info">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bg-light text-dark rounded-circle d-flex align-items-center justify-content-center me-2"
                            style="width: 40px; height: 40px; font-weight: bold; border: 2px solid white;">
                            {{ substr($video->umkm->nama_umkm ?? 'U', 0, 1) }}
                        </div>
                        <div class="umkm-name mb-0">{{ $video->umkm->nama_umkm ?? 'UMKM' }}</div>
                    </div>
                    <p class="caption">{{ $video->caption }}</p>
                    <small class="text-white-50"><i class="far fa-clock me-1"></i>
                        {{ $video->created_at->diffForHumans() }}</small>
                </div>

                <div class="action-bar">
                    <a href="#" class="action-btn">
                        <i class="fas fa-heart"></i>
                    </a>
                    <a href="{{ route('shop.show', $video->umkm->id) }}" class="action-btn" title="Kunjungi Toko">
                        <i class="fas fa-store"></i>
                    </a>
                    <button class="action-btn" onclick="shareVideo('{{ asset('storage/' . $video->video_path) }}')">
                        <i class="fas fa-share"></i>
                    </button>
                </div>
            </div>
        @empty
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center p-4">
                <div class="mb-4 opacity-50">
                    <i class="fas fa-video-slash fa-4x"></i>
                </div>
                <h3>Belum ada video</h3>
                <p class="text-white-50">Jadilah yang pertama mengupload video!</p>
                <a href="{{ url('/') }}" class="btn btn-outline-light rounded-pill px-4 mt-3">Kembali ke Beranda</a>
            </div>
        @endforelse
    </div>

    @include('components.bottom-nav')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.querySelector('.video-container');
            const videos = document.querySelectorAll('video');

            // Intersection Observer to handle Play/Pause
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.play().catch(e => console.log("Autoplay blocked", e));
                    } else {
                        entry.target.pause();
                        entry.target.currentTime = 0; // Reset video
                    }
                });
            }, {
                threshold: 0.7, // Only trigger when 70% visible
                root: container
            });

            videos.forEach(video => {
                // Click to toggle
                video.addEventListener('click', function () {
                    if (this.paused) this.play();
                    else this.pause();
                });
                observer.observe(video);
            });
        });

        function shareVideo(url) {
            if (navigator.share) {
                navigator.share({
                    title: 'Video UMKM Queuely',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link video berhasil disalin!');
                });
            }
        }
    </script>
</body>

</html>