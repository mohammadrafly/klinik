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
            'kode_user' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'kode_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => null,
            ],
            'type_antrian' => [
                'type' => 'ENUM("offline","online")',
                'default' => 'online',
                'null' => false,
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
