var check_filename = [];
var bill_filename = [];
var expense_filename = [];
var vc_filename = [];
$(document).ready(function () {
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
                    );
                }
            });
        }
    });
    });

    // Expenses page
    function getArrayCategoriesId(category_id) {
        var list = [];
        $(category_id).each(function(index, element) {
            list.push($(element).val());
        });
        return list;
    }  function getArrayCategory(category) {
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
    function showCategories(check,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview) {
        if (check > 0){
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
                    select:select,
                    preview:preview
                },
                success:function (data) {
                    $(container).html(data);
                    var total = 0;
                    $('.'+ amount_class).each(function () {
                        var num = $(this).val().replace(',','');
                        if (num !== 0){
                            total += parseFloat(num);
                        }
                    });
                    if (isNaN(total)){
                        total = 0;
                        total = total.toFixed(2);
                    }
                    $('#total-amount'+preview).text(total.toFixed(2));
                }
            });
        }else{
            $.ajax({
                url:"/accounting/defaultCategoryRow",
                type:"POST",
                cache:false,
                data:{
                    row:row,
                    cat_class:cat_class,
                    des_class:des_class,
                    amount_class:amount_class,
                    counter:counter,
                    remove_id:remove_id,
                    select:select,
                    preview:preview
                },
                success:function (data) {
                    $(container).html(data);
                }
            });
        }

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
        var id = 0;
        var container = '#line-container-check';
        var row = 'tableLine';
        var cat_class = 'checkCategory';
        var des_class = 'checkDescription';
        var amount_class = 'checkAmount';
        var counter = 'line-counter';
        var remove_id = 'delete-line-row';
        var select = 'select2-check-category';
        var preview = '-check';
        showCategories(0,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
    });
    // Add Check
    $('#checkSaved').click(function () {
        var vendor_id = getArrayCategoriesId($('#checkVendorID').val());
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
                amount:amount,
                filename:check_filename
            },
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "New check has been updated!",
                        icon: 'success'
                    }
                );
                $('#checkAttachment').next().next($('.dz-preview').remove());
                $('#checkAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });
    // Update Check modal
    $(document).on('click','#editCheck',function () {
        $('#addEditCheckmodal').attr('action',"/accounting/editCheckData");
        $('#checkSaved').attr('id','checkUpdate');
        var id = $(this).attr("data-id");
        var container = '#line-container-check';
        var row = 'tableLine';
        var cat_class = 'checkCategory';
        var des_class = 'checkDescription';
        var amount_class = 'checkAmount';
        var counter = 'line-counter';
        var remove_id = 'delete-line-row';
        var select = 'select2-check-category';
        var preview = '-check';
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
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);

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
        var category_id = getArrayCategoriesId($('.categories_id'));
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
                category_id:category_id,
                category:category,
                description:description,
                amount:amount
            },
            success:function () {

                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Check expense has been updated!",
                        icon: 'success'
                    }
                );
                $('#checkAttachment').next().next($('.dz-preview').remove());
                $('#checkAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });

    // Delete Check
    $(document).on('click','#deleteCheck',function () {
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
                    url:'/accounting/deleteCheckData',
                    method:"POST",
                    data:{id:id},
                    success:function (data) {
                        Swal.fire(
                            'Deleted!',
                            'Check expense has been deleted.',
                            'success'
                        );
                    }
                });
            }
    });
    });

    //Check modal Dropzone
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        var fname = [];
        var selected = [];
        var checkDropzone = new Dropzone('div#checkAttachment', {
            url:'/accounting/expensesTransactionAttachment',
            acceptedFiles: "image/*",
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    check_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                });
            },
            removedfile:function (file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if(d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type:"POST",
                    url:'/accounting/removeTransactionAttachment',
                    data:{name:name,index:index},
                    success:function (data) {
                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });

    //Bill Modal
    $(document).on('click','#addBill',function () {
        $('#billForm').attr('action',"/accounting/addBill");
        $('#billForm')[0].reset();
        $("#billTerms").select2('val','All');
        $("#billVendorID").select2('val','All');
        $('#billMailingAddress').html(null);
        $('#total-amount-bill').html('0.00');
        var id = 0;
        var container = '#line-container-bill';
        var row = 'tableLine-bill';
        var cat_class = 'billCategory';
        var des_class = 'billDescription';
        var amount_class = 'billAmount';
        var counter = 'line-counter-bill';
        var remove_id = 'delete-row-bill';
        var select = 'select2-bill-category';
        var preview = '-bill';
        showCategories(0,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
    });
    $(document).on('click','#editBill',function () {
        $('#billForm').attr('action',"/accounting/editBillData");
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
        var preview = '-bill';
        $.ajax({
            url:'/accounting/getBillData',
            method:"POST",
            data:{id:id},
            dataType:"json",
            cached:false,
            success:function (data) {
                $('#billTransId').val(data.transaction_id);
                $('#billID').val(data.bill_id);
                $("#billVendorID option[value='"+ data.vendor_id +"']").attr('selected',true);
                $('#billVendorID').next($('#select2-billVendorID-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#billMailingAddress').html(data.address);
                $('#billTerms option:contains('+ data.terms+ ')').attr('selected',true);
                $('#billTerms').next($('#select2-billTerms-container').attr('title',data.terms).html(data.terms));
                $('#billDate').val(data.bill_date);
                $('#billDueDate').val(data.due_date);
                $('#billNumber').val(data.bill_number);
                $('#billPermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
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
                amount:amount,
                filename:bill_filename
            },
            cache:false,
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Bill expense has been added!",
                        icon: 'success'
                    }
                );
                $('#billAttachment').next().next($('.dz-preview').remove());
                $('#billAttachment').next($('.dz-message').css({"display":"inherit"}));
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
        var category_id = getArrayCategoriesId($('.categories_id'));
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
                category_id:category_id,
                category:category,
                description:description,
                amount:amount
            },
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Bill expense has been updated!",
                        icon: 'success'
                    });
                $('#billAttachment').next().next($('.dz-preview').remove());
                $('#billAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });
    // Delete Bill
    $(document).on('click','#deleteBill',function () {
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
                url:'/accounting/deleteBillData',
                method:"POST",
                data:{id:id},
                success:function () {
                    Swal.fire(
                        'Deleted!',
                        'Bill expense has been deleted.',
                        'success'
                    );
                }
            });
        }
    });
    });

    //Bill modal Dropzone
    $(document).ready(function () {
        var fname = [];
        var selected = [];
        var billDropzone = new Dropzone('div#billAttachment', {
            url:'/accounting/expensesTransactionAttachment',
            acceptedFiles: "image/*",
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    bill_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                });
            },
            removedfile:function (file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if(d == file) return index;
                }).filter(isFinite)[0];

                $.ajax({
                    type:"POST",
                    url:'/accounting/removeTransactionAttachment',
                    data:{name:name,index:index},
                    success:function (data) {

                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });


// Expense Modal
    $(document).on('click','#addExpense',function () {
        $('#expenseForm').attr('action',"/accounting/addExpense");
        $('#expenseForm')[0].reset();
        $("#expenseVendorId").select2('val','All');
        $("#expensePaymentAccount").select2('val','All');
        $("#expensePaymentMethod").select2('val','All');
        $('#total-amount-bill').html('0.00');
        var id = 0;
        var container = '#line-container-expense';
        var row = "tableLine-expense";
        var cat_class = 'expenseCategory';
        var des_class = 'expenseDescription';
        var amount_class = 'expenseAmount';
        var counter = 'line-counter-expense';
        var remove_id = 'delete-row-expense';
        var select = 'select2-expense-category';
        var preview = '-expense';
        showCategories(0,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
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
                amount:amount,
                filename:expense_filename
            },
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "New expense has been added!",
                        icon: 'success'
                    });
                $('#expenseAttachment').next().next($('.dz-preview').remove());
                $('#expenseAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });
    $(document).on('click','#editExpense',function () {
        $('#expenseForm').attr('action',"/accounting/updateExpenseData");
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
        var preview = '-expense';
        $.ajax({
            url:'/accounting/getExpenseData',
            method:"POST",
            data:{id:id},
            dataType:"json",
            success:function (data) {
                $('#expenseTransId').val(data.transaction_id);
                $('#expenseId').val(data.expense_id);
                $("#expenseVendorId option[value='" + data.vendor_id +"']").attr('selected',true);
                $('#expenseVendorId').next($('#select2-expenseVendorId-container').attr('title',data.vendor_name).html(data.vendor_name));
                $("#expensePaymentAccount option[value='" + data.payment_account +"']").attr('selected',true);
                $('#expensePaymentAccount').next($('#select2-expensePaymentAccount-container').attr('title',data.payment_account).html(data.payment_account));
                $('#expensePaymentDate').val(data.payment_date);
                $('#expensePaymentMethod option:contains('+ data.payment_method+ ')').attr('selected',true);
                $('#expensePaymentMethod').next($('#select2-expensePaymentMethod-container').attr('title',data.payment_method).html(data.payment_method));
                $('#expenseRefNumber').val(data.ref_number);
                $('#expensePermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
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
        var category_id = getArrayCategoriesId($('.categories_id'));
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
                category_id:category_id,
                category:category,
                description:description,
                amount:amount
            },
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Expense has been updated!",
                        icon: 'success'
                    });
                $('#expenseAttachment').next().next($('.dz-preview').remove());
                $('#expenseAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });

    // Delete Expense
    $(document).on('click','#deleteExpense',function () {
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
                url:'/accounting/deleteBillData',
                method:"POST",
                data:{id:id},
                success:function () {
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Expense has been deleted!",
                            icon: 'success'
                        });
                }
            });
        }
    });
    });

    //Expense modal Dropzone
    $(document).ready(function () {
        var fname = [];
        var selected = [];
        var expenseDropzone = new Dropzone('div#expenseAttachment', {
            url:'/accounting/expensesTransactionAttachment',
            acceptedFiles: "image/*",
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    expense_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                });
            },
            removedfile:function (file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if(d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type:"POST",
                    url:'/accounting/removeTransactionAttachment',
                    data:{name:name,index:index},
                    success:function (data) {

                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });


    });

    // Vendor Credit
    $(document).on('click','#addVendorCredit',function () {
        $('#formVendorCredit').attr('action',"/accounting/vendorCredit");
        $('#formVendorCredit')[0].reset();
        $("#vcVendorId").select2('val','All');
        $("#vcMailingAddress").html(null);
        var id = 0;
        var container = '#line-container-vendorCredit';
        var row = 'tableLine-vendorCredit';
        var cat_class = 'vcCategory';
        var des_class = 'vcDescription';
        var amount_class = 'vcAmount';
        var counter = 'line-counter-vendorCredit';
        var remove_id = 'delete-row-vendorCredit';
        var select = 'select2-vc-category';
        var preview = '-vc';
        showCategories(0,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
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
                amount:amount,
                filename:vc_filename
            },
            success:function () {
                Swal.fire(
                    {
                        showConfirmButton: false,
                        timer: 2000,
                        title: 'Success',
                        text: "Vendor Credit has been added!",
                        icon: 'success'
                    });
                $('#vcAttachment').next().next($('.dz-preview').remove());
                $('#vcAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });
    $(document).on('click','#editVendorCredit',function (e) {
        e.preventDefault();
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
        var preview = '-vc';
        $.ajax({
            url:'/accounting/getVendorCredit',
            type:"POST",
            data:{id:id},
            dataType:"json",
            cached:false,
            success:function (data) {
                $('#vendorCreditId').val(id);
                $('#vcTransId').val(data.transaction_id);
                $("#vcVendorId option[value='" + data.vendor_id +"']").attr('selected',true);
                $('#vcVendorId').next($('#select2-vcVendorId-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#vcMailingAddress').html(data.mailing_address);
                $('#vcPaymentDate').val(data.payment_date);
                $('#vcRefNumber').val(data.ref_number);
                $('#vcPermitNumber').val(data.permit_number);
                showCategories(data.check_category,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
                console.log(data.check_category);
            }
        });
    });

    $(document).on('click','#updateVC',function () {
        var transaction_id = $('#vcTransId').val();
        var vc_id = $('#vendorCreditId').val();
        var vendor_id = $('#vcVendorId').val();
        var mailing_address = $('#vcMailingAddress').val();
        var payment_date = $('#vcPaymentDate').val();
        var ref_number = $('#vcRefNumber').val();
        var permit_number = $('#vcPermitNumber').val();
        var category_id = getArrayCategoriesId($('.categories_id'));
        var category = getArrayCategory($('.vcCategory'));
        var description = getArrayDescription($('.vcDescription'));
        var amount = getArrayAmount($('.vcAmount'));
        $.ajax({
            url:'/accounting/updateVendorCredit',
            type:"POST",
            data:{
                vc_id:vc_id,
                transaction_id:transaction_id,
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                payment_date:payment_date,
                ref_number:ref_number,
                permit_number:permit_number,
                category_id:category_id,
                category:category,
                description:description,
                amount:amount
            },
            success:function (data) {
                if (data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Vendor Credit has been updated!",
                            icon: 'success'
                        });
                }else{
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: "Something is wrong in the process!",
                            icon: 'warning'
                        });
                }

                $('#vcAttachment').next().next($('.dz-preview').remove());
                $('#vcAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    });
    //Delete Vendor Credit
    $(document).on('click','#deleteVendorCredit',function () {
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
                url:'/accounting/deleteVendorCredit',
                method:"POST",
                data:{id:id},
                success:function () {
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Vendor Credit has been deleted!",
                            icon: 'success'
                        });
                }
            });
        }
    });
    });

    //Vendor credit modal Dropzone
    $(document).ready(function () {
        var fname = [];
        var selected = [];
        var vcDropzone = new Dropzone('div#vcAttachment', {
            url:'/accounting/expensesTransactionAttachment',
            acceptedFiles: "image/*",
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    vc_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                });
            },
            removedfile:function (file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if(d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type:"POST",
                    url:'/accounting/removeTransactionAttachment',
                    data:{name:name,index:index},
                    success:function (data) {

                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });

});
//Add expense categories
$(document).on('click','#select2-category-id-vc-results > li',function () {
    $("#addNewCategories").modal("show");
    $('.select2-vc-category').next('.select2-selection').attr('aria-expanded',false);
    console.log('Response txt');
});

    //Upload Receipt image or Add receipt
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var fname;
    var receiptDropzone = new Dropzone('div#receiptDZ', {
        url:'/accounting/uploadReceiptImage',
        acceptedFiles: "image/*",
        addRemoveLinks:true,
        init: function() {
            this.on("success", function(file,response) {
                fname = response;
            });
        },
        removedfile:function (file) {
            var name = fname.replace(/\"/g, "");
            $.ajax({
                type:"POST",
                url:'/accounting/removeReceiptImage',
                data:{file:name},
                dataType:'html'
            });
            //remove thumbnail
            var previewElement;
            return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
        }
    });
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
                );
            }
        });
    }
});
});



