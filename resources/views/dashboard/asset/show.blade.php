<!-- resources/views/asset/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Detail Asset</h1>
    
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $asset->id }}</td>
        </tr>
        <tr>
            <th>Nama Aset:</th>
            <td>{{ $asset->asset_name }}</td>
        </tr>
        <tr>
            <th>Detail Aset:</th>
            <td>{{ $asset->asset_detail }}</td>
        </tr>
        <tr>
            <th>Kategori Aset:</th>
            <td>{{ $asset->category->category_name_asset }}</td>
        </tr>
        <tr>
            <th>Digunakan Oleh:</th>
            <td>
                @if ($asset->usedBy)
                    {{ $asset->usedBy->user_name }}
                @else
                    Unknown
                @endif
            </td>
        </tr>
        <tr>
            <th>Disewakan Oleh:</th>
            <td>
                @if ($asset->rentBy)
                    {{ $asset->rentBy->user_name }}
                @else
                    Not Rented
                @endif
            </td>
        </tr>
        <tr>
            <th>Tersedia:</th>
            <td>{{ $asset->is_available ? 'Ya' : 'Tidak' }}</td>
        </tr>
        <tr>
            <th>Gambar Aset:</th>
            <td>
                @if ($asset->asset_pict)
                    <img src="{{ asset($asset->asset_pict) }}" alt="Asset Pict" style="max-width: 100px">
                @else
                    N/A
                @endif
            </td>
        </tr>
    </table>
    
    <a href="{{ route('asset.edit', $asset->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('asset.destroy', $asset->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
    </form>
@endsection
