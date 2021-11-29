<?php include viewPath('includes/header_no_navbar'); ?>
<style>
    tr.hide-table-padding td {
        padding: 0;
    }
    svg#svg-sprite-menu-close {
        position: relative;
        bottom: 178px !important;
    }
    .nav-close {
        margin-top: 52% !important;
    }
    .bank-img-container img{
        width:auto !important;
    }
</style>

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
    .disableds{
        background-color: #1b1e21;
    }
</style>
<div id="overlay">
    <div>
        <img src="<?=base_url()?>assets/img/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p id="overlay_message">Processing...</p></center></div>
</div>

<div class="wrapper" role="wrapper" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full-screen-modals">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" style="background: #f4f5f8;">
                                    <h6>Import bank transactions</h6>
                                    <a href="<?= base_url('accounting/link_bank') ?>"><button type="button" class="close" ><i class="fa fa-times fa-lg"></i></button></a>
                                </div>
                                <div class="modal-body">
                                    <form id="import_transaction">
                                        <div class="row" id="step1">
                                            <div class="col-sm-5">
                                                <h5>Step 1</h5>
                                                <div class="modal-container box-bank-container">
                                                    <div class="centered-container">
                                                        <center><img style="width: 100px;" src="<?php echo base_url('assets/img/accounting/Artboard_230-512.png') ?>" alt=""></center>
                                                    </div>
                                                    <div style="margin-top: 70px;">
                                                        <h4 >Manually upload your transactions</h4>
                                                        <ol>
                                                            <li>1. Open a new tab and sign in to your bank.</li>
                                                            <li>2. Download transactions: CSV only.</li>
                                                            <li>3. Close the tab and return to nSmartrac.</li>
                                                        </ol>
                                                    </div>
                                                    <div>
                                                        <h5 >Select a file to upload</h5>
                                                        <div class="custom-file">
                                                                <input type="file" name="file" class="custom-file-input" id="uploadTransaction" accept=".csv">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2" style="padding-top: 250px;"><h1 class="modal-title" style="text-align: center;font-size: 46px;">OR</h1></div>
                                            <div class="col-sm-4">
                                                <br><br>
                                                <div class="modal-container box-bank-container" style="width: 100%">
                                                    <div class="centered-container">
                                                        <center><img style="width: 100px;" src="<?php echo base_url('assets/img/accounting/bank-security-system-621346.png') ?>" alt=""></center>
                                                    </div>
                                                    <div style="margin-top: 70px;">
                                                        <h4 style="margin: 20px 20px 30px 20px; ">Securely connect your bank</h4>
                                                        <ol>
                                                            <li>More secure. No need to share files with bank data.</li>
                                                            <li>No work. Transactions come in from your bank automatically.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" >
                                                <br>
                                                <button type="button" style="justify-content: right;" class="btn btn-success" id="toStepTwo"><span class="fa fa-arrow-right"></span> Next</button>
                                            </div>
                                        </div>
                                        <div class="row" id="step2" style="display:none">
                                            <div class="col-sm-6">
                                                <h5 >Step 2</h5>
                                                <div class="modal-container box-bank-container">
                                                    <div style="margin-top: 70px;">
                                                        <h5 style="margin: 20px 20px 30px 20px; ">Which account are these transactions from?</h5>
                                                    </div>
                                                    <div>
                                                        <h6 style="margin: 20px 20px 30px 20px;">Select connected account</h6>
                                                            <select id="account" name="account" class="form-control" >
                                                                <option  value=""></option>
                                                                <option  value="CC">Credit Card</option>
                                                                <option  value="Stripe">Stripe</option>
                                                                <option  value="Paypal">Paypal</option>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-12" >
                                                <button style="justify-content: left;" class="btn btn-success" id="toStepOne"><span class="fa fa-arrow-left"></span> Back</button>
                                                <button style="justify-content: right;" class="btn btn-success" id="toStepThree"><span class="fa fa-arrow-right"></span> Next</button>
                                            </div>
                                        </div>
                                        <div class="row" id="step3" style="display:none">
                                            <div class="col-sm-6" >
                                                <div class="modal-container box-bank-container">
                                                    <h5>Step 3</h5>
                                                    <div>
                                                        <h6 style="margin: 20px 20px 30px 20px;">Select the fields that correspond to your file</h6>

                                                            <div class="row">
                                                                <label> Date</label>
                                                                <select id="transDate" name="transDate" class="form-control" required>
                                                                    <option  value="">Select field</option>
                                                                </select>
                                                            </div>
                                                            <div class="row form_line">
                                                                <label> Description</label>
                                                                <select id="transDesc" name="transDesc" class="form-control" required>
                                                                    <option  value="">Select field</option>
                                                                </select>
                                                            </div>
                                                            <div class="row form_line">
                                                                <label> Amount</label>
                                                                <select id="transMoneyRec" name="transMoneyRec" class="form-control" required>
                                                                    <option  value="">Select field</option>
                                                                </select>
                                                            </div>
                                                            <div class="row form_line">
                                                                <label> Payee</label>
                                                                <select id="transMoneySpent" name="transMoneySpent" class="form-control" required>
                                                                    <option  value="">Select field</option>
                                                                </select>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="display:none">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="submit" class="btn btn-success"><span class="fa fa-upload"></span> Import Now</button>
                                        </div>
                                    </form>
                                    <div style="margin: auto;text-align: center;">
                                        <br>
                                        <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
                                    </div>
                                </div>
                            </div>
                    <!--end of modal-->
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">Copyright © 2020 nSmartrac. All rights reserved.</div>
        </div>
    </div>
</footer><!-- End Footer -->


<script type="text/javascript">
    var base_url = "<?php echo base_url();?>";
</script>
<!-- jQuery  -->

<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script
    src="<?php echo $url->assets ?>plugins/jquery-initialize/jquery.initialize.min.js">
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?> ;
</script>

<script type="text/javascript">
    $('#toStepTwo').click(function () {
        if($("#uploadTransaction").val() === ""){
            nsmartrac_alert("Warning!","Please upload file before proceeding to Step 2.","warning");
        }else{
            $('#step1').hide();
            $('#step2').show();
        }
    });

    $('#toStepOne').click(function () {
        $('#step2').hide();
        $('#step1').show();
    });

    $('#toStepThree').click(function () {
        $('#step2').hide();
        $('#step3').show();
        $('.modal-footer').show();
    });

    function nsmartrac_alert(title='Awesome',text,icon='success',redirect=''){
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.value) {
                if(redirect !== ''){
                    window.location.href='<?= base_url(); ?>'+redirect;
                }
            }
        });
    }
    $(document).ready(function() {
        $("#import_transaction").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?= base_url('processing/onPostCSVValue'); ?>",
                data: new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                success: function(data) {
                    console.log(data);
                    document.getElementById('overlay').style.display = "none";
                    if(data.success){
                        nsmartrac_alert('Nice',data.message,'success','accounting/link_bank');
                    }else{
                        nsmartrac_alert('Warning',data.message,'warning');
                    }
                }, beforeSend: function() {
                    document.getElementById('overlay').style.display = "flex";
                }
            });
        });


        $("#uploadTransaction").change(function(){
            console.log("A file has been selected.");

            var fileInput = document.getElementById('uploadTransaction');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('file', file);
            console.log(formData);
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "<?= base_url() ?>processing/onGetCSVHeaders",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    console.log('Sending Now!');
                },
                success: function (response) {

                    console.log(response);
                    var head = response.data;
                    //var csvHeaders  = Object.keys(head[0]);
                    var toAppend = '';
                    $.each(head,function(i,o){
                        toAppend += '<option value='+i+'>'+i+'</option>';
                    });
                    $('#transDate').append(toAppend);
                    $('#transDesc').append(toAppend);
                    $('#transMoneyRec').append(toAppend);
                    $('#transMoneySpent').append(toAppend);
                },
                error: function (e) {
                    console.log("ERROR : ", e);
                }
            });
        });
    });
</script>

</body>

</html>
