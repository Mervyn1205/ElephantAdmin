<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018/10/21
 */

namespace app\admin\controller;

use think\Controller;

class BaseController extends Controller {

    protected $_user = [];

    protected $middleware = ['CheckLogin'];

    protected $beforeActionList = [
        'getUser' ,
    ];

    /**
     * return json
     */
    protected function _ajaxReturn($code = 0, $msg = '', $data = []) {
        $data = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return json($data);
    }

    protected function getUser() {
        $session = session('admin');
        if (!$session) {
            return [];
        }

        $this->_user = $session;
    }
}