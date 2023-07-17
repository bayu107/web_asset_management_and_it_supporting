<?php

namespace App\Http\Controllers;

use App\Models\ReportTrouble;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ReportTroubleController extends Controller
{
    public function index()
    {
        $reports = ReportTrouble::with(['report', 'reporter', 'handler'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar laporan berhasil diambil.',
            'data' => $reports
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'category_report_id' => 'required|integer',
            'report_detail' => 'required|string',
            'report_pict' => 'nullable|image',
            'report_by' => 'required|integer',
            //'handle_by' => 'nullable|integer',
            // 'isdone' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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
        //$report->handle_by = $request->input('handle_by');
        // $report->isdone = $request->input('isdone');
        $report->save();

        return response()->json([
            'success' => true,
            'message' => 'Daftar laporan Report berhasil Tambah.',
            'data' => $report
        ], 201);
    }

    public function show(ReportTrouble $report)
    {
        $report->load(['report', 'reporter', 'handler']);

        return response()->json([
            'success' => true,
            'message' => 'Daftar laporan Report.',
            'report' => $report
        ], 200);
    }

    public function update(Request $request, ReportTrouble $report)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'category_report_id' => 'integer',
            'report_detail' => 'string',
            'report_pict' => 'nullable|image',
            'report_by' => 'integer',
            //'handle_by' => 'integer',
            // 'isdone' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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
            'report_by',
        ])));

        $report->save();

        return response()->json([
            'success' => true,
            'message' => 'Data laporan Report berhasil diperbarui.',
            'data' => $report
        ], 200);
    }

    public function destroy($id)
    {
        $report = ReportTrouble::find($id);

        if (!$report) {
            return response()->json([
                'success' => false,
                'message' => 'Data laporan tidak ditemukan.'
            ], 404);
        }

        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data laporan berhasil dihapus.'
        ], 200);
    }

    public function showByReportBy($reportBy)
    {
        $reports = ReportTrouble::where('report_by', $reportBy)->with(['report'])->get();
    
        $formattedReports = $reports->map(function ($report) {
            // Set handle_by to 0 if empty
            //$report->handle_by = $report->handle_by ?? 0;
    
            // Set handler to empty string if empty (instead of 0)
            //$report->handler = $report->handler ?? '';
    
            // Set report_pict to 0 if empty
            $report->report_pict = $report->report_pict ?? '';
    
            // Get the name of handle_by if it exists
            $handleByName = $report->handle_by ? $report->handler->user_name : '';
    
            // Add handle_by_name property to the report object
            $report->handle_by_name = $handleByName;
    
            return $report;
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Daftar laporan berdasarkan report_by berhasil diambil.',
            'data' => $formattedReports->isEmpty() ? [] : $formattedReports
        ], 200);
    }   
}
