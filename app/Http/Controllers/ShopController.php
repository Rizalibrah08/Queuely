<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UMKM;

class ShopController extends Controller
{
    public function show($id)
    {
        $umkm = UMKM::with([
            'menus' => function ($query) {
                $query->where('is_available', true);
            }
        ])->findOrFail($id);

        // Group menus by category
        $menus = $umkm->menus->groupBy('category');

        return view('backend.shop.show', compact('umkm', 'menus'));
    }
}
