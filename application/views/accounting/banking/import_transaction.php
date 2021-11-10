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
                            <div class="modal-content">
                                <div class="modal-header" style="background: #f4f5f8;">
                                    <h6>Import bank transactions</h6>
                                    <a href="<?= base_url('accounting/link_bank') ?>"><button type="button" class="close" ><i class="fa fa-times fa-lg"></i></button></a>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="modal-container box-bank-container">
                                                <div class="centered-container">
                                                    <center><img style="width: 100px;" src="<?php echo base_url('assets/img/accounting/Artboard_230-512.png') ?>" alt=""></center>
                                                </div>
                                                <div style="margin-top: 70px;">
                                                    <h4 style="margin: 20px 20px 30px 20px; ">Manually upload your transactions</h4>
                                                    <ol>
                                                        <li>1. Open a new tab and sign in to your bank.</li>
                                                        <li>2. Download transactions: CSV, QFX, QBO, OFX or TXT format only.</li>
                                                        <li>3. Close the tab and return to nSmartrac.</li>
                                                    </ol>
                                                </div>
                                                <div>
                                                    <h5 style="margin: 20px 20px 30px 20px;">Select a file to upload</h5>
                                                    <form style="margin: 20px 20px 30px 20px;">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2" style="padding-top: 250px;"><h1 class="modal-title" style="text-align: center;font-size: 46px;">OR</h1></div>
                                        <div class="col-sm-5">
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


                                        <div class="col-sm-6" id="form2">
                                            <div class="modal-container box-bank-container">
                                                <div style="margin-top: 70px;">
                                                    <h5 style="margin: 20px 20px 30px 20px; ">Which account are these transactions from?</h5>
                                                </div>
                                                <div>
                                                    <h6 style="margin: 20px 20px 30px 20px;">Select connected account</h6>
                                                    <form style="margin: 20px 20px 30px 20px;">
                                                        <select id="account" name="account" class="form-control" >
                                                            <option  value=""></option>
                                                            <option  value="CC">Credit Card</option>
                                                            <option  value="Stripe">Stripe</option>
                                                            <option  value="Paypal">Paypal</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                        <div style="display: flex;justify-content: center;">
                                            <button class="btn btn-success">Connect</button>
                                        </div>
                                    </div>
                                    <div style="margin: auto;text-align: center;">
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

<script type="text/javascript">
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
