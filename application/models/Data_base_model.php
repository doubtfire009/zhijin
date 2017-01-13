<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Data_base_model extends CI_Model{
    
    public function __construct(){
       parent::__construct();

       $this->load->database();
    }
    
    /**
	*设置用and连接的查询条件
	*@param $where_data array|string 限定条件
	*
	*/
    public function set_where($where_data){
        if(!empty($where_data)){
            if(is_array($where_data)){
                foreach($where_data as $key=>$where){
                    $this->db->where($key,$where);
                }
            }else{
                $this->db->where($where_data);
            }
        }
    }
    
    /**
	*设置用or连接的查询条件
	*@param $where_data array|string 限定条件
	*
	*/    
    public function set_orwhere($orwhere_data){
        if(!empty($orwhere_data)){
            if(is_array($orwhere_data)){
                foreach($orwhere_data as $key=>$orwhere){
                    $this->db->or_where($key,$orwhere);
                }
            }else{
                $this->db->or_where($orwhere_data);
            }
        }
    }
    
    
    
    
    /**
     * 查询得到多条数据
     * @param string $table 数据表
     * @param array $where_data 查询条件
     * @param string $or_and and还是or的条件连接
     * @param string $pagenum 显示数据条数
     * @param string $offset  偏移量
     * @param int $tag 返回数据或是指示符
     * @param int $order_arr 排列方式
     * @param int $sql_field 查询得到字段
     * @return array|boolean
     * 
     */
    public function select_list($table_name,$where_data='',$or_and = 'and', $pagenum = "0", $offset = "0", $tag='all',$order_arr = array(),$sql_field ='*'){
        if(count($order_arr) >0){
            $order_id = array_keys($order_arr);
            $this->db->order_by($order_id[0],$order_arr[$order_id[0]]);
        }
        $this->db->select($sql_field);
        if($or_and == 'and'){
            $this->set_where($where_data);
        }else if($or_and = 'or'){
            $this->set_orwhere($where_data);
        }
        if($pagenum > 0){
            $this->db->limit($pagenum, $offset);
        }
        
        $result = $this->db->get($table_name)->result_array();
        if($tag == 'all'){
            return $result;        
        }else if($tag == 'bool'){
            if(count($result)>0){
                return true;
            }else{
                return false;
            }
            
        }
    }
    /**
     * 查询得到1条数据
     * @param string $table 数据表
     * @param array $where_data 查询条件
     * @param string $or_and and还是or的条件连接
     * @param string $pagenum 显示数据条数
     * @param string $offset  偏移量
     * @param int $tag 返回数据或是指示符
     * @param int $sql_field 查询得到字段
     * @return array|boolean
     * 
     */
    public function select_list_one($table_name,$where_data="",$or_and = 'and',$tag='one',$sql_field = '*'){
        $this->db->select($sql_field);
        if($or_and == 'and'){
            $this->set_where($where_data);
        }else if($or_and = 'or'){
            $this->set_orwhere($where_data);
        }
        $result = $this->db->get($table_name)->result_array();
        if(!empty($result)){
            if($tag == 'one'){
                return $result[0];        
            }else if($tag == 'bool'){
                if(!empty($result)){
                    return true;
                }else{
                    return false;
                }

            }
        }else{
            return $result;
        }
    }
    /**
	 * 删除数据
	 * @param string $table_name
	 * @param array|string $where_data
	 * @return int 被影响的行数=0 删除成功 -1删除失败
	 *
	 */
    public function del_one($table_name,$where_data){
        if(!empty($where_data)){
            $this->set_where($where_data);
            $this->db->delete($table_name);
            return $this->db->affected_rows();
        }else{
            return -1;
        }
        
    }
    /**
	 * 增加数据
	 * @param string $table_name
	 * @param array $add_data
	 * @return int|boolean 插入后得到的id
	 *
	 */
    public function add_one($table_name,$add_data){
        if(!empty($add_data)){
            $this->db->insert($table_name,$add_data);
            return  $this->db->insert_id($table_name,$add_data);
        }else{
            return false;
        }
    }
    /**
	 * 编辑数据
	 * @param string $table_name
	 * @param array|string $where_data
	 * @param array $edit_data
	 * @return int 被影响的行数 >0 删除成功 否则失败
	 *
	 */
    public function edit_one($table_name,$where_data,$edit_data){
        if(!empty($where_data)){
            $this->set_where($where_data);
            $this->db->set($edit_data);

            $this->db->update($table_name);
            return $this->db->affected_rows();
        }else{
            return -1;
        }
    }
    
    
    
    
}
