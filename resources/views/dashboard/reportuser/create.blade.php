@extends('userdashboard')
@section('title', 'Tambah Laporan Baru')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reportuser.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category_report_id">Kategori</label>
            <select name="category_report_id" id="category_report_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="report_detail">Keterangan</label>
            <textarea name="report_detail" id="report_detail" class="form-control" rows="5">{{ old('report_detail') }}</textarea>
        </div>
        <div class="form-group">
            <label for="report_pict">Gambar Pendukung</label>
            <input type="file" name="report_pict" id="report_pict" class="form-control">
        </div>
            <button type="submit" class="btn-block py-2 btn-primary">Tambah</button>
    </form>
@endsection
