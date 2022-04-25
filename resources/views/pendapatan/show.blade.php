@extends('layout.master')
@section('judul')
    Halaman Data Pendapatan
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
    <b>Detail Pesanan Pada Tanggal {{ $tanggal }}</b>
    {{-- <a href="/pendapatan/toExcel" class="btn btn-success" style="float: right;">To Excel</a> --}}
    <br><br> 
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pemesan </th>
                <th>Total Bayar</th>
                <th><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendapatan as $key => $p)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $p->nama_pemesan }}</td>
                    <td>@currency($p->total_bayar)</td>
                   
                    <td><center>   
                        <a href="/penyucian/{{ $p->id }}" class="btn btn-success btn-sm">Detail Pendapatan</a>       
                    </td></center>
                </tr>
            @empty
                <h1>Data Kosong</h1>
            @endforelse
        </tbody>
    </table>

    <button type="button" class="btn btn-primary"onclick="history.back();"><b>Kembali</b></button>
@endsection
