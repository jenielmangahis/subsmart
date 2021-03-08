<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    #payment_methods .btn-group .btn:hover, #payment_methods .btn-group .btn:focus {
        color: unset;
    }
    #payment_methods .btn-group .btn {
        padding: 10px;
    }
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Payment Methods</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">The many methods of payment are Ach, Cash, Check, Credit, and payment-in-kind (or bartering). These methods are used in basic transactions; for example, one may pay for a product or services with cash, a credit card, or theoretically even by trading another person for other trade services for the equivalent value.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center pb-3">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/lists" class="text-info"><i class="fa fa-chevron-left"></i> All Lists</a></h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown show">
                                            <a href="#" class="btn btn-secondary mr-2" style="padding: 10px 12px !important">
                                                Run Report
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#payment_method_modal" class="btn btn-success" style="padding: 10px 20px !important">
                                                New
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <input type="text" name="search" id="search" class="form-control w-50" placeholder="Filter by name">
                                </div>
                                <div class="col-md-6">
                                    <div class="action-bar h-100 d-flex align-items-center">
                                        <ul class="ml-auto">
                                            <li><a href="#" onclick = "window.print()"><i class="fa fa-print"></i></a></li>
                                            <li>
                                                <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </a>
                                                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                    <p class="p-padding m-0">Columns</p>
                                                    <p class="p-padding"><input type="checkbox" id="col_credit" checked="checked" onchange="col(this)"> Credit Card</p>
                                                    <p class="p-padding m-0">Other</p>
                                                    <p class="p-padding m-0"><input type="checkbox" id="inc_inactive" value="1"> Include Inactive</p>
                                                    <p class="p-padding m-0">Rows</p>
                                                    <p class="p-padding m-0">
                                                        <select name="table_rows" id="table_rows" class="form-control">
                                                            <option value="50">50</option>
                                                            <option value="75">75</option>
                                                            <option value="100">100</option>
                                                            <option value="150" selected>150</option>
                                                            <option value="300">300</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            		    <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <table id="payment_methods" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th width="70%">NAME</th>
                                            <th class="credit-card">CREDIT CARD</th>
                                            <th class="text-right">ACTION</th>
                                        </tr>
									</thead>
									<tbody></tbody>
								</table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <div class="modal fade" id="payment_method_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Payment Method</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <form id="payment-method-form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="credit_card" name="credit_card" value="1">
                                                <label class="form-check-label" for="credit_card">This is a credit card.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success btn-rounded border float-right">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inactive_payment_method" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to make <span class="method-name"></span> inactive?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="active_payment_method" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered m-auto w-50" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="max-height: 650px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Are you sure you want to make <span class="method-name"></span> active?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">No</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success btn-rounded border float-right">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer_accounting'); ?>

<script>
function col(el)
{
    if($(el).prop('checked'))
    {
        $('.credit-card').removeClass('hide');
    }
    else
    {
        $('.credit-card').addClass('hide');
    }
}

$('#payment_methods').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
    ajax: {
        url: 'payment-methods/load-payment-methods/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.inactive = $('#inc_inactive').prop('checked') === true ? 1 : 0;
            d.length = $('#table_rows').val();
            d.columns[0].search.value = $('input#search').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: 'name',
            name: 'name',
            fnCreatedCell: function (td, cellData, rowData, row, col) {
                if(rowData.status === 0 || rowData.status === '0') {
                    $(td).html(cellData + ' (deleted)');
                } else {
                    $(td).html(cellData);
                }
            }
        },
        {
            data: 'credit_card',
            name: 'credit_card',
            orderable: false,
            searchable: false,
            fnCreatedCell: function (td, cellData, rowData, row, col) {
                $(td).addClass('credit-card');

                if(cellData === '1' || cellData === 1) {
                    $(td).html(`
                    <div class="form-group d-flex" style="margin-bottom: 0 !important">
                        <input class="m-auto" type="checkbox" checked disabled>
                    </div>
                    `);
                }
            }
        },
        {
            data: null,
            name: 'actions',
            orderable: false,
            searchable: false,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                if(rowData.status === '1' || rowData.status === 1) {
                    $(td).html(`
                    <div class="btn-group float-right">
                        <a href="#" class="btn text-primary d-flex align-items-center justify-content-center">Run Report</a>

                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-method" href="#" data-name="${rowData.name}" data-credit_card="${rowData.credit_card}" data-id="${rowData.id}">Edit</a>
                            <a class="dropdown-item make-inactive" href="#" data-id="${rowData.id}" data-name="${rowData.name}">Make inactive</a>
                        </div>
                    </div>
                    `);
                } else {
                    $(td).html(`
                    <div class="btn-group float-right">
                        <a href="#" data-id="${rowData.id}" data-name="${rowData.name}" class="make-active btn text-primary d-flex align-items-center justify-content-center">Make active</a>

                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item edit-method" href="#"">Run report</a>
                        </div>
                    </div>
                    `);
                }
            }
        }
    ],
    language: {
        emptyTable: "There are no payment methods that match the criteria."
    }
});

$('.dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});

$('#payment-method-form').on('submit', function(e) {
    e.preventDefault();

    var data = new FormData(document.getElementById('payment-method-form'));
    var url = '/accounting/payment-methods/add';

    if(data.has('id')) {
        url = '/accounting/payment-methods/update'
    }

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);

            $.toast({
                icon: res.success ? 'success' : 'error',
                heading: res.success ? 'Success' : 'Error',
                text: res.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });

            $('#payment_method_modal').modal('hide');

            $('#name').val('');
            $('#credit_card').prop('checked', false);
            $('#payment_methods').DataTable().ajax.reload();
        }
    });
});

$('#search').on('keyup', function() {
    $('#payment_methods').DataTable().ajax.reload();
});

$('#table_rows, #inc_inactive').on('change', function() {
    $('#payment_methods').DataTable().ajax.reload();
});

$(document).on('click', '#payment_methods .edit-method', function(e) {
    e.preventDefault();

    var data = e.currentTarget.dataset;

    $('#payment-method-form').prepend(`<input type="hidden" value="${data.id}" name="id">`);

    if(data.name !== null && data.name !== "null") {
        $('#payment-method-form #name').val(data.name);
    }

    if(data.credit_card === '1' || data.credit_card === 1) {
        $('#payment-method-form #credit_card').prop('checked', true);
    } else {
        $('#payment-method-form #credit_card').prop('checked', false);
    }

    $('#payment_method_modal h4.modal-title').html('Edit Payment Method');
    $('#payment_method_modal').modal('show');
});

$('a[data-target="#payment_method_modal"]').on('click', function() {
    $('#payment_method_modal form').attr('id', 'payment-method-form');
    if($('#payment_method_modal form input[name="id"]').length > 0) {
        $('#payment_method_modal form input[name="id"]').remove();
    }
    $('#payment-method-form #name').val('');
    $('#payment-method-form #credit_card').prop('checked', false);
    $('#payment_method_modal h4.modal-title').html('New Payment Method');
});

$(document).on('click', '#payment_methods .make-inactive', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

    $('#inactive_payment_method .modal-footer .btn-success').attr('data-id', id);
    $('#inactive_payment_method span.method-name').html(name);

    $('#inactive_payment_method').modal('show');
});

$(document).on('click', '#inactive_payment_method .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/payment-methods/delete/${id}`,
        type:"DELETE",
        success:function (result) {
            var res = JSON.parse(result);

            $.toast({
                icon: res.success ? 'success' : 'error',
                heading: res.success ? 'Success' : 'Error',
                text: res.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });

            $('#inactive_payment_method').modal('hide');

            $('#payment_methods').DataTable().ajax.reload();
        }
    });
});

$(document).on('click', '#payment_methods .make-active', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;
    var name = e.currentTarget.dataset.name;

    $('#active_payment_method .modal-footer .btn-success').attr('data-id', id);
    $('#active_payment_method span.method-name').html(name);

    $('#active_payment_method').modal('show');
});

$(document).on('click', '#active_payment_method .modal-footer .btn-success', function(e) {
    e.preventDefault();

    var id = e.currentTarget.dataset.id;

    $.ajax({
        url: `/accounting/payment-methods/activate/${id}`,
        type:"GET",
        success:function (result) {
            var res = JSON.parse(result);

            $.toast({
                icon: res.success ? 'success' : 'error',
                heading: res.success ? 'Success' : 'Error',
                text: res.message,
                showHideTransition: 'fade',
                hideAfter: 3000,
                allowToastClose: true,
                position: 'top-center',
                stack: false,
                loader: false,
            });

            $('#active_payment_method').modal('hide');

            $('#payment_methods').DataTable().ajax.reload();
        }
    });
});
</script>