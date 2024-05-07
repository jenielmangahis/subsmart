<style>
.badge-danger {
    color: #fff;
    background-color: #dc3545;
}
.badge-primary {
    color: #fff;
    background-color: #007bff;
}
.badge-secondary {
    color: #fff;
    background-color: #6c757d;
}
.badge{
    width: 100%;
    display: block;
}
#nsm-table-open-estimates .badge{
    display: block;
    width: 100%;
}
.badge-error{
    color: #fff;
    background-color: #dc3545;
    padding: 5px;
    border-radius: 0px;
    margin-top: 5px;
    display: block;
}
</style>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;

function formatEstimateNumber($number) {
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
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url("estimate") ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="nsm-widget-table">
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
                                        $class = "badge-primary";
                                        break;
                                    case 'Draft':
                                        $class = "badge-secondary";
                                        break;
                                    case 'Accepted':
                                        $class = "badge-info";
                                        break;
                                    default:
                                        $class = "badge-primary";
                                        break;
                                endswitch;    

                                $datetime1 = new DateTime(date("Y-m-d",strtotime($estimate->updated_at)));
                                $datetime2 = new DateTime(date("Y-m-d"));
                                $difference = $datetime1->diff($datetime2);

                                $show_no_movement_notice = 0;
                                if( $difference->d >= 14 && ($estimate->status == 'Draft' || $estimate->status == 'Submitted' || $estimate->status == 'Accepted') ){
                                    $show_no_movement_notice = 1;
                                }
                            ?>
                            <tr>                    
                                <td>
                                    <span class="content-title"><?= $estimate->estimate_number; ?></span>
                                    <span class="content-subtitle d-block"><i class='bx bxs-user-circle' style="font-size: 14px;position: relative;top: 2px;"></i> <?= $estimate->first_name . ' ' . $estimate->last_name; ?></span>
                                    <?php if( $show_no_movement_notice == 1 ){  ?>
                                        <a style="text-decoration:none;" style="margin-top:7px;" href="<?= base_url('estimate/edit/'.$estimate->id) ?>"><span class="nsm-badge badge-error">Last update was <b><?= $difference->d . ' days ago' ?></b> - Needs update</span></a>
                                    <?php } ?>
                                </td>                                    
                                <td>
                                    <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$<?= $estimate->grand_total == NULL || $estimate->grand_total == 0 ? '0.00' : number_format($estimate->grand_total,2); ?></span>
                                    <span class="content-subtitle d-block">Total Due</span>
                                </td>
                                <td style="width:25%;text-align:right;">
                                    <span class="nsm-badge <?= $class ?>"><?= ucwords($estimate->status); ?></span>
                                    <span class="content-subtitle d-block mt-2"><?= date('F d, Y', strtotime($estimate->updated_at)); ?></span>
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
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>
<script>
$(function(){
    $("#nsm-table-open-estimates").nsmPagination({itemsPerPage:5});   
});
</script>