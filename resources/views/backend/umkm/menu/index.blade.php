@extends('backend.umkm.layout')

@section('title', 'Manajemen Menu')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark">Daftar Menu</h2>
            <p class="text-muted">Kelola menu dan produk UMKM Anda</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('umkm.menu.create') }}" class="btn btn-primary"
                style="background-color: var(--color-brown); border-color: var(--color-brown);">
                <i class="fas fa-plus me-2"></i> Tambah Menu Baru
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($menus->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="80">Gambar</th>
                                <th>Nama Menu</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th class="text-center">Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>
                                        @if($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="rounded"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="fas fa-utensils text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <h6 class="mb-0 fw-bold">{{ $menu->name }}</h6>
                                        <small class="text-muted text-truncate d-inline-block"
                                            style="max-width: 200px;">{{ $menu->description }}</small>
                                    </td>
                                    <td>
                                        @if($menu->category)
                                            <span class="badge bg-light text-dark border">{{ $menu->category }}</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if($menu->is_available)
                                            <span class="badge bg-success">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('umkm.menu.edit', $menu->id) }}"
                                            class="btn btn-sm btn-outline-secondary me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('umkm.menu.destroy', $menu->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-utensils fa-4x text-muted opacity-25"></i>
                    </div>
                    <h5 class="text-muted">Belum ada menu</h5>
                    <p class="text-muted mb-4">Mulai tambahkan menu untuk UMKM Anda</p>
                    <a href="{{ route('umkm.menu.create') }}" class="btn btn-primary"
                        style="background-color: var(--color-brown); border-color: var(--color-brown);">
                        <i class="fas fa-plus me-2"></i> Tambah Menu Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection