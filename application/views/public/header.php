<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">

        <title><?php echo $site_title;?></title>
                
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-cache" />
        <!-- Loading Bootstrap -->
        <link href="<?php echo base_url('theme/css/main/bootstrap.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('theme/css/main/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Loading Flat UI -->
        <link href="<?php echo base_url('theme/css/main/flat-ui.css');?>" rel="stylesheet">

        <?php

    if (isset($css)) {
        if (!is_array($css)) {
            echo '<link href="' . base_url($css) . '" rel = "stylesheet">' . "\n";
        } else {
            if (count($css) > 0) {
                foreach ($css as $value) {
                   
                    echo '<link href="' . base_url($value) . '" rel = "stylesheet">' . "\n";
                }
            }
        }
    }
 ?>
        
        
        

    </head>

    <body> 

<nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?php echo base_url('index.php/zhijin/home');?>">指津网</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
              <li><a href="<?php echo base_url('index.php/zhijin/home');?>"><small>学啥专业好</small></a></li>
              <li><a href="<?php echo base_url('index.php/university/university');?>"><small>大学咋招生</small></a></li>
              <li><a href="#"><small>心理压力大</small></a></li>
              <li><a href="#"><small>我啥都懂</small></a></li>
            <li><a href="<?php echo base_url('index.php/account/account');?>"><small>我的账户</small><span class="badge">3</span></a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
              <?php if(!isset($_SESSION['nickname'])){?>
              <li><a href="<?php echo base_url('index.php/member/Zj_user/login');?>"><small>登录/注册</small></a></li>
              <?php }else{?>
              <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="width:110px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">
                        <small class="text-info"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['nickname'];?> </small>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('index.php/member/Zj_user/login_out');?>"><small>退出</small></a></li>
                    </ul>
              </li>
              <?php }?>
              
              
              
              <li><a href="<?php echo base_url('index.php/complain/complain');?>"><small>举报建议</small></a></li>
            
              <li><a href="<?php echo base_url('index.php/about/about');?>"><small>联系我们</small></a></li>
              
          </ul>
        </div>
      </div>
    </nav>
        
       