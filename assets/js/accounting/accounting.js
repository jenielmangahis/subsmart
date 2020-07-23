//Alert popup
$(document).ready(function () {
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
    $('.alert').css({"bottom":"50px","left":"20px","position":"absolute","z-index":"200","width":"auto"});

    $(document).on('click','#edit-expensesCheck',function () {
        var id = $(this).attr("vendroID");
        $.ajax({
            url:"/dashboard/getDesignationData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#des-id').val(data.des_id);
                $('#designation').val(data.designation);
            }
        });
    });
});