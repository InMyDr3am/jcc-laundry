@extends('layout.master')
@section('judul')
    Halaman Data Pendapatan Hari Ini 
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
    <a href="/export-pendapatan/todaytoExcel" class="btn btn-success" style="float: right;">To Excel</a>
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal </th>
                <th>Total Pendapatan</th>
                <th><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendapatan as $key => $p)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $p->tgl_masuk }}</td>
                    <td>@currency($p->total_bayar)</td>
                    <td>   
                        <center><a href="/penyucian/{{ $p->id }}" class="btn btn-success btn-sm">Detail</a></center>       
                    </td>
                </tr>
            @empty
                <h1>Data Kosong</h1>
            @endforelse
        </tbody>
    </table>
@endsection
