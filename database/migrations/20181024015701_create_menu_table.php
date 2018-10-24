<?php

use think\migration\Migrator;
use think\migration\db\Column;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateMenuTable extends Migrator {
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

        $table = $this->table('menu', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('name', 'string', ['limit' => 32, 'comment' => '菜单名称'])
              ->addColumn('route', 'string', ['limit' => 128, 'default' => '', 'comment' => ''])
              ->addColumn('params', 'string', ['limit' => 128, 'default' => '', 'comment' => ''])
              ->addColumn('parent_id', 'string', ['limit' => 64, 'default' => '', 'comment' => '父节点'])
              ->addColumn('status', 'integer', ['limit'   => MysqlAdapter::INT_TINY,
                                                'default' => 1,
                                                'comment' => '状态, 1 正常， 0 禁用',
              ])
              ->addColumn('is_active', 'integer', ['limit'   => MysqlAdapter::INT_TINY,
                                                   'default' => 1,
                                                   'comment' => '状态, 1 正常， 0 禁用',
              ])
              ->addColumn('sort', 'integer', ['length' => 11, 'default' => 0, 'comment' => '排序'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $data = [
            [
                'name'       => '个人面板',
                'route'      => '/dashboard',
                'params'     => '',
                'parent_id'  => 0,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            [
                'name'       => '设置',
                'route'      => '',
                'params'     => '',
                'parent_id'  => 0,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
            [
                'name'       => '内容',
                'route'      => '/dashboard',
                'params'     => '',
                'parent_id'  => 0,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],

            [
                'name'       => '个人信息',
                'route'      => '/dashboard',
                'params'     => '',
                'parent_id'  => 1,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],

            [
                'name'       => '面板',
                'route'      => '/dashboard',
                'params'     => '',
                'parent_id'  => 4,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 1,
                'created_at' => time(),
                'updated_at' => time(),
            ],

            [
                'name'       => '修改密码',
                'route'      => '/account/edit',
                'params'     => '',
                'parent_id'  => 4,
                'sort'       => 0,
                'status'     => 1,
                'is_active'  => 0,
                'created_at' => time(),
                'updated_at' => time(),
            ],
        ];
        $table->insert($data)->save();
    }
}
