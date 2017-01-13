<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 *  global_function_helper.php 公共函数库
 *
 * @author 李之玉 <hn.lizhiyu@163.com>
 */

/**
 * 检查身份证是否合法
 *

 *
 * @author lzy hn.lizhiyu@163.com
 */

function ID_No_check_flag($ID_No){
    $userID_preg = "/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/";
    $flag = preg_match($userID_preg,$ID_No);
    echo $flag;
    echo "fuck";
    echo $ID_No;

    if(!$flag||strlen($ID_No)!=18){
        return 2;                                   //位数或字符不对
    }else{
        
            $idCardWi = array( 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2 ); //将前17位加权因子保存在数组里
            $idCardY = array( 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ); //这是除以11后，可能产生的11位余数、验证码，也保存成数组
            $idCardWiSum = 0;//用来保存前17位各自乘以加权因子后的总和
            foreach($idCardWi as $k=>$v){
                $idCardWiSum += $v * $ID_No[$k];
            }
//            for($i = 0;$i<(strlen($ID_No)-1);$i++){
////                $idCardWiSum += $ID_No[$i] * $idCardWi[$i];
////                $idCardWiSum += substr($ID_No,$i,$i++) * $idCardWi[$i];
//                echo $i;
//                $idCardWiSum += substr($ID_No,$i,$i++) * $idCardWi[$i];
//            }
            $idCardMod = $idCardWiSum % 11;//计算出校验码所在数组的位置
            $idCardLast = $ID_No[17];//得到最后一位身份证号码
            if($idCardMod==2){
                    if($idCardLast=="X"||$idCardLast=="x"){
                        
                        return 1;                //通过验证
                    }else{
                       
                        return 3;                 //身份证格式错误
                    }
                }else if($idCardLast==$idCardY[$idCardMod]){
                         return 1;                //通过验证
                    }else{
                         return 3;                 //身份证格式错误
                     }
          
        }
    }
    
    
    
