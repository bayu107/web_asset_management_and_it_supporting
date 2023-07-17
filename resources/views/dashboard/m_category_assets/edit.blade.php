<!-- resources/views/m_category_assets/edit.blade.php -->

@extends('dashboard')
@section('title', 'Update Category Asset')


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
    
    <form action="{{ route('m_category_assets.update', $m_category_asset->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name_asset">Category Name:</label>
            <input type="text" name="category_name_asset" id="category_name_asset" class="form-control" value="{{ $m_category_asset->category_name_asset }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
