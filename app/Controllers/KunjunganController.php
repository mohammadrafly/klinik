<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Antrian;
use App\Models\ItemModel;
use App\Models\KunjunganModel;
use App\Models\ObatModel;
use App\Models\TandaVital;
use App\Models\TindakanModel;
use App\Models\UsersModel;

class KunjunganController extends BaseController
{
    public function index()
    {
        $model = new KunjunganModel();
        $modelAntrian = new Antrian();
        $modelObat = new ObatModel();
        $modelUsers = new UsersModel();
        $modelVital = new TandaVital();
        $modelTindakan = new TindakanModel();
        if ($this->request->getMethod(true) !== 'POST') {
            return view('pages/dashboard/kunjunganDashboard', [
            //dd([  
                'title' => 'Kunjungan',
                'content' => $modelAntrian
                    ->where('created_at', date('Y-m-d'))
                    ->where('status', 'dalam_pemeriksaan')
                    ->orWhere('status', 'tindakan')
                    ->orderBy('nomor_antrian', 'ASC')
                    ->findAll(),
                'obat' => $modelObat->findAll(),
                'tindakan' => $modelTindakan->findAll(),
                'dokter' => $modelUsers->where('role', 'dokter')->findAll(),
            ]);
        }

        $kode = 'KNJ' . mt_rand(0000000, 9999999) . uniqid();
        $data = [
            'id' => $this->request->getVar('id'),
            'kode_kunjungan' => $kode,
            'kode_pasien' => $this->request->getVar('kode_pasien'),
            'kode_dokter' => $this->request->getVar('kode_dokter'),
            'kode_pembayaran' => $this->request->getVar('kode_pembayaran'),
            'keluhan_utama' => $this->request->getVar('keluhan_utama'),
            'riwayat_penyakit_sekarang' => $this->request->getVar('riwayat_penyakit_sekarang'),
            'riwayat_penyakit_dahulu' => $this->request->getVar('riwayat_penyakit_dahulu'),
            'keadaan_umum_pasien' => $this->request->getVar('keadaan_umum_pasien'),
            'keterangan_penunjang' => $this->request->getVar('keterangan_penunjang'),
            'diagnosa' => $this->request->getVar('diagnosa'),
            'tindakan' => $this->request->getVar('tindakan'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];
        
        //dd($data['id']);
        $dataVital = [
            'kode_kunjungan' => $kode,
            'tekanan_darah' => $this->request->getVar('tekanan_darah'),
            'nadi' => $this->request->getVar('nadi'),
            'suhu_badan' => $this->request->getVar('suhu_badan'),
            'pernapasan' => $this->request->getVar('pernapasan'),
            'berat_badan' => $this->request->getVar('berat_badan'),
            'tinggi_badan' => $this->request->getVar('tinggi_badan'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];

        $updatedAntrian = [
            'kode_kunjungan' => $kode,
        ];
        if ($modelAntrian->update($data['id'], $updatedAntrian)) {
            if ($model->insert($data)) {
                $modelVital->insert($dataVital);
                return $this->response->setJSON([
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Sukses!',
                    'message' => 'Berhasil membuat kunjungan'
                ]);
            }
        }
    }

    public function tambahResep()
    {
        $model = new ItemModel();
        $modelObat = new ObatModel();
        $modelAntrian = new Antrian();
        $kode_obat = $this->request->getVar('kode_obat[]');
        $quantity = $this->request->getVar('quantity[]');
        $dosis = $this->request->getVar('dosis[]');
        $currentDate = date('Y-m-d');
    
        $count = count($kode_obat);
        $updateErrors = [];
    
        // Update the stock and the antrian status first
        $kode_kunjungan = $this->request->getVar('kode_kunjungan');
        $antrian = $modelAntrian->where('kode_kunjungan', $kode_kunjungan)->first();
        if ($antrian) {
            $this->updateStock($modelObat, $kode_obat, $quantity, $updateErrors);
            $this->updateAntrianStatus($modelAntrian, $antrian['id'], $currentDate);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Data antrian tidak ditemukan',
            ]);
        }
    
        // Insert the items into the database
        for ($i = 0; $i < $count; $i++) {
            $data = [
                'kode_kunjungan' => $kode_kunjungan,
                'kode_obat' => $kode_obat[$i],
                'quantity' => $quantity[$i],
                'dosis' => $dosis[$i],
                'created_at' => $currentDate,
                'updated_at' => $currentDate,
            ];
    
            $model->insert($data);
        }
    
        if (!empty($updateErrors)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Gagal mengupdate stok obat',
                'failedUpdates' => $updateErrors
            ]);
        }
    
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Sukses!',
            'message' => 'Berhasil membuat resep'
        ]);
    }

    
    private function updateStock($modelObat, $kode_obat, $quantity, &$updateErrors)
    {
        for ($i = 0; $i < count($kode_obat); $i++) {
            $obat = $modelObat->where('kode_obat', $kode_obat[$i])->first();
            if ($obat) {
                $newStock = $obat['stok'] - $quantity[$i];
                $updateResult = $modelObat->update($obat['id'], ['stok' => $newStock]);
                if (!$updateResult) {
                    $updateErrors[] = $kode_obat[$i];
                }
            }
        }
    }    
    
    private function updateAntrianStatus($modelAntrian, $antrianId, $currentDate)
    {
        $updateResult = $modelAntrian->update($antrianId, [
            'status' => 'pembayaran',
            'updated_at' => $currentDate,
        ]);
        return $updateResult;
    }    
}
