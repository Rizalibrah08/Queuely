<!-- resources/views/backend/admin/umkm/edit.blade.php -->
@extends('backend.admin.layout')

@section('title', 'Edit UMKM - ' . $umkm->nama_umkm)

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-edit me-2"></i> Edit UMKM: {{ $umkm->nama_umkm }}
                        </div>
                        <a href="{{ route('admin.umkm.detail', $umkm->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" id="editUmkmForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- Informasi Dasar -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-info-circle me-2"></i> Informasi Dasar
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_umkm" class="form-label">Nama UMKM <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_umkm') is-invalid @enderror" 
                                           id="nama_umkm" name="nama_umkm" 
                                           value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required>
                                    @error('nama_umkm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" 
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Makanan & Minuman" {{ old('kategori', $umkm->kategori) == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                        <option value="Fashion" {{ old('kategori', $umkm->kategori) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                        <option value="Kerajinan" {{ old('kategori', $umkm->kategori) == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                        <option value="Jasa" {{ old('kategori', $umkm->kategori) == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                        <option value="Retail" {{ old('kategori', $umkm->kategori) == 'Retail' ? 'selected' : '' }}>Retail</option>
                                        <option value="Pertanian" {{ old('kategori', $umkm->kategori) == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                        <option value="Lainnya" {{ old('kategori', $umkm->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi UMKM</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                          id="deskripsi" name="deskripsi" 
                                          rows="3">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="text-end">
                                    <small class="text-muted"><span id="charCount">0</span>/500 karakter</small>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jam_buka" class="form-label">Jam Buka <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_buka') is-invalid @enderror" 
                                           id="jam_buka" name="jam_buka" 
                                           value="{{ old('jam_buka', $umkm->jam_buka ?? '08:00') }}" required>
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="jam_tutup" class="form-label">Jam Tutup <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_tutup') is-invalid @enderror" 
                                           id="jam_tutup" name="jam_tutup" 
                                           value="{{ old('jam_tutup', $umkm->jam_tutup ?? '21:00') }}" required>
                                    @error('jam_tutup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informasi Pemilik -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-user me-2"></i> Informasi Pemilik
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pemilik_id" class="form-label">Pemilik <span class="text-danger">*</span></label>
                                    <select class="form-select @error('pemilik_id') is-invalid @enderror" 
                                            id="pemilik_id" name="pemilik_id" required>
                                        <option value="">Pilih Pemilik</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('pemilik_id', $umkm->pemilik_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pemilik_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                           id="telepon" name="telepon" 
                                           value="{{ old('telepon', $umkm->telepon) }}" required>
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email', $umkm->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Lokasi -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-map-marker-alt me-2"></i> Lokasi
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                              id="alamat" name="alamat" 
                                              rows="2" required>{{ old('alamat', $umkm->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kota" class="form-label">Kota/Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kota') is-invalid @enderror" 
                                           id="kota" name="kota" 
                                           value="{{ old('kota', $umkm->kota) }}" required>
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror" 
                                           id="provinsi" name="provinsi" 
                                           value="{{ old('provinsi', $umkm->provinsi) }}" required>
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control @error('latitude') is-invalid @enderror" 
                                           id="latitude" name="latitude" 
                                           value="{{ old('latitude', $umkm->latitude) }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" name="longitude" 
                                           value="{{ old('longitude', $umkm->longitude) }}">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Media & Logo -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-image me-2"></i> Media & Logo
                            </h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Logo Saat Ini</label>
                                <div>
                                    @if($umkm->logo)
                                        <img src="{{ asset('storage/' . $umkm->logo) }}" 
                                             alt="{{ $umkm->nama_umkm }}" 
                                             class="img-thumbnail mb-2" 
                                             style="max-width: 150px; max-height: 150px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="hapus_logo" name="hapus_logo">
                                            <label class="form-check-label" for="hapus_logo">
                                                Hapus logo saat ini
                                            </label>
                                        </div>
                                    @else
                                        <div class="text-muted mb-2">Belum ada logo</div>
                                    @endif
                                </div>
                                
                                <label for="logo" class="form-label mt-3">Ubah Logo</label>
                                <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                       id="logo" name="logo" accept="image/*">
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Ukuran maksimal 2MB, format: JPG, PNG, GIF</small>
                                <div class="mt-2" id="logoPreview"></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                           id="website" name="website" 
                                           value="{{ old('website', $umkm->website) }}">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                           id="instagram" name="instagram" 
                                           value="{{ old('instagram', $umkm->instagram) }}">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-cog me-2"></i> Pengaturan
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status', $umkm->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="pending" {{ old('status', $umkm->status) == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        <option value="inactive" {{ old('status', $umkm->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="kode_umkm" class="form-label">Kode UMKM</label>
                                    <input type="text" class="form-control @error('kode_umkm') is-invalid @enderror" 
                                           id="kode_umkm" name="kode_umkm" 
                                           value="{{ old('kode_umkm', $umkm->kode_umkm) }}">
                                    @error('kode_umkm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-file-alt me-2"></i> Dokumen
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nib" class="form-label">NIB</label>
                                    <input type="text" class="form-control @error('nib') is-invalid @enderror" 
                                           id="nib" name="nib" 
                                           value="{{ old('nib', $umkm->nib) }}">
                                    @error('nib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="siup" class="form-label">SIUP</label>
                                    <input type="text" class="form-control @error('siup') is-invalid @enderror" 
                                           id="siup" name="siup" 
                                           value="{{ old('siup', $umkm->siup) }}">
                                    @error('siup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="npwp" class="form-label">NPWP</label>
                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" 
                                           id="npwp" name="npwp" 
                                           value="{{ old('npwp', $umkm->npwp) }}">
                                    @error('npwp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            @if($umkm->dokumen && count(json_decode($umkm->dokumen)) > 0)
                            <div class="mb-3">
                                <label class="form-label">Dokumen Saat Ini</label>
                                <div class="row">
                                    @foreach(json_decode($umkm->dokumen) as $index => $doc)
                                    <div class="col-md-4 mb-2">
                                        <div class="card border">
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <i class="fas fa-file-pdf text-danger me-1"></i>
                                                        <small>{{ $doc->nama }}</small>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="hapus_dokumen[]" value="{{ $index }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <small class="text-muted">Centang untuk menghapus dokumen</small>
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Tambah Dokumen Baru</label>
                                <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                                       id="dokumen" name="dokumen[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                                @error('dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">PDF, JPG, PNG (maksimal 5 file tambahan, 5MB per file)</small>
                            </div>
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.umkm.detail', $umkm->id) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-admin">
                                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for description
    const descTextarea = document.getElementById('deskripsi');
    const charCount = document.getElementById('charCount');
    
    descTextarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
    
    // Initialize character count
    charCount.textContent = descTextarea.value.length;
    
    // Logo preview
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('logoPreview');
                preview.innerHTML = `
                    <div class="border rounded p-2 d-inline-block">
                        <img src="${e.target.result}" alt="Preview" style="max-width: 150px; max-height: 150px;">
                        <div class="mt-1 small text-muted">${file.name}</div>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Form validation
    document.getElementById('editUmkmForm').addEventListener('submit', function(e) {
        const jamBuka = document.getElementById('jam_buka').value;
        const jamTutup = document.getElementById('jam_tutup').value;
        
        if (jamBuka && jamTutup && jamBuka >= jamTutup) {
            e.preventDefault();
            alert('Jam buka harus lebih awal dari jam tutup!');
            return false;
        }
        
        return true;
    });
    
    // Warn before leaving if changes were made
    let formChanged = false;
    const form = document.getElementById('editUmkmForm');
    const initialFormData = new FormData(form);
    
    form.addEventListener('change', function() {
        formChanged = true;
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'Perubahan yang belum disimpan akan hilang. Yakin ingin meninggalkan halaman?';
        }
    });
</script>
@endsection