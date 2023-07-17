@extends('dashboard')

@section('title', 'Create Report')

@section('content_header')
    <h1>Create Report</h1>
@stop

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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_report_id">Category:</label>
                    <select name="category_report_id" id="category_report_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="report_detail">Report Detail:</label>
                    <textarea name="report_detail" id="report_detail" class="form-control" rows="5">{{ old('report_detail') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="report_pict">Report Picture:</label>
                    <input type="file" name="report_pict" id="report_pict" class="form-control">
                </div>
                <div class="form-group">
                    <label for="report_by">Report By:</label>
                    <select name="report_by" id="report_by" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="handle_by">Handle By:</label>
                    <select name="handle_by" id="handle_by" class="form-control">
                        <option value="">Not Assigned</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="isdone">Is Done:</label>
                    <input type="checkbox" name="isdone" id="isdone" value="1">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
@stop
