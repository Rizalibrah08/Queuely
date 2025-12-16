<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRController extends Controller
{
    public function scan()
    {
        return view('backend.qr.scan');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = $request->code;

        // Cari UMKM berdasarkan shop_code
        $umkm = \App\Models\UMKM::where('shop_code', $code)
            ->orWhere('id', $code) // Fallback jika ID yang discan
            ->orWhere('slug', $code) // Fallback jika slug
            ->first();

        if ($umkm) {
            return response()->json([
                'success' => true,
                'message' => 'UMKM ditemukan!',
                'redirect_url' => route('shop.show', $umkm->id),
                'umkm' => [
                    'name' => $umkm->nama_umkm,
                    'id' => $umkm->id
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Kode QR tidak dikenali atau UMKM tidak ditemukan.'
        ], 404);
    }
}
