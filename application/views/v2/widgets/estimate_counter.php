<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    echo '<div class="col-12 col-lg-4">';
}
?>


<div class="<?php echo $class; ?>" data-id="<?php echo $id; ?>" id="widget_<?php echo $id; ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-estimate">
                        <i class="bx bx-fw bx-notepad"></i>
                    </div>
                    <span style="color:#6a4a86  ">Estimate</span>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?php echo $id; ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row ">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-start summary-report-body">
                <?php
            $draft = 0;
            $accepted = 0;
            $invoiced = 0;
            $other = 0;

            foreach ($estimate_draft as $estimate):
                switch ($estimate->status){
                    case 'Draft';
                        $draft++;
                        break;
                    case 'Accepted';
                        $accepted++;
                        break;
                    case 'Invoiced';
                        $invoiced++;
                        break;
                    default;
                        $other++;
                        break;
                }
            endforeach;

            $draft_percent = number_format((float)$draft/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $accepted_percent = number_format((float)$accepted/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $invoiced_percent = number_format((float)$invoiced/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
            $other_percent = number_format((float)$other/ (count($estimate_draft) ?: 1) ,2,'.','') * 100;
        ?>
                    <label for="">Total Estimate</label>
                    <h1><?php echo count($estimate_draft); ?></h1>

                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class="nsm-button btn-sm m-0 me-2" href="customer/leads">
            <i class='bx bx-right-arrow-alt'></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) {
    echo '</div>';
}
?>