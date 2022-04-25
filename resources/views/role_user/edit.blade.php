@extends('layout.master')
@section('judul')
    Halaman Edit Cast
@endsection

@section('content')
    
    <form action="/role_user/{{ $role_user->id }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Jabatan</label>
            <input type="text" value="{{ $role_user->jabatan }}" class="form-control" name="jabatan">
        </div>
        @error('jabatan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection