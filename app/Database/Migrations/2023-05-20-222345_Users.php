<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'kode_user' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'usia' => [
                'type'      => 'VARCHAR',
                'constraint'=> '255',
            ],
            'nomor_hp' => [
                'type'  => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kelamin' => [ 
                'type' => 'ENUM("laki-laki", "perempuan")',
                'default' => 'laki-laki',
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'role' => [
                'type' => 'ENUM("dokter","admin","pasien","resepsionis")',
                'default' => 'pasien',
                'null' => false,
            ],
            'created_at' => [
                'type'    => 'DATE',
            ],
            'updated_at' => [
                'type'    => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
