<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user->isUmkm()) {
            return redirect()->route('profile.index')->with('error', 'Anda bukan pemilik UMKM.');
        }

        $umkm = $user->umkm;
        $menus = $umkm->menus;

        return view('backend.umkm.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('backend.umkm.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
        ]);

        $user = Auth::user();
        $umkm = $user->umkm;

        $data = $request->all();
        $data['umkm_id'] = $umkm->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($data);

        return redirect()->route('umkm.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        // Ensure menu belongs to user's UMKM
        if ($menu->umkm_id !== Auth::user()->umkm->id) {
            abort(403);
        }

        return view('backend.umkm.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->umkm_id !== Auth::user()->umkm->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('umkm.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->umkm_id !== Auth::user()->umkm->id) {
            abort(403);
        }

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('umkm.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
