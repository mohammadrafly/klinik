<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Antrian;

class TransaksiController extends BaseController
{
    public function index()
    {
        $model = new Antrian();
        return view('pages/dashboard/transaksiDashboard', [
        //dd([
            'title' => 'Transaksi Pembayaran',
            'content' => $model->getForPembayaran(),
        ]);
    }

    public function getTransaksi($kode)
    {
        $model = new Antrian();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->getForPembayaranByKode($kode));
        }

        $id = $model->where('kode_kunjungan', $kode)->first();
        $model->update($id['id'], ['status' => 'selesai']);
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Sukses!',
            'message' => 'Berhasil melakukan pembayaran'
        ]);
    }
}
