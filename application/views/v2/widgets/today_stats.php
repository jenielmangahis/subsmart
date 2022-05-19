<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter h3 {
        margin: unset;
        font-weight: bold;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Today's Stats</span>
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
        <div class="row h-100 g-2">
            <div class="col-12 col-md-6">
                <div class="nsm-counter success h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h3>$<?php $totalPayments = 0;
                                    foreach ($payment as $p) {
                                        if(date("Y-m-d")==date("Y-m-d",strtotime($p->created_at))){
                                            $totalPayments += $p->amount;
                                        }
                                    }
                                    foreach ($paymentInvoices as $PI) {
                                        if(date("Y-m-d")==date("Y-m-d",strtotime($PI->created_at))){
                                            $totalPayments += $PI->payment_amount;
                                        }
                                    }
                                    echo $totalPayments;
                                    ?></h3>
                            <span>Earned</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-box'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h3>$<?php $totalPayments = 0;
                                    foreach ($payment as $p) {
                                        if(date("Y-m-d")==date("Y-m-d",strtotime($p->created_at))){
                                            $totalPayments += $p->amount;
                                        }
                                        
                                    }
                                    foreach ($paymentInvoices as $PI) {
                                        if(date("Y-m-d")==date("Y-m-d",strtotime($PI->created_at))){
                                            $totalPayments += $PI->payment_amount;
                                        }
                                        
                                    }
                                    echo $totalPayments;
                                    ?></h3>
                            <span>Collected</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter success h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-list-check'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2><?php $totalJobsComplete = 0;
                                foreach ($jobsDone as $JD) {
                                    if ($JD->status == "Completed") {
                                        if(date("Y-m-d") == date("Y-m-d",strtotime($JD->date_issued))) {
                                            $totalJobsComplete++;
                                        }
                                        
                                    }
                                }
                                echo $totalJobsComplete;
                                ?></h2>
                            <span>Jobs Completed</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-bookmarks'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2><?php $totalJobsAdded = 0;
                                foreach ($jobsDone as $JD) {
                                    if ($JD->status == "New" || $JD->status == "Scheduled") {
                                        if(date("Y-m-d") == date("Y-m-d",strtotime($JD->date_issued))) {
                                            $totalJobsAdded++;
                                        }
                                    }
                                }
                                echo $totalJobsAdded;
                                ?></h2>
                            <span>New Jobs Booked Online</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter error h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-task-x'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2>0
                            </h2>
                            <span>Lost Accounts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-box'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2>
                                <?php
                                $totalInvoices = 0;
                                foreach ($upcomingInvoice as $UI) {
                                    if ($UI->status == "Due"){
                                        if(date("Y-m-d") == date("Y-m-d", strtotime($UI->due_date))){
                                            $totalInvoices++;
                                        }
                                        
                                    }
                                }
                                echo $totalInvoices;
                                ?>
                            </h2>
                            <span>Collections</span>
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