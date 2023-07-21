@extends('userdashboard')
@section('title', 'Laporan Saya')

@section('content')
<div class="container">
    <a href="{{ route('reportuser.create') }}" class="btn btn-primary mb-3">Tambah Laporan Baru</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('reportuser.index') }}" method="GET" class="form-inline mb-3">
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
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Ditangani oleh</th>
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
                    <td>{{ $report->handler == null? '' : $report->handler->user_name }}</td>
                    <td>
                        @if($report->handler == null)
                            <span style="background-color: grey; color: white; padding: 5px;">Belum Ditangani</span>
                        @elseif (!$report->isdone)
                            <span style="background-color: orange; color: white; padding: 5px;">Sedang Ditangani</span>
                        @else
                            <span style="background-color: green; color: white; padding: 5px;">Selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('reportuser.edit', $report->id) }}" class="btn btn-success">Lihat Detail</a>
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
