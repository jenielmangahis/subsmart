<style>
    #widget-sales-leaderboard .nsm-profile {
        width: 35px !important;
        display: inline-block;
        margin-top: -4px;
        margin-right: 2px;
    }

    #widget-sales-leaderboard .details {
        display: block;
        width: 100%;
        vertical-align: top;
        margin-left: 5px;
    }

    #widget-sales-leaderboard thead tr {
        font-size: 14px;
        font-weight: bold;
        color: var(--sales-green3);
    }
    

    #widget-sales-leaderboard .content-title {
        color: var(--sales-primary);
    }

    #widget-sales-leaderboard .content-subtitle {
        color: var(--sales-green3) !important;
    }

    #widget-sales-leaderboard .jobs {
        text-align: center
    }

    #widget-sales-leaderboard .jobs label,
    #widget-sales-leaderboard .ticket label {
        border-radius: 25px;
        font-weight: bold;
        font-size: 16px;
    }

    #widget-sales-leaderboard .sales {
        text-align: right;
    }

    #widget-sales-leaderboard .sales label {
        font-size: 16px;
        font-weight: bold;
        color: var(--sales-green3);
    }

    #widget-sales-leaderboard .profile {
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

    #widget-sales-leaderboard .profile-wrapper::before {
        content: "";
        position: absolute;
        top: 2px;
        left: 7px;
        width: 45px;
        height: 42px;
        background: linear-gradient(135deg, var(--sales-green2), var(--sales-primary));
        border-radius: 50%;
        z-index: 0;
    }

    #widget-sales-leaderboard_wrapper table.dataTable.no-footer {
        border: none !important;
    }

    #widget-sales-leaderboard .widget-item {
        gap: 10px;
    }

    #widget-sales-leaderboard .profile-wrapper {
        width: 50px;
    }
</style>
<?php if (count($salesLeaderBoards) > 0) : ?>
<table class="w-100" id="widget-sales-leaderboard">
<thead>
    <tr>
        <td data-name="Employee" style="width: 200px">Employee</td>
        <td style="text-align: center">Job</td>
        <td style="text-align:right;">Sales</td>
    </tr>
    </thead>
    <tbody>
        <?php $count = 0;
        $colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
        ?>
        <?php foreach ($salesLeaderBoards as $sales) { ?>
        <?php if ($count >= 10) {
            break;
        } ?>
        <tr>
            <td>
                <div class="widget-item position-relative">
                    <?php $image = userProfilePicture($sales->uid); ?>
                    <div class="profile-wrapper">
                        <?php if (is_null($image)){ ?>
                        <div class="profile">
                            <span><?php echo getLoggedNameInitials($sales->uid); ?></span>
                        </div>
                        <?php }else{ ?>
                        <div class="profile" style="background-image: url('<?php echo $image; ?>');"></div>
                        <?php } ?>
                    </div>
                    <div class="details" style="width:159px;overflow:hidden;display:inline-block;">
                        <span class="content-title"><?= $sales->name ?></span>
                        <span class="content-subtitle d-block"><?php echo 'rep# ' . $sales->employee_number; ?></span>
                    </div>
                </div>
            </td>
            <td class="jobs"><label><?= $sales->total_jobs ?></label></td>
            <td class="sales"><label for="">$<?= number_format($sales->total_sales, 2) ?></label></td>
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
    $(function() {
        var dt_sales_leaderboard = $("#widget-sales-leaderboard").DataTable({
            "searching": false,
            "paging": false,
            "info": false,
            "ordering": true
        });
    });
</script>
