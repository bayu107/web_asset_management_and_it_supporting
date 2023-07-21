<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Asset;
use App\Models\UsedAsset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsedAssetController extends Controller
{
    public function index()
    {
        $usedAssets = UsedAsset::with(['accBy', 'asset', 'usedBy'])->get();

        return view('dashboard.usedasset.index', compact('usedAssets'));
    }

    public function create()
    {
        // $mAssets = Asset::all();
        $users = User::all();

        $mAssets = Asset::where('is_available', 1)->get();

        // return $mAssets;
        return view('dashboard.usedasset.create', compact('mAssets', 'users'));
    }


    // public function store(Request $request)
    // {
    //     $usedAsset = UsedAsset::create($request->all());

    //     $mAsset = Asset::find($request->input('asset_id'));
        
    //     if ($mAsset) {
    //         $mAsset->is_available = false;
    //         $mAsset->save();
    //     }

    //     return redirect()->route('usedasset.index')
    //         ->with('success', 'Used asset berhasil ditambahkan.');
    // }

    // public function create()
    // {
    //     $mAssets = Asset::where('is_available', true)->get();
    //     $user = User::all();

    //     // return $user;

    //     return view('dashboard.usedasset.create', compact('mAssets', 'user'));
    // }

    public function store(Request $request)
    {
        $mAsset = Asset::find($request->input('asset_id'));

        if ($mAsset && $mAsset->is_available) {
            $usedAsset = UsedAsset::create([
                'asset_id' => $mAsset->id,
                'used_by' => auth()->id(),
                'is_acc' => false,
                'use_start_date' => now(),
            ]);

            $mAsset->is_available = false;
            $mAsset->save();

            return redirect()->route('usedasset.index')
                ->with('success', 'Used asset berhasil ditambahkan.');
        } else {
            return redirect()->route('usedasset.index')
                ->with('error', 'Asset tidak tersedia atau tidak valid.');
        }
    }


    public function show($id)
    {
        $usedAsset = UsedAsset::with('asset.category')->find($id);

        if ($usedAsset) {
            return view('dashboard.usedasset.show', compact('usedAsset'));
        } else {
            return redirect()->route('usedasset.index')
                ->with('error', 'Used asset tidak ditemukan.');
        }
    }

    public function edit($id)
    {
        $usedAsset = UsedAsset::find($id);
        if ($usedAsset) {
            $mAssets = Asset::all(); // Mengambil semua data MAsset
            $users = User::all(); // Mengambil semua data pengguna
            return view('dashboard.usedasset.edit', compact('usedAsset', 'mAssets', 'users'));
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Used asset tidak Ditemukan'
            ], 404);
        }
    }
    

    // public function edit($id)
    // {
    //     $usedAsset = UsedAsset::find($id);

    //     if ($usedAsset) {
    //         return view('dashboard.usedasset.edit', compact('usedAsset'));
    //     } else {
    //         return redirect()->route('usedasset.index')
    //             ->with('error', 'Used asset tidak ditemukan.');
    //     }
    // }

    // public function update(Request $request, $id)
    // {
    //     $usedAsset = UsedAsset::find($id);

    //     if ($usedAsset) {
    //         $usedAsset->update($request->all());
    //         return redirect()->route('usedasset.index')
    //             ->with('success', 'Used asset berhasil diperbarui.');
    //     } else {
    //         return redirect()->route('usedasset.index')
    //             ->with('error', 'Used asset tidak ditemukan.');
    //     }
    // }

    public function update(Request $request, $id)
    {
        $usedAsset = UsedAsset::find($id);

        if ($usedAsset) {
            $usedAsset->update($request->all());

            // Cek jika is_acc telah diakses dan sudah ke acc
            if ($usedAsset->is_acc && $usedAsset->acc_by) {
                // Ubah status is_available menjadi 0 pada m_asset
                $mAsset = Asset::find($usedAsset->asset_id);
                if ($mAsset) {
                    $mAsset->is_available = 1;
                    $mAsset->save();
                }
            } else {
                // Ubah status is_available menjadi 1 pada m_asset
                $mAsset = Asset::find($usedAsset->asset_id);
                if ($mAsset) {
                    $mAsset->is_available = 0;
                    $mAsset->save();
                }
            }

            return redirect()->route('usedasset.index')
                ->with('success', 'Used asset berhasil diperbarui.');
        } else {
            return redirect()->route('usedasset.index')
                ->with('error', 'Used asset tidak ditemukan.');
        }
    }

    public function destroy($id)
    {
        $usedAsset = UsedAsset::find($id);

        if ($usedAsset) {
            $usedAsset->delete();

            $mAsset = Asset::find($usedAsset->asset_id);
            if ($mAsset) {
                $mAsset->is_available = true;
                $mAsset->save();
            }

            return redirect()->route('usedasset.index')
                ->with('success', 'Used asset berhasil dihapus.');
        } else {
            return redirect()->route('usedasset.index')
                ->with('error', 'Used asset tidak ditemukan.');
        }
    }

    public function returnAsset($id)
    {
        $usedAsset = UsedAsset::find($id);

        if ($usedAsset) {
            $usedAsset->return_date = Carbon::now();
            $usedAsset->save();

            $mAsset = Asset::find($usedAsset->asset_id);
            if ($mAsset) {
                $mAsset->is_available = 1;
                $mAsset->used_by = null;
                $mAsset->save();
            }

            // return $usedAsset->return_date;

            return redirect()->route('usedasset.index')->with('success', 'Asset returned successfully.');
        } else {
            return redirect()->route('usedasset.index')->with('error', 'Used asset not found.');
        }
    }

}
