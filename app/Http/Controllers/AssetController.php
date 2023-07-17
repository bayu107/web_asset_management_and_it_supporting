<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all();

        return response()->json([
            'status' => 'succes',
            'message' => 'Daftar laporan berhasil diambil',
            'data' => $assets
        ], 200);
    }

    public function show($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return response()->json([
                'status' => 'error',
                'message' => 'Asset Tidak Ditemukan'
            ], 400);
        }

        return response()->json([
            'status' => 'Succes',
            'message' => 'Daftar Asset',
            'data' => $asset
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
            'asset_name' => 'required|string',
            'asset_detail' => 'required|string',
            'used_by' => 'required|integer',
            'rent_by' => 'nullable|integer',
            'is_available' => 'boolean'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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
            'used_by' => $request->input('used_by'),
            'rent_by' => $request->input('rent_by'),
            'is_available' => $request->input('is_available', false),
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data aset berhasil ditambahkan.',
            'data' => $asset
        ], 201);
    }

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
            return response()->json($validator->errors(), 400);
        }
    
        $asset = Asset::find($id);
    
        if (!$asset) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aset tidak ditemukan'
            ], 404);
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
    
        return response()->json([
            'status' => 'success',
            'message' => 'Data aset berhasil diperbarui.',
            'data' => $asset
        ], 200);
    }

    public function destroy($id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aset tidak ditemukan'
            ], 404);
        }

        $asset->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Aset berhasil dihapus.'
        ], 200);
    }
    
    public function getAssetsByUsedBy(Request $request, $userId)
    {
        $assets = Asset::with('category')
            ->where('used_by', $userId)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar aset berhasil diambil berdasarkan pengguna',
            'data' => $assets
        ], 200);
    }
}
