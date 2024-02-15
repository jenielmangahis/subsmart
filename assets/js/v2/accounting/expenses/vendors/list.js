$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$("#vendors-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#vendors-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#vendors-table thead td[data-name="${dataName}"]`).index();
    $(`#vendors-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_vendors_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_vendors_modal #vendors_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$("#btn_print_vendors").on("click", function() {
    $("#vendors_table_print").printThis();
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#inc_inactive').on('change', function() {
    var currUrl = window.location.href;
    var urlSplit = currUrl.split('/');

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }
    
    if($(this).prop('checked')) {
        if(urlSplit[urlSplit.length - 1] === 'vendors') {
            location.href='vendors?status=all';
        } else {
            location.href = currUrl+'&status=all';
        }
    } else {
        if(currUrl.includes('&status=all')) {
            location.href=currUrl.replace('&status=all', '');
        } else {
            location.href=currUrl.replace('status=all', '');
        }
    }
});

$('.export-items').on('click', function() {
    if($('#export-form').length < 1) {
        $('body').append('<form action="/accounting/vendors/export-vendors" method="post" id="export-form"></form>');
    }

    var fields = $('.dropdown-menu.table-settings input[name="col_chk"]:checked');
    fields.each(function() {
        $('#export-form').append(`<input type="hidden" name="fields[]" value="${$(this).attr('id').replace('_chk', '')}">`);
    });

    $('#export-form').append(`<input type="hidden" name="inactive" value="${$('#inc_inactive').prop('checked') ? 1 : 0}">`);
    $('#export-form').append(`<input type="hidden" name="search" value="${$('#search_field').val()}">`);

    if($('.nsm-counter.selected').length > 0) {
        $('#export-form').append(`<input type="hidden" name="transaction" value="${$('.nsm-counter.selected').attr('id')}">`);
    }

    $('#export-form').append(`<input type="hidden" name="column" value="name">`);
    $('#export-form').append(`<input type="hidden" name="order" value="asc">`);

    $('#export-form').submit();
});

$('#export-form').on('submit', function(e) {
    e.preventDefault();
    this.submit();
    $(this).remove();
});

$('#add-vendor-button').on('click', function(e) {
    e.preventDefault();

    $.get( base_url + 'accounting/get-add-vendor-details-modal', function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${result}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${result}
                </div>
            `);
        }

        var vendorAttachment = new Dropzone(`#vendAtt`, {
            url: '/accounting/attachments/attach',
            maxFilesize: 20,
            uploadMultiple: true,
            // maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var ids = JSON.parse(response)['attachment_ids'];
                    for (i in ids) {
                        if ($('#vendor-modal').find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                            $('#modal-container #vendor-modal #vendAtt').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                        }

                        vendAttIds.push(ids[i]);
                    }
                    vendAttFiles.push(file);
                });
            },
            removedfile: function(file) {
                var ids = vendAttIds;
                var index = vendAttFiles.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];

                $('#modal-container #vendor-modal').find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });

        $('#modal-container #vendor-modal select').select2({
            dropdownParent: $('#modal-container #vendor-modal')
        });
        $('#modal-container #vendor-modal .date').datepicker({
            format: 'mm/dd/yyyy',
            orientation: 'bottom',
            autoclose: true
        });

        $('#modal-container #vendor-modal form').attr('action', base_url + 'accounting/vendors/add');
        $('#modal-container #vendor-modal form').attr('method', 'post');
        //$('#modal-container #vendor-modal form').attr('novalidate', 'novalidate');
        $('#modal-container #vendor-modal form').attr('enctype', 'multipart/form-data');
        $('#modal-container #vendor-modal form').addClass('form-validate');
        $('#modal-container #vendor-modal form').removeAttr('id');

        $('#modal-container #vendor-modal').modal('show');
    });
});

$('#print-checks').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="print_checks_modal"]').trigger('click');
});

$('#pay-bills').on('click', function(e) {
    e.preventDefault();

    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-view="pay_bills_modal"]').trigger('click');
});

$('#vendors-table .select-all').on('change', function() {
    if($(this).prop('checked')) {
        $('#vendors-table tbody input.select-one').prop('checked', true);
        $('#delete-vendor').removeClass('disabled');
    } else {
        $('#vendors-table tbody input.select-one').prop('checked', false);
        $('#delete-vendor').addClass('disabled');
    }
});

$('#vendors-table .select-one').on('change', function() {
    var checked = $('#vendors-table tbody tr:visible input.select-one:checked');
    var totalrows = $('#vendors-table tbody tr:visible input.select-one').length;

    $('#vendors-table .select-all').prop('checked', checked.length === totalrows);

    var href = 'mailto:';
    checked.each(function() {
        var row = $(this).closest('tr');
        var email = row.find('td:nth-child(5)').html().trim();

        if(email !== '') {
            href += ' '+email+',';
        }
    });

    if(href !== 'mailto:') {
        $('#email').removeClass('disabled');
    } else {
        $('#email').addClass('disabled');
    }

    if(checked.length > 0) {
        $('#make-inactive').removeClass('disabled');
        $('#delete-vendor').removeClass('disabled');
    } else {
        $('#make-inactive').addClass('disabled');
        $('#delete-vendor').addClass('disabled');
    }
    $('#email').attr('href', href);
});

$('#make-inactive').on('click', function() {
    var data = new FormData();
    
    $('#vendors-table tbody input.select-one:checked').each(function() {
        data.append('vendors[]', $(this).val());
    });

    Swal.fire({            
        html: "Change the selected vendor status to <b>inactive</b>?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url + 'accounting/vendors/make-inactive',
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#vendors-table .make-inactive').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var data = new FormData();
    data.set('vendors[]', row.find('.select-one').val());

    Swal.fire({            
        html: "Change the selected vendor status to <b>inactive</b>?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url + 'accounting/vendors/make-inactive',
                data: data,
                type: 'post',
                processData: false,
                contentType: false,
                success: function(result) {
                    location.reload();
                }
            });
        }
    });
});

$('#delete-vendor').on('click', function(e) {
    e.preventDefault();

    var data = new FormData();
    
    $('#vendors-table tbody input.select-one:checked').each(function() {
        data.append('vendors[]', $(this).val());
    });

    Swal.fire({            
        html: "Are you sure you want to delete selected vendors?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url + 'accounting/vendors/delete-selected',
                data: data,
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.is_success == 1) {
                        if( result.total_deleted == 1 ){
                            var text_vendor = 'vendor';
                        }else if( result.total_deleted  > 1 ){
                            var text_vendor = 'vendors';                            
                        }                        

                        Swal.fire({
                            text: "Selected "+ text_vendor +" was deleted successfully",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                        });
                    }
                }
            });
        }
    });
});

$('#vendors-table .delete-vendor').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var data = new FormData();
    data.set('vendors[]', row.find('.select-one').val());

    Swal.fire({            
        html: "Are you sure you want to delete selected vendor?",
        icon: 'question',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url + 'accounting/vendors/delete-selected',
                data: data,
                type: 'post',
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.is_success == 1) {
                        if( result.total_deleted == 1 ){
                            var text_vendor = 'vendor';
                        }else if( result.total_deleted  > 1 ){
                            var text_vendor = 'vendors';                            
                        }                        

                        Swal.fire({
                            text: "Selected "+ text_vendor +" was deleted successfully",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    }else{
                        Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: o.msg
                        });
                    }
                }
            });
        }
    });
});

$('#vendors-table .make-active').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');
    var data = new FormData();
    data.set('vendors[]', row.find('.select-one').val());

    $.ajax({
        url: '/accounting/vendors/make-active',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            location.reload();
        }
    });
});

$('.nsm-counter').on('click', function() {
    var currUrl = window.location.href;

    if(currUrl.slice(-1) === '#') {
        currUrl = currUrl.slice(0, -1); 
    }

    var urlSplit = currUrl.split('/');

    if($(this).hasClass('selected')) {
        if(currUrl.includes(`&transaction=${$(this).attr('id')}`)) {
            location.href = currUrl.replace(`&transaction=${$(this).attr('id')}`, '');
        } else {
            location.href = currUrl.replace(`transaction=${$(this).attr('id')}`, '');
        }
    } else {
        if($('.nsm-counter.selected').length > 0) {
            var selected = $('.nsm-counter.selected').attr('id');
    
            currUrl = currUrl.replace(`transaction=${selected}`, `transaction=${$(this).attr('id')}`);
    
            location.href = currUrl;
        } else {
            if(urlSplit[urlSplit.length - 1] === 'vendors') {
                location.href=`vendors?transaction=${$(this).attr('id')}`;
            } else {
                location.href = currUrl+`&transaction=${$(this).attr('id')}`;
            }
        }
    }
});

$('#vendors-table .create-bill').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get(base_url + 'accounting/get-other-modals/bill_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#billModal #vendor').html(`<option value="${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#billModal';
        initModalFields('billModal');

        $('#billModal').modal('show');
    });
});

$('#vendors-table .create-expense').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/expense_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#expenseModal #payee').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#expenseModal';
        initModalFields('expenseModal');

        $('#expenseModal').modal('show');
    });
});

$('#vendors-table .write-check').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/check_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#checkModal #payee').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#checkModal';
        initModalFields('checkModal');

        $('#checkModal').modal('show');
    });
});

$('#vendors-table .create-purchase-order').on('click', function(e) {
    e.preventDefault();

    var row = $(this).closest('tr');

    $.get('/accounting/get-other-modals/purchase_order_modal', function(res) {
        if ($('div#modal-container').length > 0) {
            $('div#modal-container').html(res);
        } else {
            $('body').append(`
                <div id="modal-container"> 
                    ${res}
                </div>
            `);
        }

        $('#purchaseOrderModal #vendor').html(`<option value="vendor-${row.find('.select-one').val()}">${row.find('td:nth-child(2)').text().trim()}</option>`).trigger('change');

        modalName = '#purchaseOrderModal';
        initModalFields('purchaseOrderModal');

        $('#purchaseOrderModal').modal('show');
    });
});

$('#vendors-table .view-attachment').on('click', function(e) {
    e.preventDefault();
    var data = e.currentTarget.dataset;

    window.open(data.href, "_blank");
});

const $overlay = document.getElementById('overlay');
$("#import-vendors-modal #file-upload").change(function(){
    const formData = new FormData();
    const fileInput = document.getElementById('file-upload');
    formData.append('file', fileInput.files[0]);

    if ($overlay) $overlay.style.display = "flex";
    fetch(base_url+'accounting/vendors/get-import-data', {
        method: 'POST',
        body: formData
    }) .then(response => response.json() ).then(response => {
        var { data, headers, success, message }  = response;
        if ($overlay) $overlay.style.display = "none";
        if(!success){
            sweetAlert('Sorry!','error',message);
        }else{
            $.each(headers,function(i,o){
                $('#import-vendors-modal .headersSelector').append(
                    '<option value="'+i+'">'+o+'</option>'
                );
                $('#import-vendors-modal #tableHeader').append(
                    '<th><strong>'+o+'</strong></th>'
                );
            });
            csvHeaders = headers;
            vendorsData = data; // save customer array data
            // process mapping preview
            $.each(data,function(i,o){
                var toAppend = '';
                $.each(o,function(index,data){
                    toAppend += '<td>'+data+'</td>';
                });
                $('#import-vendors-modal #imported_vendors').append(
                    '<tr>'+toAppend+'</tr>'
                );
            });

            $('#import-vendors-modal #nextBtn1').prop("disabled", false);
        }
    }).catch((error) => {
        console.log('Error:', error);
    });
});

$(document).on('click', "#import-vendors-modal .step", function () {
    $(this).addClass("active").prevAll().addClass("active");
    $(this).nextAll().removeClass("active");
});

$(document).on('click', "#import-vendors-modal .step01", function () {
    $("#import-vendors-modal #line-progress").css("width", "8%");
    $("#import-vendors-modal .step1").addClass("active").siblings().removeClass("active");
});

$(document).on('click', "#import-vendors-modal .step02", function () {
    $("#import-vendors-modal #line-progress").css("width", "50%");
    $("#import-vendors-modal .step2").addClass("active").siblings().removeClass("active");

    $('#import-vendors-modal .modal-footer').html(`<button type="button" class="nsm-button step01">Back</button>
    <button type="button" class="nsm-button primary step03">Next</button>`);
});

$(document).on('click', "#import-vendors-modal .step03", function () {
    $("#import-vendors-modal #line-progress").css("width", "100%");
    $("#import-vendors-modal .step3").addClass("active").siblings().removeClass("active");

    $('#import-vendors-modal .modal-footer').html(`<button type="button" class="nsm-button step02">Back</button>
    <button type="button" class="nsm-button primary" id="importVendor">Import</button>`);
});

$(document).on('click', "#import-vendors-modal #importVendor", function(e) {
    // prepare form data to be posted
    
    var selectedHeader = [];
    $('#import-vendors-modal select[name="headers[]"]').each(function() {
        selectedHeader.push(this.value);
    });

    const formData = new FormData();
    formData.append('vendors', JSON.stringify(vendorsData));
    formData.append('mapHeaders', JSON.stringify(selectedHeader));
    formData.append('csvHeaders', JSON.stringify(csvHeaders));
    
    if ($overlay) $overlay.style.display = "flex";
    // perform post request
    fetch(base_url+'accounting/vendors/import-vendors-data', {
        method: 'POST',
        body: formData,
    }) .then(response => response.json() ).then(response => {
        if ($overlay) $overlay.style.display = "none";
        var { customer, csv, mapping, fields, dataValue, office, billing, profile, message, success }  = response;
        if(success){
            sweetAlert('Awesome!','success',message ,1);
        }else{
            sweetAlert('Sorry!','error',message);
        }

        console.log(response);
    }).catch((error) => {
        console.log('Error:', error);
    });
});

function sweetAlert(title,icon,information,is_reload){
    Swal.fire({
        title: title,
        text: information,
        icon: icon,
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if(is_reload === 1){
            if (result.value) {
                window.location.reload();
            }
        }
    });
}

function test(){
    var selectedHeader = [];
    var head = [];
    $('#import-vendors-modal select[name="headers[]"]').each(function() {
        selectedHeader.push(this.value);
    });
    var ar = selectedHeader.length;
    for(var x=0; x<ar; x++){
        head.push(x);
    }

    var arHead = head.length;

    for(var x=0; x<ar; x++){
        if(selectedHeader[x] != ""){
            document.getElementById('headersSelector'+x).value = selectedHeader[x];
            var text = "headersSelector"+x+"";
            for(var i=0; i<arHead; i++){
                var text1 = "headersSelector"+i+"";
                if(text != text1){
                    $("#headersSelector"+i+" option[value='"+selectedHeader[x]+"'").remove();
                }
            }
        }
    }
}