@extends('backend.admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="stats-card blue">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-number">{{ $stats['total_users'] }}</div>
                <div class="stats-label">Total Users</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stats-card green">
                <div class="stats-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-number">{{ $stats['total_umkm'] }}</div>
                <div class="stats-label">Total UMKM</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stats-card orange">
                <div class="stats-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-number">{{ $stats['pending_umkm'] }}</div>
                <div class="stats-label">Pending UMKM</div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="stats-card purple">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-number">{{ $stats['active_umkm'] }}</div>
                <div class="stats-label">Active UMKM</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-clock me-2"></i> UMKM Pending Review ({{ $pendingUmkm->count() }})
                    <a href="{{ route('admin.umkm.index') }}" class="float-end btn btn-sm btn-admin">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if($pendingUmkm->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama UMKM</th>
                                        <th>Pemilik</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUmkm as $umkm)
                                        <tr>
                                            <td>
                                                <strong>{{ $umkm->nama_umkm }}</strong><br>
                                                <small class="text-muted">{{ $umkm->kategori }}</small>
                                            </td>
                                            <td>
                                                {{ $umkm->user->name ?? 'N/A' }}<br>
                                                <small class="text-muted">{{ $umkm->user->email ?? '' }}</small>
                                            </td>
                                            <td>{{ $umkm->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <form action="{{ route('admin.umkm.approve', $umkm->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-admin">
                                                            <i class="fas fa-check"></i> Approve
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.umkm.detail', $umkm->id) }}"
                                                        class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <p class="mb-0">Tidak ada UMKM pending</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users me-2"></i> User Terbaru
                    <a href="{{ route('admin.users.index') }}" class="float-end btn btn-sm btn-admin">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @if($recentUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'admin')
                                                    <span class="badge bg-danger">Admin</span>
                                                @elseif($user->role === 'umkm')
                                                    <span class="badge badge-approved">UMKM</span>
                                                @else
                                                    <span class="badge bg-secondary">Customer</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-slash fa-2x text-muted mb-3"></i>
                            <p class="mb-0">Belum ada user</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-chart-line me-2"></i> Quick Actions
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.umkm.index') }}" class="btn btn-admin w-100 py-3">
                        <i class="fas fa-store fa-2x mb-2"></i><br>
                        Kelola UMKM
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-admin w-100 py-3">
                        <i class="fas fa-users fa-2x mb-2"></i><br>
                        Kelola Users
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-admin w-100 py-3">
                        <i class="fas fa-user-plus fa-2x mb-2"></i><br>
                        Tambah Admin
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-admin w-100 py-3">
                        <i class="fas fa-cog fa-2x mb-2"></i><br>
                        Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection