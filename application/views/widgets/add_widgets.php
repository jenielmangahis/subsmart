<div class="col-lg-3 col-md-6 col-sm-12 widget_header" id="addWidget">
    <div  class="wid_header">
        <i class="fa fa-bar-chart"></i> Add More Report
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div 
                    onmouseover="$('.add_widget').attr('style', 'font-size: 120px; color: black')" 
                    onmouseout="$('.add_widget').attr('style', 'font-size: 120px; color: gray')" 
                    onclick="$('#addWidgets').modal('show')"
                    class="text-center justify-content-center" style="cursor: pointer">
                    <i style="font-size: 120px; color: gray" class="fa fa-plus-circle add_widget"></i><br />
                    <span>Manage Widgets</span>
                </div>
                <hr />
                <div class="justify-content-center text-center">
                    <span>Track stats important to your business</span><br />
                    <button onclick="document.location = '<?= base_url('nsmart_plans/index') ?>'" class="btn btn-primary mt-2">Upgrade Plan</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addWidgets" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="addWidgets" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Manage Widgets</h6>
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body no-padding text-center">
                <span style="color:red;">Select the widgets you would like to display in your dashboard</span><br />
                <div class="col-lg-12 mt-3" id="widgetTable" style="max-height: 350px; overflow-y: scroll">
                    <div class="progress" style="height:20px;">
                        <div class="progress-bar progress-bar-striped bg-info  progress-bar-animated" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Please wait while System is fetching data</div>

                    </div>
                </div>
                <input type="hidden" id="widgetIDs" />
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

    function manipulateWidget(dis, id)
    {
        if ($(dis).is(":checked"))
        {
            addWidget(id);
        } else {
            removeWidget(id);
        }
    }


    function addToMain(id, isMain, isGlobal)
    {
        if(!isGlobal){
            $.ajax({
                url: '<?php echo base_url(); ?>widgets/addToMain',
                method: 'POST',
                data: {id: id},
                //dataType: 'json',
                success: function (response) {
                   alert(isMain?'Successfully Removed':'Successfully Added');
                   location.reload();
                }
            });
        }else{
            alert('Sorry you cannot update a widget set by the company as global')
        }
    }

    function addWidget(id)
    {
        var isGlobal = $('#widgetGlobal_' + id).is(":checked") ? '1' : 0;
        var isMain = $('#widgetMain_' + id).is(":checked") ? '1' : 0;
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/addWidget',
            method: 'POST',
            data: {id: id, isGlobal: isGlobal, isMain: isMain},
            //dataType: 'json',
            success: function (response) {
                if (isMain != '1') {
                    $(response).insertBefore($('#addWidget'));
                }
            }
        });
    }

    function removeWidget(dis)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/removeWidget',
            method: 'POST',
            data: {id: dis},
            dataType: 'json',
            success: function (response) {
                if (response.success)
                {
                    $('#widget_' + dis).remove();
                   
                }else{
                    alert(response.message);
                }
            }
        });
    }
</script>
