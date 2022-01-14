$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#tags-filter-dropdown select').each(function() {
    $(this).select2();
});

$('#filter-dropdown select').each(function() {
    if($(this).attr('id') !== 'by-contact') {
        $(this).select2({
            minimumResultsForSearch: -1
        });
    } else {
        $(this).select2({
            ajax: {
                url: '/accounting/get-dropdown-choices',
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        type: 'public',
                        field: 'transaction-contact'
                    }

                    // Query parameters will be ?search=[term]&type=public&field=[type]
                    return query;
                }
            },
            templateResult: formatResult,
            templateSelection: optionSelect
        });
    }
});

$('#filter-dropdown input.datepicker').datepicker({
    uiLibrary: 'bootstrap'
});

$('#date').on('change', function() {
    switch($(this).val()) {
        case 'all' :
            var from = '';
            var to = '';
        break;
        case 'today' :
            var today = new Date();
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            var date = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var from = date;
            var to = date;
        break;
        case 'yesterday' :
            var today = new Date();
            today.setDate(today.getDate() - 1);
            var todayDate = String(today.getDate()).padStart(2, '0');
            var todayMonth = String(today.getMonth() + 1).padStart(2, '0');
            var date = todayMonth + '/' + todayDate + '/' + today.getFullYear();

            var from = date;
            var to = date;
        break;
        case 'this-week' :
            var today = new Date();
            var first = today.getDate() - today.getDay();
            var last = first + 6;

            var from = new Date(today.setDate(first));
            var to = new Date(today.setDate(last));
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'this-month' :
            var today = new Date();
            var to = new Date(today.getFullYear(), today.getMonth() + 1, 0);

            var from = String(today.getMonth() + 1).padStart(2, '0') + '/01/' + today.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + today.getFullYear();
        break;
        case 'this-quarter' :
            var today = new Date();
            var year = today.getFullYear();
            var quarters = [
                [1,2,3],
                [4,5,6],
                [7,8,9],
                [10,11,12]
            ];

            var dates = [];
            dates[0] = {
                from: '01/01/'+year,
                to: '03/31/'+year
            };
            dates[1] = {
                from: '04/01/'+year,
                to: '06/30/'+year
            };
            dates[2] = {
                from: '07/01/'+year,
                to: '09/30/'+year
            };
            dates[3] = {
                from: '10/01/'+year,
                to: '12/31/'+year
            };

            var quarter = 0;
            for(var i = 0; i < quarters.length; i++) {
                if(quarters[i].includes(today.getMonth() + 1)) {
                    quarter = i;
                }
            }

            var from = dates[quarter].from;
            var to = dates[quarter].to;
        break;
        case 'this-year' :
            var today = new Date();
            var from = '01/01/'+today.getFullYear();
            var to = '12/31/'+today.getFullYear();
        break;
        case 'last-week' :
            var from = new Date();
            from.setDate(from.getDate() - from.getDay() - 7);
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();

            var to = new Date();
            to.setDate(to.getDate() - to.getDay() - 1);
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'last-month' :
            var today = new Date();
            var from = new Date();
            from.setMonth(today.getMonth() - 1);
            from.setDate(1);
            var to = new Date(from.getFullYear(), from.getMonth() + 1, 0);
            from = String(from.getMonth() + 1).padStart(2, '0') + '/' + String(from.getDate()).padStart(2, '0') + '/' + from.getFullYear();
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'last-quarter' :
            var today = new Date();
            var year = today.getFullYear();
            var lastYear = year - 1;
            var quarters = [
                [1,2,3],
                [4,5,6],
                [7,8,9],
                [10,11,12]
            ];

            var dates = [];
            dates[0] = {
                from: '10/01/'+lastYear,
                to: '12/31/'+lastYear
            };
            dates[1] = {
                from: '01/01/'+year,
                to: '03/31/'+year
            };
            dates[2] = {
                from: '04/01/'+year,
                to: '06/30/'+year
            };
            dates[3] = {
                from: '07/01/'+year,
                to: '09/30/'+year
            };

            var quarter = 0;
            for(var i = 0; i < quarters.length; i++) {
                if(quarters[i].includes(today.getMonth() + 1)) {
                    quarter = i;
                }
            }

            var from = dates[quarter].from;
            var to = dates[quarter].to;
        break;
        case 'last-year' :
            var today = new Date();
            var year = today.getFullYear() - 1;
            var from = '01/01/'+year;
            var to = '12/31/'+year;
        break;
        case 'last-365-days' :
            var to = new Date();
            var fromYear = to.getFullYear() - 1;
            var from = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + fromYear;
            to = String(to.getMonth() + 1).padStart(2, '0') + '/' + String(to.getDate()).padStart(2, '0') + '/' + to.getFullYear();
        break;
        case 'custom' :
            var today = new Date();
            var from = String(today.getMonth() + 1).padStart(2, '0') + '/' + String(today.getDate()).padStart(2, '0') + '/' + today.getFullYear();
            var to = String(today.getMonth() + 1).padStart(2, '0') + '/' + String(today.getDate()).padStart(2, '0') + '/' + today.getFullYear();
        break;
    }

    $('#from-date').val(from);
    $('#to-date').val(to);
});

const columns = [
    {
        orderable: false,
        data: null,
        name: 'id',
        fnCreatedCell: function(td, cellData, rowData, row, col) {
            $(td).html(`
            <div class="d-flex justify-content-center">
                <div class="checkbox checkbox-sec m-0">
                    <input type="checkbox" value="${rowData.id}" id="account-${rowData.id}">
                    <label for="account-${rowData.id}" class="p-0" style="width: 24px; height: 24px"></label>
                </div>
            </div>
            `);
        }
    },
    {
        data: 'date',
        name: 'date'
    },
    {
        data: 'from_to',
        name: 'from_to'
    },
    {
        data: 'category',
        name: 'category'
    },
    {
        data: 'memo',
        name: 'memo'
    },
    {
        data: 'type',
        name: 'type'
    },
    {
        data: 'amount',
        name: 'amount'
    },
    {
        data: 'tags',
        name: 'tags'
    }
];
$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,//
    lengthChange: false,
    pageLength: 150,
    info: false,
	order: [[1, 'asc']],
    ajax: {
		url: '/accounting/tags/load-transactions',
		dataType: 'json',
		contentType: 'application/json',
		type: 'POST',
		data: function(d) {
            d.type = $('#type').val();
            d.date = $('#date').val();
            d.from = $('#from-date').val();
            d.to = $('#to-date').val();
            d.contact = $('#by-contact').val();
            d.untagged = $('#untagged').prop('checked') ? 1 : 0;
            d.ungrouped = $('#ungrouped').select2('val');
            d.groups = [];

            var i = 0;
            $('#tags-filter-dropdown select:not(#ungrouped)').each(function() {
                d.groups[i] = $(this).select2('val');
                i++;
            });
			return JSON.stringify(d);
		},
		pagingType: 'full_numbers'
	},
	columns: columns
});