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
        <img src="<?=base_url()?>assets/images/uploading.gif" class="" style="width: 80px;" alt="" />
        <center><p id="overlay_message">Processing...</p></center></div>
</div>

<div class="wrapper" role="wrapper" style="">
    <div class="container">
            <div class="row">
            <div class="col-md-12">
                <div class="full-screen-modals">
                    <!-- Modal content-->
                    <div class="modal-header" style="background: #f4f5f8;">
                        <h6>Connect your policy to nSmarTrac</h6>
                        <a href="<?= base_url('accounting/workers-comp') ?>"><button type="button" class="close" ><i class="fa fa-times fa-lg"></i></button></a>
                    </div>
                    <div class="modal-body" style="background-color:white;">
                        <form id="regForm" action="<?php echo site_url('accounting/addQuote');?>">
                                    <div style="padding:3%;border: solid gray 1px;width:60%;margin:-5px 20% 1% 20%;">
                                        <h4>Connect your policy to nSmarTrac</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Current insurance carrier</h6>
                                                <select class="form-control" id="mRole">
                                                    <option value="AmTrust">AmTrust</option>
                                                    <option value="The Hartford">The Hartford</option>
                                                    <option value="Employers">Employers</option>
                                                    <option value="FirstComp/Markel">FirstComp/Markel</option>
                                                    <option value="CNA">CNA</option>
                                                    <option value="Travelers">Travelers</option>
                                                    <option value="Guard">Guard</option>
                                                    <option value="Other (please specify)">Other (please specify)</option>
                                                </select>
                                                <input type="text" class="form-control" id="insuranceCarrier" style="margin-top:10px;">
                                                <br>
                                                <h6>Policy renewal date</h6>
                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            <select class="form-control" id="renewaldateMonth">
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" id="renewaldateyears">
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p style="font-size: 12px;margin-bottom:10px;">Connecting your policy does not change anything about your current policy or billing method.</p>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            <div class="col-md-6" style="padding:5%;">
                                                <p style="font-weight:bold;font-size:20px;">Why connect?</p>
                                                <div class="container">
                                                    <!-- completed -->
                                                    <div class="step2 completed">
                                                        <div class="v-stepper">
                                                            <div class="circle"></div>
                                                            <div class="line"></div>
                                                        </div>

                                                        <div class="content" style="padding:1%;">
                                                            Sign up for automatic policy renewal reminders to help you stay covered at the best price. <br><br>
                                                        </div>
                                                    </div>

                                                    <!-- active -->
                                                    <div class="step2 completed">
                                                        <div class="v-stepper">
                                                            <div class="circle"></div>
                                                            <div class="line"></div>
                                                        </div>

                                                        <div class="content" style="padding:1%;">
                                                            Learn if your policy qualifies for Pay As You Go billing through nSmarTrac.<br><br>
                                                        </div>
                                                    </div>

                                                    <!-- regular -->
                                                    <div class="step2 completed">
                                                        <div class="v-stepper">
                                                            <div class="circle"></div>
                                                            <div class="line"></div>
                                                        </div>

                                                        <div class="content" style="padding:1%;">
                                                            Gain access to trusted insurance experts.<br><br>
                                                        </div>
                                                    </div>

                                                </div>

                                                <button type="button" class="btn btn-success" style="float:right;">Get connected</button>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        </div>
                        <div style="margin: auto;text-align: center;">
                            <span style="font-size: 14px"><i class="fa fa-lock fa-lg" style="color: rgb(225,226,227);margin-right: 15px"></i>At nSmartrac, the privacy and security of your information are top priorities.</span>
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
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>js/folders_files.js"></script>
<script src="<?php echo $url->assets ?>js/add.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>

<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!--Accounting JS-->
<?php echo put_footer_assets();?>

<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?> ;
</script>

<script>
    $('#open_stripe').click(function () {
        const openWin = window.open('https://connect.stripe.com/oauth/v2/authorize?response_type=code&client_id=ca_KBQqImsoRKsn8QTIvr9DdP0dH37hPQ3Y&scope=read_write','Ratting','width=550,height=650,left=450,top=200,toolbar=0,status=0');
        var timer = setInterval(function() {
            if(openWin.closed) {
                clearInterval(timer);
                fetch('<?=base_url()?>api/check_stripe_api_connected').then(function(response) {
                    return response.json();
                }).then(function(data) {
                    console.log(data);
                }).catch(function() {
                    console.log("Booo");
                });
            }
        }, 1000);
    });
    $('.click-stripe').click(function () {
        $('.accounts-list').hide();
        $('.stripe-container').show();
    });
    $('.close-stripe-container').click(function () {
        $('.stripe-container').hide();
        $('.accounts-list').show();
    });

    $('.click-paypal').click(function () {
        $('.accounts-list').hide();
        $('.paypal-container').show();
    });
    $('.close-paypal-container').click(function () {
        $('.paypal-container').hide();
        $('.accounts-list').show();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#paypal_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url:  "<?=base_url()?>api/on_save_paypal_credentials",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function (data) {
                    if(data === "1"){
                        nsmartrac_alert('Nice!','Paypal crendentials saved!','success');
                    }
                    document.getElementById('overlay').style.display = "none";
                    $('.paypal-container').hide();
                    $('.accounts-list').show();
                }
            });
        });

        $("#stripe_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            $.ajax({
                type: "POST",
                url:  "<?=base_url()?>api/on_save_stripe_crendetials",
                data: form.serialize(), // serializes the form's elements.
                beforeSend: function() {
                    $("#overlay_message").text('Saving Stripe Credentials...');
                    document.getElementById('overlay').style.display = "flex";
                },
                success: function (data) {
                    if(data === "1"){
                        nsmartrac_alert('Nice!','Stripe Crendentials Saved!','success');
                    }
                    document.getElementById('overlay').style.display = "none";
                    $('.stripe-container').hide();
                    $('.accounts-list').show();
                }
            });
        });
    } );


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
</script>

</body>

</html>
