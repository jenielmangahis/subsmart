const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";
var rowCount = 0;
var rowInputs = '';
var blankRow = '';

$(function() {
    $(document).on('click', 'ul#accounting_order li a[data-toggle="modal"], ul#accounting_employees li a', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var view = target.view
        var modal_element = target.target;

        $.get(GET_OTHER_MODAL_URL+view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
                $(modal_element).modal('show');
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
                $(modal_element).modal('show');
            }

            if($('div#modal-container table').length > 0) {
                rowCount = $('div#modal-container table tbody tr').length;
                rowInputs = $('div#modal-container table tbody tr:first-child()').html();
                blankRow = $('div#modal-container table tbody tr:nth-child(2)').html();

                $('div#modal-container table tbody tr:first-child()').html(blankRow);
                $('div#modal-container table tbody tr:first-child() td:nth-child(2)').html(1);
            }
        });
    });

    $(document).on('keyup', 'div#journalEntryModal input#journalNo', function() {
        if($(this).val() !== "") {
            var val = $(this).val();
            $('div#journalEntryModal h4.modal-title').html(`Journal Entry #${val}`);
        } else {
            $('div#journalEntryModal h4.modal-title').html('Journal Entry');
        }
    });

    $(document).on('click', 'div#modal-container table tbody tr', function() {
        if($(this).children('td:nth-child(3)').children('select').length < 1) {
            var rowNum = $(this).children().next().html();

            $(this).html(rowInputs);
            $(this).children('td:nth-child(2)').html(rowNum);
        }
    });

    $(document).on('click', 'div#modal-container table tbody tr td a.deleteRow', function() {
        $(this).parent().parent().remove();
        if($('div#modal-container table tbody tr').length < rowCount) {
            $('div#modal-container table tbody').append(`<tr>${blankRow}</tr>`)
        } 

        var num = 1;
    
        $('div#modal-container table tbody tr').each(function() {
            $(this).children('td:nth-child(2)').html(num);
            num++;
        });
    });
});

const addTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;
    var lastRow = $(`table${table} tbody tr:last-child() td:nth-child(2)`)
    var lastRowCount = parseInt(lastRow.html());

    for(var i = 0; i < rowCount; i++) {
        lastRowCount++;
        $(`table${table} tbody`).append(`<tr>${blankRow}</tr>`);
        $(`table${table} tbody tr:last-child() td:nth-child(2)`).html(lastRowCount);
    }
}

const clearTableLines = (e) => {
    e.preventDefault();
    var table = e.currentTarget.dataset.target;

    $(`table${table} tbody tr`).each(function(index, value) {
        if(index < rowCount) {
            $(this).children().each(function(){
                $(this).children('input').remove();
                $(this).children('select').remove();
            });
        }
        if(index >= rowCount) {
            $(this).remove();
        }
    });
}

const submitModalForm = (event, el) => {
    event.preventDefault();

    var data = new FormData(document.getElementById($(el).attr('id')));
    data.append('modal_name', $(el).parent().parent().attr('id'));

    $.ajax({
        url: '/accounting/submit-modal-form',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            $('.modal').modal('hide');

            toast(res.success, res.message);
        }
    });
}

const toast = (status = true, text = "Success", position = "top-right") => {
    var icon = status ? "success" : "error";
    var heading = status ? "Success" : "Error";

    $.toast({
        icon: icon,
        heading: heading,
        text: text,
        showHideTransition: 'fade',
        hideAfter: 3000,
        allowToastClose: true,
        position: position,
        stack: false,
        loader: false,
    });
}

const showHiddenFields = (el) => {
    if($(el).attr('id') === 'billable') {
        if($(el).prop('checked') === true) {
            $(el).next().next().removeClass('hide');
            $(el).next().next().attr('required', 'required');
            $(el).parent().next().removeClass('hide');
        } else {
            $(el).next().next().addClass('hide');
            $(el).next().next().removeAttr('required');
            $(el).parent().next().addClass('hide');
        }
    }

    if($(el).attr('id') === 'startEndTime') {
        if($(el).prop('checked') === true) {
            $('input#startTime, input#endTime').parent().removeClass('hide');
            $('input#startTime, input#endTime').attr('required', 'required');
            $('label[for="time"]').html('Break');
        } else {
            $('input#startTime, input#endTime').parent().addClass('hide')
            $('input#startTime, input#endTime').removeAttr('required', 'required');
            $('label[for="time"]').html('Time');
        }
    }
}