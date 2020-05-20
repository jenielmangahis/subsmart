<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/inquiries'); ?>
    <link href="<?php echo $url->assets ?>css/jquery.signaturepad.css" rel="stylesheet">

    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">New Lead</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Add your new lead.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('WORKORDER_MASTER')) : ?>
                                    <a href="<?php echo base_url('inquiries') ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> Go Back to Inquiries
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <?php echo form_open_multipart('inquiries/save', ['class' => 'form-validate require-validation', 'id' => 'inquiry_form', 'autocomplete' => 'off']); ?>
            <style>

            </style>
            <div class="row custom__border">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Basic Info</h3>
                                </div>
                                <div class="col-md-12 margin-bottom-ter no-padding">
                                    <div class="form-group" id="inquiry_type_group">
                                        <label for="">Cutomer Type</label><br/>
                                        <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                            <input type="radio" name="inquiry_type" value="Residential"
                                                   checked="checked" id="inquiry_type"
                                                   onchange="toggle_advance_options()">
                                            <label for="inquiry_type"><span>Residential</span></label>
                                        </div>
                                        <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                            <input type="radio" name="inquiry_type" value="Commercial" id="Commercial"
                                                   onchange="toggle_advance_options()">
                                            <label for="Commercial"><span>Commercial</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group" style="display: none" id="company_div">
                                    <label for="contact_name">Company <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" id="contact_name"
                                        required placeholder="Enter Name" autofocus
                                        onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-6 form-group" style="display: none" id="company_div_empty">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="contact_name">Contact Name <span id="company_div" style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="contact_name" id="contact_name"
                                           required placeholder="Enter Name" autofocus
                                           onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="contact_phone">Phone <span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="contact_phone" id="contact_phone"
                                           placeholder="(555) 555-5555"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="contact_email">Email</label>
                                    <input type="email" class="form-control" name="contact_email" id="contact_email"
                                           placeholder="Enter Email" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-auto form-group">
                                    <label for="">Preferred notification method</label><br/>
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="checkbox" name="notify_by" value="Email" checked
                                               id="notify_by_email">
                                        <label for="notify_by_email"><span>Email</span></label>
                                    </div>
                                    <div class="checkbox checkbox-sec margin-right my-0 mr-3">
                                        <input type="checkbox" name="notify_by" value="SMS" checked id="notify_by_sms">
                                        <label for="notify_by_sms"><span>SMS/Text</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Contact Address </h3>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="street_address">Street Address</label>
                                    <input type="text" class="form-control" name="street_address" id="street_address"
                                           required placeholder="Enter Name" autofocus
                                           onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="suite_unit">Suite/Unit</label>
                                    <input type="text" class="form-control" name="suite_unit" id="suite_unit" required
                                           placeholder="Enter Name" autofocus
                                           onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city" id="city" required
                                           placeholder="Enter Name" autofocus
                                           onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="zip">Zip/Postal Code</label>
                                    <input type="text" class="form-control" name="zip" id="zip" required
                                           placeholder="Enter Name" autofocus
                                           onChange="jQuery('#inquiry_name').text(jQuery(this).val());"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="state">State/Province</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="" selected="selected">- select -</option>
                                        <?php foreach (get_config_item('states') as $key => $state) { ?>
                                            <option value="<?php echo $key ?>"><?php echo $state; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="inquiry_source">Source</label>
                                    <select id="inquiry_source" name="inquiry_source_id"
                                            data-inquiry-source="dropdown" class="form-control searchable-dropdown"
                                            placeholder="Select">
                                        <option value="0">- none -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="notes">Comments <small>(some remarks for internal use)</small></label>
                                    <textarea name="notes" cols="40" rows="3" class="form-control"
                                              autocomplete="off"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
                                    <a href="<?php echo url('inquiries') ?>" class="btn btn-danger">Cancel this</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>

            <?php echo form_close(); ?>

            <!-- Modal Service Address -->
            <div class="modal fade" id="modalServiceAddress" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Service Address</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Additional Contact -->
            <div class="modal fade" id="modalAdditionalContacts" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAddNewSource" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Source</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="frm_add_new_source" name="modal-form" method="post">
                                <div class="validation-error" style="display: none;"></div>
                                <div class="form-group">
                                    <label>Source Name</label> <span class="form-required">*</span>
                                    <input type="text" name="title" value="" class="form-control"
                                           autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary save">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script>

    document.getElementById('contact_mobile').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    document.getElementById('contact_phone').addEventListener('input', function (e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    function validatecard() {
        var inputtxt = $('.card-number').val();

        if (inputtxt == 4242424242424242) {
            $('.require-validation').submit();
        } else {
            alert("Not a valid card number!");
            return false;
        }
    }
</script>