
                <div class="col-xs-7 col-sm-7">
                    <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/account/account/basic_account_do'); ?>" method="post">
                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <label for="nickname" class="col-sm-3 control-label"><h6>基本信息</h6></label>
                               
                            </div>
                             <hr>
                           
                            <div class="personal_data_category">
                                <label for="mobile" class="col-sm-2 control-label">手机</label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" id="mobile" name="mobile"
                                          placeholder="请输入手机号码" value="<?php echo $user_info['mobile'];?>">
                                </div>  
                                 <div class="col-sm-4">
                                    <?php echo form_error('mobile','<small class="text-danger">', '</small>'); ?>
                                 </div>
                            </div>
                            <div class="personal_data_category">
                                <label for="mobile" class="col-sm-2 control-label">邮箱</label>
                                <div class="col-sm-6">
                                   <input type="text" class="form-control" id="email" name="email"
                                      placeholder="请输入邮箱号码" value="<?php echo $user_info['email'];?>">
                                </div> 
                                <div class="col-sm-4">
                                    <?php echo form_error('email','<small class="text-danger">', '</small>'); ?>
                                 </div>
                            </div>
                            <div class="personal_data_category portrait_center">
                                <label for="mobile_change" class="col-sm-2 control-label">密码</label>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-info btn-xs ">
                                        <span class="glyphicon glyphicon-lock"></span> 修改密码
                                    </button>
                                </div>
                            </div>

                             <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">对于实名认证的说明</div>
                                        <div class="panel-body">
                                            填写了以上内容就可以购阅别人的经历了。您也可以完善“我要验证”中的验证信息来发布自己的经历！加油~
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        </div>

                        
                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <div class="col-sm-5">
                                    <button type="submit" class="btn btn-success" >
                                    <span class="glyphicon glyphicon-ok"></span>保存</button>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-3 col-sm-3">
                    <div class="personal_item_category ">

                        <div class="personal_data_category">
                            <img src="img/bear.jpg" class="img-thumbnail"><br>
                        </div>
                        <div class="personal_data_category portrait_center">
                            <button type="button" class="btn btn-info btn-xs">
                                <span class="glyphicon glyphicon-plus"></span> 上传头像
                            </button>
                        </div>
                        <div class="personal_data_category portrait_center">
                            <p class="portrait_text">该图与账号绑定使用。请选用jpg/png/gif格式图片，且大小不超过2M。</p>
                        </div> 
                    </div>
                
                    
                </div>
            </div>
    </div>
    




