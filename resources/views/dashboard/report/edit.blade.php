<!-- resources/views/dashboard/report/edit.blade.php -->

@extends('dashboard')
@section('title', 'Update Report')

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
                            <td>Tidak ada gambar</td>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Status :</th>
                    <td>{{ $report->isdone ? 'Done' : 'Pending' }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('report.update', $report->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- <div class="form-group">
            <label for="category_report_id">Category:</label>
            <select name="category_report_id" id="category_report_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $report->category_report_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="report_detail">Report Detail:</label>
            <textarea name="report_detail" id="report_detail" class="form-control" rows="5">{{$report->report_detail }}</textarea>
        </div>
        <div class="form-group">
            <label for="report_pict">Report Picture:</label>
            @if ($report->report_pict)
                <img src="{{ asset($report->report_pict) }}" alt="Report Picture" class="img-thumbnail mb-2">
            @endif
            <input type="file" name="report_pict" id="report_pict" class="form-control">
        </div> --}}
        {{-- <div class="form-group">
            <label for="report_by">Report By:</label>
            <select name="report_by" id="report_by" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $report->report_by ? 'selected' : '' }}>{{ $user->user_name }}</option>
                @endforeach
            </select>
        </div> --}}
        {{-- <div class="form-group">
            <label for="used_by">Pengguna</label>
            <input class="form-control" type="text" value="{{ session('$report->handle_by')}}" readonly>
            <select name="used_by" id="used_by" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="report_by">Reported By:</label>
            <input type="text" id="report_by" class="form-control" value="{{ $report->reporter->user_name }}" readonly>
        </div>
        
        <div class="form-group">
            <label for="handle_by">Handled By:</label>
            <input type="text" id="handle_by" class="form-control" value="{{ $report->handler ? $report->handler->user_name : 'Not Assigned' }}" readonly>
        </div>
        <div class="form-group">
            <label for="handle_by">Handle By:</label>
            <select name="handle_by" id="handle_by" class="form-control">
                <option value="">Not Assigned</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $report->handle_by ? 'selected' : '' }}>{{ $user->user_name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Sedang Di Tangani</button>
        </div>
        <div class="form-group">
            <label for="isdone">Sudah DiTangani</label>
            <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-primary {{ $report->isdone ? 'active' : '' }}">
                    <input type="submit" name="isdone" id="isdone" value="1" {{ $report->isdone ? 'checked' : '' }}> Mark as Done
                </label>
            </div>
        </div>
        
        {{-- <div class="form-group">
            <label for="isdone">Is Done:</label>
            <input type="checkbox" name="isdone" id="isdone" value="1" {{ $report->isdone ? 'checked' : '' }}>
        </div> --}}
        <div class="form-group">
            {{-- <button type="submit" class="btn btn-primary">Sedang Di Tangani</button> --}}
        </div>
        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
        <a href="{{ route('report.index') }}" class="btn btn-primary">Kembali</a>
    </form>
</div>
@endsection
