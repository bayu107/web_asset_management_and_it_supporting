<!-- resources/views/m_category_reports/index.blade.php -->

@extends('dashboard')
@section('title', 'Category Report')

@section('content')
<div class="container">
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <a href="{{ route('m_category_reports.create') }}" class="btn btn-primary mb-3">Create MCategoryReport</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                {{-- <th>ID</th> --}}
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($m_category_reports as $index => $m_category_report)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    {{-- <td>{{ $m_category_report->id }}</td> --}}
                    <td>{{ $m_category_report->category_name }}</td>
                    <td>
                        <a href="{{ route('m_category_reports.show', $m_category_report->id) }}" class="btn btn-sm btn-info">View</a>
                        {{-- <a href="{{ route('m_category_reports.edit', $m_category_report->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                        {{-- <form action="{{ route('m_category_reports.destroy', $m_category_report->id) }}" method="POST" class="d-inline">
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