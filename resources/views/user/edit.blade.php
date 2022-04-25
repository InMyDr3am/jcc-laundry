@extends('layout.master')
@section('judul')
    Halaman Edit Data User
@endsection

@section('content')
    <form action=" /user/{{ $user->id }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $user->nama }}">
        </div>
        @error('nama')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control" name="role_user_id">
                @foreach ($role_user as $role)
                    @if ($role->id === $user->role_user_id)
                        <option value="{{ $role->id }}" selected>{{ $role->jabatan }}</option>
                    @else
                        <option value="{{ $role->id }}">{{ $role->jabatan }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('role_user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
