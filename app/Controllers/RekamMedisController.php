<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KunjunganModel;

class RekamMedisController extends BaseController
{
    public function index()
    {
        $model = new KunjunganModel();
        return view('pages/dashboard/rekamMedis', [
            'title' => 'Rekam Medis',
            'content' => $model->getRekamMedis(),
        ]);
    }
}
