<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Sales</span>
            <center><b><?= $company_id == 58 ? 'UNIT' : 'USD' ?></b></center>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url('accounting/allsales') ?>">
                See More
            </a>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content d-flex justify-content-center flex-column align-items-center">
        <canvas id="sales_chart" class="nsm-chart" data-chart-type="sales"></canvas>
    </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script type="text/javascript">
//     window.onload = function () {
//     var chart = new CanvasJS.Chart("chartContainer",
//     {
//       title:{
//       text: "Try Various Chart Types"
//       },
//       data: [
//       {
//         type: "column", //change type to bar, line, area, pie, etc
//         dataPoints: [
//         { x: 10, y: 71 },
//         { x: 20, y: 55},
//         { x: 30, y: 50 },
//         { x: 40, y: 65 },
//         { x: 50, y: 95 },
//         { x: 60, y: 68 },
//         { x: 70, y: 28 },
//         { x: 80, y: 34 },
//         { x: 90, y: 14}

//         ]
//       }
//       ]
//     });

//     chart.render();
//   }
    var today = new Date();

    var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Nov", "Dec"];
    var todayDate = month[today.getMonth()] + "-" + today.getDate();
    var first = new Date(new Date().setDate(today.getDate() - 30));
    var firstDate = month[first.getMonth()] + " " + first.getDate();
    var second = new Date(new Date().setDate(first.getDate() - 25));
    var second2 = new Date(new Date().setDate(first.getDate() - 24));
    var secondDate = month[second.getMonth()] + " " + second.getDate();
    var secondDate2 = month[second2.getMonth()] + " " + second2.getDate();
    var third = new Date(new Date().setDate(today.getDate() - 18));
    var third2 = new Date(new Date().setDate(today.getDate() - 17));
    var thirdDate = month[third.getMonth()] + " " + third.getDate();
    var thirdDate2 = month[third2.getMonth()] + " " + third2.getDate();
    var fourth = new Date(new Date().setDate(today.getDate() - 12));
    var fourth2 = new Date(new Date().setDate(today.getDate() - 11));
    var fourthdDate = month[fourth.getMonth()] + " " + fourth.getDate();
    var fourthdDate2 = month[fourth2.getMonth()] + " " + fourth2.getDate();
    var fifth = new Date(new Date().setDate(today.getDate() - 6));
    var fifthDate = month[fifth.getMonth()] + " " + fifth.getDate();
    var fifth2 = new Date(new Date().setDate(today.getDate() - 5));
    var fifthDate2 = month[fifth2.getMonth()] + " " + fifth2.getDate();

    var one = new Date('January 01, 2022');
    var jan = month[one.getMonth()]+" "+one.getDate();
    var two = new Date('Febraury 01, 2022');
    var feb = month[two.getMonth()]+" "+two.getDate();
    var three = new Date('March 01, 2022');
    var mar = month[three.getMonth()]+" "+three.getDate();
    var four = new Date('April 01, 2022');
    var apr = month[four.getMonth()]+" "+four.getDate();
    var five = new Date('May 01, 2022');
    var may = month[five.getMonth()]+"-"+five.getDate();
    var six = new Date('June 01, 2022');
    var jun = month[six.getMonth()]+" "+six.getDate();
    var seven = new Date('July 01, 2022');
    var jul = month[seven.getMonth()]+" "+seven.getDate();
    var eight = new Date('August 01, 2022');
    var aug = month[eight.getMonth()]+" "+eight.getDate();
    var nine = new Date('September 01, 2022');
    var sep = month[nine.getMonth()]+" "+nine.getDate();




    $(document).ready(function() {
        initializeSalesChart()

    });


    <?php
    $amountFirst = 0;
    $amountSecond = 0;
    $amountThird = 0;
    $amountFourth = 0;
    $amountFifth = 0;
    $amountSixth = 0;
    $amountSevent = 0;
    $amountEight = 0;
    $amountNinth = 0;
    foreach($mmr as $mmrs){
        if(empty($mmrs->bill_start_date)){
            $start_date = getInstalledDate($mmrs->prof_id, 'acs_office');
        }else{
            $start_date = $mmrs->bill_start_date;
            array_push($datenow, $start_date);
        }

        // if (date("Y-m-d", strtotime("-30 days")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("-25 days")) >= date("Y-m-d", strtotime($start_date))) {
        //     $amountFirst += $mmrs->mmr;
        // }else if (date("Y-m-d", strtotime("-24 days")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("-18 days")) >= date("Y-m-d", strtotime($start_date))) {
        //     $amountSecond += $mmrs->mmr;
        // }else if (date("Y-m-d", strtotime("-17 days")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("-12 days")) >= date("Y-m-d", strtotime($start_date))) {
        //     $amountThird += $mmrs->mmr;
        // }else if (date("Y-m-d", strtotime("-11 days")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("-6 days")) >= date("Y-m-d", strtotime($start_date))) {
        //     $amountFourth += $mmrs->mmr;
        // }  else if (date("Y-m-d", strtotime("-5 days")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d") >= date("Y-m-d", strtotime($start_date))) {
        //     $amountFifth += $mmrs->mmr;
        // }

        if (date("Y-m-d", strtotime("2022-01-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-01-31")) >= date("Y-m-d", strtotime($start_date))) {
            $amountFirst += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-02-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-02-28")) >= date("Y-m-d", strtotime($start_date))) {
            $amountSecond += $mmrs->mmr;        
        }else if (date("Y-m-d", strtotime("2022-03-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-03-31")) >= date("Y-m-d", strtotime($start_date))) {
            $amountThird += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-04-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-04-30")) >= date("Y-m-d", strtotime($start_date))) {
            $amountFourth += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-05-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-05-31")) >= date("Y-m-d", strtotime($start_date))) {
            $amountFifth += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-06-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-06-30")) >= date("Y-m-d", strtotime($start_date))) {
            $amountSixth += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-07-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-07-31")) >= date("Y-m-d", strtotime($start_date))) {
            $amountSevent += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-08-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-08-31")) >= date("Y-m-d", strtotime($start_date))) {
            $amountEight += $mmrs->mmr;
        }else if (date("Y-m-d", strtotime("2022-09-01")) <= date("Y-m-d", strtotime($start_date)) && date("Y-m-d", strtotime("2022-09-30")) >= date("Y-m-d", strtotime($start_date))) {
            $amountNinth += $mmrs->mmr;
        }
    }


    ?>


    function initializeSalesChart() {
        var sales = $('#sales_chart');

        const sales_labels = [
            jan, feb, mar, apr, may, jun, jul, aug, sep
        ];
        const sales_data = {
            labels: sales_labels,
            datasets: [{
                label: 'Sales',
                backgroundColor: 'rgb(106, 74, 134)',
                borderColor: 'rgb(106, 74, 134)',
                data: [<?php echo $amountFirst ?>, <?php echo $amountSecond; ?>, <?php echo $amountThird; ?>, <?php echo $amountFourth; ?>, <?php echo $amountFifth; ?>, <?php echo $amountSixth; ?>, <?php echo $amountSevent; ?>, <?php echo $amountEight; ?>, <?php echo $amountNinth; ?>],

            }, ]
        };

        new Chart(sales, {
            type: 'line',
            data: sales_data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 10
                    },
                },
                aspectRatio: 1.5,
            },
        });
    }
</script>



<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>