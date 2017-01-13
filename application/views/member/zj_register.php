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
    </head>
    <body>

        <form action="<?php echo base_url('index.php/member/Zj_user/register_do'); ?>" method="post">
            <?php echo form_error('user_account'); ?>
            <h5>手机号/邮箱</h5>
            <input type="text" id = "user_account" name="user_account" value="<?php echo set_value('user_account'); ?>"/>
            <br>
            <?php echo form_error('password'); ?>
            <h5>密码</h5>
            <input type="password" id = "password" name="password" value=""/>
            <br>
            <?php echo form_error('confirm_password'); ?>
            <h5>确认密码</h5>
            <input type="password" id = "confirm_password" name="confirm_password" value=""/>
            <br>
            <?php echo form_error('nickname'); ?>
            <h5>昵称</h5>
            <input type="text" id = "nickname" name="nickname" value="<?php echo set_value('nickname'); ?>"/>
            <div>
                <input type="submit" value="确认注册" />
            </div>
        </form>
        <div>
            <a href="<?php echo base_url('index.php/member/Zj_user/login'); ?>"><input type="submit" value="直接登录" /></a>
        </div>
        
    </body>
</html>
