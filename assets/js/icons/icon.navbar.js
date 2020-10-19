$(document).ready(function () {
    //Check if body is fully loaded
    var readyStateCheckInterval = setInterval(function() {
        if (document.readyState === "complete") {
            $(".icon-loader").fadeOut('fast',function(){
                $('.icon-loader').hide();
                $('.icon-loader-left').hide();
                $('.bell').css('display','inline-block');
                // $('.notify-badge').css('visibility','visible');
                $('.settings-icon-container').css('display','inline-block');
                $('.schedule-icon-container').css('display','inline-block');
                $('.growth-icon-container').css('display','inline-block');
                $('.conversation-icon-container').css('display','inline-block');
                $('.plus-icon-container').css('display','inline-block');
                $('.icons-list-navbar').css('display','inline-block');
                $('.clock-users').css('display','contents');
                $('.nav-pro-img').css('display','inline-block');
            });
            clearInterval(readyStateCheckInterval);
        }
    }, 10);
});