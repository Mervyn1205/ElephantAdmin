<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018-10-22
 */

namespace app\common\model;

use app\common\traits\SingletonTrait;
use think\Model;

class BaseModel extends Model {

    use SingletonTrait;

    protected $connection = 'admin';
}