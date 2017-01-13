<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Cart_model extends CI_Model
{
    public $user_table;
    public $status_table;
    public $staff_table;
    public $level_table;
    public $cart_table;
    public $order_table;
    public $product_table;
    
    function __construct(){
       parent::__construct();

       
       $this->user_table = 'user';
       $this->status_table = 'status';
       $this->staff_table = 'staff';
       $this->level_table = 'level';
       $this->cart_table = 'cart';
       $this->order_table = 'order';
       $this->product_table = 'product_info';
       
       $this->load->library('session');
       $this->load->helper('url');
       $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

    }
    /*
        获取购物车表cart中所有记录
        * @param  
        * @return array
          */ 
    function cart_list($where_data=""){

        $data = $this->Data_base_model->select_list($this->cart_table,$where_data);
        if(!empty($data)){
            foreach($data as $k=>$v){
//                $pro_tmp = $this->Product_model->product_info_one($v['cart_pro_id']);
                $where_data_one = array('product_id'=>$v['cart_pro_id']);
                $pro_tmp = $this->Data_base_model->select_list_one($this->product_table,$where_data_one);
                $data[$k]['cart_pro_name'] = $pro_tmp['product_name'];
            }
        }
        return $data;
    }
    
   
    
    /*
        增加购物车表cart中单条记录
        * @param int $product_id,$user_id 产品号、用户号
        * @return boolean
          */ 
    function cart_add($product_id,$user_id){
        $where_data = array('cart_pro_id'=>$product_id,
                            'cart_user_id'=>$user_id);
        $cart_tmp = $this->Data_base_model->select_list_one($this->cart_table,$where_data);
        if(!empty($cart_tmp)){
            $cart_tmp['cart_pro_num']++;
            $where_data = array('cart_id'=>$cart_tmp['cart_id']);
            $flag = $this->Data_base_model->edit_one($this->cart_table,$where_data,$cart_tmp);
            return $flag;

        }else{
            $tmp['cart_pro_id'] = $product_id;
            $tmp['cart_user_id'] = $_SESSION['user_id'];
            $tmp['cart_pro_num'] = 1;
            $flag_tmp = $this->Data_base_model->add_one($this->cart_table,$tmp);
            return $flag_tmp;
        }
    }
    /*
        获取订单表order中所有记录
        * @param 
        * @return array
          */ 

    function order_info_list($where_data=""){
        
        $data = $this->Data_base_model->select_list($this->order_table,$where_data);
        foreach($data as $k=>$v){

            $where_data = array('product_id'=>$v['order_pro_id']);
            $pro_tmp = $this->Data_base_model->select_list_one($this->product_table,$where_data);
            $data[$k]['order_pro_name'] = (!empty($pro_tmp)) ? $pro_tmp['product_name'] : "";
            $where_data = array('status_id'=> $v['order_status']);
            $status_tmp = $this->Data_base_model->select_list_one($this->status_table,$where_data);
            $data[$k]['order_status_name'] = (!empty($status_tmp)) ? $status_tmp['status_name'] : "";
        }
      
        return $data;
        
    }
    
    /*
        将购物车表cart中选中的记录加入order表，没有记录的插入，有记录的加上原有数量
        * @param array $cart_id 插入的信息
        * @return boolean
          */
    function cart_to_order($cart_id){
        $where_data1 = array('cart_id'=>$cart_id);
        $cart_info = $this->Data_base_model->select_list_one($this->cart_table,$where_data1);
        $where_data2 = array('order_pro_id'=>$cart_info['cart_pro_id'],'order_user_id'=>$_SESSION['user_id']);
        $cart_order_info = $this->Data_base_model->select_list_one($this->order_table,$where_data2);
        if(empty($cart_order_info)){
            $cart_to_order['order_pro_id'] = $cart_info['cart_pro_id'];
            $cart_to_order['order_user_id'] = $cart_info['cart_user_id'];
            $cart_to_order['order_pro_num'] = $cart_info['cart_pro_num'];
            $cart_to_order['order_status'] = 4;
            $flag_add = $this->Data_base_model->add_one($this->order_table,$cart_to_order);
        }else{
            $cart_order_info['order_pro_num'] += $cart_info['cart_pro_num'];
            $cart_to_order['order_status'] = 4;
            $where_data3 = array('order_id'=>$cart_order_info['order_id']);            
            $flag_edit = $this->Data_base_model->edit_one($this->order_table,$where_data3,$cart_order_info);            
        }         
        return true;
    }

    
    
}

