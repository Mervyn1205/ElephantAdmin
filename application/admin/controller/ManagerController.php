<?php

namespace app\admin\controller;

use app\admin\model\Manager;
use think\Controller;
use think\Request;

class ManagerController extends Controller {
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request) {
        $limit = 10;
        $page  = $request->get("page", 1, 'intval');

        $manager  = Manager::getInstance();
        $managers = $manager->page($page, $limit)->select();
        $count    = $manager->count();

        $this->assign([
            'managers' => $managers,
            'page'     => $page,
            'limit'    => $limit,
            'count'    => $count,
        ]);

        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create() {
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     *
     * @return \think\Response
     */
    public function save(Request $request) {
        $username        = $request->post('username');
        $password        = $request->post('password');
        $confirmPassword = $request->post('confirm_password');
        $status          = $request->post('status');

        if ($password != $confirmPassword) {
            $this->error("密码不一致");
        }

        $manager = Manager::getInstance()->where('username', $username)->find();
        if (!empty($manager)) {
            $this->error("用户已存在");
        }

        $salt = randomStr();
        $data = [
            'username'   => $username,
            'password'   => generatePassword($password, $salt),
            'salt'       => $salt,
            'status'     => $status,
            'created_at' => time(),
            'updated_at' => time(),
        ];
        Manager::getInstance()->insert($data);

        $this->success('添加成功', '/manager');

    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    public function read($id) {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    public function edit($id) {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int            $id
     *
     * @return \think\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    public function delete($id) {
        //
    }
}
