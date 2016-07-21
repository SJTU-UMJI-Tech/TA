function resetBorderColor() {
    $('.submit').css("borderColor", "rgb(255,205,0)");
}

function resetCourseidColor() {
    $('.sidebar .choose-course td').css({
        "backgroundColor": "rgb(0,47,92)",
        "color": "white"
    }).find('img').attr("src", "/ji_style/images/arrow.png").addClass('hidden').css("marginLeft", "10px");
}

function resetStatusColor() {
    $('.apply .sidebar .choose-status td').css({
        "backgroundColor": "rgb(0,47,92)",
        "color": "white"
    }).find('img').attr("src", "/ji_style/images/arrow.png").addClass('hidden').css("marginLeft", "10px");
}

function stringSize(string) {
    var len = 0;
    for (var i = 0; i < string.length; i++) {
        if (string.charCodeAt(i) > 127) {
            len += 2.5;
        } else if (string.charCodeAt(i) == 94 || string.charCodeAt(i) == 64) {
            len += 2;
        }
        else {
            len++;
        }
    }
    return len;
}

function getCourseInfo(currentCourseid) {

    $('.list .application-status span.courseid').text(ucfirst(currentCourseid));
    $('.list .application-status span.status').text(($('#class_data #' + currentCourseid).attr("status") == 1) ? "Open" : "Close");
    if ($('.list .application-status .status').text() == "Close") {
        $('.list .application-status .change').attr("value", "Open Application");
        $('#form_status').val("1");
    }
    else {
        $('.list .application-status .change').attr("value", "Close Application");
        $('#form_status').val("0");
    }

    $('.list .course-information .course_id').val(ucfirst($('#class_data #' + currentCourseid).attr("KCDM")));
    $('.list .course-information .course_title').val($('#class_data #' + currentCourseid).attr("KCZWMC"));
    $('.list .course-information .name').val($('#class_data #' + currentCourseid).attr("XM"));
    $('.list .course-information .semester').val($('#class_data #' + currentCourseid).attr("XQ"));
    $('.list .course-information .year').val($('#class_data #' + currentCourseid).attr("XN"));
    $('.list .course-information .description').val($('#class_data #' + currentCourseid).attr("KCJJ"));
    $('.list .course-information .max').val($('#class_data #' + currentCourseid).attr("maxta"));
    $('.list .course-information .current').val($('#class_data #' + currentCourseid).attr("curta"));
    $('.list .course-information .salary').val($('#class_data #' + currentCourseid).attr("salary"));
    $('.list .course-information .email').val($('#class_data #' + currentCourseid).attr("email"));

    $('.list .input_text').each(function () {
        $(this).attr("size", stringSize($(this).val())+1);
    });

    $('#form_BSID').val($('#class_data #' + currentCourseid).attr("BSID"));
    $('#form_BSID2').val($('#class_data #' + currentCourseid).attr("BSID"));
}

function ucfirst(string) {
    return (string.substring(0, 1).toUpperCase() + string.substring(1));
}

$(document).ready(function () {
    var id = 0;
    var studentid = "";
    var courseid = "";
    var time = "";
    var reason = ""; //html
    var reason_content = "";  //text
    var currentCourseid = "all";
    var currentStatus = "all";
    var isModified = 0;
    var lastProcess = "";
    $('.header tr.button td.notspace').hover(function () {
        $(this).css('cursor', 'pointer');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css({'backgroundColor': 'rgb(245,245,245)', 'transition': '0.5s all'});
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css({'backgroundColor': 'rgb(255,205,0)', 'transition': '0.5s all'});
        }
    }, function () {
        $(this).css('cursor', 'default');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css('backgroundColor', 'white');
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css('backgroundColor', 'rgb(245,245,245)');
        }
    });
    $('.header tr.button td.notspace').click(function (event) {
        event.preventDefault();
        location.href = $(this).find('a').attr('href');
    });

    $('.apply tr.button td.notspace').hover(function () {
        $(this).css('cursor', 'default');
        $(this).find('a').css('cursor', 'default');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css('cursor', 'pointer');
            $(this).find('a').css('cursor', 'pointer');
            $(this).css({'backgroundColor': 'white', 'transition': '0.5s all'});
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css({'backgroundColor': 'rgb(255,205,0)', 'transition': '0.5s all'});
            $('.apply .button .current').css({'backgroundColor': 'rgb(245,245,245)', 'transition': '0.5s all'});
            $num = $('.apply .button .current').attr('id')[7];
            $stripid = '#strip-' + $num;
            $($stripid).css({'backgroundColor': 'rgb(245,245,245)', 'transition': '0.5s all'});
        }
    }, function () {
        $(this).css('cursor', 'default');
        if ($(this).attr('class') != 'notspace current') {
            $(this).css('backgroundColor', 'rgb(245,245,245)');
            var $num = $(this).attr('id')[7];
            var $stripid = '#strip-' + $num;
            $($stripid).css('backgroundColor', 'rgb(245,245,245)');
            $('.apply .button .current').css({'backgroundColor': 'white', 'transition': '0.5s all'});
            $num = $('.apply .button .current').attr('id')[7];
            $stripid = '#strip-' + $num;
            $($stripid).css({'backgroundColor': 'rgb(255,205,0)', 'transition': '0.5s all'});
        }
    });

    $('.apply tr.button td.notspace').click(function (event) {
        event.preventDefault();
        if ($(this).attr('class') != 'notspace current') {
            location.href = $(this).find('a').attr('href');
        }
    });

    if ($('.apply .text-container').length == 0) {
        $('.apply .isEmpty').removeClass('hidden');
    }

    $('.sidebar .choose-course td').each(function () {
        if ($(this).text().toLowerCase() == currentCourseid) {
            resetCourseidColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
        }
    });


    $('.sidebar .choose-course td').hover(function () {
        if (!$(this).hasClass("empty")) {
            if (currentCourseid != $(this).text().toLowerCase()) {
                $(this).css({'backgroundColor': 'rgb(0,121,242)', 'cursor': 'pointer'});
                $(this).find('img').addClass('hidden').css("marginLeft", "10px");
                $(this).find('img').removeClass('hidden').stop().animate({"marginLeft": "40px"}, 500);
            } else {
                $(this).css({'cursor': 'default'});
            }
        }
    }, function () {
        if (!$(this).hasClass("empty")) {
            if (currentCourseid != $(this).text().toLowerCase()) {
                $(this).css({'backgroundColor': 'rgb(0,47,92)', 'cursor': 'default'});
                $(this).find('img').addClass('hidden').css("marginLeft", "10px");
            }
        }
    });

    $('.apply .sidebar .choose-course td').click(function () {
        if (!$(this).hasClass("empty")) {
            $('.apply .isEmpty').addClass('hidden');
            resetCourseidColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
            currentCourseid = $(this).text().toLowerCase();
            $('.apply .text-container').each(function () {
                $(this).removeClass('hidden');
            });
            if (currentCourseid != "all") {
                $('.apply .text-container').each(function () {
                    if ($(this).find('.courseid').text().toLowerCase() != currentCourseid) {
                        $(this).addClass('hidden');
                    }
                });
            }
            if (currentStatus != "all") {
                $('.apply .text-container').each(function () {
                    if ($(this).find('.status').text().toLowerCase().indexOf(currentStatus) == -1) {
                        $(this).addClass('hidden');
                    }
                });
            }
            var isEmpty = 1;
            $('.apply .text-container').each(function () {
                if (!$(this).hasClass('hidden')) {
                    isEmpty = 0;
                }
            });
            if (isEmpty == 1) {
                $('.apply .isEmpty').removeClass('hidden');
            }
        }
    });

    $('.apply .sidebar .choose-status td').each(function () {
        if ($(this).text().toLowerCase() == currentStatus) {
            resetStatusColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
        }
    });

    $('.apply .sidebar .choose-status td').hover(function () {
        if (!$(this).hasClass("empty")) {
            if (currentStatus != $(this).text().toLowerCase()) {
                $(this).css({'backgroundColor': 'rgb(0,121,242)', 'cursor': 'pointer'});
                $(this).find('img').addClass('hidden').css("marginLeft", "10px");
                $(this).find('img').removeClass('hidden').stop().animate({"marginLeft": "40px"}, 500);
            } else {
                $(this).css({'cursor': 'default'});
            }
        }
    }, function () {
        if (!$(this).hasClass("empty")) {
            if (currentStatus != $(this).text().toLowerCase()) {
                $(this).css({'backgroundColor': 'rgb(0,47,92)', 'cursor': 'default'});
                $(this).find('img').addClass('hidden').css("marginLeft", "10px");
            }
        }
    });

    $('.apply .sidebar .choose-status td').click(function () {
        if (!$(this).hasClass("empty")) {
            $('.apply .isEmpty').addClass('hidden');
            resetStatusColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
            currentStatus = $(this).text().toLowerCase();
            $('.apply .text-container').each(function () {
                $(this).removeClass('hidden');
            });
            if (currentCourseid != "all") {
                $('.apply .text-container').each(function () {
                    if ($(this).find('.courseid').text().toLowerCase() != currentCourseid) {
                        $(this).addClass('hidden');
                    }
                });
            }
            if (currentStatus != "all") {
                $('.apply .text-container').each(function () {
                    if ($(this).find('.status').text().toLowerCase().indexOf(currentStatus) == -1) {
                        $(this).addClass('hidden');
                    }
                });
            }
            var isEmpty = 1;
            $('.apply .text-container').each(function () {
                if (!$(this).hasClass('hidden')) {
                    isEmpty = 0;
                }
            });
            if (isEmpty == 1) {
                $('.apply .isEmpty').removeClass('hidden');
            }
        }
    });

    $('.apply .text-container').each(function () {
        if ($(this).find('.status').text().toLowerCase().indexOf("reject") == -1) {
            $(this).find('.reject_reason').remove();
        }
    });

    $('.apply .up-down').hover(function () {
        $(this).css('cursor', 'pointer');
        if ($(this).attr('src') == '/ji_style/images/down.png') {
            $(this).attr('src', '/ji_style/images/down2.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/up.png') {
            $(this).attr('src', '/ji_style/images/up2.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/down2.png') {
            $(this).attr('src', '/ji_style/images/down.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/up2.png') {
            $(this).attr('src', '/ji_style/images/up.png');
            return;
        }
    }, function () {
        $(this).css('cursor', 'default');
        if ($(this).attr('src') == '/ji_style/images/down.png') {
            $(this).attr('src', '/ji_style/images/down2.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/up.png') {
            $(this).attr('src', '/ji_style/images/up2.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/down2.png') {
            $(this).attr('src', '/ji_style/images/down.png');
            return;
        }
        if ($(this).attr('src') == '/ji_style/images/up2.png') {
            $(this).attr('src', '/ji_style/images/up.png');
            return;
        }
    });

    $('.apply .up-down').click(function () {
        var $text_container = $(this).parents('.text-container');
        if ($(this).attr('src') == '/ji_style/images/down2.png') {
            resetBorderColor();
            $(this).attr('src', '/ji_style/images/up.png');
            $text_container.css('borderColor', 'rgb(0,121,242)');
        }
        else {
            $(this).attr('src', '/ji_style/images/down2.png');
            $text_container.css('borderColor', 'rgb(255,205,0)');
            if ($text_container.find('.time').css("opacity") != 0 && $text_container.find('.time').css("display") != "none") {
                $text_container.find('.time').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
            }
            if ($text_container.find('.reason').css("opacity") != 0 && $text_container.find('.reason').css("display") != "none") {
                $text_container.find('.reason').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
            }
        }
        $text_container.find('.extra-information').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        $text_container.find('.choices').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
    });

    $('.apply .choices .pass').click(function (event) {
        event.preventDefault();
        resetBorderColor();
        $(this).css("borderColor", "rgb(0,121,242)");
        var $text_container = $(this).parents(".text-container");
        $text_container.addClass("processing");
        id = $text_container.find('.form_id').val();
        studentid = $text_container.find('.studentid').text();
        courseid = $text_container.find('.courseid').text();
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        if ($text_container.find('.time').css("opacity") != 0 && $text_container.find('.time').css("display") != "none") {
            $text_container.find('.time').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
        if ($text_container.find('.reason').css("opacity") != 0 && $text_container.find('.reason').css("display") != "none") {
            $text_container.find('.reason').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
        var $box = $('#pass-box');
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });

    $('#pass-yes').click(function () {
        var requestData = {status: 1, id: id};
        $.post("/Pro_class/process", requestData, function (data) {
            location.href = "/ta/application/Teacher/process_success"
        });
    });

    $('.apply .choices .interview').click(function (event) {
        event.preventDefault();
        resetBorderColor();
        var $text_container = $(this).parents('.text-container');
        if ($text_container.find('.time').css("opacity") != 0 && $text_container.find('.time').css("display") != "none") {
            $(this).css("borderColor", "rgb(255,205,0)");
        }
        else {
            $(this).css("borderColor", "rgb(0,121,242)");
        }
        $text_container.find('.time').animate({height: 'toggle', opacity: 'toggle'}, 500);
        if ($text_container.find('.reason').css("opacity") != 0 && $text_container.find('.reason').css("display") != "none") {
            $text_container.find('.reason').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
    });

    $('.apply .interview-submit').click(function (event) {
        event.preventDefault();
        var $text_container = $(this).parents('.text-container');
        studentid = $text_container.find('.studentid').text();
        courseid = $text_container.find('.courseid').text();
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        id = $text_container.find('.form_id').val();
        time = $text_container.find(".interview-time").val();
        var $box = $('#interview-box');
        $box.find('#changetime').text(time + "?");
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });

    $('#interview-yes').click(function () {
        var requestData = {status: 2, id: id, interviewtime: time};
        $.post("/Pro_class/process", requestData, function (data) {
            location.href = "/ta/application/Teacher/process_success"
        });
    });

    $('.apply .choices .reject').click(function (event) {
        event.preventDefault();
        resetBorderColor();
        var $text_container = $(this).parents('.text-container');
        if ($text_container.find('.reason').css("opacity") != 0 && $text_container.find('.reason').css("display") != "none") {
            $(this).css("borderColor", "rgb(255,205,0)");
        }
        else {
            $(this).css("borderColor", "rgb(0,121,242)");
        }
        $text_container.find('.reason').animate({height: 'toggle', opacity: 'toggle'}, 500);
        if ($text_container.find('.time').css("opacity") != 0 && $text_container.find('.time').css("display") != "none") {
            $text_container.find('.time').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
        $text_container.find('.reason input').each(function () {
            $(this).attr('checked', false);
        });
        $text_container.find('.reason textarea').addClass("hidden");
    });

    $('.apply .reason .other-reasons').change(function () {
        $(this).parent().find('textarea').val("").toggleClass("hidden");
    });

    $('.apply .reject-submit').click(function (event) {
        var isFilled = 1;
        var isChecked = 0;
        var $text_container = $(this).parents('.text-container');
        event.preventDefault();
        id = $text_container.find('.form_id').val();
        studentid = $text_container.find('.studentid').text();
        courseid = $text_container.find('.courseid').text();
        reason = "<p style='word-break: normal; padding-left: 2em; padding-right: 2em'>";
        reason_content = "";
        var count = 1;
        $text_container.find('.reason input').each(function () {
            if (this.checked) {
                isChecked = 1;
                if ($(this).val() == "other") {
                    if ($text_container.find('.reasons-content').val() == "") {
                        isFilled = 0;
                    }
                    reason += (count + ". " + $text_container.find('.reasons-content').val() + "<br />");
                    reason_content += (count + ". " + $text_container.find('.reasons-content').val() + "\n");
                }
                else {
                    reason += (count + ". " + $(this).next().text() + "<br />");
                    reason_content += (count + ". " + $(this).next().text() + "\n");
                }
                count += 1;
            }
        });
        if (isChecked == 0) {
            alert("Please select at least one reason.");
            return;
        }
        if (isFilled == 0) {
            alert("Please input the reasons.");
            return;
        }
        reason += "</p>";
        $('#reject-box .text').html("<p class=\"question\">Are you sure to reject for the following reasons?</p>");
        $('#reject-box p.question').after(reason);
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        var $box = $('#reject-box');
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });

    $('#reject-yes').click(function () {
        var requestData = {status: -1, id: id, rejectreason: reason_content};
        $.post("/Pro_class/process", requestData, function (data) {
            location.href = "/ta/application/Teacher/process_success"
        });
    });

    $('.apply .choices .reprocess').click(function (event) {
        event.preventDefault();
        resetBorderColor();
        $(this).css("borderColor", "rgb(0,121,242)");
        var $text_container = $(this).parents(".text-container");
        $text_container.addClass("processing");
        studentid = $text_container.find('.studentid').text();
        courseid = $text_container.find('.courseid').text();
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        if ($text_container.find('.time').css("opacity") != 0 && $text_container.find('.time').css("display") != "none") {
            $text_container.find('.time').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
        if ($text_container.find('.reason').css("opacity") != 0 && $text_container.find('.reason').css("display") != "none") {
            $text_container.find('.reason').stop().animate({height: 'toggle', opacity: 'toggle'}, 500);
        }
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

    $('.list .sidebar .choose-course td').eq(0).each(function () {
        {
            resetCourseidColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
            currentCourseid = $(this).text().toLowerCase();
        }
    });

    $('.list .sidebar .choose-course td').click(function () {
        if (!$(this).hasClass("empty")) {
            if (isModified == 1) {
                lastProcess = $(this).text().toLowerCase();
                $('#bg').css({
                    height: $(document).height(),
                    cursor: "pointer"
                });
                $('#bg').animate({opacity: 'toggle'}, 300);
                var $box = $('#modify-box2');
                $box.css({
                    left: ($("body").width() - $box.width()) / 2 + "px",
                    top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
                });
                $box.animate({opacity: 'toggle'}, 300);
                $("body").css({overflow: "hidden"});
                return;
            }
            isModified = 0;
            resetCourseidColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
            currentCourseid = $(this).text().toLowerCase();
            getCourseInfo(currentCourseid);
        }
    });

    getCourseInfo(currentCourseid);

    $('.list .course-information img').hover(function () {
        $(this).css("cursor", "pointer");
        if ($(this).prev()[0]) {
            $(this).prev().css({"borderWidth": "3px", "padding": "2px"});
        }
        else {
            $('.list .course-information textarea').css({"borderWidth": "3px", "padding": "8px"});
        }
    }, function () {
        $(this).css("cursor", "default");
        if ($(this).prev()[0]) {
            $(this).prev().css({"borderWidth": "2px", "padding": "3px"});
        }
        else {
            $('.list .course-information textarea').css({"borderWidth": "2px", "padding": "9px"});
        }
    });

    $('.list .course-information img').click(function () {
        $('.list .course-information input').attr("readonly", "readonly").addClass("readonly").css("borderColor", "rgb(145,145,145)");
        $('.list .course-information textarea').attr("readonly", "readonly").addClass("readonly").css("borderColor", "rgb(145,145,145)");
        if ($(this).prev()[0]) {
            $(this).prev().removeAttr("readonly").removeClass("readonly").css("borderColor", "rgb(255,205,0)").select();
        }
        else {
            $('.list .course-information textarea').removeAttr("readonly").removeClass("readonly").css("borderColor", "rgb(255,205,0)").focus();
        }
        $('#bg2').removeClass("hidden");
    });

    $('#bg2').click(function () {
        $(this).addClass("hidden");
        $('.list .course-information input').attr("readonly", "readonly").addClass("readonly").css("borderColor", "rgb(145,145,145)");
        $('.list .course-information textarea').attr("readonly", "readonly").addClass("readonly").css("borderColor", "rgb(145,145,145)");
    });

    $('.list .course-information input').keyup(function (event) {
        if ($(this).attr("readonly") != "readonly") {
            if (event.keyCode == 13) {
                $('#bg2').trigger("click");
            }
            else {
                isModified = 1;
            }
        }
    });

    $('.list .course-information textarea').keyup(function (event) {
        isModified = 1;
    });

    $('.list .course-information input').focus(function () {
        if ($(this).attr("readonly") == "readonly") {
            $('#bg2').trigger("click");
        }
    });

    $('.list .course-information textarea').focus(function () {
        if ($(this).attr("readonly") == "readonly") {
            $('#bg2').trigger("click");
        }
    });

    $('.list .course-information .modify').click(function (event) {
        event.preventDefault();
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        var $box = $('#modify-box');
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });

    $('#modify-yes2').click(function (event) {
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if (!reg.test($('input.email').val())) {
            alert("The Email address is invalid.");
            event.preventDefault();
            return;
        }
    });

    $('#modify-no2').click(function (event) {
        event.preventDefault();
        isModified = 0;
        $('.box').css("display", "none");
        $("body").css({overflow: "visible"});
        $('.processing').find('.pass').css("borderColor", "rgb(255,205,0)");
        $('.processing').removeClass('processing');
        if (lastProcess == "change") {
            $('#bg').css("cursor", "default");
            $('#bg').animate({opacity: 'toggle'}, 300);
            var $box = $('#change-box');
            $box.css({
                left: ($("body").width() - $box.width()) / 2 + "px",
                top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
            });
            $box.animate({opacity: 'toggle'}, 300);
            $("body").css({overflow: "hidden"});
            lastProcess = "";
            return;
        }
        currentCourseid = lastProcess;
        $('.list .sidebar .choose-course td').each(function () {
            if ($(this).text().toLowerCase() == currentCourseid) {
                resetCourseidColor();
                $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
                $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
                $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
                getCourseInfo(currentCourseid);
            }
        });
    });

    $('.list .application-status .change').click(function (event) {
        event.preventDefault();
        if (isModified == 1) {
            lastProcess = "change";
            $('#bg').css({
                height: $(document).height(),
                cursor: "pointer"
            });
            $('#bg').animate({opacity: 'toggle'}, 300);
            var $box = $('#modify-box2');
            $box.css({
                left: ($("body").width() - $box.width()) / 2 + "px",
                top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
            });
            $box.animate({opacity: 'toggle'}, 300);
            $("body").css({overflow: "hidden"});
            return;
        }
        $('#bg').css({
            height: $(document).height(),
            cursor: "pointer"
        });
        $('#bg').animate({opacity: 'toggle'}, 300);
        var $box = $('#change-box');
        $box.css({
            left: ($("body").width() - $box.width()) / 2 + "px",
            top: ($(window).height() - $box.height()) / 2 + $(window).scrollTop() + "px",
        });
        $box.animate({opacity: 'toggle'}, 300);
        $("body").css({overflow: "hidden"});
    });
});