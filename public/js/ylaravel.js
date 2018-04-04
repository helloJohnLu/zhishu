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

