<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 150],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'image'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'active'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'is_admin'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'token'      => ['type' => 'VARCHAR', 'constraint' => 64, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}