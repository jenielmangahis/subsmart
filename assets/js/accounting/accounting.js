var check_filename = [];
var bill_filename = [];
var expense_filename = [];
var vc_filename = [];
var original_fname_check = [];
var original_fname_bill = [];
var original_fname_expense = [];
var original_fname_vc = [];
var siteURL = document.getElementById('siteurl').value;
var attachment = null;
var attachment_id = [];
window.prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

$(document).ready(function () {
    $('.loader').hide();
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
        row.find("[data-type='conditions.comment']").val("");
        row.find("#conID").val("");
        row.removeAttr("data-id");
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
	//Show paypal form
	$('.clk-paypal').click(function () {
        $('.accounts-list').hide();
        $('.paypal-container').show();
    });
	//Hide paypal form
	
	$('.close-paypal-container').click(function () {
		$('.paypal-container').hide();
        $('.accounts-list').show();
    });
	//Show stripe form
	$('.clk-stripe').click(function () {
        $('.accounts-list').hide();
        $('.stripe-container').show();
    });
	//Hide stripe form
	
	$('.close-stripe-container').click(function () {
		$('.stripe-container').hide();
        $('.accounts-list').show();
    });
	
	//Save paypal credentials
	$(document).on('submit', '#save-paypal-account', function(e) {
		e.preventDefault();
		var email = $('#paypal_email').val();
			$.ajax({
                url: siteURL + "accounting/addBankAccount",
                type:"POST",
                cache:false,
                dataType:"json",
                data:{
                    email:email,
					method:"paypal"
                },
                success:function (data) {
                    
                }
            });

	});

	//Save stripe credentials
	$(document).on('submit', '#save-stripe-account', function(e) {
		e.preventDefault();
		var publish_key = $('#publish_key').val();
		var secret_key = $('#secret_key').val();
		var stripe_email = $('#stripe_email').val();
			$.ajax({
                url: siteURL + "accounting/addBankAccount",
                type:"POST",
                cache:false,
                dataType:"json",
                data:{
                    publish_key:publish_key,
                    secret_key:secret_key,
                    stripe_email:stripe_email,
					method:"stripe"
                },
                success:function (data) {
                    
                }
            });

	});
	
    // Add Split Line
    $('#btnAddSplit').click(function () {
        $("#addRuleForm").attr('data-add-split', 'true');

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
        const $clone = $('.add-split-section').first().clone();
        const $percentInput = $clone.find("[data-type='assignment.category_percent']");
        const $categorySelect = $clone.find("[data-type='assignment.category']");

        $percentInput.val("");
        $percentInput.removeClass("inputError");
        $categorySelect.removeClass("inputError");

        $(".add-split-container").append($clone);
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
            $("#addRuleForm").removeAttr('data-add-split');

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
                    window.location.reload();
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
    function showCategories(check,transaction_id,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview) {
        $(".table-loader").fadeIn('fast',function(){
            $('.table-loader').show();
        });
        if (check > 0){
            $.ajax({
                url: siteURL + "accounting/rowCategories",
                type:"GET",
                cache:false,
                dataType:"json",
                data:{
                    transaction_id:transaction_id,
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
                    $(".table-loader").fadeOut('fast',function(){
                        $('.table-loader').hide();
                    });
                    var total = 0;
                    $('.'+ amount_class).each(function () {
                        var num = $(this).val().replace(',','');
                        total += parseFloat(num);
                    });
                    if (isNaN(total)){
                        total = 0;
                        total = total.toFixed(2);
                    }else {
                        $('#total-amount'+preview).text(total.toFixed(2));
                        $('#h1_amount'+preview).text('$'+total.toFixed(2));
                    }
                }
            });
        }else{
            $.ajax({
                url: siteURL + "accounting/defaultCategoryRow",
                type:"GET",
                cache:false,
                dataType:"json",
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
                    $(".table-loader").fadeOut('fast',function(){
                        $('.table-loader').hide();
                    });
                    var total = 0;
                    $('.'+ amount_class).each(function () {
                        var num = $(this).val().replace(',','');
                        total += parseFloat(num);
                    });
                    if (isNaN(total)){
                        total = 0;
                        total = total.toFixed(2);
                    }else{
                        $('#total-amount'+preview).text(total);
                        $('#h1_amount'+preview).text('$'+total.toFixed(2));
                    }

                }
            });
        }

    }

    function deleteTemporaryAttachment() {
        $.ajax({
            url:"/accounting/deleteTemporaryAttachment",
            method:"POST",
            dataType:"json",
            success:function (data) {
                $('#billAttachment').next().next($('.dz-preview').remove());
                $('#billAttachment').next($('.dz-message').css({"display":"inherit"}));
            }
        });
    }

    function displayAttachments(id,type,container) {
        $.ajax({
            url:"/accounting/displayListAttachment",
            method:"GET",
            dataType:"json",
            data:{id:id,type:type},
            success:function (data) {
                $('#file-list'+container).html(data);
            }

        });
    }
    function showExpenseTransactionsTable() {
        $.ajax({
            url:"/accounting/showExpenseTransactionsTable",
            method:"GET",
            dataType:"json",
            success:function (data) {
                $('.expense-transactions-data-table').html(data);
                $('.select2-tbl-category').select2({
                    placeholder: 'Select a category',
                    allowClear: true,
                    width: 'resolve',
                    ajax:{
                        url:'/accounting/getExpensesCategories',
                        type:"GET",
                        dataType:"json",
                        delay:250,
                        data:function (params) {
                            var query = {
                                search: params.term
                            };
                            return query;
                        },
                        processResults:function (response) {
                            return{results:response};
                        },
                        cache:true
                    },
                    escapeMarkup: function (markup) {
                        return markup;
                    },
                    templateResult: function (d) {
                        var subtext = d.subtext;
                        if(subtext == undefined){subtext=''}
                        return '<span class="text-details">'+d.text+'</span><span class="pull-right subtext">'+subtext+'</span>';
                    }
                });

            }
        });
    }

    $(document).on('change','#expenseTransCategory',function () {
        $(this).parent().next('.fa-spinner').css('display','inline-block');
        $(this).parent('div').css('width','90%');
        var id = $(this).attr('data-id');
        var category = $(this).val();
        var select = this;
        var expenses_id = $(this).parent('div').parent('td').attr('data-id');
        var transaction_id = $(this).parent('div').parent('td').attr('data-transid');
        $.ajax({
           url:"/accounting/updateCategoryById",
           type:"POST",
           data:{id:id,category:category,expenses_id:expenses_id,transaction_id:transaction_id},
           success:function () {
               $(select).parent().next('.fa-spinner').css('display','none');
               $(select).parent('div').css('width','100%');
           }
        });
    });
    // Check modal
    $(document).on('click','#addCheck',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#addEditCheckmodal').attr('action',"accounting/addCheck");
        $('#addEditCheckmodal')[0].reset();
        $("#checkVendorID").select2('val','All');
        $("#bank_account").select2('val','All');
        $('#check_mailing_address').html(null);
        $('#print_later').attr("checked",false);
        $('#check_number').val(null);
        $('#checkNUmberHeader').html(1);
        var container = '#line-container-check';
        var row = 'tableLine';
        var cat_class = 'checkCategory';
        var des_class = 'checkDescription';
        var amount_class = 'checkAmount';
        var counter = 'line-counter';
        var remove_id = 'delete-line-row';
        var select = 'select2-check-category';
        var preview = '-check';
        showCategories(0,0,0,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
        $(".loader").fadeOut('fast',function(){
            $('.loader').hide();
        });
    });
    // Add Check
    $('#checkSaved').click(function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var vendor_id = $('#checkVendorID').val();
        var bank_account = $('#bank_account').val();
        var mailing_address = $('#check_mailing_address').val();
        var payment_date = $('#payment_date').val();
        var check_number = $('#check_number').val();
        var print_later = $('#print_later').val();
        var permit_number = $('#permit_number').val();
        var memo = $('#checkMemo').val();
        var category = getArrayCategory($('.checkCategory'));
        var description = getArrayDescription($('.checkDescription'));
        var amount = getArrayAmount($('.checkAmount'));
        var total = $('#total-amount-check').text();
        $.ajax({
            url:siteURL + $('#addEditCheckmodal').attr('action'),
            type:"POST",
            cache: false,
            dataType:"json",
            data:{
                vendor_id:vendor_id,
                bank_account:bank_account,
                mailing_address:mailing_address,
                payment_date:payment_date,
                check_number:check_number,
                print_later:print_later,
                permit_number:permit_number,
                memo:memo,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:check_filename,
                original_fname:original_fname_check
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "New check has been updated!",
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
                showExpenseTransactionsTable();
                $('#checkAttachment').next().next($('.dz-preview').remove());
                $('#checkAttachment').next($('.dz-message').css({"display":"inherit"}));
                attachment = null;
                attachment_id = [];
            }
        });
    });
    // Update Check modal
    var check_original = null;
    var check_updated = null;
    $(document).on('click','#editCheck',function () {
        $('#edit-expensesCheck').modal({backdrop: 'static', keyboard: false});
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#addEditCheckmodal').attr('action',"/accounting/editCheckData");
        $('#checkSaved').attr('id','checkUpdate');
        var transaction_id = $(this).attr('data-transId');
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
            method:"GET",
            data:{id:id,transaction_id:transaction_id},
            dataType:"json",
            success:function (data) {
                $('#checkID').val(data.check_id);
                $('#checktransID').val(transaction_id);
                $("#checkVendorID option[value='" + data.vendor_id +"']").html(data.vendor_name).attr("selected",true);
                $('#checkVendorID').next($('#select2-checkVendorID-container').attr('title',data.vendor_name).html(data.vendor_name));
                $("#bank_account option[value='" + data.bank_account +"']").html(data.bank_account).attr("selected",true);
                $('#bank_account').next($('#select2-bank_account-container').attr('title',data.bank_account).html(data.bank_account));
                $('#check_mailing_address').val(data.mailing);
                $('#payment_date').val(data.payment_date);
                $('#check_number').val(data.check_number);
                $('#checkNUmberHeader').html(data.check_number);
                $('#print_later').attr("checked",data.print_later);
                $('#permit_number').val(data.permit_number);
                $('#checkMemo').val(data.memo);
                $('#checkID').addClass('expenses-ID-'+transaction_id);
                $('#checkType').addClass('expenseType-'+transaction_id);
                check_original = $('#line-container-check').closest('.modal-content').find('form').serialize();
                check_updated = check_original;
                showCategories(data.check_category,transaction_id,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
                displayAttachments(id,'Check',preview);
                if (check_original != null){
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
    $(document).on('change','#addEditCheckmodal',function () {
        check_updated = $(this).serialize();
    });
    $(document).on('click','#closeCheckModal',function () {
        if(check_original != check_updated){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#edit-expensesCheck').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                        attachment = null;
                        attachment_id = [];
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#edit-expensesCheck').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            }
        });
        }else{
            if(attachment == 0){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "There is/are a attachment that temporarily removed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it permanently!'
                }).then((result) => {
                    if (result.value) {
                    $.ajax({
                        url:"/accounting/removePermanentlyAttachment",
                        type:"POST",
                        data:{attachment_id:attachment_id},
                        success:function () {

                        }
                    });
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#edit-expensesCheck').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            });
            }else{
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });
                $('#edit-expensesCheck').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        }
    });
    $(document).on('click','#checkUpdate',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var check_id = $('#checkID').val();
        var transaction_id = $('#checktransID').val();
        var vendor_id = $('#checkVendorID').val();
        var bank_account = $('#bank_account').val();
        var mailing_address = $('#check_mailing_address').val();
        var payment_date = $('#payment_date').val();
        var check_number = $('#check_number').val();
        var print_later = $('#print_later').val();
        var permit_number = $('#permit_number').val();
        var memo = $('#checkMemo').val();
        var category_id = getArrayCategoriesId($('.categories_id'));
        var category = getArrayCategory($('.checkCategory'));
        var description = getArrayDescription($('.checkDescription'));
        var amount = getArrayAmount($('.checkAmount'));
        var total = $('#total-amount-check').text();
        $.ajax({
            url:$('#addEditCheckmodal').attr('action'),
            type:"POST",
            cache: false,
            dataType:"json",
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
                memo:memo,
                category_id:category_id,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:check_filename,
                original_fname:original_fname_check
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Check expense has been updated!",
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
                showExpenseTransactionsTable();
                $('#checkAttachment').next().next($('.dz-preview').remove());
                $('#checkAttachment').next($('.dz-message').css({"display":"inherit"}));
                $('#checkID').removeClass('expenses-ID-'+transaction_id);
                $('#checkType').removeClass('expenseType-'+transaction_id);
                attachment = null;
                attachment_id = [];
                showExpenseTransactionsTable();
            }
        });
    });

    // Delete Check
    $(document).on('click','#deleteCheck',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
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
                    success:function () {
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                        Swal.fire(
                            {
                                showConfirmButton: false,
                                timer: 2000,
                                title: 'Success',
                                text: "Check expense has been deleted.!",
                                icon: 'success'
                            });
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
            url:siteURL + 'accounting/expensesTransactionAttachment',
            // acceptedFiles: "image/*",
            maxFilesize:20,
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    check_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                    original_fname_check.push(file.name);
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
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#billForm').attr('action',"/accounting/addBill");
        $('#billForm')[0].reset();
        $("#billTerms").select2('val','All');
        $("#billVendorID").select2('val','All');
        $('#billMailingAddress').html(null);
        $('#total-amount-bill').html('0.00');
        var container = '#line-container-bill';
        var row = 'tableLine-bill';
        var cat_class = 'billCategory';
        var des_class = 'billDescription';
        var amount_class = 'billAmount';
        var counter = 'line-counter-bill';
        var remove_id = 'delete-row-bill';
        var select = 'select2-bill-category';
        var preview = '-bill';
        showCategories(0,0,0,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
        $(".loader").fadeOut('fast',function(){
            $('.loader').hide();
        });
    });
    $(document).on('click','#billSaved',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var vendor_id = $('#billVendorID').val();
        var mailing_address = $('#billMailingAddress').val();
        var terms = $('#billTerms').val();
        var bill_date = $('#billDate').val();
        var due_date = $('#billDueDate').val();
        var bill_number = $('#billNumber').val();
        var permit_number = $('#billPermitNumber').val();
        var memo = $('#billMemo').val();
        var category = getArrayCategory($('.billCategory'));
        var description = getArrayDescription($('.billDescription'));
        var amount = getArrayAmount($('.billAmount'));
        var total = $('#total-amount-bill').text();
        $.ajax({
            url:$('#billForm').attr('action'),
            type:"POST",
            dataType:"json",
            data:{
                vendor_id:vendor_id,
                mailing_address:mailing_address,
                terms:terms,
                bill_date:bill_date,
                due_date:due_date,
                bill_number:bill_number,
                permit_number:permit_number,
                memo:memo,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:bill_filename,
                original_fname:original_fname_bill
            },
            cache:false,
            success:function (data) {
                console.log(data);
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Bill expense has been added!",
                            icon: 'success'
                        }
                    );
                }else{
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Failed',
                            text: "Something is wrong in the process!",
                            icon: 'warning'
                        }
                    );
                }

                showExpenseTransactionsTable();
                $('#billAttachment').next().next($('.dz-preview').remove());
                $('#billAttachment').next($('.dz-message').css({"display":"inherit"}));
                attachment = null;
                attachment_id = [];
            }
        });
    });
    var bill_original = null;
    var bill_updated = null;
    $(document).on('click','#editBill',function () {
        $('#bill-modal').modal({backdrop: 'static', keyboard: false});
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#billForm').attr('action',"/accounting/editBillData");
        $('#billSaved').attr('id','billUpdate');
        var transaction_id = $(this).attr('data-transId');
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
            method:"GET",
            data:{id:id,transaction_id:transaction_id},
            dataType:"json",
            cached:false,
            success:function (data) {
                $('#billTransId').val(transaction_id);
                $('#billID').val(data.bill_id);
                $("#billVendorID option[value='"+ data.vendor_id +"']").attr('selected',true);
                $('#billVendorID').next($('#select2-billVendorID-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#billMailingAddress').val(data.address);
                $('#billTerms option:contains('+ data.terms+ ')').attr('selected',true);
                $('#billTerms').next($('#select2-billTerms-container').attr('title',data.terms).html(data.terms));
                $('#billDate').val(data.bill_date);
                $('#billDueDate').val(data.due_date);
                $('#billNumber').val(data.bill_number);
                $('#billMemo').val(data.memo);
                $('#billPermitNumber').val(data.permit_number);
                $('#billID').addClass('expenses-ID-'+transaction_id);
                $('#billType').addClass('expenseType-'+transaction_id);
                bill_original = $('#line-container-bill').closest('.modal-content').find('form').serialize();
                bill_updated = bill_original;
                showCategories(data.check_category,transaction_id,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
                displayAttachments(id,'Bill',preview);
                if (bill_original != null){
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
    $(document).on('change','#billForm',function () {
        bill_updated = $(this).serialize();
    });
    $(document).on('click','#closeBillModal',function () {
        if(bill_original != bill_updated){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#bill-modal').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                        attachment = null;
                        attachment_id = [];
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#bill-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            }
        });
        }else{
            if(attachment == 0){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "There is/are a attachment that temporarily removed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it permanently!'
                }).then((result) => {
                    if (result.value) {
                    $.ajax({
                        url:"/accounting/removePermanentlyAttachment",
                        type:"POST",
                        data:{attachment_id:attachment_id},
                        success:function () {

                        }
                    });
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#bill-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            });
            }else{
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });
                $('#bill-modal').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        }


    });
    $(document).on('click','#billUpdate',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var transaction_id = $('#billTransId').val();
        var bill_id = $('#billID').val();
        var vendor_id = $('#billVendorID').val();
        var mailing_address = $('#billMailingAddress').val();
        var terms = $('#billTerms').val();
        var bill_date = $('#billDate').val();
        var due_date = $('#billDueDate').val();
        var bill_number = $('#billNumber').val();
        var permit_number = $('#billPermitNumber').val();
        var memo = $('#billMemo').val();
        var category_id = getArrayCategoriesId($('.categories_id'));
        var category = getArrayCategory($('.billCategory'));
        var description = getArrayDescription($('.billDescription'));
        var amount = getArrayAmount($('.billAmount'));
        var total = $('#total-amount-bill').text();
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
                memo:memo,
                category_id:category_id,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:bill_filename,
                original_fname:original_fname_bill
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Bill expense has been updated!",
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
                showExpenseTransactionsTable();
                $('#billAttachment').next().next($('.dz-preview').remove());
                $('#billAttachment').next($('.dz-message').css({"display":"inherit"}));
                $('#billID').removeClass('expenses-ID-'+transaction_id);
                $('#billType').removeClass('expenseType-'+transaction_id);
                attachment = null;
                attachment_id = [];
            }
        });
    });
    // Delete Bill
    $(document).on('click','#deleteBill',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
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
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Bill expense has been deleted!",
                            icon: 'success'
                        });
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
            url: siteURL + 'accounting/expensesTransactionAttachment',
            // acceptedFiles: "image/*",
            maxFilesize:20,
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    bill_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                    original_fname_bill.push(file.name);
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
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#expenseForm').attr('action',"accounting/addExpense");
        $('#expenseForm')[0].reset();
        $("#expenseVendorId").select2('val','All');
        $("#expensePaymentAccount").select2('val','All');
        $("#expensePaymentMethod").select2('val','All');
        $('#total-amount-bill').html('0.00');
        var container = '#line-container-expense';
        var row = "tableLine-expense";
        var cat_class = 'expenseCategory';
        var des_class = 'expenseDescription';
        var amount_class = 'expenseAmount';
        var counter = 'line-counter-expense';
        var remove_id = 'delete-row-expense';
        var select = 'select2-expense-category';
        var preview = '-expense';
        showCategories(0,0,0,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
        $(".loader").fadeOut('fast',function(){
            $('.loader').hide();
        });
    });
    $(document).on('click','#expenseSaved',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var vendor_id = $('#expenseVendorId').val();
        var payment_account = $('#expensePaymentAccount').val();
        var payment_date = $('#expensePaymentDate').val();
        var payment_method = $('#expensePaymentMethod').val();
        var ref_number = $('#expenseRefNumber').val();
        var permit_number = $('#expensePermitNumber').val();
        var memo = $('#expenseMemo').val();
        var category = getArrayCategory($('.expenseCategory'));
        var description = getArrayDescription($('.expenseDescription'));
        var amount = getArrayAmount($('.expenseAmount'));
        var total = $('#total-amount-expense').text();
        $.ajax({
            url:siteURL + $('#expenseForm').attr('action'),
            type:"POST",
            cache:false,
            data:{
                vendor_id:vendor_id,
                payment_account:payment_account,
                payment_date:payment_date,
                payment_method:payment_method,
                ref_number:ref_number,
                permit_number:permit_number,
                memo:memo,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:expense_filename,
                original_fname:original_fname_expense
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "New expense has been added!",
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
                $("#new-popup").css("display", "none");
                $('.modal-backdrop').remove();
                showExpenseTransactionsTable();
                $('#expenseAttachment').next().next($('.dz-preview').remove());
                $('#expenseAttachment').next($('.dz-message').css({"display":"inherit"}));
                attachment = null;
                attachment_id = [];
            }
        });
    });
    var expense_original = null;
    var expense_updated = null;
    $(document).on('click','#editExpense',function () {
        $('#expense-modal').modal({backdrop: 'static', keyboard: false});
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#expenseForm').attr('action',"/accounting/updateExpenseData");
        $('#expenseSaved').attr('id','expenseUpdate');
        var transaction_id = $(this).attr('data-transId');
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
            method:"GET",
            data:{id:id,transaction_id:transaction_id},
            dataType:"json",
            success:function (data) {
                $('#expenseTransId').val(transaction_id);
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
                $('#expenseMemo').val(data.memo);
                $('#expenseId').addClass('expenses-ID-'+transaction_id);
                $('#exType').addClass('expenseType-'+transaction_id);
                showCategories(data.check_category,transaction_id,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
                displayAttachments(id,'Expense',preview);
                expense_original = $('#line-container-expense').closest('.modal-content').find('form').serialize();
                expense_updated = $('#line-container-expense').closest('.modal-content').find('form').serialize();
                if (expense_original != null){
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
    $(document).on('change','#expenseForm',function () {
        expense_updated = $(this).serialize();
    });
    $(document).on('click','#closeModalExpense',function () {
        if(expense_original != expense_updated){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#expense-modal').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                        attachment = null;
                        attachment_id = [];
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#expense-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            }
        });
        }else{
            if(attachment == 0){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "There is/are a attachment that temporarily removed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it permanently!'
                }).then((result) => {
                    if (result.value) {
                    $.ajax({
                        url:"/accounting/removePermanentlyAttachment",
                        type:"POST",
                        data:{attachment_id:attachment_id},
                        success:function () {

                        }
                    });
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#expense-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            });
            }else{
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });
                $('#expense-modal').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        }


    });
    $(document).on('click','#expenseUpdate',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var transaction_id = $('#expenseTransId').val();
        var expense_id =  $('#expenseId').val();
        var vendor_id = $('#expenseVendorId').val();
        var payment_account = $('#expensePaymentAccount').val();
        var payment_date = $('#expensePaymentDate').val();
        var payment_method = $('#expensePaymentMethod').val();
        var ref_number = $('#expenseRefNumber').val();
        var permit_number = $('#expensePermitNumber').val();
        var memo = $('#expenseMemo').val();
        var category_id = getArrayCategoriesId($('.categories_id'));
        var category = getArrayCategory($('.expenseCategory'));
        var description = getArrayDescription($('.expenseDescription'));
        var amount = getArrayAmount($('.expenseAmount'));
        var total = $('#total-amount-expense').text();
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
                memo:memo,
                category_id:category_id,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:expense_filename,
                original_fname:original_fname_expense
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if (data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Expense has been updated!",
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
                showExpenseTransactionsTable();
                $('#expenseAttachment').next().next($('.dz-preview').remove());
                $('#expenseAttachment').next($('.dz-message').css({"display":"inherit"}));
                $('#expenseId').removeClass('expenses-ID-'+transaction_id);
                $('#exType').removeClass('expenseType-'+transaction_id);
                attachment = null;
                attachment_id = [];
            }
        });
    });

    // Delete Expense
    $(document).on('click','#deleteExpense',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
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
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
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
            url:siteURL + 'accounting/expensesTransactionAttachment',
            // acceptedFiles: "image/*",
            maxFilesize:20,
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    expense_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                    original_fname_expense.push(file.name);
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
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#formVendorCredit').attr('action',"/accounting/vendorCredit");
        $('#formVendorCredit')[0].reset();
        $("#vcVendorId").select2('val','All');
        $("#vcMailingAddress").html(null);
        $('#total-amount-vc').text('0.00');
        var container = '#line-container-vendorCredit';
        var row = 'tableLine-vendorCredit';
        var cat_class = 'vcCategory';
        var des_class = 'vcDescription';
        var amount_class = 'vcAmount';
        var counter = 'line-counter-vendorCredit';
        var remove_id = 'delete-row-vendorCredit';
        var select = 'select2-vc-category';
        var preview = '-vc';
        showCategories(0,0,0,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
        $(".loader").fadeOut('fast',function(){
            $('.loader').hide();
        });
    });
    $(document).on('click','#vcSaved',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var vendor_id = $('#vcVendorId').val();
        var mailing_address = $('#vcMailingAddress').val();
        var payment_date = $('#vcPaymentDate').val();
        var ref_number = $('#vcRefNumber').val();
        var permit_number = $('#vcPermitNumber').val();
        var memo = $('#vcMemo').val();
        var category = getArrayCategory($('.vcCategory'));
        var description = getArrayDescription($('.vcDescription'));
        var amount = getArrayAmount($('.vcAmount'));
        var total = $('#total-amount-vc').text();
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
                memo:memo,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:vc_filename,
                original_fname:original_fname_vc
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                if(data == 1){
                    Swal.fire(
                        {
                            showConfirmButton: false,
                            timer: 2000,
                            title: 'Success',
                            text: "Vendor Credit has been added!",
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
                showExpenseTransactionsTable();
                $('#vcAttachment').next().next($('.dz-preview').remove());
                $('#vcAttachment').next($('.dz-message').css({"display":"inherit"}));
                attachment = null;
                attachment_id = [];
            }
        });
    });
    var vc_original = null;
    var vc_updated = null;
    $(document).on('click','#editVendorCredit',function () {
        $('#vendorCredit-modal').modal({backdrop: 'static', keyboard: false});
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        $('#vcSaved').attr('id','updateVC');
        var transaction_id = $(this).attr('data-transId');
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
            type:"GET",
            data:{id:id,transaction_id:transaction_id},
            dataType:"json",
            cached:false,
            success:function (data) {
                $('#vendorCreditId').val(id);
                $('#vcTransId').val(transaction_id);
                $("#vcVendorId option[value='" + data.vendor_id +"']").attr('selected',true);
                $('#vcVendorId').next($('#select2-vcVendorId-container').attr('title',data.vendor_name).html(data.vendor_name));
                $('#vcMailingAddress').val(data.mailing_address);
                $('#vcPaymentDate').val(data.payment_date);
                $('#vcRefNumber').val(data.ref_number);
                $('#vcPermitNumber').val(data.permit_number);
                $('#vcMemo').val(data.memo);
                $('#vendorCreditId').addClass('expenses-ID-'+transaction_id);
                $('#vcType').addClass('expenseType-'+transaction_id);
                showCategories(data.check_category,transaction_id,id,container,row,cat_class,des_class,amount_class,counter,remove_id,select,preview);
                displayAttachments(id,'Vendor Credit',preview);
                vc_original = $('#line-container-vendorCredit').closest('.modal-content').find('form').serialize();
                vc_updated = $('#line-container-vendorCredit').closest('.modal-content').find('form').serialize();
                if (vc_original != null){
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
    $(document).on('change','#formVendorCredit',function () {
        vc_updated = $(this).serialize();
    });
    $(document).on('click','#closeModalVC',function () {
        deleteTemporaryAttachment();
        if(vc_original != vc_updated){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                            $('#vendorCredit-modal').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                        attachment = null;
                        attachment_id = [];
                        }
                    });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#vendorCredit-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
                }
            });
        }else{
            if(attachment == 0){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "There is/are a attachment that temporarily removed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2ca01c',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it permanently!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                           url:"/accounting/removePermanentlyAttachment",
                            type:"POST",
                            data:{attachment_id:attachment_id},
                            success:function () {

                            }
                        });
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#vendorCredit-modal').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                    attachment = null;
                    attachment_id = [];
                }
            });
            }else{
                $(".loader").fadeIn('fast',function(){
                    $('.loader').show();
                });

                $('#vendorCredit-modal').modal('hide');
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
                attachment = null;
                attachment_id = [];
            }
        }

    });
    $(document).on('click','#updateVC',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
        var transaction_id = $('#vcTransId').val();
        var vc_id = $('#vendorCreditId').val();
        var vendor_id = $('#vcVendorId').val();
        var mailing_address = $('#vcMailingAddress').val();
        var payment_date = $('#vcPaymentDate').val();
        var ref_number = $('#vcRefNumber').val();
        var permit_number = $('#vcPermitNumber').val();
        var memo = $('#vcMemo').val();
        var category_id = getArrayCategoriesId($('.categories_id'));
        var category = getArrayCategory($('.vcCategory'));
        var description = getArrayDescription($('.vcDescription'));
        var amount = getArrayAmount($('.vcAmount'));
        var total = $('#total-amount-vc').text();
        $('#attachmentType').val('Vendor Credit');
        $('#attachmentTypePreview').val('-vc');
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
                memo:memo,
                category_id:category_id,
                category:category,
                description:description,
                amount:amount,
                total:total,
                filename:vc_filename,
                original_fname:original_fname_vc
            },
            success:function (data) {
                $(".loader").fadeOut('fast',function(){
                    $('.loader').hide();
                });
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
                showExpenseTransactionsTable();
                $('#vcAttachment').next().next($('.dz-preview').remove());
                $('#vcAttachment').next($('.dz-message').css({"display":"inherit"}));
                $('#vcType').removeClass('expenseType-'+transaction_id);
                $('#vendorCreditId').removeClass('expenses-ID-'+transaction_id);
                attachment = null;
                attachment_id = [];
            }
        });
    });
    //Delete Vendor Credit
    $(document).on('click','#deleteVendorCredit',function () {
        $(".loader").fadeIn('fast',function(){
            $('.loader').show();
        });
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
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
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
            url:siteURL + 'accounting/expensesTransactionAttachment',
            // acceptedFiles: "image/*",
            maxFilesize:20,
            addRemoveLinks:true,
            init: function() {
                this.on("success", function(file,response) {
                    fname.push(response.replace(/\"/g, ""));
                    vc_filename.push(response.replace(/\"/g, ""));
                    selected.push(file);
                    original_fname_vc.push(file.name);
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

    $(document).on('click','#removeAttachment',function () {
        $(this).prev('span').prev('span').toggleClass('cross-out');
        $(this).toggleClass('tooltip');
        $(this).children('i.fa').toggleClass('fa-exclamation-triangle');
        $(this).next('span').toggleClass('hide');
        var status = $(this).attr('data-status');
        var attach_id = $(this).next().next('#attachmentId').val();
        if (status == 1){
            $(this).attr('data-status',0);
            attachment_id.push(attach_id);
            console.log(attachment_id);
            attachment = 0;
        }else{
            $(this).attr('data-status',1);
            attachment = 1;
            Array.prototype.remove = function(v) { this.splice(this.indexOf(v) == -1 ? this.length : this.indexOf(v), 1); }
            attachment_id.remove(attach_id);
        }
        $.ajax({
            url:"/accounting/removeTemporaryAttachment",
            type:"POST",
            data:{attach_id:attach_id,status:status},
            success:function (data) {

            }
        });
    });
//Show Existing file
    $(document).on('click','#showExistingFile',function (e) {
        $('#showExistingModal').modal({backdrop: 'static', keyboard: false});
        $(".modal-backdrop").hide();
        var transaction_id = $(e.target).closest('.modal-body').find('.transaction_id').val();
        var expenses_id = $('.expenses-ID-'+transaction_id).val();
        var type =  $('.expenseType-'+transaction_id).val();
        $.ajax({
            url:"/accounting/showExistingFile",
            method:"GET",
            dataType:"json",
            data:{expenses_id:expenses_id,type:type,transaction_id:transaction_id},
            success:function (data) {
                $('.modal-existing-file-container').html(data);
            }
        });
    });
//Adding Existing file
    $(document).on('click','#addingFileAttachment',function (e) {
        var transaction_id = $(e.target).closest('.modal-content').find('#attachmentTransId').val();
        var trans_from_id = $(e.target).closest('.modal-content').find('#attachTransFromId').val();
        var expenses_id = $(e.target).closest('.modal-content').find('#attachmentExpensesId').val();
        var type = $(e.target).closest('.modal-content').find('#attachmentType').val();
        var preview = $(e.target).closest('.modal-content').find('#attachmentTypePreview').val();
        var original_fname = $(this).attr('data-fname');
        var file_id = $(this).attr('data-id');
        $(this).text('Added');
        $(this).addClass('isDisabled');
        $.ajax({
            url:"/accounting/addingFileAttachment",
            type:"POST",
            cache:false,
            data:{file_id:file_id,expenses_id:expenses_id,transaction_id:transaction_id,trans_from_id:trans_from_id,type:type,original_fname:original_fname},
            success:function () {
                displayAttachments(expenses_id,type,preview);
            }
        });
    });

});


//Add expense categories
//Bill modal
$(document).on('click','#select2-category-id-bill-results > li',function () {
    $('#addNewCategories').modal({backdrop: 'static', keyboard: false});
    $("#addNewCategories").css('z-index',1055);
    $('.modal-backdrop').css('z-index',1052);
    $('.modal-backdrop').css('display','inherit');
});
//Expense modal
$(document).on('click','#select2-category-id-expense-results > li',function () {
    $('#addNewCategories').modal({backdrop: 'static', keyboard: false});
    $("#addNewCategories").css('z-index',1055);
    $('.modal-backdrop').css('z-index',1052);
    $('.modal-backdrop').css('display','inherit');
});
//Check modal
$(document).on('click','#select2-category-id-check-results > li',function () {
    $('#addNewCategories').modal({backdrop: 'static', keyboard: false});
    $("#addNewCategories").css('z-index',1055);
    $('.modal-backdrop').css('z-index',1052);
    $('.modal-backdrop').css('display','inherit');
});
// Vendor credit modal
$(document).on('click','#select2-category-id-vc-results > li',function () {
    $('#addNewCategories').modal({backdrop: 'static', keyboard: false});
    $("#addNewCategories").css('z-index',1055);
    $('.modal-backdrop').css('z-index',1052);
    $('.modal-backdrop').css('display','inherit');
});
//Expense Transactions page
$(document).on('click','#select2-expenseTransCategory-results > li',function () {
    $('#addNewCategories').modal({backdrop: 'static', keyboard: false});
    $("#addNewCategories").css('z-index',1055);
    $('.modal-backdrop').css('z-index',1052);
    $('.modal-backdrop').css('display','inherit');
});
$(document).on('click','#closedAddCategory', function () {
    if (!$('#addNewCategories').is(':visible')){
        $('.modal-backdrop').css('z-index',1049);
        $('.modal-backdrop').css('display','none');
    }
});
$(document).on('change','#selectDetailType',function () {
    $('#addCategoryName').val($(this).val());

    var advertising = $('#detailDescAdvertise').html();
    var auto = $('#detailDescAuto').html();
    var bad_debt = $('#detailDescBadDebt').html();
    var bank_charges = $('#detailDescBankCharges').html();
    var charitable = $('#detailDescCharitable').html();
    var cost_of_labor = $('#detailDescCostOfLabor').html();
    var due_subscription = $('#detailDescDueSubscription').html();
    var entertainment = $('#detailDescEntertainment').html();
    var entertainment_meals = $('#detailDescEntertainmentMeals').html();
    var equipment_rental = $('#detailDescEquipmentRental').html();
    var finance = $('#detailDescFinance').html();
    var insurance = $('#detailDescInsurance').html();
    var interest_paid = $('#detailDescInterestPaid').html();
    var fee = $('#detailDescLegalProfFee').html();
    var general_admin = $('#detailDescGeneralAdmin').html();
    var other_business = $('#detailDescOtherBusiness').html();
    var mis_service = $('#detailDescMisService').html();
    var payroll = $('#detailDescPayrollExpenses').html();
    var promo_meals = $('#detailDescPromotionalMeals').html();
    var rent_lease = $('#detailDescRentLease').html();
    var repair = $('#detailDescRepairMaintain').html();
    var shipping = $('#detailDescShipping').html();
    var supplies = $('#detailDescSupplies').html();
    var taxes_paid = $('#detailDescTaxesPaid').html();
    var travel = $('#detailDescTravel').html();
    var travel_meals = $('#detailDescTravelMeals').html();
    var unapplied = $('#detailDescUnapplied').html();
    var utilities = $('#detailDescUtilities').html();

    switch ($(this).val()){
        case "Advertising/Promotional":
            $('.detailTypeDesc').html(advertising);
            break;
        case "Auto":
            $('.detailTypeDesc').html(auto);
            break;
        case "Bad Debts":
            $('.detailTypeDesc').html(bad_debt);
            break;
        case "Bank Charges":
            $('.detailTypeDesc').html(bank_charges);
            break;
        case "Charitable Contributions":
            $('.detailTypeDesc').html(charitable);
            break;
        case "Cost & Labor":
            $('.detailTypeDesc').html(cost_of_labor);
            break;
        case "Dues & subscription":
            $('.detailTypeDesc').html(due_subscription);
            break;
        case "Entertainment":
            $('.detailTypeDesc').html(entertainment);
            break;
        case "Entertainment Meals":
            $('.detailTypeDesc').html(entertainment_meals);
            break;
        case "Equipment Rental":
            $('.detailTypeDesc').html(equipment_rental);
            break;
        case "Finance costs":
            $('.detailTypeDesc').html(finance);
            break;
        case "Insurance":
            $('.detailTypeDesc').html(insurance);
            break;
        case "Interest Paid":
            $('.detailTypeDesc').html(interest_paid);
            break;
        case "Legal & Professional fees":
            $('.detailTypeDesc').html(fee);
            break;
        case "Office/General Administrative Expenses":
            $('.detailTypeDesc').html(general_admin);
            break;
        case "Other Business Expenses":
            $('.detailTypeDesc').html(other_business);
            break;
        case "Other Miscellaneous Service Cost":
            $('.detailTypeDesc').html(mis_service);
            break;
        case "Payroll Expenses":
            $('.detailTypeDesc').html(payroll);
            break;
        case "Promotional Meals":
            $('.detailTypeDesc').html(promo_meals);
            break;
        case "Rent or Lease of Buildings":
            $('.detailTypeDesc').html(rent_lease);
            break;
        case "Repair & Maintenance":
            $('.detailTypeDesc').html(repair);
            break;
        case "Shipping,Freight & Delivery":
            $('.detailTypeDesc').html(shipping);
            break;
        case "Supplies & Materials":
            $('.detailTypeDesc').html(supplies);
            break;
        case "Taxes Paid":
            $('.detailTypeDesc').html(taxes_paid);
            break;
        case "Travel":
            $('.detailTypeDesc').html(travel);
            break;
        case "Travel Meals":
            $('.detailTypeDesc').html(travel_meals);
            break;
        case "Unapplied Cash Bill Payment Expenses":
            $('.detailTypeDesc').html(unapplied);
            break;
        case "Utilities":
            $('.detailTypeDesc').html(utilities);
            break;
        default:
            $('.detailTypeDesc').html(advertising);
            break;
    }
});
$(document).on('change','#checkBoxSubAccount',function () {
    $("#selectSubAccount").attr("disabled", ! $(this).is(':checked'));
});
$(document).on('click','#addCategorySaved',function () {
    if (!$('#addNewCategories').is(':visible')){
        $('.modal-backdrop').css('z-index',1049);
        $('.modal-backdrop').css('display','none');
    }
   var account_type = $('#addCategoryType').val();
   var detail_type = $('#selectDetailType').val();
   var name = $('#addCategoryName').val();
   var description = $('#addCategoryDesc').val();
   var sub_account = $('#selectSubAccount').val();
   $.ajax({
      url:"/accounting/addCategories",
      type:"POST",
      data:{
          account_type:account_type,
          detail_type:detail_type,
          name:name,
          description:description,
          sub_account:sub_account
      },
      success:function (data) {
        if (data == 1){
            Swal.fire(
                {
                    showConfirmButton: false,
                    timer: 2000,
                    title: 'Success',
                    text: "New category added",
                    icon: 'success'
                });
        }else{
            Swal.fire(
                {
                    showConfirmButton: false,
                    timer: 5000,
                    title: 'Failed',
                    text: "Sorry the *Name is already exist",
                    icon: 'warning'
                });
        }
      }
   });
});

    //Upload Receipt image or Add receipt
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var fname;
    var site_url = jQuery("#siteurl").val();
    var receiptDropzone = new Dropzone('div#receiptDZ', {
        url: site_url +'/accounting/uploadReceiptImage',
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
$(document).on('click','.receiptsTable__row',function (event) {
    const { target: $target } = event;
    if ($target.classList.contains("receiptsTable__checkbox")) return;
    if ($target.classList.contains("receiptsTable__selectColumn")) return;
    if ($target.classList.contains("action")) return;

    var id = $(this).attr('data-id');
    var site_url = jQuery("#siteurl").val();
    $.ajax({
        url: site_url +"/accounting/getReceiptData",
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
            $('#deleteReceipt').attr("data-id", data.id);
            const createdAt = moment(data.created_at).format("hh:mm A MM/DD/YYYY");
            $('#receiptImageCreatedAt').text(`Added ${createdAt}`);
            $("#receiptModal").modal("show");
        }
    });
});
// Delete Receipt
$(document).on('click','#deleteReceipt',function (event) {
    event.preventDefault();
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
            url:`${window.prefixURL}/AccountingReceipts/apiDeleteReceipt/${id}`,
            method: 'DELETE',
            success:function (data) {
                window.location.reload();
            }
        });
    }
});
});


/** Invoice **/
$(document).on('click','#closeAddInvoiceModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#add-invoice').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#add-invoice').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
	
/** Receive Payment **/
$(document).on('click','#closeReceivePaymentModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#receive-payment').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#receive-payment').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
	
/** Estimate **/
$(document).on('click','#closeAddEstimateModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#add-estimate').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#add-estimate').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
	
/** Sales Receipt **/
$(document).on('click','#closeSalesReceiptModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#sales-receipt').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#sales-receipt').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });
	
/** Credit Memo **/
$(document).on('click','#closeCreditMemoModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it permanently!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#credit-memo').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#credit-memo').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });

/** Delayed Charge **/
$(document).on('click','#closeDelayedChargeModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it now!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#delayed-charge').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#delayed-charge').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });

	/** Sales Time Acitity **/
$(document).on('click','#closeSalesTimeActivityModal',function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to leave without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, leave without saving!'
            }).then((result) => {
                if (result.value) {
                if(attachment == 0){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "There is/are a attachment that temporarily removed?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2ca01c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it now!'
                    }).then((result) => {
                        if (result.value) {
                        $(".loader").fadeIn('fast',function(){
                            $('.loader').show();
                        });
                        $('#sales-time-activity').modal('hide');
                        $(".loader").fadeOut('fast',function(){
                            $('.loader').hide();
                        });
                    }
                });
                }else{
                    $(".loader").fadeIn('fast',function(){
                        $('.loader').show();
                    });
                    $('#sales-time-activity').modal('hide');
                    $(".loader").fadeOut('fast',function(){
                        $('.loader').hide();
                    });
                }
            }
        });
    });