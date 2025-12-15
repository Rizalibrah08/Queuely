@extends('backend.umkm.layout')

@section('title', 'Edit Menu')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold text-dark mb-0">Edit Menu</h2>
                <a href="{{ route('umkm.menu.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Informasi Menu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('umkm.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $menu->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" value="{{ old('price', $menu->price) }}" required min="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                    <option value="">Pilih Kategori (Optional)</option>
                                    <option value="Makanan" {{ old('category', $menu->category) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="Minuman" {{ old('category', $menu->category) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                    <option value="Snack" {{ old('category', $menu->category) == 'Snack' ? 'selected' : '' }}>
                                        Snack</option>
                                    <option value="Paket" {{ old('category', $menu->category) == 'Paket' ? 'selected' : '' }}>
                                        Paket</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" rows="3">{{ old('description', $menu->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Menu</label>
                            @if($menu->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Preview" class="img-thumbnail"
                                        style="max-height: 100px;">
                                    <small class="d-block text-muted">Gambar saat ini</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar. Format: JPG, PNG. Maks:
                                2MB.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_available" name="is_available"
                                    value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_available">Status Tersedia</label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: var(--color-brown); border-color: var(--color-brown); padding: 12px;">
                                <i class="fas fa-save me-2"></i> Perbarui Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection