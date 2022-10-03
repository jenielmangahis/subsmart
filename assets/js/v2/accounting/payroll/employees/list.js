$('.dropdown-menu.table-settings').on('click', function(e) {
    e.stopPropagation();
});

var element = document.querySelector('#privacy');
var switchery = new Switchery(element, {size: 'small'});

$('#privacy').on('change', function() {
    if($(this).prop('checked')) {
        $('#employees-table tbody .pay-rate').html(`<i class="bx bx-fw bx-lock-alt"></i>`);
    } else {
        $('#employees-table tbody tr .pay-rate').each(function() {
            var data = $(this).data();

            $(this).html(data.pay_rate);
        });
    }
});

$('.dropdown-menu.table-settings input[name="col_chk"]').on('change', function() {
    var chk = $(this);
    var dataName = $(this).next().text();

    var index = $(`#employees-table thead td[data-name="${dataName}"]`).index();
    $(`#employees-table tr`).each(function() {
        if(chk.prop('checked')) {
            $($(this).find('td')[index]).show();
        } else {
            $($(this).find('td')[index]).hide();
        }
    });
});

$('#status-filter li a.dropdown-item').on('click', function(e) {
    e.preventDefault();
    var search = $('#search_field').val();

    var status = $(this).attr('id').replace('-employees', '');

    var url = `${base_url}accounting/employees?`;

    url += search !== '' ? `search=${search}&` : '';
    url += status !== 'active' ? `status=${status}` : '';

    if(url.slice(-1) === '&') {
        url = url.slice(0, -1);
    }

    if(url.slice(-1) === '?') {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#search_field").on("input", debounce(function() {
    let _form = $(this).closest("form");

    _form.submit();
}, 1500));