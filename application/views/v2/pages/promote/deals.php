<?php include viewPath('v2/includes/header'); ?>
<style>
#tbl-deals-steals .nsm-badge{
    display:block;
    font-size:14px;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('promote/create_deals') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/marketing_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <!-- <button><i class='bx bx-x'></i></button> -->
                            Your items and services offered at very low prices, implying the buyer is getting a great bargain.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-badge-check'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= $activeSummaryDeals->total_records; ?></h2>
                                    <span>Total Active Deals</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-dollar-circle'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id=""><?= number_format($activeSummaryDeals->sum_total_deal_price,2,".",","); ?></h2>
                                    <span>Total Amount Active Deals</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-md-6 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search" value="">
                        </div>
                    </div> 
                    <div class="col-6 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-with-selected" id="with-selected-delete" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter : <?= $filter; ?></span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a name="btn_filter" class="dropdown-item" data-id="all" href="javascript:void(0);">All Deals</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="active" href="javascript:void(0);">Active Deals</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="ended" href="javascript:void(0);">Ended Deals</a></li>
                                <li><a name="btn_filter" class="dropdown-item" data-id="draft" href="javascript:void(0);">Draft Deals</a></li>
                            </ul>
                        </div>
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_create" class="nsm-button primary" onclick="location.href='<?php echo url('promote/create_deals') ?>'">
                                <i class='bx bx-plus'></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                <form id="frm-with-selected">
                    <table class="nsm-table" id="tbl-deals-steals">
                        <thead>
                            <tr>
                                <td class="table-icon text-center sorting_disabled">
                                    <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                                </td>
                                <td class="table-icon"></td>
                                <td data-name="Deal" style="width:50%;">Deal</td>                            
                                <td data-name="Valid" style="width:20%;">Validity</td>
                                <td data-name="Expiration" style="width:10%;">Expiration</td>
                                <td data-name="Views">Views</td>
                                <td data-name="Status">Status</td>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody id="deals_container">
                            <?php if (!empty($dealsSteals)) : ?>
                                <?php
                                foreach ($dealsSteals as $ds) :
                                    switch ($ds->status):
                                        case 1:
                                            $badge = "success";
                                            break;
                                        case 3:
                                            $badge = "primary";
                                            break;
                                        case 2:
                                            $badge = "secondary";
                                            break;                                        
                                        default:
                                            $badge = "";
                                            break;
                                    endswitch;

                                    if( $ds->is_expired == 'Yes' ){
                                        $badge = 'error';
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <input class="form-check-input row-select table-select" name="deals[]" type="checkbox" value="<?= $ds->id; ?>">
                                        </td>
                                        <td>
                                            <div class="table-row-icon img" style="background-image: url('<?= base_url("uploads/deals_steals/" . $ds->company_id . "/" . $ds->photos); ?>')"></div>
                                        </td>
                                        <td class="fw-bold show nsm-text-primary">
                                            <label class="d-block"><?= $ds->title; ?></label>
                                            <label class="text-muted">$<?= number_format($ds->deal_price, 2); ?><label>
                                        </td>            
                                        <td><?= date("m/d/Y",strtotime($ds->valid_from)) . ' to ' . date("m/d/Y",strtotime($ds->valid_to)); ?></td>
                                        <td><?= $ds->status != 0 ? date("m/d/Y", strtotime($ds->date_expiration)) : '---'; ?></td>
                                        <td><?= $ds->views_count > 0 ? $ds->views_count : 0; ?></td>
                                        <td><span class="nsm-badge <?= $badge ?>">
                                            <?php 
                                                if( $ds->is_expired == 'Yes' ){
                                                    echo 'Expired';
                                                }else{
                                                    echo $statusOptions[$ds->status];
                                                }
                                            ?>                                            
                                        </td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item row-btn-view" name="dropdown_list" data-id="<?= $ds->id; ?>" href="javascript:void(0);">View</a>
                                                    </li>       
                                                    <?php if( $ds->status == $status_draft ){ ?>
                                                        <li>
                                                            <a class="dropdown-item" name="dropdown_edit" href="<?php echo base_url('promote/edit_deals/' . $ds->id) ?>">Edit</a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if( $ds->status == $status_active ){ ?>                                                        
                                                        <li>
                                                            <a class="dropdown-item close-item" name="dropdown_close_deal" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>">Close Deal</a>
                                                        </li>
                                                    <?php } ?>
                                                    <li>
                                                        <a class="dropdown-item" name="dropdown_bookings" href="<?= base_url('promote/bookings/'. $ds->id); ?>">Bookings</a>
                                                    </li>    
                                                    <li>
                                                        <a class="dropdown-item delete-item" name="dropdown_delete" href="javascript:void(0);" data-name="<?= $ds->title; ?>" data-id="<?= $ds->id; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="modal fade nsm-modal fade" id="modalViewDeals" aria-labelledby="modalViewDealsLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title" id="new_feed_modal_label">View Deals</span>
                            <button name="btn_close_modal" type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <div class="modal-body">
                            <div id="view-deals-container"></div>
                        </div>             
                    </div>
                </div>
            </div>

            <div class="modal fade nsm-modal fade" id="modal-reactivate-deals" tabindex="-1" aria-labelledby="modal-reactivate-deals_label" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">        
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title content-title">Reactivate Deal</span>
                            <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                        </div>
                        <form id="frm-reactivate-deal" method="post">
                        <input type="hidden" name="deal_id" id="deals-steals-id" value="" />
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <label>Card Number</label>
                                    <input type="text" class="form-control" name="card_number" id="" value="" required/>
                                </div>
                                <div class="col-6 mt-4">
                                    <label>Expiration</label>
                                    <br />
                                    <select class="nsm-field form-select" name="exp_month" style="width:33%;display:inline-block;">
                                        <option value="" selected="selected" disabled>MM</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select class="nsm-field form-select" name="exp_year" style="width:37%;display:inline-block;">
                                        <option value="" selected="selected" disabled>YY</option>
                                        <?php for( $x = date("Y"); $x<=date("Y", strtotime("+20 years")); $x++ ){ ?>
                                            <option value="<?= $x; ?>"><?= $x; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="password" maxlength="4" class="form-control" name="cvc" id="cvc" value="" style="width:26%;display:inline-block;" placeholder="CVC" required/>
                                </div>
                                <div class="col-6 mt-2">
                                    <label>Total Amount</label>
                                    <div class="col-auto">
                                        <label class="visually-hidden" for="license-total-amount">Total Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-text">$</div>
                                            <input type="number" class="form-control" name="total_license"  id="license-total-amount" value="<?= number_format($dealStealPrice,2,".",","); ?>" disabled="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="nsm-button primary" id="btn-reactivate-deal">Pay</button>
                        </div>
                        </form>
                    </div>        
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        let activeTab = '<?= $status_active; ?>';

        $(".nsm-table").nsmPagination();
        $("#search_field").on("input", debounce(function() {
            let search = $(this).val();
            if( search == '' ){
                $(".nsm-table").nsmPagination();
            }else{
                tableSearch($(this));        
            }
            
        }, 1000));

        $(document).on('change', '#select-all', function(){
            $('.row-select:checkbox').prop('checked', this.checked);  
            let total= $('input[name="deals[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(document).on('change', '.row-select', function(){
            let total= $('input[name="deals[]"]:checked').length;
            if( total > 0 ){
                $('#num-checked').text(`(${total})`);
            }else{
                $('#num-checked').text('');
            }
        });

        $(".select-filter .dropdown-item").on("click", function() {
            let filter = $(this).attr('data-id');
            if( filter == 'all' ){
                location.href = base_url + 'promote/deals';
            }else{
                location.href = base_url + 'promote/deals?filter=' + filter;
            }
        });

        $(document).on('click', '.row-btn-reactivate', function(){
            let deal_id = $(this).attr('data-id');
            $('#deals-steals-id').val(deal_id);
            $('#modal-reactivate-deals').modal('show');
        });

        $(document).on('click', '.row-btn-view', function(){
            let deal_id = $(this).attr('data-id');

            $('#modalViewDeals').modal('show');

            $.ajax({
                type: 'POST',
                url: base_url + 'promote/deals/_view',
                data: {deal_id: deal_id},
                success: function(html) {
                    $('#view-deals-container').html(html);
                },
                beforeSend: function(){
                    $('#view-deals-container').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });

        $(document).on("click", ".close-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>promote/_close_deal";

            Swal.fire({
                title: 'Close Deal',
                html: `Are you sure you want close deals <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            deal_id: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            console.log(result);
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Close Deal',
                                    text: result.msg,
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        //loadDeals(activeTab);
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", ".delete-item", function() {
            let name = $(this).attr("data-name");
            let id = $(this).attr("data-id");
            let url = "<?php echo base_url(); ?>promote/_delete_deal";

            Swal.fire({
                title: 'Delete Deal',
                html: `Are you sure you want delete deals <b>${name}</b>?`,
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            deal_id: id
                        },
                        dataType: "JSON",
                        success: function(result) {
                            if (result.is_success == 1) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Data Deleted Successfully!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    //if (result.value) {
                                        location.reload();
                                    //}
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.msg,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#frm-reactivate-deal").submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url + 'promote/deals/_reactivate_deal',
                dataType: "json",
                data: $("#frm-reactivate-deal").serialize(),
                success: function(o)
                {
                    $("#modal-reactivate-deals").modal('hide'); 
                    if( o.is_success == 1 ){
                        Swal.fire({
                            title: 'Payment Successful!',
                            text: "Deal was successfully activated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#32243d',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            //if (result.value) {
                                location.reload();
                            //}
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Cannot process payment',
                            text: o.msg
                        });
                    }

                    $('#btn-reactivate-deal').prop("disabled", false);
                    $("#btn-reactivate-deal").html('Pay');
                },
                beforeSend: function(){
                    $("#btn-reactivate-deal").html('<span class="bx bx-loader bx-spin"></span>');
                    $("#btn-reactivate-deal").prop("disabled", true);
                }
            });
        });

        $(document).on('click', '#with-selected-delete', function(){
            let total= $('input[name="deals[]"]:checked').length;
            if( total <= 0 ){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please select rows',
                });
            }else{
                Swal.fire({
                    title: 'Delete Deals',
                    html: `Are you sure you want to delete selected rows?`,
                    icon: 'question',
                    confirmButtonText: 'Proceed',
                    showCancelButton: true,
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: 'POST',
                            url: base_url + 'promote/deals/_delete_selected',
                            dataType: 'json',
                            data: $('#frm-with-selected').serialize(),
                            success: function(result) {                        
                                if( result.is_success == 1 ) {
                                    Swal.fire({
                                        title: 'Delete Deals',
                                        text: "Data deleted successfully!",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        //if (result.value) {
                                            location.reload();
                                        //}
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: result.msg,
                                    });
                                }
                            },
                        });

                    }
                });
            }        
        });
    });   

    function loadDeals(status = '<?= $status_active; ?>') {
        let _container = $("#deals_container");
        let loader = '<tr><td colspan="7"><div class="nsm-loader"><i class="bx bx-loader-alt bx-spin"></i></div></td></tr>';
        let url = base_url + "promote/_load_deals_list/" + status;
        _container.html(loader);

        $.ajax({
            type: 'POST',
            url: url,
            success: function(result) {
                _container.html(result);
                $(".nsm-table").nsmPagination();
            },
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>