<!-- resources/views/asset/index.blade.php -->

@extends('userdashboard')
@section('title', 'Peminjaman Saya')

@section('content')
<div class="container">
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <a href="{{ route('asset.create') }}" class="btn btn-primary mb-3">Tambah Pengajuan Peminjaman</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Aset</th>
                <th>Detail Aset</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usedAsset as $index => $used)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $used->asset->asset_name }}</td>
                    <td>{{ $used->asset->asset_detail }}</td>
                    <td>
                        <a href="{{ route('assetuser.show', $used->id) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('asset.edit', $used->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
