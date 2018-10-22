<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018/10/18
 */

namespace app\admin\controller\auth;

use app\admin\model\Manager;
use app\admin\controller\BaseController;

class LoginController extends BaseController {

    public function showLoginForm() {
        return $this->fetch();
    }

    public function login() {
        $username = input("post.username");
        $password = input("post.password");

        $manager = Manager::getInstance();
        $user = $manager->where('username', $username)->find();

        if (empty($user) || generatePassword($password, $user->salt) != $user->password) {
            return $this->_ajaxReturn(10001, "用户名或密码有误");
        }

        $userInfo = $user->toArray();

        $roles            = RoleUser::where(['uid' => $userInfo['id']])->select()->toArray();
        $roleIdArr        = array_column($roles, 'role_id');
        $userInfo['role'] = $roleIdArr;

        unset($userInfo['password']);
        session("_userInfo.admin", $userInfo);

        $user->last_login_time = time();
        $user->last_login_ip   = request()->ip();

        $user->save();

        $data = [
            'homePage' => $this->_homePage,
        ];
        return $this->_ajaxReturn(0, '', $data);
    }
}