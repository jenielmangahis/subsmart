$('select').select2();

$('.datepicker').each(function() {
    $(this).datepicker({
        uiLibrary: 'bootstrap',
        todayBtn: "linked",
        language: "de"
    });
});

$('.dropdown-menu[aria-labelledby="filterDropdown"]').on('click', function(e) {
    e.stopPropagation();
});

$('#transactions-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: false,
    lengthChange: false,
    info: false,
    pageLength: $('#table_rows').val(),
    order: [[1, 'asc']]
});
// var table = $('#transactions-table').DataTable({
//     autoWidth: false,
//     searching: false,
//     processing: true,
//     serverSide: true,
//     lengthChange: false,
//     info: false,
//     pageLength: $('#table_rows').val(),
//     order: [[1, 'asc']],
//     ajax: {
//         url: 'expenses/load-transactions/',
//         dataType: 'json',
//         contentType: 'application/json',
//         type: 'POST',
//         data: function(d) {
//             d.length = $('#table_rows').val();
//             d.type = $('select#type').val();
//             d.status = $('select#status').val();
//             d.delivery_method = $('select#del-method').val();
//             d.date = $('select#date').val();
//             d.from_date = $('input#from-date').val();
//             d.to_date = $('input#to-date').val();
//             d.payee = $('select#payee').val();
//             d.category = $('select#category').val();
//             return JSON.stringify(d);
//         },
//         pagingType: 'full_numbers'
//     },
//     columns: [
//         {
//             orderable: false,
// 			data: null,
// 			name: 'checkbox',
// 			fnCreatedCell: function(td, cellData, rowData, row, col) {
//                 $(td).html(`<input type="checkbox" value="${rowData.id}">`);
// 			}
// 		},
//         {
//             data: 'date',
//             name: 'date'
//         },
//         {
//             data: 'type',
//             name: 'type'
//         },
//         {
//             data: 'number',
//             name: 'number'
//         },
//         {
//             data: 'payee',
//             name: 'payee'
//         },
//         {
//             data: 'method',
//             name: 'method'
//         },
//         {
//             data: 'source',
//             name: 'source'
//         },
//         {
//             data: 'category',
//             name: 'category'
//         },
//         {
//             data: 'memo',
//             name: 'memo'
//         },
//         {
//             data: 'memo',
//             name: 'memo'
//         },
//         {
//             data: 'due_date',
//             name: 'due_date'
//         },
//         {
//             data: 'balance',
//             name: 'balance'
//         },
//         {
//             data: 'total',
//             name: 'total'
//         },
//         {
//             data: 'status',
//             name: 'status'
//         },
//         {
//             data: 'attachments',
//             name: 'attachments'
//         },
//         {
//             orderable: false,
// 			data: null,
// 			name: 'action',
// 			fnCreatedCell: function(td, cellData, rowData,row, col) {

//             }
//         }
//     ]
// });