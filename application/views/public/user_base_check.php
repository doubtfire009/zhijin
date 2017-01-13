<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $site_title; ?></title>
        <!--引入CSS-->
        <link rel="stylesheet" type="text/css" href="js/webuploader/webuploader.css">
        <!--引入JS-->
         <script type="text/javascript" src="<?php echo base_url();?>js/jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/public/ajaxfileupload.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/public/account.js"></script>
    </head>
    <body>

        <form action="<?php echo base_url('index.php/public/user_check/personal_data_add_do'); ?>" method="post">
            <div id="user_ID_No_par">
            <?php echo form_error('user_ID_No'); ?>
            <h5>身份证号</h5>
            <input type="text" id = "user_ID_No" name="user_ID_No" value="<?php echo set_value('user_ID_No'); ?>"/>
            <br>
            </div>
            
            <div id ="user_ID_upload_par">
            <h5>上传身份证图像</h5>
            <img id = "imgShow" src="" width="200" height="200">
            <p>点击选择图像</p>
            <input type="hidden" id = "user_ID_upload" name="user_ID_upload" />
            <input type="button" id = "btnUploadImg" name="btnUploadImg" />
            <br>
            <input type="hidden" id="uploadedImg" name="uploadedImg" value="1" />
            </div>
            
            <div>
                <input type="submit" value="确认提交" />
            </div>
        </form>
        
        
    </body>
</html>
