</div>
          <br><br>
          <div class="nsm-footer">
              <div class="row">
                  <div class="col-md-12">
                      <span class="content-subtitle">
                          <center>Copyright © 2023 nSmarTrac. All rights reserved.</center>
                      </span>
                  </div>
              </div>
          </div>
          </div>
          </div>
          </div>

          <div class="modal fade nsm-modal fade" id="hdr_multi_account_loading_modal"
              aria-labelledby="hdr_multi_account_loading_modal_label" aria-hidden="true" style="margin-top:10%;">
              <div class="modal-dialog modal-md">
                  <div class="modal-content">
                      <div class="modal-body"></div>
                  </div>
              </div>
          </div>
          <!-- DataTables -->
          <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
          <!-- <script src="<?php echo $url->assets; ?>plugins/datatables.net/export/dataTables.buttons.min.js"> -->

          <script src="<?php echo base_url('assets/plugins/datatables.net/export/dataTables.buttons.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/datatables.net/export/buttons.bootstrap.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/datatables.net/export/jszip.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/datatables.net/export/pdfmake.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/datatables.net/export/vfs_fonts.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/datatables.net/export/buttons.html5.min.js'); ?>"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
          <!-- Validate  -->
          <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/jquery.validate.min.js'); ?>"></script>
          <script src="<?php echo base_url('assets/plugins/bootstrap-treeview/bootstrap-treeview.js'); ?>"></script>
          <!-- Chart JS -->
          <script src="<?php echo base_url('assets/js/v2/chart.min.js'); ?>"></script>
          <!-- Boostrap JS -->
          <script src="<?php echo base_url('assets/js/v2/bootstrap.bundle.min.js'); ?>" crossorigin="anonymous">
          </script>
          <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
          <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.js">
          </script>


          <!-- Timepicker -->
          <script src="<?php echo base_url('assets/plugins/jquery-timepicker/jquery.timepicker.min.js'); ?>"></script>
          <!-- Custom JS -->
          <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
          <!-- Sweetalert JS -->
          <script src="<?php echo base_url('assets/js/v2/sweetalert2.min.js'); ?>"></script>          
          <!-- Datepicker -->
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/bootstrap-datepicker.min.js'); ?>">
          </script>
          <!-- TagsInput -->
          <script type="text/javascript"
              src="<?php echo base_url('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js'); ?>">
          </script>
          <!-- Datetimepicker -->
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/moment.min.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/bootstrap-datetimepicker.min.js'); ?>">
          </script>
          <!-- Sidebar counbter -->
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/sidebar-counter.js'); ?>"></script>
          <!-- Select2 -->
          <script src="<?php echo base_url('assets/plugins/select2/dist/js/select2.full.min.js'); ?>"></script>
          <!-- Input Mask -->
          <?php if (isset($enable_input_mask)) { ?>
          <script src="<?php echo base_url('assets/plugins/inputmask/dist/jquery.inputmask.bundle.js'); ?>"></script>
          <?php } ?>
          <!-- Twilio Call -->
          <?php if (isset($enable_twilio_call)) { ?>
          <script src="<?php echo base_url('assets/js/twilio.min.js'); ?>"></script>
          <?php } ?>

          <?php if (isset($enable_ringcentral_call)) { ?>
          <script type="text/javascript" src="//cdn.jsdelivr.net/es6-promise/3.1.2/es6-promise.js"></script>
          <script type="text/javascript" src="//cdn.pubnub.com/sdk/javascript/pubnub.4.4.2.js"></script>
          <script type="text/javascript" src="//cdn.rawgit.com/onsip/SIP.js/0.7.7/dist/sip-0.7.7.js"></script>
          <script type="text/javascript" src="//cdn.rawgit.com/ringcentral/ringcentral-js/3.1.0/build/ringcentral.js">
          </script>
          <script src="<?php echo base_url('assets/js/ringcentral/ringcentral-web-phone.js'); ?>"></script>
          <?php } ?>

          <?php if (isset($enable_tracklocation)) { ?>
          <script src="<?php echo $url->assets; ?>js/timesheet/tracklocation.js"></script>
          <?php } ?>

          <?php if (isset($enable_popper_tooltip)) { ?>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <?php } ?>

          <!-- Switchery -->
          <script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js'); ?>"></script>

          <!-- Ckeditor -->
          <script type="text/javascript" src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

          <!-- Multiselect -->
          <script src="<?php echo base_url('assets/js/v2/multiple-select.min.js'); ?>"></script>

          <!-- FullCalendar -->
          <!-- <script src="<?php echo base_url('assets/js/v2/full-calendar-main.js'); ?>"></script> -->

          <!-- Fancybox -->
          <script src="<?php echo base_url('assets/js/v2/fancybox.umd.js'); ?>"></script>

          <!-- Switchery -->
          <!-- <script src="<?php echo $url->assets; ?>plugins/switchery/switchery.min.js"></script> -->

          <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
          <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

          <!-- Main Script -->
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/main.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/nsm.draggable.js'); ?>"></script>
          <script type="text/javascript" src="<?php echo base_url('assets/js/v2/nsm.table.js'); ?>"></script>
          <?php if (!$disable_clockjs) { ?>
          <script src="<?php echo base_url('assets/js/timesheet/clock.js');?>"></script>
          <?php } ?>

          <script type="text/javascript">
var notification_badge_value = 0;
var current_user_company_id = <?php echo logged('company_id'); ?>;
var all_notifications_html = '';
var notification_badge_value = 0;
var notification_html_holder_ctr = 0;

$(document).ready(function() {

    getNotificationsAll();

    $(".check-input-rules").click(function() {
        var count_rule_list_check = $('.check-input-rules').filter(':checked').length;
        if (count_rule_list_check > 0) {
            $(".dropdown-item-delete-rule").removeClass("disabled");
        } else {
            $('.dropdown-item-delete-rule').addClass('disabled');
        }
    })

    $(".select-all-rules").click(function() {
        if (this.checked) {
            $('.check-input-rules').each(function() {
                this.checked = true;
            });
            $(".dropdown-item-delete-rule").removeClass("disabled");
        } else {
            $('.check-input-rules').each(function() {
                this.checked = false;
            });
            $('.dropdown-item-delete-rule').addClass('disabled');
        }
    });

    $(".check-input-expenses").click(function() {
        var count_expenses_list_check = $('.check-input-expenses').filter(':checked').length;
        if (count_expenses_list_check > 0) {
            $(".dropdown-item-print-transaction").removeClass("disabled");
            $(".dropdown-item-categorize-selected").removeClass("disabled");
            $(".dropdown-item-delete-expenses").removeClass("disabled");
        } else {
            $(".dropdown-item-print-transaction").addClass("disabled");
            $(".dropdown-item-categorize-selected").addClass("disabled");
            $(".dropdown-item-delete-expenses").addClass("disabled");
        }
    })

    $(".check-input-all-expenses").click(function() {
        if (this.checked) {
            $('.check-input-expenses').each(function() {
                this.checked = true;
            });
            $(".dropdown-item-print-transaction").removeClass("disabled");
            $(".dropdown-item-categorize-selected").removeClass("disabled");
            $(".dropdown-item-delete-expenses").removeClass("disabled");
        } else {
            $('.check-input-expenses').each(function() {
                this.checked = false;
            });
            $(".dropdown-item-print-transaction").addClass("disabled");
            $(".dropdown-item-categorize-selected").addClass("disabled");
            $(".dropdown-item-delete-expenses").addClass("disabled");
        }
    });

    $(".check-input-all-customers").click(function() {
        if (this.checked) {
            $('.check-input-customers').each(function() {
                this.checked = true;
            });
        } else {
            $('.check-input-customers').each(function() {
                this.checked = false;
            });
        }
    });

    $(".check-input-all-tasks").click(function() {
        if (this.checked) {
            $('.check-input-task').each(function() {
                this.checked = true;
            });
            $(".dropdown-item-mark-complete").removeClass("disabled");
            $(".dropdown-item-delete").removeClass("disabled");
            $(".dropdown-item-mark-ongoing").removeClass("disabled");
        } else {
            $('.check-input-task').each(function() {
                this.checked = false;
            });
            $('.dropdown-item-mark-complete').addClass('disabled');
            $('.dropdown-item-mark-ongoing').addClass('disabled');
            $('.dropdown-item-delete').addClass('disabled');
        }
    });

    $(".check-input-task").click(function() {
        var count_task_list_check = $('.check-input-task').filter(':checked').length;
        if (count_task_list_check > 0) {
            $(".dropdown-item-mark-complete").removeClass("disabled");
            $(".dropdown-item-delete").removeClass("disabled");
            $(".dropdown-item-mark-ongoing").removeClass("disabled");
        } else {
            $('.dropdown-item-mark-complete').addClass('disabled');
            $('.dropdown-item-delete').addClass('disabled');
            $('.dropdown-item-mark-ongoing').addClass('disabled');
        }

        $('.check-input-all-tasks').each(function() {
            this.checked = false;
        });
    })


    $('.hdr-drpdown-multi-accounts').on('click', function() {
        var parent = $(this).closest('li');
        if (parent.hasClass('shown')) {
            load_company_multi_account_list();
        } else {
            $('#hdr-multi-account-list').html('');
        }
    });

    $(document).on('submit', '#sidebar-add-multi-account-form', function(e) {
        e.preventDefault();

        var url = base_url + 'mycrm/_add_multi_account';
        var form = $(this);

        $.ajax({
            type: "POST",
            url: url,
            dataType: 'json',
            data: form.serialize(),
            success: function(data) {

                $('#btn-sidebar-add-multi-account').html('Save');
                $('#btn-sidebar-add-multi-account').prop("disabled", false);

                if (data.is_success == 1) {
                    $('#sidebar-modal-add-multi-account').modal('hide');
                    $('#sidebar-multi-email').val('');
                    $('#sidebar-multi-password').val('');

                    Swal.fire({
                        html: 'An email was sent to <b>' + data.email +
                            '</b> to activate and verify account.',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        //load_company_multi_account_list();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
            },
            beforeSend: function() {
                $('#btn-sidebar-add-multi-account').html(
                    '<span class="bx bx-loader bx-spin"></span>');
                //$('#btn-add-multi-account').find("button[type=submit]").prop("disabled", true);    
            }
        });
    });

    function load_company_multi_account_list() {
        var url = base_url + "mycrm/_hdr_load_multi_account_list";
        showLoader($("#hdr-multi-account-list"));

        setTimeout(function() {
            $.ajax({
                type: "GET",
                url: url,
                success: function(o) {
                    $("#hdr-multi-account-list").html(o);
                }
            });
        }, 500);
    }

    $('#manage_widgets_modal').on('show.bs.modal', function() {
        $.ajax({
            url: '<?php echo base_url(); ?>dashboard/getWidgetList',
            method: 'get',
            data: {},
            success: function(response) {
                $('#add_widget_container').html(response);
            }
        });

        $.ajax({
            url: '<?php echo base_url(); ?>dashboard/getThumbnailsList',
            method: 'get',
            data: {},
            success: function(response) {
                $('#add_thumbnail_container').html(response);
            }
        });
    });

    var offset = new Date().getTimezoneOffset();
    var offset_zone = (offset / 60) * (-1);
    if (offset_zone >= 0) {
        offset_zone = "+" + offset_zone;
    }
    $.ajax({
        url: "<?php echo base_url(); ?>/timesheet/timezonesetter",
        type: "POST",
        dataType: "json",
        data: {
            usertimezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
            offset_zone: "GMT" + offset_zone
        },
        success: function(data) {}
    });

    var pusher = new Pusher('f3c73bc6ff54c5404cc8', {
        cluster: 'ap1'
    });

    var channelUnAuthorizeLogin = pusher.subscribe('nsmarttrac-unauthorize-login');
    channelUnAuthorizeLogin.bind('force-logout-user', function(data) {
        location.href = base_url + '/logout';
    });

    var channel = pusher.subscribe('nsmarttrac');
    channel.bind('my-event', function(data) {

        // console.log(data.user_id);
        if (data.notif_action_made == "over8less9") {
            if (data.user_id == user_id) {
                notificationRing();
                Push.Permission.GRANTED;
                Push.create("Hey! " + data.FName, {
                    body: "It's time for you to clock out. Do you still need more time?",
                    icon: data.profile_img,
                    timeout: 20000,
                    onClick: function() {
                        window.focus();
                        this.close();
                    }
                });
            }
        } else {

            if (data.user_id != user_id && data.company_id == current_user_company_id) {
                notificationRing();
                Push.Permission.GRANTED; // 'granted'
                Push.create(data.FName + " " + data.LName, {
                    body: data.content_notification,
                    icon: data.profile_img,
                    timeout: 20000,
                    onClick: function() {
                        window.focus();
                        this.close();
                    }
                });
            }
            if (data.notif_action_made != "Lunchin" && data.notif_action_made != "Lunchout" && data
                .company_id == current_user_company_id) {
                notification_badge_value++;
                $('#notifyBadge').html(notification_badge_value);
                $('#notifyBadge').show();
                var current_notifs = $('#autoNotifications').html();
                $('#autoNotifications').html(data.html + current_notifs);
            }
            if (data.notif_action_made == "autoclockout") {
                if (data.user_id == user_id) {
                    notificationRing();
                    Push.Permission.GRANTED;
                    Push.create("Hey! " + data.FName + " you have been auto clocked out.", {
                        body: "We haven't heard from you since the last time clock notification.",
                        icon: data.profile_img,
                        timeout: 20000,
                        onClick: function() {
                            window.focus();
                            this.close();
                        }
                    });
                }
            }
        }

        function bell_acknowledged() {
            // $('#notifyBadge').hide();
            if (notification_badge_value > 0) {
                notification_badge_value = 0;
                $.ajax({
                    url: baseURL + '/timesheet/notif_user_acknowledge',
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log("Bell Acknowledged");
                    }
                });
            }
        }

    });
});

function getNotificationsAll() {
    $.ajax({
        url: baseURL + "/Timesheet/getV2NotificationsAll",
        type: "POST",
        dataType: "json",
        data: {
            badgeCount: notification_badge_value
        },
        success: function(data) {
            if (data.notifyCount > 0) {
                $('#notifications_container').html(data.autoNotifications);
                notification_badge_value = data.badgeCount;
            }
        }
    });
}

// function notificationClockInOut(){
//     $.ajax({
//         url: baseURL + "Timesheet/getCount_NotificationsAll",
//         type: "POST",
//         dataType: "json",
//         data: {
//             notifycount: notification_badge_value
//         },
//         success: function(data) {
//             if (notification_badge_value != data.badgeCount) {
//                 notification_badge_value = data.badgeCount;
//                 getNotificationsAll();
//             }
//             if (data.notifyCount < 1) {
//                 $('#notifications_container').html('<div class="text-center py-3"><span class="content-subtitle">No notifications for now.</span></div>');
//             }
//         }
//     });
// }

function sendFeed() {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>/dashboard/sendFeed",
        dataType: 'json',
        data: {
            subject: $('#feedSubject').val(),
            message: $('#feedMessage').val()
        },
        success: function(data) {
            $('#new_feed_modal').modal('hide');
            if (data.success) {
                notifyUser('Nice!', data.msg, 'success');
            }
        }
    });
}

function sendNewsLetter() {
    var _modal = $("#news_letter_modal");
    var _sendBtn = _modal.find(".nsm-button.primary");
    var file = _modal.find("#file")[0].files[0];

    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append('news', _modal.find('#news').val());

    _sendBtn.prop("disabled", true);
    _sendBtn.html("Sending...");

    $.ajax({
        url: '<?php echo base_url(); ?>newsletter/saveNewsBulletin',
        method: 'POST',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.success) {
                notifyUser('Nice!', response.msg, 'success');
            }
            $('#news_letter_modal').modal('hide');
            _sendBtn.prop("disabled", false);
            _sendBtn.html("Send Newsletter");
        }
    });
}

function notifyUser(title, text, icon, location = null) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            if (location === "reload") {
                window.location.reload(true);
            } else if (location !== null && location !== "") {
                window.location.href = '<?php echo base_url(); ?>' + location;
            }
        }
    });
}

function manipulateWidget(dis, id) {
    if ($(dis).is(":checked")) {
        addWidget(id);
    } else {
        removeWidget(id);
    }
}

function manipulateShowGraph(dis, id) {
    if ($(dis).is(":checked")) {
        $(`#thumbnail_content_graph_${id}, .graphData_${id}`).show();
        $(`#thumbnail_content_list${id}, .textData_${id}`).hide();
        updateListView(id, 1);
    } else {
        $(`#thumbnail_content_graph_${id}, .graphData_${id}`).hide();
        $(`#thumbnail_content_list${id}, .textData_${id}`).show();
        updateListView(id, 0);
    }
}

function fetchGraphs(thumbnail) {
    switch (thumbnail) {
        case 'widgets/collections_counter':
            collectionGraphThumbnail()
            break
        case 'widgets/pastdue_invoices_counter':
            pastDueGraphThumbnail()
            break
        case 'widgets/income_counter':
            incomeGraphThumbnail()
            break
        case 'widgets/customer_counter':
            customerGroupsGraphThumbnail()
            break
        case 'widgets/sales_counter':
            salesGraphThumbnail()
            break
        case 'widgets/estimate_counter':
            estimateGraphThumbnail()
            break
        case 'widgets/jobs_counter':
            jobsGraphThumbnail()
            break
        case 'widgets/unpaid_invoices_counter':
            unpaidInvoicesGraphThumbnail()
            break
        case 'widgets/new_leads_counter':
            newLeadsGraphThumbnail()
            break
        case 'widgets/open_invoices_counter':
            openInvoicesGraphThumbnail()
            break
        case 'widgets/accounting_expense_counter':
            accountingExpenseGraphThumbnail()
            break
        default:
            return;
    }
}

function fetchCount(thumbnail) {
    switch (thumbnail) {
        case 'widgets/coupon_code_counter':
            var from_date = '0000-00-00  00:00:00';
            var to_date   = '2024-12-11';
            var table     = 'coupon_codes';
            var id        = 52;
            var filter    = '';
            loadDataFilter(from_date, to_date, table, id,filter);
            break        
        case 'widgets/nsmart_companies_counter':
            var from_date = '0000-00-00  00:00:00';
            var to_date   = '2024-12-11';
            var table     = 'nsmart_companies';
            var id        = 53;
            var filter    = '';
            loadDataFilter(from_date, to_date, table, id,filter);
            break        
        default:
            return;
    }
}

function updateListView(id, val) {
    $.ajax({
        url: base_url + 'dashboard/updateListView',
        method: 'post',
        data: {
            id: id,
            val: val,
        },
        success: function(response) {

            console.log('response', response)
            // var data = JSON.parse(response);
            // $(`#first_content_${id}`).html(data['first']);
            // $(`#second_content_${id}`).html(data['second']);
        }
    });
}

function filterAccountingExpenseCategory(selectedCategory) {
    fetch('<?php echo base_url('Dashboard/accounting_expense'); ?>', {}).then(response => response.json()).then(
        response => {
            var {
                accounting_expense
            } = response;
            let filteredCategories = [];
            let filteredData = [];
            let filteredTotal = 0;

            if (accounting_expense) {
                for (var x = 0; x < accounting_expense.length; x++) {
                    if (accounting_expense[x].category && accounting_expense[x].category.name) {
                        if (selectedCategory == "" || accounting_expense[x].category.name ===
                            selectedCategory) {
                            filteredCategories.push(accounting_expense[x].category.name);
                            filteredData.push(accounting_expense[x].total);
                            filteredTotal += parseInt(accounting_expense[x].total);
                        }
                    }
                }
            }

            // Update the chart with filtered data
            renderAccountingExpenseGraph(filteredCategories, filteredData);

            $(".total_expense_graph_total").html('$ ' + filteredTotal.toLocaleString(undefined, {minimumFractionDigits: 2}));
            $("#total_expense_graph").html('$' + filteredTotal.toLocaleString(undefined, {minimumFractionDigits: 2}));
        }
    ).catch((error) => {
        console.log(error);
    });

}


function filterSubscription(){
    let selectedDateRange = $('.filterSubscriptionDate').val();
    let selectedDataId = $('.filterSubscriptionDate').attr('data-id');
    let selectedStatus = $('.filterSubscriptionStatus').val();
    filterThumbnail(selectedDateRange, selectedDataId, 'acs_billing',selectedStatus)
};


function filterSubscriptionStatus(status) {
    // Encode the status to ensure it handles spaces and special characters properly
    const encodedStatus = encodeURIComponent(status);

    fetch(`<?php echo base_url('Dashboard/income_subscription_filter_status?status='); ?>${encodedStatus}`, {
    }).then(response => response.json()).then(response => {
        var monthlyAmounts = new Array(12).fill(0);
        var subscriptionTotal = 0;

        var {
            success,
            mmr
        } = response;

        //console.log('mmr.length',mmr.length)

        if (mmr) {
            for (var x = 0; x < mmr.length; x++) {
                var installDate = mmr[x].bill_end_date;
                var ins = new Date(installDate);
                var month = ins.getMonth();
                monthlyAmounts[month] += parseFloat(mmr[x].mmr);
                subscriptionTotal += parseFloat(mmr[x].mmr);
            }
        }

        subscriptionChart.data.datasets[0].data = monthlyAmounts;
        subscriptionChart.update();

        $(`.subscription-text`).html(subscriptionTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));



    }).catch((error) => {
        console.log(error);
    });
}

function renderAccountingExpenseGraph(labels, data) {
    var new_leads_data = {
        labels: labels,
        datasets: [{
            label: 'Total leads',
            data: data,
            backgroundColor: [
                'rgb(106 74 134)',
                'rgb(199 149 28)',
                'rgb(64 136 84)',
                'rgb(220 53 69)',
                'rgb(206, 128, 255)'
            ],
        }]
    };

    $('#AccountingExpenseGraphLoader').hide();

    if (window.AccountingExpenseGraph) {
        window.AccountingExpenseGraph.destroy(); // Destroy the previous chart instance
    }

    window.AccountingExpenseGraph = new Chart($('#AccountingExpenseGraph'), {
        type: 'doughnut',
        data: new_leads_data,
        options: {
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                    }
                },
            },
            layout: {
                padding: {
                    left: 5,
                    right: 5,
                    top: 0,
                }
            },
        },
    });
}

function handleHideCurrentSub(isShow){

    if(isShow){
        $('.plus_text').show();
    }else{
        $('.plus_text').hide();
    }
    

}

function filterThumbnail(val, id, table,filter) {
    var date = new Date();
    handleHideCurrentSub(true);
    switch (val) {
        case 'all':
            var from_date = '0000-00-00  00:00:00';
            if(table == 'acs_billing' || table == 'collection'|| table == 'nsmart_sales'){
                var to_date = '0000-00-00 23:59:59';
            }else{
                var to_date = "<?php echo date('Y-m-d'); ?>";
            }
     

            // var to_date = '0000-00-00';

            if (table == 'accounting_expense') {
                var pastDate = new Date();
                pastDate.setDate(pastDate.getDate() - 365);
                from_date = pastDate.getFullYear() + '-' + ('0' + (pastDate.getMonth() + 1)).slice(-2) + '-' + ('0' +
                    pastDate.getDate()).slice(-2);
            }

            break;
            case 'week':
                if (table == 'acs_billing') {
                    handleHideCurrentSub(false);
                }

                var today = new Date();
                var from_date_temp = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 6); // 7 days interval

                // Formatting from_date
                var from_month = ('0' + (from_date_temp.getMonth() + 1)).slice(-2);
                var from_day = ('0' + from_date_temp.getDate()).slice(-2);
                var from_year = from_date_temp.getFullYear();
                var from_date = from_year + '-' + from_month + '-' + from_day + ' 00:00:00'; // Start of 7-day interval

                // Formatting to_date
                var to_month = ('0' + (today.getMonth() + 1)).slice(-2);
                var to_day = ('0' + today.getDate()).slice(-2);
                var to_year = today.getFullYear();
                var to_date = to_year + '-' + to_month + '-' + to_day + ' 23:59:59'; // End of today

                break;



        case 'two-week':
            if (table == 'acs_billing') {
                handleHideCurrentSub(false);
            }

            var endDate = new Date();
            var startDate = new Date(endDate);
            startDate.setDate(startDate.getDate() - 13);

            // Formatting from_date with time starting at 00:00:00
            var from_date = startDate.getFullYear() + '-' + 
                            String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(startDate.getDate()).padStart(2, '0') + 
                            ' 00:00:00';

            // Formatting to_date with time ending at 23:59:59
            var to_date = endDate.getFullYear() + '-' + 
                        String(endDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(endDate.getDate()).padStart(2, '0') + 
                        ' 23:59:59';

            break;

        case 'month':
            if (table == 'acs_billing') {
                handleHideCurrentSub(false);
            }

            var endDate = new Date();
            var startDate = new Date(endDate);

            // Set start date to 29 days before the end date
            startDate.setDate(startDate.getDate() - 29);

            // Formatting from_date with time starting at 00:00:00
            var from_date = startDate.getFullYear() + '-' + 
                            String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(startDate.getDate()).padStart(2, '0') + 
                            ' 00:00:00';

            // Formatting to_date with time ending at 23:59:59
            var to_date = endDate.getFullYear() + '-' + 
                        String(endDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(endDate.getDate()).padStart(2, '0') + 
                        ' 23:59:59';

            break;

        case 'two-month':
            if (table == 'acs_billing') {
                handleHideCurrentSub(false);
            }

            var endDate = new Date();
            var startDate = new Date(endDate);
            startDate.setDate(startDate.getDate() - 59);

            // Formatting from_date with time starting at 00:00:00
            var from_date = startDate.getFullYear() + '-' + 
                            String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(startDate.getDate()).padStart(2, '0') + 
                            ' 00:00:00';

            // Formatting to_date with time ending at 23:59:59
            var to_date = endDate.getFullYear() + '-' + 
                            String(endDate.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(endDate.getDate()).padStart(2, '0') + 
                            ' 23:59:59';

            break;
        case 'this-year':
            if (table == 'acs_billing') {
                handleHideCurrentSub(false);
            }

            // Set startDate to January 1st of the current year
            var startDate = new Date(new Date().getFullYear(), 0, 1);

            // Set endDate to December 31st of the current year
            var endDate = new Date(new Date().getFullYear(), 11, 31); 

            var from_date = startDate.getFullYear() + '-' + 
                            String(startDate.getMonth() + 1).padStart(2, '0') + '-' + 
                            String(startDate.getDate()).padStart(2, '0') + 
                            ' 00:00:00';

            var to_date = endDate.getFullYear() + '-' + 
                        String(endDate.getMonth() + 1).padStart(2, '0') + '-' + 
                        String(endDate.getDate()).padStart(2, '0') + 
                        ' 23:59:59';

            break;



        default:
            var from_date = '';
            var to_date = '';
            break;

    }
    if (table == 'jobs') {
        $('.jobs_count_thumbnail').html('<span class="bx bx-loader bx-spin"></span>')
    }

    if (table == 'accounting_expense') {
        $('#AccountingExpenseGraphLoader').show();
    }
    loadDataFilter(from_date, to_date, table, id,filter);

}

function loadDataFilter(from_date, to_date, table, id, filter) {
    $.ajax({
        url: base_url + 'dashboard/loadFilterData',
        method: 'post',
        data: {
            table: table,
            from_date: from_date,
            to_date: to_date,
            id: id,
            filter: filter,
        },
        success: function(response) {
            var data = JSON.parse(response);
            $(`#first_content_${id}, #first_estimate_content_${id}`).html(data['first']);
            $(`#second_content_${id}, #second_estimate_content_${id}`).html(data['second']);

            if (table == 'acs_billing') {
                // window.subscriptionChart.destroy();
                filterSubsciptionThumbnailGraph(data['mmr'])
            }

            if (table == 'estimates') {
                filterEstimateThumbnailGraph(data['first'], data['second'])
            }

            if (table == 'invoices') {
                $(`#second_content_${id}`).html("$ " + data['second']);
                filterPastDueThumbnailGraph(data['past_due'])
            }

            if (table == 'nsmart_sales') {
                $(`#second_content_${id}`).html("$ " + data['second']);
                filterNsmartSalesGraph(data['nsmart_sales'])
            }

            if (table == 'open_invoices') {
                filterOpenInvoicesThumbnailGraph(data['open_invoices'])
            }

            if (table == 'sales') {
                $(`#first_content_${id}`).html('$ ' + data['first']);
                filterSalesThumbnailGraph(data['sales'])
            }

            if (table == 'ac_leads') {
                filterLeadsThumbnailGraph(data['total_leads'])
            }

            if (table == 'accounting_expense') {
                filterAccountingExpenseThumbnailGraph(data['accounting_expense'])
            }

            if (table == 'acs_profile') {
                filterCustomerThumbnailGraph(data['customer']);
            }

            if (table == 'collection') {
                var income = data['collection'];
                var totalIncome = 0;
                for (var x = 0; x < income.length; x++) {
                    totalIncome += parseFloat(income[x].grand_total);
                }

                $(`#first_content_${id}`).html('$ ' + totalIncome.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }));

                filterCollectionThumbnailGraph(data['collection'])
            }

            if (table == 'esign') {
                filterEsignThumbnailGraph(data['esign'])
            }

            if (table == 'jobs') {
                filterJobsThumbnailGraph(data['jobs'])
            }

            if (table == 'unpaid_invoices') {
                var unpaid_invoices = data['unpaid'];
                var totalUnpaid = 0;
                for (var x = 0; x < unpaid_invoices.length; x++) {
                    var total_amount_paid = unpaid_invoices[x].total_amount_paid ? unpaid_invoices[x]
                        .total_amount_paid : 0

                    totalUnpaid += parseFloat(unpaid_invoices[x].grand_total -
                        total_amount_paid);
                }

                //$(`#first_content_${id}`).html(totalUnpaid.toFixed(2));
                $(`#first_content_${id}`).html("$ " + totalUnpaid.toFixed(2));

                filterUnpaidInvoicesThumbnailGraph(data['unpaid'])
            }

            if (table == 'income') {
                var income = data['income'];
                var totalIncome = 0;
                for (var x = 0; x < income.length; x++) {
                    totalIncome += parseFloat(income[x].grand_total);
                }

                $(`#first_content_${id}`).html('$ ' + totalIncome.toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }));

                filterIncomeThumbnailGraph(data['income'])
            }

            if (table == 'coupon_codes') {
                $(`#first_content_${id}`).html(data['first']);
                $(`#second_content_${id}`).html(data['second']);
            }

            if (table == 'nsmart_companies') {
                $(`#first_content_${id}`).html(data['first']);
            }
        }
    });
}

function filterEsignThumbnailGraph(esign) {
    //console.log('goes here')
    var output = '';
    if (esign.length > 0) {
        $.each(esign, function(index, data) {
            output += "<div class='col'>";
            output +=   "<div class='text-center p-2'>";
            output +=       "<strong class='text-muted text-uppercase'>"+htmlspecialchars(data.status)+"</strong>";
            output +=       "<h2 class='mb-0'>"+htmlspecialchars(data.status_count)+"</h2>";
            output +=   "</div>";
            output += "</div>";
        });
    } else {
        output = '';
        output += "<div class='col'>";
        output +=   "<div class='text-center p-2'>";
        output +=       "<strong class='text-muted text-uppercase'>NO AVAILABLE DATA</strong>";
        output +=   "</div>";
        output += "</div>";
    }
    $('.esignContent').html(output);
}

function htmlspecialchars(str) {
    return str.replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function filterIncomeThumbnailGraph(income) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var monthlyAmounts = new Array(month_index).fill(0);

    for (var x = 0; x < income.length; x++) {
        var insA = new Date(income[x].date_created);

        if( insA.getFullYear() < currentDate.getFullYear() ){    
            var installDate = '2024-01-01';
        }else if( insA > currentDate ){        
            var installDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var installDate = income[x].date_created;
        }

        if (installDate) {
        var ins = new Date(installDate);
        var month = ins.getMonth();             
    
        if( isNaN(parseFloat(income[x].grand_total)) ){
            monthlyAmounts[month] += 0;
        }else{
            monthlyAmounts[month] += parseFloat(income[x].grand_total);
        }
        }
  
    }
    var start = 0;
    var prev_amount = 0;
    for (i = 0; i < monthlyAmounts.length; ++i) {
        if( start == 0 ){
            var amount = monthlyAmounts[i];
        }else{
            var amount = monthlyAmounts[i] + prev_amount;
        }

        prev_amount = amount;
        monthlyAmounts[i] = amount;                
        start++;
    }

    IncomeThumbnailGraph.data.datasets[0].data = monthlyAmounts;
    IncomeThumbnailGraph.update();
}

function filterUnpaidInvoicesThumbnailGraph(sales) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var amountsByMonth = new Array(month_index).fill(0);

    for (var x = 0; x < sales.length; x++) {
        var dateCreated = new Date(sales[x].date_created);
        if( dateCreated.getFullYear() < currentDate.getFullYear() ){    
            var dueDate = '2024-01-01';
        }else if( dateCreated > currentDate ){        
            var dueDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var dueDate = sales[x].date_created;
        }
        
        //var dueDate = sales[x].due_date;
        if (dueDate) {
            var due = new Date(dueDate);
            var month = due.getMonth();

            amountsByMonth[month] += parseFloat(sales[x].grand_total);
        }

        var start = 0;
        var prev_amount = 0;
        for (i = 0; i < amountsByMonth.length; ++i) {
            if( start == 0 ){
                var amount = amountsByMonth[i];
            }else{
                var amount = amountsByMonth[i] + prev_amount;
            }

            prev_amount = amount;
            amountsByMonth[i] = amount;                
            start++;
        }
    }

    UnpaidInvoicesWidgetsGraph.data.datasets[0].data = amountsByMonth;
    UnpaidInvoicesWidgetsGraph.update();
}

function filterJobsThumbnailGraph(jobs) {

    var amountsByMonth = new Array(12).fill(0);

    for (var x = 0; x < jobs.length; x++) {
        var date_created = jobs[x].date_created;
        if (date_created) {
            var due = new Date(date_created);
            var month = due.getMonth();

            amountsByMonth[month] += 1;
        }
    }

    JobsThumbnailGraph.data.datasets[0].data = amountsByMonth;
    JobsThumbnailGraph.update();

}

function filterCollectionThumbnailGraph(collection) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var monthlyAmounts = new Array(month_index).fill(0);

    for (var x = 0; x < collection.length; x++) {
        var insA          = new Date(collection[x].date_created);
        if( insA.getFullYear() < currentDate.getFullYear() ){    
            var installDate = '2024-01-01';
        }else if( insA > currentDate ){        
            var installDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var installDate = collection[x].date_created;
        }

        if (installDate) {
            var ins = new Date(installDate);
            var month = ins.getMonth();             

            if( isNaN(parseFloat(collection[x].grand_total)) ){
                monthlyAmounts[month] += 0;
            }else{
                monthlyAmounts[month] += parseFloat(collection[x].grand_total);
            }
        }
    }

    var start = 0;
    var prev_amount = 0;
    for (i = 0; i < monthlyAmounts.length; ++i) {
        if( start == 0 ){
            var amount = monthlyAmounts[i];
        }else{
            var amount = monthlyAmounts[i] + prev_amount;
        }

        prev_amount = amount;
        monthlyAmounts[i] = amount;                
        start++;
    }


    collectionGraph.data.datasets[0].data = monthlyAmounts;
    collectionGraph.update();
}


function filterCustomerThumbnailGraph(customer) {
    let totalCustomer = 0;
    let dataTemp = [];
    let labelsTemp = [];

    if (customer) {
        for (var x = 0; x < customer.length; x++) {
            labelsTemp.push(customer[x].title);
            dataTemp.push(customer[x].total_customer);
            totalCustomer += parseInt(customer[x].total_customer);
        }
    }

    $(".recent-customer-container-count").html(totalCustomer);
    $("#total_customer_graph").html(labelsTemp.length);
    NewCustomerWidgetsGraph.data.labels = labelsTemp;
    NewCustomerWidgetsGraph.data.datasets[0].data = dataTemp;
    NewCustomerWidgetsGraph.update();
}

function filterAccountingExpenseThumbnailGraph(accounting_expense) {

    let expenseCategory = [];
    let dataTemp = [];
    let total_expense = 0;

    if (accounting_expense) {
        for (var x = 0; x < accounting_expense.length; x++) {
            if (accounting_expense[x].category) {
                expenseCategory.push(accounting_expense[x].category.name)
                dataTemp.push(accounting_expense[x].total)
                total_expense += parseInt(accounting_expense[x].total)
            }
        }
    }

    $(".total_expense_graph_total").html('$ ' + total_expense.toLocaleString(undefined, {minimumFractionDigits: 2}));
    $("#total_expense_graph").html('$' + total_expense.toLocaleString(undefined, {minimumFractionDigits: 2}));
    $('#AccountingExpenseGraphLoader').hide();
    AccountingExpenseGraph.data.labels = expenseCategory;
    AccountingExpenseGraph.data.datasets[0].data = dataTemp;
    AccountingExpenseGraph.update();




}

function filterLeadsThumbnailGraph(leads) {
    let labelsTemp = [];
    let dataTemp = [];
    let totalLeads = 0;

    if (leads.length > 0) {
        for (var x = 0; x < leads.length; x++) {
            labelsTemp.push(leads[x].lead_name)
            dataTemp.push(leads[x].total_leads)
            totalLeads += parseInt(leads[x].total_leads)
        }
        NewLeadsWidgetsGraph.data.labels = labelsTemp;
        NewLeadsWidgetsGraph.data.datasets[0].data = dataTemp;
        NewLeadsWidgetsGraph.update();
    } else {
        NewLeadsWidgetsGraph.data.datasets[0].data = null;
        NewLeadsWidgetsGraph.update();
    }

    $(".total_leads_graph_total").html(totalLeads);
    $("#total_leads_graph").html(totalLeads);

}

function filterSalesThumbnailGraph(sales) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var amountsByMonth = new Array(month_index).fill(0);

    for (var x = 0; x < sales.length; x++) {
        var dateA = new Date(sales[x].due_date);
        if( dateA.getFullYear() < currentDate.getFullYear() ){    
            var dueDate = '2024-01-01';
        }else if( dateA > currentDate ){        
            var dueDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var dueDate = sales[x].due_date;
        }
        
        if (dueDate) {
            var due = new Date(dueDate);
            var month = due.getMonth();

            amountsByMonth[month] += parseFloat(sales[x].grand_total);
        }
    }

    SalesWidgetsGraph.data.datasets[0].data = amountsByMonth;
    SalesWidgetsGraph.update();
}

function filterOpenInvoicesThumbnailGraph(open_invoices) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var monthlyAmounts = new Array(month_index).fill(0);

    if (open_invoices) {
        for (var x = 0; x < open_invoices.length; x++) {
            var insA          = new Date(open_invoices[x].date_created);
            if( insA.getFullYear() < currentDate.getFullYear() ){    
                var installDate = '2024-01-01';
            }else if( insA > currentDate ){        
                var installDate = moment(currentDate).format('YYYY-MM-DD');
            }else{
                var installDate = open_invoices[x].date_created;
            }

            if (installDate) {
                var ins = new Date(installDate);
                var month = ins.getMonth();             
                monthlyAmounts[month] += 1;
            }
        }

        var start = 0;
        var prev_amount = 0;
        for (i = 0; i < monthlyAmounts.length; ++i) {
        if( start == 0 ){
            var amount = monthlyAmounts[i];
        }else{
            var amount = monthlyAmounts[i] + prev_amount;
        }

        prev_amount = amount;
        monthlyAmounts[i] = amount;                
        start++;
        }
    }

    OpenInvoicesGraph.data.datasets[0].data = monthlyAmounts;
    OpenInvoicesGraph.update();
}

function filterPastDueThumbnailGraphBackup(past_due) {
    var amountsByMonth = new Array(12).fill(0);

    for (var x = 0; x < past_due.length; x++) {
        var dueDate = past_due[x].due_date;
        if (dueDate) {
            var due = new Date(dueDate);
            var month = due.getMonth();

            amountsByMonth[month] += parseFloat(past_due[x].balance);
        }
    }

    pastDueGraph.data.datasets[0].data = amountsByMonth;
    pastDueGraph.update();
}

function filterPastDueThumbnailGraph(past_due) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var monthlyAmounts = new Array(month_index).fill(0);    
    
    for (var x = 0; x < past_due.length; x++) {

        var dueDate = past_due[x].due_date;

        var insA = new Date(past_due[x].due_date);
        if( insA.getFullYear() < currentDate.getFullYear() ){    
            var installDate = '2024-01-01';
        }else if( insA > currentDate ){        
            var installDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var installDate = past_due[x].due_date;
        }                    

        if (dueDate) {
            var due = new Date(dueDate);
            var month = due.getMonth();
            monthlyAmounts[month] += parseFloat(past_due[x].balance);
        }
    }    

    var start = 0;
    var prev_amount = 0;
    for (i = 0; i < monthlyAmounts.length; ++i) {
        if( start == 0 ){
            var amount = monthlyAmounts[i];
        }else{
            var amount = monthlyAmounts[i] + prev_amount;
        }

        prev_amount = amount;
        monthlyAmounts[i] = amount;                
        start++;
    }    

    pastDueGraph.data.datasets[0].data = monthlyAmounts;
    pastDueGraph.update();
}

function filterNsmartSalesGraph(nsmart_sales){
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var monthlyAmounts = new Array(month_index).fill(0);    
    
    for (var x = 0; x < nsmart_sales.length; x++) {

        var insA = new Date(nsmart_sales[x].plan_date_registered);
        if( insA.getFullYear() < currentDate.getFullYear() ){    
            var installDate = '2024-01-01';
        }else if( insA > currentDate ){        
            var installDate = moment(currentDate).format('YYYY-MM-DD');
        }else{
            var installDate = nsmart_sales[x].plan_date_registered;
        }                    

        if (installDate) {
            var due = new Date(installDate);
            var month = due.getMonth();
            monthlyAmounts[month] += parseFloat(nsmart_sales[x].price - nsmart_sales[x].discount );
        }
    }    

    var start = 0;
    var prev_amount = 0;
    for (i = 0; i < monthlyAmounts.length; ++i) {
        if( start == 0 ){
            var amount = monthlyAmounts[i];
        }else{
            var amount = monthlyAmounts[i] + prev_amount;
        }

        prev_amount = amount;
        monthlyAmounts[i] = amount;                
        start++;
    }    

    nsmartSalesGraph.data.datasets[0].data = monthlyAmounts;
    nsmartSalesGraph.update();

}


function filterSubsciptionThumbnailGraph(mmr) {
    var currentDate    = new Date();
    var month_index    = currentDate.getMonth() + 1;
    var amountsByMonth = new Array(month_index).fill(0);

    for (var x = 0; x < mmr.length; x++) {
        if( mmr[x].bill_end_date == '0000-00-00' || mmr[x].bill_end_date == '1970-01-01' ){
            var installDate = '2024-01-01';
        }else{
            var insA = new Date(mmr[x].bill_end_date);
            
            if( insA.getFullYear() < currentDate.getFullYear() ){    
                var installDate = '2024-01-01';
            }else if( insA > currentDate ){        
                var installDate = moment(currentDate).format('YYYY-MM-DD');
            }else{
                var installDate = mmr[x].bill_end_date;
            }

            // var insAYear = insA.getFullYear();
            // if( insAYear < currentYear ){                        
            //     var installDate = '2024-01-01';
            // }else if( insAYear > currentYear ){
            //     var today = new Date();                                     
            //     var installDate = moment(today).format('YYYY-MM-DD');
            // }else{
            //     var installDate = mmr[x].bill_end_date;
            // }
        }

        if (installDate) {
            var ins = new Date(installDate);
            var month = ins.getMonth();                         
            if( isNaN(parseFloat(mmr[x].mmr)) ){
                amountsByMonth[month] += 0;
            }else{
                amountsByMonth[month] += parseFloat(mmr[x].mmr);
            }
        }
    }

    var start = 0;
    var prev_amount = 0;
    for (i = 0; i < amountsByMonth.length; ++i) {
        if( start == 0 ){
            var amount = amountsByMonth[i];
        }else{
            var amount = amountsByMonth[i] + prev_amount;
        }

        prev_amount = amount;
        amountsByMonth[i] = amount;                
        start++;
    }

    subscriptionChart.data.datasets[0].data = amountsByMonth.map(amount => parseFloat(amount.toFixed(2)));
    subscriptionChart.update();

}

function filterEstimateThumbnailGraph(first, second) {
    estimateChart.data.datasets[0].data = [first, second];
    estimateChart.update();
}


function manipulateThumbnail(dis, id, link) {
    var count = $('#check_count_thumbnails').val();

    if ($(dis).is(":checked")) {        
        count++;

        if (count < 8) {
            addThumbnail(id, link);
            $(dis).removeAttr('isnotselected');

        } else if (count == 8) {

            addThumbnail(id, link);
            $(dis).removeAttr('isnotselected');
            $('.add_tumbnail_checkbox[isnotselected]').prop('disabled', true);

        } else {
            count--;
            $(dis).removeAttr('checked')
            $(dis).attr('isnotselected', true);
            $('.add_tumbnail_checkbox[isnotselected]').prop('disabled', true);
        }

    } else {
        count--;
        $(dis).attr('isnotselected', true);
        $('.add_tumbnail_checkbox[isnotselected]').removeAttr('disabled')
        removeThumbnail(id);
    }


    $('#check_count_thumbnails').val(count);
}











function fetchCollections() {
    fetch('<?php echo base_url('Dashboard/todays_stats'); ?>', {
        method: 'GET',
    }).then(response => response.json()).then(response => {
        var {
            success,
            data,
            paymentInvoice,
            jobsCompleted,
            onlineBooking,
            lostAccount,
            collectedAccounts
        } = response;

        if (success) {
            var collectedAcc = collectedAccounts == '' ? '0' : collectedAccounts[0]['total'];

        }
    }).catch((error) => {
        console.log('Error:', error);
    });
}

function fetchJobs() {
    fetch('<?php echo base_url('Dashboard/jobs'); ?>', {

    }).then(response => response.json()).then(response => {
        var date1 = new Date();
        const currentMonth = new Date(date1.getFullYear(), date1.getMonth()).toLocaleString('default', {
            month: 'short'
        });
        const secMonth = new Date(date1.getFullYear(), date1.getMonth() - 1, 1).toLocaleString('default', {
            month: 'short'
        });
        const firstMonth = new Date(date1.getFullYear(), date1.getMonth() - 2, 1).toLocaleString('default', {
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
        }
        //console.log('goes here ', previousJob + prevJob + curJob)
        $('#jobs_count_thumbnail').html(previousJob + prevJob + curJob);

    });
}


function addThumbnail(id, link) {
    var isGlobal = $('#widgetGlobal_' + id).is(":checked") ? '1' : 0;
    var isMain = $('#widgetMain_' + id).is(":checked") ? '1' : 0;
    var divContainer = `
        <div class="col mt-3" data-id="${id}" id="thumbnail_${id}">
            <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-3" style="color:#6a4a86"></span>
                                    <span class="placeholder col-11 mt-3"></span>
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-4"></span>
                                    <span class="placeholder placeholder-lg col-12 mt-3 mb-3"></span>
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-12"></span>
                                    <span class="placeholder col-2 mt-3 float-end"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>`;
    $(".thumbnailCardContainers").append(divContainer);
    $.ajax({
        url: '<?php echo base_url(); ?>widgets/addV2Thumbnail',
        method: 'POST',
        data: {
            id: id,
            isGlobal: isGlobal,
            isMain: isMain
        },
        //dataType: 'json',
        success: function(response) {

            console.log(response);
            if (isMain != '1') {
                setTimeout(function() {
                    // Remove the loader

                    $("#widget_loader").remove();

                    // Append the response
                    $(`#thumbnail_${id}`).html(response);
                }, 1000);
            }
            fetchJobs();
            fetchCollections();

            setTimeout(function() {
                fetchGraphs(link);
                fetchCount(link);
            }, 1000);
        }
    });
}



function addToMain(id, isMain, isGlobal) {
    console.log(id, isMain, isGlobal);
    if (!isGlobal) {
        $.ajax({
            url: '<?php echo base_url(); ?>widgets/addToMain',
            method: 'POST',
            data: {
                id: id
            },
            //dataType: 'json',
            success: function(response) {
                alert(isMain ? 'Successfully Removed' : 'Successfully Added');
                location.reload();
            }
        });
    } else {
        alert('Sorry you cannot update a widget set by the company as global')
    }
}

function addWidget(id) {
    var isGlobal = $('#widgetGlobal_' + id).is(":checked") ? '1' : 0;
    var isMain = $('#widgetMain_' + id).is(":checked") ? '1' : 0;

    $.ajax({
        url: '<?php echo base_url(); ?>widgets/addV2Widget',
        method: 'POST',
        data: {
            id: id,
            isGlobal: isGlobal,
            isMain: isMain
        },
        //dataType: 'json',
        success: function(response) {
            console.log(response);
            if (isMain != '1') {
                $("#nsm_widgets").append(response);
            }
        }
    });
}

function removeThumbnail(dis) {
    $.ajax({
        url: '<?php echo base_url(); ?>widgets/removeWidget',
        method: 'POST',
        data: {
            id: dis
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.success) {
                $('#thumbnail_' + dis).remove();
            } else {
                alert(response.message);
            }
        }
    });
}

function removeWidget(dis) {
    $.ajax({
        url: '<?php echo base_url(); ?>widgets/removeWidget',
        method: 'POST',
        data: {
            id: dis
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.success) {
                $('#widget_' + dis).parent().remove();
                $('#widget_' + dis).remove();
            } else {
                alert(response.message);
            }
        }
    });
}

async function notificationRing() {
    var audioUrl = baseURL + '/assets/css/notification/notification_tone2.mp3';
    const audio = new Audio();
    audio.src = audioUrl;
    audio.muted = true;
    try {
        await audio.play();
    } catch (err) {
        // console.log('error');
        console.log(err);
    }
}

<?php if (logged('user_type') == 1 || isAdminBypass()) { ?>
$(document).on('click', '.btn-admin-switch', function() {
    $.ajax({
        url: '<?php echo base_url(); ?>user/_admin_switch',
        dataType: 'json',
        success: function(e) {
            if (e.is_valid == 1) {
                location.href = '<?php echo base_url('admin/users'); ?>';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: e.msg
                });
            }

        }
    });
});
<?php } ?>

<?php if (logged('user_type') == 7) { ?>
$(document).on('click', '.btn-adt-sales-portal', function() {
    $('#modalConnectAdtPortal').modal('show');
    $('.adt-connect-msg').html('Connecting to ADT Sales Portal...');
    setTimeout(function() {
        $.ajax({
            url: '<?php echo base_url(); ?>user/_loggedin_adt_sales_portal',
            dataType: 'json',
            success: function(e) {
                $('#modalConnectAdtPortal').modal('hide');
                if (e.is_valid == 1) {
                    //var portal_url = 'http://portal.urpowerpro.com/api/v1/user/login?portal_username='+e.portal_username;
                    var portal_url =
                        'http://portal.urpowerpro.com/api/v1/user/login?token=' + e.token;
                    window.open(portal_url, "_blank");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        confirmButtonColor: '#32243d',
                        html: e.msg
                    });
                }

            }
        });
    }, 900);
});
<?php } ?>
          </script>

          <script>
jQuery(document).ready(function() {

    // var attr = $('button').attr('name');

    // // For some browsers, `attr` is undefined; for others,
    // // `attr` is false.  Check for both.
    // if (typeof attr !== 'undefined' && attr !== false) {
    //     attr.attr("name","name");
    // }

    // $( "li.item-ii" ).find( allListElements );
    // $( "div" ).find( "button" ).attr( "name", "name-button" );
    // $( "div" ).find( "button" ).attr( "aria-label", "name-button" );
    // $( "div" ).find( "img" ).attr( "alt", "image" );
    // $( "div" ).find( "frame" ).attr( "title", "frame" );
    // $( "div" ).find( "frame" ).attr( "iframe", "iframe" );
    // $( "div" ).find( "a" ).attr( "name", "link" );


    $(document).on('click', '#calendar-add-job', function() {
        // var start_date = $('#action_select_date').val();
        // var start_time = $('#action_select_time').val();

        var appointment_date = $('#appointment_date').val();
        var appointment_time = $('#appointment_time').val();
        var appointment_user_id = $('#appointment-user').val();
        var appointment_customer_id = $('#appointment-customer').val();
        var appointment_type_id = $("input[name=appointment_type_id]").val();

        $.ajax({
            url: '<?php echo base_url(); ?>tickets/addnewTicketApmt',
            method: 'POST',
            data: {
                appointment_date: appointment_date,
                appointment_time: appointment_time,
                appointment_user_id: appointment_user_id,
                appointment_customer_id: appointment_customer_id,
                appointment_type_id: appointment_type_id
            },
            success: function(e) {


            }
        });
    });



});
          </script>

          <!-- Added footer assets -->
          <?php echo put_footer_assets(); ?>

          <!-- taxes page -->
          <!-- <script src="<?php echo $url->assets; ?>dashboard/js/custom.js"></script> -->
          <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
          <!-- global script that can be use all over the site pages -->
          <script>
function notifyUser(title, text, icon, location = null) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (result.value) {
            if (location === "reload") {
                window.location.reload(true);
            } else if (location !== null && location !== "") {
                window.location.href = '<?php echo base_url(); ?>' + location;
            }
        }
    });
}

var Accordion = function() {

    var
        toggleItems,
        items;

    var _init = function() {
        toggleItems = document.querySelectorAll('.accordion__itemTitleWrap');
        toggleItems = Array.prototype.slice.call(toggleItems);
        items = document.querySelectorAll('.accordion__item');
        items = Array.prototype.slice.call(items);

        _addEventHandlers();
        TweenLite.set(items, {
            visibility: 'visible'
        });
        TweenMax.staggerFrom(items, 0.9, {
            opacity: 0,
            x: -100,
            ease: Power2.easeOut
        }, 0.3)
    }

    var _addEventHandlers = function() {
        toggleItems.forEach(function(element, index) {
            element.addEventListener('click', _toggleItem, false);
        });
    }

    var _toggleItem = function() {
        var parent = this.parentNode;
        var content = parent.children[1];
        if (!parent.classList.contains('is-active')) {
            parent.classList.add('is-active');
            TweenLite.set(content, {
                height: 'auto'
            })
            TweenLite.from(content, 0.6, {
                height: 0,
                immediateRender: false,
                ease: Back.easeOut
            })

        } else {
            parent.classList.remove('is-active');
            TweenLite.to(content, 0.3, {
                height: 0,
                immediateRender: false,
                ease: Power1.easeOut
            })
        }
    }

    return {
        init: _init
    }

}();

Accordion.init();
          </script>
          </body>

          </html>