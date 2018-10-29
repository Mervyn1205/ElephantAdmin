<?php

use think\migration\Migrator;
use think\migration\db\Column;
use \Phinx\Db\Adapter\MysqlAdapter;

class CreateMenuTable extends Migrator {

    public function up() {
        $table = $this->table('menu', ['collation' => 'utf8mb4_general_ci']);
        $table->addColumn('name', 'string', ['limit' => 32, 'comment' => '菜单名称'])
              ->addColumn('route', 'string', ['limit' => 128, 'default' => '', 'comment' => ''])
              ->addColumn('params', 'string', ['limit' => 128, 'default' => '', 'comment' => ''])
              ->addColumn('parent_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '父节点'])
              ->addColumn('status', 'integer', [
                  'limit'   => MysqlAdapter::INT_TINY,
                  'default' => 1,
                  'comment' => '状态, 1 正常， 0 禁用',
              ])
              ->addColumn('is_active', 'integer', [
                  'limit'   => MysqlAdapter::INT_TINY,
                  'default' => 0,
                  'comment' => '是否默认选中状态, 1 是， 0 否',
              ])
              ->addColumn('sort', 'integer', ['length' => 11, 'default' => 0, 'comment' => '排序'])
              ->addColumn('created_at', 'integer', ['length' => 11])
              ->addColumn('updated_at', 'integer', ['length' => 11])
              ->create();

        $this->initData();
    }

    public function initData() {
        $data = [
            ['id' => 1, 'parent_id' => 0, 'name' => '个人面板', 'route' => '/dashboard', 'is_active' => 1],
            ['id' => 2, 'parent_id' => 1, 'name' => '个人信息', 'route' => '/dashboard'],
            ['id' => 3, 'parent_id' => 2, 'name' => '面板', 'route' => '/dashboard'],
            ['id' => 4, 'parent_id' => 2, 'name' => '修改密码', 'route' => '/account/edit'],

            ['id' => 5, 'parent_id' => 0, 'name' => '设置', 'route' => ''],
            ['id' => 7, 'parent_id' => 5, 'name' => '系统设置', 'route' => ''],
            ['id' => 8, 'parent_id' => 7, 'name' => '网站设置', 'route' => ''],
            ['id' => 9, 'parent_id' => 5, 'name' => '管理员设置', 'route' => ''],
            ['id' => 10, 'parent_id' => 9, 'name' => '角色管理', 'route' => ''],
            ['id' => 11, 'parent_id' => 9, 'name' => '管理员', 'route' => '/manager'],
        ];

        foreach ($data as $key => $row) {
            $data[$key]['created_at'] = time();
            $data[$key]['updated_at'] = time();
        }

        $this->table('menu')->insert($data)->save();
    }

    public function down() {
        $this->table('menu')->drop();
    }
}
