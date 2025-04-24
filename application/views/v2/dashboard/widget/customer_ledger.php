<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-tile-unpaid-invoice-row:hover {
        cursor: pointer;
    }


    .customer-ledger-container .overdue-invoices-items {
        margin: 0 20px;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .customer-ledger-container .overdue-invoices-items .nsm-widget-table {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 10px;
        background: #fff;
        height: unset;
    }

    .customer-ledger-container .overdue-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        border-radius: 25px;
        font-weight: bold;
        font-size: 16px;
        background: unset;
        padding: unset;
    }

    .content-title {
        font-size: 15px;
        font-weight: bold;
        line-height: 1.3;
        display: block;
    }

    #nsm-table-customer-ledgers .unpaid-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }


    #nsm-table-customer-ledgers .nsm-table-pagination .pagination li a.prev,
    #nsm-table-customer-ledgers .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #nsm-table-customer-ledgers .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #nsm-table-customer-ledgers .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #nsm-table-customer-ledgers .nsm-table-pagination .pagination li a.active {
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }

    #nsm-table-customer-ledgers tbody tr td {
        width: 200px;
    }


    @media screen and (max-width: 1366px) {
        #nsm-table-customer-ledgers {
            width: 500px;
        }

        .customer-ledger-container .overdue-invoices-items {
            margin: auto;
        }
    }

    @media screen and (max-width: 991px) {
        #nsm-table-customer-ledgers {
            width: 100%;
        }
    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Ledger</span>
        </div>
        <div class="nsm-card-controls">
            <!-- <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('customer') ?>">
                See More
            </a> -->
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/customer-ledgers-banner.svg" alt="">
            </div>
            <div class="customer-ledger-container">
                <div class="overdue-invoices-items">
                    <div class="nsm-widget-table table-responsive">
                        <div>
                            <select class="main-search-customer" id="main-search-customer"></select>
                        </div>
                        <table class="nsm-table" id="nsm-table-customer-ledgers">
                            <thead style="">
                                <tr>
                                    <td data-name="No." style="width:5%;">#</td>
                                    <td data-name="Date" style="width:12%;">Date</td>       
                                    <td data-name="Description">Description</td>                                
                                    <td data-name="Income" style="text-align:right;">Invoice</td>
                                    <td data-name="Payment" style="text-align:right;">Payment</td>                
                                    <td data-name="Description">Payment Method</td>                                
                                    <td data-name="Description">Record Date</td>                                
                                    <td data-name="Description">Entry By</td>                           
                                </tr>
                            </thead>
                            <tbody id="ajax-reload-ledger-container" class="ajax-reload-ledger-container">
                                <tr>
                                    <td colspan="8">
                                        <div class="nsm-empty">
                                            <span>Please select customer.</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>

<script>
    $(function() {
        // $("#nsm-table-customer-ledgers").nsmPagination({
        //     itemsPerPage: 10
        // });
        $('.widget-tile-upcoming-estimate-row').on('click', function() {
            var invoice_id = $(this).attr('data-id');
            location.href = base_url + 'invoice/genview/' + invoice_id;
        });

        $('#main-search-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Search Customer',            
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        }); 

        $('#main-search-customer').on('change', function(){
            var customer_id = $(this).val();
            $.ajax({
                url: base_url + 'dashboard/_customer_ledgers/' + customer_id,
                method: 'get',
                success: function(response) {
                    $('#ajax-reload-ledger-container').html(response);
                },
                beforeSend: function() {
                    $('#ajax-reload-ledger-container').html("<span class='bx bx-loader bx-spin'></span>");
                },
            });            
        });

        function formatRepoCustomerSelection(repo) {
            if( repo.first_name != null ){
                return repo.first_name + ' ' + repo.last_name;      
            }else{
                return repo.text;
            }
        }

        function formatRepoCustomer(repo) {
            if (repo.loading) {
                return repo.text;
            }
            var $container = $(
                '<div class="contact-acro">'+repo.acro+'</div><div class="contact-info"><i class="bx bx-user-pin"></i> '+repo.first_name + ' ' + repo.last_name+'<br><small><i class="bx bx-mobile"></i> '+repo.phone_m+' / <i class="bx bx-envelope"></i> '+repo.email+'</div>'
            );
            return $container;
        }        

    });
</script>
