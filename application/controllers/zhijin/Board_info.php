<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 指津名牌业务逻辑
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
 */

class Board_info extends Home_Controller
{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    } 
    
    public function index(){
        $this->data['site_title']= '指津网——**的经历';
        $this->load->view('public/header',$this->data);
        $this->load->view('zhijin/board_info');
        $this->load->view('public/footer');
    }
}
