<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018-10-24
 */

namespace app\admin\model;

use app\common\model\BaseModel as CommonBaseModel;

class BaseModel extends CommonBaseModel {

    protected $connection = 'admin';
}