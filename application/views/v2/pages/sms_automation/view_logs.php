<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo url('sms_campaigns/add_sms_blast') ?>'">
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
                            SMS Logs
                            <small style="display:block;">Automation : <?= $smsAutomation->automation_name; ?></small>
                        </div>
                    </div>
                </div>  
                <div class="row">
                    <div class="col-12 grid-mb text-end">                        
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" name="btn_create_sms_blast" class="nsm-button primary" onclick="location.href='<?php echo url('sms_campaigns'); ?>'">
                            <i class='bx bx-fw bx-chat'></i> Back to List
                        </button>
                        </div>
                    </div>
                </div> 
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="Date">Date</td>
                            <td data-name="From">From</td>
                            <td data-name="To">To</td>
                            <td data-name="Sent on">Sent on</td>
                            <td data-name="Paid">Note</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($smsLogs as $sl){ ?>
                            <tr>
                              <td><?= date("d-M-Y H:i", strtotime($sl->date_created)); ?></td>
                              <td><?= $sl->from_number; ?></td>
                              <td><?= $sl->to_number; ?></td>
                              <td>
                                <?php 
                                  if( $sl->is_sent == 1 ){
                                    echo '<span class="badge badge-primary">Yes</span>';
                                  }else{
                                    echo '<span class="badge badge-danger">No</span>';
                                  }
                                ?>
                              </td>
                              <td><?= $sl->error_message; ?></td>                                              
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>