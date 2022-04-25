<?php

namespace App\Http\Controllers;

use App\JenisCuci;
use App\Penyucian;
use App\DetailPenyucian;
use App\Exports\PendapatanExport;
use DB;
Use Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PendapatanController extends Controller
{
    public function index()
    {
        $pendapatan = DB::table('penyucian')
                ->select([
                    DB::raw('count(*) as jumlah'),
                    DB::raw('DATE(tgl_masuk) as tanggal'),
                    DB::raw('sum(total_bayar) as total_pendapatan')
                ])
                ->groupBy('tanggal')
                ->get();
       
        return view('pendapatan.index', compact('pendapatan'));

    }

    public function pendapatantoday()
    {
        $tgl_today = date('Y-m-d');
        $pendapatan = Penyucian::where('tgl_masuk', $tgl_today)->get();
            
        return view('pendapatan.today', compact('pendapatan'));
    }

    public function show($tgl)
    {
        $tanggal = $tgl;
        $pendapatan = Penyucian::where('tgl_masuk', $tgl)->get();
         
        return view('pendapatan.show', compact('pendapatan','tanggal'));
        
    }

    public function toExcel()
    {
        
        ini_set("memory_limit","-1");
        set_time_limit(500);
        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('B1','DAFTAR PENCUCIAN');
        $sheet->setCellValue('A4','NO');
        $sheet->setCellValue('B4','TANGGAL');
        $sheet->setCellValue('C4','JUMLAH PESANAN');
        $sheet->setCellValue('D4','TOTAL PENDAPATAN');
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(70);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
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
        $sheet->getStyle('A3:C3')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
        $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B')->getAlignment()->setVertical('center');
        $sheet->getStyle('A')->getAlignment()->setVertical('center');
        $sheet->getStyle('C')->getAlignment()->setVertical('center');
        $model = DB::table('penyucian')
                ->select([
                    DB::raw('count(*) as jumlah'),
                    DB::raw('DATE(tgl_masuk) as tanggal'),
                    DB::raw('sum(total_bayar) as total_pendapatan')
                ])
                ->groupBy('tanggal')
                ->get();

        $row = 6;
        $no = 1;

        foreach($model as $model)
        {
            $sheet->setCellValue("A$row",$no);
            $sheet->setCellValue("B$row",@$model->tanggal);
            $sheet->setCellValue("C$row",@$model->jumlah);
            $sheet->setCellValue("D$row",@$model->total_pendapatan);
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

    public function todaytoExcel()
    {
        
        // ini_set("memory_limit","-1");
        set_time_limit(500);

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('B1','DAFTAR PENCUCIAN HARI INI');
        $sheet->setCellValue('A4','NO');
        $sheet->setCellValue('B4','TANGGAL');
        $sheet->setCellValue('C4','TOTAL PENDAPATAN');
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(50);
        $sheet->getColumnDimension('C')->setAutoSize(true);
       

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
        
        $sheet->getStyle('A3:C3')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);
        $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B')->getAlignment()->setVertical('center');
        $sheet->getStyle('A')->getAlignment()->setVertical('center');
        $sheet->getStyle('C')->getAlignment()->setVertical('center');

        $tgl_today = date('Y-m-d');
        $model = Penyucian::where('tgl_masuk', $tgl_today)->get();

        $row = 6;
        $no = 1;

        foreach($model as $model)
        {
            $sheet->setCellValue("A$row",$no);
            $sheet->setCellValue("B$row",@$model->tgl_masuk);
            $sheet->setCellValue("C$row",@$model->total_bayar);
            $row++;
            $no++;
        }
       
        $filename = time().'_export_data_pencucian_hari_ini.xlsx';
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function cariKombinasi()
    {
        
        $barang = Barang::all();
        if (request()->barang1 || request()->barang2) {
            $barang1 = request()->barang1;
            $barang2 = request()->barang2;
            $transaksi = TransaksiPembelianBarang::where('master_barang_id', $barang1)
                            ->orwhere('master_barang_id', $barang2)
                            ->selectRaw('transaksi_pembelian_id')
                            ->select([
                                      DB::raw('count(*) as jumlah'),
                                      DB::raw('transaksi_pembelian_id as id_beli'),
                                ])
                            ->groupBy('id_beli')
                            ->get();
         return $transaksi;

        } else {
            $transaksi = TransaksiPembelian::latest()->get();
        }
        
        return view('transaksi-cari/kombinasi', compact('transaksi','barang'));
    }

    public function cariKombinasiSederhana()
    {
        
        $barang = Barang::all();
        if (request()->barang1 || request()->barang2) {
            $barang1 = request()->barang1;
            $barang2 = request()->barang2;
            $transaksi = DB::table('transaksi_pembelian_barang')
                            ->where('master_barang_id', $barang1)
                            ->orwhere('master_barang_id', $barang2)
                            ->get();
         

        } else {
            $transaksi = TransaksiPembelian::latest()->get();
        }
        
        return view('transaksi-cari/kombinasi', compact('transaksi','barang','barang1','barang2'));
    }
}
