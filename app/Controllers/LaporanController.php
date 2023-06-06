<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\KunjunganModel;

class LaporanController extends BaseController
{
    public function index()
    {
        $model = new KunjunganModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/dashboard/laporanDashboard',[
            //dd([
                'title' => 'Laporan Keuangan & Transaksi',
                'content' => $model->findAllAssociate(),
            ]);
        }
    }

    public function export($start, $end)
    {
        $model = new KunjunganModel();
        $dataUser = $model->findDataInBetween($start, $end);
        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Kode Kunjungan')
                    ->setCellValue('B1', 'Nama Obat')
                    ->setCellValue('C1', 'Harga')
                    ->setCellValue('D1', 'Jumlah Obat')
                    ->setCellValue('E1', 'Total')
                    ->setCellValue('F1', 'Dibuat Tanggal');
        
        $column = 2;
        // tulis data mobil ke cell
        foreach($dataUser as $data) {
            $total = $data['harga'] * $data['quantity'];
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $data['kode_kunjungan'])
                        ->setCellValue('B' . $column, $data['nama'])
                        ->setCellValue('C' . $column, $data['harga'])
                        ->setCellValue('D' . $column, $data['quantity'])
                        ->setCellValue('E' . $column, $total)
                        ->setCellValue('F' . $column, $data['created_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan Keuangan '. $start . ' - ' . $end ;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
}
