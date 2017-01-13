/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
  $("button").click(function(){
    $.ajax({
        type:"POST",
        url:"<?php echo base_url('index.php/Product_back/status_change');?>",
    });
  });
});

