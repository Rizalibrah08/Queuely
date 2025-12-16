@extends('backend.umkm.layout')

@section('title', 'Upload Video')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Upload Video Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('umkm.videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="video" class="form-label fw-bold">File Video</label>
                            <input type="file" class="form-control @error('video') is-invalid @enderror" id="video"
                                name="video" accept="video/mp4,video/mov,video/avi">
                            <div class="form-text text-muted">
                                Format: MP4, MOV, AVI. Maksimal 50MB. Disarankan rasio 9:16 (Vertikal).
                            </div>
                            @error('video')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="caption" class="form-label fw-bold">Caption</label>
                            <textarea class="form-control @error('caption') is-invalid @enderror" id="caption"
                                name="caption" rows="3" placeholder="Tulis deskripsi menarik..."></textarea>
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('umkm.videos.index') }}" class="btn btn-light rounded-pill px-4">Batal</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 flex-grow-1">
                                <i class="fas fa-upload me-2"></i> Upload Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection