<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 指津大学选择业务逻辑
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
 */
class university extends Home_Controller
{
    
    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
    } 
    
    public function index(){
        $this->data['site_title']= '指津网——关于大学的信息';
        $this->data['js'] = array("theme/js/university/score_chart_com.js","theme/js/university/score_pie.js");
        $this->load->view('public/header',$this->data);
        $this->load->view('university/enrolled_score');
        $this->load->view('public/footer');
    }
    public function people(){
        $this->data['site_title']= '指津网——关于招生人数的信息';
        $this->data['js'] = array("theme/js/university/people_chart.js","theme/js/university/people_score.js");
        $this->load->view('public/header',$this->data);
        $this->load->view('university/enrolled_people');
        $this->load->view('public/footer');
    }
}