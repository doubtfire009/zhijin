<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Product_model extends CI_Model
{
    public $table_name;
    public $table_name_cat;
    
    function __construct(){
       parent::__construct();
       $this->load->database();
       $this->table_name = 'product_info';
       $this->table_name_cat = 'cat_info';
//       $this->table_name_cat = 'test_cat';

    }

    /*
        取类别表cat_info某一节点的所有直接子节点，并在每一条记录最后加上'son'字段
        * @param int $parent_id 父类别号
        * @return array
          */
    function cat_parent_to_son_list($parent_id){//变量为cat_id时为找到该id对应的直接子节点
        $where_data = array('parent_id'=>$parent_id);
        $data = $this->Data_base_model->select_list($this->table_name_cat,$where_data);
        if(!empty($data)){
            foreach($data as $k=>$v){
                $data[$k]['son'] = "";
            }
            return $data;
        }else{
            return $data;
        }
    }

    
   /*
        产品表product_info根据cat_id从任一子节点取到其对应的所有父节点，最下层的节点处于$str_tmp[0]
        * @param int $cat_id 类别号
        * @return array  $str_tmp 节点信息数组
          */  
 
//    function product_cat_info($cat_id){
//
//        global $str_tmp;
//            $where_data = array('cat_id'=>$cat_id);
//            $cat_info = $this->Data_base_model->select_list_one($this->table_name_cat,$where_data);
//            $str_tmp[] = $cat_info['cat_name'];
//        
//            if($cat_info['type_id'] != 1){
//           
//                return $str_tmp[] = $this->product_cat_info($cat_info['parent_id']);
//           
//  
//            }else{
//                $tmp = $str_tmp;
//                unset($GLOBALS['str_tmp']);
//
//           
//                return  $str_tmp;
//            }
//        
//          
//    }
     function product_cat_info($cat_id){
         global $str_tmp;
         $where_data1 = array('cat_id'=>$cat_id);
         $data = $this->Data_base_model->select_list_one($this->table_name_cat,$where_data1);
//         var_dump($data);
        if(!empty($data)){
            $path = explode(",",$data['path']);
            foreach ($path as $k => $v) {
                $where_data2 = array('cat_id'=>$v);
                $res = $this->Data_base_model->select_list_one($this->table_name_cat,$where_data2);
                if(!empty($res)){
                    $str_tmp[] = $res['cat_name'];
                }else{
                    $str_tmp[] = "";
                }
                
            }
        }
        $tmp = $str_tmp;
        unset($GLOBALS['str_tmp']);
        return $tmp;
          
    }
    /*
        产品表cat_info根据cat_id从任一节点取到其对应的所有子节点
        * @param int $parent_id 类别号
        * @return array  $str_tmp 节点信息数组
          */  
/////////////////////////////////////////////////////////////////////////////  取到无限级的数组
    function get_all_son($parent_id){//parent_id是选取的某个节点cat_id
        
        $res = $this->cat_parent_to_son_list($parent_id);
        if(!empty($res)){
            foreach($res as $k=>$v){
                
                $v['son'] = $this->get_all_son($v['cat_id']);
                $str_get_all_son[] = $v;   
            }
            return $str_get_all_son;
        }

    }
    /*
        根据get_all_son()取得的数组生成记录树
        * @param array $arr 节点信息数组
        * @return  $str 节点信息字符串
          */ 
    function make_tree($arr){
        global $str;

        if(!empty($arr)){
            foreach ($arr as $k => $v) {
                $str .= str_repeat("&nbsp",2).str_repeat("--",$v['type_id']).$v['cat_name']."<br>";

                $this->make_tree($v['son']);
           }
        }
        return $str;
    }

    /*
        产品表product_info根据cat_id将所有对应cat_id记录变为空
        * @param int $cat_id 类别号
        * @return  boolean
          */ 
    function del_cat_of_product_list($cat_id){

        $where_data = array('cat_id'=>$cat_id);
        $data_pro = $this->Data_base_model->select_list($this->table_name,$where_data);
        if(!empty($data_pro)){
            foreach($data_pro as $k=>$v){
                $v['cat_id'] = "";
                $where_data = array('product_id'=>$v['product_id']);
                $flag = $this->Data_base_model->edit_one($this->table_name,$where_data,$v);
            }
            return true;
        }else{
            return false;
        }
        
    }
    /*
         * 从产品表product_info和cat_info中删除对应cat_id记录，cat_info中删除对应该节点和对应子节点，product_info中将对应cat_id记录设为空
         * @param int $cat_id 
         * @return 
    */ 
    
    function del_tree_node($cat_id){
        $where_data1 = array('parent_id'=>$cat_id);
        $son_list = $this->Data_base_model->select_list($this->table_name_cat,$where_data1);
        $where_data = array('cat_id'=>$cat_id);
        $del_cat_one_flag = $this->Data_base_model->del_one($this->table_name_cat,$where_data);
        $del_cat_of_product_list_flag = $this->del_cat_of_product_list($cat_id);
        foreach($son_list as $k=>$v){
            $this->del_tree_node($v['cat_id']); 
        }
    }
   
     /*
        根据get_all_son()取得的数组生成用于增加产品的<select>的记录树
        * @param array $arr 节点信息数组
        * @return  $str_sel_add 节点信息字符串
          */ 
    function make_tree_select_add($arr){
        global $str_sel_add;

        if(!empty($arr)){
            foreach ($arr as $k => $v) {

                $str_sel_add .= "<option value = \"".$v['cat_id']."\">".str_repeat("--",$v['type_id']).$v['cat_name']."</option>";
                $this->make_tree_select_add($v['son']);
           }
        }
        return $str_sel_add;
    }
    /*
        根据get_all_son()取得的数组生成用于修改产品的<select>的记录树
        * @param array $arr 节点信息数组
        * @param int $cat_id 产品类别号
        * @return  $str_sel_edit 节点信息字符串
          */ 
    function make_tree_select_edit($arr,$cat_id){
        global $str_sel_edit;

        if(!empty($arr)){
            foreach ($arr as $k => $v) {

                if($v['cat_id'] == $cat_id){
                    $str_sel_edit .= "<option value = \"".$v['cat_id']."\" selected=\"selected\">".str_repeat("--",$v['type_id']).$v['cat_name']."</option>";
                }else{
                    $str_sel_edit .= "<option value = \"".$v['cat_id']."\">".str_repeat("--",$v['type_id']).$v['cat_name']."</option>";
                }
                $this->make_tree_select_edit($v['son'],$cat_id);
           }
        }
        
        return $str_sel_edit;
    }

}

