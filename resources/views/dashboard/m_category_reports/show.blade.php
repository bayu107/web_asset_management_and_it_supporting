<!-- resources/views/m_category_reports/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>MCategoryReport Details</h1>
    
    <table class="table">
        <tr>
            <th>ID:</th>
            <td>{{ $m_category_report->id}}</td>
        </tr>
        <tr>
            <th>Category Name:</th>
            <td>{{ $m_category_report->category_name }}</td>
        </tr>
    </table>
    
    <a href="{{ route('m_category_reports.edit', $m_category_report->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('m_category_reports.destroy', $m_category_report->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
@endsection
