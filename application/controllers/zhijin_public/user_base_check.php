<?php

/*
|+-------------------------------------------------------------------------
| 个人资料完善
|+-------------------------------------------------------------------------
| /**
 * 指津用户功能业务逻辑
 * 个人资料完善
 * @author lzy <hn.lizhiyu@163.com>
 * @date 2015-12-14
|+-------------------------------------------------------------------------
*/ 
class user_base_check extends Member_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Data_base_model');
        $this->load->model('Login_model');
        $this->load->helper('url');
    }
    /**
     * 个人资料完善
     */
    public function user_base_check(){
        $this->data['site_title']= '告诉大家您是谁';
        $this->load->view('public/user_base_check',$this->data);
    }
     /**
     * 身份证处理
     */
    public function user_base_check_do()
    {
        $config = array(
                            array(
                                    'field' => 'user_ID_No',
                                    'label' => '身份证号',
                                    'rules' => 'required|max_length[18]|callback_user_ID_No_check',
                                    'errors' => array(
                                        'required' => '身份证号不能为空',
                                        'max_length' => '身份证号长度不能超过18',
                                    ),
                                )
                            
                            );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){
                $this->data['site_title']= '告诉大家您是谁';
                $this->load->view('public/user_base_check',$this->data);
            }
        else{
                $user_info['user_id'] = $_SESSION['user_id'];
                $user_info['ID_No']  = $this->input->post('user_ID_No',true);
                
                $flag_tmp_id = $this->Data_base_model->add_one('user',$user_info);
                if($flag_tmp_id){
                    
//                    $this->session->set_userdata($user_info);

                    redirect('zhijin/Home/index');
                }else{
                    header("Content-type:text/html;charset=utf-8");
                    die("<script>alert('注册失败！');window.location='".base_url('index.php/public/user_base_check')."';</script>");
                }
            }    
    }
    
    public function user_ID_No_check($ID_No){
            return $this->User_base_check_model->user_ID_No_check($ID_No);
        }
}

