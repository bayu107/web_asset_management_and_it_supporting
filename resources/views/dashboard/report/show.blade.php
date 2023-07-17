@extends('dashboard')

@section('title', 'Detail Report')

@section('content_header')
    <h1>Detail Report</h1>
@stop

@section('content')

<div class="container">

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>ID:</th>
                    <td>{{ $report->id }}</td>
                </tr>
                <tr>
                    <th>Kategori Report:</th>
                    <td>{{ $report->report->category_name }}</td>
                </tr>
                <tr>
                    <th>Detail Report:</th>
                    <td>{{ $report->report_detail }}</td>
                </tr>
                <tr>
                    <th>Dilaporkan Oleh:</th>
                    <td>{{ $report->reporter->user_name }}</td>
                </tr>
                <tr>
                    <th>Ditangani Oleh:</th>
                    <td>{{ $report->handler ? $report->handler->user_name : 'Belum Ditangani' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Laporan:</th>
                    <td>{{ $report->created_at }}</td>
                </tr>
                <tr>
                    <th>Gambar Laporan:</th>
                    <td>
                        @if ($report->report_pict)
                            <img src="{{ asset($report->report_pict) }}" alt="Report Picture" style="max-width: 300px">
                        @else
                            <p style="font-weight: bold;">Tidak ada gambar</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status :</th>
                    <td>
                        @if ($report->handler == null && $report->isdone == 0 && $report->isdone == 1)
                            <span style="background-color:white ; color: grey; padding: 5px; font-weight: bold;">Belum Ditangani</span>
                        @elseif ($report->handler != null && $report->isdone == 0 )
                            <span style="background-color: white ; color: orange; padding: 5px; font-weight: bold;">Sedang Ditangani</span>
                        @elseif ($report->handler == null && $report->isdone == 1)
                            <span style="background-color: white ; color: orange; padding: 5px; font-weight: bold;">Sedang Ditangani</span>
                        @elseif($report->handler != null && $report->isdone == 1 )
                            <span style="background-color: white ; color: green; padding: 5px; font-weight: bold;">Selesai Ditangani</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    
    <a href="{{ route('report.index') }}" class="btn btn-primary">Kembali</a>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
@stop
