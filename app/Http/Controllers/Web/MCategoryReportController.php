<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\MCategoryReport;
use App\Http\Controllers\Controller;

class MCategoryReportController extends Controller
{
    public function index()
    {
        $m_category_reports = MCategoryReport::all();

        return view('dashboard.m_category_reports.index', compact('m_category_reports'));
    }

    public function create()
    {
        return view('dashboard.m_category_reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $m_category_report = MCategoryReport::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('m_category_reports.index')
            ->with('success', 'MCategoryReport created successfully.');
    }

    public function show($id)
    {
        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return redirect()->route('m_category_reports.index')
                ->with('error', 'MCategoryReport not found.');
        }

        return view('dashboard.m_category_reports.show', compact('m_category_report'));
    }

    public function edit($id)
    {
        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return redirect()->route('m_category_reports.index')
                ->with('error', 'MCategoryReport not found.');
        }

        return view('dashboard.m_category_reports.edit', compact('m_category_report'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string'
        ]);

        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return redirect()->route('m_category_reports.index')
                ->with('error', 'MCategoryReport not found.');
        }

        $m_category_report->update([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('m_category_reports.index')
            ->with('success', 'MCategoryReport updated successfully.');
    }

    public function destroy($id)
    {
        $m_category_report = MCategoryReport::find($id);

        if (!$m_category_report) {
            return redirect()->route('m_category_reports.index')
                ->with('error', 'MCategoryReport not found.');
        }

        $m_category_report->delete();

        return redirect()->route('m_category_reports.index')
            ->with('success', 'MCategoryReport deleted successfully.');
    }
}
