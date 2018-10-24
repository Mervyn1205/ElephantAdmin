<?php

use think\migration\Migrator;
use think\migration\db\Column;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateManagerTable extends Migrator {
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
        $table = $this->table('manager');
        $table->addColumn('username', 'string', ['limit' => 32])
              ->addColumn('password', 'string', ['limit' => 32])
              ->addColumn('salt', 'string', ['limit' => 6, 'default' => ''])
              ->addColumn('last_login_time', 'integer', ['length' => 11, 'default' => 0])
              ->addColumn('last_login_ip', 'string', ['limit' => 32, 'default' => ''])
              ->addColumn('status', 'integer', ['limit'   => MysqlAdapter::INT_TINY, 'default' => 1, 'comment' => '1 正常 0 禁用'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $salt = randomStr(6);
        $table->insert([
            'username'   => 'admin',
            'password'   => generatePassword('admin', $salt),
            'salt'       => $salt,
            'created_at' => time(),
            'updated_at' => time(),
        ])->save();
    }
}
