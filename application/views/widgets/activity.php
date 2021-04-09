<div class="<?= $class ?>" data-id="<?= $id ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-tasks" aria-hidden="true"></i> Activity
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>, '<?= $isGlobal ?>')"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px;  height: <?= $rawHeight ?>px; overflow: hidden">
                <div class="row" style="height: <?= $rawHeight-30 ?>px; overflow-y: scroll; padding:5px 20px;">
                    <div id="activityLogs" class="col-lg-12 text-center">
                        <div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div>
                    </div>

                </div>
                <div class="text-center">
                    <a class="text-info" href="<?php echo base_url('activity_logs') ?>">Load More</a>
                </div>
            </div>

        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadActivityLogs();
        //alert('hey');

    });
    function loadActivityLogs() {

        $.ajax({
            url: '<?php echo base_url(); ?>activity_logs/getActivityLogs',
            method: 'get',
            data: {},
            beforeSend: function () {
                // $('#timesheetBody').html('')
            },
            success: function (response) {
                $('#activityLogs').html(response);
            }

        });

    }
    ;
</script>