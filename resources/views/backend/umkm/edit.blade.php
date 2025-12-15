@extends('backend.umkm.layout')

@section('title', 'Pengaturan UMKM')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark mb-0">Pengaturan UMKM</h2>
            <p class="text-muted mb-0">Kelola informasi profil dan detail bisnis Anda</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form action="{{ route('umkm.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Use POST for update as defined in routes, though typically PUT is used, the form method is POST with @method('POST') implicit or explicit -->
                <!-- Checking routes: Route::post('/update', ...) so it is POST -->

                <div class="row">
                    <!-- Kolom Kiri: Informasi Utama -->
                    <div class="col-md-8">
                        <h5 class="fw-bold text-dark mb-4"><i class="fas fa-store me-2 text-primary"></i>Informasi Bisnis
                        </h5>

                        <div class="mb-3">
                            <label for="nama_umkm" class="form-label">Nama Bisnis</label>
                            <input type="text" class="form-control" id="nama_umkm" name="nama_umkm"
                                value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" id="kategori" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach(['Coffee Shop', 'Restoran', 'Warung Makan', 'Kafe', 'Bakery', 'Minuman', 'Makanan Cepat Saji', 'Catering', 'Street Food', 'Dessert Shop'] as $cat)
                                        <option value="{{ $cat }}" {{ old('kategori', $umkm->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon" name="telepon"
                                    value="{{ old('telepon', $umkm->telepon) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
                                required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2"
                                required>{{ old('alamat', $umkm->alamat) }}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota"
                                    value="{{ old('kota', $umkm->kota) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi"
                                    value="{{ old('provinsi', $umkm->provinsi) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="kodepos" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" id="kodepos" name="kodepos"
                                    value="{{ old('kodepos', $umkm->kodepos) }}" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Bisnis</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $umkm->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website (Opsional)</label>
                                <input type="url" class="form-control" id="website" name="website"
                                    value="{{ old('website', $umkm->website) }}">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="fw-bold text-dark mb-4"><i class="fas fa-user-tie me-2 text-primary"></i>Informasi
                            Pemilik</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik"
                                    value="{{ old('nama_pemilik', $umkm->nama_pemilik) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="nik_pemilik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik_pemilik" name="nik_pemilik"
                                    value="{{ old('nik_pemilik', $umkm->nik_pemilik) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Media/Gambar -->
                    <div class="col-md-4">
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body text-center">
                                <h6 class="fw-bold mb-3">Logo UMKM</h6>
                                <div class="mb-3 position-relative d-inline-block">
                                    @if($umkm->logo)
                                        <img src="{{ asset('storage/' . $umkm->logo) }}" id="logoPreview"
                                            class="rounded-circle shadow-sm"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center shadow-sm mx-auto"
                                            style="width: 150px; height: 150px;">
                                            <i class="fas fa-store fa-3x text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-grid">
                                    <label for="logo" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-upload me-1"></i> Ganti Logo
                                    </label>
                                    <input type="file" id="logo" name="logo" class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'logoPreview')">
                                    <small class="text-muted mt-2">Format: JPG, PNG (Max 2MB)</small>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body text-center">
                                <h6 class="fw-bold mb-3">Foto Sampul / Cover</h6>
                                <div class="mb-3 position-relative">
                                    @if($umkm->cover)
                                        <img src="{{ asset('storage/' . $umkm->cover) }}" id="coverPreview"
                                            class="rounded shadow-sm w-100" style="height: 120px; object-fit: cover;">
                                    @else
                                        <div class="rounded bg-white d-flex align-items-center justify-content-center shadow-sm w-100"
                                            style="height: 120px;">
                                            <i class="fas fa-image fa-2x text-secondary"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="d-grid">
                                    <label for="cover" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-upload me-1"></i> Ganti Cover
                                    </label>
                                    <input type="file" id="cover" name="cover" class="d-none" accept="image/*"
                                        onchange="previewImage(this, 'coverPreview')">
                                    <small class="text-muted mt-2">Format: JPG, PNG (Max 2MB)</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-primary fw-bold py-2">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('umkm.dashboard') }}" class="btn btn-outline-secondary py-2">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var preview = document.getElementById(previewId);
                    // If the preview is a div (placeholder), replace it with an img
                    if (preview.tagName !== 'IMG') {
                        // logic to handle div replacement if needed, 
                        // but simplified here: assume img tag always exists or handled by blade logic mostly
                        // actually my blade logic puts img OR div. 
                        // Javascript needs to handle "if div, hide div create img" or simplify blade to always output img with placeholder src
                    }

                    // Simpler: Just rely on ID. If ID is on IMG tag:
                    if (preview) {
                        preview.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection