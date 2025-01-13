<style>
    .widget-tile-upcoming-estimate-row:hover {
        cursor: pointer;
    }

    .open-estimates-container .open-estimates-items {
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

    .open-estimates-container .open-estimates-items .nsm-widget-table {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 10px;
        background: #fff;
        height: unset;
    }

    .open-estimates-container .open-estimates-items .nsm-widget-table .badge-section .nsm-badge {
        border-radius: 25px;
        font-weight: bold;
        font-size: 14px;
        color: #000;
    }

    .content-title {
        font-size: 15px;
        font-weight: bold;
        line-height: 1.3;
        display: block;
    }



    #nsm-table-open-estimates .unpaid-invoices-items .nsm-widget-table .badge-section .nsm-badge {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }


    #nsm-table-open-estimates .nsm-table-pagination .pagination li a.prev,
    #nsm-table-open-estimates .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #nsm-table-open-estimates .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #nsm-table-open-estimates .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #nsm-table-open-estimates .nsm-table-pagination .pagination li a.active {
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }

    #nsm-table-open-estimates .nsm-badge {
        background-color: unset;
        display: block;
        width: 100%;
        margin-top: 10px;
        text-wrap: auto;
    }

    #nsm-table-open-estimates tbody tr td {
        /* width: 200px; */
    }


    @media screen and (max-width: 1366px) {
        #nsm-table-open-estimates {
            width: 500px;
        }
    }

    @media screen and (max-width: 1200px) {
        .open-estimates-container .open-estimates-items {
            margin: unset;
        }
    }



    @media screen and (max-width: 991px) {
        #nsm-table-open-estimates {
            width: 100%;
        }
    }

    @media screen and (max-width: 567px) {
        .open-estimates-container .open-estimates-items {
            margin: unset;
        }

    }
</style>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;

function formatEstimateNumber($number)
{
    if (strpos(strtoupper($number), 'EST-') !== 0) {
        return $number;
    }

    $numericPart = (int) str_replace('EST-', '', $number);
    return 'EST-' . str_pad($numericPart, 7, '0', STR_PAD_LEFT);
}
?>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Open Estimates</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('estimate') ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/upcoming-estimates.svg" alt="">
            </div>
            <div class="open-estimates-container">
                <div class="open-estimates-items">
                    <div class="nsm-widget-table table-responsive">
                        <table class="nsm-table" id="nsm-table-open-estimates">
                            <thead style="display:none;">
                                <tr>
                                    <td data-name="EstimateNumber">Estimate Number</td>
                                    <td data-name="TotalDue"></td>
                                    <td data-name="Status"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($estimates)) { ?>
                                <?php foreach ($estimates as $estimate) { ?>
                                <?php
                                switch ($estimate->status):
                                    case 'Submitted':
                                        $statusBadgeColor = '#FEA303';
                                        break;
                                    case 'Draft':
                                        $statusBadgeColor = '#d9a1a0';
                                        break;
                                    case 'Accepted':
                                        $statusBadgeColor = '#EFB6C8';
                                        break;
                                    default:
                                        $statusBadgeColor = 'A888B5';
                                        break;
                                endswitch;
                                
                                $datetime1 = new DateTime(date('Y-m-d', strtotime($estimate->updated_at)));
                                $datetime2 = new DateTime(date('Y-m-d'));
                                $difference = $datetime1->diff($datetime2);
                                
                                $show_no_movement_notice = 0;
                                if ($difference->d >= 14 && ($estimate->status == 'Draft' || $estimate->status == 'Submitted' || $estimate->status == 'Accepted')) {
                                    $show_no_movement_notice = 1;
                                }
                                ?>
                                <tr>
                                    <td class="widget-tile-upcoming-estimate-row" data-id="<?= $estimate->id ?>">
                                        <span class="content-title"><?= $estimate->estimate_number ?></span>
                                        <span class="content-subtitle d-block" style="font-weight: bold; margin-top: 5px;"><i class='bx bxs-user-circle'
                                                style="font-size: 14px;position: relative;top: 2px; color: #FEA303;"></i>
                                            <?php if ($estimate->customer !== '' && $estimate->customer !== null) {
                                                echo $estimate->customer;
                                            } else {
                                                echo '—';
                                            } ?></span>
                                        <?php if( $show_no_movement_notice == 1 ){  ?>
                                        <a style="text-decoration:none;" style="margin-top:7px;"
                                            href="<?= base_url('estimate/edit/' . $estimate->id) ?>"><span
                                                class="nsm-badge">Last update was
                                                <b><?= $difference->d . ' days ago' ?></b> - Needs update</span></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span class="content-subtitle fw-bold"
                                            style="font-size:12px;color:#000">$<?= $estimate->grand_total == null || $estimate->grand_total == 0 ? '0.00' : number_format($estimate->grand_total, 2) ?></span>
                                        <span class="content-subtitle d-block">Total Due</span>
                                    </td>
                                    <td style="width:25%;text-align:right;" class="badge-section">
                                        <span class="nsm-badge "><?= ucwords($estimate->status) ?></span>
                                        <span
                                            class="content-subtitle d-block mt-2"><?= date('F d, Y', strtotime($estimate->updated_at)) ?></span>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php }else { ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
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
        $("#nsm-table-open-estimates").nsmPagination({
            itemsPerPage: 5
        });
        $('.widget-tile-upcoming-estimate-row').on('click', function() {
            var estimate_id = $(this).attr('data-id');
            location.href = base_url + 'estimate/view/' + estimate_id;
        });
    });
</script>
