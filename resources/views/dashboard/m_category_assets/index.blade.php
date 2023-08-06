<!-- resources/views/m_category_assets/index.blade.php -->

@extends('dashboard')
@section('title', 'Daftar Kategori Asset')

@section('content')
<div class="container">
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <a href="{{ route('m_category_assets.create') }}" class="btn btn-primary mb-3">Tambah Kategori Asset</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                {{-- <th>ID</th> --}}
                <th>Nama Kategori</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($m_category_assets as $index => $m_category_asset)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- <td>{{ $m_category_asset->id }}</td> --}}
                    <td>{{ $m_category_asset->category_name_asset }}</td>
                    <td>
                        <a href="{{ route('m_category_assets.show', $m_category_asset->id) }}" class="btn btn-sm btn-info">View</a>
                        {{-- <a href="{{ route('m_category_assets.edit', $m_category_asset->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('m_category_assets.destroy', $m_category_asset->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
