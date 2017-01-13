<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * 前台基类控制器
 * @package name:Home_Controller
 * @author 李之玉 <hn.lizhiyu@163.com>
 * @date 2015-12-09 01：06
 */
class Home_Controller extends CI_Controller
{

	public $data = array(); //data数组存放数据
	public $viewSeo = array(); //seo信息

	function __construct()
	{
		parent::__construct();

                //检查user是否登录
//                $this->filter();
                $this->load->library('session');
                

	}

}

class Member_Controller extends CI_Controller
{

	public $data = array(); //data数组
        function __construct()
	{
		parent::__construct();


                $this->load->library('session');
                $this->load->helper('url');
                

        
        }         
}