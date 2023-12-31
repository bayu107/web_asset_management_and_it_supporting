<!-- resources/views/m_category_reports/create.blade.php -->

@extends('dashboard')

@section('title', 'Tambah Kategori Laporan')

@section('content')
<div class="container">    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('m_category_reports.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Nama Kategori:</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
