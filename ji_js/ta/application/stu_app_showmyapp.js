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

function ucfirst(string) {
    return (string.substring(0, 1).toUpperCase() + string.substring(1));
}

$(document).ready(function () {
    var studentid = "";
    var courseid = "";
    var currentCourseid = "all";
    var currentStatus = "all";
    var courseList = new Array();

    $('#strip-3').addClass('current');
    $('#button-3').addClass('current');

    $('.text-container').each(function () {
        var newCourse = $(this).find('.courseid').text();
        if ($.inArray(newCourse, courseList)==-1)
        {
            courseList.push($(this).find('.courseid').text());
        }
    });

    courseList.sort();
    for (var i = 0; i < courseList.length; i++) {
        $('table.choose-course').append('<tr><td>' + ucfirst(courseList[i]) + '<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td></tr>');
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
                    var thisStatus = $(this).find('.status').text().toLowerCase();
                    if (currentStatus == "decided") {
                        if (thisStatus.indexOf("undecided") != -1) {
                            $(this).addClass('hidden');
                        }
                    }
                    else {
                        if (thisStatus.indexOf("undecided") == -1) {
                            $(this).addClass('hidden');
                        }
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
                    var thisStatus = $(this).find('.status').text().toLowerCase();
                    if (currentStatus == "decided") {
                        if (thisStatus.indexOf("undecided") != -1) {
                            $(this).addClass('hidden');
                        }
                    }
                    else {
                        if (thisStatus.indexOf("undecided") == -1) {
                            $(this).addClass('hidden');
                        }
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
        if ($(this).find('.status').text().toLowerCase().indexOf("reject") == -1)
        {
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
        $('.processing').find('.reprocess').css("borderColor", "rgb(255,205,0)");
        $('.processing').removeClass('processing');
    });
});