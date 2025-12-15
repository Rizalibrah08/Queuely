<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\UMKM;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UMKMController extends Controller
{
    public function create()
    {
        if (Auth::check() && Auth::user()->umkm) {
            $umkm = Auth::user()->umkm;

            if ($umkm->status === 'approved') {
                return redirect()->route('umkm.dashboard');
            }

            return view('backend.umkm.status', compact('umkm'));
        }

        return view('backend.umkm.create');
    }

    public function store(Request $request)
    {
        Log::info('UMKM Store Request:', $request->all());

        $validator = Validator::make($request->all(), [
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:20',
            'kategori' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kodepos' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
            'nama_pemilik' => 'required|string|max:255',
            'nik_pemilik' => 'required|string|max:20',
            'foto_ktp' => 'required|image|max:2048',
            'npwp' => 'nullable|string|max:30',
            'siup' => 'nullable|string|max:50',
            'tdp' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::user()->umkm) {
            return back()->with('error', 'Anda sudah memiliki UMKM terdaftar.')->withInput();
        }

        try {
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('umkm/logo', 'public');
            }

            $coverPath = null;
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('umkm/cover', 'public');
            }

            if ($request->hasFile('foto_ktp')) {
                $ktpPath = $request->file('foto_ktp')->store('umkm/ktp', 'public');
            } else {
                return back()->with('error', 'Foto KTP wajib diupload.')->withInput();
            }

            $umkmData = [
                'user_id' => Auth::id(),
                'nama_umkm' => $request->nama_umkm,
                'slug' => Str::slug($request->nama_umkm) . '-' . Str::random(6),
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos' => $request->kodepos,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $logoPath,
                'cover' => $coverPath,
                'nama_pemilik' => $request->nama_pemilik,
                'nik_pemilik' => $request->nik_pemilik,
                'foto_ktp' => $ktpPath,
                'npwp' => $request->npwp,
                'siup' => $request->siup,
                'tdp' => $request->tdp,
                'status' => 'pending', // TETAP pending, nanti admin approve
            ];

            $umkm = UMKM::create($umkmData);
            Log::info('UMKM Created with ID: ' . $umkm->id);

            // JANGAN ubah role user dulu - tunggu admin approve
            // $user = Auth::user();
            // $user->role = 'umkm';
            // $user->save();

            return redirect()->route('umkm.status')->with('success', 'Pendaftaran UMKM berhasil! Status akan diverifikasi oleh admin.');

        } catch (\Exception $e) {
            Log::error('Error creating UMKM: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function status()
    {
        $umkm = Auth::user()->umkm;

        if (!$umkm) {
            return redirect()->route('umkm.create');
        }

        return view('backend.umkm.status', compact('umkm'));
    }

    public function dashboard()
    {
        $umkm = Auth::user()->umkm;

        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('umkm.status')->with('error', 'UMKM Anda belum disetujui.');
        }

        // Stats Data
        $todayOrdersCount = \App\Models\Order::where('umkm_id', $umkm->id)
            ->whereDate('created_at', \Carbon\Carbon::today())
            ->count();

        $pendingOrdersCount = \App\Models\Order::where('umkm_id', $umkm->id)
            ->where('status', 'pending')
            ->count();

        $completedOrdersCount = \App\Models\Order::where('umkm_id', $umkm->id)
            ->where('status', 'completed')
            ->count();

        $totalMenus = \App\Models\Menu::where('umkm_id', $umkm->id)->count();

        // Recent Orders
        $recentOrders = \App\Models\Order::where('umkm_id', $umkm->id)
            ->with(['user', 'items.menu']) // Eager load user and items
            ->latest()
            ->take(5)
            ->get();

        return view('backend.umkm.dashboard', compact(
            'umkm',
            'todayOrdersCount',
            'pendingOrdersCount',
            'completedOrdersCount',
            'totalMenus',
            'recentOrders'
        ));
    }

    public function edit()
    {
        $umkm = Auth::user()->umkm;

        if (!$umkm) {
            return redirect()->route('umkm.create');
        }

        return view('backend.umkm.edit', compact('umkm'));
    }

    public function update(Request $request)
    {
        $umkm = Auth::user()->umkm;

        if (!$umkm) {
            return redirect()->route('umkm.create');
        }

        $validator = Validator::make($request->all(), [
            'nama_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:20',
            'kategori' => 'required|string|max:100',
            'alamat' => 'required|string|max:500',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kodepos' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
            'nama_pemilik' => 'required|string|max:255',
            'nik_pemilik' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $umkm->nama_umkm = $request->nama_umkm;
        $umkm->deskripsi = $request->deskripsi;
        $umkm->kategori = $request->kategori;
        $umkm->alamat = $request->alamat;
        $umkm->kota = $request->kota;
        $umkm->provinsi = $request->provinsi;
        $umkm->kodepos = $request->kodepos;
        $umkm->telepon = $request->telepon;
        $umkm->email = $request->email;
        $umkm->website = $request->website;
        $umkm->nama_pemilik = $request->nama_pemilik;
        $umkm->nik_pemilik = $request->nik_pemilik;

        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }
            $umkm->logo = $request->file('logo')->store('umkm/logo', 'public');
        }

        if ($request->hasFile('cover')) {
            if ($umkm->cover) {
                Storage::disk('public')->delete($umkm->cover);
            }
            $umkm->cover = $request->file('cover')->store('umkm/cover', 'public');
        }

        $umkm->save();

        return redirect()->route('umkm.dashboard')->with('success', 'Data UMKM berhasil diperbarui.');
    }

    public function qrcode()
    {
        $umkm = Auth::user()->umkm;

        if (!$umkm) {
            return redirect()->route('umkm.create');
        }

        if (!$umkm->shop_code) {
            // Generate unique code if not exists
            do {
                $code = Str::upper(Str::random(6)); // Example: X9A2B1
            } while (UMKM::where('shop_code', $code)->exists());

            $umkm->shop_code = $code;
            $umkm->save();
        }

        return view('backend.umkm.qrcode', compact('umkm'));
    }
}