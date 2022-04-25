<?php

namespace App\Http\Controllers;

use App\JenisCuci;
use App\Penyucian;
use App\DetailPenyucian;
use Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exports\DataPencucian;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;






class PenyucianController extends Controller
{
    public function index()
    {
        $penyucian = Penyucian::all();
        return view('penyucian.index', compact('penyucian'));
    }

    
    public function create()
    {
        $jenis_cuci = JenisCuci::all();
        return view('penyucian.create', compact('jenis_cuci'));
    }

    
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_pemesan' => 'required',
                'no_hp' => 'required',
                'jenis_cuci_id' => 'required',
                'berat' => 'required',
            ],

            [
                'nama_pemesan.required' => 'Nama tidak boleh kosong',
                'no_hp.required' => 'No HP tidak boleh kosong',
                'jenis_cuci_id.required' => 'Jenis Cuci tidak boleh kosong',
                'berat.required' => 'Berat tidak boleh kosong',
            ]
        );

        $user_id = 2;
        $tgl_masuk = Carbon\Carbon::now();
        $keterangan = "On Proses";
        $jenis = JenisCuci::find($request->jenis_cuci_id);
        
        // $penyucian = new Penyucian;
        // $penyucian->user_id = $user_id;
        // $penyucian->nama_pemesan = $request->nama_pemesan;
        // $penyucian->no_hp = $request->no_hp;
        // $penyucian->tgl_masuk = $tgl_masuk;
        // $penyucian->tgl_keluar = $tgl_masuk;
        // $penyucian->total_bayar = 0;
        // $penyucian->keterangan  = $keterangan;
        // $penyucian = $penyucian->save();

        $data_penyucian = Penyucian::create([
            'user_id' => Auth::user()->id,
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'tgl_masuk' => $tgl_masuk,
            'tgl_keluar' => $tgl_masuk,
            'total_bayar' => $jenis->harga * $request->berat,
            'keterangan' => $keterangan,
        ]);

        DetailPenyucian::create([
            'penyucian_id' => $data_penyucian->id,
            'jenis_cuci_id' => $request->jenis_cuci_id,
            'berat' => $request->berat,
            'total_harga' => $jenis->harga * $request->berat,
        ]);

        Alert::success('Berhasil', 'Data Pencucian Berhasil Ditambahkan');

        return redirect('/penyucian');
        
    }

    public function show($id)
    {
        $penyucian = Penyucian::find($id);
        $penyucian_id = $penyucian->id;
        $penyucian_detail = DetailPenyucian::where('penyucian_id', $penyucian_id)->get();
        return view('penyucian.show', compact('penyucian','penyucian_detail'));
        
    }

    public function tambah($id)
    {
        $jenis_cuci = JenisCuci::all();
        $penyucian = Penyucian::find($id);
        $penyucian_id = $penyucian->id;
        $penyucian_detail = DetailPenyucian::where('penyucian_id', $penyucian_id)->get();
        return view('penyucian.tambah', compact('penyucian','penyucian_detail','jenis_cuci'));
        
    }

    public function simpan(Request $request)
    {

        $request->validate(
            [
                'jenis_cuci_id' => 'required',
                'berat' => 'required',
            ],

            [
                'jenis_cuci_id.required' => 'Jenis Cuci tidak boleh kosong',
                'berat.required' => 'Berat tidak boleh kosong',
            ]
        );

        $user_id = 2;
        $tgl_masuk = Carbon\Carbon::now();
        $keterangan = "On Proses";
        $jenis = JenisCuci::find($request->jenis_cuci_id);

        DetailPenyucian::create([
            'penyucian_id' => $request->penyucian_id,
            'jenis_cuci_id' => $request->jenis_cuci_id,
            'berat' => $request->berat,
            'total_harga' => $jenis->harga * $request->berat,
        ]);

        $penyucian = Penyucian::find($request->penyucian_id);
        $total_bayar = $penyucian->total_bayar + $jenis->harga * $request->berat;

        $penyucian->total_bayar = $total_bayar;
        $penyucian->save();

        Alert::success('Berhasil', 'Data Pencucian Berhasil Ditambahkan');
        return redirect('/penyucian');
        
    }
    
    public function edit($id)
    {  
        $penyucian = Penyucian::find($id);
        $penyucian_id = $penyucian->id;
        $penyucian_detail = DetailPenyucian::where('penyucian_id', $penyucian_id)->get();
        return view('penyucian.edit', compact('penyucian','penyucian_detail'));
        
    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_pemesan' => 'required',
                'no_hp' => 'required',
                'keterangan' => 'required',
            ],

            [
                'nama_pemesan.required' => 'Nama pemesan tidak boleh kosong',
                'no_hp.required' => 'No hp tidak boleh kosong',
                'keterangan.required' => 'keterangan tidak boleh kosong',
            ]
        );

        $penyucian = Penyucian::find($id);

        if($penyucian->keterangan =="On Proses" AND $request->keterangan == "Selesai")
        {
            $penyucian->tgl_keluar =  Carbon\Carbon::tomorrow();
        }
        
        $penyucian->nama_pemesan = $request->nama_pemesan;
        $penyucian->no_hp = $request->no_hp;
        $penyucian->keterangan = $request->keterangan;
        $penyucian->save();
        
        Alert::success('Berhasil', 'Data Pencucian Berhasil Diubah');
        return redirect('/penyucian');

    }

    
    public function destroy($id)
    {

        $penyucian = Penyucian::find($id);
        $penyucian_id = $penyucian->id;
        
        $detail_penyucian = DetailPenyucian::where('penyucian_id', $penyucian_id)->get();
            
        foreach($detail_penyucian as $data)
        {
            $data->delete();
        }   
            
        $penyucian->delete();

        Alert::success('Berhasil', 'Data Pencucian Berhasil Dihapus');

        return redirect('/penyucian');
    }

    public function toExcel()
    {
        // return Excel::download(new DataPencucian, 'DataPencucian.xlsx');
        // ini_set("memory_limit","-1");
        set_time_limit(500);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B1','DAFTAR PENCUCIAN');
        $sheet->setCellValue('A4','NO');
        $sheet->setCellValue('B4','NAMA PEGAWAI');
        $sheet->setCellValue('C4','NAMA PEMESAN');
        $sheet->setCellValue('D4','NO HP');
        $sheet->setCellValue('E4','TANGGAL MASUK');
        $sheet->setCellValue('F4','TANGGAL KELUAR');
        $sheet->setCellValue('G4','KETERANGAN');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(70);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $headerStyle = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '28a745',
                ],
            ],
        ];
        

        $sheet->getStyle('A3:C3')->getFont()->getColor()->setARGB(COLOR::COLOR_WHITE);
        $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('B')->getAlignment()->setVertical('center');
        $sheet->getStyle('A')->getAlignment()->setVertical('center');
        $sheet->getStyle('C')->getAlignment()->setVertical('center');

        $model = Penyucian::all();

        $row = 6;
        $no = 1;

        foreach($model as $model)
        {
            $sheet->setCellValue("A$row",$no);
            $sheet->setCellValue("B$row",@$model->user->nama);
            $sheet->setCellValue("C$row",@$model->nama_pemesan); 
            $sheet->setCellValue("d$row",@$model->no_hp); 
            $sheet->setCellValue("e$row",@$model->tgl_masuk);
            if($model->keterangan === "On Proses"){
                $sheet->setCellValue("f$row","-"); 
            }else{
                $sheet->setCellValue("f$row",@$model->tgl_keluar); 
            }
            $sheet->setCellValue("g$row",@$model->keterangan); 


            $row++;
            $no++;
        }
       
        $filename = time().'_export_data_pencucian.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function toPDF($id)
    {
        
        // $penyucian = Penyucian::find($id);
        // $penyucian_id = $penyucian->id;
        // $penyucian_detail = DetailPenyucian::where('penyucian_id', $id)->get();

        // $pdf = \PDF::loadView('penyucian._export-pdf', ['model' => $penyucian_detail]);
        // return $pdf->download('detail_penyucian.pdf');

        $data['judul'] = "Lapor";
        $pdf = PDF::loadView('penyucian._export-pdf', $data);
        return $pdf->download('inf.pdf');

        
    // $pdf = PDF::loadView('pdf.invoice', $data);
    // return $pdf->download('invoice.pdf');

    
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
    }
}
