<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('v2/includes/header'); ?>
<style>
.fc-day-number{
    cursor:pointer;
}
@-moz-keyframes three-quarters-loader {
  0% {
    -moz-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes three-quarters-loader {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes three-quarters-loader {
  0% {
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
/* :not(:required) hides this rule from IE9 and below */
.three-quarters-loader:not(:required) {
  -moz-animation: three-quarters-loader 1250ms infinite linear;
  -webkit-animation: three-quarters-loader 1250ms infinite linear;
  animation: three-quarters-loader 1250ms infinite linear;
  border: 8px solid #38e;
  border-right-color: transparent;
  border-radius: 16px;
  box-sizing: border-box;
  display: inline-block;
  position: relative;
  overflow: hidden;
  text-indent: -9999px;
  width: 32px;
  height: 32px;
}
</style>
<!-- Headline Section -->
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('demo\tabs\index'); ?>
    </div>

    <table class="nsm-table">
        <thead>
            <tr>
                <td class="table-icon"></td>
                <td>Demo Name</td>
                <td>Email</td>
                <td>Guest Emails</td>
                <td>Phone Number</td>
                <td>Key Features</td>
                <td>Demo Time</td>
                <td>Demo Date</td>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($demoList)) :
            ?>
                <?php
                foreach ($demoList as $demo) :
                ?>
                    <tr>
                        <td>
                            <div class="table-row-icon">
                                <i class='bx bx-receipt'></i>
                            </div>
                        </td>
                        <td class="fw-bold nsm-text-primary nsm-link default"><?= $demo->name ?>
                        </td>
                        <td class="nsm-text-primary nsm-link default" >
                                <?php echo $demo->email != '' ? $demo->email : '---';  ?>
                        </td>
                        <td class="nsm-text-primary nsm-link default" >
                                <?php echo $demo->guest_emails != '' ? $demo->guest_emails : '---';  ?>
                        </td>
                        <td class="nsm-text-primary nsm-link default" >
                                <?php echo $demo->phone_number != '' ? formatPhoneNumber($demo->phone_number) : '---';  ?>
                        </td>
                      
                        <td class="nsm-text-primary nsm-link default" >
                                <?php echo $demo->key_features != '' ? $demo->key_features : '---';  ?>
                        </td>
                        <td>
                            <span class="nsm-badge success p-2">
                                <?php 
                                    echo date('g:i A', strtotime($demo->demo_time));
                                ?>                                            
                            </span>
                        </td>
                        <td><?php echo get_format_date($demo->demo_date) ?></td>
                    </tr>
                <?php
                endforeach;
                ?>
            <?php
            else :
            ?>
                <tr>
                    <td colspan="11">
                        <div class="nsm-empty">
                            <span>No results found.</span>
                        </div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>


</div>

<script>
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>

<?php include viewPath('v2/includes/footer'); ?>
