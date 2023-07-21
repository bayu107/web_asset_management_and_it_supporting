<!-- resources/views/report/show.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    
    <h1>Detail Laporan</h1>

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Kategori</th>
                    <td>{{ $report->report->category_name }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $report->report_detail }}</td>
                </tr>
                <tr>
                    <th>Ditangani Oleh</th>
                    <td>{{ $report->handler ? $report->handler->user_name : '' }}</td>
                </tr>
                <tr>
                    <th>Status :</th>
                    <td>
                        @if($report->handler == null)
                            Belum Ditangani
                        @elseif (!$report->isdone)
                            Sedang Ditangani
                        @else
                            Selesai
                        @endif </td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $report->created_at }}</td>
                </tr>
                <tr>
                    <th>Gambar</th>
                    <td>
                        @if ($report->report_pict)
                            <img src="{{ asset($report->report_pict) }}" alt="Report Picture" style="max-width: 300px">
                        @else
                            <td>Tidak ada gambar</td>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    

    <a href="{{ route('reportuser.index') }}" class="btn btn-primary">Kembali</a>

@endsection
    