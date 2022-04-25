@extends('layout.master')
@section('judul')
    Halaman Data User
@endsection

@section('content')
    <form action=" /user" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
        </div>
        @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email') }}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" value="{{ old('password') }}">
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control" name="role_user_id">
                @foreach ($role_user as $role)
                    <option value="{{ $role->id }}">{{ $role->jabatan }}</option>
                @endforeach
            </select>
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
