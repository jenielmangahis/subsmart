<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter.h-100.yellow {
        background-color: #fef5e0;
    }

    i.bx.bx-box.subs {
        background-color: #ffeab9;
        color: #cda030;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Income</span>
        </div>
        <div class="nsm-card-controls">
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
        <div class="row">
            <div class="col-12 mb-2">
                <div class="nsm-counter h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-receipt"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Open Invoices</span>
                            <h2><?php $total = 0; $overdue =0;
                                foreach ($upcomingInvoice as $UI) {
                                    if ($UI->status == "Due" || $UI->status == 'Approved' || $UI->status == 'Partially Paid') {
                                        $total++;
                                    }else if($UI->status == "Overdue"){
                                        $overdue++;
                                    }
                                }
                                echo $total; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="nsm-counter h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-calendar-exclamation"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Overdue Invoices</span>
                            <h2><?php echo $overdue; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="nsm-counter success h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-badge-check"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Paid last 30 days</span>
                            <h2><?php $totalPaid = 0;
                                    foreach($upcomingInvoice as $UI){
                                        if(date("Y-m-d")>=date("Y-m-d",strtotime($UI->date_updated)) && date("Y-m-d",strtotime("-30 days"))<=date("Y-m-d",strtotime($UI->date_updated)) && $UI->status == "Paid"){
                                            $totalPaid++;
                                        }
                                    }
                                    echo $totalPaid;
                            ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter yellow h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-box subs"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Subscription</span>
                            <h2><!-- <?php echo "$".number_format($subs->TOTAL_MMR, 2); ?> -->$0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>