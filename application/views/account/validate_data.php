
                <div class="col-xs-7 col-sm-7">
                    <form class="form-horizontal" role="form" action="<?php echo base_url('index.php/account/account/validate_account_do'); ?>" method="post">
                        

                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <label for="validate_1" class="col-sm-2 control-label">认证信息</label>
                               
                            </div>
                             <hr>
                                 <div class="personal_data_category">
                                    <label for="username" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" id="user_name" name="username"
                                              placeholder="请输入真实姓名" value="<?php if(!empty($user_info['username'])){echo $user_info['username'];}else{set_value('username');}?>">
                                    </div>   
                                    <div class="col-sm-4">
                                        <?php echo form_error('username','<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="personal_data_category">
                                    <label for="sex" class="col-sm-2 control-label">性别</label>
                                    <div class="col-sm-6">
                                        <?php 
                                            if(!isset($user_info['sex'])||$user_info['sex'] == 1|| set_value('sex')==1){
                                                $flag_sex = 1;
                                            }else{
                                                $flag_sex = 0;
                                            }
                                        ?>
                                        <select data-toggle="select" class="form-control select select-default mrs mbm select2-offscreen" tabindex="-1" title="学位" id="sex" name="sex">
                                            <option value="1" <?php if($flag_sex==1){echo "selected";}?>>男</option>
                                            <option value="0" <?php if($flag_sex == 0){echo "selected";}?>>女</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="personal_data_category">
                                    <label for="ID_No" class="col-sm-2 control-label">身份证号</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" id="ID_No" name="ID_No" 
                                              placeholder="请输入身份证号" value="<?php if(isset($user_info['ID_No'])){echo $user_info['ID_No'];}else{set_value('ID_No');}?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo form_error('ID_No','<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    
                                </div>
                                
                        </div>
                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <label for="validate_2" class="col-sm-2 control-label">阅历信息</label>
                               
                            </div>
                             <hr>
                            <div class="personal_data_category">
                                    <label for="study_period" class="col-sm-2 control-label">学业时间</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" id="study_period_start" name="study_period_start"
                                              placeholder="开始时间" onclick="WdatePicker()" value="<?php if(isset($user_info['study_period_start'])){echo $user_info['study_period_start'];}else{set_value('study_period_start');}?>">
                                       
                                    </div>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" id="study_period_end"  name ="study_period_end"
                                          placeholder="截止时间" onclick="WdatePicker()" value="<?php if(isset($user_info['study_period_end'])){echo $user_info['study_period_end'];}else{set_value('study_period_end');}?>">
                                       
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo form_error('study_period_end','<small class="text-danger">', '</small>'); ?>
                                    </div>
                            </div>
                            <div class="personal_data_category">
                                    <label for="work_period" class="col-sm-2 control-label">工作时间</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" id="work_period_start"  name="work_period_start"
                                          placeholder="开始时间" onclick="WdatePicker()" value="<?php if(isset($user_info['work_period_start'])){echo $user_info['work_period_start'];}else{set_value('work_period_start');}?>">
                                       
                                    </div>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" id="work_period_end"  name="work_period_end"
                                          placeholder="截止时间" onclick="WdatePicker()" value="<?php if(isset($user_info['work_period_end'])){echo $user_info['work_period_end'];}else{set_value('work_period_end');}?>">
                                       
                                    </div>
                                    <div class="col-sm-4">
                                        <?php echo form_error('work_period_end','<small class="text-danger">', '</small>'); ?>
                                    </div>
                                    
                            </div>
                        </div>
                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">对于实名认证的说明</div>
                                        <div class="panel-body">
                                            您必须先填写本页面的身份信息，认证通过后才能发布自己的阅历事件。不过如果不认证，并不妨碍您使用网站的其他内容。
                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="personal_item_category ">
                            <div class="personal_data_category">
                                <div class="col-sm-5">
                                    <button class="btn btn-success">
                                    <span class="glyphicon glyphicon-ok"></span>保存并提交审核</button>
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
                                <span class="glyphicon glyphicon-plus"></span> 上传认证照
                            </button>
                        </div>
                        <div class="personal_data_category portrait_center">
                            <p class="portrait_text">请选用如上图姿势的jpg/png/gif格式图片，且大小不超过2M。</p>
                        </div>
                        <div class="personal_data_category">
                            <img src="img/bear.jpg" class="img-thumbnail"><br>
                        </div>
                    </div>
                    
                </div>
            </div>
    </div>
    




