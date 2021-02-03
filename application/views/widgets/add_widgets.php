<div class="col-lg-3 col-md-6 col-sm-12">
    <div class="card" style="margin:0;">
        <div class="card-header">
            <i class="fa fa-bar-chart"></i> Add More Report
        </div>
        <div class="card-body">
            <div 
                onmouseover="$('.add_widget').attr('style', 'font-size: 120px; color: black')" 
                onmouseout="$('.add_widget').attr('style', 'font-size: 120px; color: gray')" 
                onclick="$('#addWidgets').modal('show')"
                class="text-center justify-content-center" style="cursor: pointer">
                <i style="font-size: 120px; color: gray" class="fa fa-plus-circle add_widget"></i><br />
                <span>Add Widgets</span>
            </div>
            <hr />
            <div class="justify-content-center text-center">
                <span>Track stats important to your business</span><br />
                <button onclick="document.location = '<?= base_url('nsmart_plans/index') ?>'" class="btn btn-primary mt-2">Upgrade to Plan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addWidgets" tabindex="-1" role="dialog" aria-labelledby="addWidgets" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Widgets</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 3px;">
                <span style="color:red;">Select the widgets you would like to display in your dashboard</span><br />
                <div class="col-lg-12 mt-3" id="widgetTable">
                    <div class="progress" style="height:20px;">
                        <div class="progress-bar progress-bar-striped bg-info  progress-bar-animated" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Please wait while System is fetching data</div>
                            
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="float-right btn btn-success btn-small">Add Widget</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#addWidgets').on('show.bs.modal', function () {
        $.ajax({
            url: '<?php echo base_url(); ?>dashboard/getWidgetList',
            method: 'get',
            data: {},
            success: function (response) {
                $('#widgetTable').html(response);
            }
        });
    });
</script>
