<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018-10-24
 */

namespace app\admin\logic;

use app\admin\model\Menu;

class MenuLogic extends BaseLogic {

    public function getTopMenu() {
        $where = [
            'status'    => 1,
            'parent_id' => 0,
        ];

        $modules      = Menu::getInstance()->where($where)->order('sort desc')->select()->toArray();
        $activeModule = [];
        foreach($modules as $key => $module) {
            $modules[$key]['url'] = $module['route'].$module['params'];

            if ($module['is_active'] == 1) {
                $activeModule = $modules[$key];
            }
        }

        $activeModule = empty($activeModule) ? $modules[0] : $activeModule;

        return [$activeModule, $modules];
    }

    public function getLeftMenu($pid = 0) {
        return $this->getChildMenu($pid);
    }


    public function getChildMenu($pid = 0) {
        $where = [
            'status'    => 1,
            'parent_id' => $pid,
        ];
        $menus = Menu::getInstance()->where($where)->order('sort desc')->select()->toArray();
        foreach ($menus as $key => $menu) {
            $menus[$key]['url'] = $menu['route'].$menu['params'];

            $menus[$key]['child'] = $this->getChildMenu($menu['id']);
        }

        return $menus;

    }
}