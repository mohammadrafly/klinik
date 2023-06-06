<?php

namespace App\Controllers;

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
        //Export Excel
    }
}
