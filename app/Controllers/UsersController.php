<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    public function index()
    {
        $model = new UsersModel();
        if ($this->request->getMethod(true) !== 'POST') {
            $data = [
                'content' => $model->findAll(),
                'title' => 'Data User'
            ];
            return view('pages/dashboard/usersDashboard', $data);
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
        $model = new UsersModel();
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
        $model = new UsersModel();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Operasi berhasil'
        ]);
    }
}
