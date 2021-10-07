          <div class="row">
            <div class="col-12 d-flex mt-4">
              <span class="content-subtitle">Copyright © 2020 nSmartrac. All rights reserved.</span>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Chart JS -->
    <script src="<?= base_url("assets/js/v2/chart.min.js") ?>"></script> 
    <!-- Boostrap JS -->
    <script src="<?= base_url("assets/js/v2/bootstrap.bundle.min.js") ?>" crossorigin="anonymous"></script>
    <!-- Sweetalert JS -->
    <script src="<?= base_url("assets/js/v2/sweetalert2.min.js") ?>"></script>
    <!-- Main Script -->
    <script type="text/javascript" src="<?= base_url("assets/js/v2/main.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/v2/nsm.draggable.js") ?>"></script>
    <script src="<?php echo $url->assets;?>js/timesheet/clock.js"></script>
    <script type="text/javascript">
      var baseURL = '<?= base_url() ?>';
      var notification_badge_value = 0;

      $(document).ready(function() {
        //initializeChart();
        getNotificationsAll();

        $('#manage_widgets_modal').on('show.bs.modal', function () {
            console.log("TEST");
            $.ajax({
                url: '<?php echo base_url(); ?>dashboard_v2/getWidgetList',
                method: 'get',
                data: {},
                success: function (response) {
                    $('#add_widget_container').html(response);
                }
            });
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
    </script>
  </body>

</html>