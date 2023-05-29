<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Obats extends Seeder
{
    public function run()
    {
        $prefix = 'OBT';
        $randomNumber = $prefix . mt_rand(000000, 999999) . uniqid();
        $data = [
            [
                'kode_obat' => $randomNumber,
                'nama' => 'Obat Batuk',
                'deskripsi' => 'obat untuk mengobati batuk',
                'stok' => '10',
                'harga' => '12000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'kode_obat' => $randomNumber,
                'nama' => 'Obat Sakit Kepala',
                'deskripsi' => 'obat untuk mengobati sakit kepala',
                'stok' => '20',
                'harga' => '10000',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ];
        $this->db->table('obat')->insertBatch($data);
    }
}
