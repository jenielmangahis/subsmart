  
<div  class="<?= $class ?>"  data-id="<?= $id ?>" id="widget_<?= $id ?>">
    <div class="wid_header">
        <i class="fa fa-tasks" aria-hidden="true"></i> TaskHub

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
                <div id="taskHubBody" class="tasks" style="height: <?= $rawHeight ?>px; overflow-y: scroll">
                    <div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div>
                </div>
                <div class="text-center mt-4">
                    <a class="text-info" href="<?= base_url('taskhub') ?>">See All Task</a>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadTasks();
        //alert('hey');

    });
    function loadTasks() {

        $.ajax({
            url: '<?php echo base_url(); ?>taskhub/loadWidgetContents',
            method: 'get',
            data: {},
            beforeSend: function () {
                // $('#timesheetBody').html('')
            },
            success: function (response) {
                $('#taskHubBody').html(response);
            }

        });

    }
    ;
</script>