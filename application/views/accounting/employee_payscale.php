<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Gross Annual Salary Calculation
                        </div>
                    </div>
                </div>

                <div class="row grid-mb">
                    <div class="col-12">
                        <div class="nsm-card primary" style="height: 50% !important;">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row g-1">
                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold">Employee Name:</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="content-subtitle"><?php echo $employee->FName . ' '. $employee->LName; ?></label>
                                            </div>

                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold">Role:</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="content-subtitle"><?php echo $employee->title; ?></label>
                                            </div>

                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold">Start Date:</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="content-subtitle"><?php echo $employee->date_hired; ?></label>
                                            </div>

                                            <div class="col-12 col-md-2">
                                                <label class="content-subtitle fw-bold">Location:</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <label class="content-subtitle"><?php echo $employee->address .', '. $employee->city .', '. $employee->state .', '. $employee->postal_code; ?></label>
                                            </div>
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <table class="nsm-table" id="payscale-view-details-table">
                                    <thead style="background-color:#EEEEEE; font-weight:bold;">
                                        <tr>
                                            <td data-name="Role">ROLE</td>
                                            <td data-name="Amount">AMOUNT</td>
                                            <td data-name="Experience">EXPERIENCE</td>
                                            <td data-name="Coeff.">COEFF.</td>
                                            <td data-name="Seniority">SENIORITY</td>
                                            <td data-name="Amount">AMOUNT</td>
                                            <td data-name="Gross Salary">GROSS SALARY</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control role_name" id="selected-role-name" name="role_name">
                                                    <option value="<?php echo $employee->id; ?>"><?php echo $employee->title; ?></option>
                                                    <option value="0">+ Add New</option>
                                                    <?php foreach($roles as $role): ?>
                                                        <option value="<?php echo $role->id; ?>" role-amount="<?php echo $role->role_amount; ?>"><?php echo $role->title; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td><span id="rolevalue"><?php echo $role->role_amount; ?></span></td>
                                            <td>
                                                <select class="form-control expRoleDropdown">
                                                    <option value="X 1,00">Tier A</option>
                                                    <option value="X 1,10">Tier B</option>
                                                    <option value="X 1,20">Tier C</option>
                                                    <option value="X 1,30">Tier D</option>
                                                    <option value="X 1,40">Tier E</option>
                                                    <option value="X 1,50">Tier F</option>
                                                </select>
                                            </td>
                                            <td style="width:180px;">
                                                <input type="text"  class="form-control expRolevalue" value="X 1,00" readonly>
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
                                                <select class="form-control seniorityDropdown">
                                                    <option value="1000">Tier A</option>
                                                    <option value="2000">Tier B</option>
                                                    <option value="3000">Tier C</option>
                                                    <option value="4000">Tier D</option>
                                                    <option value="5000">Tier E</option>
                                                    <option value="6000">Tier F</option>
                                                </select>
                                            </td>
                                            <td style="width:180px;"><input type="text"  class="form-control seniorityamount" value="1000" readonly></td>
                                            <td><span class="gross_salary">0.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>      
                                <div style="margin-top: 30px; text-align: center;">
                                    <a href="javascript:void(0)" id="btn-save-emp-payscale" class="btn btn-danger btn-save-emp-payscale">Save Changes</a>
                                </div>                                                     
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-labelledby="addroleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addroleLabel">Add Role</h5>
                <button type="button" name="btn_modal_close" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button> 
            </div>
            <div class="modal-body">
                <span>Role name</span>
                <input type="texy" class="form-control role_name_text" name="role_name_text" placeholder="e.g Developer" required>
                <br>
                <span>Amount</span>
                <input type="texy" class="form-control role_amount" name="role_amount" placeholder="$0.00" required>
            </div>
            <div class="modal-footer">
                <div id="validation-message-container" class="validation-message-container" style="color:red; bold"></div>
                <button type="button" name="btn_modal_close" class="nsm-button" data-bs-dismiss="modal">Close</button>                
                <button type="button" class="btn btn-primary save_role">Save role</button>
            </div>
        </div>
    </div>
</div>

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

    $(".role_name").change(function () {
        var role_name = this.value;
        var role_amount = $(this).attr('role-amount');

        var optiontest = $('option:selected', this).attr('role-amount');
        if(role_name == '0') {
            $('#addrole').modal('show');
        } else {
            $('#rolevalue').text(optiontest);

            var rolevalue = $('#rolevalue').text();
            var expRolevalueT = $('.expRolevalue').val();
            var seniorityamount = $('.seniorityamount').val();

            if (expRolevalueT == 'X 1,00')
            {
                expRolevalue = '1.0';
            }
            else if(expRolevalueT == 'X 1,20')
            {
                expRolevalue = '1.2';
            }
            else if(expRolevalueT == 'X 1,30')
            {
                expRolevalue = '1.3';
            }
            else if(expRolevalueT == 'X 1,40')
            {
                expRolevalue = '1.4';
            }
            else if(expRolevalueT == 'X 1,50')
            {
                expRolevalue = '1.5';
            }
            else if(expRolevalueT == 'X 1,60')
            {
                expRolevalue = '1.6';
            }

            var stotal = parseFloat(rolevalue) * parseFloat(expRolevalue);
            var total = parseFloat(stotal) + parseFloat(seniorityamount);

            $('.gross_salary').text(parseFloat(total).toFixed(2));
        }
    });    

    $(".expRoleDropdown").change(function () {
        var expValue = this.value;

        $('.expRolevalue').val(expValue);

        var rolevalue = $('#rolevalue').text();
        var expRolevalueT = $('.expRolevalue').val();
        var seniorityamount = $('.seniorityamount').val();

        if (expRolevalueT == 'X 1,00')
        {
            expRolevalue = '1.0';
        }
        else if(expRolevalueT == 'X 1,20')
        {
            expRolevalue = '1.2';
        }
        else if(expRolevalueT == 'X 1,30')
        {
            expRolevalue = '1.3';
        }
        else if(expRolevalueT == 'X 1,40')
        {
            expRolevalue = '1.4';
        }
        else if(expRolevalueT == 'X 1,50')
        {
            expRolevalue = '1.5';
        }
        else (expRolevalueT == 'X 1,60')
        {
            expRolevalue = '1.6';
        }

        var stotal = parseFloat(rolevalue) * parseFloat(expRolevalue);
        var total = parseFloat(stotal) + parseFloat(seniorityamount);

        $('.gross_salary').text(parseFloat(total).toFixed(2));
    });    

    $(".seniorityDropdown").change(function () {
        var expValue = this.value;
        $('.seniorityamount').val(expValue);
            var rolevalue = $('#rolevalue').text();
            var expRolevalueT = $('.expRolevalue').val();
            var seniorityamount = $('.seniorityamount').val();

            if (expRolevalueT == 'X 1,00')
            {
                expRolevalue = '1.0';
            }
            else if(expRolevalueT == 'X 1,20')
            {
                expRolevalue = '1.2';
            }
            else if(expRolevalueT == 'X 1,30')
            {
                expRolevalue = '1.3';
            }
            else if(expRolevalueT == 'X 1,40')
            {
                expRolevalue = '1.4';
            }
            else if(expRolevalueT == 'X 1,50')
            {
                expRolevalue = '1.5';
            }
            else if(expRolevalueT == 'X 1,60')
            {
                expRolevalue = '1.6';
            }

            var stotal = parseFloat(rolevalue) * parseFloat(expRolevalue);
            var total = parseFloat(stotal) + parseFloat(seniorityamount);
            $('.gross_salary').text(parseFloat(total).toFixed(2));
    });    

    $(".save_role").click(function(){
        var role_name   = $(".role_name_text").val();
        var role_amount = $(".role_amount").val();

        if(role_name == "" || role_amount == "") {
            $(".validation-message-container").html("Role name & amount is required.");
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/save_role",
            data: {
                role_name: role_name,
                role_amount: role_amount
            },
            success: function(result) {
                sucess("Added Successfully!");
            },
            error: function() {
                alert("An error has occurred");
            },

        });
    }); 
    
    $(".btn-save-emp-payscale").click(function(){
        var usrid    = <?php echo $usr_id; ?>;
        var roleid   = $("#selected-role-name").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>accounting/save_user_role",
            data: {
                usrid: usrid,
                roleid: roleid
            },
            success: function(result) {
                //if(result == 'Success') {
                    sucess("Update Successful!");
                //} else {
                //    alert("An error has occurred");
                //}
            },
            error: function() {
                alert("An error has occurred");
            },

        });
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

<?php include viewPath('v2/includes/footer'); ?>