<!-- resources/views/backend/admin/umkm/create.blade.php -->
@extends('backend.admin.layout')

@section('title', 'Tambah UMKM Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-plus-circle me-2"></i> Tambah UMKM Baru
                        </div>
                        <a href="{{ route('admin.umkm') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" id="createUmkmForm">
                        @csrf
                        
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
                                           value="{{ old('nama_umkm') }}" required>
                                    @error('nama_umkm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select @error('kategori') is-invalid @enderror" 
                                            id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Makanan & Minuman" {{ old('kategori') == 'Makanan & Minuman' ? 'selected' : '' }}>Makanan & Minuman</option>
                                        <option value="Fashion" {{ old('kategori') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                        <option value="Kerajinan" {{ old('kategori') == 'Kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                                        <option value="Jasa" {{ old('kategori') == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                        <option value="Retail" {{ old('kategori') == 'Retail' ? 'selected' : '' }}>Retail</option>
                                        <option value="Pertanian" {{ old('kategori') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                                        <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                          rows="3">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Jelaskan tentang UMKM Anda (maksimal 500 karakter)</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jam_buka" class="form-label">Jam Buka <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_buka') is-invalid @enderror" 
                                           id="jam_buka" name="jam_buka" 
                                           value="{{ old('jam_buka', '08:00') }}" required>
                                    @error('jam_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="jam_tutup" class="form-label">Jam Tutup <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control @error('jam_tutup') is-invalid @enderror" 
                                           id="jam_tutup" name="jam_tutup" 
                                           value="{{ old('jam_tutup', '21:00') }}" required>
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
                                    <label for="pemilik_id" class="form-label">Pilih Pemilik <span class="text-danger">*</span></label>
                                    <select class="form-select @error('pemilik_id') is-invalid @enderror" 
                                            id="pemilik_id" name="pemilik_id" required>
                                        <option value="">Pilih User sebagai Pemilik</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('pemilik_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} - {{ $user->email }} ({{ $user->role }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pemilik_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Atau <a href="#" onclick="showAddUserModal()">tambah user baru</a></small>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                           id="telepon" name="telepon" 
                                           value="{{ old('telepon') }}" required>
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" 
                                       value="{{ old('email') }}" required>
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
                                              rows="2" required>{{ old('alamat') }}</textarea>
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
                                           value="{{ old('kota') }}" required>
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="provinsi" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror" 
                                           id="provinsi" name="provinsi" 
                                           value="{{ old('provinsi') }}" required>
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
                                           value="{{ old('latitude') }}">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" name="longitude" 
                                           value="{{ old('longitude') }}">
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
                                <label for="logo" class="form-label">Logo UMKM</label>
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
                                           value="{{ old('website') }}">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="instagram" class="form-label">Instagram</label>
                                    <input type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                           id="instagram" name="instagram" 
                                           value="{{ old('instagram') }}">
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
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="kode_umkm" class="form-label">Kode UMKM</label>
                                    <input type="text" class="form-control @error('kode_umkm') is-invalid @enderror" 
                                           id="kode_umkm" name="kode_umkm" 
                                           value="{{ old('kode_umkm', 'UMKM-' . date('Ymd') . rand(100, 999)) }}">
                                    @error('kode_umkm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dokumen (Opsional) -->
                        <div class="mb-4">
                            <h5 class="mb-3" style="color: var(--color-brown);">
                                <i class="fas fa-file-alt me-2"></i> Dokumen (Opsional)
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="nib" class="form-label">NIB (Nomor Induk Berusaha)</label>
                                    <input type="text" class="form-control @error('nib') is-invalid @enderror" 
                                           id="nib" name="nib" 
                                           value="{{ old('nib') }}">
                                    @error('nib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="siup" class="form-label">SIUP</label>
                                    <input type="text" class="form-control @error('siup') is-invalid @enderror" 
                                           id="siup" name="siup" 
                                           value="{{ old('siup') }}">
                                    @error('siup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="npwp" class="form-label">NPWP</label>
                                    <input type="text" class="form-control @error('npwp') is-invalid @enderror" 
                                           id="npwp" name="npwp" 
                                           value="{{ old('npwp') }}">
                                    @error('npwp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Upload Dokumen Lainnya</label>
                                <input type="file" class="form-control @error('dokumen') is-invalid @enderror" 
                                       id="dokumen" name="dokumen[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                                @error('dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">PDF, JPG, PNG (maksimal 5 file, 5MB per file)</small>
                            </div>
                        </div>
                        
                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.umkm.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-admin">
                                <i class="fas fa-save me-1"></i> Simpan UMKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User Baru -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    @csrf
                    <div class="mb-3">
                        <label for="new_user_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="new_user_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_user_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="new_user_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_user_phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="new_user_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_user_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="new_user_password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-admin" onclick="addNewUser()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
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
    
    // Show add user modal
    function showAddUserModal() {
        const modal = new bootstrap.Modal(document.getElementById('addUserModal'));
        modal.show();
    }
    
    // Add new user via AJAX
    function addNewUser() {
        const name = document.getElementById('new_user_name').value;
        const email = document.getElementById('new_user_email').value;
        const phone = document.getElementById('new_user_phone').value;
        const password = document.getElementById('new_user_password').value;
        
        fetch('/admin/users/quick-create', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name, email, phone, password })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add new option to select
                const select = document.getElementById('pemilik_id');
                const option = new Option(`${data.user.name} - ${data.user.email} (${data.user.role})`, data.user.id);
                select.add(option);
                select.value = data.user.id;
                
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('addUserModal')).hide();
                
                // Reset form
                document.getElementById('addUserForm').reset();
                
                alert('User berhasil ditambahkan!');
            } else {
                alert('Gagal menambah user: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menambah user');
        });
    }
    
    // Auto-generate slug from name
    document.getElementById('nama_umkm').addEventListener('blur', function() {
        const name = this.value;
        if (name && !document.getElementById('kode_umkm').value.startsWith('UMKM-')) {
            const slug = 'UMKM-' + name.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '') 
                + '-' + Math.floor(Math.random() * 900 + 100);
            document.getElementById('kode_umkm').value = slug.substring(0, 50);
        }
    });
    
    // Form validation
    document.getElementById('createUmkmForm').addEventListener('submit', function(e) {
        const jamBuka = document.getElementById('jam_buka').value;
        const jamTutup = document.getElementById('jam_tutup').value;
        
        if (jamBuka && jamTutup && jamBuka >= jamTutup) {
            e.preventDefault();
            alert('Jam buka harus lebih awal dari jam tutup!');
            return false;
        }
        
        return true;
    });
</script>
@endsection