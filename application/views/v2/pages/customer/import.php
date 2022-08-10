<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<?php include viewPath('customer/css/import_customer_css'); ?>
<style>
     #overlay {
        display: none;
        background: rgba(255, 255, 255, 0.7);
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        top: 0;
        z-index: 9998;
        align-items: center;
        justify-content: center;
        margin: auto;
    }
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process to import all your customers.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="progress-wrapper" style="padding-bottom: 100px;">
                        <div id="progress-bar-container">
                                <ul>
                                <li class="step step01 active">
                                    <div class="step-inner">Step 1</div>
                                </li>
                                <li class="step step02">
                                    <div class="step-inner">Step 2</div>
                                </li>
                                <li class="step step03">
                                    <div class="step-inner">Step 3</div>
                                </li>
                                </ul>
                                <div id="line">
                                <div id="line-progress"></div>
                                </div>
                                <!-- progress-bar-container -->
                                <div id="progress-content-section">
                                <div class="section-content step1 active">
                                    <h2>Step 1</h2>
                                    <p>Industry Type Select and CSV Upload</p>

                                    <form id="import_customer" enctype="multipart/form-data" style="text-align: center;">
                                        <input id="file-upload" name="file" type="file" accept=".csv"/>
                                        <input  name="file2" value="1" type="hidden"/>
                                        <br><br>
                                        <button type="button" id="nextBtn1" class="btn btn-primary btn-sm step step02" disabled ><span class="fa fa-arrow-right"></span> Next</button>
                                    </form>
                                </div>
                                <div class="section-content step2">
                                    <h2>Step 2</h2>
                                    <p>Map Headings</p>
                                    <?php $fieldsValue = $import_settings->value ? explode(',', $import_settings->value) : array() ; ?>
                                    <?php $headers = $importFieldsList;?>
                                    <?php foreach ($headers as $header): ?>
                                        <?php if (in_array($header->id, $fieldsValue)) : ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <b ><?= $header->field_description; ?></b> <span class='mapping-line'>-----------------</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="headers[]" class="form-control headersSelector">
                                                            <option value="">Select Heading</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <br>
                                    <button type="button" class="btn btn-primary btn-sm step step01" ><span class="fa fa-arrow-left"></span> Back</button>
                                    <button type="button" class="btn btn-primary btn-sm step step03" ><span class="fa fa-arrow-right"></span> Next</button>
                                </div>
                                <div class="section-content step3">
                                    <h2>Step 3</h2>
                                    <p>Customer Preview </p>

                                    <?php $headers = $importFieldsList;?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table tbl" style="height: 100px;overflow-y: auto; overflow-x: hidden;border-collapse: collapse; ">
                                                <thead>
                                                    <tr id='tableHeader'></tr>
                                                </thead>
                                                <tbody id="imported_customer"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-primary btn-sm step step02" ><span class="fa fa-arrow-left"></span> Back</button>
                                    <button type="button" class="btn btn-primary btn-sm" id="importCustomer"><span class="fa fa-upload"></span> Import</button>
                                
                                </div>
                            </div>
                            <!-- progress-wrapper -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="overlay">
    <div>
        <img src="<?=base_url()?>/assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p>Processing...</p></center></div>
</div>
<?php include viewPath('v2/includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(".step").click(function () {
        $(this).addClass("active").prevAll().addClass("active");
        $(this).nextAll().removeClass("active");
    });

    $(".step01").click(function () {
        $("#line-progress").css("width", "8%");
        $(".step1").addClass("active").siblings().removeClass("active");
    });

    $(".step02").click(function () {
        $("#line-progress").css("width", "50%");
        $(".step2").addClass("active").siblings().removeClass("active");
    });

    $(".step03").click(function () {
        $("#line-progress").css("width", "100%");
        $(".step3").addClass("active").siblings().removeClass("active");
    });

    const $overlay = document.getElementById('overlay');
    var customerData = csvHeaders = [];
    $(document).ready(function() {

        $("#importCustomer").click(function(e) {
            // prepare form data to be posted
            
            var selectedHeader = [];
            $('select[name="headers[]"]').each(function() {
                selectedHeader.push(this.value);
            });

            const formData = new FormData();
            formData.append('customers', JSON.stringify(customerData));
            formData.append('mapHeaders', JSON.stringify(selectedHeader));
            formData.append('csvHeaders', JSON.stringify(csvHeaders));
            
            if ($overlay) $overlay.style.display = "flex";
            // perform post request
            fetch('<?= base_url('customer/importCustomerData') ?>', {
                method: 'POST',
                body: formData,
            }) .then(response => response.json() ).then(response => {
                if ($overlay) $overlay.style.display = "none";
                var { message, success }  = response;
                if(success){
                    sweetAlert('Awesome!','success',message ,1);
                }else{
                    sweetAlert('Sorry!','error',message);
                }
            }).catch((error) => {
                console.log('Error:', error);
            });
        });

        $('#customer_list_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 100,
            "info": true,
            "responsive": true,
            "order": [],
        });


        $("#file-upload").change(function(){
            console.log("A file has been selected.");
            const formData = new FormData();
            const fileInput = document.getElementById('file-upload');
            formData.append('file', fileInput.files[0]);

            if ($overlay) $overlay.style.display = "flex";
            fetch('<?= base_url('customer/getImportData') ?>', {
                method: 'POST',
                body: formData
            }) .then(response => response.json() ).then(response => {
                console.log(response);
                var { data, headers, success, message }  = response;
                if ($overlay) $overlay.style.display = "none";
                if(!success){
                    sweetAlert('Sorry!','error',message);
                }else{
                    $.each(headers,function(i,o){
                        $('.headersSelector').append(
                            '<option value="'+i+'">'+o+'</option>'
                        );
                        $('#tableHeader').append(
                            '<th><strong>'+o+'</strong></th>'
                        );
                    });

                    csvHeaders = headers;
                    customerData = data; // save customer array data

                    // process mapping preview
                    $.each(data,function(i,o){
                        var toAppend = '';
                        $.each(o,function(index,data){
                            toAppend += '<td>'+data+'</td>';
                        });
                        $('#imported_customer').append(
                            '<tr>'+toAppend+'</tr>'
                        );
                    });

                    $('#nextBtn1').prop("disabled", false);
                }
                }).catch((error) => {
                    console.log('Error:', error);
                });
            
        });

        function sweetAlert(title,icon,information,is_reload){
            Swal.fire({
                title: title,
                text: information,
                icon: icon,
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if(is_reload === 1){
                    if (result.value) {
                        window.location.reload();
                    }
                }
            });
        }
    });
</script>