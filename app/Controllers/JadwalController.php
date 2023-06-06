<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class JadwalController extends BaseController
{
    private $openingHoursFilePath = WRITEPATH . 'openingHours.json';

    public function index()
    {
        $openingHours = $this->getOpeningHours();
        return view('pages/dashboard/jadwalDashboard', [
            'openingHours' => $openingHours,
            'title' => 'Atur Jadwal'
        ]);
    }

    public function update($day)
    {
        $jsonFile = WRITEPATH . 'openingHours.json';
    
        if ($this->request->getMethod(true) !== 'POST') {
            $openingHours = $this->getOpeningHoursFromFile($jsonFile);
            $openingHour = $openingHours[$day] ?? null;
            return $this->response->setJSON(['day' => $day, 'openingHour' => $openingHour]);
        }
    
        $startTime = $this->request->getVar('start_time');
        $endTime = $this->request->getVar('end_time');
    
        $openingHours = $this->getOpeningHoursFromFile($jsonFile);
        $openingHours[$day] = [
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
    
        $this->saveOpeningHoursToFile($jsonFile, $openingHours);
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Sukses!',
            'text' => 'Berhasil Update'
        ]);
    }
    
    private function getOpeningHoursFromFile($jsonFile)
    {
        $jsonData = file_get_contents($jsonFile);
        return json_decode($jsonData, true);
    }
    
    private function saveOpeningHoursToFile($jsonFile, $openingHours)
    {
        $jsonData = json_encode($openingHours, JSON_PRETTY_PRINT);
        file_put_contents($jsonFile, $jsonData);
    }
    

    private function getOpeningHours()
    {
        if (!file_exists($this->openingHoursFilePath)) {
            return [];
        }

        $openingHoursJson = file_get_contents($this->openingHoursFilePath);
        return json_decode($openingHoursJson, true);
    }
}
