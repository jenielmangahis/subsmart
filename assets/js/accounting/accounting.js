
$(document).ready(function () {
    // select2 option initialized
    $('.select2').select2();
    //Alert popup
    window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
    $('.alert').css({"bottom":"100px","left":"30px","position":"absolute","z-index":"999","width":"auto"});

    // Rules page
    //select2 initialisation
    $('.select2-rules-category').select2({
        placeholder: 'Select a category',
        allowClear: true
    });
    $('.select2-rules-payee').select2({
        placeholder: '(Recommended)',
        allowClear: true
    });
    // Add and remove condition div
    $('#btnAddCondition').click(function (e) {
        $("#deleteCondition").show();
        $("#addCondition").clone().appendTo($('.addCondition-container'));
        e.preventDefault();
    });
    //Remove added condition
    $(document).on("click","#btnDeleteCondition",function (e) {
        e.preventDefault();
        $("#addCondition").remove();
        var check_count = jQuery("div[id='addCondition']").length;
        if (check_count == 1){
            $("#deleteCondition").hide();
        }
    });
    //Assign More
    $('#btnAssignMore').click(function () {
        $('#assignMore').show();
        $(this).hide();
        $('#btnClear').show();
    });
    $('#btnClear').click(function () {
        $('#assignMore').hide();
        $(this).hide();
        $('#btnAssignMore').show();
    });
    // Add Split Line
    $('#btnAddSplit').click(function () {
        $('.add-split-container').show();
        $('#categoryDefault').hide();
        $('#btnAddLine').show();
        $('#mainCategory').removeAttr('name');

        $('.select2-rules-category').select2({
            placeholder: 'Select a category',
            allowClear: true
        });
        $('.select2-rules-category').last().next().next().remove();
    });

    $(document).on("click","#btnAddLine",function () {
        $(".add-split-container").append($('.add-split-section').first().clone());
        var num = $('.add-split-section').length;
        $('.splitNum').last().html(num);
        $('.select2-rules-category').select2({
            placeholder: 'Select a category',
            allowClear: true
        });
        $('.select2-rules-category').last().next().next().remove();
    });
    //Delete split
    $(document).on("click","#deleteSplitLine",function () {
        var num = $('.add-split-section').length;
        if(num == 2){
            $('.add-split-container').hide();
            $('#categoryDefault').show();
            $('#btnAddLine').hide();
            $('#mainCategory').attr('name','category[]');
        }else{
            $(".add-split-section").last().remove();
        }
    });


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

// Delete Check
$(document).on('click','#deleteCheck',function () {
    var id = $(this).attr('data-id');
    console.log(id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2ca01c',
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

//Upload Receipt image or Add receipt
Dropzone.autoDiscover = false;
var fname;
    var receiptDropzone = new Dropzone("#receiptDZ", {
        url:"/accounting/uploadReceiptImage",
        acceptedFiles: "image/*",
        addRemoveLinks:true,
        init: function() {
            this.on("success", function(file,response) {
                fname = response;
            });
        },
        removedfile:function (file) {
            // var name = file.name;
            var name = fname.replace(/\"/g, "");
            $.ajax({
                type:"POST",
                url:"/accounting/removeReceiptImage",
                data:{file:name},
                dataType:'html'
            });
            //remove thumbnail
            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
    });

    // Get Receipt data
$(document).on('click','#updateReceipt',function () {
    var id = $(this).attr('data-id');
    $.ajax({
        url:"/accounting/getReceiptData",
        type:"POST",
        data:{id:id},
        dataType:"json",
        success:function (data) {
            $('#receiptImage').attr('src',$('#base_url').val() + data.receipt_img);
            $('#receipt_id').val(data.id);
            $('#documentType option:contains('+ data.document_type+ ')').attr('selected',true);
            $("#payeeID").val(data.payee_id).trigger('change');
            $("#bank_account").val(data.bank_account).trigger('change');
            $("#category").val(data.category).trigger('change');
            $('#paymentDate').val(data.transaction_date);
            $('#description').val(data.description);
            $('#totalAmount').val(data.total_amount);
            $('#memo').text(data.memo);
            $('#refNumber').val(data.ref_number);


        }

    });
});
// Delete Receipt
$(document).on('click','#deleteReceipt',function () {
    var id = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2ca01c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
        $.ajax({
            url:'/accounting/deleteReceiptData',
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







