<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TindakanModel;

class TindakanController extends BaseController
{
    public function index()
    {
        $model = new TindakanModel();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Data Tindakan'
            ];
            return view('pages/dashboard/tindakanDashboard', $data);
        }

        $data = [
            'kode_tindakan' => 'TDK'. mt_rand(000000, 999999) . uniqid(),
            'nama_tindakan' => $this->request->getVar('nama_tindakan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga' => $this->request->getVar('harga'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];

        if (!$model->insert($data)) {
            $response = [
                'status' => false,
                'message' => 'Operasi gagal'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Operasi berhasil'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function update($id)
    {
        $model = new TindakanModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }
        $data = [
            'nama_tindakan' => $this->request->getVar('nama_tindakan'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga' => $this->request->getVar('harga'),
            'updated_at' => date('Y-m-d'),
        ];

        if (!$model->update($id, $data)) {
            $response = [
                'status' => false,
                'message' => 'Operasi gagal'
            ];
        } else {
            $response = [
                'status' => true,
                'message' => 'Operasi berhasil'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function delete($id)
    {
        $model = new TindakanModel();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Operasi berhasil'
        ]);
    }
}
