<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCategoryAsset;

class MCategoryAssetController extends Controller
{
    public function index()
    {
        $m_category_assets = MCategoryasset::all();

        return response()->json([
            'success' => true,
            'data' => $m_category_assets
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name_asset' => 'required|string'
        ]);

        $m_category_asset = MCategoryasset::create([
            'category_name_asset' => $request->category_name_asset
        ]);

        return response()->json([
            'success' => true,
            'data' => $m_category_asset
        ]);
    }

    public function show($id)
    {
        $m_category_asset = MCategoryasset::find($id);

        if (!$m_category_asset) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryasset not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $m_category_asset
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name_asset' => 'required|string'
        ]);

        $m_category_asset = MCategoryasset::find($id);

        if (!$m_category_asset) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryasset not found'
            ], 404);
        }
    
        $m_category_asset->update([
            'category_name_asset' => $request->category_name_asset
        ]);
    
        return response()->json([
            'success' => true,
            'data' => $m_category_asset
        ]);
    }
    
    public function destroy($id)
    {
        $m_category_asset = MCategoryasset::find($id);
    
        if (!$m_category_asset) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryasset not found'
            ], 404);
        }
    
        $m_category_asset->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'MCategoryasset deleted'
        ]);
    }    
}
