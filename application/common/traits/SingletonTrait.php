<?php
/**
 * @author  Mervyn<tangtz1205@163.com>
 * @version 1.0
 * @date    2018-10-22
 */
namespace app\common\traits;

trait SingletonTrait {
    protected static $_instances = [];

    /**
     * @return static
     */
    public static function getInstance() {
        $class = get_called_class();
        if (!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class();
        }
        return self::$_instances[$class];
    }
}