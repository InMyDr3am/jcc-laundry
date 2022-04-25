<?php

namespace App\Http\Controllers;

use App\JenisCuci;
use App\Penyucian;
use App\DetailPenyucian;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DetailPenyucianController extends Controller
{
    
    public function index()
    {
        
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $detail_penyucian = DetailPenyucian::find($id);
        $jenis_cuci = JenisCuci::find($detail_penyucian->jenis_cuci_id)->get();
        return view('detail_penyucian.edit', compact('detail_penyucian','jenis_cuci'));
        
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'jenis_cuci_id' => 'required',
                'berat' => 'required',
            ],

            [
                'jenis_cuci_id.required' => 'Jenis Cuci Tidak Boleh Kosong',
                'berat.required' => 'Berat tidak boleh kosong',
            ]
        );

        $detail_penyucian = DetailPenyucian::find($id);
        
        $total_harga_baru = $detail_penyucian->jenis_cuci->harga * $request->berat; 
        $detail_penyucian->jenis_cuci_id = $request->jenis_cuci_id;
        $detail_penyucian->berat = $request->berat;
        $detail_penyucian->total_harga = $total_harga_baru;
        $detail_penyucian->save();

        $total_bayar_baru = 0;
        $data_sama = DetailPenyucian::where('penyucian_id', $detail_penyucian->penyucian_id)->get();
            
        foreach($data_sama as $data)
        {
            $total_bayar_baru += $data['total_harga'];
        }   
            
        $penyucian = Penyucian::find($detail_penyucian->penyucian_id);
        $penyucian->total_bayar = $total_bayar_baru;
        $penyucian->save();

        Alert::success('Berhasil', 'Data Pencucian Berhasil Diubah');
        return redirect('/penyucian');
    }

    
    public function destroy($id)
    {
        $detail_penyucian = DetailPenyucian::find($id);
        $penyucian_id = $detail_penyucian->penyucian_id;
        $detail_penyucian->delete();

        $total_bayar_baru = 0;
        $data_sama = DetailPenyucian::where('penyucian_id', $penyucian_id)->get();
            
        foreach($data_sama as $data)
        {
            $total_bayar_baru += $data['total_harga'];
        }   
            
        $penyucian = Penyucian::find($penyucian_id);
        $penyucian->total_bayar = $total_bayar_baru;
        $penyucian->save();
        Alert::success('Berhasil', 'Data Pencucian Berhasil Dihapus');
        return redirect('/penyucian');
    }
}
