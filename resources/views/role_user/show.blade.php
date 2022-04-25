@extends('layout.master')
@section('judul')
    Halaman Detail Cast 
@endsection

@section('content')
              
    <table class="table">
        <tbody>
            <tr>
                <th scope="row">Nama</th>
                <td>:</td>
                <td>{{$cast->nama}}</td>
            </tr>
            <tr>
                <th scope="row">Umur</th>
                <td>:</td>
                <td>{{$cast->umur}}</td>
            </tr>
            <tr>
                <th scope="row">Bio</th>
                <td>:</td>
                <td>{{$cast->bio}}</td>
            </tr>
        </tbody>
    </table>                      

@endsection