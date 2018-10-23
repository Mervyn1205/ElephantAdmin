<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateRolePermissionsTable extends Migrator {
    /**
     * Change Method.
     * Write your reversible migrations using this method.
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change() {
        $table = $this->table('permission', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('label', 'string', ['limit' => 32, 'comment' => '权限标识'])
              ->addColumn('name', 'string', ['limit' => 64, 'default' => '',])
              ->addColumn('method', 'enum', [
                  'values'  => [
                      'ANY',
                      'GET',
                      'POST',
                      'PUT',
                      'DELETE',
                      'PATCH',
                      'OPTIONS',
                      'HEAD',
                  ],
                  'default' => 'ANY',
              ])
              ->addColumn('url', 'string', ['limit' => 128, 'default' => '*'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $table = $this->table('role', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('label', 'string', ['limit' => 32, 'comment' => '角色标识'])
              ->addColumn('name', 'string', ['limit' => 64, 'default' => '', 'comment' => '角色名称'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $table = $this->table('role_permissions', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('role_id', 'string', ['limit' => 32, 'comment' => '角色标识'])
              ->addColumn('permission_id', 'string', ['limit' => 64, 'default' => '', 'comment' => '角色名称'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $table = $this->table('user_roles', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('uid', 'string', ['limit' => 32, 'comment' => '角色标识'])
              ->addColumn('role_id', 'string', ['limit' => 64, 'default' => '', 'comment' => '角色名称'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $table = $this->table('user_permissions', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('uid', 'string', ['limit' => 32, 'comment' => '角色标识'])
              ->addColumn('permission_id', 'string', ['limit' => 64, 'default' => '', 'comment' => '角色名称'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();
    }
}
