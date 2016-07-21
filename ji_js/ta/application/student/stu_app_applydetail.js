function wordStatic(value) {
    var length = 0;
    if (value) {
        // 替换中文字符为空格
        value = value.replace(/[\u4e00-\u9fa5]+/g, " ");
        // 将换行符，前后空格不计算为单词数
        value = value.replace(/\n|\r|^\s+|\s+$/gi,"");
        // 多个空格替换成一个空格
        value = value.replace(/\s+/gi," ");
        // 更新计数
        var match = value.match(/\s/g);
        if (match) {
            length = match.length + 1;
        } else if (value) {
            length = 1;
        }
    }
    return length;
}

$(document).ready(function () {
    $('#strip-2').addClass('current');
    $('#button-2').addClass('current');

    $('.reprocess').click(function (event) {
        event.preventDefault();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if (!reg.test($('#email').val()))
        {
            alert("The Email address is invalid.");
            return;
        }
        if (wordStatic($('#introduction').val())<20)
        {
            alert("The self-introduction should be more than 20 words.");
            return;
        }
        if (wordStatic($('#introduction').val())>1000)
        {
            alert("The self-introduction should be less than 1000 words.");
            return;
        }
        if (wordStatic($('#comment').val())==0)
        {
            alert("Please input the comment.");
            return;
        }
        if (wordStatic($('#comment').val())>500)
        {
            alert("The comment should be less than 500 words.");
            return;
        }
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        var $box = $('#reprocess-box');
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });

    $('#bg').click(function () {
        //resetBorderColor();
        $(this).css("cursor", "default");
        $(this).stop().animate({opacity: "toggle"}, 300);
        $('.box').css("display", "none");
        $("body").css({overflow: "visible"});
        $('.processing').find('.pass').css("borderColor", "rgb(255,205,0)");
        $('.processing').find('.reprocess').css("borderColor", "rgb(255,205,0)");
        $('.processing').removeClass('processing');
    });

    $('.box .no').click(function () {
        //resetBorderColor();
        $('#bg').css("cursor", "default");
        $('#bg').animate({opacity: 'toggle'}, 300);
        $('.box').css("display", "none");
        $("body").css({overflow: "visible"});
        $('.processing').find('.pass').css("borderColor", "rgb(255,205,0)");
        $('.processing').removeClass('processing');
    });
});