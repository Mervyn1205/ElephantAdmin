<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018/10/18
 */

namespace app\admin\controller\auth;

use think\Controller;

class LoginController extends Controller {

    public function showLoginForm() {
        return $this->fetch();
    }
}