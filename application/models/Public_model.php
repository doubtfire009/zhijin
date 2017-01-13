<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Public_model extends CI_Model
{
    
    
    function __construct(){
       parent::__construct();
       $this->load->database();
       
       $this->load->helper('url');
    }
    /*
        检测是否登录或是否传递了POST
        * @param array $var string $path
        * 
          */
    function _public_check($var,$path){
        if(empty($var)){
            redirect($path);
        }
    }  

}