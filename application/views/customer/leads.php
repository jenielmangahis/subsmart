<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<style>
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Leads Manager</h3>
                                </div>
                                <div class="col-sm-6">
                                    <div class="float-right d-md-block">
                                        <div class="dropdown">
                                            <a class="btn btn-primary btn-md"
                                               href="<?php echo url('customer/add_lead') ?>"><span
                                                    class="fa fa-plus"></span> Add New Lead</a>
                                            <?php //endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom-ter align-items-center">
                                <div class="col-auto">
                                    <p>
                                        Listing all leads.
                                    </p>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-hover" id="leads_list_table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Assigned To</th>
                                        <th>Email</th>
                                        <th>SSS Number</th>
                                        <th>Date of Birth</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($leads as $lead) : ?>
                                            <tr>
                                                <td><?= $lead->firstname.' '.$lead->lastname; ?></td>
                                                <td><?= $lead->address; ?></td>
                                                <td><?= $lead->FName; ?></td>
                                                <td><?= $lead->email_add; ?></td>
                                                <td><?= $lead->sss_num; ?></td>
                                                <td><?= $lead->date_of_birth; ?></td>
                                                <td><?= $lead->phone_cell; ?></td>
                                                <td><?= $lead->status; ?></td>
                                                <td>
                                                    <a href="<?php echo url('/customer/add_lead/'.$lead->leads_id); ?>" >
                                                    <button class="btn btn-primary" type="button">
                                                        <span class="btn-label"><span class="fa fa-pencil-square-o icon"></span> Edit</span>
                                                    </button>
                                                    </a>
                                                    <button class="btn btn-primary delete_lead" id="<?php echo $lead->leads_id; ?>" type="button">
                                                        <span class="btn-label"><span class="fa fa-trash-o icon"></span> Delete</span>
                                                    </button>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
</div>

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $('#leads_list_table').DataTable({
        "lengthChange": true,
        "searching" : true,
        "pageLength": 10,
        "info": true
    });
    $(".delete_lead").on( "click", function( event ) {
        var ID=this.id;
        // alert(ID);
        Swal.fire({
            title: 'Are you sure you want to DELETE this lead?',
            text: "All lead data will be remove.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#32243d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "/customer/remove_lead",
                    data: {lead_id : ID}, // serializes the form's elements.
                    success: function(data)
                    {
                        if(data === "Done"){
                            sucess("Lead Remove Successfully!");
                        }else{
                            console.log(data);
                        }

                    }
                });
                // window.location.href="/customer";
            }
        });
    });
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
                window.location.href="/customer/leads";
            }
        });
    }
</script>