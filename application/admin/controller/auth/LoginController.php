<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018/10/18
 */

namespace app\admin\controller\auth;

use app\admin\model\Manager;
use app\admin\controller\BaseController;
use think\Request;

class LoginController extends BaseController {

    protected $middleware = [
    ];

    public function showLoginForm(Request $request) {
        return $this->fetch();
    }

    public function login(Request $request) {
        $username = input("post.username");
        $password = input("post.password");

        $manager = Manager::getInstance();
        $user    = $manager->where('username', $username)->find();

        if (empty($user) || generatePassword($password, $user->salt) != $user->password) {
            return $this->_ajaxReturn(10001, "用户名或密码有误");
        }

        $userInfo = $user->toArray();
        unset($userInfo['password']);
        session("admin", $userInfo);

        $user->last_login_time = time();
        $user->last_login_ip   = $request->ip();
        $user->save();

        $data = [
            'homePage' => '/',
        ];
        return $this->_ajaxReturn(0, '', $data);
    }
}