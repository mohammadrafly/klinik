<?php

namespace App\Controllers;

use App\Models\Antrian;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function konsultasi()
    {
        $model = new UsersModel();
        return view('pages/home/konsultasi', [
            'users' => $model->where('id !=', session()->get('id'))->findAll(),
        ]);
    }

    public function index()
    {
        return view('pages/home/index');
    }

    public function antrianOnline()
    {
        $model = new Antrian();
        $currentQueue = $model->getLastQueueNumberByStatus('dalam_pemeriksaan');

        if ($currentQueue === null) {
            $currentQueue = "0";
        }
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/home/antrianHome', [
                'currentQueue' => $currentQueue,
                'antrianSaya' => $model->getQueueByKodePasien(session()->get('kode_user'))
            ]);
            dd();
        }

        // Periksa apakah pengguna sudah memiliki antrian sebelumnya
        $existingQueue = $model->getQueueByKodePasien(session()->get('kode_user'));
        if (!empty($existingQueue)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Anda sudah memiliki antrian sebelumnya'
            ]);
        }

        $data = [
            'kode_pasien' => session()->get('kode_user'),
            'status' => 'antri',
            'type_antrian' => 'online',
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
            'nomor_antrian' => $model->getLastQueueNumber() + 1,
        ];
        $model->insert($data);

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Sukses!',
            'message' => 'Berhasil melakukan pengambilan antrian online'
        ]);
    }
}
