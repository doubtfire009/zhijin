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
       
        <!--引入JS-->
         <script type="text/javascript" src="<?php echo base_url();?>js/jquery/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/public/ajaxfileupload.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/public/imgupload1.js"></script>
    </head>
    <body>

       <div data-role="fieldcontain" class="upload-box">
                <label for="id_photos"><span class="red">* </span>您的有效证件照：</label>
                    <input type="file" id="id_photos" name="id_photos" value="上传" style="filter:alpha(opacity=10);-moz-opacity:10;opacity:10;" />            
                <p style="margin-top:0.5em;color:#999;font-size:11pt;">说明：请上传手持证件的半身照，请确保照片内证件信息清晰可读。</p>
        </div>
        <div class="id_photos" >
            
        </div>
        

    </body>
    
</html>
