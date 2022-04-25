@extends('layout.master')
@section('judul')
    Halaman Create Role User
@endsection

@section('content')

<form action="/role_user" method="POST">
    @csrf
    <div class="form-group">
        <label>Jabatan</label>
        <input type="text" class="form-control" name="jabatan">
    </div>
    @error('jabatan')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

