<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MCategoryReport;

class MCategoryReportController extends Controller
{
    public function index()
    {
        $m_category_reports = MCategoryReport::all();

        return response()->json([
            'success' => true,
            'data' => $m_category_reports
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $m_category_report = MCategoryReport::create([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Report berhasil DiTambah.',
            'data' => $m_category_report
        ]);
    }

    public function show($id)
    {
        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryReport not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $m_category_report
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryReport not found'
            ], 404);
        }
    
        $m_category_report->update([
            'category_name' => $request->category_name
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Data Report Berhasil DiUpdate.',
            'data' => $m_category_report
        ]);
    }
    
    public function destroy($id)
    {
        $m_category_report = MCategoryReport::find($id);
    
        if (!$m_category_report) {
            return response()->json([
                'success' => false,
                'message' => 'MCategoryReport not found'
            ], 404);
        }
    
        $m_category_report->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'MCategoryReport deleted'
        ]);
    }    
}
