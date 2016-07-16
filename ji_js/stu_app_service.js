function resetCourseidColor() {
    $('.sidebar .choose-course td').css({
        "backgroundColor": "rgb(0,47,92)",
        "color": "white"
    }).find('img').attr("src", "/ji_style/images/arrow.png").addClass('hidden').css("marginLeft", "10px");
}

$(document).ready(function () {
    var currentCourseid = "search ta information";
    $('#strip-4').addClass('current');
    $('#button-4').addClass('current');
    $('.sidebar .choose-course td').each(function () {
        if ($(this).text().toLowerCase() == currentCourseid) {
            resetCourseidColor();
            $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
            $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
            $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
        }
    });

    $('.sidebar .choose-course td').hover(function () {
        if (currentCourseid != $(this).text().toLowerCase()) {
            $(this).css({'backgroundColor': 'rgb(0,121,242)', 'cursor': 'pointer'});
            $(this).find('img').addClass('hidden').css("marginLeft", "10px");
            $(this).find('img').removeClass('hidden').stop().animate({"marginLeft": "40px"}, 500);
        } else {
            $(this).css({'cursor': 'default'});
        }
    }, function () {
        if (currentCourseid != $(this).text().toLowerCase()) {
            $(this).css({'backgroundColor': 'rgb(0,47,92)', 'cursor': 'default'});
            $(this).find('img').addClass('hidden').css("marginLeft", "10px");
        }
    });

    $('.apply .sidebar .choose-course td').click(function () {
        resetCourseidColor();
        $(this).css({"backgroundColor": "white", "color": "rgb(0,121,242)"});
        $(this).find('img').attr("src", "/ji_style/images/arrow2.png");
        $(this).find('img').removeClass('hidden').css({"marginLeft": "40px"});
        currentCourseid = $(this).text().toLowerCase();
        $('.apply .text-container').each(function () {
            $(this).removeClass('hidden');
        });
        $('.apply .text-container').each(function () {
            if ($(this).find('.courseid').text().toLowerCase() != currentCourseid) {
                $(this).addClass('hidden');
            }
        });
    });
});