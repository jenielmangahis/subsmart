<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<style>
    .switch {
        position: relative !important;
        display: inline-block !important;
        width: 50px;
        height: 24px;
        float: right;
        margin-top: 6px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute !important;
        cursor: pointer !important;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute !important;
        content: "";
        height: 24px;
        width: 26px;
        left: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background: linear-gradient(to bottom, #45a73c 0%, #67ce5e 100%) !important;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3 !important;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px) !important;
        -ms-transform: translateX(26px) !important;
        transform: translateX(26px) !important;
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px !important;
    }

    .slider.round:before {
        border-radius: 50% !important;
    }
    .form-control {
        font-size: 12px;
        height: 30px !important;
        line-height: 150%;
    }
    label{
        font-size: 12px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 2px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 3px !important;
    }
    .required{
        color : red!important;
    }
    .msg-count-cus {
        height: 30px;
        width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card{
        box-shadow: 0 0 13px 0 rgb(116 116 117 / 44%) !important;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body hid-desk" >
                                <div class="col-auto">
                                    <h2 class="page-title">Customer Import</h2>
                                </div>
                                <div class="alert alert-warning col-md-12 mt-4" role="alert">
                                        <span style="color:black;">
                                            A great process to import all your customers.
                                        </span>
                                </div>
                                <form action="<?php echo base_url('customer/import_customer_data'); ?>" method="post" enctype="multipart/form-data" style="text-align: center;">
                                     <label for="file-upload" class="" style="font-size: 16px !important;">
                                         Choose file to Import ( .csv)
                                    </label>
                                    <hr>
                                    <br>
                                    <input id="file-upload" name="file" type="file" accept=".csv"/>
                                    <br><br>
                                    <div class="">
                                        <a href="<?= url('customer/') ?>">
                                            <button type="button" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-remove"></span> Cancel</button>
                                        </a>
                                        <button type="submit" name="importSubmit" class="btn btn-primary btn-md" id="exportCustomers"><span class="fa fa-download"></span> Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="cards">
                        <div class="card-body">
                            <div class="row" >
                                <div class="col-md-12">

                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- end container-fluid -->

<?php include viewPath('includes/footer'); ?>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).ready(function() {
        $("#file-upload").change(function(){
            console.log("A file has been selected.");
            var input = document.getElementById('file-upload');
            console.log(input.files);
            for (var i = 0; i < input.files.length; i++) {
                console.log(input.files[i]);
            }
           var fileInput = document.getElementById('file-upload');
            var file = fileInput.files[0];
            var formDatas = new FormData();
            formDatas.append('file', file);

        //console.log(formDatas);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "/customer/get_customer_import_header",
                data: formDatas,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    console.log('Sending Now!');
                },
                success: function (data) {
                   // console.log(data);
                    var head = JSON.parse(data)
                    var csvHeaders  = Object.keys(head[0]);
                    console.log(head);
                    $.each(csvHeaders,function(i,o){
                        console.log(o);
                    });
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                }
            });
        });
    });
</script>