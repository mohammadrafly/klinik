<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Obat extends Migration
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
            'kode_obat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => null,
            ],
            'stok' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable('obat');
    }

    public function down()
    {
        $this->forge->dropTable('obat');
    }
}
