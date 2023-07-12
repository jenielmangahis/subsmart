<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/job/job_settings_modals'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<style>
    .nsm-table {
        /*display: none;*/
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
        table {
        width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
        display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important;
     cursor: pointer; 
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/job_subtabs'); ?>
    </div>

    <div class="col-12" style="min-height:750px">
        <div class="nsm-page">
            <div class="nsm-page-content">                
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-3">                        
                        <form id="frm-update-job-settings">
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="nsm-card-header d-block">
                                                <div class="nsm-card-title">
                                                    <span>Job Order Number</span>
                                                </div>
                                                <label class="nsm-subtitle">Set the prefix and the next auto-generated number.</label>
                                            </div>
                                            <div class="nsm-card-content">
                                                <div class="row g-2">
                                                    <div class="col-12 col-md-3">
                                                        <input type="text" placeholder="Prefix" name="job_settings_prefix" id="number-prefix" class="nsm-field form-control" value="<?php echo $settings_prefix ?>" autocomplete="off" />
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <input type="text" placeholder="Next Number" name="job_settings_next_number" id="number-base" class="nsm-field form-control" value="<?php echo $settings_next_num; ?>" autocomplete="off" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-end">
                                            <hr>
                                            <button type="submit" class="nsm-button primary">Save Changes</button>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="nsm-card primary">
                            <div class="row">
                                <div class="col-6 grid-mb">
                                    <div class="nsm-field-group search form-group">
                                        <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOM_TAX_SEARCHBAR" placeholder="Search Tax Rate...">
                                    </div>
                                </div>
                                <div class="col-6 grid-mb text-end">
                                    <div class="nsm-page-buttons page-button-container">
                                        <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#new_tax_rate_modal">
                                        <i class='bx bxs-plus-circle' ></i> Add Tax Rate
                                        </button>                                        
                                    </div>
                                </div>
                            </div>
                            <table id="TAX_SETTINGS_TABLE" class="nsm-table">
                                <thead>
                                    <tr>
                                        <td class="table-icon"></td>
                                        <td data-name="Tax Rate Name">Tax Rate Name</td>
                                        <td data-name="Percent">Percent</td>
                                        <td data-name="Date Created">Date Created</td>
                                        <td data-name="Default">Default</td>
                                        <td data-name="Manage"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (!empty($tax_rates)) {
                                            foreach ($tax_rates as $rate) {
                                        ?>
                                    <tr>
                                        <td>
                                            <div class="table-row-icon">
                                                <i class='bx bx-receipt'></i>
                                            </div>
                                        </td>
                                        <td class="fw-bold nsm-text-primary"><?php echo $rate->name; ?></td>
                                        <td><?php echo $rate->rate; ?> %</td>
                                        <td><?php echo date("m-d-Y h:i A",strtotime($rate->date_created)); ?></td>
                                        <td><?php echo ($rate->is_default == 1) ? "<i style='font-size: 31px;' class='bx bx-check text-success'></i>" : ""?></td>
                                        <td>
                                            <div class="dropdown table-management">
                                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-item" href="javascript:void(0);" data-name="<?php echo $rate->name; ?>" data-percentage="<?php echo $rate->rate; ?>" data-id="<?php echo $rate->id; ?>" data-default="<?php echo $rate->is_default; ?>">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-item" href="javascript:void(0);" data-id="<?php echo $rate->id; ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        } 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">    
var TAX_SETTINGS_TABLE = $("#TAX_SETTINGS_TABLE").DataTable({
    'columnDefs': [       
       {
            "targets": 0,
            "width": "1%"
       },
       {
            "targets": 1,
            "width": "60%"
       },
       {
            "targets": 2,
            "width": "20%"            
       },
       {
            "targets": 3,
            "width": "10%"
       },
       {
            "targets": 4,
            "width": "3%",
            "className": "text-center",
       },
       {
            "targets": 4,
            "width": "5%"
            
       }
    ],
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});

$("#CUSTOM_TAX_SEARCHBAR").keyup(function() {    
    TAX_SETTINGS_TABLE.search($(this).val()).draw()
});
TAX_SETTINGS_TABLE_SETTINGS = TAX_SETTINGS_TABLE.settings();

    $(document).ready(function() {
        // $(".nsm-table").nsmPagination();

        $(document).on("click", ".edit-item", function( event ){
            var ID = $(this).attr("data-id");
            var rateName = $(this).attr("data-name");
            var ratePercentage = $(this).attr("data-percentage");

            if ($(this).attr("data-default") == "1") {
                $("#UPDATE_DEFAULT_TAXRATE").attr("checked", "");  
                $("input[name='UPDATE_DEFAULT_TAXRATE']").val("true");  
            } else {
                $("#UPDATE_DEFAULT_TAXRATE").removeAttr("checked");  
                $("input[name='UPDATE_DEFAULT_TAXRATE']").val("false");  
            }

            $("#edit-tax-name").val(rateName);
            $("#edit-tax-rate").val(ratePercentage);
            $("#edit-tid").val(ID);

            $("#edit_tax_rate_modal").modal('show');
        });

        $(document).on("click", ".delete-item", function( event ) {
            var ID = $(this).attr("data-id");

            Swal.fire({
                title: 'Are you sure to remove this tax rate?',
                text: "",
                icon: 'warning',
                confirmButtonColor: '#32243d',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('/job/delete_tax_rate') ?>", 
                        data: {id : ID}, // serializes the form's elements.
                        success: function(data)
                        {
                            if(data === "1"){                                
                                sucess_add('Nice!','Removed Successfully!',1);
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    confirmButtonColor: '#32243d',
                                    html: 'Cannot save data'
                                });
                            }
                        }
                    });
                }
            });
        });

        $("#form_add_tax").submit(function(e) {
            e.preventDefault(); 
            var form = $(this);
            
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('/job/add_tax_rate') ?>",
                data: form.serialize(), 
                success: function(data)
                {
                    if(data === "1"){
                        $('#new_tax_rate_modal').modal('hide');
                        sucess_add('Awesome!','Successfully Added!',1);                        
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            confirmButtonColor: '#32243d',
                            html: 'Cannot save data'
                        });
                    }
                }
            });
        });

        $("#form_edit_tax").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            //var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('/job/update_tax_rate') ?>",
                data: form.serialize(), // serializes the form's elements.
                dataType: 'json',
                success: function(data)
                {
                    if(data.is_success == "1"){
                        $('#edit_tax_rate_modal').modal('hide');
                        sucess_add('Awesome!','Tax Rate was successfully Updated!',1);
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            confirmButtonColor: '#32243d',
                            html: data.msg
                        });
                    }
                }
            });
        });

        $("#frm-update-job-settings").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var is_valid = 1;
            var err_msg  = '';
            if( $('#number-prefix').val() == '' ){
                is_valid = 0;
                err_msg  = 'Please specify job prefix number';
            }
            if( $('#number-base').val() == '' ){
                is_valid = 0;
                err_msg  = 'Please specify job next number';   
            }

            if( is_valid == 1 ){
                var form = $(this);                
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/job/update_settings') ?>",
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                        if(data === "1"){
                            sucess_add('Awesome!','Job Settings was successfully Updated!',0);                        
                        }else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                confirmButtonColor: '#32243d',
                                html: 'Cannot update settings'
                            });
                        }
                    }
                });    
            }else{
               Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    confirmButtonColor: '#32243d',
                    html: err_msg
                }); 
            }
            
        });
    });

    function sucess_add($title,information,is_reload){
        Swal.fire({
            //title: $title,
            text: information,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#32243d',
            confirmButtonText: 'Ok'
        }).then((result) => {            
            if(is_reload == 1){
                //if (result.value) {
                    location.reload();
                //}
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>