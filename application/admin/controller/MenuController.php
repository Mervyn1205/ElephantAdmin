<?php
/**
 * @author    Mervyn<tangtz@wondershare.cn>
 * @version   1.0
 * @copyright 2018@wondershare.com
 */

namespace app\admin\controller;


use app\admin\logic\MenuLogic;
use think\Request;

class MenuController extends BaseController {

    public function index() {
        $this->assign('user', $this->_user);
        return $this->fetch();
    }

    public function getLeft(Request $request) {
        $pid = $request->route('pid');
        $menuLogic = MenuLogic::getInstance();
        $activeMenu = $menuLogic->getLeftMenu($pid);

        return $this->_ajaxReturn(200, "", $activeMenu);
    }
}