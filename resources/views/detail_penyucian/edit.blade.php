@extends('layout.master')
@section('judul')
    Halaman Edit Data User
@endsection

@section('content')
    <form action="/detail_penyucian/{{ $detail_penyucian->id }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Jenis Cuci</label>
            <select class="form-control" name="jenis_cuci_id">
                <option disabled="disabled" >--Pilih Jenis Cuci--</option>
                @foreach ($jenis_cuci as $item) 
                    @if ($item->id == $detail_penyucian->jenis_cuci_id)
                        <option value="{{ $item->id }}" selected>{{ $item->jenis }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->jenis }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @error('jenis_cuci_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label>Berat Cucian (dalam kg)</label>
            <input type="text" class="form-control" value ="{{ $detail_penyucian->berat }}"name="berat">
        </div>
        @error('berat')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
