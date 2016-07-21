$(document).ready(function () {
    $('#strip-2').addClass('current');
    $('#button-2').addClass('current');
    var count = 0;
    $('.apply tr').each(function () {
        if (count%2==0)
        {
            $(this).addClass('gray');
        }
        if (count==0)
        {
            $(this).css("backgroundColor","rgb(200,200,200)");
        }
        count+=1;
    });

    $('.apply tr:not(.first)').hover(function () {
        $(this).find(".submit").toggleClass("hidden");
        $(this).css("cursor","pointer");
    }, function () {
        $(this).find(".submit").toggleClass("hidden");
        $(this).css("cursor","default");
    });

    $('.apply .apply-list').click(function () {
        var $id = $(this).attr('lid');
        location.href = "/ta/application/student/apply?id=" + $id;
    });
});