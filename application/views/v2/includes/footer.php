          
            </div>
            <div class="nsm-footer">
                <div class="row">
                    <div class="col-12 d-flex mt-4">
                        <span class="content-subtitle">Copyright © 2020 nSmarTrac. All rights reserved.</span>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="modal fade nsm-modal fade" id="hdr_multi_account_loading_modal" aria-labelledby="hdr_multi_account_loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- Chart JS -->
    <script src="<?= base_url("assets/js/v2/chart.min.js") ?>"></script> 
    <!-- Boostrap JS -->
    <script src="<?= base_url("assets/js/v2/bootstrap.bundle.min.js") ?>" crossorigin="anonymous"></script>
    
    <!-- Timepicker -->
    <script src="<?php echo $url->assets ?>plugins/jquery-timepicker/jquery.timepicker.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo $url->assets ?>js/custom.js"></script>
    <!-- Sweetalert JS -->
    <script src="<?= base_url("assets/js/v2/sweetalert2.min.js") ?>"></script>
    <!-- Pusher JS -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- Datepicker -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/bootstrap-datepicker.min.js") ?>"></script>
    <!-- TagsInput -->
    <script type="text/javascript" src="<?= base_url("assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js") ?>"></script>
    <!-- Datetimepicker -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/moment.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/bootstrap-datetimepicker.min.js") ?>"></script>
    <!-- Sidebar counbter -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/sidebar-counter.js") ?>"></script>
    <!-- Select2 -->
    <script src="<?= base_url("assets/plugins/select2/dist/js/select2.full.min.js"); ?>"></script>
    <!-- Input Mask -->
    <?php if( isset($enable_input_mask) ){ ?>
    <script src="<?= base_url("assets/plugins/inputmask/dist/jquery.inputmask.bundle.js"); ?>"></script>
    <?php } ?>
    <!-- Twilio Call -->
    <?php if( isset($enable_twilio_call) ){ ?>
    <script src="<?= base_url("assets/js/twilio.min.js"); ?>"></script>
    <?php } ?>

    <?php if( isset($enable_ringcentral_call) ){ ?>
    <script type="text/javascript" src="//cdn.jsdelivr.net/es6-promise/3.1.2/es6-promise.js"></script>
    <script type="text/javascript" src="//cdn.pubnub.com/sdk/javascript/pubnub.4.4.2.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/onsip/SIP.js/0.7.7/dist/sip-0.7.7.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/ringcentral/ringcentral-js/3.1.0/build/ringcentral.js"></script>
    <script src="<?= base_url("assets/js/ringcentral/ringcentral-web-phone.js"); ?>"></script>
    <?php } ?>

    <?php if( isset($enable_popper_tooltip) ){ ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php } ?>

    <!-- Switchery -->
    <script src="<?= base_url("assets/plugins/switchery/switchery.min.js"); ?>"></script>

    <!-- Ckeditor -->
    <script type="text/javascript" src="<?= base_url("assets/ckeditor/ckeditor.js"); ?>"></script>

    <!-- Multiselect -->
    <script src="<?= base_url("assets/js/v2/multiple-select.min.js") ?>"></script>

    <!-- FullCalendar -->
    <!-- <script src="<?= base_url("assets/js/v2/full-calendar-main.js") ?>"></script> -->

    <!-- Fancybox -->
    <script src="<?= base_url("assets/js/v2/fancybox.umd.js") ?>"></script>

    <!-- Switchery -->
    <script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>

    <!-- Main Script -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/main.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.draggable.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.table.js") ?>"></script>
    <script src="<?php echo $url->assets;?>js/timesheet/clock.js"></script>
    <script type="text/javascript">
        var baseURL = '<?= base_url() ?>';
        var notification_badge_value = 0;
        var current_user_company_id = <?=logged('company_id')?> ;
        var all_notifications_html = '';
        var notification_badge_value = 0;
        var notification_html_holder_ctr = 0;

        $(document).ready(function() {
            getNotificationsAll();

            $('.hdr-drpdown-multi-accounts').on('click', function(){
                var parent = $(this).closest('li');
                if(parent.hasClass('shown')){
                    load_company_multi_account_list();
                }else{
                    $('#hdr-multi-account-list').html('');
                }
            });

            function load_company_multi_account_list(){
                var url = base_url + "mycrm/_hdr_load_multi_account_list";
                showLoader($("#hdr-multi-account-list"));        

                setTimeout(function () {
                  $.ajax({
                     type: "GET",
                     url: url,
                     success: function(o)
                     {          
                        $("#hdr-multi-account-list").html(o);
                     }
                  });
                }, 500);
            }

            $('#manage_widgets_modal').on('show.bs.modal', function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>dashboard/getWidgetList',
                    method: 'get',
                    data: {},
                    success: function (response) {
                        $('#add_widget_container').html(response);
                    }
                });
            });

            var offset = new Date().getTimezoneOffset();
            var offset_zone = (offset / 60) * (-1);
            if (offset_zone >= 0) {
                offset_zone = "+" + offset_zone;
            }
            $.ajax({
                url: "<?= base_url() ?>/timesheet/timezonesetter",
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

            var channel = pusher.subscribe('nsmarttrac');
            channel.bind('my-event', function(data) {

                console.log(data.user_id);
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

        function getNotificationsAll(){
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

        function notificationClockInOut(){
            $.ajax({
                url: baseURL + "Timesheet/getCount_NotificationsAll",
                type: "POST",
                dataType: "json",
                data: {
                    notifycount: notification_badge_value
                },
                success: function(data) {
                    if (notification_badge_value != data.badgeCount) {
                        notification_badge_value = data.badgeCount;
                        getNotificationsAll();
                    }
                    if (data.notifyCount < 1) {
                        $('#notifications_container').html('<div class="text-center py-3"><span class="content-subtitle">No notifications for now.</span></div>');
                    }
                }
            });
        }

        function sendFeed(){
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/dashboard/sendFeed",
                dataType: 'json',
                data: {
                    subject : $('#feedSubject').val(),
                    message : $('#feedMessage').val()
                },
                success: function (data) {
                    $('#new_feed_modal').modal('hide');
                    if(data.success){
                        notifyUser('Nice!',data.msg,'success');
                    }
                }
            });
        }

        function sendNewsLetter(){
            var _modal = $("#news_letter_modal");
            var _sendBtn = _modal.find(".nsm-button.primary");
            var file = _modal.find("#file")[0].files[0];

            var formdata = new FormData();
            formdata.append("file", file);
            formdata.append('news', _modal.find('#news').val());

            _sendBtn.prop("disabled", true);
            _sendBtn.html("Sending...");

            $.ajax({
                url: '<?= base_url(); ?>newsletter/saveNewsBulletin',
                method: 'POST',
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if(response.success){
                        notifyUser('Nice!',response.msg,'success');
                    }
                    $('#news_letter_modal').modal('hide');
                    _sendBtn.prop("disabled", false);
                    _sendBtn.html("Send Newsletter");
                }
            });
        }

        function notifyUser(title,text,icon,location=null){
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: false,
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    if(location === "reload"){
                        window.location.reload(true);
                    }else if(location !== null && location !== ""){
                        window.location.href='<?= base_url(); ?>'+location;
                    }
                }
            });
        }

        function manipulateWidget(dis, id){
            if ($(dis).is(":checked"))
            {
                addWidget(id);
            } else {
                removeWidget(id);
            }
        }

        function addToMain(id, isMain, isGlobal){
            console.log(id, isMain, isGlobal);
            if(!isGlobal){
                $.ajax({
                    url: '<?php echo base_url(); ?>widgets/addToMain',
                    method: 'POST',
                    data: {id: id},
                    //dataType: 'json',
                    success: function (response) {
                    alert(isMain?'Successfully Removed':'Successfully Added');
                    location.reload();
                    }
                });
            }else{
                alert('Sorry you cannot update a widget set by the company as global')
            }
        }

        function addWidget(id){
            var isGlobal = $('#widgetGlobal_' + id).is(":checked") ? '1' : 0;
            var isMain = $('#widgetMain_' + id).is(":checked") ? '1' : 0;

            $.ajax({
                url: '<?php echo base_url(); ?>widgets/addV2Widget',
                method: 'POST',
                data: {id: id, isGlobal: isGlobal, isMain: isMain},
                //dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (isMain != '1') {
                        $("#nsm_widgets").append(response);
                    }
                }
            });
        }

        function removeWidget(dis){
            $.ajax({
                url: '<?php echo base_url(); ?>widgets/removeWidget',
                method: 'POST',
                data: {id: dis},
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success){
                        $('#widget_' + dis).remove();
                    }else{
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

        <?php if( logged('user_type') == 1 || isAdminBypass() ){ ?>
        $(document).on('click', '.btn-admin-switch', function(){
            $.ajax({
                url: '<?php echo base_url(); ?>user/_admin_switch',
                dataType: 'json',
                success: function (e) {
                    if( e.is_valid == 1 ){
                        location.href = '<?= base_url('admin/users'); ?>';
                    }else{
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

        <?php if( logged('user_type') == 7 ){ ?>
        $(document).on('click', '.btn-adt-sales-portal', function(){
            $('#modalConnectAdtPortal').modal('show');
            $('.adt-connect-msg').html('Connecting to ADT Sales Portal...');
            setTimeout(function () {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/_loggedin_adt_sales_portal',
                    dataType: 'json',
                    success: function (e) {
                        $('#modalConnectAdtPortal').modal('hide');
                        if( e.is_valid == 1 ){
                            //var portal_url = 'http://portal.urpowerpro.com/api/v1/user/login?portal_username='+e.portal_username;
                            var portal_url = 'http://portal.urpowerpro.com/api/v1/user/login?token='+e.token;
                            window.open(portal_url, "_blank");
                        }else{
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

        
    $(document).on('click', '#calendar-add-job', function(){
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
                data: {appointment_date: appointment_date, appointment_time: appointment_time, appointment_user_id:appointment_user_id, appointment_customer_id:appointment_customer_id, appointment_type_id:appointment_type_id},
                success: function (e) {

                        
                }
            });
    });



    });

    </script>

    <!-- Added footer assets -->
    <?php echo put_footer_assets();?>
  </body>

</html>