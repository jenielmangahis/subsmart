//Alert popup
$(document).ready(function () {
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
    $('.alert').css({"bottom":"50px","left":"20px","position":"absolute","z-index":"200","width":"auto"});

    // Expenses page Check modal
    $(document).on('click','#addCheck',function () {
        $('#addEditCheckmodal').attr('action',$('#site_url').val()+"accounting/addCheck");
        $('#vendorID').val(null);
        $('#mailing_address').text(null);
        $('#payment_date').val(null);
        $('#check_number').val(null);
        $('#print_later').attr("checked",false);
        $('#permit_number').val(null);
    });
    $(document).on('click','#editCheck',function () {
        $('#addEditCheckmodal').attr('action',$('#site_url').val()+"accounting/editCheckData");
        var id = $(this).attr("data-id");
        $.ajax({
            url:"/accounting/getCheckData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#checkID').val(data.check_id);
                $("#vendorID option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#mailing_address').text(data.mailing);
                $('#payment_date').val(data.payment_date);
                $('#check_number').val(data.check_number);
                $('#print_later').attr("checked",data.print_later);
                $('#permit_number').val(data.permit_number);
            }
        });
    });
});

// Sweet Alert
$(document).on('click','#deleteCheck',function () {
    var id = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
        $.ajax({
            url:'/accounting/deleteCheckData',
            method:"POST",
            data:{id:id},
            success:function (data) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        });
    }
});
});



