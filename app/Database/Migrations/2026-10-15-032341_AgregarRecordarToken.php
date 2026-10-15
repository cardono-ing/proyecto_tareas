<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class AgregarRecordarToken extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'remember_token' => ['type' => 'VARCHAR', 'constraint' => 64, 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'remember_token');
    }
}