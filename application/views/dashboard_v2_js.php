<script>
    $(document).ready(function() {
        // Track user location
        getLocation();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(trackPosition);
            }
        }

        function trackPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            $.ajax({
                type: "POST",
                url: base_url + "trac360/_create_user_location",
                dataType: 'json',
                data: {
                    latitude: latitude,
                    longitude: longitude
                },
                success: function(data) {
                    if (data.success) {
                        $('#new_feed_modal').modal('hide');
                        notifyUser('', data.msg, 'success');
                        $('#feedSubject').val('');
                        $('#feedMessage').val('');
                    }
                    //console.log(data);
                },
                beforeSend: function() {

                }
            });
        }

        $('.nsm-draggable-container-sortable-main').sortable({
            update: function(event, ui) {
                var data = $(this).sortable('serialize');
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: base_url + 'widgets/_update_sort'
                });
            }
        });

        $('#frm-feeds').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: base_url + "dashboard/_create_news_feeds",
                dataType: 'json',
                data: $('#frm-feeds').serialize(),
                success: function(data) {
                    if (data.success) {
                        $('#new_feed_modal').modal('hide');
                        notifyUser('', data.msg, 'success');
                        $('#feedSubject').val('');
                        $('#feedMessage').val('');
                    }
                    //console.log(data);
                },
                beforeSend: function() {

                }
            });
        });

        $('#frm-newsletter').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: base_url + "dashboard/_create_newsletter",
                dataType: 'json',
                data: formData,
                success: function(data) {
                    if (data.success == 1) {
                        $('#news_letter_modal').modal('hide');
                        load_company_newsletter();
                        notifyUser('', data.msg, 'success');
                        $('#news-subject').val('');
                        $('#news-content').val('');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: data.msg
                        });
                    }
                },
                beforeSend: function() {

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        fetch('<?php echo base_url('Dashboard/todays_stats'); ?>', {
            method: 'GET',
        }).then(response => response.json()).then(response => {
            var {
                success,
                data,
                paymentInvoice,
                onlineBooking,
                lost_accounts,
                collectedAccounts,
                invoice_amount_due,
                collected_amount,
                service_project_income,
                invoice_amount,
                jobs_completed,
                new_jobs,
                earned,
            } = response;

            if (success) {

                $("#earned").text('$' + earned); // total earned
                $("#jobs_completed").text(jobs_completed); // total jobs completed
                $("#jobs_added").text(new_jobs); // total jobs added
                $("#lost_accounts").text(lost_accounts); // total lost account
                $("#service_project_income").text('$' + invoice_amount);
                $("#invoice_amount_stats").text('$' + invoice_amount); // total earned
            }
        }).catch((error) => {
            console.log('Error:', error);
        });


        fetch('<?php echo base_url('Dashboard/today'); ?>', {
            method: 'GET',
        }).then(response => response.json()).then(response => {
            var {
                success,
                data,
                sales,
                jobsCreated,
                jobsDone,
                collected,
                jobsCanceled,
                serviceSceduled
            } = response;

            if (success) {

                $("#today_sales").text('$' + sales);
                $("#today_jobs_created").text(jobsCreated)
                $("#today_jobs_done").text(jobsDone);
                $("#today_collected").text('$' + collected);
                $("#today_jobs_canceled").text(jobsCanceled);
                $("#today_service_scheduled").text(serviceSceduled);
            }
        }).catch((error) => {
            console.log('Error:', error);
        });


        // fetch('<?php echo base_url('dashboard/_recent_customers_thumbnail'); ?>', {
        //     method: 'GET',
        // }).then(response => response.json()).then(response => {
        //     var {
        //         success,
        //         companies,
        //         recentCustomers
        //     } = response;

        //     $(".recent-customer-container-count").html(recentCustomers.length);
        //     $("#total_customer_graph").html(recentCustomers.length);

        // }).catch((error) => {
        //     console.log('Error:', error);
        // });

        fetch('<?php echo base_url('dashboard/_recent_customers'); ?>', {
            method: 'GET',
        }).then(response => response.json()).then(response => {
            var {
                success,
                companies,
                recentCustomers
            } = response;
            $("#recent-customer-container").html('');
            if (success == 1) {
                var colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
                var colorIndex = 0;
                var randomColor= ''
                var count = 1;
                for (var j = 0; j < recentCustomers.length; j++) {
                    if (count == 9){
                        return;
                    }
                    count++;
                    randomColor = colors[colorIndex];

                    colorIndex = (colorIndex + 1) % colors.length;
                    var nn = "NN";
                    if (recentCustomers[j].last_name[0]) {
                        nn = recentCustomers[j].last_name[0] + '' + recentCustomers[j].first_name[0];
                    }

                    if (recentCustomers[j].is_favorite == 1) {
                        var cust_name = '<i class="bx bxs-heart customer-favorite"></i> ' +
                            recentCustomers[j].first_name + ' ' + recentCustomers[j].last_name;
                    } else {
                        var cust_name = recentCustomers[j].first_name + ' ' + recentCustomers[j]
                            .last_name;
                    }

                    if (recentCustomers[j].city == null && recentCustomers[j].state == null &&
                        recentCustomers[j].zip_code == null) {
                        var cust_address = '---';
                    } else {
                        var cust_address = recentCustomers[j].city + ', ' + recentCustomers[j].state +
                            ' ' + recentCustomers[j].zip_code;
                    }

                    var cust_type = recentCustomers[j].customer_type !== null ? recentCustomers[j]
                        .customer_type : '---';

                    $("#recent-customer-container").append(
                        '<div class="widget-item cursor-pointer" onclick="location.href=`/customer/module/' +
                        recentCustomers[j].prof_id + '`"><div class="nsm-profile" style="background-color:'+randomColor+'!important'+'"><span>' + nn +
                        '</span></div><div class="content ms-2"><div class="details" style="color:#281c2d"><span class="content-title">' +
                        cust_name +
                        '</span><span class="content-subtitle d-block">' + cust_address +
                        '</span></div><div class="controls"><span class="customer-badge" >' +
                        cust_type +
                        '</span><span class="content-subtitle d-block mt-1"></span></div></div></div>'
                    )
                }
            }

        }).catch((error) => {
            console.log('Error:', error);
        });

        fetch('<?php echo base_url('dashboard/_recent_leads'); ?>', {
            method: 'GET',
        }).then(response => response.json()).then(response => {
            var {
                success,
                recentLeads
            } = response;
            $("#recent-leads-container").html('');
            if (success == 1) {
                var colors = ['#FEA303', '#d9a1a0', '#BEAFC2', '#EFB6C8'];
                var randomColor= ''
                if (recentLeads.length > 0) {
                    for (var j = 0; j < recentLeads.length; j++) {

                        randomColor = colors[Math.floor(Math.random() * colors.length)];
                        var nn = "NN";
                        if (recentLeads[j].lastname[0]) {
                            nn = recentLeads[j].lastname[0] + '' + recentLeads[j].firstname[0];
                        }

                        var recent_lead_mail = "---";
                        if (recentLeads[j].email_add != null) {
                            var recent_lead_mail = recentLeads[j].email_add;
                        }

                        if (recentLeads[j].city == null && recentLeads[j].state == null && recentLeads[
                                j].zip) {
                            var recent_lead_address = "---";
                        } else {
                            var recent_lead_address = recentLeads[j].city + ', ' + recentLeads[j]
                                .state + ' ' + recentLeads[j].zip;
                        }

                        $("#recent-leads-container").append(
                            '<div class="widget-item cursor-pointer" onclick="location.href=`/customer/add_lead/' +
                            recentLeads[j].leads_id + '`"><div class="nsm-profile"  style="background-color:'+randomColor+'!important'+'"><span>' + nn +
                            '</span></div><div class="content ms-2"><div class="details"><span class="content-title">' +
                            recentLeads[j].lastname + ' ' + recentLeads[j].firstname +
                            '</span><span class="content-subtitle d-block">' + recent_lead_address +
                            '</span></div><div class="controls"><span class="content-subtitle d-block mt-1"  >' +
                            recent_lead_mail + '</span></div></div></div>'
                        )
                    }
                } else {
                    $("#recent-leads-container").html(`<div class="nsm-empty">
                    <i class="bx bx-meh-blank"></i>
                    <span>There is no recent leads.</span>
                </div>`);
                }
            } else {
                $("#recent-leads-container").html(`<div class="nsm-empty">
                    <i class="bx bx-meh-blank"></i>
                    <span>There is no recent leads.</span>
                </div>`);
            }

        }).catch((error) => {
            console.log('Error:', error);
        });

        // fetch('<?php echo base_url('Dashboard/upcoming_jobs'); ?>', {
        //     method: 'GET',
        // }) .then(response => response.json() ).then(response => {
        //     var {success, companies, upcomingJobs } = response;

        //     if(success){
        //         if(companies){
        //             companies = companies.map(company => {
        //                 return new Proxy(company, {
        //                     // return fallback if property/value is null
        //                     get: (object, key) => object[key] === null ? "--" : object[key],
        //                 });
        //             });

        //             for(var i=0; i < companies.length; i++){
        //                 $("#companiesData").append(
        //                     '<div class="widget-item cursor-pointer" id="companiesData"><div class="nsm-list-icon"><i class="bx bx-buildings"></i></div><div class="content ms-2"><div class="details"><span class="content-title" id="customer_name">'+ companies[i].business_name+'</span><span class="content-subtitle d-block mb-1">'+companies[i].website+'</span><span class="content-subtitle d-block"><i>Since </i>'+companies[i].year_est+'</span></div><div class="controls"><span class="nsm-badge primary"></span><span class="content-subtitle d-block mt-1">'+companies[i].business_email+'</span></div></div></div>'
        //                 )
        //             }
        //         }else{
        //             for(var j=0; j < upcomingJobs.length; j++){
        //             var nn = "NN";
        //                 if(upcomingJobs[j].last_name[0]){
        //                     nn = upcomingJobs[j].last_name[0]+''+upcomingJobs[j].first_name[0];
        //                 }
        //                 $("#jobsData").append(
        //                     '<div class="widget-item cursor-pointer" onclick="location.href=`/customer/module/'+upcomingJobs[j].prof_id+'`"><div class="nsm-profile"><span>'+nn+'</span></div><div class="content ms-2"><div class="details"><span class="content-title">'+upcomingJobs[j].last_name+' '+upcomingJobs[j].first_name+'</span><span class="content-subtitle d-block">'+upcomingJobs[j].city+', '+upcomingJobs[j].state+' '+upcomingJobs[j].zip_code+'</span></div><div class="controls"><span class="nsm-badge primary">Pending</span><span class="content-subtitle d-block mt-1">'+upcomingJobs[j].email+'</span></div></div></div>'
        //                 )
        //             }
        //         }
        //     }

        // }).catch((error) => {
        //     console.log('Error:', error);
        // });

        fetch('<?php echo base_url('Dashboard/customer_status'); ?>', {
            method: 'GET',
        }).then(response => response.json()).then(response => {
            var {
                success,
                status
            } = response;


            var content = "";
            let icon = 'bx bxs-calendar';
            let background = '';
            let color = '';
            let color_icon = '#FEA303';
            if (success) {
                for (var x = 0; x < status.length; x++) {
                    if (status[x].status != '') {
                        switch (status[x].status) {
                            case "Cancelled":
                                icon = 'bx bxs-calendar';
                                color_icon = '#FEA303';
                                break;

                            case "Active w/RMR":
                                icon = 'bx bxs-calendar';
                                color_icon = '#d9a1a0';

                                break;
                            case "Funded":
                                icon = 'bx bxs-news';
                                color_icon = '#A888B5';

                                break;
                            case "Collection":
                                icon = 'bx bxs-calendar-check';
                                color_icon = '#EFB6C8';
                                break;
                            case "New":
                                icon = 'bx bxs-badge-check';
                                color_icon = '#d9a1a0';
                                break;
                            case "Inactive w/RMM":
                                icon = 'bx bx-task';
                                color_icon = '#EFB6C8';
                                break;
                            case "Moni":
                                icon = 'bx bx-error-alt';
                                color_icon = '#FEA303';

                                break;
                            case "Active w/RQR":
                                icon = 'bx bxs-archive';
                                color_icon = '#A888B5';

                                break;
                            case "Collections":
                                icon = 'bx bxs-check-square';
                                color_icon = '#A888B5';

                                break;
                            case "Active w/RYR":
                                icon = 'bx bxs-check-square';
                                color_icon = '#FEA303';

                                break;
                            case "Guardian":
                                icon = 'bx bxs-check-square';
                                color_icon = '#d9a1a0';

                                break;
                            case "Inactive":
                                icon = 'bx bxs-check-square';
                                color_icon = '#EFB6C8';

                                break;
                            case "Active":
                                icon = 'bx bxs-check-square';
                                color_icon = '#d9a1a0';

                                break;
                            case "Lead":
                                icon = 'bx bxs-check-square';
                                color_icon = '#A888B5';

                                break;
                            case "Inspection ":
                                icon = 'bx bxs-check-square';
                                color_icon = '#EFB6C8';

                                break;
                            case "Competition Lost":
                                icon = 'bx bxs-check-square';
                                color_icon = '#A888B5';

                                break;
                            case "Proposal ":
                                icon = 'bx bxs-check-square';
                                color_icon = '#A888B5';

                                break;
                            case "Cancel Pending":
                                icon = 'bx bxs-check-square';
                                color_icon = '#FEA303';

                                break;
                        }
                        var total_count = parseFloat(status[x].statusCount);

                        content += `
                            <div class="col-md-3 mb-3 column-container" style="padding: 0 5px;margin-bottom: 10px;">
                                <div class="item">
                                    <div class="box" style="background:` + color_icon + '2a' + `"></div>
                                    <div class="box3" style="background:` + color_icon + '2a' + `"></div>
                                    <div class="box2" style="background:` + color_icon + '2a' + `"></div>
                                    <div class="first">
                                    <div class="icons" style="color:` + color_icon + `;background:` + color_icon +
                            '1a' + `">
                                                <i class='` + icon + `'></i>
                                            </div>
                                            <label for="">` + total_count.toLocaleString(undefined, {
                                minimumFractionDigits: 0
                            }) + `</label>
                                    </div>
                                    <div class="count">
                                        <p>` + status[x].status + `</p>
                                    </div>
                                </div>
                            </div>
                            `;

                    }

                }
                $('#customer_status').append(content);

            }
        }).catch((error) => {
            console.log('Error:', error);
        })

        const dashboard_getLeaderboardAvatar = (leaderboard) => {
            let {
                avatar,
                firstname,
                lastname
            } = leaderboard;

            if (typeof avatar === "string" && !avatar.endsWith("default.png")) {
                return `<div class="nsm-profile" style="background-image: url('${avatar}');"></div>`;
            }

            firstname = firstname ? firstname : " ";
            lastname = lastname ? lastname : " ";

            const initials = firstname[0] + '' + lastname[0];
            return `
            <div class="nsm-profile">
                <span>${initials}</span>
            </div>
        `;
        };

        const dashboard_getLeaderboardHTMLItem = (leaderboard, nameSubTitle = "Sales Rep") => {
            const {
                firstname = "", lastname = "", total_revenue, total_customers, employee_id
            } = leaderboard;
            const fullName = `${firstname} ${lastname}`;

            const formatter = Intl.NumberFormat('en-US');
            const revenue = formatter.format(total_revenue || 0);
            const leaderboardType = nameSubTitle === "Sales Rep" ? "sales" : "tech";

            return `
        <a class="widget-item" style="text-decoration: none; color: inherit; cursor: pointer;" target="_blank" href="/job?user_id=${employee_id}&leader_board_type=${leaderboardType}">
            ${dashboard_getLeaderboardAvatar(leaderboard)}
            <div class="content">
                <div class="details">
                    <span class="content-title">${fullName}</span>
                    <span class="content-subtitle d-block">${nameSubTitle}</span>
                </div>
                <div style="padding-top: 5px;">
                    <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">
                        $${revenue}
                    </span>
                    <span class="content-subtitle d-block">revenue</span>
                </div>
                <div class="controls">
                    <span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">
                        ${total_customers || 0}
                    </span>
                    <span class="content-subtitle d-block">customers</span>
                </div>
            </div>
        </a>
        `;
        }

        const dashboard_getLeaderboardEmptyMessage = () => {
            return `
        <div class="nsm-card-content d-flex justify-content-center align-items-center">
            <div class="nsm-empty">
                <i class="bx bx-meh-blank"></i>
                <span>There is currently no leaderboard recorded.</span>
            </div>
        </div>
        `;
        }

        fetch('<?php echo base_url('Dashboard/sales_leaderboard'); ?>', {
            method: 'GET'
        }).then(response => response.json()).then(response => {

            if (response.is_new) {
                if (!Array.isArray(response.data) || !response.data.length) {
                    $('#sales_leaderboard').css({
                        height: "100%"
                    });
                    $('#sales_leaderboard').append(dashboard_getLeaderboardEmptyMessage());
                    return;
                }

                response.data.forEach(leaderboard => {
                    $('#sales_leaderboard').append(dashboard_getLeaderboardHTMLItem(
                        leaderboard));
                });
                return;
            }


            var {
                success,
                salesLeaderboard,
                revenue
            } = response;
            console.log(response);
            if (success) {
                for (var x = 0; x < salesLeaderboard.length; x++) {
                    var name = salesLeaderboard[x].FName + ' ' + salesLeaderboard[x].LName;
                    var salesRev = 0;
                    var salesRev1 = revenue[x].length != 0 ? parseFloat(revenue[x][0]['salesRepRev'])
                        .toFixed(2) : '0.00';

                    // if(revenue[x][0]['salesRepRev']){
                    //     salesRev = parseFloat(revenue[x][0]['salesRepRev']).toFixed(2);
                    // }
                    var prof = salesLeaderboard[x].FName[0] + '' + salesLeaderboard[x].LName[0];

                    var salesRev2 = Intl.NumberFormat('en-US');
                    var salesRev3 = salesRev2.format(salesRev1);

                    $('#sales_leaderboard').append(
                        '<div class="widget-item"><div class="nsm-profile"><span>' + prof +
                        '</span></div><div class="content"><div class="details"><span class="content-title">' +
                        name +
                        '</span><span class="content-subtitle d-block">Sales Rep</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$' +
                        salesRev3 +
                        '</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">' +
                        salesLeaderboard[x].customerCount +
                        '</span><span class="content-subtitle d-block">customers</span></div></div></div>'
                    )
                }
            }
        }).catch((error) => {
            console.log(error);
        })

        fetch('<?php echo base_url('Dashboard/tech_leaderboard'); ?>', {

        }).then(response => response.json()).then(response => {
            if (response.is_new) {
                if (!Array.isArray(response.data) || !response.data.length) {
                    $('#tech_leaderboard').css({
                        height: "100%"
                    });
                    $('#tech_leaderboard').append(dashboard_getLeaderboardEmptyMessage());
                    return;
                }

                response.data.forEach(leaderboard => {
                    $('#tech_leaderboard').append(dashboard_getLeaderboardHTMLItem(leaderboard,
                        "Tech Rep"));
                });
                return;
            }

            var {
                success,
                techLeaderboard,
                revenue,
                customerCount
            } = response;
            console.log(response);
            if (success) {
                for (var x = 0; x < techLeaderboard.length; x++) {
                    var techRev = revenue[x][0]['techRev'] ? parseFloat(revenue[x][0]['techRev'])
                        .toFixed(
                            2) : '0.00';
                    // var techRev = rev ? rev : 0.00;

                    var count = '0';
                    if (customerCount[x][0] && customerCount[x][0].totalCount) {
                        count = parseFloat(customerCount[x][0].totalCount);
                    }
                    $('#tech_leaderboard').append(
                        '<div class="widget-item"><div class="nsm-profile"><span>' +
                        techLeaderboard[x]
                        .FName[0] + '' + techLeaderboard[x].LName[0] +
                        '</span></div><div class="content"><div class="details"><span class="content-title">' +
                        techLeaderboard[x].FName + ' ' + techLeaderboard[x].LName +
                        '</span><span class="content-subtitle d-block">Technician</span></div><div style="padding-top: 5px;"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">$' +
                        techRev +
                        '</span><span class="content-subtitle d-block">revenue</span></div><div class="controls"><span class="content-subtitle nsm-text-success fw-bold" style="font-size:12px;">' +
                        count +
                        '</span><span class="content-subtitle d-block">jobs</span></div></div></div>'
                    )
                }
            }
        }).catch((error) => {
            console.log(error);
        })

        var MONTH_DATE = "MONTH";
        $.post("<?php echo base_url('Dashboard/statusCount'); ?>", {
            DATE: MONTH_DATE,
        }).done(function(data) {
            //console.log('jobs tatus data =========')
            //console.log(data)
            var MONTH_DATA = JSON.parse(data);
            var content = '';

            let icon = '';
            let background = '';
            let color = '';
            let color_icon = '';
            let box_color = '';
            MONTH_DATA.forEach(function(item) {
                switch (item.STATUS) {
                    case 'Draft':
                        // icon = 'bx bxs-note';
                        return;
                    case 'Scheduled':
                        icon = 'bx bxs-calendar';
                        color_icon = '#FEA303';
                        color = 'var(--jobs-color3)';

                        break;
                    case 'Arrival':
                        icon = 'bx bxs-news';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#d9a1a0';

                        break;
                    case 'Started':
                        icon = 'bx bxs-calendar-check';
                        color_icon = '#BEAFC2';
                        color = 'var(--jobs-primary)';

                        break;
                    case 'Approved':
                        icon = 'bx bxs-badge-check';
                        color = 'var(--jobs-color3)';
                        color_icon = '#FEA303';

                        break;
                    case 'Finished':
                        icon = 'bx bx-task';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#BEAFC2';

                        break;
                    case 'Cancelled':
                        icon = 'bx bx-error-alt';
                        color_icon = '#FEA303';
                        color = 'var(--jobs-color3)';

                        break;
                    case 'Invoiced':
                        icon = 'bx bxs-archive';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#d9a1a0';

                        break;
                    case 'Completed':
                        icon = 'bx bxs-check-square';
                        color = 'var(--jobs-primary)';
                        color_icon = '#BEAFC2';

                        break;
                }
                content += `
                    <div class="col-md-3 mb-3" style="padding: 0 5px;margin-bottom: 10px;">
                        <div class="item">
                            <div class="box" style="background:` + color_icon + '2a' + `"></div>
                            <div class="box3" style="background:` + color_icon + '2a' + `"></div>
                            <div class="box2" style="background:` + color_icon + '2a' + `"></div>
                            <div class="icons" style="color:` + color_icon + `;background:` + color_icon + '1a' + `">
                                <i class='` + icon + `'></i>
                            </div>
                            <div class="count">
                                <label for="">` + item.TOTAL + `</label>
                                <p>` + item.STATUS + `</p>
                            </div>
                        </div>
                    </div>
                    `;
            });

            $('#MONTH_COUNT').html(content);
        });


        var YEAR_DATE = "YEAR";
        $.post("<?php echo base_url('Dashboard/statusCount'); ?>", {
            DATE: YEAR_DATE,
        }).done(function(data) {
            var YEAR_DATA = JSON.parse(data);
            var content = '';
            let icon = '';
            let background = '';
            let color = '';
            YEAR_DATA.forEach(function(item) {
                switch (item.STATUS) {
                    case 'Draft':
                        // icon = 'bx bxs-note';
                        return;
                    case 'Scheduled':
                        icon = 'bx bxs-calendar';
                        color_icon = '#FEA303';
                        color = 'var(--jobs-color3)';

                        break;
                    case 'Arrival':
                        icon = 'bx bxs-news';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#d9a1a0';

                        break;
                    case 'Started':
                        icon = 'bx bxs-calendar-check';
                        color_icon = '#BEAFC2';
                        color = 'var(--jobs-primary)';

                        break;
                    case 'Approved':
                        icon = 'bx bxs-badge-check';
                        color = 'var(--jobs-color3)';
                        color_icon = '#FEA303';

                        break;
                    case 'Finished':
                        icon = 'bx bx-task';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#BEAFC2';

                        break;
                    case 'Cancelled':
                        icon = 'bx bx-error-alt';
                        color_icon = '#FEA303';
                        color = 'var(--jobs-color3)';

                        break;
                    case 'Invoiced':
                        icon = 'bx bxs-archive';
                        color = 'var(--jobs-tertiary)';
                        color_icon = '#d9a1a0';

                        break;
                    case 'Completed':
                        icon = 'bx bxs-check-square';
                        color = 'var(--jobs-primary)';
                        color_icon = '#BEAFC2';

                        break;
                }
                content += `
                    <div class="col-md-3 mb-3" style="padding: 0 5px;margin-bottom: 10px;">
                        <div class="item">
                            <div class="box" style="background:` + color_icon + '2a' + `"></div>
                            <div class="box3" style="background:` + color_icon + '2a' + `"></div>
                            <div class="box2" style="background:` + color_icon + '2a' + `"></div>
                            <div class="icons" style="color:` + color_icon + `;background:` + color_icon + '1a' + `">
                                <i class='` + icon + `'></i>
                            </div>
                            <div class="count">
                                <label for="">` + item.TOTAL + `</label>
                                <p>` + item.STATUS + `</p>
                            </div>
                        </div>
                    </div>
                    `;
            });
            $('#YEAR_COUNT').append(content);
        });


        // fetch('<?php echo base_url('Dashboard/jobs_status'); ?>',{
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


        fetch('<?php echo base_url('Dashboard/jobs'); ?>', {

        }).then(response => response.json()).then(response => {
            var date1 = new Date();
            const currentMonth = new Date(date1.getFullYear(), date1.getMonth()).toLocaleString(
                'default', {
                    month: 'short'
                });
            const secMonth = new Date(date1.getFullYear(), date1.getMonth() - 1, 1).toLocaleString(
                'default', {
                    month: 'short'
                });
            const firstMonth = new Date(date1.getFullYear(), date1.getMonth() - 2, 1).toLocaleString(
                'default', {
                    month: 'short'
                });
            var curJob = 0;
            var prevJob = 0;
            var previousJob = 0;
            var {
                success,
                jobsDone
            } = response;
            var date = new Date();
            var monthNow = date.getMonth() + 1;
            var yearNow = date.getFullYear();
            var previousYear = yearNow - 1;
            var prev = new Date(date.setMonth(date.getMonth() - 1));
            var previous = new Date(date.setMonth(date.getMonth() - 1));
            var curAmount = 0;
            var prevAmount = 0;
            var previousAmount = 0;

            var prevMonthNow = prev.getMonth() + 1;
            var previousMonthNow = previous.getMonth() + 1;
            if (jobsDone) {
                for (var x = 0; x < jobsDone.length; x++) {
                    var date_created = new Date(jobsDone[x].date_created);
                    var month_created = date_created.getMonth() + 1;
                    var year_created = date_created.getFullYear();
                    if (monthNow == month_created && yearNow == year_created) {
                        curJob++;
                        curAmount += parseFloat(jobsDone[x].amount);
                    } else if (prevMonthNow == (month_created) && yearNow == year_created) {
                        prevJob++;
                        prevAmount += parseFloat(jobsDone[x].amount);
                    } else if (previousMonthNow == (month_created) && yearNow == year_created) {
                        previousJob++;
                        previousAmount += parseFloat(jobsDone[x].amount);
                    }

                    if (12 == month_created && previousYear == year_created) {
                        prevJob++;
                        prevAmount += parseFloat(jobsDone[x].amount);
                    } else if (11 == month_created && previousYear == year_created) {
                        previousJob++;
                        previousAmount += parseFloat(jobsDone[x].amount);
                    }

                }
                //console.log(previousMonthNow);

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
                                        return value.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g,
                                            ",");
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
                                        return '$' + value.toString().replace(
                                            /\B(?=(\d{3})+(?!\d))/g, ",");
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



        // fetch('<?php echo base_url('Dashboard/accounting_sales'); ?>', {}).then(response => response.json()).then(
        //     response => {
        //         var amountFirst = amountSecond = amountThird = amountFourth = amountFifth = amountSixth =
        //             amountSevent = amountEight = amountNinth = amountTenth = amountEleven = amountTwelve = 0;
        //         var {
        //             success,
        //             mmr
        //         } = response;
        //         if (mmr) {
        //             for (var x = 0; x < mmr.length; x++) {
        //                 var installDate = mmr[x].install_date;
        //                 if (installDate) {
        //                     var ins = new Date('"' + installDate + '"');

        //                     if (new Date('01/01/2022') <= ins && new Date('01/31/2022') >= ins) {
        //                         amountFirst += parseInt(mmr[x].mmr);
        //                     } else if (new Date('02/01/2022') <= ins && new Date('02/28/2022') >= ins) {
        //                         amountSecond += parseInt(mmr[x].mmr);
        //                     } else if (new Date('03/01/2022') <= ins && new Date('03/31/2022') >= ins) {
        //                         amountThird += parseInt(mmr[x].mmr);
        //                     } else if (new Date('04/01/2022') <= ins && new Date('04/30/2022') >= ins) {
        //                         amountFourth += parseInt(mmr[x].mmr);
        //                     } else if (new Date('05/01/2022') <= ins && new Date('05/31/2022') >= ins) {
        //                         amountFifth += parseInt(mmr[x].mmr);
        //                     } else if (new Date('06/01/2022') <= ins && new Date('06/30/2022') >= ins) {
        //                         amountSixth += parseInt(mmr[x].mmr);
        //                     } else if (new Date('07/01/2022') <= ins && new Date('07/31/2022') >= ins) {
        //                         amountSevent += parseInt(mmr[x].mmr);
        //                     } else if (new Date('08/01/2022') <= ins && new Date('08/31/2022') >= ins) {
        //                         amountEight += parseInt(mmr[x].mmr);
        //                     } else if (new Date('09/01/2022') <= ins && new Date('09/30/2022') >= ins) {
        //                         amountNinth += parseInt(mmr[x].mmr);
        //                     } else if (new Date('10/01/2022') <= ins && new Date('10/31/2022') >= ins) {
        //                         amountTenth += parseInt(mmr[x].mmr);
        //                     } else if (new Date('11/01/2022') <= ins && new Date('11/30/2022') >= ins) {
        //                         amountEleven += parseInt(mmr[x].mmr);
        //                     } else if (new Date('12/01/2022') <= ins && new Date('12/31/2022') >= ins) {
        //                         amountTwelve += parseInt(mmr[x].mmr);
        //                     }
        //                 }
        //             }
        //         }

        //         var sales = $('#sales_chart');
        //         const sales_labels = [
        //             'Jan 1-31', 'Feb 1-28', 'Mar 1-31', 'Apr 1-30', 'May 1-31', 'Jun 1-30', 'Jul 1-31',
        //             'Aug 1-31', 'Sep 1-30', 'Oct 1-31', 'Nov 1-30', 'Dec 1-31'
        //         ];
        //         const sales_data = {
        //             labels: sales_labels,
        //             datasets: [{
        //                 label: 'Sales',
        //                 backgroundColor: 'rgb(106, 74, 134)',
        //                 borderColor: 'rgb(106, 74, 134)',
        //                 data: [amountFirst, amountSecond, amountThird, amountFourth, amountFifth,
        //                     amountSixth, amountSevent, amountEight, amountNinth, amountTenth,
        //                     amountEleven, amountTwelve
        //                 ],

        //             }, ]
        //         };

        //         new Chart(sales, {
        //             type: 'line',
        //             data: sales_data,
        //             options: {
        //                 responsive: true,
        //                 plugins: {
        //                     legend: {
        //                         position: 'bottom',
        //                     },
        //                 },
        //                 scales: {
        //                     y: {
        //                         beginAtZero: true,
        //                         suggestedMax: 10
        //                     },
        //                 },
        //                 aspectRatio: 1.5,
        //             },
        //         });
        //     }).catch((error) => {
        //     console.log(error);
        // })

        $('#dashboard-btn-add-customer').on('click', function() {
            $('#modal-quick-add-customer').modal('show');
        });
    });
    $('#quick_links_modal .shortcut-item.print-check').on('click', function() {
        $.get(GET_OTHER_MODAL_URL + 'print_checks_modal', function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
            }

            $(`#printChecksModal select`).each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (type === 'payment-account') {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: 'printChecksModal'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#printChecksModal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#printChecksModal')
                    });
                }
            });

            if ($(`#printChecksModal .dropdown`).length > 0) {
                $(`#printChecksModal .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            $('#printChecksModal').on('hidden.bs.modal', function() {
                $('#modal-container').remove();
                $('.modal-backdrop').remove();
            });

            $('#printChecksModal').modal('show');
        });
    });

    $('#quick_links_modal .shortcut-item.receive-payment').on('click', function() {
        $.get(GET_OTHER_MODAL_URL + 'receive_payment_modal', function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
            }

            $(`#receivePaymentModal [data-bs-toggle="popover"]`).popover();

            $(`#receivePaymentModal select`).each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: 'receivePaymentModal'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#receivePaymentModal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#receivePaymentModal')
                    });
                }
            });

            if ($(`#receivePaymentModal .date`).length > 0) {
                $(`#receivePaymentModal .date`).each(function() {
                    $(this).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                });
            }

            var attachmentContId = $(`#receivePaymentModal .attachments .dropzone`).attr('id');
            modalAttachments = new Dropzone(`#${attachmentContId}`, {
                url: '/accounting/attachments/attach',
                maxFilesize: 20,
                uploadMultiple: true,
                // maxFiles: 1,
                addRemoveLinks: true,
                init: function() {
                    this.on("success", function(file, response) {
                        var ids = JSON.parse(response)['attachment_ids'];
                        var modal = $(`#receivePaymentModal`);

                        for (i in ids) {
                            if (modal.find(
                                    `input[name="attachments[]"][value="${ids[i]}"]`
                                )
                                .length === 0) {
                                modal.find('.attachments').parent().append(
                                    `<input type="hidden" name="attachments[]" value="${ids[i]}">`
                                );
                            }

                            modalAttachmentId.push(ids[i]);
                        }
                        modalAttachedFiles.push(file);
                    });
                },
                removedfile: function(file) {
                    var ids = modalAttachmentId;
                    var index = modalAttachedFiles.map(function(d, index) {
                        if (d == file) return index;
                    }).filter(isFinite)[0];

                    $(`#receivePaymentModal .attachments`).parent().find(
                        `input[name="attachments[]"][value="${ids[index]}"]`).remove();

                    if ($('#modal-container form .modal .attachments-container').length >
                        0) {
                        $('#modal-container form .modal .attachments-container #attachment-types')
                            .trigger('change');
                    }

                    //remove thumbnail
                    var previewElement;
                    return (previewElement = file.previewElement) !== null ? (previewElement
                        .parentNode.removeChild(file.previewElement)) : (void 0);
                }
            });

            if ($(`#receivePaymentModal .dropdown`).length > 0) {
                $(`#receivePaymentModal .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            $('#receivePaymentModal #invoices-container').hide();
            $('#receivePaymentModal #credits-container').hide();
            $('#receivePaymentModal #payment-summary').hide();

            $('#receivePaymentModal').modal('show');
        });
    });

    $('#quick_links_modal .shortcut-item.process-payment').on('click', function() {
        $.get(GET_OTHER_MODAL_URL + 'pay_bills_modal', function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
				<div id="modal-container"> 
					${res}
				</div>
			`);
            }

            $(`#payBillsModal [data-bs-toggle="popover"]`).popover();

            $(`#payBillsModal select`).each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: '/accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: 'payBillsModal'
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $('#payBillsModal')
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $('#payBillsModal')
                    });
                }
            });

            if ($(`#payBillsModal .date`).length > 0) {
                $(`#payBillsModal .date`).each(function() {
                    $(this).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                });
            }

            if ($(`#payBillsModal .dropdown`).length > 0) {
                $(`#payBillsModal .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            $('#payBillsModal').modal('show');
        });
    });

    $(document).on('click', '.tbl-row', function(){
        let row_id = $(this).attr('data-id');
        let row_type = $(this).attr('data-type');
        if( row_type == 'job_activities' ){
            location.href = base_url + 'job/edit/' + row_id;
        }
    });
</script>
