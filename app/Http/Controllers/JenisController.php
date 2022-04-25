<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisCuci;
use App\Exports\JenisEcxel;
use Maatwebsite\Excel\Facades\Excel;

class JenisController extends Controller
{
    public function index()
    {
        $tabel=JenisCuci::all();

        return view('jenis_cuci.jenis-data',['tabel'=>$tabel]);
    }

    public function tambah()
    {
        return view('jenis_cuci.tambah-jenis');
    }

    public function store(Request $ambil)
    {
       $ambil->validate(
            [
                'jenis' => 'required',
                'harga' => 'required',
            ],

            [
                'jenis.required' => 'Jenis tidak boleh kosong',
                'harga.required' => 'Harga tidak boleh kosong',
            ]
        );

        $tabel = new JenisCuci;
        $tabel->jenis = $ambil->jenis;
        $tabel->harga = $ambil->harga;
        $tabel->save();
        return redirect('/jenis_cuci');
    }

    public function edit($id)
    {
        $tabel = JenisCuci::find($id);

        return view('jenis_cuci.edit-jenis', ['tabel'=>$tabel]);
    }

    public function update(Request $ambil)
    {
        $id=$ambil->id;
        $tabel = JenisCuci::find($id);
        $tabel->jenis = $ambil->jenis;
        $tabel->harga = $ambil->harga;
        $tabel->save();
        
        return redirect('/jenis_cuci');
    }

    public function hapus($id)
    {
        $tabel = JenisCuci::find($id);
        $tabel->delete();

        return redirect('/jenis_cuci');
    }

    public function toExcel()
    {
        return Excel::download(new JenisEcxel, 'JenisCuci.xlsx');
    }
}
