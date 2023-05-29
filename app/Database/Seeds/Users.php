<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
                'username' => 'pasien',
                'email' => 'pasien@gmail.com',
                'password' => password_hash('pasien', PASSWORD_DEFAULT),
                'name' => 'pasien',
                'alamat' => 'Jln Pasien',
                'role' => 'pasien',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'name' => 'admin',
                'alamat' => 'Jln Admin',
                'role' => 'admin',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
                'username' => 'dokter',
                'email' => 'dokter@gmail.com',
                'password' => password_hash('dokter', PASSWORD_DEFAULT),
                'name' => 'dokter',
                'alamat' => 'Jln Dokter',
                'role' => 'dokter',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ],
            [
                'kode_user' => 'USR'. mt_rand(000000, 999999) . uniqid(),
                'username' => 'resepsionis',
                'email' => 'resepsionis@gmail.com',
                'password' => password_hash('resepsionis', PASSWORD_DEFAULT),
                'name' => 'resepsionis',
                'alamat' => 'resepsionis',
                'role' => 'resepsionis',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d'),
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
