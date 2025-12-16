@extends('backend.umkm.layout')

@section('title', 'Kelola Video')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-0">Video / Shorts</h2>
            <p class="text-muted mb-0">Upload video pendek untuk mempromosikan UMKM Anda</p>
        </div>
        <a href="{{ route('umkm.videos.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="fas fa-plus me-2"></i> Upload Video
        </a>
    </div>

    @if($videos->isEmpty())
        <div class="card border-0 shadow-sm text-center py-5">
            <div class="card-body">
                <div class="mb-3 opacity-25">
                    <i class="fas fa-video-slash fa-4x"></i>
                </div>
                <h5 class="text-muted">Belum ada video</h5>
                <p class="text-muted small">Mulai promosi dengan mengupload video pendek pertama Anda!</p>
                <a href="{{ route('umkm.videos.create') }}" class="btn btn-outline-primary rounded-pill mt-2">
                    <i class="fas fa-upload me-2"></i> Upload Sekarang
                </a>
            </div>
        </div>
    @else
        <div class="row g-4">
            @foreach($videos as $video)
                <div class="col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden">
                        <div class="position-relative" style="padding-top: 177.77%; background: #000;">
                            <!-- Aspect ratio 9:16 approx -->
                            <video src="{{ asset('storage/' . $video->video_path) }}"
                                class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover;" controls></video>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-truncate mb-2 fw-medium">{{ $video->caption ?? 'Tanpa caption' }}</p>
                            <div class="d-flex justify-content-between align-items-center small text-muted">
                                <span><i class="far fa-clock me-1"></i> {{ $video->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                            <form action="{{ route('umkm.videos.destroy', $video->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 rounded-pill">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection