<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AuthController extends BaseController
{
    function setUserInfo($data)
    {
        return session()->set([
            'isLoggedIn' => true,
            'kode_user' => $data[0]['kode_user'],
            'username' => $data[0]['username'],
            'email' => $data[0]['email'],
            'password' => $data[0]['password'],
            'name' => $data[0]['name'],
            'nomor_hp' => $data[0]['nomor_hp'],
            'jenis_kelamin' => $data[0]['jenis_kelamin'],
            'tanggal_lahir' => $data[0]['tanggal_lahir'],
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
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Email atau username tidak ditemukan',
                
            ]);
        }

        if (password_verify($password, $checkpoint[0]['password'])) {
            $this->setUserInfo($checkpoint);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Sukses!',
                'message' => 'Berhasil login',
                'role' => $checkpoint[0]['role']
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
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
            'nomor_hp' => $this->request->getVar('nomor_hp'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];

        if ($model->isUserExist($data['email'])) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Email telah dipakai',
            ]);
        }

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Gagal melakukan pendaftaran'
            ]);
        } else {
            $this->setUserInfo($data);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Sukses!',
                'message' => 'Berhasil melakukan pendaftaran'
            ]);
        }
    }
}
