<!-- resources/views/m_category_assets/create.blade.php -->

@extends('dashboard')
@section('title', 'Create Category Asset')

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
    
    <form action="{{ route('m_category_assets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name_asset">Category Name:</label>
            <input type="text" name="category_name_asset" id="category_name_asset" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
