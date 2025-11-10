<style>
.btn-set-customer-mobile{
    display: block;
    margin-top: 13px;
}
.accordion-button{
    background-color: #6a4a86 !important;
    color:#ffffff;
}
.accordion-button:focus {
    border: none !important;
}
.accordion-button:not(.collapsed) {
    color: #ffffff !important; 
}
.accordion-button::after {    
    background-color: #ffffff;
}
.accordion-button:not(.collapsed)::after{
    background-color: #ffffff;
    padding: 5px;
}
.btn-use-template{
    position:absolute;
    right:49px;
    top:12px;
    z-index: 99999;
}
.accordion-header{
    position:relative;
}
.btn-use-template:hover{
    background-color: #529562ba !important;
}
/*Call*/
.dialpad-container .row {
  margin: 0 auto;
  width: auto;
  clear: both;
  text-align: center;
  font-family: 'Exo';  
}

.digit, .dig {
  float: left;
  padding: 10px 39px;
  width: 30px;
  font-size: 2rem;
  cursor: pointer;
}

.sub {
  font-size: 0.8rem;
  color: grey;
}

.dialpad-container{
  /*background-color: white;*/
  width: auto;
  padding: 0px;
  margin: 0 auto;
  height: 420px;
  text-align: center;
  /*box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);*/  

}

#output {
  font-family: "Exo";
  font-size: 2rem;
  height: 60px;
  font-weight: bold;
  color: #1976d2;
}

#call {
    display: inline-block;
    background-color: #66bb6a;
    padding: 10px 20px;
    margin: 10px;
    color: white;
    border-radius: 4px;
    float: left;
    cursor: pointer;
}

.botrow {
  margin: 0 auto;
  width: 280px;
  clear: both;
  text-align: center;
  font-family: 'Exo';
}

.digit:active,
.dig:active {
  background-color: #e6e6e6;
}

#call:hover {
  background-color: #81c784;
}

.dig {
  float: left;
  padding: 10px 20px;
  margin: 10px;
  width: 30px;
  cursor: pointer;
}
div#controls div#call-controls div#volume-indicators {
display: none;
padding: 10px;
margin-top: 20px;
width: 500px;
text-align: left;
}

div#controls div#call-controls div#volume-indicators > div {
  display: block;
  height: 20px;
  width: 0;
}
/* Signature pad */
#modal-customer-signature canvas {
    width: 100%;
    border: 1px solid #e4e4e4;
    position: relative;
    z-index: 1;
}

#modal-customer-signature .modal-body {
    display: flex;
    flex-direction: column;
}

#modal-customer-signature .canvas-wrapper {
    flex-grow: 1;
    position: relative;
}

#modal-customer-signature .canvas-wrapper.is-loading::after {
    content: "Loading...";
    font-size: 13px;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    background-color: #fff;
    color: #b6b6b6;
}

#modal-customer-signature .canvas-wrapper.has-content .canvas-placeholder {
    opacity: 0;
}

#modal-customer-signature .canvas-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    color: #e9e9e9;
    text-transform: uppercase;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
    opacity: 1;
}
#CUSTOMER_LOG_TABLE_length, 
#CUSTOMER_LOG_TABLE_filter, 
#CUSTOMER_LOG_TABLE_info {
    display: none;
}
#CUSTOMER_LOG_TABLE.dataTable thead th, #CUSTOMER_LOG_TABLE.dataTable thead td {
    padding: 5px;
}
#CUSTOMER_LOG_TABLE.dataTable.no-footer {
    border: 1px solid lightgray;
}
#CUSTOMER_LOG_TABLE.dataTable, #CUSTOMER_LOG_TABLE.dataTable th, #CUSTOMER_LOG_TABLE.dataTable td {
    box-sizing: border-box;
}
.balance-red{
    color : #721c24;
}
.balance-green{
    color:#155724;
}
.profile-mmr{
    font-weight: bold;
    font-size: 13px;
    margin-right: 3px;
}
@media only screen and (min-device-width: 390px){
    /* .name-acro{
        position:relative;
        bottom:30px;
    } */
}

</style>
<div class="col-12 col-md-4" data-id="<?= $id ?>" id="<?= $id ?>">
    <div class="nsm-card nsm-grid">
        <div class="nsm-card-header d-block">
            <div class="nsm-card-title">
                <span>Profile</span>
                <span class="float-end">Balance : <span id="customer-balance-amount">$0.00</span></span>
            </div>
        </div>
        <div class="nsm-card-content">
            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <div class="nsm-profile me-3 name-acro">
                            <?php 
                                $profile_info->first_name = trim($profile_info->first_name);
                                $profile_info->last_name  = trim($profile_info->last_name);
                            ?>
                            <span><?= ucwords(trim($profile_info->first_name[0])) . ucwords(trim($profile_info->last_name[0])) ?></span>                        
                        </div>
                        <div class="row w-100 position-relative">
                            <div class="col-7 col-md-6">
                                <?php 
                                    $business_name = '---';
                                    if( $profile_info->business_name != '' ){
                                        $business_name = $profile_info->business_name;
                                    }     
                                ?>                                
                                <?php if ($profile_info->customer_type == 'Business' || $profile_info->customer_type == 'Commercial'){ ?>
                                <span class="content-title"><i class='bx bx-buildings'></i> <?= $business_name; ?> </span>
                                <?php } ?>
                                <span class="content-title"><i class='bx bx-user-circle' ></i> <?= $profile_info->first_name . ' ' . $profile_info->last_name; ?></span>
                                <span class="content-subtitle d-block mt-1" style="font-size:14px;">ID# : <?= formatCustomerId($profile_info->customer_no); ?></span>   
                                <div class="verificationCheckboxContainer position-absolute" style="top: 40px;">
                                <?php $is_verified = ($profile_info->is_verified == 1) ? "checked" : ""; ?>
                                    <input id="verifyActiveCustomer" class="form-check-input verifyActiveCustomer" style="width: 16px; height: 16px;" customer_id="<?php echo $profile_info->prof_id; ?>" type="checkbox" <?php echo $is_verified; ?>>&ensp;<label class="text-muted" for="verifyActiveCustomer">Verify</label>
                                    <script>
                                        $(document).on('change', '.verifyActiveCustomer', function () {
                                            const state = $(this).prop('checked');
                                            const customer_id = $(this).attr('customer_id');

                                            $.ajax({
                                                type: "POST",
                                                url: `${window.origin}/Customer/verifyCustomer`,
                                                data: {
                                                    customer_id: `${customer_id}`,
                                                    state: `${state}`
                                                },
                                                beforeSend: function() {},
                                                success: function(response) {
                                                    // const data = JSON.parse(response)[0];
                                                },
                                                error: function() {}
                                            });
                                        });
                                    </script>
                                </div>                               
                            </div>
                            <div class="col-5 col-md-6 text-end">
                                <?php
                                switch (strtoupper($profile_info->status)):
                                    case "INSTALLED":
                                        $badge = "success";
                                        break;
                                    case "CANCELLED":
                                        $badge = "error";
                                        break;
                                    case "COLLECTIONS":
                                        $badge = "secondary";
                                        break;
                                    case "CHARGED BACK":
                                        $badge = "primary";
                                        break;
                                    default:
                                        $badge = "";
                                        break;
                                endswitch;
                                ?>
                                <span class="nsm-badge" style="white-space:normal !important;overflow-wrap:break-word;margin-bottom:4px;display:inline-block;text-align:left;width:auto;"><?= $alarm_info && $alarm_info->panel_type != '' ? $alarm_info->panel_type : '---'; ?></span><br />
                                <span class="nsm-badge <?= $badge ?>"><?= $profile_info->status != '' ? $profile_info->status : 'Pending'; ?></span><br />                         
                                <?php if( $billing_info->mmr > 0 ){ ?>       
                                    <span class="profile-mmr" style="display:inline-block;margin-top:7px;">MMR : $<?= $billing_info->mmr > 0 ? number_format($billing_info->mmr,2,'.',',') : '0.00'; ?></span>       
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-1 mt-5">
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-calendar'></i> Date of Birth</h6>
                    <p class="text-muted"><?= $profile_info->date_of_birth != '' && strtotime($profile_info->date_of_birth) > 0 ? date("m/d/Y",strtotime($profile_info->date_of_birth)) : '---'; ?></p>
                </div>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-mobile-alt' ></i> Phone #</h6>
                    <p class="text-muted"><?= $profile_info->phone_m != '' ? formatPhoneNumber($profile_info->phone_m) : '---'; ?></p>
                </div>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-envelope'></i> Email Address</h6>
                    <p class="text-muted" style="overflow-wrap:break-word;"><?= $profile_info->email != '' ? $profile_info->email : '---'; ?></p>
                </div>
                <?php if( $alarm_info ){ ?>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-package'></i> Security Package</h6>
                    <p class="text-muted"><?= $alarm_info->comm_type != '' ? $alarm_info->comm_type : '---'; ?></p>
                </div>
                <?php } ?>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-id-card'></i> CS Account #</h6>
                    <p class="text-muted"><?= $alarm_info->monitor_id != '' ? $alarm_info->monitor_id : '---'; ?></p>
                </div>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-id-card'></i> SSN</h6>
                    <p class="text-muted">
                        <?php 
                            if ( isAdmin() ) {
                                if ($profile_info->ssn) {
                                    $ssn = $profile_info->ssn; 
                                } else {
                                    $ssn = "&mdash;";
                                }
                            }else{
                                if ($profile_info->ssn) {
                                    $ssn = maskString($profile_info->ssn); 
                                    //$ssn = $profile_info->ssn; 
                                } else {
                                    $ssn = "---";
                                }
                            }
                            echo $ssn;
                        ?>
                    </p>
                </div>
                <div class="col-6 col-md-4 mb-1">
                    <h6><i class='bx bx-id-card'></i> Customer Group</h6>
                    <p class="text-muted"><?= $customerGroup ? $customerGroup->title : '---'; ?></p>
                </div>
                <div class="col-12 mb-1">
                    <h6><i class='bx bx-map-pin'></i> Address</h6>
                    <p class="text-muted" style="margin-bottom:1px;"><?= $profile_info->mail_add; ?></p>
                    <p class="text-muted"><?= $profile_info->city . ', ' . $profile_info->state . ' ' . $profile_info->zip_code; ?></p>
                </div>                
            </div>
            <div class="row mt-5">
                <div class="col-12 col-md-5">
                    <a role="button" class="nsm-button btn-sm m-0 me-2" onclick="window.open('<?= base_url('/customer/preview/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        View Profile
                    </a>
                    <a role="button" class="nsm-button btn-sm m-0 me-2"  onclick="window.open('<?= base_url('/customer/add_advance/'.$profile_info->prof_id) ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                        Edit Profile
                    </a>
                </div>  
                <div class="col-12 col-md-12 mt-4">
                    <div class="nsm-card">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title">
                                <span>Activities</span>
                            </div>
                        </div>
                        <div class="nsm-card-content">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="CUSTOMER_LOG_TABLE" class="table table-hover w-100">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 0%;">Datetime</th>
                                                    <th>Logs</th>
                                                    <a href="#"></a>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    foreach ($log_info as $log_infos) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $log_infos->date; ?></td>
                                                    <td><?php echo $log_infos->logs; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <button class="nsm-button primary w-100 ms-0 mt-2" onclick="window.open('<?= base_url('ticket/add?cus_id=' . $customer_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                            <i class='bx bx-fw bx-calendar-edit' ></i> Schedule Service
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="nsm-button primary w-100 ms-0 mt-2" onclick="window.open('<?= base_url('invoice/add?cus_id=' . $customer_id); ?>', '_blank', 'location=yes,height=1080,width=1500,scrollbars=yes,status=yes');">
                            <i class='bx bx-plus bx-fw'></i> Create Invoice
                        </button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="managequickactionsmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Quick Actions</h5>
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
            <i class="bx bx-fw bx-x m-0"></i>
        </button>
      </div>
      <div class="modal-body">
        <p>Select the actions you would like to display in this customer's profile</p>

        <div>
            <div class="actions-loader d-flex align-items-center justify-content-center" style="min-height: 300px;">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="actions-wrapper"></div>
        </div>

        <template>
            <div class="nsm-card mb-2 h-auto">
                <div class="nsm-card-content">
                    <div class="d-flex">
                        <div>
                            <span class="content-title d-block mb-1"></span>
                            <span class="content-subtitle d-block"></span>
                        </div>
                        <div class="d-flex justify-content-end align-items-center" style="margin-left: auto;">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-0" type="checkbox" checked="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    var count = 0;
    var customer_signature = '<?= $customerSignature && $customerSignature->value != '' ? $customerSignature->value : ''; ?>';

    var CUSTOMER_LOG_TABLE = $("#CUSTOMER_LOG_TABLE").DataTable({
        "ordering": false,
        pageLength : 5,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    }); 

    $(".digit").on('click', function() {

        var num = ($(this).clone().children().remove().end().text());
        if (count < 11) {
        var phoneNumber = $('#phone-number').val();
        var newNumber   = phoneNumber + num.trim();

        $('#phone-number').val(newNumber);
        $('#output').html(newNumber);

        count++
        }
    });

    load_customer_ledger_balance_amount();
    function load_customer_ledger_balance_amount(){
        let customer_id = "<?= $cus_id; ?>";
        let url = base_url + 'customer/_ledger_balance_amount';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                customer_id: customer_id
            },
            dataType:'json',
            success: function(result) {
                let ledger_balance = parseFloat(result.balance);
                if( ledger_balance > 0 ){                    
                    $('#customer-balance-amount').addClass('balance-red').html('$' + ledger_balance.toFixed(2));
                }else{
                    $('#customer-balance-amount').addClass('balance-green').html('$' + ledger_balance.toFixed(2));
                }
            },
            beforeSend: function(){
                $('#customer-balance-amount').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    }

    function initSignatureModal() {
        const $modal = document.getElementById('modal-customer-signature');
        const $canvasWrapper = $modal.querySelector(".canvas-wrapper");
        const $canvas = $canvasWrapper.querySelector("canvas");
        const $placehoder = $modal.querySelector(".canvas-placeholder");

        let signaturePad = new SignaturePad($canvas); 

        $($modal).on("shown.bs.modal", () => {
            const { height, width } = window.getComputedStyle($canvasWrapper);
            $canvas.setAttribute("height", height);
            $canvas.setAttribute("width", width);
            signaturePad = new SignaturePad($canvas);

            $($placehoder).fitText();

            if (customer_signature != '') {  
                $canvasWrapper.classList.add("has-content");
                signaturePad.fromDataURL(customer_signature);
            }
        });

        $($modal).on("hidden.bs.modal", () => {
          clearCanvas();
          $canvas.removeAttribute("height");
          $canvas.removeAttribute("width");
        });

        const $clear = $modal.querySelector("[data-action=clear]");
            $clear.addEventListener("click", (event) => {
            event.preventDefault();
            clearCanvas();
        });

        signaturePad.onBegin = () => {
            $canvasWrapper.classList.add("has-content");
        };

        const $save = $modal.querySelector("[data-action=save]");
        $save.addEventListener("click", (event) => {
            saveCustomerSignature(getSignatureUrl($canvas));
        });

        function clearCanvas() {
            signaturePad.clear();
            $canvasWrapper.classList.remove("has-content");
        }
    }

    function saveCustomerSignature(signature_value)
    {
        if( signature_value != '' ){
            var customer_id = '<?= $profile_info->prof_id; ?>';
            $.ajax({
                url: base_url + 'customer/_save_signature',
                method: 'post',            
                data: {customer_id:customer_id,signature_value:signature_value},
                dataType:'json',
                success: function (response) {
                    $('#btn-save-signature').html('Save');
                    if( response.is_success == 1 ){
                        customer_signature = signature_value;
                        $('#modal-customer-signature').modal('hide');
                        Swal.fire({
                        icon: 'success',                        
                        text: 'Customer signature has been updated successfully',
                        }).then((result) => {
                            window.location.reload();
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }
                },
                beforeSend: function() {
                    $('#btn-save-signature').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });   
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter customer signature',
            });
        }
    }

    function getSignatureUrl($canvas) 
    {
        if (isCanvasBlank($canvas)) return '';

        const $clonedCanvas = cloneCanvas($canvas);            
        return $clonedCanvas.toDataURL("image/png");
    }

    function isCanvasBlank(canvas) 
    {
        return !canvas
            .getContext("2d")
            .getImageData(0, 0, canvas.width, canvas.height)
            .data.some((channel) => channel !== 0);
    }

    function cloneCanvas(oldCanvas) 
    {
        //create a new canvas
        var newCanvas = document.createElement("canvas");
        var context = newCanvas.getContext("2d");

        //set dimensions
        newCanvas.width = oldCanvas.width;
        newCanvas.height = oldCanvas.height;

        //apply the old canvas to the new one
        context.drawImage(oldCanvas, 0, 0);

        //return the new canvas
        return newCanvas;
    }

    $('.bx-arrow-back').on('click', function() {
        var phoneNumber = $('#phone-number').val();
        var newNumber   = phoneNumber.slice(0, -1);

        $('#phone-number').val(newNumber);
        $('#output').html(newNumber);
        count--;
    });

    $(document).on('click', '.call-customer',function(){
        var cphone = $(this).attr('data-phone');
        var cid    = $(this).attr('data-id');

        count = cphone.length;

        $('#output').html(cphone);
        $('#phone-number').val(cphone);
        $('#cid').val(cid);
        $('#modalCallDialPad').modal('show');
    });

    $(".nsm-table").nsmPagination();
});
</script>