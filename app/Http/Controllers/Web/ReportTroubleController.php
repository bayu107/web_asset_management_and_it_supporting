<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ReportTrouble;
use App\Models\MCategoryReport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReportTroubleController extends Controller
{
    // public function index()
    // {
    //     $reports = ReportTrouble::with(['report', 'reporter', 'handler'])->get();

    //     return view('dashboard.report.index', compact('reports'));
    // }

    public function index(Request $request)
    {
        $perPage = 10;
        $search = $request->input('search');

        $reports = ReportTrouble::with(['report', 'reporter', 'handler'])
            ->when($search, function ($query, $search) {
                $query->where('report_detail', 'like', '%' . $search . '%');
            })
            ->orderByDesc('id')
            ->paginate($perPage);

        return view('dashboard.report.index', compact('reports'));
    }

    public function create()
    {
        $categories = MCategoryReport::all();
        $users = User::all();
        return view('dashboard.report.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'category_report_id' => 'required|integer',
            'report_detail' => 'required|string',
            'report_pict' => 'nullable|image',
            'report_by' => 'required|integer',
            'handle_by' => 'nullable|integer',
            'isdone' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan file ke direktori storage jika ada foto yang dikirim
        if ($request->hasFile('report_pict')) {
            $path = $request->file('report_pict')->store('public/report_picts');
            $report_pict = Storage::url($path);
        } else {
            $report_pict = null;
        }

        // Buat record baru di database
        $report = new ReportTrouble;
        $report->category_report_id = $request->input('category_report_id');
        $report->report_detail = $request->input('report_detail');
        $report->report_pict = $report_pict;
        $report->report_by = $request->input('report_by');
        $report->handle_by = $request->input('handle_by');

        // Periksa isdone, jika dicek, ubah status menjadi "Tidak Pending"
        if ($request->has('isdone')) {
            $report->isdone = true;
        } else {
            $report->isdone = false;
        }

        $report->save();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil ditambahkan.');
    }


    public function show($id)
    {
        $report = ReportTrouble::findOrFail($id);

        return view('dashboard.report.show', compact('report'));
    }

    public function edit($id)
    {
        $report = ReportTrouble::findOrFail($id);
        $categories = MCategoryReport::all();
        $users = User::all();

        return view('dashboard.report.edit', compact('report', 'categories', 'users'));
    }   


    // public function update(Request $request, $id)
    // {
    //     $report = ReportTrouble::findOrFail($id);

    //     // Validasi input dari form
    //     $validator = Validator::make($request->all(), [
    //         'category_report_id' => 'integer',
    //         'report_detail' => 'string',
    //         'report_pict' => 'nullable|image',
    //         'report_by' => 'integer',
    //         //'handle_by' => 'integer',
    //         // 'isdone' => 'boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Simpan file ke direktori storage jika ada foto yang dikirim
    //     if ($request->hasFile('report_pict')) {
    //         // Hapus gambar lama jika ada
    //         Storage::delete(str_replace('/storage', 'public', $report->report_pict));

    //         // Simpan gambar baru ke direktori storage
    //         $path = $request->file('report_pict')->store('public/report_picts');
    //         $report->report_pict = Storage::url($path);
    //     }

    //     // Perbarui report dengan data dari input form hanya jika ada perubahan
    //     $report->fill(array_filter($request->only([
    //         'category_report_id',
    //         'report_detail',
    //         'report_by',
    //     ])));

    //     // Periksa isdone, jika dicek, ubah status menjadi "Tidak Pending"
    //     if ($request->has('isdone')) {
    //         $report->isdone = true;
    //     } else {
    //         $report->isdone = false;
    //     }

    //     $report->save();

    //     return redirect()->route('report.show', $id)->with('success', 'Laporan berhasil diperbarui.');
    // }

    // public function update(Request $request, $id)
    // {
    //     $report = ReportTrouble::findOrFail($id);

    //     // Validasi input dari form
    //     $validator = Validator::make($request->all(), [
    //         'category_report_id' => 'integer',
    //         'report_detail' => 'string',
    //         'report_pict' => 'nullable|image',
    //         'report_by' => 'integer',
    //         'isdone' => 'nullable|boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Simpan file ke direktori storage jika ada foto yang dikirim
    //     if ($request->hasFile('report_pict')) {
    //         // Hapus gambar lama jika ada
    //         Storage::delete(str_replace('/storage', 'public', $report->report_pict));

    //         // Simpan gambar baru ke direktori storage
    //         $path = $request->file('report_pict')->store('public/report_picts');
    //         $report->report_pict = Storage::url($path);
    //     }

    //     // Perbarui report dengan data dari input form hanya jika ada perubahan
    //     $report->fill(array_filter($request->only([
    //         'category_report_id',
    //         'report_detail',
    //         // 'report_pict',
    //         // 'report_by,'
    //     ])));

    //     // Periksa isdone, jika dicek, ubah status menjadi "Done"
    //     if ($request->has('isdone')) {
    //         $report->isdone = true;
    //     } else {
    //         $report->isdone = false;
    //     }

    //     $report->save();

    //     return redirect()->route('report.show', $id)->with('success', 'Laporan berhasil diperbarui.');
    // }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // 'category_report_id' => 'required',
            // 'report_detail' => 'required',
            // 'report_pict' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'report_by' => 'required',
            'handle_by' => 'nullable',
            'isdone' => 'boolean',
        ]);
    
        // Find the report by ID
        $report = ReportTrouble::findOrFail($id);
    
        // Update the report attributes
        // $report->category_report_id = $validatedData['category_report_id'];
        // $report->report_detail = $validatedData['report_detail'];
        // $report->report_by = $validatedData['report_by'];
        $report->handle_by = $validatedData['handle_by'];
        $report->isdone = isset($validatedData['isdone']);
    
        // Handle the report picture if uploaded
        if ($request->hasFile('report_pict')) {
            $file = $request->file('report_pict');
            $path = $file->store('report_pictures', 'public');
            $report->report_pict = $path;
        }
    
        // Save the updated report
        $report->save();
    
        // Redirect or return a response
        // For example, redirect to the report index page
        return redirect()->route('report.index')->with('success', 'Report updated successfully');
    }
    

    public function destroy($id)
    {
        $report = ReportTrouble::findOrFail($id);
        $report->delete();

        return redirect()->route('report.index')->with('success', 'Laporan berhasil dihapus.');
    }

    // WEB USER
    public function indexuser(Request $request)
    {
        $perPage = 10;
        $search = $request->input('search');

        $user = session('user');

        // if($user->user_level == 1){
        //     return view('userdashboard');
        // }else{
        //     return view('dashboard');
        // }
        // return $user;
        
        $reports = ReportTrouble::with(['report', 'reporter', 'handler'])
            ->where('report_by', $user->id)
            ->when($search, function ($query, $search) {
                $query->where('report_detail', 'like', '%' . $search . '%');
            })
            ->orderByDesc('id')
            ->paginate($perPage);
        
        return view('dashboard.reportuser.index', compact('reports'));
        // return $reports;
    }

    public function createuser()
    {
        $categories = MCategoryReport::all();
        $users = User::all();
        return view('dashboard.reportuser.create', compact('categories', 'users'));
        // return $categories;
    }

    public function storeuser(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'category_report_id' => 'required|integer',
            'report_detail' => 'required|string',
            'report_pict' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan file ke direktori storage jika ada foto yang dikirim
        if ($request->hasFile('report_pict')) {
            $path = $request->file('report_pict')->store('public/report_picts');
            $report_pict = Storage::url($path);
        } else {
            $report_pict = '';
        }

        $reporter = session('user');

        // Buat record baru di database
        $report = new ReportTrouble;
        $report->category_report_id = $request->input('category_report_id');
        $report->report_detail = $request->input('report_detail');
        $report->report_pict = $report_pict;
        $report->report_by = $reporter->id;

        $report->save();

        return redirect()->route('reportuser.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edituser($id)
    {
        $report = ReportTrouble::findOrFail($id);
        $categories = MCategoryReport::all();
        $users = User::all();

        return view('dashboard.reportuser.edit', compact('report', 'categories', 'users'));
    }   

    public function updateuser(Request $request, $id)
    {
        $report = ReportTrouble::findOrFail($id);

        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'category_report_id' => 'integer',
            'report_detail' => 'string',
            'report_pict' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan file ke direktori storage jika ada foto yang dikirim
        if ($request->hasFile('report_pict')) {
            // Hapus gambar lama jika ada
            Storage::delete(str_replace('/storage', 'public', $report->report_pict));

            // Simpan gambar baru ke direktori storage
            $path = $request->file('report_pict')->store('public/report_picts');
            $report->report_pict = Storage::url($path);
        }

        // Perbarui report dengan data dari input form hanya jika ada perubahan
        $report->fill(array_filter($request->only([
            'category_report_id',
            'report_detail',
        ])));

        $report->save();

        return redirect()->route('reportuser.show', $id)->with('success', 'Laporan berhasil diperbarui.');
    }

}
