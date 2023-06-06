<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Antrian;
use App\Models\UsersModel;

class AntrianController extends BaseController
{
    public function getAntrian($id) 
    {
        $model = new Antrian();
        return $this->response->setJSON($model->getDetails($id));
    }

    public function index()
    {
        $model = new Antrian();
        $modelUser = new UsersModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/dashboard/antrianDashboard',[
                'title' => 'Antrian',
                'pasien' => $modelUser->where('role', 'pasien')->findAll(),
                'content' => $model->where('created_at', date('Y-m-d'))->where('status', 'antri')->orderBy('nomor_antrian', 'ASC')->findAll(),
            ]);
        }

        $pasien = $this->request->getVar('kode_user');

        if ($pasien != 'tambah_pasien' && $pasien != 'pilih_pasien') {
            $dataAntrian = [
                'kode_pasien' => $pasien,
                'status' => 'antri',
                'type_antrian' => 'offline',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
                'nomor_antrian' => $model->getLastQueueNumber() + 1,
            ];
            $model->insert($dataAntrian);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Sukses!',
                'message' => 'Berhasil membuat antrian dan pasien'
            ]);
        } elseif ($pasien == 'tambah_pasien') {
            $data = [
                'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
                'name' => $this->request->getVar('name'),
                'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                'nomor_hp' => $this->request->getVar('nomor_hp'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'alamat' => $this->request->getVar('alamat'),
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ];
    
            if ($modelUser->insert($data)) {
                $dataAntrian = [
                    'kode_pasien' => $data['kode_user'],
                    'status' => 'antri',
                    'type_antrian' => 'offline',
                    'created_at' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d'),
                    'nomor_antrian' => $model->getLastQueueNumber() + 1,
                ];
                $model->insert($dataAntrian);
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Sukses!',
                    'message' => 'Berhasil membuat antrian dan pasien'
                ]);
            }
    
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'message' => 'Terjadi Error!'
            ]);
        }
    }

    public function detail($id) 
    {
        $model = new Antrian();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'status' => $this->request->getVar('status')
        ];

        if ($model->update($id, $data)) {
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Sukses!',
                'message' => 'Berhasil update antrian'
            ]);
        }
    }
}
