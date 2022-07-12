<?php include viewPath('v2/includes/header'); ?>
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
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

                <?php if( $enable_ringcentral_call ){ ?>
                    <script type="text/html" id="template-login" style="display:none;">
                        <form class="panel panel-default">
                            <input type="hidden" class="form-control" value="<?= RINGCENTRAL_DEV_URL; ?>" name="server">
                            <input type="hidden" class="form-control" value="<?= $ringCentralAccount->client_id; ?>" name="appKey">
                            <input type="hidden" class="form-control" value="<?= $ringCentralAccount->client_secret; ?>" name="appSecret">
                            <input type="hidden" class="form-control" value="<?= $ringCentralAccount->rc_username; ?>" name="login" placeholder="18881234567">
                            <input type="hidden" class="form-control" value="<?= $ringCentralAccount->rc_ext; ?>" name="extension">
                            <input type="hidden" class="form-control" value="<?= $ringCentralAccount->rc_password; ?>" name="password">
                            <input type="hidden" class="form-control" name="logLevel" value="1">
                        </form>
                    </script>
                <?php } ?>

                <!--Call Dialpad Modal-->
                <div class="modal fade nsm-modal fade" id="modalCallDialPad" tabindex="-1" aria-labelledby="modalCallDialPadLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <span class="modal-title content-title" id="new_feed_modal_label">Make Call</span>
                                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                            </div>
                            <div class="modal-body">
                                <?php if( $enable_ringcentral_call ){ ?>
                                    <video id="remoteVideo" hidden="hidden"></video>
                                    <video id="localVideo" hidden="hidden" muted="muted"></video>
                                <?php } ?>
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

    <?php if( $enable_ringcentral_call ){ ?>
    //RingCentral
    $(function() {
        var session = null;
        /** @type {RingCentral.SDK} */
        var sdk = null;
        /** @type {Platform} */
        var platform = null;
        /** @type {WebPhone} */
        var webPhone = null;

        var logLevel = 0;
        var username = null;
        var extension = null;
        var sipInfo = null;
        var $app = $('#app');

        var $loginTemplate = $('#template-login');
        var $callTemplate = $('#template-call');
        var $incomingTemplate = $('#template-incoming');
        var $acceptedTemplate = $('#modalCallDialPad');

        /**
         * @param {jQuery|HTMLElement} $tpl
         * @return {jQuery|HTMLElement}
         */
        function cloneTemplate($tpl) {
            return $($tpl.html());
        }

        function login(server, appKey, appSecret, login, ext, password, ll) {
            sdk = new RingCentral.SDK({
                appKey: appKey,
                appSecret: appSecret,
                server: server
            });

            platform = sdk.platform();

            // TODO: Improve later to support international phone number country codes better
            if (login) {
                login = (login.match(/^[\+1]/)) ? login : '1' + login;
                login = login.replace(/\W/g, '')
            }

            platform
                .login({
                    username: login,
                    extension: ext || null,
                    password: password
                })
                .then(function() {

                    logLevel = ll;
                    username = login;

                    localStorage.setItem('webPhoneServer', server || '');
                    localStorage.setItem('webPhoneAppKey', appKey || '');
                    localStorage.setItem('webPhoneAppSecret', appSecret || '');
                    localStorage.setItem('webPhoneLogin', login || '');
                    localStorage.setItem('webPhoneExtension', ext || '');
                    localStorage.setItem('webPhonePassword', password || '');
                    localStorage.setItem('webPhoneLogLevel', logLevel || 0);

                    return platform.get('/restapi/v1.0/account/~/extension/~');

                })
                .then(function(res) {

                    extension = res.json();

                    console.log('Extension info', extension);

                    return platform.post('/client-info/sip-provision', {
                        sipInfo: [{
                            transport: 'WSS'
                        }]
                    });

                })
                .then(function(res) { return res.json(); })
                .then(register)
                .then(function(res){
                    $('#call-controls').show();
                })
                .catch(function(e) {
                    console.error('Error in main promise chain');
                    console.error(e.stack || e);
                });

        }

        function register(data) {

            sipInfo = data.sipInfo[0] || data.sipInfo;

            webPhone = new RingCentral.WebPhone(data, {
                appKey: localStorage.getItem('webPhoneAppKey'),
                audioHelper: {
                    enabled: true
                },
                logLevel: parseInt(logLevel, 10)
            });
            webPhone.userAgent.audioHelper.loadAudio({
                incoming: '<?= base_url('assets/js/ringcentral/audio/incoming.ogg'); ?>',
                outgoing: '<?= base_url('assets/js/ringcentral/audio/outgoing.ogg'); ?>'
            })

            webPhone.userAgent.audioHelper.setVolume(.3);

            webPhone.userAgent.on('invite', onInvite);
            webPhone.userAgent.on('connecting', function() { console.log('UA connecting'); });
            webPhone.userAgent.on('connected', function() { console.log('UA Connected'); });
            webPhone.userAgent.on('disconnected', function() { console.log('UA Disconnected'); });
            webPhone.userAgent.on('registered', function() { console.log('UA Registered'); });
            webPhone.userAgent.on('unregistered', function() { console.log('UA Unregistered'); });
            webPhone.userAgent.on('registrationFailed', function() { console.log('UA RegistrationFailed', arguments); });
            webPhone.userAgent.on('message', function() { console.log('UA Message', arguments); });

            return webPhone;

        }

        function onInvite(session) {

            console.log('EVENT: Invite', session.request);
            console.log('To', session.request.to.displayName, session.request.to.friendlyName);
            console.log('From', session.request.from.displayName, session.request.from.friendlyName);

            var $modal = cloneTemplate($incomingTemplate).modal({backdrop: 'static'});

            var acceptOptions = {
                media: {
                    render: {
                        remote: document.getElementById('remoteVideo'),
                        local: document.getElementById('localVideo')
                    }
                }
            };

            $modal.find('.answer').on('click', function() {
                $modal.find('.before-answer').css('display', 'none');
                $modal.find('.answered').css('display', '');
                session.accept(acceptOptions)
                    .then(function() {
                        $modal.modal('hide');
                        onAccepted(session);
                    })
                    .catch(function(e) { console.error('Accept failed', e.stack || e); });
            });

            $modal.find('.decline').on('click', function() {
                session.reject();
            });

            $modal.find('.forward-form').on('submit', function(e) {
                e.preventDefault();
                e.stopPropagation();
                session.forward($modal.find('input[name=forward]').val().trim(), acceptOptions)
                    .then(function() {
                        console.log('Forwarded');
                        $modal.modal('hide');
                    })
                    .catch(function(e) { console.error('Forward failed', e.stack || e); });
            });

            session.on('rejected', function() {
                $modal.modal('hide');
            });

        }

        function onAccepted(session) {

            console.log('EVENT: Accepted', session.request);
            console.log('To', session.request.to.displayName, session.request.to.friendlyName);
            console.log('From', session.request.from.displayName, session.request.from.friendlyName);

            var $modal = cloneTemplate($acceptedTemplate).modal();

            var $info = $modal.find('.info').eq(0);
            var $dtmf = $modal.find('input[name=dtmf]').eq(0);
            var $transfer = $modal.find('input[name=transfer]').eq(0);
            var $flip = $modal.find('input[name=flip]').eq(0);

            var interval = setInterval(function() {

                var time = session.startTime ? (Math.round((Date.now() - session.startTime) / 1000) + 's') : 'Ringing';

                $info.text(
                    'time: ' + time + '\n' +
                    'startTime: ' + JSON.stringify(session.startTime, null, 2) + '\n'
                );

            }, 1000);

            session.on('accepted', function() { console.log('Event: Accepted'); });
            session.on('progress', function() { console.log('Event: Progress'); });
            session.on('rejected', function() {
                console.log('Event: Rejected');
                close();
            });
            session.on('failed', function() {
                console.log('Event: Failed');
                close();
            });
            session.on('terminated', function() {
                console.log('Event: Terminated');
                close();
            });
            session.on('cancel', function() {
                console.log('Event: Cancel');
                close();
            });
            session.on('refer', function() {
                console.log('Event: Refer');
                close();
            });
            session.on('replaced', function(newSession) {
                console.log('Event: Replaced: old session', session, 'has been replaced with', newSession);
                close();
                onAccepted(newSession);
            });
            session.on('dtmf', function() { console.log('Event: DTMF'); });
            session.on('muted', function() { console.log('Event: Muted'); });
            session.on('unmuted', function() { console.log('Event: Unmuted'); });
            session.on('connecting', function() { console.log('Event: Connecting'); });
            session.on('bye', function() {
                console.log('Event: Bye');
                close();
            });

            session.mediaHandler.on('iceConnection', function() { console.log('Event: ICE: iceConnection'); });
            session.mediaHandler.on('iceConnectionChecking', function() { console.log('Event: ICE: iceConnectionChecking'); });
            session.mediaHandler.on('iceConnectionConnected', function() { console.log('Event: ICE: iceConnectionConnected'); });
            session.mediaHandler.on('iceConnectionCompleted', function() { console.log('Event: ICE: iceConnectionCompleted'); });
            session.mediaHandler.on('iceConnectionFailed', function() { console.log('Event: ICE: iceConnectionFailed'); });
            session.mediaHandler.on('iceConnectionDisconnected', function() { console.log('Event: ICE: iceConnectionDisconnected'); });
            session.mediaHandler.on('iceConnectionClosed', function() { console.log('Event: ICE: iceConnectionClosed'); });
            session.mediaHandler.on('iceGatheringComplete', function() { console.log('Event: ICE: iceGatheringComplete'); });
            session.mediaHandler.on('iceGathering', function() { console.log('Event: ICE: iceGathering'); });
            session.mediaHandler.on('iceCandidate', function() { console.log('Event: ICE: iceCandidate'); });
            session.mediaHandler.on('userMedia', function() { console.log('Event: ICE: userMedia'); });
            session.mediaHandler.on('userMediaRequest', function() { console.log('Event: ICE: userMediaRequest'); });
            session.mediaHandler.on('userMediaFailed', function() { console.log('Event: ICE: userMediaFailed'); });

        }

        function makeCall(number, homeCountryId) {

            homeCountryId = homeCountryId
                          || (extension && extension.regionalSettings && extension.regionalSettings.homeCountry && extension.regionalSettings.homeCountry.id)
                          || null;

            session = webPhone.userAgent.invite(number, {
                media: {
                    render: {
                        remote: document.getElementById('remoteVideo'),
                        local: document.getElementById('localVideo')
                    }
                },
                fromNumber: username,
                homeCountryId: homeCountryId
            });

            var url = base_url + 'calls/_log_start_call';
            var phoneNumber = document.getElementById('phone-number').value;
            var cid = document.getElementById('cid').value;
            var apiType = 'ringcentral';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid,phoneNumber:phoneNumber,apiType:apiType},
                 success: function(o)
                 {          
                    
                 }
            });

            onAccepted(session);

        }

        function makeCallForm() {

            var $form = cloneTemplate($callTemplate);

            var $number = $form.find('input[name=number]').eq(0);
            var $homeCountry = $form.find('input[name=homeCountry]').eq(0);

            $number.val(localStorage.getItem('webPhoneLastNumber') || '');

            $form.on('submit', function(e) {

                e.preventDefault();
                e.stopPropagation();

                localStorage.setItem('webPhoneLastNumber', $number.val() || '');

                makeCall($number.val(), $homeCountry.val());

            });

            $app.empty().append($form);

        }

        function connectRingCentral() {

            var $form = cloneTemplate($loginTemplate);

            var $server = $form.find('input[name=server]').eq(0);            
            var $appKey = $form.find('input[name=appKey]').eq(0);            
            var $appSecret = $form.find('input[name=appSecret]').eq(0);            
            var $login = $form.find('input[name=login]').eq(0);            
            var $ext = $form.find('input[name=extension]').eq(0);            
            var $password = $form.find('input[name=password]').eq(0);
            
            var $logLevel = $form.find('input[name=logLevel]').eq(0);

            /*$server.val(localStorage.getItem('webPhoneServer') || RingCentral.SDK.server.sandbox);
            $appKey.val(localStorage.getItem('webPhoneAppKey') || '');
            $appSecret.val(localStorage.getItem('webPhoneAppSecret') || '');
            $login.val(localStorage.getItem('webPhoneLogin') || '');
            $ext.val(localStorage.getItem('webPhoneExtension') || '');
            $password.val(localStorage.getItem('webPhonePassword') || '');
            $logLevel.val(localStorage.getItem('webPhoneLogLevel') || logLevel);*/            
            login($server.val(), $appKey.val(), $appSecret.val(), $login.val(), $ext.val(), $password.val(), $logLevel.val());

        }

        $(document).on('click', '.call-customer', function(){
            connectRingCentral();
        });

        $(document).on('click', '#button-call', function(){
            var phone_number = $('#phone-number').val();
            var countryid    = 1;

            $('#button-call').hide();
            $('#button-hangup').show();
            makeCall(phone_number, countryid);
        });

        $(document).on('click', '#button-hangup', function(){
            session.terminate();            
            $('#button-call').show();
            $('#button-hangup').hide();  

            var url = base_url + 'calls/_log_end_call';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {},
                 success: function(o)
                 {          
                    
                 }
            });          
        });
    });    
    <?php } ?>

    <?php if( $enable_twilio_call ){ ?>
    //Twilio
    //var speakerDevices = document.getElementById('speaker-devices');
    var capability_token_url = '<?= $twilioAccount->tw_capability_token_url; ?>';
    $(function(){
        $.getJSON(capability_token_url)
          //Paste URL HERE
        .done(function (data) {
          //log('Got a token.');
          //console.log('Token: ' + data.token);

          // Setup Twilio.Device
          Twilio.Device.setup(data.token);

          Twilio.Device.ready(function (device) {
            //log('Twilio.Device Ready!');
            document.getElementById('call-controls').style.display = 'block';
          });

          Twilio.Device.error(function (error) {
            log('Twilio.Device Error: ' + error.message);
          });

          Twilio.Device.connect(function (conn) {            
            var url = base_url + 'calls/_log_start_call';
            var phoneNumber = document.getElementById('phone-number').value;
            var cid = document.getElementById('cid').value;
            var apiType = 'twilio';
            $.ajax({
                 type: "POST",
                 url: url,
                 data: {cid:cid,phoneNumber:phoneNumber,apiType:apiType},
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
    <?php } ?>
</script>
<?php include viewPath('v2/includes/footer'); ?>