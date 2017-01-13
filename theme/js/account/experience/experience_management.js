$("#ex_title_add_bt").click(function(){
             $.ajax({
                 type: "post",
                 url: 'account/experience/experience_title_dealer',     
                 data: $("#form1").serialize(),    
                 success: function(data) {
                     alert("提交成功！");
                 },
                 error: function(data) {
                     alert(data);
                 }
             })
         });