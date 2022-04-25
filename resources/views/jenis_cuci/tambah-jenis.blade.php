@extends('layout.master')
@section('judul','Jenis Laundry')

@section('content')
  
  <div class="card text-white bg-primary mb-12">
    <div class="card-header">Tambah Jenis Cuci</div>
    <div class="card-body">
      <form action="/jenis_cuci/store" method="post">
          {{csrf_field()}}
          <label>Jenis Cuci</label>
          <input type="text" name="jenis" style="width:100%">
          <br>
          <label>Harga/Kg</label>
          <input type="text" name="harga" style="width:100%">
          <br>
          <br>
          <input type="submit" name="" value="Tambahkan" class = " btn btn-primary" style="float: right">
      </form>
    </div>
  </div>

@endsection