
        
        <div class="container" >
        <div class="row">
          <div class="col-xs-12 col-sm-6" >
              <img src="<?php echo base_url('theme/img/2016.1.7.jpg');?>" class="img-responsive">
              <img src="<?php echo base_url('theme/img/2016.1.7.1.jpg');?>" class="img-responsive clearfix visible-lg">
          </div>
          <div class="col-xs-12 col-sm-6" style="margin-top: 60px;">
              <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/member/Zj_user/register_do'); ?>" method="post">
             <input type="hidden"  id="location_flag" name="location_flag" value="mobile" >  
    <div class="form-group" >
      <label for="user_account" class="col-sm-2 control-label">手机</label>
      <div class="col-sm-6">
          <input type="text" class="form-control" id="user_account"  name="user_account"
            placeholder="请输入手机" value="<?php echo set_value('user_account'); ?>">
         <a href="<?php echo base_url('index.php/member/Zj_user/register_email');?>" class="sm_font">使用邮箱注册</a>
      </div>
       <div class="col-sm-4">
           <?php echo form_error('user_account','<small class="text-danger">', '</small>'); ?>
       </div>
   </div>
   <div class="form-group">
      <label for="password" class="col-sm-2 control-label">密码</label>
      <div class="col-sm-6">
          <input type="password" class="form-control" id="password"  name="password" 
                 placeholder="请输入密码" value="">
      </div>
      <div class="col-sm-4">
           <?php echo form_error('password','<small class="text-danger">', '</small>'); ?>
       </div>
   </div>
    <div class="form-group">
      <label for="confirm_password" class="col-sm-2 control-label">再次输入密码</label>
      <div class="col-sm-6">
          <input type="password" class="form-control" id="confirm_password"  name="confirm_password"
            placeholder="请再次输入密码">
      </div>
      <div class="col-sm-4">
           <?php echo form_error('confirm_password','<small class="text-danger">', '</small>'); ?>
       </div>
   </div>
    <div class="form-group" >
      <label for="nickname" class="col-sm-2 control-label">昵称</label>
      <div class="col-sm-6">
          <input type="text" class="form-control" id="user_account"  name="nickname"
            placeholder="中英文2-10字，可用下划线" value="<?php echo set_value('nickname'); ?>">
      </div>
       <div class="col-sm-4">
           <?php echo form_error('nickname','<small class="text-danger">', '</small>'); ?>
       </div>
   </div>
   <div class="form-group">
      
       <div class="col-sm-6" style="margin-left: -30px;">
         <div class="checkbox">
            <label for="agreement" class="checkbox">
                <input type="checkbox" data-toggle="checkbox" id="agreement" name="agreement" value="1" class="custom-checkbox"style="margin-right: 10px">
                                 
                                    我已阅读并同意相关协议
            </label>  
             
         </div>
      </div>
       <div class="col-sm-4" style="margin-top: -6px">
         <?php echo form_error('agreement','<small class="text-danger" >', '</small>'); ?>
      </div>
   </div>
   <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
         <button type="submit" class="btn btn-primary">确定</button>
         <a href="<?php echo base_url('index.php/member/Zj_user/login'); ?>"  target="_blank"><small class="text-info">直接登录</small></a>
      </div>
   </div>
</form>
          </div>
          

        </div>
            


    </div>



