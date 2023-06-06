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

        $data = [
            'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => $this->request->getVar('role'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
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
        $model = new UsersModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }
        $data = [
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getVar('email'),
            'name' => $this->request->getVar('name'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => $this->request->getVar('role'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
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
        $model = new UsersModel();
        $model->where('id', $id)->delete($id);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Operasi berhasil'
        ]);
    }
}
