<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Models\MCategoryAsset;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        $categories = MCategoryAsset::all();

        return view('dashboard.asset.index', compact('assets','categories'));
    }

    public function show($id)
    {
        {
            $asset = Asset::find($id);
    
            if (!$asset) {
                return redirect()->route('asset.index')
                    ->with('error', 'Asset Tidak Ditemukan');
            }
    
            $usedBy = User::find($asset->used_by);
            $rentBy = User::find($asset->rent_by);
            $asset->used_by = $usedBy ? $usedBy->user_name : 'Unknown';
            $asset->rent_by = $rentBy ? $rentBy->user_name : 'Not Rented';
    
            return view('dashboard.asset.show', compact('asset'));
        }
    
    }

    public function create()
    {
        $categories = MCategoryAsset::all();
        $users = User::all();

        return view('dashboard.asset.create', compact('categories', 'users'));
    }


    // public function create()
    // {
    //     return view('dashboard.asset.create');
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'asset_name' => 'required|string',
            'asset_detail' => 'required|string',
            // 'used_by' => 'required|integer',
            // 'rent_by' => 'nullable|integer',
            'is_available' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mengambil file gambar jika ada
        $asset_pict = null;
        if ($request->hasFile('asset_pict')) {
            $path = $request->file('asset_pict')->store('public/asset_picts');
            $asset_pict = Storage::url($path);
        }

        // Membuat record baru di database
        $asset = Asset::create([
            'category_id' => $request->input('category_id'),
            'asset_name' => $request->input('asset_name'),
            'asset_detail' => $request->input('asset_detail'),
            'asset_pict' => $asset_pict,
            // 'used_by' => $request->input('used_by'),
            // 'rent_by' => $request->input('rent_by'),
            'is_available' => $request->input('is_available', false),
        ]);

        return redirect()->route('asset.index')->with('success', 'Data aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return redirect()->route('asset.index')
                ->with('error', 'Asset Tidak Ditemukan');
        }

        $categories = MCategoryAsset::all();
        $users = User::all();

        return view('dashboard.asset.edit', compact('asset', 'categories', 'users'));
    }


    // public function edit($id)
    // {
    //     $asset = Asset::find($id);

    //     if (!$asset) {
    //         return redirect()->route('asset.index')->with('error', 'Aset tidak ditemukan');
    //     }

    //     return view('dashboard.asset.edit', compact('asset'));
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'integer',
            'asset_name' => 'string',
            'asset_detail' => 'string',
            'used_by' => 'integer',
            'rent_by' => 'nullable|integer',
            'is_available' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $asset = Asset::find($id);

        if (!$asset) {
            return redirect()->route('asset.index')->with('error', 'Aset tidak ditemukan');
        }

        // Mengambil file gambar jika ada
        $asset_pict = $asset->asset_pict;
        if ($request->hasFile('asset_pict')) {
            // Hapus gambar lama jika ada
            Storage::delete(str_replace('/storage', 'public', $asset->asset_pict));

            // Simpan gambar baru ke direktori storage
            $path = $request->file('asset_pict')->store('public/asset_picts');
            $asset_pict = Storage::url($path);
        }

        // Memperbarui data aset
        $asset->category_id = $request->input('category_id', $asset->category_id);
        $asset->asset_name = $request->input('asset_name', $asset->asset_name);
        $asset->asset_detail = $request->input('asset_detail', $asset->asset_detail);
        $asset->asset_pict = $asset_pict;
        $asset->used_by = $request->input('used_by', $asset->used_by);
        $asset->rent_by = $request->input('rent_by', $asset->rent_by);
        $asset->is_available = $request->input('is_available', $asset->is_available);
        $asset->save();

        return redirect()->route('asset.index')->with('success', 'Data aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return redirect()->route('asset.index')->with('error', 'Aset tidak ditemukan');
        }

        $asset->delete();

        return redirect()->route('asset.index')->with('success', 'Aset berhasil dihapus.');
    }
}
