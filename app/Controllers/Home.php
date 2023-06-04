<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('pages/home/index');
    }

    public function antrianOnline()
    {
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/home/antrianHome');
        }
    }
}
