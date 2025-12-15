<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UMKM;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('backend.admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            } else {
                Auth::logout();
                return back()->with('error', 'Anda bukan admin.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_umkm' => UMKM::count(),
            'pending_umkm' => UMKM::where('status', 'pending')->count(),
            'active_umkm' => UMKM::where('status', 'approved')->count(),
            'inactive_umkm' => UMKM::where('status', 'rejected')->count(),
        ];

        $recentUsers = User::latest()->take(10)->get();
        $pendingUmkm = UMKM::where('status', 'pending')->latest()->take(10)->get();

        return view('backend.admin.dashboard', compact('stats', 'recentUsers', 'pendingUmkm'));
    }

    // ==================== UMKM MANAGEMENT ====================

    public function umkm()
    {
        $status = request('status');
        $search = request('search');

        $query = UMKM::with('user');

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_umkm', 'like', "%{$search}%")
                    ->orWhere('kota', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $umkmList = $query->latest()->paginate(20);

        $totalUmkm = UMKM::count();
        $activeUmkm = UMKM::where('status', 'approved')->count();
        $pendingUmkm = UMKM::where('status', 'pending')->count();
        $inactiveUmkm = UMKM::where('status', 'rejected')->count();

        return view('backend.admin.umkm', compact(
            'umkmList',
            'totalUmkm',
            'activeUmkm',
            'pendingUmkm',
            'inactiveUmkm'
        ));
    }

    public function umkmDetail($id)
    {
        $umkm = UMKM::with('user')->findOrFail($id);
        return view('backend.admin.umkm.detail', compact('umkm'));
    }

    // APPROVE UMKM (ubah dari pending ke active)
    public function approveUmkm($id)
    {
        $umkm = UMKM::findOrFail($id);
        $umkm->status = 'approved';
        $umkm->approved_at = now();
        $umkm->save();

        // Update user role
        $user = $umkm->user;
        $user->role = 'umkm';
        $user->save();

        return back()->with('success', 'UMKM berhasil disetujui dan status diubah menjadi aktif.');
    }

    // REJECT UMKM
    public function rejectUmkm(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10',
        ]);

        $umkm = UMKM::findOrFail($id);
        $umkm->status = 'rejected';
        $umkm->alasan_penolakan = $request->alasan_penolakan;
        $umkm->save();

        return back()->with('success', 'UMKM berhasil ditolak.');
    }

    // UPDATE STATUS (untuk ganti status: active/pending/inactive)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,pending,rejected'
        ]);

        $umkm = UMKM::findOrFail($id);

        // Jika diubah jadi active, update approved_at dan role user
        if ($request->status == 'approved') {
            $umkm->approved_at = now();

            // Update role user jadi 'umkm'
            if ($umkm->user) {
                $umkm->user->role = 'umkm';
                $umkm->user->save();
            }
        }

        $umkm->status = $request->status;
        $umkm->save();

        return back()->with('success', 'Status UMKM berhasil diubah menjadi ' . $request->status . '!');
    }

    // ==================== USER MANAGEMENT ====================

    public function users()
    {
        $users = User::with('umkm')->latest()->paginate(20);
        return view('backend.admin.users.index', compact('users'));
    }

    public function createAdmin()
    {
        return view('backend.admin.users.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users')->with('success', 'Admin berhasil ditambahkan.');
    }

    // ==================== SETTINGS ====================

    public function settings()
    {
        return view('backend.admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password saat ini salah.');
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // ==================== DETAIL UMKM ====================

    public function detail($id)
    {
        $umkm = UMKM::with(['user', 'menus', 'orders.customer'])->findOrFail($id);

        $stats = [
            'total_orders' => $umkm->orders()->count(),
            'total_revenue' => $umkm->orders()->where('status', 'selesai')->sum('total_harga'),
            'menu_count' => $umkm->menus()->count(),
            'avg_rating' => $umkm->orders()->whereNotNull('rating')->avg('rating') ?? 0,
        ];

        $menus = $umkm->menus()->latest()->paginate(10);
        $recentOrders = $umkm->orders()->with('customer')->latest()->take(10)->get();

        return view('backend.admin.umkm.detail', compact(
            'umkm',
            'stats',
            'menus',
            'recentOrders'
        ));
    }

    public function show($id)
    {
        $umkm = UMKM::with(['user', 'menus', 'orders.customer'])->findOrFail($id);

        $stats = [
            'total_orders' => $umkm->orders()->count(),
            'total_revenue' => $umkm->orders()->where('status', 'completed')->sum('total_amount'),
            'menu_count' => $umkm->menus()->count(),
            'avg_rating' => $umkm->orders()->whereNotNull('rating')->avg('rating') ?? 0,
        ];

        $menus = $umkm->menus()->latest()->paginate(6);
        $recentOrders = $umkm->orders()->with('customer')->latest()->take(10)->get();

        return view('backend.admin.umkm.detail', compact(
            'umkm',
            'stats',
            'menus',
            'recentOrders'
        ));
    }

    // ==================== BULK ACTIONS ====================

    public function bulkStatusUpdate(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:umkm,id',
            'status' => 'required|in:approved,pending,rejected'
        ]);

        $count = UMKM::whereIn('id', $validated['ids'])
            ->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'count' => $count,
            'message' => 'Berhasil mengubah status ' . $count . ' UMKM'
        ]);
    }

    public function destroy($id)
    {
        $umkm = UMKM::findOrFail($id);

        if ($umkm->logo) {
            Storage::disk('public')->delete($umkm->logo);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm')
            ->with('success', 'UMKM berhasil dihapus!');
    }
}