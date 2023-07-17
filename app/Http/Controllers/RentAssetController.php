<?php

namespace App\Http\Controllers;

use App\Models\RentAsset;
use Illuminate\Http\Request;

class RentAssetController extends Controller
{
    public function index()
    {
        $rentAssets = RentAsset::all();
        return response()->json([
            'success' => true,
            'message' => 'Data Rent assets berhasil diambil',
            'data' => $rentAssets
        ]);
    }

    public function store(Request $request)
    {
        $rentAsset = RentAsset::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Rent asset Berhasil Ditambah',
            'data' => $rentAsset
        ], 201);
    }

    public function show($id)
    {
        $rentAsset = RentAsset::findOrFail($id);
        return response()->json([
            'success' => true,
            'message' => 'Data Rent asset',
            'data' => $rentAsset
        ]);
    }

    public function update(Request $request, $id)
    {
        $rentAsset = RentAsset::findOrFail($id);
        $rentAsset->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Rent asset Berhasil Diupdate',
            'data' => $rentAsset
        ], 200);
    }

    public function destroy($id)
    {
        RentAsset::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Rent asset Berhasil Dihapus'
        ], 204);
    }
}
