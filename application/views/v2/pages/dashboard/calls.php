<?php include viewPath('v2/includes/header'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
<script>
  (function() {
    var rcs = document.createElement("script");
    rcs.src = "https://ringcentral.github.io/ringcentral-embeddable/adapter.js?clientId=BP5ojuryTlKehE63y3jKiA&appServer=https://platform.devtest.ringcentral.com&redirectUri=https://ringcentral.github.io/ringcentral-embeddable/redirect.html";
    var rcs0 = document.getElementsByTagName("script")[0];
    rcs0.parentNode.insertBefore(rcs, rcs0);
  })();
</script>
<style>
.dialpad-container .row {
  margin: 0 auto;
  width: auto;
  clear: both;
  text-align: center;
  font-family: 'Exo';  
}

.digit, .dig {
  float: left;
  padding: 10px 39px;
  width: 30px;
  font-size: 2rem;
  cursor: pointer;
}

.sub {
  font-size: 0.8rem;
  color: grey;
}

.dialpad-container{
  /*background-color: white;*/
  width: auto;
  padding: 0px;
  margin: 0 auto;
  height: 420px;
  text-align: center;
  /*box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);*/  

}

#output {
  font-family: "Exo";
  font-size: 2rem;
  height: 60px;
  font-weight: bold;
  color: #1976d2;
}

#call {
    display: inline-block;
    background-color: #66bb6a;
    padding: 10px 20px;
    margin: 10px;
    color: white;
    border-radius: 4px;
    float: left;
    cursor: pointer;
}

.botrow {
  margin: 0 auto;
  width: 280px;
  clear: both;
  text-align: center;
  font-family: 'Exo';
}

.digit:active,
.dig:active {
  background-color: #e6e6e6;
}

#call:hover {
  background-color: #81c784;
}

.dig {
  float: left;
  padding: 10px 20px;
  margin: 10px;
  width: 30px;
  cursor: pointer;
}
div#controls div#call-controls div#volume-indicators {
display: none;
padding: 10px;
margin-top: 20px;
width: 500px;
text-align: left;
}

div#controls div#call-controls div#volume-indicators > div {
  display: block;
  height: 20px;
  width: 0;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/call_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Call customer.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('sms') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Customer" value="<?php echo (!empty($search)) ? $search : '' ?>">                                
                            </div>
                            <button type="submit" class="nsm-button primary" style="margin:0px;">Search</button>
                        </form>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon"></td>
                            <td data-name="Name">Name</td>
                            <td data-name="Phone" style="width:10%;">Phone</td>     
                            <td data-name="Manage" style="width:5%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($customers)) : ?>
                            <?php foreach ($customers as $customer) : ?>
                                <tr>
                                    <td>
                                        <div class="nsm-profile">
                                            <?php if ($customer->customer_type === 'Business'): ?>
                                                <span>
                                                <?php 
                                                    $parts = explode(' ', strtoupper(trim($customer->business_name)));
                                                    echo count($parts) > 1 ? $parts[0][0] . end($parts)[0] : $parts[0][0];
                                                ?>
                                                </span>
                                            <?php else: ?>
                                                <span><?= ucwords($customer->first_name[0]) . ucwords($customer->last_name[0]); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="nsm-text-primary">
                                        <label class="nsm-link default d-block fw-bold" onclick="location.href='<?= base_url('/customer/module/' . $customer->prof_id); ?>'">
                                            <?php if ($customer->customer_type === 'Business'): ?>
                                                <?= $customer->business_name ?>
                                            <?php else: ?>
                                                <?= ($customer) ? $customer->first_name . ' ' . $customer->last_name : ''; ?>
                                            <?php endif; ?>
                                        </label>
                                        <label class="nsm-link default content-subtitle fst-italic d-block"><?php echo $customer->email; ?></label>
                                    </td>                              
                                    <td><?php echo $customer->phone_m; ?></td>
                                    <td>
                                        <div class="dropdown table-management">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <?php
                                                        $phone = cleanMobileNumber($customer->phone_m);
                                                    ?>
                                                    <a class="dropdown-item call-customer" data-id="<?= $customer->prof_id; ?>" data-phone="<?= $phone; ?>" href="javascript:void(0);">Call</a>
                                                    <a class="dropdown-item" data-id="<?= $customer->prof_id; ?>" data-phone="<?= $phone; ?>" href="tel:+<?= $phone; ?>">+<?= $phone; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3">
                                    <div class="nsm-empty">
                                        <span>No results found.</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <nav class="nsm-table-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!--Call Dialpad Modal-->
                <div class="modal fade nsm-modal fade" id="modalCallDialPad" tabindex="-1" aria-labelledby="modalCallDialPadLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Make Call</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="container dialpad-container" id="call-controls" style="display:none;">
                                  <div id="log" style="display:none;"></div>
                                  <div id="output"></div>
                                  <input type="hidden" name="customer_phone" id="phone-number" value="" />
                                  <input type="hidden" name="cid" id="cid" value="" />
                                  <div class="row">
                                    <div class="digit" id="one">1</div>
                                    <div class="digit" id="two">2
                                      <div class="sub">ABC</div>
                                    </div>
                                    <div class="digit" id="three">3
                                      <div class="sub">DEF</div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="digit" id="four">4
                                      <div class="sub">GHI</div>
                                    </div>
                                    <div class="digit" id="five">5
                                      <div class="sub">JKL</div>
                                    </div>
                                    <div class="digit">6
                                      <div class="sub">MNO</div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="digit">7
                                      <div class="sub">PQRS</div>
                                    </div>
                                    <div class="digit">8
                                      <div class="sub">TUV</div>
                                    </div>
                                    <div class="digit">9
                                      <div class="sub">WXYZ</div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="digit">*
                                    </div>
                                    <div class="digit">0
                                    </div>
                                    <div class="digit">#
                                    </div>
                                  </div>
                                  <div class="botrow">  
                                    <!-- <i class='bx bx-star dig'></i> -->
                                    <i class='bx bx-arrow-back dig' style="width:auto;"></i>
                                    <div id="call">
                                        <a id="button-call" href="javascript:void(0);">
                                            <i class='bx bx-phone-call' style="font-size:17px;"></i>
                                        </a>
                                        <a id="button-hangup" href="javascript:void(0);" style="display: none;">
                                            <i class='bx bx-phone-incoming' style="font-size:17px;"></i>
                                        </a>
                                    </div>
                                  </div>
                                </div>

                                <div id="volume-indicators" style="display:none;">
                                    <label>Mic Volume</label>
                                    <div id="input-volume"></div><br/><br/>
                                    <label>Speaker Volume</label>
                                    <div id="output-volume"></div>
                                </div>

                            </div>                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var count = 0;
        $(".digit").on('click', function() {

          var num = ($(this).clone().children().remove().end().text());
          if (count < 11) {
            var phoneNumber = $('#phone-number').val();
            var newNumber   = phoneNumber + num.trim();

            $('#phone-number').val(newNumber);
            $('#output').html(newNumber);

            count++
          }
        });

        $('.bx-arrow-back').on('click', function() {
          var phoneNumber = $('#phone-number').val();
          var newNumber   = phoneNumber.slice(0, -1);

          $('#phone-number').val(newNumber);
          $('#output').html(newNumber);
          count--;
        });

        $(document).on('click', '.call-customer',function(){
            var cphone = $(this).attr('data-phone');
            var cid    = $(this).attr('data-id');

            count = cphone.length;

            $('#output').html(cphone);
            $('#phone-number').val(cphone);
            $('#cid').val(cid);
            $('#modalCallDialPad').modal('show');
        });

        $(".nsm-table").nsmPagination();
    });



    //Twilio
    //var speakerDevices = document.getElementById('speaker-devices');
    $(function(){
        $.getJSON('https://bubbles-shark-3469.twil.io/capability-token')
          //Paste URL HERE
        .done(function (data) {
          log('Got a token.');
          console.log('Token: ' + data.token);

          // Setup Twilio.Device
          Twilio.Device.setup(data.token);

          Twilio.Device.ready(function (device) {
            log('Twilio.Device Ready!');
            document.getElementById('call-controls').style.display = 'block';
          });

          Twilio.Device.error(function (error) {
            log('Twilio.Device Error: ' + error.message);
          });

          Twilio.Device.connect(function (conn) {            
            var url = base_url + 'calls/_log_start_call';
            var phoneNumber = document.getElementById('phone-number').value;
            var cid = document.getElementById('cid').value;
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid,phoneNumber:phoneNumber},
                 success: function(o)
                 {          
                    
                 }
            });

            log('Successfully established call!');
            /*document.getElementById('button-call').style.display = 'none';
            document.getElementById('button-hangup').style.display = 'inline';*/
            volumeIndicators.style.display = 'block';
            bindVolumeIndicators(conn);
          });

          Twilio.Device.disconnect(function (conn) {
            var url = base_url + 'calls/_log_end_call';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {},
                 success: function(o)
                 {          
                    
                 }
            });

            log('Call ended.');
            document.getElementById('button-call').style.display = 'inline';
            document.getElementById('button-hangup').style.display = 'none';
            volumeIndicators.style.display = 'none';
          });

          Twilio.Device.incoming(function (conn) {
            log('Incoming connection from ' + conn.parameters.From);
            var archEnemyPhoneNumber = '+12099517118';

            if (conn.parameters.From === archEnemyPhoneNumber) {
              conn.reject();
              log('It\'s your nemesis. Rejected call.');
            } else {
              // accept the incoming connection and start two-way audio
              conn.accept();
            }
          });

          //setClientNameUI(data.identity);

          Twilio.Device.audio.on('deviceChange', updateAllDevices);

          // Show audio selection UI if it is supported by the browser.
          if (Twilio.Device.audio.isSelectionSupported) {
            document.getElementById('output-selection').style.display = 'block';
          }
        })
        .fail(function () {
          log('Could not get a token from server!');
        });

        function bindVolumeIndicators(connection) {
          connection.volume(function(inputVolume, outputVolume) {
          var inputColor = 'red';
          if (inputVolume < .50) {
            inputColor = 'green';
          } else if (inputVolume < .75) {
            inputColor = 'yellow';
          }

          inputVolumeBar.style.width = Math.floor(inputVolume * 300) + 'px';
          inputVolumeBar.style.background = inputColor;

          var outputColor = 'red';
          if (outputVolume < .50) {
            outputColor = 'green';
          } else if (outputVolume < .75) {
            outputColor = 'yellow';
          }

          outputVolumeBar.style.width = Math.floor(outputVolume * 300) + 'px';
          outputVolumeBar.style.background = outputColor;
        });
        }

        function updateAllDevices() {
            //updateDevices(speakerDevices, Twilio.Device.audio.speakerDevices.get());
            //updateDevices(ringtoneDevices, Twilio.Device.audio.ringtoneDevices.get());
        }

        // Bind button to make call
        document.getElementById('button-call').onclick = function () {
            // get the phone number to connect the call to
            var params = {
              To: document.getElementById('phone-number').value
            };

            $('#button-call').hide();
            $('#button-hangup').show();
            console.log('Calling ' + params.To + '...');
            Twilio.Device.connect(params);
        };

        // Bind button to hangup call
        document.getElementById('button-hangup').onclick = function () {
            log('Hanging up...');
            Twilio.Device.disconnectAll();
        };
    });   
    // Update the available ringtone and speaker devices
    function updateDevices(selectEl, selectedDevices) {
      selectEl.innerHTML = '';
      Twilio.Device.audio.availableOutputDevices.forEach(function(device, id) {
        var isActive = (selectedDevices.size === 0 && id === 'default');
        selectedDevices.forEach(function(device) {
          if (device.deviceId === id) { isActive = true; }
        });

        var option = document.createElement('option');
        option.label = device.label;
        option.setAttribute('data-id', id);
        if (isActive) {
          option.setAttribute('selected', 'selected');
        }
        selectEl.appendChild(option);
      });
    }

    // Activity log
    function log(message) {
      var logDiv = document.getElementById('log');
      logDiv.innerHTML += '<p>&gt;&nbsp;' + message + '</p>';
      logDiv.scrollTop = logDiv.scrollHeight;
    }

    // Set the client name in the UI
    function setClientNameUI(clientName) {
      var div = document.getElementById('client-name');
      div.innerHTML = 'Your client name: <strong>' + clientName +
        '</strong>';
    } 
</script>
<?php include viewPath('v2/includes/footer'); ?>