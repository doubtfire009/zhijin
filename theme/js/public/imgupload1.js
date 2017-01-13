
$(document).ready(function(){
    //照片异步上传
//        $('#id_photos').change(function(){  //此处用了change事件，当选择好图片打开，关闭窗口时触发此事件
        $('#id_photos').live('change',function(){  //此处用了change事件，当选择好图片打开，关闭窗口时触发此事件
        $.ajaxFileUpload({

//        url:'Zj_account/imgupload',   //处理图片的脚本路径
//        url:'Zj_account/simple',   //处理图片的脚本路径
        url:'Zj_account/avatar_upload',   //处理图片的脚本路径
        type: 'post',       //提交的方式
        secureuri :false,   //是否启用安全提交
        fileElementId :'id_photos',     //file控件ID
        dataType : 'JSON',  //服务器返回的数据类型  
//        data:{pid:52111},
        success : function (data, status){  //提交成功后自动执行的处理函数
//            if(1 != data.total) return;　　 //因为此处指允许上传单张图片，所以数量如果不是1，那就是有错误了
            var dataObj=eval("("+data+")");//转换为json对象 
//            $.each(dataObj.path, function(i, item){
//                $('.id_photos').empty();
//                $('.id_photos').append('<img src="'+item+'" value="'+item+'" style="width:80%" >');
//                $("p").append(item + " ");
//                
//            } );
//            $.each(dataObj.path, function(i, field){
//                $("p").append(field + " ");
//            });
//            $("p").append(data.path + " ");
            var url = dataObj.path;            
            $('.id_photos').empty();
            //此处效果是：当成功上传后会返回一个json数据，里面有url，取出url赋给img标签，然后追加到.id_photos类里显示出图片
            $('.id_photos').append('<img src="'+url+'" value="'+url+'" style="width:80%"  width="200" height="200">');
//            //$('.upload-box').remove();
            alert(dataObj.path);
        },
            
        error: function(data, status, e){   //提交失败自动执行的处理函数
            alert(e);
        }
         })
    });
});


