@extends('layout.master')
@section('judul')
    Halaman Data Pencucian
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
    <a href="/penyucian/create" class="btn btn-primary">Tambah Data Pencucian</a>
    <a href="/export-penyucian/toExcel" class="btn btn-success" style="float: right;" target="_blank">To Excel</a>
    <br><br>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Keluar</th>
                <th>Keterangan</th>
                <th><center>Aksi</center></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($penyucian as $key => $cuci)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cuci->nama_pemesan }}</td>
                    <td>{{ $cuci->no_hp }}</td>
                    <td>{{ $cuci->tgl_masuk }}</td>
                    <td>
                        <?php
                            if($cuci->keterangan == "On Proses")
                            {
                                $tgl_keluar = "-";
                            }
                            else
                            {
                                $tgl_keluar = $cuci->tgl_keluar;
                            }
                            ?>
                            {{ $tgl_keluar }}
                </td>
                    <td>{{ $cuci->keterangan }}</td>
                    <td>
                        <form action="/penyucian/{{ $cuci->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <a href="/penyucian/{{ $cuci->id }}/tambah" class="btn btn-primary btn-sm">Tambah Pesanan</a>
                            <a href="/penyucian/{{ $cuci->id }}" class="btn btn-success btn-sm">Detail</a>
                            <a href="/penyucian/{{ $cuci->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
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
