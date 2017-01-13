<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $site_title;?></title>
    </head>
    <body>
        <?php 
            
        ?>
        
        <form action="<?php echo base_url('index.php/member/Zj_user/login_do'); ?>" method="post">
            <?php echo form_error('user_account'); ?>
            <h5>手机号/邮箱</h5>
            <input type="text" id = "user_account" name="user_account" value="<?php echo set_value('user_account'); ?>"/>
            <br>
            <?php echo form_error('password'); ?>
            <h5>密码</h5>
            <input type="password" id = "password" name="password" value="<?php echo set_value('password'); ?>"/>
            <div>
                <input type="submit" value="登录" />
            </div>
        </form>
        <div>
            <a href="<?php echo base_url('index.php/member/Zj_user/register'); ?>">注册</a>
        </div>
        
    </body>
</html>
