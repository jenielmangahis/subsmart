
$(document).ready(function () {
    //Alert popup
    // function alert_success() {
    //     $('.alert-success').show();
    //     window.setTimeout(function() {
    //         $('.alert').fadeTo(500, 0).slideUp(500, function(){
    //             $(this).remove();
    //         });
    //     }, 5000);
    //     $('.alert').css({"bottom":"60px","left":"30px","position":"absolute","z-index":"999","width":"auto"});
    // }
    // function alert_failed() {
    //     $('.alert-danger').show();
    //     window.setTimeout(function() {
    //         $('.alert').fadeTo(500, 0).slideUp(500, function(){
    //             $(this).remove();
    //         });
    //     }, 5000);
    //     $('.alert').css({"bottom":"60px","left":"30px","position":"absolute","z-index":"999","width":"auto"});
    // }

    // Rules page
    //select2 initialisation
    $('.select2-rules-category').select2({
        placeholder: 'Select a category',
        allowClear: true,
    });
    $('.select2-rules-payee').select2({
        placeholder: '(Recommended)',
        allowClear: true
    });
    // Add and remove condition div
    $(document).on("click","#btnAddCondition",function () {
        $('.addCondition-container').children($('.deleteCondition').show());
        var $target = $('html,body');
        $target.animate({scrollTop: $target.height()}, 1000);
        var row = $('#addCondition').clone(true);
        row.find("#conID").val("");
        row.appendTo('.addCondition-container');
    });
    //Remove added condition
    $(document).on("click","#btnDeleteCondition",function (e) {
        e.preventDefault();
        $("#addCondition").remove();
        var check_count = jQuery("div[id='addCondition']").length;
        var counter = $('#counterCondition').val();
        console.log(check_count);
        if (check_count == counter){
            $('.addCondition-container').children($('.deleteCondition').hide());
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
    //Delete Rules
    $(document).on('click','#deleteRules',function () {
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
                url:'/accounting/deleteRulesData',
                method:"POST",
                data:{id:id},
                success:function (data) {
                    $('.displayRules').html(data);
                    window.location.href= '/'+ url;
                    Swal.fire(
                        'Deleted!',
                        'Rule has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
    });

    // Expenses page
    function getArrayCategory(category) {
        var list = [];
        $(category).each(function(index, element) {
            list.push($(element).val());
        });
        return list;
    }
    function getArrayDescription(description) {
        var list = [];
        $(description).each(function(index, element) {
            list.push($(element).val());
        });
        return list;
    }
    function getArrayAmount(amount) {
        var list = [];
        $(amount).each(function(index, element) {
            list.push($(element).val());
        });
        return list;
    }
    function showCategories(check,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select) {
        $.ajax({
            url:"/accounting/rowCategories",
            type:"POST",
            cache:false,
            data:{
                id:id,
                row:row,
                cat_class:cat_class,
                des_class:des_class,
                amount_class:amount_class,
                counter:counter,
                remove_id:remove_id,
                select:select
            },
            success:function (data) {
                if(check == true){
                    $(container).html(data);
                }
            }
        });
    }
    // Check modal
    $(document).on('click','#addCheck',function () {
        $('#addEditCheckmodal').attr('action',"/accounting/addCheck");
        $('#addEditCheckmodal')[0].reset();
        $("#checkVendorID").select2('val','All');
        $("#bank_account").select2('val','All');
        $('#check_mailing_address').html(null);
        $('#print_later').attr("checked",false);
        $('#check_number').val(null);
        $('#checkNUmberHeader').html(1);
    });
    // Add Check
    $('#checkSaved').click(function () {
        var vendor_id = $('#checkVendorID').val();
        var bank_account = $('#bank_account').val();
        var mailing_address = $('#check_mailing_address').val();
        var payment_date = $('#payment_date').val();
        var check_number = $('#check_number').val();
        var print_later = $('#print_later').val();
        var permit_number = $('#permit_number').val();
        var category = getArrayCategory($('.checkCategory'));
        var description = getArrayDescription($('.checkDescription'));
        var amount = getArrayAmount($('.checkAmount'));
        $.ajax({
            url:$('#addEditCheckmodal').attr('action'),
            type:"POST",
            cache: false,
            data:{
                vendor_id:vendor_id,
                bank_account:bank_account,
                mailing_address:mailing_address,
                payment_date:payment_date,
                check_number:check_number,
                print_later:print_later,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {
                $('#alert_message').html('New Check has been added.')
            }
        });
    });
    // Update Check modal
    $(document).on('click','#editCheck',function () {
        $('#addEditCheckmodal').attr('action',$('#site_url').val()+"accounting/editCheckData");
        var id = $(this).attr("data-id");
        $('#checkSaved').attr('id','checkUpdate');
        var container = $('#line-container-check');
        var row = 'tableLine';
        var cat_class = 'checkCategory';
        var des_class = 'checkDescription';
        var amount_class = 'checkAmount';
        var counter = 'line-counter';
        var remove_id = 'delete-line-row';
        var select = 'select2-check-category';
        $.ajax({
            url:"/accounting/getCheckData",
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#checkID').val(data.check_id);
                $('#checktransID').val(data.transaction);
                $("#checkVendorID option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#checkVendorID').next($('#select2-checkVendorID-container').attr('title',data.vendor_name).html(data.vendor_name));
                $("#bank_account option[value='" + data.bank_account +"']").html(data.bank_account).attr("selected",true);
                $('#bank_account').next($('#select2-bank_account-container').attr('title',data.bank_account).html(data.bank_account));
                $('#check_mailing_address').text(data.mailing);
                $('#payment_date').val(data.payment_date);
                $('#check_number').val(data.check_number);
                $('#checkNUmberHeader').html(data.check_number);
                $('#print_later').attr("checked",data.print_later);
                $('#permit_number').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select);
            }
        });
    });
    $(document).on('click','#checkUpdate',function () {
        var check_id = $('#checkID').val();
        var transaction_id = $('#checktransID').val();
        var vendor_id = $('#checkVendorID').val();
        var bank_account = $('#bank_account').val();
        var mailing_address = $('#check_mailing_address').val();
        var payment_date = $('#payment_date').val();
        var check_number = $('#check_number').val();
        var print_later = $('#print_later').val();
        var permit_number = $('#permit_number').val();
        var category = getArrayCategory($('.checkCategory'));
        var description = getArrayDescription($('.checkDescription'));
        var amount = getArrayAmount($('.checkAmount'));
        $.ajax({
            url:$('#addEditCheckmodal').attr('action'),
            type:"POST",
            cache: false,
            data:{
                check_id:check_id,
                transaction_id:transaction_id,
                vendor_id:vendor_id,
                bank_account:bank_account,
                mailing_address:mailing_address,
                payment_date:payment_date,
                check_number:check_number,
                print_later:print_later,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {
                Swal.fire(
                    'Good job!',
                    'New check expense has been added!',
                    'success'
                )
            }
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
                        'Banking check has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
    });

    //Bill Modal
    $(document).on('click','#addBill',function () {
        $('#billForm').attr('action',$('#site_url').val()+"accounting/addBill");
        $('#billForm')[0].reset();
        $("#billTerms").select2('val','All');
        $("#billVendorID").select2('val','All');
        $('#billMailingAddress').html(null);
    });
    $(document).on('click','#editBill',function () {
        $('#billForm').attr('action',$('#site_url').val()+"accounting/editBillData");
        $('#billSaved').attr('id','billUpdate');
        var id = $(this).attr("data-id");
        var container = $('#line-container-bill');
        var row = 'tableLine-bill';
        var cat_class = 'billCategory';
        var des_class = 'billDescription';
        var amount_class = 'billAmount';
        var counter = 'line-counter-bill';
        var remove_id = 'delete-row-bill';
        var select = 'select2-bill-category';
        $.ajax({
            url:'/accounting/getBillData',
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#billTransId').val(data.transaction_id);
                $('#billID').val(data.bill_id);
                $("#billVendorID option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#billVendorID').next($('#select2-billVendorID-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#billMailingAddress').html(data.address);
                $("#billTerms option[value='" + data.terms +"']").html(data.terms).attr("selected",true);
                $('#billTerms').next($('#select2-billTerms-container').attr('title',data.terms).html(data.terms));
                $('#billDate').val(data.bill_date);
                $('#billDueDate').val(data.due_date);
                $('#billNumber').val(data.bill_number);
                $('#billPermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select);
            }
        });
    });
    $(document).on('click','#billSaved',function () {
        var vendor_id = $('#billVendorID').val();
        var mailing_address = $('#billMailingAddress').val();
        var terms = $('#billTerms').val();
        var bill_date = $('#billDate').val();
        var due_date = $('#billDueDate').val();
        var bill_number = $('#billNumber').val();
        var permit_number = $('#billPermitNumber').val();
        var category = getArrayCategory($('.billCategory'));
        var description = getArrayDescription($('.billDescription'));
        var amount = getArrayAmount($('.billAmount'));

        $.ajax({
            url:$('#billForm').attr('action'),
            type:"POST",
            data:{
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                terms:terms,
                bill_date:bill_date,
                due_date:due_date,
                bill_number:bill_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            cache:false,
            success:function (data) {
                Swal.fire(
                    'Good job!',
                    'Bill expense has been added.!',
                    'success'
                )
            }
        });
    });
    $(document).on('click','#billUpdate',function () {
        var transaction_id = $('#billTransId').val();
        var bill_id = $('#billID').val();
        var vendor_id = $('#billVendorID').val();
        var mailing_address = $('#billMailingAddress').val();
        var terms = $('#billTerms').val();
        var bill_date = $('#billDate').val();
        var due_date = $('#billDueDate').val();
        var bill_number = $('#billNumber').val();
        var permit_number = $('#billPermitNumber').val();
        var category = getArrayCategory($('.billCategory'));
        var description = getArrayDescription($('.billDescription'));
        var amount = getArrayAmount($('.billAmount'));
        $.ajax({
            url:$('#billForm').attr('action'),
            type:"POST",
            cache:false,
            data:{
                bill_id:bill_id,
                transaction_id:transaction_id,
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                terms:terms,
                bill_date:bill_date,
                due_date:due_date,
                bill_number:bill_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {
                $('#alert_message').html('Bill expense has been updated.');
            }
        });
    });
    // Delete Bill
    $(document).on('click','#deleteBill',function () {
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
                url:'/accounting/deleteBillData',
                method:"POST",
                data:{id:id},
                success:function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Banking check has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
    });


// Expense Modal
    $(document).on('click','#addBill',function () {
        $('#expenseForm').attr('action',$('#site_url').val()+"accounting/addExpense");
        $('#expenseForm')[0].reset();
        $("#expenseVendorId").select2('val','All');
        $("#expensePaymentAccount").select2('val','All');
        $("#expensePaymentMethod").select2('val','All');
    });
    $(document).on('click','#expenseSaved',function () {
        var vendor_id = $('#expenseVendorId').val();
        var payment_account = $('#expensePaymentAccount').val();
        var payment_date = $('#expensePaymentDate').val();
        var payment_method = $('#expensePaymentMethod').val();
        var ref_number = $('#expenseRefNumber').val();
        var permit_number = $('#expensePermitNumber').val();
        var category = getArrayCategory($('.expenseCategory'));
        var description = getArrayDescription($('.expenseDescription'));
        var amount = getArrayAmount($('.expenseAmount'));
        $.ajax({
            url:$('#expenseForm').attr('action'),
            type:"POST",
            cache:false,
            data:{
                vendor_id:vendor_id,
                payment_account:payment_account,
                payment_date:payment_date,
                payment_method:payment_method,
                ref_number:ref_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            cache:false,
            success:function (data) {
                $('#alert_message').html('Bill expense has been updated.');
            }
        });
    });
    $(document).on('click','#editExpense',function () {
        $('#expenseForm').attr('action',$('#site_url').val()+"accounting/updateExpenseData");
        $('#expenseSaved').attr('id','expenseUpdate');
        var id = $(this).attr("data-id");
        var container = $('#line-container-expense');
        var row = "tableLine-expense";
        var cat_class = 'expenseCategory';
        var des_class = 'expenseDescription';
        var amount_class = 'expenseAmount';
        var counter = 'line-counter-expense';
        var remove_id = 'delete-row-expense';
        var select = 'select2-expense-category';
        $.ajax({
            url:'/accounting/getExpenseData',
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                console.log(data.vendor_id);
                $('#expenseTransId').val(data.transaction_id);
                $('#expenseId').val(data.expense_id);
                $("#expenseVendorId option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#expenseVendorId').next($('#select2-expenseVendorId-container').attr('title',data.vendor_name).html(data.vendor_name));
                $("#expensePaymentAccount option[value='" + data.payment_account +"']").html(data.payment_account).attr("selected",true);
                $('#expensePaymentAccount').next($('#select2-expensePaymentAccount-container').attr('title',data.payment_account).html(data.payment_account));
                $('#expensePaymentDate').val(data.payment_date);
                $("#expensePaymentMethod option[value='" + data.payment_method +"']").html(data.payment_method).attr("selected",true);
                $('#expensePaymentMethod').next($('#select2-expensePaymentMethod-container').attr('title',data.payment_method).html(data.payment_method));
                $('#expenseRefNumber').val(data.ref_number);
                $('#expensePermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select);
            }
        });
    });
    $(document).on('click','#expenseUpdate',function () {
        var transaction_id = $('#expenseTransId').val();
        var expense_id =  $('#expenseId').val();
        var vendor_id = $('#expenseVendorId').val();
        var payment_account = $('#expensePaymentAccount').val();
        var payment_date = $('#expensePaymentDate').val();
        var payment_method = $('#expensePaymentMethod').val();
        var ref_number = $('#expenseRefNumber').val();
        var permit_number = $('#expensePermitNumber').val();
        var category = getArrayCategory($('.expenseCategory'));
        var description = getArrayDescription($('.expenseDescription'));
        var amount = getArrayAmount($('.expenseAmount'));

        $.ajax({
            url:$('#expenseForm').attr('action'),
            type:"POST",
            cache:false,
            data:{
                transaction_id:transaction_id,
                expense_id:expense_id,
                vendor_id:vendor_id,
                payment_account:payment_account,
                payment_date:payment_date,
                payment_method:payment_method,
                ref_number:ref_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {

            }
        });
    });

    // Delete Expense
    $(document).on('click','#deleteExpense',function () {
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
                url:'/accounting/deleteBillData',
                method:"POST",
                data:{id:id},
                success:function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Expense has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
    });
    // Vendor Credit
    $(document).on('click','#addVendorCredit',function () {
        $('#formVendorCredit').attr('action',$('#site_url').val()+"accounting/vendorCredit");
        $('#formVendorCredit')[0].reset();
        $("#vcVendorId").select2('val','All');
        $("#vcMailingAddress").html(null);
    });
    $(document).on('click','#vcSaved',function () {
        var vendor_id = $('#vcVendorId').val();
        var mailing_address = $('#vcMailingAddress').val();
        var payment_date = $('#vcPaymentDate').val();
        var ref_number = $('#vcRefNumber').val();
        var permit_number = $('#vcPermitNumber').val();
        var category = getArrayCategory($('.vcCategory'));
        var description = getArrayDescription($('.vcDescription'));
        var amount = getArrayAmount($('.vcAmount'));
        $.ajax({
            url:$('#formVendorCredit').attr('action'),
            type:"POST",
            cache:false,
            data:{
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                payment_date:payment_date,
                ref_number:ref_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {

            }
        });
    });
    $(document).on('click','#editVendorCredit',function () {
        $('#formVendorCredit').attr('action',$('#site_url').val()+"accounting/updateVendorCredit");
        $('#vcSaved').attr('id','updateVC');
        var id = $(this).attr('data-id');
        var container = $('#line-container-vendorCredit');
        var row = 'tableLine-vendorCredit';
        var cat_class = 'vcCategory';
        var des_class = 'vcDescription';
        var amount_class = 'vcAmount';
        var counter = 'line-counter-vendorCredit';
        var remove_id = 'delete-row-vendorCredit';
        var select = 'select2-vc-category';
        $.ajax({
            url:'/accounting/getVendorCredit',
            type:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#vendorCreditId').val(id);
                $('#vcTransId').val(data.transaction_id);
                $("#vcVendorId option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#vcVendorId').next($('#select2-vcVendorId-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#vcMailingAddress').html(data.mailing_address);
                $('#vcPaymentDate').val(data.payment_date);
                $('#vcRefNumber').val(data.ref_number);
                $('#vcPermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select);
            }
        });
    });
    $(document).on('click','#updateVC',function () {
        var transaction_id = $('#vcTransId');
        var vc_id = $('#vendorCreditId')
        var vendor_id = $('#vcVendorId').val();
        var mailing_address = $('#vcMailingAddress').val();
        var payment_date = $('#vcPaymentDate').val();
        var ref_number = $('#vcRefNumber').val();
        var permit_number = $('#vcPermitNumber').val();
        var category = getArrayCategory($('.vcCategory'));
        var description = getArrayDescription($('.vcDescription'));
        var amount = getArrayAmount($('.vcAmount'));
        $.ajax({
           url:$('#formVendorCredit').attr('action'),
            type:"POST",
            cache:false,
            data:{
                vc_id:vc_id,
                transaction_id:transaction_id,
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                payment_date:payment_date,
                ref_number:ref_number,
                permit_number:permit_number,
                category:category,
                description:description,
                amount:amount
            },
            success:function () {

            }
        });

    });
    //Delete Vendor Credit
    $(document).on('click','#deleteVendorCredit',function () {
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
                url:'/accounting/deleteVendorCredit',
                method:"POST",
                data:{id:id},
                success:function (data) {
                    Swal.fire(
                        'Deleted!',
                        'Vendor Credit has been deleted.',
                        'success'
                    )
                }
            });
        }
    });
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







