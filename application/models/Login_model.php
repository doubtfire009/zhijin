<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Login_model extends CI_Model
{
    public $user_table;
    public $status_table;
    public $staff_table;
    public $level_table;
    public $order_table;
    public $product_table;
    public $account_mail_preg;
    public $account_mobile_preg;
    public $nickname_preg;
    function __construct(){
       parent::__construct();
       $this->load->database();
       

       
       $this->account_mail_preg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/';
       $this->account_mobile_preg = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/";
//       $this->nickname_preg = "/^[0-9a-zA-Z\x{4e00}-\x{9fa5}/u]$/";
//       $this->nickname_preg = "/^[0-9a-zA-Z\x{4e00}-\x{9fa5}]{2,4}/u";
       $this->nickname_preg = "/^[0-9_a-zA-Z\x{4e00}-\x{9fa5}]/u";
       
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    }
     /*
        登录时查询是否存在$account_info信息
        * @param array $account_info 
        * @return boolean
          */
    function account_info($user_table,$account_info){
        $where_data = array('user_log'=>$account_info['user_log']);
        $result = $this->Data_base_model->select_list_one($user_table,$where_data,'or');
        if (!empty($result))
        {
            if ($result['pwd']==$account_info['password'])
            {
                return $result;
            }else
            {
                return false;
            }

        }else
        {
            return false;
        }
    }
    
    
    
    /*
        检测是否使用手机号或邮箱登录
        * @param array $account_info 
        * @return boolean
          */
    
    
    function user_login_check($user_table,$account,$password){
//        $str = trim($str);

        $where_data = array('user_log'=>trim($account));
        $result_user_exist = $this->Data_base_model->select_list_one($user_table,$where_data,'or');
//        var_dump($result_user_exist);
        if(empty($result_user_exist)){
            $this->form_validation->set_message('user_login_check', "无此用户");
            return false;
        }else{          
                if($result_user_exist['pwd']!=$password){
                    $this->form_validation->set_message('user_login_check', "用户名密码错误");
                    return false;
                }else{
                    if($result_user_exist['status'] == 2){
                        $this->form_validation->set_message('user_login_check', "此账号已被冻结");
                        return false;
                    }else{
                        return true;
                    }
                }
                
            }  
    }
    /*
        检测是否使用手机号或邮箱注册,是否账号已存在
        * @param array $account_info 
        * @return boolean
          */
    function account_register_check($user_table,$account,$location_flag){
         
        $account = trim($account);
        if($location_flag == "email"){
            $account_preg = preg_match($this->account_mail_preg,$account);
            $where_data = array('email'=>$account);
        }else{
            $account_preg = preg_match($this->account_mobile_preg,$account);
            $where_data = array('mobile'=>$account);
        }
 
        if($account_preg){            

            $result = $this->Data_base_model->select_list($user_table,$where_data);
            
            if(!empty($result)){
                $this->form_validation->set_message('account_register_check', "会员中已有该记录");
                return false;
            }else{
                
                return true;
            }
        }else{
            if($location_flag == "email"){
                $this->form_validation->set_message('account_register_check', "请使用正确的邮箱注册");
            }else{
                $this->form_validation->set_message('account_register_check', "请使用正确的手机注册");
            }
                
            return false;
        }
    }
    
    
    function agreement_register_check($agreement){
        if($agreement != 1){
            $this->form_validation->set_message('agreement_register_check', "必须同意相关协议");
            return false;
        }else{
            return true;
        }
    }
    
    
    function nickname_check($nickname){
        $nickname_preg = preg_match($this->nickname_preg,$nickname);
        if($nickname_preg){
            return true;
        }else{
            $this->form_validation->set_message('nickname_check', "昵称不符合呀");
            return false;
        }
    }
    
    /*
        检查登录时用的邮箱还是手机
        * @param string $str 
        * @return boolean
          */
    function account_check_mail_mobile($str){
        $str = trim($str);
        $account_mail_res = preg_match($this->account_mail_preg,$str);
        $account_mobile_preg = preg_match($this->account_mobile_preg,$str);
        
        if($account_mail_res){
            $flag = "mail";
            }else if($account_mobile_preg){
                    $flag = "mobile";
                }else{
                    $flag = "error";
                    }
        echo $flag;
        return $flag;
    }
    
    
    
    
    
    
    
    
    /*
        管理员表staff是否有重复用户信息
        * @param array $staff_name 用户信息
        * @return boolean
          */
    function exist_check($staff_table,$staff_name){
        $where_data = array('staff_name'=>$staff_name);
        $result = $this->Data_base_model->select_list_one($staff_table,$where_data);
        if(!empty($result)){
            $this->form_validation->set_message('exist_check', "管理员中已有该记录");
            return false;
        }else{
            return true;
        }
    }
    
    /*
        会员、管理员、产品的冻结功能
        * @param int $id 产品或会员号
        * @param string $table 操作表
        * @param int $pass 通过数字 
        * @param int $not_pass 冻结数字 
        * @return boolean
          */
     function freeze_identity($id,$table,$pass,$not_pass){
        if(!empty($id)){
//            if($table=='staff'){
//                $id_flag = 'staff_id';
//                $status_flag = 'staff_status';
//                
//            }else if($table=='user'){
//                $id_flag = 'user_id';
//                $status_flag = 'user_status';
//            }
//            else if($table==$this->product_table){
//                $id_flag = 'product_id';
//                $status_flag = 'pass';
//            }else if($table==$this->order_table){
//                $id_flag = 'order_id';
//                $status_flag = 'order_status';
//            }
            $id_flag = 'user_id';
            $status_flag = 'status';
            $where_data = array($id_flag => $id);
   
            $tmp = $this->Data_base_model->select_list_one($table,$where_data);

            if(!empty($tmp)){
                if($tmp[$status_flag]==$pass){
                    $tmp[$status_flag] = $not_pass;  
                }else{
                    $tmp[$status_flag] = $pass;
                }
                                  
                $flag = $this->Data_base_model->edit_one($table,$where_data,$tmp);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
   
}