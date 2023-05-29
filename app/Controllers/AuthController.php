<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{
    function setUserInfo($data)
    {
        return session()->set([
            'isLoggedIn' => TRUE,
            'kode_user' => $data[0]['kode_user'],
            'username' => $data[0]['username'],
            'email' => $data[0]['email'],
            'password' => $data[0]['password'],
            'name' => $data[0]['name'],
            'alamat' => $data[0]['alamat'],
            'role' => $data[0]['role'],
            'created_at' => $data[0]['created_at'],
        ]);
    }

    public function SignIn()
    {
        $model = new UsersModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/Login');
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $checkpoint = $model->isUserExist($email);
        if (!$checkpoint) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Email atau username tidak ditemukan',
                
            ]);
        }

        if (password_verify($password, $checkpoint[0]['password'])) {
            $this->setUserInfo($checkpoint);
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Berhasil login'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal login',
            ]);
        }
    }

    public function SignUp()
    {
        $model = new UsersModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/auth/Register');
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'role' => 'pasien',
            'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];

        if ($model->isUserExist($data['email'])) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Email telah dipakai',
            ]);
        }

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Gagal melakukan pendaftaran'
            ]);
        } else {
            $this->setUserInfo($data);
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Berhasil melakukan pendaftaran'
            ]);
        }
    }
}
