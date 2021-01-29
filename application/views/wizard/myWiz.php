<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
<style type="text/css">
    .tt-suggestion
    {
        margin: 0 !important;
    }
    .wizard-app-block .form-group {
        margin: 0 250px 30px !important;
    }
    .app-img {
        margin: 0 -14px !important;
    }
    .app-listing-box ul li {
        width: 17% !important;
    }
    
    .wizDetails {
        margin: 0 0 10px 40px;
    }
    .wizDetails > li {
        list-style: disc;
    }
    
    .trigFunc:hover, .trigFunc > p:hover{
        background: #007bff;
        color: white;
    }
    
    
    #triggers{
        position: relative;
        margin: 0 auto;
    }
    
    .trigFunc h5{
        font-size: 18px !important;
    }
    
    
    .trigFunc p{
        margin-left:20px;
        text-align: left;
    }
    
    .text-bold{
        font-weight: bold;
    }
    
</style>
<div class="row">
    <div class="col-md-2">
        <div class="wrapper" role="wrapper">
            <?php include viewPath('includes/sidebars/upgrades'); ?>
        </div>
    </div>
    <div class="col-md-10">
        <!-- Wizard -->
        <section class="wizard-wrp">
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="wizard-leftbar ziper-sidebar">
                            <div class="wizard-title creatwibx">
                                <a href="#createWizard" data-toggle="modal"><h2>Create a WiZ</h2></a>
                            </div>
                            <div class="wizard-tabs">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tb10">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tb1">Wizard Builder</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tb2">My Wiz</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-8">
                        <h1 style="font-size: 32px; font-weight: bold; color: #111; margin: 0 0 45px; text-align: center;">
                            <img src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt="" style="    display: block; margin: 0 auto 20px;width:85px;"> My WiZs</h1>

                        <div class="wizard-right wizar-add-main">
                                <!-- <h1 style="font-size: 32px; font-weight: bold; color: #111; margin: 0 0 45px; text-align: center;"><img src="<?php echo $url->assets ?>wizard/img/wizard-ic.png" alt=""> Welcome to Wizard</h1> -->

                            <div class="tab-content">
                                <div class="tab-pane active">
                                    <table class='table table-striped table-responsive-sm table-hover'>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 25%">Name of Wiz</th>
                                            <th style="width: 30%" class="text-center">Trigger App - Function</th>
                                            <th style="width: 30%" class="text-center">Action App - Function</th>
                                            <th style="width:15%; text-align: center">Status</th>
                                        </tr>
                                        <?php 
                                            $i = 0;
                                              foreach($wiz as $myWiz): $i++;
                                                $trigApp = $this->wizardlib->getAppsByfunction($myWiz->wa_trigger_app_id);
                                                $actionApp = $this->wizardlib->getAppsByfunction($myWiz->wa_action_app_id);
                                                      
                                                      ?>
                                        <tr>
                                            <td ><?= $i ?></td>
                                            <td><?= $myWiz->wa_name ?></td>
                                            <td class="text-center">
                                                <span> 
                                                    <!--<img class="float-left" src="<?php echo $url->assets.'/'.$trigApp->app_img ?>" width="35">-->
                                                    <?= $trigApp->app_name.' - '.$trigApp->wiz_app_nice_name ?>
                                                </span>
                                            </td>
                                            <td class="text-center"><?= $actionApp->app_name.' - '.$actionApp->wiz_app_nice_name ?></td>
                                            <td class="text-center">
                                                <div class="onoffswitch">
                                                    <input <?= $myWiz->wa_is_enabled?'checked':'' ?> type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ" id="onoff-WiZ">
                                                    <label class="onoffswitch-label" for="onoff-WiZ">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Wizard -->
    </div>
</div>
<?php include viewPath('includes/footer_wizard'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

<script type="text/javascript">
    $(document).ready(function () {

        var sample_data = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: '<?php echo base_url(); ?>wizard/fetch',
            remote: {
                url: '<?php echo base_url(); ?>wizard/fetch/%QUERY',
                wildcard: '%QUERY'
            }
        });


        $('#prefetch .typeahead').typeahead(null, {
            name: 'sample_data',
            display: 'app_name',
            source: sample_data,
            limit: 15,
            templates: {
                suggestion: Handlebars.compile(`<div class="row" onClick="myfunc('{{app_id}}','{{app_name}}','{{app_img}}')"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="<?php echo $url->assets ?>{{app_img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{app_name}}</div></div>`)
            }
        });
    });

    function myfunc(app_id, app_name, app_img)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/show_app',
            method: 'post',
            data: {app_id: app_id},
            dataType: 'json',
            success: function (response) {
                var mydiv = document.getElementById("ulid");
                var newcontent = document.createElement("li");
                newcontent.innerHTML = "<li id='li_" + app_id + "'><div class='app-imgbx'><div class='app-img'><img src='<?php echo $url->assets ?>" + app_img + "' alt=''><a href='#' onClick='del_app(" + app_id + ")'><i class='fa fa-times'></i></a></div></div><p>" + app_name + "</p></li>";

                while (newcontent.firstChild) {
                    mydiv.appendChild(newcontent.firstChild);
                }

            }
        });
    }

    function del_app(app_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/del_app',
            method: 'post',
            data: {app_id: app_id},
            dataType: 'json',
            success: function (response) {
                document.getElementById('li_' + app_id).remove();
            }
        });
    }
</script>

<?php $this->load->view('wizard/create_wizard_modal');