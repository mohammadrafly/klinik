<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tindakan extends Migration
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
            'kode_tindakan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_tindakan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => null,
            ],
            'harga' => [
                'type'       => 'VARCHAR',
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
        $this->forge->createTable('tindakan');
    }

    public function down()
    {
        $this->forge->dropTable('tindakan');
    }
}
