<!-- resources/views/usedasset/create.blade.php -->
@extends('dashboard')
@section('title', 'Tambah Used Asset')

@section('content')
<div class="container">
<form action="{{ route('usedasset.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="asset_id">Aset</label>
        <select name="asset_id" id="asset_id" class="form-control">
            @foreach ($mAssets as $mAsset)
                <option value="{{ $mAsset->id }}">{{ $mAsset->asset_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="used_by">Pengguna</label>
        {{-- <input class="form-control" type="text" value="Nama Pengguna" readonly> --}}
        <select name="used_by" id="used_by" class="form-control">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->user_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="acc_by">Disetujui Oleh</label>
        <select name="acc_by" id="acc_by" class="form-control">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->user_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="start_date">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="end_date">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection