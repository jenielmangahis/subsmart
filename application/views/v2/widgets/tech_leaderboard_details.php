<style>
    #widget-tech-leaderboard .nsm-profile {
        width: 35px !important;
        display: inline-block;
        margin-top: -4px;
        margin-right: 2px;
    }

    #widget-tech-leaderboard .details {
        display: block;
        width: 100%;
        vertical-align: top;
        margin-left: 5px;
    }

    #widget-tech-leaderboard thead tr {
        font-size: 14px;
        font-weight: bold;
        color: var(--tech-green3);
    }

    #widget-tech-leaderboard .content-title {
        color: var(--tech-primary);
    }

    #widget-tech-leaderboard .content-subtitle {
        color: var(--tech-green3) !important;
    }

    #widget-tech-leaderboard .jobs {
        text-align: center
    }

    #widget-tech-leaderboard .jobs label,
    #widget-tech-leaderboard .ticket label {
        border-radius: 25px;
        font-weight: bold;
        font-size: 16px;
    }

    #widget-tech-leaderboard .sales {
        text-align: right;
    }

    #widget-tech-leaderboard .sales label {
        font-size: 16px;
        font-weight: bold;
        color: var(--tech-green3);
    }

    #widget-tech-leaderboard .profile {
        margin: auto;
        width: 35px;
        height: 35px;
        min-width: 40px;
        background-color: #6a4a86;
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: 2px solid #fff;
        position: relative;
        z-index: 1;
    }

    #widget-tech-leaderboard .profile-wrapper::before {
        content: "";
        position: absolute;
        top: 2px;
        left: 3px;
        width: 45px;
        height: 42px;
        background: linear-gradient(135deg, var(--tech-green2), var(--tech-primary));
        border-radius: 50%;
        z-index: 0;
    }

    #widget-tech-leaderboard_wrapper table.dataTable.no-footer {
        border: none !important;
    }

    #widget-tech-leaderboard .widget-item {
        gap: 10px;
    }
    #widget-tech-leaderboard .profile-wrapper {
        width: 50px;
    }
</style>
<?php if (count($techLeaderBoards) > 0) : ?>
<div style="overflow-x:auto;">
    <table class="w-100" id="widget-tech-leaderboard">
        <thead>
            <tr>
                <td data-name="Employee" style="width: 200px">Employee</td>
                <td data-name="Job">Job</td>
                <td data-name="Ticket">Ticket</td>
                <td data-name="Action" style="text-align:right;">Sales</td>
            </tr>
        </thead>
        <tbody>
            <?php $count = 0;
            $colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
            
            ?>
            <?php foreach ($techLeaderBoards as $tech) { ?>
            <?php if ($count >= 10) {
                break;
            } ?>
            <tr>
                <td>
                    <div class="widget-item position-relative">
                        <?php $image = userProfilePicture($tech->employee_id); ?>
                        <div class="profile-wrapper">
                            <?php if (is_null($image)){ ?>
                            <div class="profile">
                                <span><?php echo getLoggedNameInitials($tech->employee_id); ?></span>
                            </div>
                            <?php }else{ ?>
                            <div class="profile" style="background-image: url('<?php echo $image; ?>');"></div>
                            <?php } ?>
                        </div>
                        <div class="details">
                            <span class="content-title"><?= $tech->employee_name ?></span>
                            <span class="content-subtitle d-block"><?php echo 'rep# '.$tech->employee_number; ?></span>
                        </div>
                    </div>
                </td>
                <td class="jobs"><label
                       ><?= $tech->job_count ?></label></td>
                <td class="ticket"><label
                        ><?= $tech->ticket_count ?></label></td>
                <td class="sales"><label for="">$<?= number_format(($tech->job_amount+ $tech->ticket_amount), 2,".", ",") ?></label></td>

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
    $(function() {
        var dt_tech_leaderboard = $("#widget-tech-leaderboard").DataTable({
            "searching": false,
            "paging": false,
            "info": false,
            "ordering": true
        });
    });
</script>
