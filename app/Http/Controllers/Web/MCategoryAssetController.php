<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\MCategoryAsset;
use App\Http\Controllers\controller;

class MCategoryAssetController extends Controller
{
    public function index()
    {
        $m_category_assets = MCategoryAsset::all();

        return view('dashboard.m_category_assets.index', compact('m_category_assets'));
    }

    public function create()
    {
        return view('dashboard.m_category_assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name_asset' => 'required|string'
        ]);

        $m_category_asset = MCategoryAsset::create([
            'category_name_asset' => $request->category_name_asset
        ]);

        return redirect()->route('m_category_assets.index')
            ->with('success', 'MCategoryAsset created successfully.');
    }

    public function show($id)
    {
        $m_category_asset = MCategoryAsset::find($id);

        if (!$m_category_asset) {
            return redirect()->route('m_category_assets.index')
                ->with('error', 'MCategoryAsset not found.');
        }

        return view('dashboard.m_category_assets.show', compact('m_category_asset'));
    }

    public function edit($id)
    {
        $m_category_asset = MCategoryAsset::find($id);

        if (!$m_category_asset) {
            return redirect()->route('m_category_assets.index')
                ->with('error', 'MCategoryAsset not found.');
        }

        return view('dashboard.m_category_assets.edit', compact('m_category_asset'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name_asset' => 'required|string'
        ]);

        $m_category_asset = MCategoryAsset::find($id);

        if (!$m_category_asset) {
            return redirect()->route('m_category_assets.index')
                ->with('error', 'MCategoryAsset not found.');
        }

        $m_category_asset->update([
            'category_name_asset' => $request->category_name_asset
        ]);

        return redirect()->route('m_category_assets.index')
            ->with('success', 'MCategoryAsset updated successfully.');
    }

    public function destroy($id)
    {
        $m_category_asset = MCategoryAsset::find($id);

        if (!$m_category_asset) {
            return redirect()->route('m_category_assets.index')
                ->with('error', 'MCategoryAsset not found.');
        }

        $m_category_asset->delete();

        return redirect()->route('m_category_assets.index')
            ->with('success', 'MCategoryAsset deleted successfully.');
    }
}
