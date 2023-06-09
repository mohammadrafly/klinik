<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;

class ObatsController extends BaseController
{
    public function index()
    {
        $model = new ObatModel();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Data Obat'
            ];
            return view('pages/dashboard/obatsDashboard', $data);
        }

        $data = [
            'kode_obat' => 'OBT'. mt_rand(000000, 999999) . uniqid(),
            'nama' => $this->request->getVar('nama'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'stok' => $this->request->getVar('stok'),
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
        $model = new ObatModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }
        $data = [
            'nama' => $this->request->getVar('nama'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'stok' => $this->request->getVar('stok'),
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
        $model = new ObatModel();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Operasi berhasil'
        ]);
    }
}
