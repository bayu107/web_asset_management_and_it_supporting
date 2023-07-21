<!-- resources/views/dashboard/report/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <form action="{{ route('reportuser.update', $report->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <tr>
                        <label for="report_by">Tanggal: </label>
                        <td>{{ $report->created_at }}</td>
                    </tr>
                </div>
                <div class="form-group">
                    <label for="category_report_id">kategori:</label>
                    <select name="category_report_id" id="category_report_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $report->category_report_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="report_detail">Keterangan</label>
                    <textarea name="report_detail" id="report_detail" class="form-control" rows="5">{{$report->report_detail }}</textarea>
                </div>
                <div class="form-group">
                    <label for="report_pict">Gambar Laporan:</label>
                    @if ($report->report_pict)
                        <img src="{{ asset($report->report_pict) }}" alt="Report Picture" class="img-thumbnail mb-2">
                    @endif
                    <input type="file" name="report_pict" id="report_pict" class="form-control">
                </div>
                <div class="form-group">
                    <tr>
                        <label for="report_by">Status: </label>
                        <td>
                            @if($report->handler == null)
                                Belum Ditangani
                            @elseif (!$report->isdone)
                                Sedang Ditangani
                            @else
                                Selesai
                            @endif </td>
                    </tr>
                </div>
                <div class="form-group">
                    <tr>
                        <label for="report_by">Ditangani oleh: </label>
                        <td>{{ $report->handler ? $report->handler->user_name : 'Belum ada' }}</td>
                    </tr>
                </div>
                <button type="submit" class="btn-block py-2 btn-primary">Update</button>
            </form>
        </div>
    </div>

    
</div>
@endsection
