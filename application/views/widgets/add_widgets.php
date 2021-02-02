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
                <button onclick="document.location='<?= base_url('nsmart_plans') ?>'" class="btn btn-primary mt-2">Upgrade to Plan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addWidgets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <div class="col-lg-12 mt-3">
                    <div id="triggers" class="list-group col-lg-6 float-left">
                        <a onclick="$(this).addClass('active')" href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start trigFunc">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Timesheet</h5>
                            </div>
                            <p class="mb-1">View Login and Logout of your Employee</p>
                        </a>             
                    </div>
                    <div id="triggers" class="list-group col-lg-6 float-right">          
                        <a onclick="$(this).addClass('active')" href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start trigFunc">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Upcoming Jobs</h5>
                            </div>
                            <p class="mb-1">Check Jobs Coming</p>
                        </a>             
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="float-right btn btn-success btn-small">Add Widget</button>
            </div>
        </div>
    </div>
</div>
