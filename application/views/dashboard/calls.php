<style>
    .box{
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        border-top: 3px solid #d2d6de;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    }
    .box-header.with-border {
        border-bottom: 1px solid #f4f4f4;
    }
    .box-header {
        color: #444;
        display: block;
        padding: 10px;
        position: relative;
    }
    .box-header > .fa, .box-header > .glyphicon, .box-header > .ion, .box-header .box-title {
        display: inline-block;
        font-size: 18px;
        margin: 2px !important;
        line-height: 1;
    }
    .box-header > .box-tools {
        position: absolute;
        right: 10px;
        top: 5px;
    }
    .box.box-solid > .box-header > .box-tools .btn {
        border: 0;
        box-shadow: none;
    }
    .btn-box-tool {
        padding: 5px;
        font-size: 12px;
        background: transparent;
        color: #97a0b3;
    }
    .box-body {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px;
        padding: 10px;
    }
    .box .nav-stacked > li {
        border-bottom: 1px solid #f4f4f4;
        margin: 0;
    }
    .nav-stacked > li {
        float: none;
    }
    .nav-pills > li {
        float: left;
        width:100%;
        padding: 10px 0 !important;
    }
    .nav > li {
        position: relative;
        display: block;
    }
    .box-primary{
        border-top-color: #3c8dbc;
    }
    .bg-light-blue, .label-primary{
        background-color: #3c8dbc !important;
        color: white;
        font-weight: 500;
        padding: 3px;
        border-radius: 7px;
        font-size: 12px;
    }
    .has-feedback .form-control {
        padding-right: 42.5px;
        height:30px;
        font-size: 12px;
    }
    .form-control-feedback {
        position: absolute;
        top: 0;
        right: 0;
        z-index: 2;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        pointer-events: none;
    }
    .btn-group > .btn {
        border-radius: 10px !important;
    }
    .btn-group > .btn-group:not(:last-child) > .btn, .btn-group > .btn:not(:last-child):not(.dropdown-toggle) {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .btn-group > .btn-group:not(:first-child) > .btn, .btn-group > .btn:not(:first-child) {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
    .box-header .link{
        padding: 5px;
        font-size: 12px;
        border-radius: 5px;
    }
    #msgs_details{
        transition: 0.5s;
        max-height: 650px;
        overflow-y: scroll;
    }
    #msgs_body{
        transition: 0.5s;
        height:100vh;
        overflow-y:scroll; 
    }


    #msgs_body a.active, #msgs_body a.active p, #msgs_body a.active small {
        color: #f1f1f1;
        background-color: #3a7ee1;
    }

</style>
<div class="col-lg-12 align-content-center mt-5">
    <div class="col-md-11 float-left">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Calls and Logs</h3>
                <button style="height:30px;" id="btnSend" onclick="loadDialPad()" class="btn btn-outline link float-right">
                    <img src="<?= base_url('assets/ringcentral/').'dialpad.png' ?>" style="width:20px;"/>
                </button>
                <input type="hidden" id="replyTo" value="0" />
                <input type="hidden" id="replyToBase6" value="0" />
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding float-left col-lg-12 pr-0" id="msgs_body">
                <div class="progress" style="height:40px;"><div class="progress-bar progress-bar-striped bg-warning active" role="progressbar" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">System is fetching data</div></div>
            </div>
            <div id="msgs_details" class="float-left col-lg-8" style="display: none;">

            </div>
        </div>
        <!-- /. box -->
    </div>
</div>

<script type="text/javascript">
    
        function loadDialPad() {
            $('#dialpad').modal('show');
            $.ajax({
                url: '<?php echo base_url(); ?>ring_central/loadDialPad',
                method: 'GET',
                data: {id:''},
                success: function (response) {
                    $('#dialpadBody').html(response);
                }
            });
        }
</script>    