<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Records extends Migration
{
    public function up()
    {
        $this->forge->addField([
             'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constrain' => 50,
            ]
        ]);
         $this->forge->addKey('id', true);
         $this->forge->createTable('users');         
    }

    public function down()
    {
        $this->forge->dropTable('users');        
    }
}
