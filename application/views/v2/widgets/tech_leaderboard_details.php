<style>
#widget-tech-leaderboard .nsm-profile{
    width: 35px !important;
    display: inline-block;    
    margin-top: -4px;
    margin-right: 2px;
}
#widget-tech-leaderboard .details{
    display: block;
    width:100%;
    vertical-align:top;
    margin-left:5px;
}
</style>
<?php if (count($techLeaderBoards) > 0) : ?>
    <div style="overflow-x:auto;">
        <table class="w-100" id="widget-tech-leaderboard">
            <thead>
            <tr>
                <td data-name="Employee">Employee</td>            
                <td data-name="Job">Job</td>
                <td data-name="Ticket">Ticket</td>
                <td data-name="Action" style="text-align:right;">Sales</td>
            </tr>
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php foreach ($techLeaderBoards as $tech) { ?>
                <?php  if ($count >= 10) break; ?>
                <tr>
                    <td>
                        <div class="widget-item">
                            <?php $image = userProfilePicture($tech->id); ?>
                            <?php if (is_null($image)){ ?>
                                <div class="nsm-profile">
                                    <span><?php echo getLoggedNameInitials($tech->id); ?></span>
                                </div>
                            <?php }else{ ?>
                                <div class="nsm-profile" style="background-image: url('<?php echo $image; ?>');"></div>
                            <?php } ?>
                            <div class="details">
                                <span class="content-title"><?= $tech->tech_rep; ?></span>
                                <span class="content-subtitle d-block"><?= $tech->email ?></span>
                            </div>
                        </div>
                    </td>
                    <td style="vertical-align:top;font-weight:bold;"><?= $tech->total_jobs; ?></td>
                    <td style="vertical-align:top;font-weight:bold;"><?= $tech->total_tickets; ?></td>
                    <td style="vertical-align:top;font-weight:bold;text-align:right;">$<?= number_format($tech->total_amount, 2); ?></td>
                    
                </tr>
                <?php  $count++;} ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="nsm-empty">
        <i class='bx bx-meh-blank'></i>
        <span>Tech Leaderboard is empty.</span>
    </div>
<?php endif; ?>
<script>
$(function(){
    var dt_tech_leaderboard = $("#widget-tech-leaderboard").DataTable({
        "searching": false,
        "paging": false, 
        "info": false,
        "ordering": true
    });
});
</script>
