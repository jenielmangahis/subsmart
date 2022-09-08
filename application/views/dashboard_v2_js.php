<script>
$(document).ready(function() {
    fetch('<?= base_url('Dashboard/todays_stats') ?>', {
        method: 'GET',
    }) .then(response => response.json() ).then(response => {
        var {success, data, paymentInvoice, jobsCompleted, lostAccount, collectedAccounts } = response;
        if(success){
            var totalPayments = 0;
            var totalCollected = 0;
            var totalJobsCompleted = 0;
            var totalJobsAdded = 0;
            var lostAcc = lostAccount == '' ? '0' : lostAccount[0]['total'];
            var collectedAcc = collectedAccounts == '' ? '0' : collectedAccounts[0]['total'];

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
            $("#jobs_added").text(totalJobsAdded); // total jobs added
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
            if(companies != ''){
                
                for(var i=0; i < companies.length; i++){
                    $("#companiesData").append(
                        '<div class="widget-item cursor-pointer" id="companiesData"><div class="nsm-list-icon"><i class="bx bx-buildings"></i></div><div class="content ms-2"><div class="details"><span class="content-title" id="customer_name">'+ companies[i].business_name+'</span><span class="content-subtitle d-block mb-1">'+companies[i].website+'</span><span class="content-subtitle d-block"><i>Since </i>'+companies[i].year_est+'</span></div><div class="controls"><span class="nsm-badge primary"></span><span class="content-subtitle d-block mt-1">'+companies[i].business_email+'</span></div></div></div>'
                    )
                }
            }else{
                for(var j=0; j < upcomingJobs.length; j++){
                    $("#jobsData").append(
                        '<div class="widget-item cursor-pointer" onclick="location.href='+upcomingJobs[j].prof_id+'"><div class="nsm-profile"><span>'+upcomingJobs[j].last_name+' '+upcomingJobs[j].first_name+'</span></div><div class="content ms-2"><div class="details"><span class="content-title">'+upcomingJobs[j].last_name+' '+upcomingJobs[j].first_name+'</span><span class="content-subtitle d-block">'+upcomingJobs[j].city+' '+upcomingJobs[j].state+' '+upcomingJobs[j].zip_code+'</span></div><div class="controls"><span class="nsm-badge primary">Pending</span><span class="content-subtitle d-block mt-1">'+upcomingJobs[j].email+'</span></div></div></div>'
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

        if(success){
            for(var x=0; x<salesLeaderboard.length; x++){
                var name = salesLeaderboard[x].FName + ' '+ salesLeaderboard[x].LName;
                var rev = parseFloat(revenue[x][0].salesRepRev).toFixed(2);
                var prof = salesLeaderboard[x].FName[0] + ''+ salesLeaderboard[x].LName[0];

                $('#sales_leaderboard').append(
                    '<div class="widget-item"><div class="nsm-profile"><span>'+ prof +'</span></div><div class="content"><div class="details"><span class="content-title">'+ name +'</span><span class="content-subtitle d-block">Sales Rep</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$'+ rev +'</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">'+ salesLeaderboard[x].customerCount+'</span><span class="content-subtitle d-block">customers</span></div></div></div>'
                )
            }
        }
    }).catch((error) => {

    })

    fetch('<?= base_url('Dashboard/tech_leaderboard') ?>',{
        
    }).then(response => response.json()).then(response => {
        var {success, techLeaderboard, revenue, customerCount} = response;

        if(success){
            for(var x=0; x<techLeaderboard.length; x++){
                var count = parseFloat(customerCount[x][0].totalCount) != 0 ? parseFloat(customerCount[x][0].totalCount) : '0';
                $('#tech_leaderboard').append(
                    '<div class="widget-item"><div class="nsm-profile"><span>'+techLeaderboard[x].FName[0] + ''+ techLeaderboard[x].LName[0]+'</span></div><div class="content"><div class="details"><span class="content-title">'+techLeaderboard[x].FName + ' '+ techLeaderboard[x].LName+'</span><span class="content-subtitle d-block">Technician</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$'+parseFloat(revenue[x][0].techRev).toFixed(2)+'</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">'+ count +'</span><span class="content-subtitle d-block">customers</span></div></div></div>'
                )
            }
        }
    }).catch((error) =>{
        console.log(error);
    })

    fetch('<?= base_url('Dashboard/jobs_status')?>',{
    }).then(response => response.json()).then(response => {
        var { success, jobsStatus} = response;

        if(success){
            for(var x=0; x<jobsStatus.length; x++){
                $('#jobs_status').append(
                    '<div class="row js-row-dash"><div class="col"><div class="row"><div class="col-9 marg-top"><div class="jname">'+ jobsStatus[x].status+'</div></div><div class="col-3 col-center"><div class="row"><div class="col col-align"><span class="nsm-badge success" style="font-size:12px;">'+jobsStatus[x].statusCount+'</span></div></div></div></div></div></div>'
                )
            }
        }
    }).catch((error) => {
        
    })


})
</script>