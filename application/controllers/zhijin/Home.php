<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 指津首页业务逻辑
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
 */

class Home extends Home_Controller
{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    } 
    
    public function index(){
//        var_dump($_SESSION);
//        var_dump($this->session->userdata);
        $this->data['site_title']= '指津网——阅读他人经历，发现兴趣职业';
        $this->load->view('public/header',$this->data);
        $this->load->view('zhijin/main');
        $this->load->view('public/footer');
    }
}
