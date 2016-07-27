$(document).ready(function () {
    $('#strip-3').addClass("current");
    $('#button-3').addClass("current");
});

$(function () {
    $('*[name=date]').appendDtpicker({
        "minuteInterval": 15,
        "inline": true
    });
});