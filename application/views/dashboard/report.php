<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-xl-4 ui-state-default db-card" id="report">
    <div class="card">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4">Sales Report</h4>
            <div class="cleafix">
                <p class="float-left"><i class="mdi mdi-calendar mr-1 text-primary"></i> Jan 01 - Jan 31
                </p>
                <h5 class="font-18 text-right">$0.00</h5>
            </div>
            <div id="ct-donut" class="ct-chart wid">
                <canvas id="doughnutChart"></canvas>
            </div>
            <div class="mt-4">
                <table class="table mb-0">
                    <tbody>
                    <tr>
                        <td><span class="badge badge-primary">Desk</span></td>
                        <td>Desktop</td>
                        <td class="text-right">0.00%</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-success">Mob</span></td>
                        <td>Mobile</td>
                        <td class="text-right">0.00%</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-warning">Tab</span></td>
                        <td>Tablets</td>
                        <td class="text-right">0.00%</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>