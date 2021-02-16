<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module">
    <div class="col-sm-12 individual-module">
        <div class="text-center justify-content-center" 
             onclick="$('#addModule').modal('show')"
             style="cursor: pointer">
            <i style="font-size: 120px; color: #62ba41" class="fa fa-plus-circle add_widget"></i><br />
            <span>Manage Modules</span>
        </div>
    </div>
</div>


<div class="modal fade" id="addModule" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="addWidgets" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Manage Modules</h6>
                <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body no-padding text-center">

                <div class="alert alert-warning col-md-12 mt-2 mb-2" role="alert">
                    <span style="color:black;">
                        Select the modules you would like to display in your layout
                    </span>
                </div><br/>
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
    var modules = [];
    $('#addModule').on('show.bs.modal', function () {
        $.ajax({
            url: '<?php echo base_url(); ?>customer/getModulesList',
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


    function addWidget(id)
    {
        var mod = $('#custom_modules').val();
        var arr = mod.split(',');
        if(mod!=""){
            for(var i=0; i<arr.length;i++){
                modules.push(arr[i]);
            }
        }
        modules.push(id)
        var cleanModules = removeDuplicates(modules)
        
        $('#custom_modules').val(cleanModules);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/ac_module_sort",
            data: {ams_values : cleanModules.toString(),ams_id : <?php echo $module_sort->ams_id; ?>}, // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
            }
        });
    }
    
    function removeDuplicates(data)
    {   
        let unique = [];
        data.forEach(element => {
            if(!unique.includes(element)){
                unique.push(element);
            }
        });
        
        return unique;
    }

    function removeWidget(dis)
    {
        var mod = $('#custom_modules').val();
        var arr = mod.split(',');
        if(mod!=""){
            for(var i=0; i<arr.length;i++){
                modules.push(arr[i]);
            }
        }
        
        var cleanModules = removeDuplicates(modules)
        const index = cleanModules.indexOf(dis);
        if (index > -1) {
          cleanModules.splice(index, 1);
        }
        $('#custom_modules').val(cleanModules);
        
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/customer/ac_module_sort",
            data: {ams_values : cleanModules.toString(),ams_id : <?php echo $module_sort->ams_id; ?>}, // serializes the form's elements.
            success: function(data)
            {
                console.log(data);
            }
        });
        
    }
</script>