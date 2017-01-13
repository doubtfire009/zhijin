<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 指津账户业务逻辑
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
 */

class account extends Home_Controller
{
    
    public function __construct(){
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->model('Data_base_model');
        $this->load->model('Login_model');
        $this->load->model('Public_model');
        $this->load->model('Account_model');
        
        $this->load->helper('url');
    } 
    
    public function index(){
        redirect('account/account/basic_account');
    }
    
    /**
     * 账户信息 基本信息
     */
    public function basic_account(){
        $this->Public_model->_public_check($_SESSION['user_id'],'member/Zj_user/login');
        
        $this->data['account_nav_num'] = 1;
        
        $where_data = array('user_id'=>$_SESSION['user_id']);
        $user_info = $this->Data_base_model->select_list_one('user',$where_data);
        $this->data['user_info']['mobile'] = $user_info['mobile']; 
        $this->data['user_info']['email'] = $user_info['email']; 
        
        
        $this->data['site_title']= '指津网——我的账户';
        
        $this->load->view('public/header',$this->data);
        $this->load->view('account/account_nav',$this->data);
        $this->load->view('account/personal_data');
        $this->load->view('public/footer');
    }
    
    public function basic_account_do(){
        $this->Public_model->_public_check($_SESSION['user_id'],'member/Zj_user/login');
        $this->Public_model->_public_check($_POST, 'account/account/basic_account');
        
        $user_info['mobile']    = $this->input->post('mobile',true);
        $user_info['email']   = $this->input->post('email',true);
        
        
        $config = array(
                            array(
                                    'field' => 'mobile',
                                    'label' => '手机号',
                                    'rules' => 'required|callback_mobile_account_check',
                                    'errors' => array(
                                        'required' => '手机号不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'email',
                                    'label' => '邮箱名',
                                    'rules' => 'required|callback_email_account_check',
                                    'errors' => array(
                                        'required' => '邮箱不能为空',
                                    ),
                                )
    
                        );
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE){
             $this->data['account_nav_num'] = 1;
        
        $where_data = array('user_id'=>$_SESSION['user_id']);
        $user_info = $this->Data_base_model->select_list_one('user',$where_data);
        
        $this->data['user_info']['mobile'] = $user_info['mobile']; 
        $this->data['user_info']['email'] = $user_info['email']; 
        
        $this->data['site_title']= '指津网——我的账户';
        
        $this->load->view('public/header',$this->data);
        $this->load->view('account/account_nav',$this->data);
        $this->load->view('account/personal_data');
        $this->load->view('public/footer');
//             redirect('account/account/index');
        }else{
                $where_data = array('user_id'=>$_SESSION['user_id']);
                $edit_data = array('mobile'=>$user_info['mobile'],
                                    'email'=>$user_info['email']);
                $flag = $this->Data_base_model->edit_one('user',$where_data,$edit_data);
                if($flag>=0){//此处如果不写>=0，则与原数据一致时返回0，会出现修改失败
                    redirect('account/account/basic_account');
                }else{
                    header("Content-type:text/html;charset=utf-8");
                    die("<script>alert('修改失败！');window.location='".base_url('index.php/account/account/basic_account')."';</script>");
                }
                
        }
    }
    
    public function mobile_account_check($mobile){
        return $this->Account_model->mobile_account_check($mobile);
    }
    
    public function email_account_check($email){
        return $this->Account_model->email_account_check($email);
    }
    
    /**
     * 账户信息 验证信息
     */
    public function validate_account(){
        $this->Public_model->_public_check($_SESSION['user_id'],'member/Zj_user/login');
        
        $this->data['account_nav_num'] = 2;
         $where_data = array('user_id'=>$_SESSION['user_id']);
        $user_info = $this->Data_base_model->select_list_one('user',$where_data);
        
        $this->data['user_info']['username'] = $user_info['username']; 
        $this->data['user_info']['sex'] = $user_info['sex']; 
        $this->data['user_info']['ID_No'] = $user_info['ID_No']; 
        $this->data['user_info']['study_period_start'] = date("Y-m-d", $user_info['study_period_start']); 
        $this->data['user_info']['study_period_end'] = date("Y-m-d", $user_info['study_period_end']);
        $this->data['user_info']['work_period_start'] = date("Y-m-d", $user_info['work_period_start']);
        $this->data['user_info']['work_period_end'] = date("Y-m-d", $user_info['work_period_end']);
        $this->data['site_title']= '指津网——我的账户';
        $this->load->view('public/header',$this->data);
        $this->load->view('account/account_nav',$this->data);
        $this->load->view('account/validate_data');
        $this->load->view('public/footer');
    }
    
    
    public function validate_account_do(){
        $this->Public_model->_public_check($_SESSION['user_id'],'member/Zj_user/login');
        $this->Public_model->_public_check($_POST, 'account/account/validate_account');
        
        var_dump($_POST);
        
        
        $user_info['username']    = $this->input->post('username',true);
        $user_info['sex']   = $this->input->post('sex',true);
        $user_info['ID_No'] = $this->input->post('ID_No',true); 
        $user_info['study_period_start'] = $this->input->post('study_period_start',true);
        $user_info['study_period_end'] = $this->input->post('study_period_start',true);
        $user_info['work_period_start'] = $this->input->post('work_period_start',true);
        $user_info['work_period_end'] = $this->input->post('work_period_end',true);
        
        
        $config = array(
                            array(
                                    'field' => 'username',
                                    'label' => '真实姓名',
                                    'rules' => 'required|callback_username_check',
                                    'errors' => array(
                                        'required' => '真实姓名不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'ID_No',
                                    'label' => '身份证号',
                                    'rules' => 'required|callback_ID_No_check',
                                    'errors' => array(
                                        'required' => '身份证号不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'study_period_start',
                                    'label' => '学业开始时间',
                                    'rules' => 'required',
                                    'errors' => array(
                                        'required' => '时间不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'study_period_end',
                                    'label' => '学业结束时间',
                                    'rules' => 'required|callback_study_period_end_check[' . $user_info['study_period_start'] . ']',
                                    'errors' => array(
                                        'required' => '时间不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'work_period_start',
                                    'label' => '工作开始时间',
                                    'rules' => 'required',
                                    'errors' => array(
                                        'required' => '时间不能为空',
                                    ),
                                ),
                            array(
                                    'field' => 'work_period_end',
                                    'label' => '工作结束时间',
                                    'rules' => 'required|callback_work_period_end_check[' . $user_info['work_period_start'] . ']',
                                    'errors' => array(
                                        'required' => '时间不能为空',
                                    ),
                                ),
    
                        );
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE){
               $this->data['account_nav_num'] = 2;
        
               $where_data = array('user_id'=>$_SESSION['user_id']);
               $user_info1 = $this->Data_base_model->select_list_one('user',$where_data);

               $this->data['user_info']['username'] = $user_info1['username']; 
               $this->data['user_info']['sex'] = $user_info1['sex']; 
               $this->data['user_info']['ID_No'] = $user_info1['ID_No']; 
               $this->data['user_info']['study_period_start'] = date("Y-m-d", $user_info1['study_period_start']); 
               $this->data['user_info']['study_period_end'] = date("Y-m-d", $user_info1['study_period_end']);
               $this->data['user_info']['work_period_start'] = date("Y-m-d", $user_info1['work_period_start']);
               $this->data['user_info']['work_period_end'] = date("Y-m-d", $user_info1['work_period_end']);
               
               $this->data['site_title']= '指津网——我的账户';
               $this->load->view('public/header',$this->data);
               $this->load->view('account/account_nav',$this->data);
               $this->load->view('account/validate_data');
               $this->load->view('public/footer');
        }else{
                $where_data = array('user_id'=>$_SESSION['user_id']);
                
                $user_info['username']    = $this->input->post('username',true);
                $user_info['sex']   = $this->input->post('sex',true);
                $user_info['ID_No'] = $this->input->post('ID_No',true); 
                $user_info['study_period_start'] = strtotime($this->input->post('study_period_start',true));
                $user_info['study_period_end'] = strtotime($this->input->post('study_period_end',true));
                $user_info['work_period_start'] = strtotime($this->input->post('work_period_start',true));
                $user_info['work_period_end'] = strtotime($this->input->post('work_period_end',true));
//                echo strtotime($user_info['study_period_start']);
                
                $edit_data = array('username'=>$user_info['username'],
                                    'sex'=>$user_info['sex'],
                                    'ID_No'=>$user_info['ID_No'],
                                    'study_period_start'=>$user_info['study_period_start'],
                                    'study_period_end' =>$user_info['study_period_end'],
                                    'work_period_start'=>$user_info['work_period_start'],
                                    'work_period_end' =>$user_info['work_period_end']
                        );
                $flag = $this->Data_base_model->edit_one('user',$where_data,$edit_data);
                $user_info['flag'] = $flag;
                $user_info['user_id'] = $_SESSION['user_id'];
//                var_dump($user_info);
                if($flag>=0){
                    redirect('account/account/validate_account');
                }else{
                    
//                    var_dump($edit_data);
                    header("Content-type:text/html;charset=utf-8");
                    die("<script>alert('修改失败！');window.location='".base_url('index.php/account/account/validate_account')."';</script>");
                }
                
        }
    }
    
    
    public function username_check($str){
        return $this->Account_model->username_check($str);
            }
    public function ID_No_check($str){
        return $this->Account_model->ID_No_check($str);
            }
    public function study_period_end_check($end_time,$start_time){
        return $this->Account_model->study_period_end_check($end_time,$start_time);
            }
    public function work_period_end_check($end_time,$start_time){
        return $this->Account_model->work_period_end_check($end_time,$start_time);
            }
    
}
