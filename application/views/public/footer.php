<footer class="footer ">
    <div class="container">
        <ul class="nav nav-pills">
   <li class="active"><a href="#">Home</a></li>
   <li><a href="#">SVN</a></li>
   <li><a href="#">iOS</a></li>
   <li><a href="#">VB.Net</a></li>
   <li><a href="#">Java</a></li>
   <li><a href="#">PHP</a></li>
</ul>

    </div>
</footer>

            
            
            
            <script src="<?php echo base_url('theme/js/main/jquery.min.js');?>"></script>
            
            <script src="<?php echo base_url('theme/js/main/flat-ui.js');?>"></script>
            <script src="<?php echo base_url('theme/js/main/prettify.js');?>"></script>
            <script src="<?php echo base_url('theme/js/main/application.js');?>"></script>
            <script src="<?php echo base_url('theme/js/main/My97DatePicker/WdatePicker.js');?>"></script>
            <script src="<?php echo base_url('theme/js/highcharts/js/highcharts.js');?>"></script>
            <script src="<?php echo base_url('theme/js/highcharts/js/modules/exporting.js');?>"></script>

            
            
            
<?php

    if (isset($js)) {
        if (!is_array($js)) {
            echo '<script type="text/javascript" src="' . base_url($js) . '"></script>' . "\n";
        } else {
            if (count($js) > 0) {
                foreach ($js as $value) {
                    echo '<script type="text/javascript" src="' . base_url($value) . '"></script>' . "\n";
                }
            }
        }
    }
 ?>
    </body>
</html>
