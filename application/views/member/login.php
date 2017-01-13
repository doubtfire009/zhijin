
        <div class="container" >
        <div class="row">
          <div class="col-xs-12 col-sm-6" >
              <img src="<?php echo base_url('theme/img/2016.1.7.jpg');?>" class="img-responsive">
              <img src="<?php echo base_url('theme/img/2016.1.7.1.jpg');?>" class="img-responsive clearfix visible-lg">
          </div>
          <div class="col-xs-12 col-sm-6" style="margin-top: 60px;">
              <form name="account_login" class="form-horizontal" role="form" action="<?php echo base_url('index.php/member/Zj_user/login_do'); ?>" method="post">
   <div class="form-group">
       <label for="user_account" class="col-sm-2 control-label">用户名</label>
       
      <div class="col-sm-6">
         <input type="text" class="form-control" id="user_account" name="user_account"
                placeholder="请输入手机或邮箱" value="<?php echo set_value('user_account'); ?>">
      </div>
       <div class="col-sm-4">
           <?php echo form_error('user_account','<small class="text-danger">', '</small>'); ?>
       </div>
       
   </div>
   <div class="form-group">
      <label for="password" class="col-sm-2 control-label">密码</label>
      
      <div class="col-sm-6">
         <input type="password" class="form-control" id="password" name="password"
            placeholder="请输入密码" value="">
         <a href="<?php echo base_url('index.php/member/Zj_user/password_get'); ?>" class="sm_font">找回密码</a>
      </div>
      <div class="col-sm-4">
           <?php echo form_error('password','<small class="text-danger">', '</small>'); ?>
       </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-4" style="margin-left: -10px;">
         <div class="checkbox">
            <label for="login_auto" class="checkbox">
                <input type="checkbox" data-toggle="checkbox" id="login_auto" name="login_auto" value="1" class="custom-checkbox"style="margin-right: 10px">
                                 
                                    请记住我
            </label>  
             
         </div>
      </div>
       
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-primary">登录</button>
         <a href="<?php echo base_url('index.php/member/Zj_user/register'); ?>"  target="_blank"><small class="text-info">免费注册</small></a>
        
      </div>
   </div>
         </form>

          </div>
          

        </div>
            


    </div>
<script type="javascript">
function openpage()
{
window.location.href='<?php echo base_url('index.php/member/Zj_user/register');?>';
//alert("<?php echo base_url('index.php/member/Zj_user/register');?>");
}
</script>


