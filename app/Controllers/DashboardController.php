<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;
use App\Models\UsersModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $modelObat = new ObatModel();
        $modelUser = new UsersModel();
        $data = [
            'title' => 'Dashboard',
            'total_obat' => $modelObat->countAllResults(),
            'total_user' => $modelUser->countAllResults(),
        ];
        return view('pages/dashboard/index', $data);
    }

    public function Logout()
    {
        session()->destroy();
        return $this->response->setJSON([
            'success' => TRUE,
            'message' => 'Logout Berhasil',
        ]);
    }
}
