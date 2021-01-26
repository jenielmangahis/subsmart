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
        margin: 0 250px 10px !important;
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
                            <a onmouseover="$(this).attr('style','cursor:pointer;background:#007bff;')" onmouseout="$(this).attr('style','cursor:pointer')" class="list-group-item" href="#addApp" data-toggle="modal">
                                <li style="vertical-align: middle">
                                    <i class="fa fa-2x fa-plus-circle fa-fw"></i> <span  style="vertical-align: middle; padding-bottom: 10px;">ADD an App</span>
                                </li>
                            </a>
                            <?php foreach ($wiz_apps as $wa): ?>
                            <li onclick="$(this).addClass('active'),checkApp(this), $('#deleteAppID').val('<?= $wa->id ?>'), setApp('<?= $wa->id ?>','<?= $wa->app_name ?>','<?= $wa->app_img ?>')" class="list-group-item" id="li_<?= $wa->id ?>" style="cursor: pointer" onmouseover="$(this).attr('style','cursor:pointer;background:#007bff;'),$('#delete_<?= $wa->id ?>').show() "  onmouseout="$('#delete_<?= $wa->id ?>').hide(),$(this).attr('style','cursor:pointer')">
                                <img  class="float-left" src="<?php echo $url->assets.$wa->app_img ?>" class="img-thumbnail" width="24" height="24" />&nbsp;&nbsp;<?= $wa->app_name ?> <a  id="delete_<?= $wa->id ?>" href="#deleteAppList" data-toggle="modal" class="text-danger"  style="position: absolute; right: -5px; top: -5px; display: none;"><i class="fa fa-minus-circle"></i></a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 row">
                    <h4 class="text-center">Wizard add app function (for dev use only)</h4>
                    <div class="wizard-app-block col-lg-12">
                        <div class="wizard-apps">
                            <div class="app-search-block">
                                <h6 id="app_title">Search for your App </h6>
                                <input type="hidden" id="app_name" />
                                <input type="hidden" id="app_id" />
                                <div id="searchWizApp" class="form-group div_margin">
                                    <div id="prefetch">
                                        <input type="text" name="search_box" id="search_box" placeholder="Search apps here. if apps not found add it first" class="form-control typeahead">

                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                                <div class="row col-lg-12" style="display:none;" id="addFunc">
                                    <div id="fList" class="row col-lg-12">
                                        <div class="col-lg-12 mb-5">
                                            <div class="form-group">
                                                <label>Title of the Function <br /> <small><span class="text-danger">Note: This is viewable to the users</span></small></label>
                                                <input type="text" name="" id="fn_nice" placeholder="Please enter the Title of the function" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Function Name <br /> <small><span class="text-danger">ex. createCalendar</span></small></label>
                                                <input type="text" name="" id="fn_name" placeholder="Please enter name of function" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description <br /> <small><span class="text-danger">Note: This is viewable to the users</span></small></label>
                                                <textarea class="form-control" cols="10" rows="10" id="fn_desc" placeholder="Please enter Description" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <a href="#" class="btn btn-sm btn-success float-right" onclick="setFunc()">Add Function</a>

                                            </div>
                                        </div>
                                        <h6 style="margin-bottom: 10px !important;">List of Functions</h6>
                                        <table id="tableFunc" app_id="" class="table table-stripped">
                                            <tr>
                                                <th>#</th>
                                                <th>Title of Function</th>
                                                <th>Name of Function</th>
                                                <th>Description</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            <tbody id="fList-body">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
    
<div id="deleteAppList" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="padding:5px !important;">
            <div class="bg-danger">
                <div class="col-lg-12">
                    <h5 style="font-size:20px;" class="modal-title text-white text-center col-lg-12">Are you sure you want to delete this App? Please note that is cannot be undone.</h5>
                </div>
                <div class="row justify-content-center mb-2 mt-2">
                    <button data-dismiss="modal" class="btn btn-sm btn-warning mr-2">NO</button>
                    <button data-dismiss="modal" class="btn btn-sm btn-success" onclick="deleteApp()">YES</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div id="deleteAppFunc" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content" style="padding:5px !important;">
            <div class="bg-danger">
                <div class="col-lg-12">
                    <h5 style="font-size:20px;" class="modal-title text-white text-center col-lg-12">Are you sure you want to delete this Function? This cannot be undone</h5>
                </div>
                <div class="row justify-content-center mb-2 mt-2">
                    <button data-dismiss="modal" class="btn btn-sm btn-warning mr-2">NO</button>
                    <button data-dismiss="modal" class="btn btn-sm btn-success" onclick="deleteAppFunc()">YES</button>
                </div>
            </div>
        </div>
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
                    <label>Link to the app icon<br /> <span><small class="text-danger muted">Note: Please make sure to upload your icon on the assets folder. <br />(e.g. css/icons/images/schedule-icon.svg)</small></span></label>
                    <input type="text" name="" id="app_icon" placeholder="Please enter App icon link" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary float-right" onclick="submitApp()">Submit</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="deleteAppID" />
<input type="hidden" id="deleteAppFuncID" />

<?php include viewPath('includes/footer_wizard'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        
        checkApp = function(app){
           $('.list-group li').each(function(){
               if($(this).hasClass('active')){
                   $(this).removeClass('active');
                   $('#'+$(app).attr('id')).addClass('active')
               }
           });
            
        };

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

    function submitApp()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/addApp',
            method: 'post',
            data: {app_name: $('#wiz_app').val(), app_icon: $('#app_icon').val()},
            success: function (response) {
                alert(response);
                location.reload();
            }
        });
    }

    function setApp(app_id, app_name, app_img)
    {
        var tableAppID = $('#tableFunc').attr('app_id');
        if(tableAppID!=app_id)
        {
            $('#fList-body').html('');
        }
        var app_title = '<div class="col-md-6 float-left" style="padding-right:5px; padding-left:5px;"><img class="float-left" src="<?php echo $url->assets ?>' + app_img + '" class="img-thumbnail" width="48" /> <h5 class="text-left">' + app_name + '</h5></div>'
        $('#app_title').html(app_title);
        $('#app_id').val(app_id);
        $('#app_name').val(app_name);
        $('#searchWizApp').hide();
        $('#addFunc').show();

        $.ajax({
            url: '<?php echo base_url(); ?>wizard/fetchAppFunc',
            method: 'post',
            data: {fn_id: $('#app_id').val()},
            success: function (response) {
                $('#tableFunc').attr('app_id', app_id);
                $('#fList-body').append(response);
            }
        });
    }

    setFunc = function ()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/addAppFunc',
            method: 'post',
            data: {fn_id: $('#app_id').val(), fn_name: $('#fn_name').val(), fn_desc: $('#fn_desc').val(), fn_nice: $('#fn_nice').val()},
            success: function (response) {
                alert(response);
                $('#fList-body').append('<tr><td></td><td>' + $('#fn_nice').val() + '</td><td>' + $('#fn_name').val() + '</td><td>' + $('#fn_desc').val() + '</td></tr>');
            }
        });
    };
    
    
    deleteAppFunc = function()
    {
        var id = $('#deleteAppFuncID').val()
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/deleteAppFunc',
            method: 'post',
            data: {fn_id: id},
            dataType: 'json',
            success: function(response) {
                if(response.success)
                {
                    alert(response.msg)
                    $('#appList_'+id).remove();
                }else{
                    alert(response.msg)
                }
            }
            
        });
    };
    
    deleteApp = function(){
    
        var deleteAppID = $('#deleteAppID').val();
        
        $.ajax({
            url: '<?php echo base_url(); ?>wizard/deleteApp',
            method: 'post',
            data: {app_id: deleteAppID},
            dataType: 'json',
            success: function(response) {
                if(response.success)
                {
                    alert(response.msg);
                    $('#li_'+deleteAppID).remove();
                }else{
                    alert(response.msg);
                }
            }
            
        });
    
    };
    

</script>