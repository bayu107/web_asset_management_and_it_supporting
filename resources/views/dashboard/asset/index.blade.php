<!-- resources/views/asset/index.blade.php -->

@extends('dashboard')
@section('title', 'Daftar Asset')

@section('content')
<div class="container">
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <a href="{{ route('asset.create') }}" class="btn btn-primary mb-3">Tambah Asset</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Nama Aset</th>
                <th>Detail Aset</th>
                <th>Digunakan Oleh</th>
                {{-- <th>Disewakan Oleh</th> --}}
                <th>Tersedia</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $index => $asset)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $asset->id }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->asset_detail }}</td>
                    <td>{{ $asset->used_by }}</td>
                    {{-- <td>{{ $asset->rent_by }}</td> --}}
                    <td>{{ $asset->is_available ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
