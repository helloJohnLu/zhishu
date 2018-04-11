$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// 搜索框宽度
$(document).ready(function(){
    $("#searchinput").focusin(function(){
        $("#searchinput").animate({width:'260px'});
    });
    $("#searchinput").focusout(function(){
        $("#searchinput").animate({width:'196px'});
    });
});


// 富文本编辑器
var editor = new wangEditor('content');
if (editor.config) {
    editor.config.uploadImgUrl = '/posts/image/upload';
    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };
    editor.create();
}


// 用户头像预览
$('.preview_input').change(function (event) {
    var file = event.currentTarget.files[0];
    var url = window.URL.createObjectURL(file);

    $(event.target).next(".preview_img").attr("src", url);
});


/* 关注与取消关注 */
$('.like-button').click(function (event) {
    var target = $(event.target);
    var current_like = target.attr('like-value');
    var user_id = target.attr('like-user');
    
    if (current_like == 1) {
        // 取消关注
        $.ajax({
            url: "/user/" + user_id + "/unFollow",
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 0);
                target.text("关注");
            }
        })
    } else {
        // 关注
        $.ajax({
            url: "/user/" + user_id + "/follow",
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 1);
                target.text("取消关注");
            }
        })
    }
});

