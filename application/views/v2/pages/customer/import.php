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
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span><i class='bx bx-import'></i> Import Customer</span>
                                    <a class="nsm-button default btn-download-template" href="<?= base_url('uploads/import_templates/import_customer_template.csv'); ?>">Download Template</a>      
                                </div>
                            </div>
                            <div class="nsm-card-content">

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
                                            <div id="line"><div id="line-progress"></div></div>
                                            <!-- progress-bar-container -->
                                            <form id="import_customer" enctype="multipart/form-data" style="text-align: center;"> 
                                                <div id="progress-content-section">
                                                    <div class="section-content step1 active">
                                                        <h2><i class='bx bx-file'></i> Select CSV</h2>
                                                            <input id="file-upload" name="file" type="file" style="margin-top:21px;" accept=".csv"/>
                                                            <input  name="file2" value="1" type="hidden"/>           
                                                            <br />      
                                                            <br />                 
                                                            <button type="button" id="nextBtn1" class="nsm-button primary step step02 mt-4" disabled >Next <i class='bx bx-chevrons-right' ></i></button>                                                    
                                                    </div>
                                                    <div class="section-content step2">
                                                        <h2><i class='bx bx-table' ></i> Map Headings</h2>
                                                        <?php $fieldsValue = $import_settings->value ? explode(',', $import_settings->value) : array() ; ?>
                                                        <?php $headers = $importFieldsList;?>
                                                        <?php $i = 0; ?>
                                                        <table class="nsm-table">
                                                            <thead>
                                                                <tr>
                                                                    <td></td>
                                                                    <td data-name="Field"></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($headers as $header){ ?>        
                                                                    <?php if (in_array($header->id, $fieldsValue)) { ?>
                                                                        <tr>
                                                                            <td class="fw-bold nsm-text-primary" style="text-align:right;">
                                                                                <input type="hidden" name="settingHeaders[]" value="<?= $header->field_description; ?>" />
                                                                                <?php 
                                                                                    if( trim($header->field_description) == 'Phone (M)' ){
                                                                                        echo 'Mobile Number';
                                                                                    }elseif( trim($header->field_description) == 'Phone (H)' ){
                                                                                        echo 'Phone Number';
                                                                                    }else{
                                                                                        echo trim($header->field_description);
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                            <td>
                                                                                <select name="headers[]" class="form-control headersSelector" style="width:50%;" id="headersSelector<?= $i ?>">
                                                                                        <option value="">Select Heading</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    <?php $i++; ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>                                                   
                                                        <div class="result"></div>
                                                        <br>
                                                        <button type="button" class="nsm-button primary step step01" ><i class='bx bx-chevrons-left' ></i> Back</button>
                                                        <button type="button" class="nsm-button primary step step03" >Next <i class='bx bx-chevrons-right' ></i></button>
                                                    </div>
                                                    <div class="section-content step3">
                                                        <h2><i class='bx bx-search-alt-2' ></i> Import Preview</h2>
                                                        <?php $headers = $importFieldsList;?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div id="preview-import"></div>                                                                
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <button type="button" class="nsm-button primary step step02" ><i class='bx bx-chevrons-left' ></i> Back</button>
                                                        <button type="button" class="nsm-button primary" id="importCustomer"><i class='bx bx-import'></i> Import</button>                                            
                                                    </div>
                                                </div>
                                            </form>
                                        <!-- progress-wrapper -->
                                    </div>
                                </div>
                            </div>
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
<script>
    $(document).ready(function() {
        const $overlay = document.getElementById('overlay');
        var customerData = csvHeaders = [];

        $(".step").click(function () {
            $(this).nextAll().removeClass("active");
            $(this).addClass("active").prevAll().addClass("active");            
        });

        $(".step01").click(function () {
            $("#line-progress").css("width", "10%");
            $(".step1").addClass("active").siblings().removeClass("active");

            $(".step01").addClass("active");
            $(".step02").removeClass("active");
            $(".step03").removeClass("active");
        });

        $(".step02").click(function () {
            $("#line-progress").css("width", "50%");
            $(".step2").addClass("active").siblings().removeClass("active");

            $(".step02").addClass("active");         
            $(".step03").removeClass("active");   
        });

        $(".step03").click(function () {
            $("#line-progress").css("width", "100%");
            $(".step3").addClass("active").siblings().removeClass("active");
            $(".step03").addClass("active");         

            var form = new FormData($("#import_customer")[0]);

            $.ajax({    
                type: "POST",
                url: base_url + "customer/_import_preview",  
                data: form,
                processData: false,
                contentType: false,
                success: function(html) {    
                    $('#preview-import').html(html);                          
                },
                beforeSend: function() {
                    $('#preview-import').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });

        });

        $("#importCustomer").click(function(e) {
            // prepare form data to be posted
            var selectedHeader = [];
            $('select[name="headers[]"]').each(function() {
                selectedHeader.push(this.value);
            });

            const formData = new FormData();
            var settingHeaders = $('input[name="settingHeaders[]"]')
            formData.append('customers', JSON.stringify(customerData));
            formData.append('mapHeaders', JSON.stringify(selectedHeader));
            formData.append('csvHeaders', JSON.stringify(csvHeaders));
            formData.append('settingHeaders', JSON.stringify(csvHeaders));
            
            if ($overlay) $overlay.style.display = "flex";
            // perform post request
            fetch('<?= base_url('customer/importCustomerData') ?>', {
                method: 'POST',
                body: formData,
            }) .then(response => response.json() ).then(response => {
                if ($overlay) $overlay.style.display = "none";
                var { customer, csv, mapping, fields, dataValue, office, billing, profile, message, success }  = response;
                if(success){
                    sweetAlert('Import Customer','success',message ,1);
                }else{
                    sweetAlert('Sorry!','error',message);
                }

                console.log(response);
            }).catch((error) => {
                console.log('Error:', error);
            });
        });

        $("#file-upload").change(function(){
            const formData = new FormData();
            const fileInput = document.getElementById('file-upload');
            formData.append('file', fileInput.files[0]);

            if ($overlay) $overlay.style.display = "flex";
            fetch('<?= base_url('customer/getImportData') ?>', {
                method: 'POST',
                body: formData
            }) .then(response => response.json() ).then(response => {
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
                    //if (result.value) {
                        window.location.reload();
                    //}
                }
            });
        }

        $('.headersSelector').on('change', function(){
            // var selected = this.value;
            // var selectedHeader = [];
            // var head = [];

            // $('select[name="headers[]"]').each(function() {
            //     selectedHeader.push(this.value);
            // });

            // var ar = selectedHeader.length;
            // for(var x=0; x<ar; x++){
            //     head.push(x);
            // }

            // var arHead = head.length;

            // for(var x=0; x<ar; x++){
            //     if(selectedHeader[x] != ""){
            //         document.getElementById('headersSelector'+x).value = selectedHeader[x];
            //         var text = "headersSelector"+x+"";
            //         for(var i=0; i<arHead; i++){
            //             var text1 = "headersSelector"+i+"";
            //             if(text != text1){
            //                 $("#headersSelector"+i+" option[value='"+selectedHeader[x]+"'").remove();
            //             }
            //         }
            //     }
            // }
        });
    });
</script>