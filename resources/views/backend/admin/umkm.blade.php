<!-- resources/views/backend/admin/umkm.blade.php -->
@extends('backend.admin.layout')

@section('title', 'Kelola UMKM')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Kelola UMKM</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">UMKM</li>
                </ol>
            </nav>
        </div>
        
        <div class="d-flex gap-2">
            <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari UMKM...">
            </div>
            
            <a href="{{ route('admin.umkm.create') }}" class="btn btn-admin">
                <i class="fas fa-plus me-1"></i> Tambah UMKM
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-6 mb-3">
            <div class="card stats-card blue h-100">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stats-number">{{ $totalUmkm }}</div>
                    <div class="stats-label">Total UMKM</div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-3">
            <div class="card stats-card green h-100">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stats-number">{{ $activeUmkm }}</div>
                    <div class="stats-label">Aktif</div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-3">
            <div class="card stats-card orange h-100">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-number">{{ $pendingUmkm }}</div>
                    <div class="stats-label">Pending</div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-3">
            <div class="card stats-card purple h-100">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stats-number">{{ $inactiveUmkm }}</div>
                    <div class="stats-label">Nonaktif</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter Buttons -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-outline-secondary active filter-btn" data-filter="all">
            Semua ({{ $totalUmkm }})
        </button>
        <button class="btn btn-outline-success filter-btn" data-filter="approved">
            Aktif ({{ $activeUmkm }})
        </button>
        <button class="btn btn-outline-warning filter-btn" data-filter="pending">
            Pending ({{ $pendingUmkm }})
        </button>
        <button class="btn btn-outline-danger filter-btn" data-filter="inactive">
            Nonaktif ({{ $inactiveUmkm }})
        </button>
    </div>
    
    <!-- UMKM Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-list me-2"></i> Daftar UMKM
            </div>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-download me-1"></i> Export
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="exportData('excel')">Excel</a></li>
                        <li><a class="dropdown-item" href="#" onclick="exportData('pdf')">PDF</a></li>
                        <li><a class="dropdown-item" href="#" onclick="exportData('csv')">CSV</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if($umkmList->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="umkmTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama UMKM</th>
                            <th>Pemilik</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($umkmList as $umkm)
                        <tr class="umkm-row" data-status="{{ $umkm->status }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($umkm->logo)
                                    <img src="{{ asset('storage/' . $umkm->logo) }}" 
                                         alt="{{ $umkm->nama_umkm }}" 
                                         class="rounded-circle me-3" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-store text-secondary"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <strong>{{ $umkm->nama_umkm }}</strong><br>
                                        <small class="text-muted">ID: {{ $umkm->kode_umkm ?? 'UMKM-' . str_pad($umkm->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $umkm->user->name ?? 'N/A' }}<br>
                                <small class="text-muted">{{ $umkm->user->email ?? '' }}</small>
                            </td>
                            <td>
                                @if($umkm->kategori)
                                <span class="badge rounded-pill" style="background-color: var(--color-beige); color: var(--color-dark);">
                                    {{ $umkm->kategori }}
                                </span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $umkm->kota ?? 'N/A' }}</div>
                                <small class="text-muted">{{ Str::limit($umkm->alamat, 30) }}</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($umkm->status == 'approved')
                                        <span class="badge bg-success me-2">Aktif</span>
                                    @elseif($umkm->status == 'pending')
                                        <span class="badge bg-warning me-2">Menunggu</span>
                                    @elseif($umkm->status == 'rejected')
                                        <span class="badge bg-danger me-2">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary me-2">Nonaktif</span>
                                    @endif
                                    
                                    <!-- Status Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                type="button" 
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                style="padding: 2px 8px;">
                                            <i class="fas fa-caret-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if($umkm->status == 'pending')
                                            <li>
                                                <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-success">
                                                        <i class="fas fa-check-circle me-2"></i> Approve (Aktifkan)
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.umkm.reject', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-times-circle me-2"></i> Reject (Tolak)
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            @endif
                                            
                                            <li>
                                                <form action="{{ route('admin.umkm.updateStatus', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="dropdown-item {{ $umkm->status == 'approved' ? 'active' : '' }}">
                                                        <i class="fas fa-check-circle text-success me-2"></i> Set Aktif
                                                        @if($umkm->status == 'approved')
                                                            <i class="fas fa-check float-end mt-1"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.umkm.updateStatus', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="dropdown-item {{ $umkm->status == 'pending' ? 'active' : '' }}">
                                                        <i class="fas fa-clock text-warning me-2"></i> Set Pending
                                                        @if($umkm->status == 'pending')
                                                            <i class="fas fa-check float-end mt-1"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.umkm.updateStatus', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="inactive">
                                                    <button type="submit" class="dropdown-item {{ $umkm->status == 'inactive' ? 'active' : '' }}">
                                                        <i class="fas fa-times-circle text-danger me-2"></i> Set Nonaktif
                                                        @if($umkm->status == 'inactive')
                                                            <i class="fas fa-check float-end mt-1"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.umkm.updateStatus', $umkm->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="dropdown-item {{ $umkm->status == 'rejected' ? 'active' : '' }}">
                                                        <i class="fas fa-ban text-danger me-2"></i> Set Ditolak
                                                        @if($umkm->status == 'rejected')
                                                            <i class="fas fa-check float-end mt-1"></i>
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $umkm->created_at->format('d/m/Y') }}<br>
                                <small class="text-muted">{{ $umkm->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.umkm.detail', $umkm->id) }}">
                                                <i class="fas fa-eye text-primary me-2"></i> Lihat Detail
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('umkm.edit', $umkm->id) }}">
                                                <i class="fas fa-edit text-success me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" 
                                               href="#" 
                                               onclick="confirmDelete({{ $umkm->id }}, '{{ $umkm->nama_umkm }}')">
                                                <i class="fas fa-trash me-2"></i> Hapus
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Menampilkan {{ $umkmList->firstItem() ?? 0 }} - {{ $umkmList->lastItem() ?? 0 }} dari {{ $umkmList->total() }} UMKM
                </div>
                <div>
                    {{ $umkmList->links() }}
                </div>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-store fa-4x text-muted mb-3"></i>
                <h4>Belum ada UMKM</h4>
                <p class="text-muted mb-4">Belum ada UMKM yang terdaftar di sistem</p>
                <a href="{{ route('admin.umkm.create') }}" class="btn btn-admin">
                    <i class="fas fa-plus me-2"></i> Tambah UMKM Pertama
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                </div>
                <p class="text-center">Apakah Anda yakin ingin menghapus UMKM <strong id="deleteUmkmName"></strong>?</p>
                <div class="alert alert-warning mt-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Perhatian:</strong> Tindakan ini akan menghapus semua data terkait termasuk menu dan pesanan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#umkmTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Filter by status
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-admin');
                btn.classList.add('btn-outline-secondary');
                btn.classList.remove('btn-outline-success', 'btn-outline-warning', 'btn-outline-danger');
            });
            
            // Add active class to clicked button
            this.classList.remove('btn-outline-secondary');
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            
            // Change button color based on filter
            if (filter === 'approved') {
                this.classList.add('btn-outline-success');
            } else if (filter === 'pending') {
                this.classList.add('btn-outline-warning');
            } else if (filter === 'inactive') {
                this.classList.add('btn-outline-danger');
            } else {
                this.classList.add('btn-admin');
            }
            
            // Filter rows
            const rows = document.querySelectorAll('.umkm-row');
            rows.forEach(row => {
                if (filter === 'all' || row.dataset.status === filter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    
    // Delete Confirmation
    function confirmDelete(id, name) {
        document.getElementById('deleteUmkmName').textContent = name;
        document.getElementById('deleteForm').action = `/admin/umkm/${id}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
    
    // Export Data
    function exportData(format) {
        let url = '/admin/umkm/export';
        let params = [];
        
        // Get current filter
        const activeFilter = document.querySelector('.filter-btn.active');
        if (activeFilter && activeFilter.dataset.filter !== 'all') {
            params.push(`status=${activeFilter.dataset.filter}`);
        }
        
        // Get search term
        const searchTerm = document.getElementById('searchInput').value;
        if (searchTerm) {
            params.push(`search=${encodeURIComponent(searchTerm)}`);
        }
        
        if (params.length > 0) {
            url += `?${params.join('&')}`;
        }
        
        url += `&format=${format}`;
        
        window.open(url, '_blank');
    }
    
    // Toast notification function
    function showToast(type, message) {
        // Create toast container if not exists
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.style.position = 'fixed';
            toastContainer.style.top = '20px';
            toastContainer.style.right = '20px';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }
        
        // Create toast
        const toastId = 'toast-' + Date.now();
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `alert alert-${type} alert-dismissible fade show`;
        toast.style.minWidth = '300px';
        toast.style.marginBottom = '10px';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                <div class="flex-grow-1">${message}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            const toastElement = document.getElementById(toastId);
            if (toastElement) {
                toastElement.remove();
            }
        }, 5000);
    }
    
    // Form submission feedback
    document.addEventListener('DOMContentLoaded', function() {
        // Handle form submission feedback
        const forms = document.querySelectorAll('form[action*="updateStatus"], form[action*="approve"], form[action*="reject"]');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                // Show loading
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Loading...';
                submitButton.disabled = true;
                
                // Auto re-enable after 5 seconds (in case of error)
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 5000);
            });
        });
        
        // Auto-refresh page after status change (optional)
        const statusChangeForms = document.querySelectorAll('form[action*="updateStatus"]');
        statusChangeForms.forEach(form => {
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            });
        });
    });
</script>

<style>
    /* Custom styles for dropdown in table */
    .table td .dropdown-toggle {
        padding: 2px 8px;
        font-size: 0.8rem;
    }
    
    .table td .badge {
        font-size: 0.75rem;
        padding: 4px 8px;
    }
    
    /* Ensure dropdown doesn't overflow */
    .table-responsive {
        position: relative;
    }
    
    .dropdown-menu {
        z-index: 1060;
    }
    
    /* Style for active dropdown item */
    .dropdown-item.active {
        background-color: rgba(0, 0, 0, 0.05);
        font-weight: 600;
    }
</style>
@endsection