@extends('layout.master')
@section('judul')
    Halaman Data User
@endsection

@push('scripts')
    <script src="{{ asset('layout-admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('layout-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />
@endpush

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="/user/create" class="btn btn-primary">Tambah User</a>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->jabatan }}</td>
                    <td>
                        <form action="/user/{{ $user->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="/user/{{ $user->id }}" class="btn btn-success btn-sm">Detail</a>
                            <a href="/user/{{ $user->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <input type="submit" class="btn btn-danger btn-sm" onclick="" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data Kosong</h1>
            @endforelse
        </tbody>
    </table>
@endsection
