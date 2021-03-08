<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .loader
    {
        display: none !important;
    }
    .hide-toggle::after {
        display: none !important;
    }
    .show>.btn-primary.dropdown-toggle {
        background-color: #32243D;
        border: 1px solid #32243D;
    }
    #product-categories-table .btn-group .btn:hover, #product-categories-table .btn-group .btn:focus {
        color: unset;
    }
    #product-categories-table .btn-group .btn {
        padding: 10px;
    }
    #addNewCategory form .form-group {
        margin-bottom: 0 !important;
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
                                    <h3 class="page-title" style="margin: 0 !important">Product Categories</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Product categories message</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/products-and-services" class="text-info"><i class="fa fa-chevron-left"></i> Products and Services</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <a href="javascript:void(0);" id="add-category" class="btn btn-success d-flex align-items-center justify-content-center float-right">
                                        New Category
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php if($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?></span>
                        </div>
                        <?php elseif($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible my-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <span><strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="action-bar h-100 d-flex align-items-center">
                                            <ul class="ml-auto">
                                                <li>
                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cog"></i>
                                                    </a>
                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                        <p class="m-0">Rows</p>
                                                        <p class="m-0">
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
                                <table id="product-categories-table" class="table table-striped table-bordered" style="width:100%">
									<thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="text-right" width="10%">ACTION</th>
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

    <!--    Modal for creating rules-->
    <div class="modal-right-side">
        <div class="modal right fade" id="addNewCategory" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel2" >Category information</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?=url('accounting/product-categories/create')?>" method="post" id="create-category-form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="sub-category" value="1">
                                <label for="sub-category">Is a sub-category</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--    end of modal-->
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>

<script>
$('#table_rows').on('change', function() {
    $('#product-categories-table').DataTable().ajax.reload();
});
$('.action-bar .dropdown-menu').on('click', function(e) {
    e.stopPropagation();
});
$('#product-categories-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    serverSide: true,
    lengthChange: false,
    pageLength: $('#table_rows').val(),
    info: false,
    ajax: {
        url: 'product-categories/load/',
        dataType: 'json',
        contentType: 'application/json', 
        type: 'POST',
        data: function(d) {
            d.length = $('#table_rows').val();
            return JSON.stringify(d);
        },
        pagingType: 'full_numbers',
    },
    columns: [
        {
            data: 'name',
            name: 'name'
        },
        {
            data: null,
            fnCreatedCell: function(td, cellData, rowData, row, col) {
                $(td).html(`
                <div class="btn-group float-right">
                    <a href="#" class="edit-category btn text-primary d-flex align-items-center justify-content-center">Edit</a>

                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item delete-category" href="#">Remove</a>
                    </div>
                </div>
                `);
            }
        }
    ]
});
$('#sub-category').on('change', function(){
    if($(this).prop('checked')) {
        if($(this).parent().parent().find('#parent_account').length === 0) {
            $(this).parent().parent().append(`
            <div class="form-group">
                <select class="form-control" name="parent_id" id="parent_account">
                    <option></option>
                </select>
            </div>
            `);

            $('#parent_account').select2({
                ajax: {
                    url: '/accounting/product-categories/get',
                    dataType: 'json'
                }
            });
        }
    } else {
        $(this).parent().next().remove();
    }
});
$('#add-category').on('click', function(e) {
    e.preventDefault();

    $('#addNewCategory form').attr('action', `<?=url('accounting/product-categories/create')?>`);
    $('#addNewCategory form').attr('id', 'create-category-form');
    $('#addNewCategory form [name="name"]').val('');
    $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');

    $('#addNewCategory').modal('show');
});
$(document).on('click', '.edit-category', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent();
    var rowData = $('#product-categories-table').DataTable().row(row).data();

    $.get(`product-categories/get/${rowData.id}`, function(result) {
        var category = JSON.parse(result);

        $('#addNewCategory form [name="name"]').val(category.name);

        if(category.hasOwnProperty('parent')) {
            $('#addNewCategory form #sub-category').prop('checked', true).trigger('change');

            $('#addNewCategory form #parent_account').append(`<option value="${category.parent.item_categories_id}" selected>${category.parent.name}</option>`)
        } else {
            $('#addNewCategory form #sub-category').prop('checked', false).trigger('change');
        }

        $('#addNewCategory form').attr('action', `<?=url('accounting/product-categories/update/')?>${category.item_categories_id}`);
        $('#addNewCategory form').attr('id', `update-category-form`);

        $('#addNewCategory').modal('show');
    });
});
$(document).on('click', '.delete-category', function(e) {
    e.preventDefault();
    var row = $(this).parent().parent().parent().parent();
    var rowData = $('#product-categories-table').DataTable().row(row).data();
    
    $.ajax({
        url: `/accounting/product-categories/delete/${rowData.id}`,
        type: 'DELETE',
        success: function(result) {
            location.reload();
        }
    });
});
</script>