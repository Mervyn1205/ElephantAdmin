<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 生成静态资源对应的url
 */
function asset($url) {
    return url($url, '', false);
}


/**
 * 随机字符串
 *
 * @param $length integer
 */
function randomStr ($length = 6, $type = 3)
{
    switch ($type) {
        case 1:
            $chars = "0123456789";
            break;
        case 2:
            $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
            break;
        case 3:
        default:
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
    }
    $hash = "";
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i ++) {
        $hash .= $chars[mt_rand(0, $max)];
    }

    return $hash;
}


/**
 * 生成密文密码串
 *
 *@param string $rawPassword 明文密码
 *@param string $salt 随机密码串
 *@return string 32密文密码
 */
function generatePassword($rawPassword, $salt = ''){
    return md5(md5($rawPassword) . $salt);
}

/**
 * 对url安全的base64编码
 * @param  string $input
 * @return string
 */
function base64_url_encode($input) {
    return str_replace(array('+','/','='),array('-','_',''), base64_encode($input));
}

/**
 * 对url安全的base64解码
 * @param  [type] $input [description]
 * @return [type]        [description]
 */
function base64_url_decode($input) {
    $data = str_replace(array('-','_'),array('+','/'),$input);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }

    return base64_decode($data);
}
