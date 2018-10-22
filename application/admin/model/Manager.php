<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018-10-22
 */

namespace app\admin\model;

use app\common\model\BaseModel;
use app\common\traits\SingletonTrait;

class Manager extends BaseModel {

    use SingletonTrait;

    protected $connection = 'admin';



}