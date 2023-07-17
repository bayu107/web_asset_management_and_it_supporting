<!-- resources/views/asset/create.blade.php -->

@extends('dashboard')

@section('content')
    <h1>Tambah Asset</h1>

    <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="category_id">Kategori Aset:</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name_asset }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="asset_name">Nama Aset:</label>
            <input type="text" name="asset_name" id="asset_name" class="form-control">
        </div>

        <div class="form-group">
            <label for="asset_detail">Detail Aset:</label>
            <textarea name="asset_detail" id="asset_detail" class="form-control"></textarea>
        </div>

        {{-- <div class="form-group">
            <label for="used_by">Digunakan Oleh:</label>
            <select name="used_by" id="used_by" class="form-control">
                <option value="">Tidak Digunakan</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="rent_by">Disewakan Oleh:</label>
            <select name="rent_by" id="rent_by" class="form-control">
                <option value="">Tidak Disewakan</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                @endforeach
            </select>
        </div> --}}

        <div class="form-group">
            <label for="is_available">Tersedia:</label>
            <select name="is_available" id="is_available" class="form-control">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </select>
        </div>

        <div class="form-group">
            <label for="asset_pict">Gambar Aset:</label>
            <input type="file" name="asset_pict" id="asset_pict" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
