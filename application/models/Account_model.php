<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Account_model extends CI_Model
{
  
    public $account_mail_preg;
    public $account_mobile_preg;
//    public $nickname_preg;
    function __construct(){
       parent::__construct();
       $this->load->database();
       
       $this->load->helper('account_function');
       

       
//       $this->account_mail_preg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/';
        $this->account_mail_preg = '/^^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/'; 
       $this->account_mobile_preg = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/";

       $this->username_preg = "/^[\x{4e00}-\x{9fa5}]+$/u";
       $this->userID = "/^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/";
       
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    }
    /*
        检测 我的账户 中 基本信息 是否合法
        * @param 
        * 
          */
    function email_account_check($str){
        $str = trim($str);
        $account_mail_res = preg_match($this->account_mail_preg,$str);
        if($account_mail_res){
            return true;
        }else{
            
            $this->form_validation->set_message('email_account_check', "请使用正确的邮箱");
             return false;
        }
    }
    function mobile_account_check($str){
        $str = trim($str);
        $account_mobile_res = preg_match($this->account_mobile_preg,$str);
        if($account_mobile_res){
            return true;
        }else{
            $this->form_validation->set_message('mobile_account_check', "请使用正确的手机");
            return false;
            
        }
    }
    
    public function username_check($str){
        $str = trim($str);
        $account_username_res = preg_match($this->username_preg,$str);
        if($account_username_res){

            return true;
        }else{
            $this->form_validation->set_message('username_check', "请填写真实的名字");

            return false;
            
        }
            }
    public function ID_No_check($ID_No){
        $str = trim($ID_No);
        
        $flag = ID_No_check_flag($ID_No);
        if($flag == 2){
            $this->form_validation->set_message('ID_No_check', "身份证号位数或字符不正确");
            return false;
        }else if($flag == 3){
            $this->form_validation->set_message('ID_No_check', "身份证号格式不正确");
            return false;
        }else if($flag == 1){
            return true;
        }
            
    }
            
    public function study_period_end_check($end_time,$start_time){
        $flag =  $this->period_end_check($end_time, $start_time);
        if($flag == 1){
            $this->form_validation->set_message('study_period_end_check', "结束时间过早");
            return false;
        }else{
            
            return true;
        }
            }
            
    public function work_period_end_check($end_time,$start_time){
        $flag =  $this->period_end_check($end_time, $start_time);
        if($flag == 1){
            $this->form_validation->set_message('work_period_end_check', "结束时间过早");
            return false;
        }else{
            
            return true;
        }
            }        
            
            
    public function period_end_check($end_time,$start_time){
        if($end_time <= $start_time){

            return 1;
        } else{
            return 2;
        }
    }
    
}