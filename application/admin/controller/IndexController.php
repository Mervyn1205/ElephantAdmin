<?php
/**
 * @author    Mervyn<tangtz@wondershare.cn>
 * @version   1.0
 * @copyright 2018@wondershare.com
 */

namespace app\admin\controller;

class IndexController extends BaseController {

    public function index() {
        $this->assign([
            'modules'    => [],
            'activeMenu' => [],
            'user'       => $this->_user,
        ]);

        return $this->fetch();
    }
}