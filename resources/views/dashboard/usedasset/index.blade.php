<!-- resources/views/usedasset/index.blade.php -->

@extends('dashboard')
@section('title', 'Daftar Used Asset')

@section('content')
<div class="container">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('usedasset.create') }}" class="btn btn-primary mb-3">Tambah Used Asset</a>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Pengguna</th>
                <th>Disetujui Oleh</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Pengembalian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usedAssets as $index => $usedAsset)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $usedAsset->id }}</td>
                    <td>{{ $usedAsset->asset->asset_name }}</td>
                    <td>{{ $usedAsset->asset->category->category_name_asset}}</td>
                    <td>{{ $usedAsset->usedBy ? $usedAsset->usedBy->user_name : 'Tidak Ada' }}</td>
                    <td>{{ $usedAsset->accBy ? $usedAsset->accBy->user_name : 'Tidak Ada' }}</td>
                    <td>{{ $usedAsset->use_start_date }}</td>
                    <td>{{ $usedAsset->return_date }}</td>
                    <td>
                        <a href="{{ route('usedasset.show', $usedAsset->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('usedasset.edit', $usedAsset->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('usedasset.destroy', $usedAsset->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
