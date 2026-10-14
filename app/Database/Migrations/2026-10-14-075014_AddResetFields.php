<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class AddResetFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'reset_token'   => ['type' => 'VARCHAR', 'constraint' => 64, 'null' => true],
            'reset_expires' => ['type' => 'DATETIME', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['reset_token', 'reset_expires']);
    }
}