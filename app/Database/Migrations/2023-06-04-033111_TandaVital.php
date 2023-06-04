<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TandaVital extends Migration
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
            'tekanan_darah' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'suhu_badan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'pernapasan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'berat_badan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tinggi_badan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'    => 'DATE',
            ],
            'updated_at' => [
                'type'    => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tandavital');
    }

    public function down()
    {
        $this->forge->dropTable('tandavital');
    }
}
