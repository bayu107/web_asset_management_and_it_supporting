<!-- resources/views/asset/create.blade.php -->

@extends('userdashboard')

@section('content')
    <h1>Daftar Aset</h1>

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Aset</th>
                <th>Detail Aset</th>
                <th>Gambar Aset</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $index => $asset)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $asset->asset_name }}</td>
                    <td>{{ $asset->asset_detail }}</td>
                    <td>
                        @if ($asset->asset_pict)
                            <img src="{{ asset($asset->asset_pict) }}" alt="Asset Pict" style="max-width: 100px">
                        @else
                            Tidak ada Gambar
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('assetuser.addusedasset', $asset->id) }}" class="btn btn-sm btn-info">Ajukan Peminjaman</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
