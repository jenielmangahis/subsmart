<style>
#widget-sales-leaderboard .nsm-profile{
    width: 35px !important;
    display: inline-block;    
    margin-top: -4px;
    margin-right: 2px;
}
#widget-sales-leaderboard .details{
    display: block;
    width:100%;
    vertical-align:top;
    margin-left:5px;
}
</style>
<?php if (count($salesLeaderBoards) > 0) : ?>
    <table class="w-100" id="widget-sales-leaderboard">
        <thead>
        <tr>
            <td>Employee</td>            
            <td>Job</td>
            <td style="text-align:right;">Sales</td>
        </tr>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            <?php foreach ($salesLeaderBoards as $sales) { ?>
            <?php  if ($count >= 10) break; ?>
            <tr>
                <td>
                    <?php $image = userProfilePicture($sales->uid); ?>
                    <?php if (is_null($image)){ ?>
                        <div class="nsm-profile">
                            <span><?php echo getLoggedNameInitials($sales->uid); ?></span>
                        </div>
                    <?php }else{ ?>
                        <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                    <?php } ?>
                    <div class="details" style="width:159px;overflow:hidden;display:inline-block;">
                        <span class="content-title"><?= $sales->name; ?></span>
                        <span class="content-subtitle d-block"><?= $sales->email ?></span>
                    </div>
                </td>                
                <td style="vertical-align:top;font-weight:bold;"><?= $sales->total_jobs; ?></td>
                <td style="vertical-align:top;font-weight:bold;text-align:right;">$<?= number_format($sales->total_sales, 2); ?></td>
            </tr>
            <?php  $count++;} ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Sales Leaderboard is empty.</span>
    </div>
<?php endif; ?>
<script>
$(function(){
    var dt_sales_leaderboard = $("#widget-sales-leaderboard").DataTable({
        "searching": false,
        "paging": false, 
        "info": false,
        "ordering": true
    });
});
</script>
