@extends('dashboard')
@section('title', 'Daftar Laporan')

@section('content')
<div class="container">
    {{-- <a href="{{ route('report.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a> --}}

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('report.index') }}" method="GET" class="form-inline mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                {{-- <th>Report ID</th> --}}
                <th>Category</th>
                <th>Report Detail</th>
                <th>Report By</th>
                <th>Handle By</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $index => $report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- <td>{{ $report->id }}</td> --}}
                    <td>{{ $report->report->category_name }}</td>
                    <td>{{ $report->report_detail }}</td>
                    <td>{{ $report->reporter->user_name }}</td>
                    <td>{{ $report->handler ? $report->handler->user_name : 'Not Assigned' }}</td>
                    <td>
                        @if ($report->handler == null && $report->isdone == 0)
                            <span style="background-color:white ; color: grey; padding: 5px; font-weight: bold;">Belum Ditangani</span>
                        @elseif ($report->handler != null && $report->isdone == 0 )
                            <span style="background-color: white ; color: orange; padding: 5px; font-weight: bold;">Sedang Ditangani</span>
                        @elseif ($report->handler == null && $report->isdone == 1)
                            <span style="background-color: white ; color: orange; padding: 5px; font-weight: bold;">Sedang Ditangani</span>
                        @elseif($report->handler != null && $report->isdone == 1 )
                            <span style="background-color: white ; color: green; padding: 5px; font-weight: bold;">Selesai Ditangani</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('report.show', $report->id) }}" class="btn btn-primary">View</a>
                        @if ( $report->handler == null && $report->isdone == 0 )
                            <a href="{{ route('report.edit', $report->id) }}" class="btn btn-success">Edit</a>
                        @elseif ($report->handler != null && $report->isdone == 0)
                            <a href="{{ route('report.edit', $report->id) }}" class="btn btn-success">Edit</a>
                        @elseif ($report->handler == null && $report->isdone == 1)
                            <a href="{{ route('report.edit', $report->id) }}" class="btn btn-success">Edit</a>
                        @endif
                        {{-- <a href="{{ route('report.edit', $report->id) }}" class="btn btn-success">Edit</a> --}}
                        <form action="{{ route('report.destroy', $report->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button> --}}
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No reports found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <div class="d-flex justify-content-between align-items-center mt-3">
        <p>Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} of {{ $reports->total() }} users</p>
        <div>
            {!! $reports->links('pagination::bootstrap-4') !!}
        </div>
    </div> --}}

    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="col-md-6">
            {{ $reports->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
