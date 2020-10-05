<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php include viewPath('includes/header'); ?>

<style>
    .module_ac {
        background: #f2f2f2;
        border-radius: 1px;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 10px;
        border: 1px solid #32243d !important;
        margin-bottom: 20px;
        flex-flow: wrap;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .module_ac_full {
        background: #f2f2f2;
        border-radius: 1px;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 10px;
        border: 1px solid #32243d !important;
        margin-bottom: 20px;
        flex-flow: wrap;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .module_ac_{
        flex: 0 0 97.33%;
        max-width: 100%;
        height: 100%;
        flex-direction: column; /*added*/
        display: inline-block;
        grid-gap: 15px;
        position: relative;
        padding-right: 15px;
        padding-left: 15px;
        padding-bottom: 15px;
        float: left;
        overflow-y:auto;
        overflow-x: auto;
        white-space: nowrap;
    }
    .module_header{
        /** background-color: #5f0a87;
      background-image: linear-gradient(326deg, #862987 0%, #5f0a87 74%); */
        background-color: #32243d;
        color : #fff;
        text-align: center;
        font-size: 11px;
        max-height: 20px;
        max-width: 100%;
        margin-bottom: 3px;
    }
    .module_title{
        padding-top: 1px;
    }

    .required{
        color : red!important;
    }

    .form-control  {
        font-size: 11px !important;
        height: 20px !important;
        line-height: 5%;
    }
    .form-controls{
        font-size: 11px !important;
        line-height: 150%;
    }
    label{
        font-size: 10px !important;
        margin-bottom: 1px !important;
    }
    hr{
        border: 0.5px solid #32243d !important;
        width: 100%;
    }
    .form-group {
        margin-bottom: 2px !important;
    }
    .banking-tab-container {
        border-bottom: 1px solid grey;
        padding-left: 0;
    }
    .form-line{
        padding-bottom: 1px;
    }
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
    .input_select{
        color: #363636;
        border: 2px solid #e0e0e0;
        box-shadow: none;
        display: inline-block !important;
        width: 100%;
        background-color: #fff;
        background-clip: padding-box;
        font-size: 11px !important;
    }
</style>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/customer'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6" style="padding-left: 40px;">
                            <h6 >New Advance Customer</h6>
                            <a class="btn btn-primary btn-md" href="#"><span class="fa fa-print "></span> Print</a>
                        </div>

                        <div class="cards">
                            <div class="card-body">
                                <div class="row" >
                                    <div class="col-md-12">
                                        <div class="cards">
                                            <div class="card-body">
                                                <div class="col-md-12">
                                                    <form id="customer_form">
                                                        <div class="row">
                                                            <table cellpadding="0" cellspacing="0" width="911" style="border-collapse: collapse;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="" valign="top">
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;padding-right:-41px !important;">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_profile');
                                                                                ?>
                                                                            </table>
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_billing');
                                                                                ?>
                                                                            </table>
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_alarm');
                                                                                ?>
                                                                            </table>
                                                                        </td>
                                                                        <td align="" valign="top" >
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_office');
                                                                                ?>
                                                                            </table>
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_access');
                                                                                ?>
                                                                            </table>
                                                                            <table width="440" border="0" cellspacing="0" cellpadding="0" style="margin-top:-21px !important;">
                                                                                <?php
                                                                                    include viewPath('customer/adv_module_sheets/module_notes');
                                                                                ?>
                                                                            </table>
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            <table cellpadding="0" cellspacing="0" width="911" style="border-collapse: collapse;">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?php
                                                                            include viewPath('customer/adv_module_sheets/module_devices');
                                                                        ?>
                                                                        <table width="" border="0" cellspacing="0" cellpadding="0">
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <input type="hidden" value="<?php if(isset($profile_info)){ echo $profile_info->prof_id; } ?>" class="form-control" name="prof_id" id="prof_id" />
                                                        <div class="col-md-12">
                                                                <div class="row">
                                                                    <a href="<?php echo base_url('customer') ?>">
                                                                        <button type="button" class="btn btn-primary btn-md "><span class="fa fa-remove"></span> Cancel </button> &nbsp;
                                                                    </a>
                                                                    <button type="submit" class="btn btn-primary btn-md" name="" id="" ><span class="fa fa-paper-plane-o"></span> Save </button>
                                                                </div>
                                                        </div>
                                                    </form>
                                                    <div id="readroot" class="col-md-12" style="display: none;">
                                                        <a align="left" style="color:#58bc4f; padding-top:1px;font-size: 10px !important;" href="javascript:void(0);" onclick="this.parentNode.parentNode.removeChild(this.parentNode);" >
                                                            <span class="fa fa-minus"></span>Remove</a>
                                                        <!--  <a href="javascript:void(0);">Action/Notes</a>-->
                                                        <br>
                                                        <label for="">Device Name</label>
                                                        <input type="text" class="form-control col-md-2 device" name="device_name[]" id="device_name" />

                                                        <label for="">Sold By</label>
                                                        <input type="text" class="form-control col-md-2 device" name="sold_by[]" id="sold_by" />

                                                        <label for="">Points</label>
                                                        <input type="number" class="form-control col-md-2 device" name="device_points[]" id="device_points" />

                                                        <label for="">Retail Cost</label>
                                                        <input type="number" class="form-control col-md-2 device" name="retail_cost[]" id="retail_cost" />

                                                        <br>
                                                        <label for="">Purchase Price</label>
                                                        <input type="number" class="form-control col-md-2 device" name="purch_price[]" id="purch_price" />

                                                        <label for="">Quantity</label>
                                                        <input type="number" class="form-control col-md-2 device" name="device_qty[]" id="device_qty" />

                                                        <label for="">Total Points</label>
                                                        <input type="number" class="form-control col-md-2 device" name="total_points[]" id="total_points" />

                                                        <label for="">Total Cost</label>
                                                        <input type="number" class="form-control col-md-2 device" name="total_cost[]" id="total_cost" />

                                                        <br>
                                                        <label for="">Total Purch Price</label>
                                                        <input type="number" class="form-control col-md-2 device" name="total_purch_price[]" id="total_purch_price" />

                                                        <label for="">Net</label>
                                                        <input type="number" class="form-control col-md-2 device" name="device_net[]" id="device_net" />
                                                        <br>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card -->
                                     <br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- end container-fluid -->

                        <!-- Lead Type Modal -->
                        <div class="modal fade" id="modal_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Assign</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="modal_form_assign">
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group" id="customer_type_group">
                                                    <label for="">Assign Name</label><br/>
                                                    <select id="fk_user_id" name="fk_user_id" data-customer-source="dropdown" class="form-control searchable-dropdown" required>
                                                        <option value="">Select</option>
                                                        <?php foreach ($employees as $employee): ?>
                                                            <option value="<?= $employee->id; ?>"><?= $employee->FName.' '.$employee->LName; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha512-2xXe2z/uA+2SyT/sTSt9Uq4jDKsT0lV4evd3eoE/oxKih8DSAsOF6LUb+ncafMJPAimWAXdu9W+yMXGrCVOzQA==" crossorigin="anonymous"></script>

<script>


    $(document).ready(function () {
        $('#ssn').keydown(function (e) {
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

        $("#date_picker").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#bill_start_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });
        $("#bill_end_date").datetimepicker({
            format: "l",
            //minDate: new Date(),
        });



        $(".date_picker").datetimepicker({
            format: "l",
            //'setDate': new Date(),
            //minDate: new Date(),
        });
        $('.date_picker').val(new Date().toLocaleDateString());

        //$('.time_picker').val(new Date().toLocaleTimeString());

        // $(".time_picker").datetimepicker({
        //     format: "LT",
        // });

        $('.timepicker').timepicker('setTime', new Date().toLocaleTimeString());

        var table_assign_module = $('#assign_module_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var note = $('#notes_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
        var devices_table= $('#devices_table').DataTable({
            "lengthChange": false,
            "searching" : true,
            "pageLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#customer_form").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "/customer/add_data_sheet",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    if(data === "Added"){
                        sucess("New Customer has been Added Successfully!");
                    }else if(data === "Updated"){
                        sucess("Customer Info has been Updated Successfully!");
                    }else{
                        console.log(data);
                    }

                }
            });
        });
        function save_sucess(information){
            Swal.fire(
                'Good job!',
                information,
                'success'
            );
        }
        function sucess(information){
            Swal.fire({
                title: 'Good job!',
                text: information,
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#32243d',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    window.location.href="/customer";
                }
            });
        }

        var counter = 0;

        function moreFields() {
            counter++;
            var newFields = document.getElementById('readroot').cloneNode(true);
            newFields.id = '';
            newFields.style.display = 'inline';
            var newField = newFields.childNodes;

            //console.log(newField);
            for (var i=0;i<newField.length;i++) {
                var theName = newField[i].name;
                if (theName){
                  //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        }
       // window.onload = moreFields;
        // $("#moreFields").on( "click", function( event ) {
        //     alert("sf");
        //
        // });
        // $("#moreFields").on( "click", function( event ) {
        //     moreFields();
        // });

        $("body").delegate("#moreFields", "click", function(){
            //alert("Delegated Button Clicked");
            //moreFields();
            counter++;
            var newFields = document.getElementById('readroot').cloneNode(true);
            newFields.id = '';
            newFields.style.display = 'inline';
            var newField = newFields.childNodes;

            //console.log(newField);
            for (var i=0;i<newField.length;i++) {
                var theName = newField[i].name;
                if (theName){
                    //  newField[i].name = theName+'[]';
                }

            }
            var insertHere = document.getElementById('writeroot');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        });

    });
</script>
