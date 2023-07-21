@extends('dashboard')

@section('title', 'Edit Used Asset')

@section('content_header')
    <h1>Edit Used Asset</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('usedasset.update', $usedAsset->id) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group">
                            <label for="is_acc">Is Acc:</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_acc" name="is_acc" value="1"{{ $usedAsset->is_acc ? ' checked' : '' }}>
                                <label class="custom-control-label" for="is_acc"></label>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="acc_by">Acc By:</label>
                            <select class="form-control" id="acc_by" name="acc_by">
                                <option value="">Pilih Acc By</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"{{ $user->id == $usedAsset->acc_by ? ' selected' : '' }}>{{ $user->user_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <form method="POST" action="{{ route('usedasset.return', $usedAsset->id) }}">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-danger">Pengembalian Asset</button>
                        </form>
                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
@stop
