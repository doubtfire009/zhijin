               <div class="col-xs-10 col-sm-10">
                    <ul class="nav nav-tabs">
                        <?php foreach($nav_1 as $k=>$v){?>
                            <li class="<?php if($experience_life_nav_num_s==$k){echo "active"; }?>"><a href="<?php echo base_url('index.php/account/experience/experience_study/'.$k.'/0/0'); ?>"><?php echo $v['title'];?></a></li>
                        <?php }?> 
                     </ul>
                    <hr>
                    <ul class="nav nav-tabs">
                        <?php foreach($nav_2 as $k=>$v){?>
                            <li class="<?php if($experience_life_level_s==$k){echo "active"; }?> dropdown">
           
                                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url('index.php/account/experience/experience_study/'.$experience_life_nav_num_s.'/'.$k.'/0'); ?>">
                                 <?php echo $v['title'];?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu"> 
                                            <?php foreach($experience_title as $key=>$value){
                                                if(sizeof($value['experience_arr'][0]) == 3){
                                                    if(substr($value['experience_id'],0,3) == $v['experience_id']){?>
                                    <li class="<?php if($experience_life_nav_num_s == ($value['experience_arr'][0][0]-1) && $experience_life_level_s == ($value['experience_arr'][0][1]-1) && $experience_life_level_grade_s == ($value['experience_arr'][0][2]-1)){echo "active";}?>"><a href="<?php echo base_url('index.php/account/experience/experience_study/'.($value['experience_arr'][0][0]-1).'/'.($value['experience_arr'][0][1]-1).'/'.($value['experience_arr'][0][2]-1)); ?>"><?php echo $value['title'];?></a></li>
                                                   <?php }
                                                }
                                            }?>
                                </ul>
                            </li>
                        <?php }?>
                    </ul>
 </div>