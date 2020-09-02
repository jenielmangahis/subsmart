<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-xl-9 ui-state-default db-card" id="earning">
    <div class="card tile-container" style="top:0px; margin-bottom: 30px; height:auto;">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-5" style="border-bottom:1px solid gray; padding-bottom:15px;"><i class="fa fa-bar-chart" aria-hidden="true"></i> Monthly Earning</h4>
            <div class="row">
                <div class="col-lg-7">
                    <div>
                        <!-- <div id="chart-with-area" class="ct-chart earning ct-golden-section"></div> -->
                        <canvas id="myChart" style="max-width: 500px;"></canvas>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <p class="text-muted mb-4">This month</p>
                                <h4>$0.00</h4>
                                <p class="text-muted mb-5">It will be as simple as in fact it will be
                                    occidental.</p><span class="peity-donut"
                                                         data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }'
                                                         data-width="72" data-height="72">4/5</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <p class="text-muted mb-4">Last month</p>
                                <h4>$0.00</h4>
                                <p class="text-muted mb-5">It will be as simple as in fact it will be
                                    occidental.</p><span class="peity-donut"
                                                         data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }'
                                                         data-width="72" data-height="72">3/5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div>
    </div><!-- end card -->
</div>