<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kunjungan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kode_kunjungan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kode_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kode_dokter' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'keluhan_utama' => [
                'type' => 'TEXT',
            ],
            'riwayat_penyakit_sekarang' => [
                'type' => 'TEXT',
            ],
            'riwayat_penyakit_dahulu' => [
                'type' => 'TEXT',
            ],
            'keadaan_umum_pasien' => [
                'type' => 'TEXT',
            ],
            'keterangan_penunjang' => [
                'type' => 'TEXT',
            ],
            'diagnosa' => [
                'type' => 'TEXT',
            ],
            'tindakan' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type'    => 'DATE',
            ],
            'updated_at' => [
                'type'    => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan');
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan');
    }
}
