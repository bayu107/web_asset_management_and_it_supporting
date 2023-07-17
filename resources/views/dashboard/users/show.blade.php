@extends('dashboard')

@section('title', 'Detail Users')

{{-- @section('content_header')
    <h1>{{ $user->user_name }}</h1>
@stop --}}

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Information</h5>
                    <p class="card-text"><strong>Name:</strong> {{ $user->user_name }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->user_email }}</p>
                    <p class="card-text"><strong>Level:</strong> {{ $user->user_level }}</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
@stop
