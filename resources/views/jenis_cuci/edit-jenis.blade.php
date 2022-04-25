@extends('layout.master')
@section('judul','Jenis Laundry')

@section('content')

    <div class="card text-white bg-warning mb-12">
      <div class="card-header">Tambah Jenis Cuci</div>
      <div class="card-body">
        <form action="/jenis_cuci/update/{id}" method="post">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <input type="hidden" name="id" value="{{$tabel->id}}">
            <label>Jenis Cuci</label>
            <input type="text" name="jenis" style="width:100%" value="{{$tabel->jenis}}" required>
            <br>
            <label>Harga/Kg</label>
            <input type="text" name="harga" style="width:100%" value="{{$tabel->harga}}" required>
            <br>
            <br>
            <input type="submit" name="edit" value="Edit" class = " btn btn-primary" style="float: right">
        </form>
      </div>
    </div>

@endsection