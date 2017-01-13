/**
*	上传头像
*	@version jquery 1.8.3
*	@author lzy <hn.lizhiyu@163.com>
*       @date 2015-12-25
*
*/


$(function ()
{
//	var jcrop_api;
//	//账户头像
//	var bar      = $('.bar');
//	var percent  = $('.percent');
//	var progress = $(".progress");
//	var files    = $(".files");
//	var btn      = $(".btn span");
//	var showimg  = $('#showimg1');
    //账户
    $('#user_ID_upload_par').delegate('#user_ID_upload','click',function ()
    {
    	var type = $(this).siblings('#uploadedImg').val();
    	
        ajax_upload('/member/zj_account/avatar_upload','upload_account',type,"1090",'2048000');
         
    })


	//上传
	function ajax_upload (url,name,type,pid,size)
    {
        $.ajaxFileUpload({
            url:url,
            secureuri:false,
            type: 'post',
            fileElementId:name,
            dataType: 'json',
            data:{type:type,pid:pid,size:size},
            success:function (data)
            {
                alert(data.msg);
            },
            error:function(xhr){
                $("#btn"+type).html("上传失败");
            }


        })
    }


});





	


    


