@extends('layout.master')
@section('judul')
    Halaman Rincian Data Pesanan
@endsection

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">Data yang sudah masuk</h3>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Cuci</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
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

            <form action="/penyucian/simpan" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" class="form-control" name="penyucian_id" value="{{ $penyucian->id }}">
                </div>
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
                <br>
                <button type="submit" class="btn btn-primary" >Tambah</button></div>     
            </form>
            
            <!-- /.card -->
        </div>
    </div>
@endsection
