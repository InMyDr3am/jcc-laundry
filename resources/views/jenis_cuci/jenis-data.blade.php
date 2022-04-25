@extends('layout.master')
@section('judul','Jenis Laundry')

@section('content')
  
  <a href="jenis_cuci/tambah"><button type="button" class="btn btn-primary">+Tambah</button></a>
  <a href="jenis_cuci/toexcel" style="float: right;"><button type="button" class="btn btn-success">To Excel</button></a>
  <div>
    <hr>
  </div>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Jenis</th>
        <th scope="col">Harga/Kg</th>
        <th scope="col" colspan="2" style="text-align: center;">Lanjutan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tabel as $id)
      <tr>
        <td>{{$id->id}}</td>
        <td>{{$id->jenis}}</td>
        <td>Rp. {{$id->harga}}</td>
        <td align="center">
          <a href="/jenis_cuci/edit/{{$id->id}}"><button type="button" class="btn btn-warning">Edit</button></a>
        </td>
        <td align="center">
          <a href="/jenis_cuci/hapus/{{$id->id}}"><button type="button" class="btn btn-danger">Hapus</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  
@endsection