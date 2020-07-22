//Alert popup
$(document).ready(function () {
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
    $('.alert').css({"bottom":"50px","left":"20px","position":"absolute","z-index":"200","width":"auto"});
});