@extends('backend.umkm.layout')

@section('title', 'Tambah Menu Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Tambah Menu</h2>
                <a href="{{ route('umkm.menu.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Menu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('umkm.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required placeholder="Contoh: Nasi Goreng Spesial">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" value="{{ old('price') }}" required min="0" placeholder="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                    <option value="" selected>Pilih Kategori (Optional)</option>
                                    <option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan
                                    </option>
                                    <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>Minuman
                                    </option>
                                    <option value="Snack" {{ old('category') == 'Snack' ? 'selected' : '' }}>Snack</option>
                                    <option value="Paket" {{ old('category') == 'Paket' ? 'selected' : '' }}>Paket</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="3"
                                placeholder="Jelaskan detail menu ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Menu</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG. Maks: 2MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_available" name="is_available"
                                    value="1" checked>
                                <label class="form-check-label" for="is_available">Status Tersedia</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: var(--color-brown); border-color: var(--color-brown); padding: 12px;">
                                <i class="fas fa-save me-2"></i> Simpan Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection