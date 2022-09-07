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
                        '<div class="widget-item cursor-pointer" id="companiesData"><div class="nsm-list-icon"><i class="bx bx-buildings"></i></div><div class="content ms-2"><div class="details"><span class="content-title" id="customer_name">'+ companies[i].business_name+'</span><span class="content-subtitle d-block mb-1">'+companies[i].website+'</span><span class="content-subtitle d-block"><i>Since</i>'+companies[i].year_est+'</span></div><div class="controls"><span class="nsm-badge primary"></span><span class="content-subtitle d-block mt-1">'+companies[i].business_email+'</span></div></div></div>'
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

})
</script>