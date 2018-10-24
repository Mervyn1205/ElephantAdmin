<?php
/**
 * @author    Mervyn<tangtz@wondershare.cn>
 * @version   1.0
 * @copyright 2018@wondershare.com
 */

namespace app\admin\controller;

use app\admin\logic\MenuLogic;

class IndexController extends BaseController {

    public function index() {
        $menuLogic = MenuLogic::getInstance();
        list($activeModule, $modules) = $menuLogic->getTopMenu();
        $activeMenu = $menuLogic->getLeftMenu($activeModule['id']);

        $this->assign([
            'modules'    => $modules,
            'activeMenu' => $activeMenu,
            'user'       => $this->_user,
        ]);

        return $this->fetch();
    }
}