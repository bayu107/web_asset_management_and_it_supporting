<?php

namespace App\Http\Controllers;

use App\Models\UsedAsset;
use Illuminate\Http\Request;

class UsedAssetController extends Controller
{
    public function index()
    {
        $usedAssets = UsedAsset::with(['accBy', 'asset','usedBy'])->get();;
        return response()->json([
            'success' => true,
            'data' => $usedAssets
        ]);
    }

    // public function store(Request $request)
    // {
    //     $usedAsset = UsedAsset::create($request->all());
    //     return response()->json([
    //         'success' => true,
    //         'data' => $usedAsset
    //     ], 201);
    // }

    public function store(Request $request)
{

    $usedAsset = UsedAsset::create($request->all());

    return response()->json([
        'success' => true,
        'data' => $usedAsset
    ], 201);
}

    public function show($id)
    {
        $usedAsset = UsedAsset::find($id);
        if ($usedAsset) {
            return response()->json([
                'success' => true,
                'data' => $usedAsset
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Used asset tidak Ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $usedAsset = UsedAsset::find($id);
        if ($usedAsset) {
            $usedAsset->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $usedAsset
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Used asset tidak Ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $usedAsset = UsedAsset::find($id);
        if ($usedAsset) {
            $usedAsset->delete();
            return response()->json([
                'success' => true,
                'message' => 'Used asset berhasil Dihapus.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Used asset tidak Ditemukan'
            ], 404);
        }
    }

    public function showByUsedBy($usedBy)
    {
        $usedAssets = UsedAsset::where('used_by', $usedBy)->with('accBy', 'asset')->get();

        if ($usedAssets->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Tidak ada used asset berdasarkan used_by.',
                'data' => []
            ], 200);
        }

        $data = $usedAssets->map(function ($usedAsset) {
            $assetName = $usedAsset->asset ? $usedAsset->asset->asset_name : null;
            return [
                // 'data' => $usedAsset,
                'id' => $usedAsset->id,
                'acc_by' => $usedAsset->accBy ? $usedAsset->accBy->user_name : 0,
                // 'asset' => $usedAsset,
                'is_acc' => $usedAsset->is_acc,
                'asset' => $usedAsset,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Daftar used asset berdasarkan used_by berhasil diambil.',
            'data' => $data,
        ], 200);
    }

    // public function showByUsedBy($usedBy)
    // {
    //     $usedAssets = UsedAsset::where('used_by', $usedBy)->get();

    //     if ($usedAssets->isEmpty()) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Tidak ada used asset berdasarkan used_by.',
    //             'data' => 0
    //         ], 200);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Daftar used asset berdasarkan used_by berhasil diambil.',
    //         'data' => $usedAssets
    //     ], 200);
    // }

}
