<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <style>
    .checkboxcontainer input {
  display: none;
}

.checkboxcontainer {
  display: inline-block;
  padding-left: 30px;
  position: relative;
  cursor: pointer;
  user-select: none;
}

.checkboxcontainer .checkmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  background: white;
  position: absolute;
  left: 0;
  top: 0;
  border: 1px solid black;
}

.checkboxcontainer input:checked + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:indeterminate + .checkmark {
  background-color: #1390e5;
  border: 1px solid #1390e5;
}

.checkboxcontainer input:checked + .checkmark:after {
  content: "";
  position: absolute;
  height: 6px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 45%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(-45deg);
}

.checkboxcontainer input:checked:disabled + .checkmark {
    border: 1px solid grey;
    background-color: grey;
}

.checkboxcontainer input:disabled + .checkmark {
    border: 1px solid grey;
}

.checkboxcontainer input:indeterminate + .checkmark:after {
  content: "";
  position: absolute;
  height: 0px;
  width: 11px;
  border-left: 2px solid white;
  border-bottom: 2px solid white;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) rotate(180deg);
}
    </style>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
          <div class="card">
              <div class="page-title-box pt-1 pb-0">
                  <div class="row align-items-center">
                      <div class="col-sm-12">
                          <h3 style="font-family: Sarabun, sans-serif">MERCHANT ACCOUNT APPLICATION</h3>
                      </div>
                  </div>
              </div>
            <!-- end row -->
            <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>COMPANY INFORMATION</h6>
                </div>
            </div>
            <br>
            <form action="<?php echo base_url('accounting/sendmerchantEmail'); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA NAME</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CONTANCT NAME</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS TYPE</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS 1</b> <i>(NO PO BOX)</i></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA ADDRESS 2</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>DBA PHONE NO.</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>EMAIL ADDRESS</b><span class="required_field">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MOBILE PHONE NO.</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>YEAR ESTABLISHED</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LENGTH OF CURRENT OWNERSHIP</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>YEARS</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MONTHS</b><span class="required_field">*</span></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>OTHER ADDRESS <i> (IF DIFFERENT FROM ABOVE)</i></h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>MAILING</b></label> -->
                        <label class="checkboxcontainer"> MAILING
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>SHIPPING</b></label> -->
                        <label class="checkboxcontainer"> SHIPPING
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>SEE ALSO SPECIAL INSTRUCTIONS</b> <i>(MORE THAN ONE OPTION MAY BE SELECTED)</i></label> -->
                        <label class="checkboxcontainer"> <b>SEE ALSO SPECIAL INSTRUCTIONS</b> <i>(MORE THAN ONE OPTION MAY BE SELECTED)</i>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LOCATION NAME</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>PHONE NO.</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CONTACT NO.</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>BEST CONTACT NO.</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>BEST TIME TO CALL</b></label>
                        <!-- <input type="text" class="form-control" name="name" id="name"> -->
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="name" id="name" placeholder="From">
                            </div>
                            <div class="col-md-1" style="margin-top:10px;">
                                <i class="fa fa-arrows-h" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="name" id="name" placeholder="To">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>FAX NO.</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ADDRESS</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12" style="background-color:#32243d;padding:1px;text-align:center;color:white;">
                    <h6>PRINCIPAL 1 INFORMATION <i> (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</i></h6>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <!-- <input type="checkbox">
                        <label for=""><b>BENEFICIAL OWNER: PERCENTAGE OF OWNERSHIP</b></label> -->
                        <label class="checkboxcontainer"> <b>BENEFICIAL OWNER: PERCENTAGE OF OWNERSHIP</b>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                        </label>
                        <input type="text" name="name" id="name" style="padding: 12px 20px;
                                                                        margin: 8px 0;
                                                                        box-sizing: border-box;
                                                                        border-radius: 4px;"> <label for=""><b> %</b></label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>AUTHORIZED SIGNER</b></label> -->
                        <label class="checkboxcontainer"> <b>AUTHORIZED SIGNER</b>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                    <br>
                        <!-- <input type="checkbox">
                        <label for=""><b>SOLE PROPRIETOR</b></label> -->
                        <label class="checkboxcontainer"> <b>SOLE PROPRIETOR</b>
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>FIRST NAME</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>MIDDLE NAME</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>LAST NAME</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ADDRESS</b></label> <i>(NO PO BOX)</i>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>PHONE NO</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE/PROVINCE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP/POSTAL CODE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group" id="customer_type_group" style="background-color:#E8E8E9;padding:2px;">
                        <label for=""> <i><b> PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS </b></i></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>HOME ADDRESS</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>CITY</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>STATE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" id="customer_type_group">
                        <label for=""><b>ZIP CODE</b></label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
            </div>
            
            <br><br>
                            <div class="row">
                                <div class=" col-md-12">
                                <label style="font-weight:bold;font-size:14px;">TERMS AND CONDITIONS</label>
                                    <div style="height:200px; overflow:auto; background:#FFFFFF;"
                                         id="showuploadagreement">
                                        This application will be sent to an Elavon account manager:  
                                        <br>Joyce Reynolds
                                        <br>Account Manager, Customer Account Team
                                        <br>P. 678.731.5796 &emsp; F. 678-731-3173 <u style="text-decoration:underline;">joyce.reynolds@elavon.com</u>
                                        <br>
                                        <br>Elavon l North America Revenue
                                        <br>Elavon Atlanta Concourse
                                        <br>Two Concourse Parkway NE l Suite 600 l Atlanta, GA 30328 l <u style="text-decoration:underline;">www.elavon.com </u>
                                        <br>
                                        <br>An Elavon agent will be contacting you for more specific information to further your request for a merchant account.  Any link  you make to or from the 3rd Party Website will be at your own risk.   Any use of the 3rd Party Website will be subject to and any information you provide will be governed by the terms of the 3rd Party Website, including those relating to confidentiality, data privacy and security.
                                        <br>
                                        <br>Unless otherwise expressly agreed in writing, nSmarTrac and its affiliates are not in any way associated with the owner or operator of the 3rd Party Website or responsible or liable for the goods and services offered by them or for anything in connection with such 3rd Party Website. nSmarTrac does not endorse or approve and makes no warranties, representations or undertakings relating to the content of the 3rd Party Website.  
                                        <br>
                                        <br>In addition to the terms stated in nSmarTrac Important Legal Notices, nSmarTrac disclaims liability for any loss, damage and any other consequence resulting directly or indirectly from or relating to your access to the 3rd Party Website or any information that you may provide or any transaction conducted on or via the 3rd Party Web site or the failure of any information, goods or services posted or offered at the 3rd Party Website or any error, omission or misrepresentation on the 3rd Party Website or any computer virus arising from or system failure associated with the 3rd Party Website.
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <div class=" col-md-12">
                                    <!-- <a href="#" class="btn btn-primary">Proceed</a>  -->
                                    <input type="submit" value="Proceed" class="btn btn-primary">
                                    <i>By clicking "Proceed", you will be confirming that you have read and agreed to the terms herein and in the Important Legal Notices.</i>
                                </div>
                            </div>
            </form>
            <!-- end card -->
            </div>




        </div>

        <style>

        </style>
        <?php echo form_close(); ?>
    </div>
    <!-- end container-fluid -->
</div>

<?php include viewPath('includes/footer'); ?>
<script>
    $("#date_of_birth").datetimepicker({
        format: "L",
        //minDate: new Date(),
    });

    $(function () {
        $('#sss_num').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 6) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });

        $('.phone_number').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    });
</script>

<style>
    .btn-primary.disabled, .btn-primary:disabled {
        color: #000 !important;
        background-color: #ccc !important;
        border-color: #ccc !important;
    }
</style>
