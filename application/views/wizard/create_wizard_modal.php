<div id="createWizard" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content" style="padding:5px !important;">
            <div class="modal-header">
                <h5 class="modal-title">Create a WiZ!</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="wizTab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="name-tab" data-toggle="pill" href="#name" role="tab" aria-selected="true"><i id="nameCheck" style="display: none;" class="fa fa-check text-green mr-2"></i> Name your Wiz </a>
                            <ul id="wizName" class="wizDetails"></ul>
                            <a class="nav-link Bold" id="trigger-tab" data-toggle="pill" href="#trigger" role="tab" aria-selected="false"><i id="triggerCheck" style="display: none;" class="fa fa-check text-green mr-2"></i> Choose a Trigger</a>
                            <ul id="triggerDetails" class="wizDetails"></ul>
                            <a class="nav-link Bold" id="action-tab" data-toggle="pill" href="#action" role="tab"  aria-selected="false"><i id="actionCheck" style="display: none;" class="fa fa-check text-green mr-2"></i> Choose an Action</a>
                            <ul id="actionDetails" class="wizDetails"></ul>
                            <a class="nav-link Bold" id="final-tab" data-toggle="pill" href="#final" role="tab" aria-selected="false">Finalize It!</a>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="name" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="form-group">
                                    <label>Name of Wiz</label>
                                    <input type="text" name="" id="wizAppName" placeholder="Please enter name of wiz" class="form-control">
                                </div>
                                <div class="mt-8 form-group float-right">
                                    <a prev="name" next="trigger" onclick="$('#wizName').append('<li>' + $('#wizAppName').val() + '</li>'), $('#nameCheck').show(500);" class="btn btn-success btnNext" >Next</a>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="trigger" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="app-search-block" style="padding:5px !important;">
                                    <div id="triggerWrapper" class="search-compair-bx">
                                        <div id="fetchTrigger" class="form-group">
                                            <label>Please Select a Trigger App</label>
                                            <input type="text" name="" placeholder="Search for an app" class="form-control typeahead">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div id="triggerDetailsWrapper" class="col-lg-12" style="display: none; text-align: center">
                                            <img id="trigImg" src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt="" style="width:70px; margin: 0 auto;">
                                            <h4 id="trigTitle"></h4>
                                            <div id="triggers" class="list-group col-lg-10">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 form-group float-right">
                                    <a prev="name" next="trigger"  class="btn btn-warning btnPrevious" >Previous</a>
                                    <a prev="trigger" next="action" onclick="setTriggerName()" id="triggerNext" class="btn btn-success btnNext disabled" >Next</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="action" role="tabpanel" aria-labelledby="v-pills-messages-tab">

                                <div class="app-search-block">
                                    <div class="search-compair-bx">
                                        <div id="fetchAction" class="form-group">
                                            <label>Please Select an Action App</label>
                                            <input type="text" name="" placeholder="Search for an action app" class="form-control typeahead">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div id="actionDetailsWrapper" class="col-lg-12" style="display: none; text-align: center">
                                            <img id="actionImg" src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt="" style="width:70px; margin: 0 auto;">
                                            <h4 id="actionTitle"></h4>
                                            <div id="actions" class="list-group col-lg-10">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-8 form-group float-right">
                                    <a prev="trigger" next="action" onclick="setPreviousTrigger()" class="btn btn-warning btnPrevious" >Previous</a>
                                    <a prev="action" next="final" class="btn btn-success btnNext disabled" onclick="setActionName()" id="actionNext" >Next</a>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                <div class="col-lg-12" id='configSetUp'>
                                    
                                </div>
                                <div class="mt-8 form-group float-right">
                                    <a prev="action" next="final" onclick="setPreviousAction()" class="btn btn-warning btnPrevious" >Previous</a>
                                    <a class="btn btn-success" >Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" name="trig_id" id="trig_id" />
    <input type="hidden" name="trig_name" id="trig_name" />
    <input type="hidden" name="action_id" id="action_id" />
    <input type="hidden" name="action_name" id="action_name" />
    <input type="hidden" name="has_config" id="has_config" />
    <input type="hidden" name="action_config" id="action_config" />
    <input type="hidden" name="img_config" id="img_config" />
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var trigger_app = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '<?php echo base_url(); ?>wizard/fetchTriggerApp',
            remote: {
                url: '<?php echo base_url(); ?>wizard/fetchTriggerApp/%QUERY',
                wildcard: '%QUERY'
            }
        });

        $('#fetchTrigger .typeahead').typeahead(null, {
            name: 'app_name',
            display: 'app_name',
            source: trigger_app,
            limit: 15,
            templates: {
                suggestion: Handlebars.compile(`<div class="row" onClick="fetchAppFunction('{{app_id}}','{{app_name}}','{{app_img}}')"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="<?php echo $url->assets ?>{{app_img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{app_name}}</div></div>`)
            }
        });
        
        $('#fetchAction .typeahead').typeahead(null, {
            name: 'app_name',
            display: 'app_name',
            source: trigger_app,
            limit: 15,
            templates: {
                suggestion: Handlebars.compile(`<div class="row" onClick="fetchAppAction('{{app_id}}','{{app_name}}','{{app_img}}')"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="<?php echo $url->assets ?>{{app_img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{app_name}}</div></div>`)
            }
        });

        showConfigSetUp = function (app, app_img, has_config)
        {
            if(has_config==1)
            {
                $.ajax({
                    url: '<?php echo base_url(); ?>wizard/'+app,
                    method: 'post',
                    data: {img:app_img},
                    success: function (response) {
                        $('#actionCheck').hide(500);
                        $('#actionDetails').append('<li style="list-style:disclosure-closed; margin-left: 35px;" class="hasTrigger">Setup Config</li>');
                        $('#configSetUp').html(response);
                    }
                });
                
            }
        };

        fetchAppAction = function (app_id, app_name, app_img)
        {
            $('#fetchAction').hide();
            $('#actionDetails').append('<li>' + app_name + '</li>')
            $('#actionTitle').html('Select a ' + app_name + ' Trigger');
            $('#actionDetailsWrapper').show();
            $('#actionImg').attr('src', "<?php echo $url->assets ?>" + app_img);

            $.ajax({
                url: '<?php echo base_url(); ?>wizard/getActionAppFuncById/'+app_id,
                method: 'get',
                data: {},
                success: function (response) {
                    $('#actions').html(response)
                }
            });
        };

        fetchAppFunction = function (app_id, app_name, app_img)
        {
            $('#fetchTrigger').hide();
            $('#triggerDetails').append('<li>' + app_name + '</li>')
            $('#trigTitle').html('Select a ' + app_name + ' Trigger');
            $('#triggerDetailsWrapper').show();
            $('#trigImg').attr('src', "<?php echo $url->assets ?>" + app_img);

            $.ajax({
                url: '<?php echo base_url(); ?>wizard/getTrigAppFuncById/'+app_id,
                method: 'get',
                data: {},
                success: function (response) {
                    $('#triggers').html(response)
                }
            });
        };
        
        setTriggerName = function()
        {
            if($('#triggerDetails li').hasClass('hasTrigger'))
            {
                $('#triggerDetails li.hasTrigger').html($('#trig_name').val());
                $('#triggerCheck').show(500);
            }else{
                $('#triggerDetails').append('<li style="list-style:disclosure-closed; margin-left: 35px;" class="hasTrigger">' + $('#trig_name').val() + '</li>')
                $('#triggerCheck').show(500);
            }
        };
        
        setActionName = function()
        {
            
            var hasConfig = $('#has_config').val();
            
            if($('#actionDetails li').hasClass('hasTrigger'))
            {
                $('#actionDetails li.hasTrigger').html($('#action_name').val());
                $('#actionCheck').show(500);
            }else{
                $('#actionDetails').append('<li style="list-style:disclosure-closed; margin-left: 35px;" class="hasTrigger">' + $('#action_name').val() + '</li>');
                $('#actionCheck').show(500);
            }
            
            var img = $('#img_config').val();
            var action_config = $('#action_config').val();
            
            showConfigSetUp(action_config, img, hasConfig);
        };
        
        
        
        
        setPreviousTrigger = function()
        {
            $('#triggerCheck').hide(500);
        };
        
        setPreviousAction = function()
        {
            $('#actionCheck').hide(500);
        };

        $('.btnNext').click(function () {
            var prev = $(this).attr('prev');
            var next = $(this).attr('next');

            $('#' + prev + '-tab').removeClass('active');
            $('#' + prev).removeClass('show');
            $('#' + prev).removeClass('active');

            $('#' + next + '-tab').addClass('active');
            $('#' + next).addClass('show');
            $('#' + next).addClass('active');
        });

        $('.btnPrevious').click(function () {
            var prev = $(this).attr('prev');
            var next = $(this).attr('next');

            $('#' + prev + '-tab').addClass('active');
            $('#' + prev).addClass('show');
            $('#' + prev).addClass('active');

            $('#' + next + '-tab').removeClass('active');
            $('#' + next).removeClass('show');
            $('#' + next).removeClass('active');
        });
    })
</script>    
