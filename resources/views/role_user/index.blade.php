@extends('layout.master')
@section('judul')
    Halaman Data Role User
@endsection

@push('scripts')
    <script src="{{asset('layout-admin/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{asset('layout-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
    $(function () {
        $("#example1").DataTable();
    });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css"/>
@endpush

@section('content')
    
<a href="/role_user/create" class="btn btn-primary my-3"> Tambah Role User </a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Jabatan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($role_user as $role_users => $item)
            <tr>
                <th scope="row">{{ $role_users + 1 }}</th>
                <td>{{ $item->jabatan }}</td>
               
                <td>
                    <form action= "/role_user/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href ="/role_user/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <h1>Data Kosong</h1>
            
        @endforelse

    </tbody>
</table>

{{-- ini kalau Pakai data Tables. tapi ga dipake untuk role user karena datanya terlalu dikit jadinya kurang enak dilihat kalo pake datatable
<table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Jabatan</th>
      <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
        @forelse ($role_user as $role_users => $item)
            <tr>
                <th scope="row">{{ $role_users + 1 }}</th>
                <td>{{ $item->jabatan }}</td>
                <td>
                    <form action= "/role_user/{{$item->id}}" method="POST">
                        @csrf
                        @method('delete')
                        <a href ="/role_user/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <h1>Data Kosong</h1>
            
        @endforelse
    </tbody>
</table> --}}


@endsection