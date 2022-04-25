@extends('layout.master')
@section('judul')
    Halaman Edit Data Penyucian
@endsection

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">Data pesanan </h3>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Cuci</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penyucian->detail_penyucian as $key=> $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->jenis_cuci->jenis }}</td>
                                        <td>{{ $item->berat }}</td>
                                        <td>{{ $item->jenis_cuci->harga }}</td>
                                        <td style='text-align:right'>{{ $item->total_harga }}</td>
                                        <td>
                                            <form action="/detail_penyucian/{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('delete')<center>
                                                <a href="/detail_penyucian/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                                <input type="submit" class="btn btn-danger btn-sm" onclick="" value="Delete"></center>
                                            </form>
                                        </td>
                                    </tr>        
                                @empty
                                    
                                @endforelse 
                                    <tr> 
                                        <td colspan ='4'style='text-align:right'> Total yang harus dibayar adalah  </td>
                                        <td style='text-align:right'>Rp. {{ $penyucian->total_bayar }}</td>
                                    </tr>
                            </tbody>
                        </table>  
                    </center>    
                </div>
                <!-- /.card-body --> 
            </div>

            <form action="/penyucian/{{ $penyucian->id }}" method="POST">
                @csrf
                @method('put')
                
        
                <div class="form-group">
                    <label>Nama Pemesan</label>
                    <input type="text" class="form-control" value="{{ $penyucian->nama_pemesan }}" name="nama_pemesan">
                </div>
                @error('nama_pemesan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                
                <div class="form-group">
                    <label>No Hp</label>
                    <input type="text" class="form-control" value="{{ $penyucian->no_hp }}" name="no_hp">
                </div>
                @error('no_hp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label>Keterangan</label>
                    <select class="form-control" name="keterangan">
                        <option disabled="disabled">--Pilih Keterangan--</option>
                        @if ($penyucian->keterangan == "On Proses")
                            <option value="On Proses" selected>On Proses</option>
                            <option value="Selesai">Selesai</option>
                        @else
                            <option value="On Proses" >On Proses</option>
                            <option value="Selesai" selected>Selesai</option>
                        @endif
                    </select>
                </div>
                @error('keterangan')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <br>
                <button type="submit" class="btn btn-primary" >Tambah</button></div>     
            </form>
            
            <!-- /.card -->
        </div>
    </div>
@endsection
