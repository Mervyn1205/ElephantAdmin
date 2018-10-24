<?php
/**
 * @author    Mervyn<tangtz@wondershare.cn>
 * @version   1.0
 * @copyright 2018@wondershare.com
 */

namespace app\admin\controller;

use app\admin\model\Manager;
use think\Request;

class AccountController extends BaseController {

    public function edit() {
        $this->assign('user', $this->_user);

        return $this->fetch();
    }

    public function update(Request $request) {
        $password        = $request->post('password');
        $confirmPassword = $request->post('confirm_password');
        if ($password != $confirmPassword) {
            $this->error("密码不一致");
        }

        $manager = Manager::getInstance()->get($this->_user['id']);
        if (empty($manager)) {
            $this->error("找不到对应用户");
        }
        if ($manager->status == 0) {
            $this->error("用户已被禁用");
        }

        $data = [
            'password'   => generatePassword($password, $manager->salt),
            'updated_at' => time(),
        ];
        Manager::getInstance()->where('id', $manager->id)->update($data);

        $this->success("修改成功", url('dashboard'));
    }
}