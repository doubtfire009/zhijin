
    <link href="<?php echo base_url('theme/css/shop_main/shop_main.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('theme/css/shop_main/shop_board_info.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('theme/css/account/personal_data.css');?>" rel="stylesheet">
  
        
        
        <div class="container border_color_solid_grey"  style="margin-top: -20px;padding-top: 10px">
            <div class="row">
                
                
                <div class="col-xs-2 col-sm-2">
                    <div class="personal_item_category ">
                        <ul class="nav nav-pills nav-stacked" data-spy="affix"  data-offset-top="10000000000">
                                <li class="<?php if($account_nav_num == 1){echo "active";}?>"><a href="<?php echo base_url('index.php/account/account/basic_account'); ?>">基本信息</a></li>
                                <li class="<?php if($account_nav_num == 2){echo "active";}?>"><a href="<?php echo base_url('index.php/account/account/validate_account'); ?>">我要验证</a></li>
                                <li class="<?php if($account_nav_num == 3){echo "active";}?>"><a href="<?php echo base_url('index.php/account/experience/index'); ?>">我的经历</a></li>
                                <li class="<?php if($account_nav_num == 4){echo "active";}?>"><a href="<?php echo base_url('index.php/account/account/bought_account'); ?>">已购阅经历</a></li>
                                <li class="<?php if($account_nav_num == 5){echo "active";}?>"><a href="<?php echo base_url('index.php/account/account/collection_account'); ?>">我的收藏</a></li>
                            </ul>
                    </div>


                </div>