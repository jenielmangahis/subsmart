<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>

<style>
    .btn {
        font-size: 12px !important;
        background-repeat: no-repeat;
        padding: 6px 12px;
    }
    .page-title, .box-title {
      font-family: Sarabun, sans-serif !important;
      font-size: 1.75rem !important;
      font-weight: 600 !important;
      padding-top: 5px;
    }
    .pr-b10 {
      position: relative;
      bottom: 10px;
    }
    .left {
      float: left;
    }
    .p-40 {
      padding-left: 15px !important;
      padding-top: 40px !important;
    }
    .card.p-20 {
        padding-top: 18px !important;
    }
    .fr-right {
      float: right;
      justify-content: flex-end;
    }
    .p-20 {
      padding-top: 25px !important;
      padding-bottom: 25px !important;
      padding-right: 20px !important;
      padding-left: 20px !important;
    }
    .float-right.d-md-block {
      position: relative;
      bottom: 5px;
    }
    .pd-17 {
      position: relative;
      left: 17px;
    }
    @media only screen and (max-width: 1300px) {
      .card-deck-upgrades div a {
          min-height: 440px;
      }
    }
    @media only screen and (max-width: 1250px) {
      .card-deck-upgrades div a {
          min-height: 480px;
      }
      .card-deck-upgrades div {
        padding: 10px !important;
      }
    }
    @media only screen and (max-width: 600px) {
      .p-40 {
        padding-top: 0px !important;
      }
      .pr-b10 {
        position: relative;
        bottom: 0px;
      }
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/customer'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk pl-0 pr-0" style="padding-top:0px;padding-bottom:0px;">
                            <div class="row align-items-center mb-0">
                                <div class="col-sm-6">
                                    <h3 class="page-title mt-0" style="margin:5px 0 10px 0 !important;">Leads Manager</h3>
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
                            <div class="pl-3 pr-3 mt-0 row">
                              <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                  <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">
                                    A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs. Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                                  </span>
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
                                                    <a href="<?php echo url('/customer/add_lead/'.$lead->leads_id); ?>" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                                        <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Edit Lead">
                                                    </a>
                                                    <a href="javascript:void(0);" id="<?php echo $lead->leads_id; ?>" class="delete_lead" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                                                        <img src="/assets/img/customer/actions/ac_delete.png" width="16px" height="16px" border="0" title="Delete Lead">
                                                    </a>
                                                    <a href="#" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_sms.png" width="16px" height="16px" border="0" title="Send SMS">
                                                    </a>
                                                    <a href="mailto:<?= $lead->email_add; ?>" style="text-decoration:none; display:inline-block;" >
                                                        <img src="/assets/img/customer/actions/ac_email.png" width="16px" height="16px" border="0" title="Send Email">
                                                    </a>
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

<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
    $('#leads_list_table').DataTable({
        "lengthChange": true,
        "searching" : true,
        "pageLength": 10,
        "info": true,
        "responsive": true,
        "scrollY":        '60vh',
        // "scrollY":        '200px',
        "scrollX":        false,
        "scrollCollapse": true,
        "autoWidth": true,
        "order": [[ 1, "asc" ]],
        initComplete: function () {
            this.api().columns([7]).every( function () {
                var column = this;
                var select = $('<select >' +
                    '<option value=""></option>' +
                    '<option value="New">New</option>' +
                    '<option value="Contacted">Contacted</option>' +
                    '<option value="Follow Up">Follow Up</option>' +
                    '<option value="Assigned">Assigned</option>' +
                    '<option value="Converted">Converted</option>' +
                    '<option value="Closed">Closed</option>' +
                    '</select>').appendTo( $(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search( val ? val : '', false, true ).draw();
                    } );
                column.data().unique().sort().each( function ( d, j ) {
                    //var val = $('<div/>').html(d).text();
                    //select.append( '<option value="' + val + '">' + val + '</option>' );
                   // select.append( '<option value="'+d+'">'+d+'</option>' )
                    //console.log(val);
                });
            } );
        }
    });
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
