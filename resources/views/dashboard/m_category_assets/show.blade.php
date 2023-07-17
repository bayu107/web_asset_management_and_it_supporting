<!-- resources/views/m_category_assets/show.blade.php -->

@extends('dashboard')
@section('title', 'Detail Category Asset')

@section('content')
    
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $m_category_asset->id }}</td>
        </tr>
        <tr>
            <th>Category Name:</th>
            <td>{{ $m_category_asset->category_name_asset }}</td>
        </tr>
    </table>
    
    <a href="{{ route('m_category_assets.edit', $m_category_asset->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('m_category_assets.destroy', $m_category_asset->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
