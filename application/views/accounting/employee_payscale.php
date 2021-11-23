<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid" style="padding:3%;">

            <h3>Gross annual Salary calculation</h3>
            <a href="<?php echo url('/accounting/reports') ?>" style="color: blue;"> << Back to Reports</a>

            <div class="row" style="padding:3%;">
                <div class="col-md-12">

                    <span><h6>Employee Name: John Doe</h6><span>
                    <span><h6>Role: Web Developer</h6><span>
                    <span><h6>Start Date: 03/06/18</h6><span>
                    <span><h6>Location: New York, NY, USA</h6><span>
                    <br><br>
                        <!-- <div class="col-md-1">

                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-1">

                        </div> -->
                    <!-- </div> -->

                    <table class="table employee_details">
                        <thead style="background-color:#EEEEEE;font-weight:bold;">
                            <th><b>ROLE</b></th>
                            <th><b>AMOUNT</b></th>
                            <th><b>EXPERIENCE</b></th>
                            <th><b>COEFF.</b></th>
                            <th><b>SENIORITY</b></th>
                            <th><b>AMOUNT</b></th>
                            <th><b>GROSS SALARY</b></th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control role_name" name="role_name">
                                        <option value="">--Select Role--</option>
                                        <option value="0">+ Add New</option>
                                        <!-- <option>Web Developer</option>
                                        <option>Accountant</option>
                                        <option>Marketing</option>
                                        <option>Product</option>
                                        <option>HR</option>
                                        <option>Support</option>
                                        <option>QA Tester</option> -->
                                        <?php foreach($roles as $role): ?>
                                            <option value="<?php echo $role->id; ?>" role-amount="<?php echo $role->role_amount; ?>"><?php echo $role->role_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><span>$30,000.00</span></td>
                                <td>
                                    <select class="form-control">
                                        <option>Tier A</option>
                                        <option>Tier B</option>
                                        <option>Tier C</option>
                                        <option>Tier D</option>
                                        <option>Tier E</option>
                                        <option>Tier F</option>
                                    </select>
                                </td>
                                <td style="width:180px;">
                                    <input type="text"  class="form-control" value="X 1,00" readonly>
                                    <!-- <select class="form-control" readonly>
                                        <option>X 1,00</option>
                                        <option>X 1,10</option>
                                        <option>X 1,20</option>
                                        <option>X 1,30</option>
                                        <option>X 1,40</option>
                                        <option>X 1,50</option>
                                    </select> -->
                                </td>
                                <td>
                                    <select class="form-control">
                                        <option>Tier A</option>
                                        <option>Tier B</option>
                                        <option>Tier C</option>
                                        <option>Tier D</option>
                                        <option>Tier E</option>
                                        <option>Tier F</option>
                                    </select>
                                </td>
                                <td style="width:180px;"><input type="text"  class="form-control" value="1,000" readonly></td>
                                <td><span>$31,000.00</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <div style="float:right;">
                        <a href="#" class="btn btn-danger">Save Changes</a>
                    </div>

                </div>
            </div>

        </div>
            <!-- end row -->
    </div>
        <!-- end container-fluid -->


                                    <!-- Modal -->
                                    <div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-labelledby="addroleLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addroleLabel">Add Role</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>Role name</span>
                                                    <input type="texy" class="form-control role_name_text" name="role_name_text" placeholder="e.g Developer">
                                                    <br>
                                                    <span>Amount</span>
                                                    <input type="texy" class="form-control role_amount" name="role_amount" placeholder="$0.00">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary save_role">Save role</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#rules_table').DataTable({
            "paging":false,
            "language": {
                "emptyTable": "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>

<script>
$(".role_name").change(function () {
    var role_name = this.value;
    var role_amount = $(this).attr('role-amount');
    // var roleID = this.value;
    if(role_name == '0')
    {
        // alert(role_name);
        // $('#addrole').dialog('open');
        $('#addrole').modal('show');
    }
    else
    {
        // alert('test');

        var roleID = this.value;

        $.ajax({
            type: 'GET',
            url: "<?php echo base_url(); ?>accounting/get_role_amount",
            data: {
                roleID: roleID
            },
            success: function(result) {
                alert('test';)
            },
            error: function() {
                alert("An error has occurred");
            },

        });
    }
});    
</script>

<script>
$(document).on('click touchstart', '.save_role', function() {
    // alert('test');

    var role_name = $(".role_name_text").val();
    var role_amount = $(".role_amount").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/save_role",
            data: {
                role_name: role_name,
                role_amount: role_amount
            },
            success: function(result) {
                sucess("Added Successfully!");
                
                // $('.employee_details').html(result);
                // alert('Email Successfully!');
            },
            error: function() {
                alert("An error has occurred");
            },

        });

    // else 
    // {
    // 	alert('no');
    // }

});

function sucess(information, $id) {
    Swal.fire({
        title: 'Success!',
        text: information,
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#32243d',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
    if (result.value) {
        location.reload();
        }
    });
}

</script>
