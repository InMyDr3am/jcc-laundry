@extends('layout.master')
@section('judul')
    Halaman Pendataan Pencucian
@endsection

@section('content')
    <form action="/penyucian" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Pemesan</label>
            <input type="text" class="form-control" name="nama_pemesan">
        </div>
        @error('nama_pemesan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label>No Hp</label>
            <input type="text" class="form-control" name="no_hp">
        </div>
        @error('no_hp')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Jenis Cuci</label>
            <select class="form-control" name="jenis_cuci_id">
                @foreach ($jenis_cuci as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->jenis }}</option>
                @endforeach
            </select>
        </div>
        @error('jenis_cuci_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Berat Cucian (dalam kg)</label>
            <input type="text" class="form-control" name="berat">
        </div>
        @error('berat')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
