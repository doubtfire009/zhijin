<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *  check_function_helper.php 核查函数库
 *
 * @author 李之玉 <hn.lizhiyu@163.com>
 */

//检查是否登录或是否传递POST
function _public_check($var,$path){
        if(!isset($var)){
            redirect($path);
        }
        
    }