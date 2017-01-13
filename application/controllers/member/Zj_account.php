<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
  |+-------------------------------------------------------------------------
  | 会员中心 账户信息
  |+-------------------------------------------------------------------------
  | @author lzy@hn.lizhiyu@163.com 2015-12-25
  |+-------------------------------------------------------------------------
 */

    class Zj_account extends Member_Controller
{
    private $folder;
    public function __construct() 
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Data_base_model');
        $this->load->model('Login_model');
        $this->load->helper('url');
    }
    public function index(){
        $this->data['site_title']= '上传图片';
        $this->load->view('public/imgupload',$this->data);
    }
    
    
    public function simple(){
//        $id = $_POST['pid'];
//        echo "ajx返回值是".$id;
          var_dump($_FILES);
//        echo $_FILES['id_photos']['name']; 
        }
    
     public function imgupload() {
        $files = array();
        $success = 0;    //用户统计有多少张图片上传成功了
        
        foreach ($_FILES as $item) {
            $index = count($files);

            $files[$index]['srcName'] = $item['name'];    //上传图片的原名字
            $files[$index]['error'] = $item['error'];    //和该文件上传相关的错误代码
            $files[$index]['size'] = $item['size'];        //已上传文件的大小，单位为字节
            $files[$index]['type'] = $item['type'];        //文件的 MIME 类型，需要浏览器提供该信息的支持，例如"image/gif"
            $files[$index]['success'] = false;            //这个用于标志该图片是否上传成功
            $files[$index]['path'] = '';                //存图片路径

            // 接收过程有没有错误
            if($item['error'] != 0) continue;
            //判断图片能不能上传
            if(!is_uploaded_file($item['tmp_name'])) {
                $files[$index]['error'] = 8000;
                continue;
            }
            //扩展名
            $extension = '';
            if(strcmp($item['type'], 'image/jpeg') == 0) {
                $extension = '.jpg';
            }
            else if(strcmp($item['type'], 'image/png') == 0) {
                $extension = '.png';
            }
            else if(strcmp($item['type'], 'image/gif') == 0) {
                $extension = '.gif';
            }
            else {
                //如果type不是以上三者，我们就从图片原名称里面去截取判断去取得(处于严谨性)    
                $substr = strrchr($item['name'], '.');
                if(FALSE == $substr) {
                    $files[$index]['error'] = 8002;
                    continue;
                }

                //取得元名字的扩展名后，再通过扩展名去给type赋上对应的值
                if(strcasecmp($substr, '.jpg') == 0 || strcasecmp($substr, '.jpeg') == 0 || strcasecmp($substr, '.jfif') == 0 || strcasecmp($substr, '.jpe') == 0 ) {
                    $files[$index]['type'] = 'image/jpeg';
                }
                else if(strcasecmp($substr, '.png') == 0) {
                    $files[$index]['type'] = 'image/png';
                }
                else if(strcasecmp($substr, '.gif') == 0) {
                    $files[$index]['type'] = 'image/gif';
                }
                else {
                    $files[$index]['error'] = 8003;
                    continue;
                }
                $extension = $substr;
            }

            //对临时文件名加密，用于后面生成复杂的新文件名
            $md5 = md5_file($item['tmp_name']);
            //取得图片的大小
            $imageInfo = getimagesize($item['tmp_name']);
            $rawImageWidth = $imageInfo[0];
            $rawImageHeight = $imageInfo[1];

            //设置图片上传路径，放在upload文件夹，以年月日生成文件夹分类存储，
            //rtrim(base_url(), '/')其实就是网站的根目录，大家自己处理
//            $path = rtrim(base_url(), '/') . '/upload/' . date('Ymd') . '/';
            $path = rtrim(base_url(), '/') . '/uploadfile/user/base/ID/' . date('Ymd') . '/';
            //确保目录可写
//            ensure_writable_dir($path);
            $this->ensure_writable_dir($path);
            //文件名
            $name = "$md5.0x{$rawImageWidth}x{$rawImageHeight}{$extension}";
            //加入图片文件没变化到，也就是存在，就不必重复上传了，不存在则上传
            $ret = file_exists($path . $name) ? true : move_uploaded_file($item['tmp_name'], $serverPath . $name);
            if($ret === false) {
                $files[$index]['error'] = 8004;
                continue;
            }
            else {
                $files[$index]['path'] = $path . $name;        //存图片路径
                $files[$index]['success'] = true;            //图片上传成功标志
                $files[$index]['width'] = $rawImageWidth;    //图片宽度
                $files[$index]['height'] = $rawImageHeight;    //图片高度
                $success ++;    //成功+1
            }
        }

        //将图片已json形式返回给js处理页面  ，这里大家可以改成自己的json返回处理代码
        echo json_encode(array(
            'total' => count($files),
            'success' => $success,
            'files' => $files,
        ));
    }

/*********************************分割*************************************************/
//这里我附上ensure_writable_dir()函数的代码
/**
* 确保文件夹存在并可写
*
* @param string $dir
*/
//    public function ensure_writable_dir($dir) {
//        if(!file_exists($dir)) {
//            mkdir($dir, 0766, true);
//            chmod($dir, 0766);
//            chmod($dir, 0777);
//        }
//        else if(!is_writable($dir)) {
//            chmod($dir, 0766);
//            chmod($dir, 0777);
//            if(!is_writable($dir)) {
//                throw new FileSystemException("目录 $dir 不可写");
//            }
//        }
//}  
    public function ensure_writable_dir($dir) {
        if(!file_exists($dir)) {
//            if(mkdir($dir, 0777)){
//               return  "OK";
//            };
//            return "yes";
            $f = mkdir($dir,0777);
            if($f){
                return "yes1";
            }
            else{ 
                return $f;
            }
        }else{
            return "yes2";
        }
        
}   

////////////////////////////////////////
//////////////////////////////////////
///////////////////////////////////////
//////////////////////////////////////   
    //处理头像
    public function avatar_upload()
    {
        //配置 路径
    
        $folder = './uploadfile/user/base/ID/'.date("YmdHis").'/';
        $flag = $this->ensure_writable_dir($folder);
//        echo $flag;
        
        if (!isset($_FILES['id_photos']))
        {
            $arr = array('info'=>'false','msg'=>'您没有选择上传的文件！');
            echo json_encode($arr);exit;
        }
        //类型
        $picname = $_FILES['id_photos']['name'];
        $picsize = $_FILES['id_photos']['size'];
        $pictype = $_FILES['id_photos']['type'];
        

        $pid    = 1090;
        $size   = 2048000;

        if ($picsize >$size)
        {
            $num = $size/1024*1000;
            $arr = array('info'=>'false','msg'=>'文件大小不能超过'.$num.'M!');
            echo json_encode($arr);exit;
        }

        $pic_type = array('image/jpeg','image/gif','image/png');
        $pic_end  = pathinfo($picname);
        $pic_end  = $pic_end['extension'];

        if (!in_array($pictype,$pic_type))
        {
            $arr = array('info'=>'false','msg'=>'您上传的文件类型不正确！');
            echo json_encode($arr);exit;
        }

        $new_name = date("YmdHis").rand(100, 999).'.'.$pic_end;

        //上传路径  临时文件夹
        $pic_path = $folder;
        $pic_path_back = substr($pic_path,2);
//        echo $pic_path_back;

        $flag = move_uploaded_file($_FILES['id_photos']['tmp_name'], $pic_path.basename($new_name));
        
        if ($flag)
        {
            $pic_size = round($picsize/1024,2);

            $arr = array(
                   'info'=>'success',
                   'msg'=>'上传成功！',
                   'name'=>$picname,
                   'pic'=>isset($new_name)?$new_name:'',
                   'size'=>$size,
                   'pid'=>$pid,
                   'path' => base_url().$pic_path_back.basename($new_name)
                );
            echo json_encode($arr);exit;
//            $this->session->set_userdata('card_img',$arr['name']); 
        }else
        {
//             $arr = array('info'=>'false','msg'=>'上传失败！');
             $arr = array('info'=>'false','msg'=>$pic_path);
             echo json_encode($arr);exit;
        }
        
        
    }
}