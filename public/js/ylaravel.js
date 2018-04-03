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

editor.config.uploadImgUrl = '/posts/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();