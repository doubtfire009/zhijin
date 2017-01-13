<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 指津经历业务逻辑
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09
 */

class experience extends Home_Controller
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
        redirect('account/experience/experience_study/0/0/0');
    }

    
    
    public function experience_study($experience_life_nav_num_s=0,$experience_life_level_s=0,$experience_life_level_grade_s=0){
         $this->Public_model->_public_check($_SESSION['user_id'],'member/Zj_user/login');
         $this->data['account_nav_num'] = 3;
         $this->data['experience_life_nav_num_s'] = $experience_life_nav_num_s;
         
         $this->data['experience_life_level_s'] = $experience_life_level_s;
         $this->data['experience_life_level_grade_s'] = $experience_life_level_grade_s;
         
         $this->data['js'][] = "theme/summernote/dist/summernote.js";
         $this->data['js'][] = "theme/summernote/dist/lang/summernote-zh-CN.js";
         $this->data['js'][] = "theme/js/account/experience/summernote_start.js";
         
         $this->data['js'][] = "theme/js/account/experience/experience_management.js";
         
         
         
         
         
         $this->data['css'][] = "theme/font_awesome/css/font-awesome.css";
         $this->data['css'][] = "theme/summernote/dist/summernote.css";
         $this->data['site_title']= '指津网——我的账户';
 
         $experience_title = $this->Data_base_model->select_list('experience_title');
         foreach($experience_title as $k=>$v){
            $tmp = explode(",",$v['experience_id']);
             $experience_title[$k]['experience_arr'][] = $tmp;
             
         }
         
         $this->data['experience_title']= $experience_title;
         
         $where_data = array('user_id'=>$_SESSION['user_id']);
         $result = $this->Data_base_model->select_list_one('user',$where_data);

         $nav_1 = array();         
         $nav_2 = array();
         foreach($experience_title as $k=>$v){
             if(sizeof($v['experience_arr'][0]) == 1 && $v['experience_arr'][0][0] != 0){//// 学业 工作 生活
                if(!empty($v)){
                    $nav_1[] = $v;
                }
                
             }
         }

         foreach($experience_title as $k=>$v){    
             if(sizeof($v['experience_arr'][0]) == 2 && $v['experience_arr'][0][0] == $nav_1[$experience_life_nav_num_s]['experience_arr'][0][0] && 
                     $v['experience_arr'][0][1]<=$result['study_level']){///本科 硕士 博士
                 if(!empty($v)){
                    $nav_2[] = $v;
                 }
             } 
         }

         $this->data['nav_1'] = $nav_1;
         $this->data['nav_2'] = $nav_2;

         $this->data['result'] = $result;
         
         $tmp_str = $experience_life_nav_num_s.",".$experience_life_level_s.",".$experience_life_level_grade_s;
         $where_data1 = array('experience_id_up'=>$tmp_str);
         
         $experience_table = $this->Data_base_model->select_list('experience',$where_data1);
         
         
         
         
         
         
        $this->load->view('public/header',$this->data);
        $this->load->view('account/account_nav',$this->data);
        $this->load->view('account/experience/experience_nav',$this->data);
        $this->load->view('account/experience/experience_study');

        $this->load->view('public/footer',$this->data);
    }
    
    public function experience_title_dealer(){
        
    }
}
    