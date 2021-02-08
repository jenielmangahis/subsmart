<div class="col-lg-3 col-md-6 col-sm-12"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header">
            <i class="fa fa-bullhorn" aria-hidden="true"></i> Lead Source

            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                   &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item">Name of Lead Source</a></li>
                    <li><a href="#" class="dropdown-item">Current Number of Jobs From Lead Source</a></li>
                    <li><a href="#" class="dropdown-item">Last month</a></li>
                    <li><a href="#" class="dropdown-item">Last year</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body" style="padding:5px 10px;">
            <div class="row" id="salesLeaderboardBody" style="height: 310px; overflow-y: scroll">
                <canvas id="LeadSourceChart"></canvas>
            </div>
            <div class="text-center">
                <a class="text-info" href="#">View All</a>
            </div>

        </div>

    </div>
</div>
