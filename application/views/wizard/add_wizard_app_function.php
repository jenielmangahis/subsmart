<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>
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
                <div class="col-lg-2 col-md-3 col-sm-4 float-left">
                    <div class="wizard-leftbar ziper-sidebar">
                        <div class="wizard-title creatwibx">
                            <h2>APP LIST</h2>
                        </div>
                        <ul class="list-group">
                            <?php foreach ($wiz_apps as $wa): ?>
                                <li class="list-group-item"><?= $wa->app_name ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 row">
                    <h4 class="text-center">Wizard add app function</h4>
                    <div class="wizard-app-block col-lg-10">
                        <div class="wizard-apps">
                            <div class="app-search-block">
                                <h6 id="app_title">Search for your App <a href="#addApp" data-toggle="modal" class="float-right" ><i class="fa fa-plus-square fa-fw" > </i>ADD an APP</a></h6>
                                <input type="hidden" id="app_name" />
                                <div id="searchWizApp" class="form-group div_margin">
                                    <div id="prefetch">
                                        <input type="text" name="search_box" id="search_box" placeholder="Search apps here. if apps not found add it first" class="form-control typeahead">
                                        
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
<div id="addApp" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="padding:5px !important;">
            <div class="modal-header">
                <h5 class="modal-title">Add an App</h5>
                <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name of the app</label>
                    <input type="text" name="" id="wiz_app" placeholder="Please enter name of app" class="form-control">
                </div>
                <div class="form-group">
                    <label>Link to the app icon<br /> <span><small class="text-danger muted">Note: Please make sure to upload your icon on the assets folder</small></span></label>
                    <input type="text" name="" id="app_icon" placeholder="Please enter App icon link" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary float-right" onclick="submitApp()">Submit</button>
            </div>
        </div>
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
                suggestion: Handlebars.compile(`<div class="row" onClick="setApp('{{app_id}}','{{app_name}}','{{app_img}}')"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="<?php echo $url->assets ?>{{app_img}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{app_name}}</div></div>`)
            }
        });
    });
    
    function setApp(app_id, app_name, app_img)
    {
        var app_title = '<div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img class="float-left" src="<?php echo $url->assets ?>'+app_img+'" class="img-thumbnail" width="48" /> <h5>'+app_name+'</h5></div>'
        $('#app_title').html(app_title);
        $('#app_name').val(app_id);
        $('#searchWizApp').hide();
    }
    
    function submitApp()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/addApp',
            method: 'post',
            data: {app_name: $('#wiz_app').val(),app_icon:$('#app_icon').val()},
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    }
    
</script>