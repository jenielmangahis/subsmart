<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
    <!-- page wrapper start -->
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/workorder'); ?>
        <?php include viewPath('includes/notifications'); ?>
        <div wrapper__section>
            <div class="container-fluid">
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <h1>Settings</h1>

                        <?php echo form_open('workorder/settings', ['class' => 'form-validate require-validation', 'id' => 'workorder_settings_form', 'autocomplete' => 'off']); ?>


                        <div class="validation-error hide"></div>

                        <div class="card p-3">
                            <div class="form-group">
                                <label>Work Order Number</label>
                                <div class="help help-sm help-block">Set the prefix and the next auto-generated
                                    number.
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="margin-bottom-qui">Prefix</div>
                                        <input type="text" name="next_custom_number_prefix" value="WO-"
                                               class="form-control" autocomplete="off">
                                        <span class="validation-error-field hide"
                                              data-formerrors-for-name="next_custom_number_prefix"
                                              data-formerrors-message="true"></span>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="margin-bottom-qui">Next number</div>
                                        <input type="text" name="next_custom_number_base" value="00434"
                                               class="form-control" autocomplete="off">
                                        <span class="validation-error-field hide"
                                              data-formerrors-for-name="next_custom_number_base"
                                              data-formerrors-message="true"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Work Order Template</label>
                                        <div class="help help-sm help-block">Select from the options below the fields
                                            you want hidden on your work order template.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="checkbox checkbox-sec margin-right">
                                                    <input type="checkbox" name="hide_from_email" value="1"
                                                           id="hide_from_email">
                                                    <label for="hide_from_email"><span>Hide business email</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr class="card-hr">

                        <div class="card">
                            <button class="btn btn-primary btn-lg" name="btn-submit" type="button"
                                    data-on-click-label="Save Changes..." disabled>Save Changes
                            </button>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
    <!-- end container-fluid -->
    </div>


    <!-- MODAL CREATE EVENT -->
    <div id="modalCreateEvent" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Up a Schedule</h4>
                </div>
                <div class="modal-body">
                    <p>loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="button_submit_form">Confirm</button>
                </div>
            </div>

        </div>
    </div>


    <!-- MODAL EVENT DETAILS -->
    <div id="modalEventDetails" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schedule</h4>
                </div>
                <div class="modal-body">
                    <p>loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete_schedule">Delete</button>
                    <button type="button" class="btn btn-primary" id="edit_schedule" style="display: none">Edit Schedule
                    </button>
                    <button type="button" class="btn btn-primary" id="edit_workorder" style="display: none">Edit
                        Wordorder
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?><?php
