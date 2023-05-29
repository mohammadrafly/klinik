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

        $data = $this->request->getRawInput();

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
        $data = $this->request->getRawInput();

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
