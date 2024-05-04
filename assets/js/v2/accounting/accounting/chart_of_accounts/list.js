$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

$('.dropdown-menu#table-rows a.dropdown-item').on('click', function() {
    var count = $(this).html();
    $('.dropdown-menu#table-rows a.dropdown-item.active').removeClass('active');
    $(this).addClass('active');

    $(this).parent().parent().prev().find('span').html(count);
    $('.dropdown-menu#table-rows').prev().dropdown('toggle');

    $("#accounts-table").nsmPagination({
        itemsPerPage: parseInt(count)
    });
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#accounts-table thead td[data-name="${dataName}"]`).index();
    $(`#accounts-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });

    $(`#print_accounts_modal table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });

    $(`#print_preview_accounts_modal #accounts_table_print tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index - 1]).show();
        } else {
            $($(this).find('td')[index - 1]).hide();
        }
    });
});

$('#inc_inactive').on('change', function() {
    if($(this).prop('checked')) {
        location.href='chart-of-accounts?status=all';
    } else {
        location.href='chart-of-accounts';
    }
});

$("#accounts-table").nsmPagination({
    itemsPerPage: parseInt($('#table-rows li a.active').html().trim())
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));

$('#accounts-table input.select-all').on('change', function() {
    $('#accounts-table tbody tr:visible input[type="checkbox"]').prop('checked', $(this).prop('checked')).trigger('change');
});

$('#accounts-table tbody tr input[type="checkbox"]').on('change', function() {
    // $('#selected-checks').html($('#accounts-table tbody tr:visible input[type="checkbox"]:checked').length);

    var notChecked = $('#accounts-table tbody tr:visible input[type="checkbox"]:not(:checked)').length;
    $('#accounts-table input.select-all').prop('checked', notChecked === 0);

    if($('#accounts-table tbody tr:visible input[type="checkbox"]:checked').length > 0) {
        $('#make-inactive').removeClass('disabled');
    } else {
        $('#make-inactive').addClass('disabled');
    }
});

$('#make-inactive').on('click', function(e) {
    e.preventDefault();
    if($(this).hasClass('disabled') === false) {
        var data = new FormData();

        $('#accounts-table tbody tr:visible input.select-one:checked').each(function() {
            data.append('ids[]', $(this).val());
        });

        $.ajax({
            url:"/accounting/chart-of-accounts/inactive-batch",
            method:"post",
            data: data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                $('#accounts-table tbody tr:visible input.select-one:checked').each(function() {
                    if($('#inc_inactive').prop('checked')) {
                        $(this).closest('tr').find('td:nth-child(2)').html($(this).closest('tr').find('td:nth-child(2)').text() + ' (deleted)');
                    } else {
                        $(this).closest('tr').remove();
                    }
                });
            }
        });

        $('#accounts-table thead .select-all').prop('checked', false);
    }
});

$("#btn_print_accounts").on("click", function() {
    $("#accounts_table_print").printThis();
});

$(document).on('click', '#add-account-button', function(e) {
    e.preventDefault();

    $.get( base_url + 'accounting/get-dropdown-modal/account_modal', function(result) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${result}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${result}
                </div>
            `);
        }

        initAccountModal();
    });
});

$("#accounts-table tbody .edit-account").on("click", function() {
    var id = $(this).closest('tr').find('.select-one').val();
    $.get(base_url + 'accounting/chart-of-accounts/edit/'+id, function(html) {
        if ($('#modal-container').length > 0) {
            $('div#modal-container').html(`${html}`);
        } else {
            $('body').append(`
                <div id="modal-container">
                    ${html}
                </div>
            `);
        }

        initAccountModal();
    });
});

const $overlay = document.getElementById('overlay');
$("#import-accounts-modal #file-upload").change(function(){
    const formData = new FormData();
    const fileInput = document.getElementById('file-upload');
    formData.append('file', fileInput.files[0]);

    if ($overlay) $overlay.style.display = "flex";
    fetch(base_url+'accounting/chart-of-accounts/get-import-data', {
        method: 'POST',
        body: formData
    }) .then(response => response.json() ).then(response => {
        var { data, headers, success, message }  = response;
        if ($overlay) $overlay.style.display = "none";
        if(!success){
            sweetAlert('Sorry!','error',message);
        }else{
            $.each(headers,function(i,o){
                $('#import-accounts-modal .headersSelector').append(
                    '<option value="'+i+'">'+o+'</option>'
                );
                $('#import-accounts-modal #tableHeader').append(
                    '<th><strong>'+o+'</strong></th>'
                );
            });
            csvHeaders = headers;
            accountsData = data; // save customer array data
            // process mapping preview
            $.each(data,function(i,o){
                var toAppend = '';
                $.each(o,function(index,data){
                    toAppend += '<td>'+data+'</td>';
                });
                $('#import-accounts-modal #imported_accounts').append(
                    '<tr>'+toAppend+'</tr>'
                );
            });

            $('#import-accounts-modal #nextBtn1').prop("disabled", false);
        }
    }).catch((error) => {
        console.log('Error:', error);
    });
});

$(document).on('click', "#import-accounts-modal .step", function () {
    $(this).addClass("active").prevAll().addClass("active");
    $(this).nextAll().removeClass("active");
});

$(document).on('click', "#import-accounts-modal .step01", function () {
    $("#import-accounts-modal #line-progress").css("width", "8%");
    $("#import-accounts-modal .step1").addClass("active").siblings().removeClass("active");
});

$(document).on('click', "#import-accounts-modal .step02", function () {
    $("#import-accounts-modal #line-progress").css("width", "50%");
    $("#import-accounts-modal .step2").addClass("active").siblings().removeClass("active");

    $('#import-accounts-modal .modal-footer').html(`<button type="button" class="nsm-button step01">Back</button>
    <button type="button" class="nsm-button primary step03">Next</button>`);
});

$(document).on('click', "#import-accounts-modal .step03", function () {
    $("#import-accounts-modal #line-progress").css("width", "100%");
    $("#import-accounts-modal .step3").addClass("active").siblings().removeClass("active");

    $('#import-accounts-modal .modal-footer').html(`<button type="button" class="nsm-button step02">Back</button>
    <button type="button" class="nsm-button primary" id="importAccount">Import</button>`);
});

$(document).on('click', "#import-accounts-modal #importAccount", function(e) {
    // prepare form data to be posted
    
    var selectedHeader = [];
    $('#import-accounts-modal select[name="headers[]"]').each(function() {
        selectedHeader.push(this.value);
    });

    const formData = new FormData();
    formData.append('accounts', JSON.stringify(accountsData));
    formData.append('mapHeaders', JSON.stringify(selectedHeader));
    formData.append('csvHeaders', JSON.stringify(csvHeaders));
    
    if ($overlay) $overlay.style.display = "flex";
    // perform post request
    fetch(base_url+'accounting/chart-of-accounts/import-accounts-data', {
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
    $('#import-accounts-modal select[name="headers[]"]').each(function() {
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

$('#apply-filter-coa-button').on('click', function() {
    var filterType = $('.filter-coa-type').val();            
    var url = `${base_url}accounting/chart-of-accounts?`;
    url += filterType !== 0 ? `type=${filterType}&` : '';
    if(url.slice(-1) === '?' || url.slice(-1) === '&' || url.slice(-1) === '#') {
        url = url.slice(0, -1); 
    }
    location.href = url;
});