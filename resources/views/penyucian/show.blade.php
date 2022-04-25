@extends('layout.master')
@section('judul')
    Halaman Rincian Data Pesanan
@endsection

@section('content')

    <div class="row justify-content-md-center">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body box-profile">
                {{-- <a href="/export-penyucian/{{$penyucian->id}}/toPDF" class="btn btn-danger" style="float: right;" target="_blank">To PDF</a> --}}

                    <h3 class="profile-username text-center"><b>Laundry Wangi Bersih</b></h3>
                    <h3 class="profile-username text-center">Jalan Merdeka No. 45</h3>
                    <p class="text-muted text-center">Telp : 02233344455</p>
                    <hr>
                   
                        <table style=border-collapse: collapse;' border = '0' center>
                            <td width='77%' align='left' style='padding-right:80px; vertical-align:top'>
                                <b>Nama : {{ $penyucian->nama_pemesan }}<br>
                                <b>No Hp : {{ $penyucian->no_hp }}<br>
                                <b>Ket. : {{ $penyucian->keterangan }}
                            </td>
                            <td style='vertical-align:top' width='23%'  align='left'>
                                <b>Faktur Pesanan</b><br>
                                <b>No Trans. : {{ $penyucian->id }}</b><br>
                                Tanggal Pesan: {{ $penyucian->tgl_masuk }}<br>
                                <?php
                                if($penyucian->keterangan == "On Proses")
                                {
                                    $tgl_keluar = "-";
                                }
                                else
                                {
                                    $tgl_keluar = $penyucian->tgl_keluar;
                                }
                                ?>
                                Tanggal Selesai: {{ $tgl_keluar }}<br>
                            </td>
                        </table><br>
                            
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis Cuci</th>
                                    <th>Berat</th>
                                    <th>Harga</th>
                                    <th><center>Total Harga</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($penyucian->detail_penyucian as $key=> $item)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $item->jenis_cuci->jenis }}</td>
                                        <td>{{ $item->berat }} kg</td>
                                        <td>@currency($item->jenis_cuci->harga)</td>
                                        <td style='text-align:right'>@currency($item->total_harga)</td>
                                    </tr>        
                                @empty
                                    
                                @endforelse 
                                    <tr> 
                                        <td colspan ='4'style='text-align:right'> Total yang harus dibayar adalah  </td>
                                        <td style='text-align:right'>@currency($penyucian->total_bayar)</td>
                                    </tr>
                            </tbody>
                        </table>  
                    </center><br>
                    <button type="button" class="btn btn-primary" onclick="history.back();"><b>Kembali</b></button>
                   </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
