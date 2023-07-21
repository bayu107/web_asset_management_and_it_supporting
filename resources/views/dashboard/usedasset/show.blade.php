<!-- resources/views/usedasset/show.blade.php -->

@extends('dashboard')
@section('title', 'Detail Used Asset')

@section('content')
    <div class="container">

        <table class="table">
            <tr>
                <th>ID:</th>
                <td>{{ $usedAsset->id }}</td>
            </tr>
            <tr>
                <th>Nama Asset:</th>
                <td>{{ $usedAsset->asset->asset_name }}</td>
            </tr>
            <tr>
                <th>Pengguna:</th>
                <td>{{ $usedAsset->usedBy ? $usedAsset->usedBy->user_name : 'Tidak Ada' }}</td>
            </tr>
            <tr>
                <th>Disetujui Oleh:</th>
                <td>{{ $usedAsset->accBy ? $usedAsset->accBy->user_name : 'Tidak Ada' }}</td>
            </tr>
            <tr>
                <th>Tanggal Mulai:</th>
                <td>{{ $usedAsset->use_start_date }}</td>
            </tr>
            <tr>
                <th>Tanggal Selesai:</th>
                <td>{{ $usedAsset->return_date }}</td>
            </tr>
        </table>

        <h2>Detail Aset</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Aset</th>
                    <th>Detail Aset</th>
                    <th>Kategori Aset</th>
                    <th>Digunakan Oleh</th>
                    {{-- <th>Disewakan Oleh</th> --}}
                    {{-- <th>Tersedia</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $usedAsset->asset->id }}</td>
                    <td>{{ $usedAsset->asset->asset_name }}</td>
                    <td>{{ $usedAsset->asset->asset_detail }}</td>
                    <td>{{ $usedAsset->asset->category->category_name_asset }}</td>
                    <td>
                        @if ($usedAsset->asset->usedBy)
                            {{ $usedAsset->asset->usedBy->user_name }}
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    {{-- <td>
                        @if ($usedAsset->asset->rentBy)
                            {{ $usedAsset->asset->rentBy->user_name }}
                        @else
                            Not Rented
                        @endif
                    </td> --}}
                    {{-- <td>{{ $usedAsset->asset->is_available ? 'Ya' : 'Tidak' }}</td> --}}
                </tr>
            </tbody>
        </table>

        <a href="{{ route('usedasset.index') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
