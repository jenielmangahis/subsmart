<script>
$(document).ready(function() {
    fetch('<?= base_url('Dashboard/todays_stats') ?>', {
        method: 'GET',
    }) .then(response => response.json() ).then(response => {
        var {success, data, paymentInvoice, jobsCompleted, onlineBooking, lostAccount, collectedAccounts } = response;

        if(success){
            var totalPayments = 0;
            var totalCollected = 0;
            var totalJobsCompleted = 0;
            var totalJobsAdded = 0;
            var lostAcc = lostAccount == '' ? '0' : lostAccount[0]['total'];
            var collectedAcc = collectedAccounts == '' ? '0' : collectedAccounts[0]['total'];
            var onlineBookingCount = onlineBooking == '' ? '0' : onlineBooking[0]['total'];

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;

            //earned
            for(var x=0; x<data.length; x++){
                if(today == data[x].date_issued){
                        totalPayments += parseFloat(data[x].amount);
                    }
            }
            //collected
            for(var x=0; x<paymentInvoice.length; x++){
                if(today == paymentInvoice[x].date_issued){
                        totalCollected += parseFloat(paymentInvoice[x].amount);
                    }
            }
            //jobs completed
            for(var x=0; x<jobsCompleted.length; x++){
                if(jobsCompleted[x].status == "Completed"){
                    if(today == jobsCompleted[x].date_issued){
                        totalJobsCompleted++;
                    }
                }else if(jobsCompleted[x].status == "New" || jobsCompleted[x].status == "Scheduled"){
                    if(today == jobsCompleted[x].date_issued){
                        totalJobsAdded++;
                    }
                }
            }
            $("#earned").text('$'+totalPayments); // total earned
            $("#jobs_completed").text(totalJobsCompleted); // total jobs completed
            $("#jobs_added").text(onlineBookingCount); // total jobs added
            $("#lost_accounts").text(lostAcc); // total lost account
            $("#collections").text(collectedAcc); // total collected account
            $("#collected").text('$'+totalCollected); // total earned
        }
    }).catch((error) => {
        console.log('Error:', error);
    });

    fetch('<?= base_url('Dashboard/upcoming_jobs') ?>', {
        method: 'GET',
    }) .then(response => response.json() ).then(response => {
        var {success, companies, upcomingJobs } = response;

        if(success){
            if(companies){
                companies = companies.map(company => {
                    return new Proxy(company, {
                        // return fallback if property/value is null
                        get: (object, key) => object[key] === null ? "--" : object[key],
                    });
                });
                
                for(var i=0; i < companies.length; i++){
                    $("#companiesData").append(
                        '<div class="widget-item cursor-pointer" id="companiesData"><div class="nsm-list-icon"><i class="bx bx-buildings"></i></div><div class="content ms-2"><div class="details"><span class="content-title" id="customer_name">'+ companies[i].business_name+'</span><span class="content-subtitle d-block mb-1">'+companies[i].website+'</span><span class="content-subtitle d-block"><i>Since </i>'+companies[i].year_est+'</span></div><div class="controls"><span class="nsm-badge primary"></span><span class="content-subtitle d-block mt-1">'+companies[i].business_email+'</span></div></div></div>'
                    )
                }
            }else{
                for(var j=0; j < upcomingJobs.length; j++){
                var nn = "NN";
                    if(upcomingJobs[j].last_name[0]){
                        nn = upcomingJobs[j].last_name[0]+''+upcomingJobs[j].first_name[0];
                    }
                    $("#jobsData").append(
                        '<div class="widget-item cursor-pointer" onclick="location.href=`/customer/module/'+upcomingJobs[j].prof_id+'`"><div class="nsm-profile"><span>'+nn+'</span></div><div class="content ms-2"><div class="details"><span class="content-title">'+upcomingJobs[j].last_name+' '+upcomingJobs[j].first_name+'</span><span class="content-subtitle d-block">'+upcomingJobs[j].city+', '+upcomingJobs[j].state+' '+upcomingJobs[j].zip_code+'</span></div><div class="controls"><span class="nsm-badge primary">Pending</span><span class="content-subtitle d-block mt-1">'+upcomingJobs[j].email+'</span></div></div></div>'
                    )
                }
            }
        }

    }).catch((error) => {
        console.log('Error:', error);
    });

    fetch('<?= base_url('Dashboard/customer_status') ?>', {
        method: 'GET',
    }) .then(response => response.json() ).then(response => {
        var {success, status} = response;

        if(success){
            for(var x= 0; x<status.length; x++){
                var stat = (status[x].status != '') ? status[x].status : 'Pending';
                $('#customer_status').append(
                    '<div class="row js-row-dash"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ stat +'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+ status[x].statusCount+'</span></div></div></div></div></div></div>'
                )
            }
        }
    }).catch((error) => {
        console.log('Error:', error);
    })
    
    fetch('<?= base_url('Dashboard/sales_leaderboard') ?>',{
        method: 'GET'
    }) .then(response => response.json()).then(response => {
        var {success, salesLeaderboard, revenue} = response;
        console.log(response);
        if(success){
            for(var x=0; x<salesLeaderboard.length; x++){
                var name = salesLeaderboard[x].FName + ' '+ salesLeaderboard[x].LName;
                var salesRev = 0;
                var salesRev1 = revenue[x].length != 0 ? parseFloat(revenue[x][0]['salesRepRev']).toFixed(2) : '0.00';

                // if(revenue[x][0]['salesRepRev']){
                //     salesRev = parseFloat(revenue[x][0]['salesRepRev']).toFixed(2);
                // }
                var prof = salesLeaderboard[x].FName[0] + ''+ salesLeaderboard[x].LName[0];

                var salesRev2 = Intl.NumberFormat('en-US');
                var salesRev3 = salesRev2.format(salesRev1);

                $('#sales_leaderboard').append(
                    '<div class="widget-item"><div class="nsm-profile"><span>'+ prof +'</span></div><div class="content"><div class="details"><span class="content-title">'+ name +'</span><span class="content-subtitle d-block">Sales Rep</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$'+ salesRev3 +'</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">'+ salesLeaderboard[x].customerCount+'</span><span class="content-subtitle d-block">customers</span></div></div></div>'
                )
            }
        }
    }).catch((error) => {
        console.log(error);
    })

    fetch('<?= base_url('Dashboard/tech_leaderboard') ?>',{
        
    }).then(response => response.json()).then(response => {
        var {success, techLeaderboard, revenue, customerCount} = response;
        console.log(response);
        if(success){
            for(var x=0; x<techLeaderboard.length; x++){
                var techRev = revenue[x][0]['techRev'] ? parseFloat(revenue[x][0]['techRev']).toFixed(2) : '0.00';
                // var techRev = rev ? rev : 0.00;

                var count = parseFloat(customerCount[x][0].totalCount) != 0 ? parseFloat(customerCount[x][0].totalCount) : '0';
                $('#tech_leaderboard').append(
                    '<div class="widget-item"><div class="nsm-profile"><span>'+techLeaderboard[x].FName[0] + ''+ techLeaderboard[x].LName[0]+'</span></div><div class="content"><div class="details"><span class="content-title">'+techLeaderboard[x].FName + ' '+ techLeaderboard[x].LName+'</span><span class="content-subtitle d-block">Technician</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$'+techRev+'</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">'+ count +'</span><span class="content-subtitle d-block">jobs</span></div></div></div>'
                )
            }
        }
    }).catch((error) =>{
        console.log(error);
    })

    var MONTH_DATE = "MONTH";
    $.post("<?php echo base_url('Dashboard/statusCount'); ?>", {
        DATE: MONTH_DATE,
    }).done(function(data) {
        var MONTH_DATA = JSON.parse(data);
       $('#MONTH_COUNT').append(
            '<div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[0].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[0].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[1].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[1].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[2].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[2].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[3].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[3].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[4].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[4].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[5].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[5].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ MONTH_DATA[6].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+MONTH_DATA[6].TOTAL+'</span></div></div></div></div></div></div>'
        )        
    });

    var YEAR_DATE = "YEAR";
    $.post("<?php echo base_url('Dashboard/statusCount'); ?>", {
        DATE: YEAR_DATE,
    }).done(function(data) {
        var YEAR_DATA = JSON.parse(data);
       $('#YEAR_COUNT').append(
            '<div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[0].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[0].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[1].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[1].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[2].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[2].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[3].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[3].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[4].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[4].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[5].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[5].TOTAL+'</span></div></div></div></div></div></div><div class="row js-row-dash mb-2"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ YEAR_DATA[6].STATUS+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+YEAR_DATA[6].TOTAL+'</span></div></div></div></div></div></div>'
        )        
    });

    // fetch('<?= base_url('Dashboard/jobs_status')?>',{
    // }).then(response => response.json()).then(response => {
    //     var { success, jobsStatus} = response;

    //     if(success){
    //         for(var x=0; x<jobsStatus.length; x++){
    //             $('#jobs_status').append(
    //                 '<div class="row js-row-dash"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ jobsStatus[x].status+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+jobsStatus[x].statusCount+'</span></div></div></div></div></div></div>'
    //             )
    //         }
    //     }
    // }).catch((error) => {
        
    // })


fetch('<?= base_url('Dashboard/jobs') ?>',{

}).then(response => response.json()).then(response=>{
    var date1 = new Date();
    const currentMonth = new Date(date1.getFullYear(), date1.getMonth()).toLocaleString('default', {month: 'short'});
    const secMonth = new Date(date1.getFullYear(), date1.getMonth() - 1, 1).toLocaleString('default', {month: 'short'});
    const firstMonth = new Date(date1.getFullYear(), date1.getMonth() - 2, 1).toLocaleString('default', {month: 'short'});
    var curJob = 0;
    var prevJob = 0;
    var previousJob = 0;
    var {success, jobsDone} = response;
    var date = new Date();
    var monthNow = date.getMonth()+1;
    var yearNow = date.getFullYear();
    var previousYear = yearNow - 1;
    var prev = new Date(date.setMonth(date.getMonth() - 1));
    var previous = new Date(date.setMonth(date.getMonth() - 1));
    var curAmount = 0;
    var prevAmount = 0;
    var previousAmount = 0;

    var prevMonthNow = prev.getMonth()+1;
    var previousMonthNow = previous.getMonth()+1;
    if(jobsDone){
        for(var x = 0; x<jobsDone.length; x++){
            var date_created = new Date(jobsDone[x].date_created);
            var month_created = date_created.getMonth()+1;
            var year_created = date_created.getFullYear();
            if(monthNow == month_created  && yearNow == year_created){
                curJob++;
                curAmount += parseFloat(jobsDone[x].amount);
            }else if(prevMonthNow == (month_created) && yearNow == year_created){
                prevJob++;
                prevAmount += parseFloat(jobsDone[x].amount);
            }else if(previousMonthNow == (month_created) && yearNow == year_created){
                previousJob++;
                previousAmount += parseFloat(jobsDone[x].amount);
            }

            if(12 == month_created && previousYear == year_created ){
                prevJob++;
                prevAmount += parseFloat(jobsDone[x].amount);
            }else if(11 == month_created && previousYear == year_created){
                previousJob++;
                previousAmount += parseFloat(jobsDone[x].amount);
            }

        }
        console.log(previousMonthNow);
        
    }
    var jobs = $("#jobs_chart");
    new Chart(jobs, {
        type: 'line',
        data: {
            labels: [firstMonth, secMonth, currentMonth],
            datasets: [{
                    label: 'Job Count',
                    data: [previousJob, prevJob, curJob],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    stack: 'combined',
                    type: 'bar',
                    yAxisID: "A",
                },
                {
                    label: 'Job Value',
                    data: [previousAmount, prevAmount, curAmount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(191, 191, 191, 0.5)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    stack: 'combined',
                    yAxisID: "B",
                },

            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            },
            aspectRatio: 1.5,
            scales: {
                A: {
                    type: 'linear',
                    position: 'left',
                    title: {
                        display: true,
                        text: 'No of Jobs'
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if (parseInt(value) >= 1000) {
                                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return value;
                            }
                        }
                    }
                },
                B: {
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if (parseInt(value) >= 1000) {
                                return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        }
    });
}).catch((error) => {
    console.log(error);
})
        


fetch('<?= base_url('Dashboard/accounting_sales') ?>',{
}).then(response => response.json()).then(response =>{
    var amountFirst = amountSecond = amountThird = amountFourth = amountFifth = amountSixth = amountSevent = amountEight = amountNinth = amountTenth = amountEleven = amountTwelve = 0;
    var {success, mmr} = response;
    if(mmr){
        for(var x= 0; x<mmr.length;x++){
            var installDate = mmr[x].install_date;
            if(installDate){
                var ins = new Date('"'+installDate+'"');
            
                if(new Date('01/01/2022') <= ins && new Date('01/31/2022') >= ins){
                    amountFirst += parseInt(mmr[x].mmr);
                }else if(new Date('02/01/2022') <= ins && new Date('02/28/2022') >= ins){
                    amountSecond += parseInt(mmr[x].mmr);
                }else if(new Date('03/01/2022') <= ins && new Date('03/31/2022') >= ins){
                    amountThird += parseInt(mmr[x].mmr);
                }else if(new Date('04/01/2022') <= ins && new Date('04/30/2022') >= ins){
                    amountFourth += parseInt(mmr[x].mmr);
                }else if(new Date('05/01/2022') <= ins && new Date('05/31/2022') >= ins){
                    amountFifth += parseInt(mmr[x].mmr);
                }else if(new Date('06/01/2022') <= ins && new Date('06/30/2022') >= ins){
                    amountSixth += parseInt(mmr[x].mmr);
                }else if(new Date('07/01/2022') <= ins && new Date('07/31/2022') >= ins){
                    amountSevent += parseInt(mmr[x].mmr);
                }else if(new Date('08/01/2022') <= ins && new Date('08/31/2022') >= ins){
                    amountEight += parseInt(mmr[x].mmr);
                }else if(new Date('09/01/2022') <= ins && new Date('09/30/2022') >= ins){
                    amountNinth += parseInt(mmr[x].mmr);
                }else if(new Date('10/01/2022') <= ins && new Date('10/31/2022') >= ins){
                    amountTenth += parseInt(mmr[x].mmr);
                }else if(new Date('11/01/2022') <= ins && new Date('11/30/2022') >= ins){
                    amountEleven += parseInt(mmr[x].mmr);
                }else if(new Date('12/01/2022') <= ins && new Date('12/31/2022') >= ins){
                    amountTwelve += parseInt(mmr[x].mmr);
                }
            }
        }   
    }

    var sales = $('#sales_chart');
    const sales_labels = [
        'Jan 1-31', 'Feb 1-28', 'Mar 1-31', 'Apr 1-30', 'May 1-31', 'Jun 1-30', 'Jul 1-31', 'Aug 1-31', 'Sep 1-30', 'Oct 1-31', 'Nov 1-30', 'Dec 1-31'
    ];
    const sales_data = {
        labels: sales_labels,
        datasets: [{
            label: 'Sales',
            backgroundColor: 'rgb(106, 74, 134)',
            borderColor: 'rgb(106, 74, 134)',
            data: [amountFirst, amountSecond, amountThird, amountFourth, amountFifth, amountSixth, amountSevent, amountEight, amountNinth, amountTenth, amountEleven, amountTwelve],

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
    }).catch((error) => {
        console.log(error);
    })


})
</script>