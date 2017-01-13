<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">

        <title><?php echo $site_title;?></title>

        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="<?php echo base_url('theme/css/main/bootstrap.css');?>" rel="stylesheet">

    <!-- Loading Flat UI -->
        <link href="<?php echo base_url('theme/css/main/flat-ui.css');?>" rel="stylesheet">


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
          <a class="navbar-brand" href="#">指津网</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">学啥专业好</a></li>
            <li><a href="#">大学咋招生</a></li>
            <li><a href="#">心理压力大</a></li>
            <li><a href="#">我啥都懂</a></li>
            <li><a href="#">我的账户<span class="badge">3</span></a></li>

          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">登录/注册</a></li>
            <li><a href="#">举报投诉</a></li>
            
            <li><a href="#">联系我们</a></li>
          </ul>
        </div>
      </div>
    </nav>
        
        <div class="container" >
        <div class="row">
          <div class="col-xs-12 col-sm-6" >
              <img src="<?php echo base_url('theme/img/2016.1.7.jpg');?>" class="img-responsive">
              <img src="<?php echo base_url('theme/img/2016.1.7.1.jpg');?>" class="img-responsive clearfix visible-lg">
          </div>
          <div class="col-xs-12 col-sm-6" style="margin-top: 60px;">
              <form class="form-horizontal" role="form">
   <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">用户名</label>
      <div class="col-sm-6">
         <input type="text" class="form-control" id="firstname" 
            placeholder="请输入手机或邮箱">
      </div>
   </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">密码</label>
      <div class="col-sm-6">
         <input type="password" class="form-control" id="lastname" 
            placeholder="请输入密码">
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-6">
         <div class="checkbox">
            <label for="checkbox1" class="checkbox">
                <input type="checkbox" data-toggle="checkbox" id="checkbox1" value="" class="custom-checkbox"style="margin-right: 10px">
                                 
                                    请记住我
            </label>  
         </div>
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-primary">登录</button>
         <button type="submit" class="btn btn-success">注册</button>
      </div>
   </div>
</form>
          </div>
          

        </div>
            


    </div>
            <footer class="footer ">
    <div class="container">
        <ul class="nav nav-pills">
   <li class="active"><a href="#">Home</a></li>
   <li><a href="#">SVN</a></li>
   <li><a href="#">iOS</a></li>
   <li><a href="#">VB.Net</a></li>
   <li><a href="#">Java</a></li>
   <li><a href="#">PHP</a></li>
</ul>

    </div>
</footer>

            
            
            
            <script src="<?php echo base_url('theme/js/main/jquery.min.js');?>"></script>
            
            <script src="<?php echo base_url('theme/js/main/flat-ui.js');?>"></script>
            <script src="<?php echo base_url('theme/js/main/prettify.js');?>"></script>
            <script src="<?php echo base_url('theme/js/main/application.js');?>"></script>
    </body>
</html>


