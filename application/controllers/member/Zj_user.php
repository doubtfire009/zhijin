<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|+-------------------------------------------------------------------------
| 登录 注册 找回密码
|+-------------------------------------------------------------------------
| /**
 * 指津用户功能业务逻辑
 * 登录 注册 找回密码
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
|+-------------------------------------------------------------------------
*/  
class Zj_user extends Member_Controller
{
    private $folder;
    public function __construct() 
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Data_base_model');
        $this->load->model('Login_model');
        $this->load->model('Public_model');
        
        $this->load->helper('url');
        $this->load->helper('date');
    }
    
    /**
     * 公共登录
     */
    public function login()
    {
        $this->Public_model->_public_check($_SESSION, 'zhijin/home/index');
        $this->data['site_title']= '登录';
        $this->load->view('public/header',$this->data);
        $this->load->view('member/login');
        $this->load->view('public/footer');
	
    }
    /**
     * 公共登录处理
     */
    public function login_do()
    {
//从view界面返回的值，form_error根据的是input的name，而不是id
//        $this->_post_check('member/Zj_user/login');

        $this->Public_model->_public_check($_POST, 'member/Zj_user/login');
        $user_account    = $this->input->post('user_account',true);
        $password   = $this->input->post('password',true);
        $login_auto = $this->input->post('login_auto',true);
        $config = array(
                            array(
                                    'field' => 'user_account',
                                    'label' => '账户名',
                                    'rules' => 'required',
                                    'errors' => array(
                                        'required' => '名字不能为空',
                                    ),
                                ),
                            array(
                                'field' => 'password',
                                'label' => '密码',
                                'rules' => 'required|md5|callback_user_login_check[' . $user_account . ']',
                                
                                'errors' => array(
                                    'required' => '密码不能为空',
                                ),
                            )
                        );

        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == FALSE){

            $this->data['site_title']= '登录';
            $this->load->view('public/header',$this->data);
            $this->load->view('member/login');
            $this->load->view('public/footer');
            }
        else{
                $password = md5($password);
                $account_info = array(
                                'user_log'=> $user_account,
                                'password' => $password
                );
                    $user_info = $this->Login_model->account_info('user',$account_info);
//                    if($login_auto == 1){
                        $this->session->set_userdata($user_info);
//                    }
//                        var_dump($user_info);
//                        var_dump($_SESSION);
                    redirect('zhijin/Home/index');
                
            }
    }
    
    /**
     * 登录时检查账户状态
     */
    public function user_login_check($password,$account){

        return $this->Login_model->user_login_check('user',$account,$password);
    }




    /**
     * 公共注册_手机
     */
    public function register(){
        redirect('member/Zj_user/register_mobile');
    }
    
    public function register_mobile()
    {
       
        $this->data['site_title']= '手机注册';
        $this->load->view('public/header',$this->data);
        $this->load->view('member/register_mobile');
        $this->load->view('public/footer');
    }
    
     /**
     * 公共注册_邮箱
     */
    public function register_email()
    {
        $this->data['site_title']= '邮箱注册';
        $this->load->view('public/header',$this->data);
        $this->load->view('member/register_email');
        $this->load->view('public/footer');
    }
     /**
     * 公共注册处理
     */
    public function register_do()
    {

        $this->Public_model->_public_check($_POST, 'member/Zj_user/register');
        $account    = $this->input->post('user_account',true);
        $user_info['user_log'] = $account;
        $user_info['pwd'] = $this->input->post('password',true);
        $user_info['status'] = 1;
        $user_info['reg_date'] = time();
        $user_info['nickname'] = $this->input->post('nickname',true);

        $location_flag = $this->input->post('location_flag',true);//用来判定从email还是mobile跳转
        $agreement = $this->input->post('agreement',true);

        $config = array(
                            array(
                                    'field' => 'user_account',
                                    'label' => '账户名',
                                    'rules' => 'required|max_length[200]|callback_account_register_check[' . $location_flag . ']',
                                    'errors' => array(
                                        'required' => '名字不能为空',
                                        'max_length' => '名字长度不能超过200',
                                    ),
                                ),
                            array(
                                'field' => 'password',
                                'label' => '密码',
                                'rules' => 'required|md5|max_length[32]|min_length[3]',
                                'errors' => array(
                                    'required' => '密码不能为空',
                                    'max_length' => '密码长度不能超过32',
                                    'min_length' => '密码长度不能小于3',
                                   ), 
                                ),
                            array(
                                'field' => 'confirm_password',
                                'label' => '确认密码',
                                'rules' => 'required|md5|matches[password]',
                                 'errors' => array(
                                    'required' => '确认密码不能为空',
                                    
                                    'matches' => '和设置密码不一致',
                                    ),
                                ),
                            array(
                                'field' => 'nickname',
                                'label' => '确认密码',
                                'rules' => 'required|max_length[10]|min_length[2]|callback_nickname_check',
                                 'errors' => array(
                                    'required' => '昵称不能为空',
                                    'max_length' => '长度不能超过10',
                                    'min_length' => '长度不能小于2',
                                    ),
                                ),
                            array(
                                'field' => 'agreement',
                                'label' => '同意协议',
                                'rules' => 'callback_agreement_register_check',
                                 'errors' => array(
                                    'required' => '确认密码不能为空',
                                    
                                    'matches' => '和设置密码不一致',
                                    ),
                                )
                            
                            );
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() == FALSE){
             
            if($location_flag == "email"){
                $this->data['site_title']= '邮箱注册';
                $this->load->view('public/header',$this->data);
                $this->load->view('member/register_email');
                $this->load->view('public/footer');
            }else{
                $this->data['site_title']= '手机注册';
                $this->load->view('public/header',$this->data);
                $this->load->view('member/register_mobile');
                $this->load->view('public/footer');
            }
                
        }else{
                
                
                $flag = $this->Login_model->account_check_mail_mobile($account);
                //////////////
                
                if($flag == "mail"){
                    $user_info['email'] = $account;
                    $user_info['mobile'] = "";
                }else if($flag == "mobile"){
                    $user_info['email'] = "";
                    $user_info['mobile'] = $account;
                }else{
                    header("Content-type:text/html;charset=utf-8");
                    die("<script>alert('注册失败！kkk');window.location='".base_url('index.php/member/Zj_user/register')."';</script>");
                }
               
                
                
                $user_info['pwd'] = md5($user_info['pwd']);
                $flag_tmp_id = $this->Data_base_model->add_one('user',$user_info);
                if($flag_tmp_id){
                    $user_info['user_id'] = $flag_tmp_id;
                    $this->session->sess_destroy();
                    $this->session->set_userdata($user_info);
                    
                    redirect('zhijin/Home/index');
                }else{
                    header("Content-type:text/html;charset=utf-8");
                    die("<script>alert('注册失败！');window.location='".base_url('index.php/member/Zj_user/register')."';</script>");
                }
            }    
    }
    
    public function account_register_check($account,$location_flag){
         return $this->Login_model->account_register_check('user',$account,$location_flag);
    }
    
    public function agreement_register_check($agreement){
         return $this->Login_model->agreement_register_check($agreement);
    }
    public function nickname_check($nickname){
         return $this->Login_model->nickname_check($nickname);
    }
    
     
    /**
     * 找回密码
     */    
    public function password_get(){
        $this->data['site_title']= '密码找回';
        $this->load->view('public/header',$this->data);
        $this->load->view('member/password_get');
        $this->load->view('public/footer');
    }
    /**
     * 重置密码
     */  
    public function password_reset(){
        $this->data['site_title']= '密码重置';
        $this->load->view('public/header',$this->data);
        $this->load->view('member/password_reset');
        $this->load->view('public/footer');
    }

    
    /**
     * 退出
     */ 
    public function login_out(){
        $this->session->sess_destroy();
        redirect('member/Zj_user/login');
    }
    
}
