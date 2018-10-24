<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018/10/18
 */

namespace app\admin\controller;

use app\admin\model\Manager;
use think\Request;

class AuthController extends BaseController {

    protected $middleware = [];

    public function showLoginForm() {
        return $this->fetch();
    }

    public function login(Request $request) {
        $username = $request->post('username');
        $password = $request->post('password');

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

    public function logout() {
        session(null);
        return redirect(url('/login'));
    }
}