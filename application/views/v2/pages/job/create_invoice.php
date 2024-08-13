<?php include viewPath('v2/includes/header'); ?>

<style>
    .btn-danger {
        background-color: #dc3545 !important;
    }

    .dataTable {
        border-bottom: 0 !important;
    }

    .dataTable tbody td {
        border-bottom-color: rgb(222, 226, 230) !important;
    }

    .dataTables_filter {
        display: none;
    }

    .table td,
    .table th {
        border-top: 0 !important;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>


    <div class="col-12">
        <div class="nsm-page">
            <form class="nsm-page-content" id="createinvoiceform">
                <input type="hidden" name="inid" id="inid" value="<?= $jobInvoice->id; ?>" />
                <div class="col-md-12 mb-4">
                    <h5>Customer Details</h5>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Customer</label>
                            <input class="form-control" value="<?= $customer->first_name, " ", $customer->last_name; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Location</label>
                            <input class="form-control" id="job_location" value="<?= getFormatedCustomerAddress($customer) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Name</label>
                            <input id="job_name" class="form-control" value="<?= $customer->first_name, " ", $customer->last_name; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Invoice Details</h5>
                    <div class="row form-group mb-3">
                        <div class="col-md-4">
                            <label>Invoice Type</label>
                            <select name="invoice_type" class="form-select">
                                <option value="Deposit">Deposit</option>
                                <option value="Partial Payment">Partial Payment</option>
                                <option value="Final Payment">Final Payment</option>
                                <option value="Total Due" selected="selected">Total Due</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Job #</label>
                            <input class="form-control" id="job_number" value="<?= formatJobNumber($job->job_number) ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Invoice #</label>
                            <input class="form-control" id="invoice_number_display" readonly value="<?php echo $invoiceNumber; ?>" required="">
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-md-4">
                            <label>PO #</label>
                            <input id="po_number" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Date Issued</label>
                            <input type="date" class="form-control" id="date-issued" required="">
                        </div>
                        <div class="col-md-4">
                            <label>Due Date</label>
                            <input type="date" class="form-control" id="due-date" required="">
                        </div>
                        <div class="col-md-4">
                            <label>Send a tip amount to assigned technician </label>
                            <input id="tip" name="tip" type="number" min=0 step="any" value="0" class="form-control">
                        </div>
                    </div>

                    <!-- <div class="row form-group">
                        <div class="col-md-4">
                            <label>Job Tags</label>
                            <select id="job_tags" name="tags" class="form-control" required>
                                <?php if (!empty($tags)) : ?>
                                    <?php foreach ($tags as $tag) : ?>
                                        <option <?= ($job->tags == $tag->name) ? 'selected' : '' ?> value="<?= $tag->id; ?>" data-image="<?= $tag->marker_icon; ?>">
                                            <?= $tag->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div> -->
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Invoice Items</h5>

                    <table class="table" id="item-table">
                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Tax (%)</th>
                                <th scope="col">Total</th>
                                <!-- <th scope="col"></th> -->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <template id="createinvoiceforjobitemrow">
                        <tr class="row-item">
                            <td style="width:40%;">
                                <input type="text" class="form-control itemname" disabled="">
                            </td>
                            <td style="width:20%;">
                                <select class="form-select itemtype" disalbed="">
                                    <option value="Product">Product</option>
                                    <option value="Service">Service</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" min="0" step="0.001" class="form-control itemquantity" disabled="">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.001" class="form-control itemprice" disabled="">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.001" class="form-control itemdiscount" disabled="">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.001" class="form-control itemtax" disabled="">
                            </td>
                            <td>
                                <input type="number" min="0" step="0.001" class="form-control itemtotal" disabled="">
                            </td>
                            <!-- <td>
                                <button class="nsm-button btn-danger" onclick="removeRow(this)" type="button">Remove</button>
                            </td> -->
                        </tr>
                    </template>
                    <!-- <div>
                        <a href="#" class="nsm-link" data-bs-target="#createinvoiceforjobitemsmodal" data-bs-toggle="modal">Add another item</a>
                    </div> -->
                    <div class="offset-md-8 col-md-4">
                        <?php 
                            $installation_cost = 0;
                            if (isset($workorder) && $workorder->installation_cost > 0) {
                                $installation_cost = $workorder->installation_cost;
                            }elseif( $jobPayments && $jobPayments->installation_cost > 0 ){
                                $installation_cost = $jobPayments->installation_cost;
                            }

                            $otp_setup = 0;
                            if (isset($workorder) && $workorder->otp_setup > 0) {
                                $otp_setup = $workorder->otp_setup;
                            }elseif( $jobPayments && $jobPayments->program_setup > 0 ){
                                $otp_setup = $jobPayments->program_setup;
                            }

                            $monthly_monitoring = 0;
                            if (isset($workorder) && $workorder->monthly_monitoring > 0){
                                $monthly_monitoring = $workorder->monthly_monitoring;
                            }elseif( $jobPayments && $jobPayments->monthly_monitoring > 0 ){
                                $monthly_monitoring = $jobPayments->monthly_monitoring;
                            }
                        ?> 
                        <input id="adjustment_ic" type="hidden" value="<?= $installation_cost; ?>">
                        <input id="adjustment_otps" type="hidden" value="<?= $otp_setup; ?>">
                        <input id="adjustment_mm" type="hidden" value="<?= $monthly_monitoring; ?>">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <span>Subtotal</span>
                                </td>
                                <td>
                                    <span id="subtotal">$ 0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Taxes</span>
                                </td>
                                <td>
                                    <span id="taxes">$ <?= number_format((float) $job->tax_rate, 2); ?></span>
                                    <input id="default_tax" type="hidden" value="<?= $job->tax_rate; ?>">
                                </td>
                            </tr>
                            <?php if ( $installation_cost > 0 ) { ?>
                                <tr>
                                    <td>
                                        <span>Installation Cost</span>
                                    </td>
                                    <td>
                                        <span>$ <?= number_format((float) $installation_cost, 2); ?></span>                                        
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if ( $otp_setup > 0 ) { ?>
                                <tr>
                                    <td>
                                        <span>One time (Program and Setup)</span>
                                    </td>
                                    <td>
                                        <span>$ <?= number_format((float) $otp_setup, 2); ?></span>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if ( $monthly_monitoring > 0 ){ ?>
                                <tr>
                                    <td>
                                        <span>Monthly Monitoring</span>
                                    </td>
                                    <td>
                                        <span>$ <?= number_format((float) $monthly_monitoring, 2); ?></span>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>
                                    <span style="color:blue;">Grand Total</span>
                                </td>
                                <td>
                                    <span id="grandtotal">$ 0.00</span>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="row" style="background-color:white;">
                        <div class="col-md-12">
                            <h5>Request a Deposit</h5>
                            <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <input type="hidden" id="deposit-amount-type" value="1" class="form-control" />                            
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input type="number" min="0" value="0" step="any" id="deposit-amount-value" name="deposit_amount" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <!-- <div class="col-md-4 form-group">
                            <select class="form-select" id="deposit-amount-type">
                                <option value="$" selected="selected">Deposit amount $</option>
                                <option value="%">Percentage %</option>
                            </select>
                        </div> -->
                    </div>

                    <div class="mb-3">
                        <h5>Message to Customer</h5>
                        <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                        <textarea name="message_to_customer" cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                    </div>
                    <div>
                        <h5>Terms &amp; Conditions</h5>
                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                        <textarea name="terms_and_conditions" id="editor1_tc" cols="40" rows="2" class="form-control ckeditor editor1_tc">
                            <?= isset($workorder) ? $workorder->terms_and_conditions : ''; ?>
                        </textarea>
                    </div>
                    <br>
                    <button class="nsm-button primary" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createinvoiceforjobitemsmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Items List</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <input id="createinvoiceforjobitemstablesearch" style="max-width: 200px;" class="form-control" placeholder="Search item...">
                <table class="table" id="createinvoiceforjobitemstable" style="width: 100% !important;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>

<script>
    (async () => {
        const jobId = <?= $job->id; ?>;
        const response = await fetch(base_url + "/job/apiGetJobItems/" + jobId);
        const json = await response.json();
        json.data.forEach((item) => {
            addNewItem(item);
        })
        calculateSummary()
    })()

    function addNewItem(item) {
        const template = document.getElementById("createinvoiceforjobitemrow");
        const templateContent = template.content;
        const row = document.importNode(templateContent, true);

        if (item) {
            row.querySelector("tr").setAttribute("data-id", item.id)

            row.querySelector(".itemname").value = item.title;
            row.querySelector(".itemquantity").value = item.qty;
            row.querySelector(".itemprice").value = parseFloat(item.cost);            
            row.querySelector(".itemdiscount").value = parseFloat(item.discount);
            row.querySelector(".itemtax").value = item.tax;
            row.querySelector(".itemtotal").value = item.total;
            row.querySelector(".itemtype").value = capitalizeFirstLetter(item.type);

            const quantity = row.querySelector(".itemquantity");
            const price = row.querySelector(".itemprice");
            const discount = row.querySelector(".itemdiscount");
            const tax = row.querySelector(".itemtax");
            const total = row.querySelector(".itemtotal");

            quantity.addEventListener("input", updateTotal);
            price.addEventListener("input", updateTotal);
            discount.addEventListener("input", updateTotal);
            tax.addEventListener("input", updateTotal);

            //total.value = item.qty * item.price;
            total.value = item.total;
        }

        document.querySelector("#item-table tbody").appendChild(row);
        calculateSummary();
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }


    function calculateSummary() {
        const rows = document.querySelectorAll(".row-item");
        let subtotal = 0;
        let taxes = 0;
        let discount = 0;
        let grandtotal = 0;


        rows.forEach((row) => {
            const quantity = parseInt(row.querySelector(".itemquantity").value) || 0;
            const price = parseFloat(row.querySelector(".itemprice").value) || 0;
            const tax = parseFloat(row.querySelector(".itemtax").value) || 0;
            const itemdiscount = parseFloat(row.querySelector(".itemdiscount").value) || 0;
            const itemTotalValue = (quantity * price).toFixed(2);

            subtotal += parseFloat(itemTotalValue) || 0;
            taxes += (itemTotalValue * tax) / 100;
            discount += itemdiscount;
            grandtotal = (subtotal + taxes) - discount;
        });

        const adjustmentIdSelectors = ["adjustment_ic", "adjustment_otps", "adjustment_mm"];
        adjustmentIdSelectors.forEach(selector => {
            const $element = document.getElementById(selector);
            if ($element) {
                grandtotal = parseFloat(grandtotal) + parseFloat($element.value);
            }
        })

        const defaultTax = parseFloat(document.getElementById("default_tax").value) || 0;
        grandtotal += defaultTax;
        taxes += defaultTax;

        document.getElementById("subtotal").textContent = "$ " + subtotal.toFixed(2);
        document.getElementById("taxes").textContent = "$ " + taxes.toFixed(2);
        document.getElementById("grandtotal").textContent = "$ " + grandtotal.toFixed(2);
    }

    function updateTotal(event) {
        const input = event.target;
        const row = input.parentNode.parentNode;
        const quantity = parseInt(row.querySelector(".itemquantity").value) || 0;
        const price = parseFloat(row.querySelector(".itemprice").value) || 0;
        const tax = parseFloat(row.querySelector(".itemtax").value) || 0;
        const discount = parseFloat(row.querySelector(".itemdiscount").value) || 0;
        const total = row.querySelector(".itemtotal");
        total.value = (quantity * price).toFixed(2);

        calculateSummary();
    }

    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calculateSummary();
    }

    (async () => {
        const response = await fetch(base_url + '/job/apiGetItems');
        const data = await response.json();

        const columns = {
            addButton: () => {
                return `<button class="nsm-button add-item"><i class="bx bx-plus-medical"></i></button>`
            },
            name: (_, __, row) => {
                return row.title;
            },
            quantity: () => {
                return ""
            },
            price: (_, __, row) => {
                return row.price;
            },
            type: (_, __, row) => {
                return `<span style="text-transform: capitalize;">${row.type}</span>`;
            },
        };

        const table = $('#createinvoiceforjobitemstable').DataTable({
            data: data.data,
            bLengthChange: false,
            bFilter: true,
            ordering: false,
            language: {
                search: "",
            },
            columns: [{
                    sortable: false,
                    render: columns.addButton,
                },
                {
                    sortable: false,
                    render: columns.name,
                },
                {
                    sortable: false,
                    render: columns.quantity,
                },
                {
                    sortable: false,
                    render: columns.price,
                },
                {
                    sortable: false,
                    render: columns.type,
                },
            ],
            rowId: (row) => `row${row.id}`,
            createdRow: (row, data) => {
                $(row).attr("data-id", data.id);
            },
        });
        $("#createinvoiceforjobitemstablesearch").keyup(function() {
            table.search($(this).val()).draw();
        });

        table.on("click", ".add-item", async (event) => {
            event.preventDefault();

            const target = $(event.target);
            const parent = target.closest("tr");
            const rows = table.rows().data().toArray();

            const rowId = parent.data("id");
            const row = rows.find(({
                id
            }) => id == rowId);

            if (!row) return;

            $("#createinvoiceforjobitemsmodal").modal("hide");
            addNewItem({
                ...row,
                qty: 1
            })
        });
    })()
    const today = new Date().toISOString().substr(0, 10);
    document.getElementById("date-issued").value = today;
    document.getElementById("due-date").value = today;
</script>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const $jobNavItem = $("a.nsm-page-link:contains('Jobs')");
        $jobNavItem.closest("li").addClass("active");

        const $form = document.getElementById("createinvoiceform");
        $form.addEventListener("submit", async function(event) {
            event.preventDefault();

            const jobLocation = document.getElementById("job_location").value;
            let ckeditorData = '';
            if (CKEDITOR.instances.editor1_tc) {
                ckeditorData = CKEDITOR.instances.editor1_tc.getData();
            }
            const payload = {
                inid: document.querySelector('#inid').value,
                job_id: "<?= $job->id; ?>",
                customer_id: "<?= $customer->prof_id; ?>",
                customer_email: "<?= $customer->email; ?>",
                purchase_order: document.querySelector('#po_number').value,
                po_number: document.querySelector('#po_number').value,
                invoice_type: document.querySelector('select[name="invoice_type"]').value,
                date_issued: document.querySelector('#date-issued').value,
                due_date: document.querySelector('#due-date').value,
                //job_tags: document.querySelector('#job_tags').value,
                job_location: jobLocation,
                jobs_location: jobLocation,
                shipping_to_address: jobLocation,
                billing_address: jobLocation,
                deposit_amount: document.querySelector('[name=deposit_amount]').value,
                message_to_customer: document.querySelector('[name=message_to_customer]').value,
                message_on_voice: document.querySelector('[name=message_to_customer]').value,
                job_number: document.querySelector('#job_number').value,
                invoice_number: document.querySelector('#invoice_number_display').value,
                job_name: document.querySelector('#job_name').value,
                status: "Submitted",
                total_due: 0.00,
                tip: document.querySelector('#tip').value,
                sub_total: document.querySelector('#subtotal').textContent.slice(2),
                balance: document.querySelector('#grandtotal').textContent.slice(2),
                taxes: document.querySelector('#taxes').textContent.slice(2),
                grand_total: document.querySelector('#grandtotal').textContent.slice(2),
                terms_and_conditions: ckeditorData,
                terms: ckeditorData,
                items: [],
                work_order_number: '',
                deposit_request_type: document.getElementById("deposit-amount-type").value,
                deposit_request: document.getElementById("deposit-amount-value").value,
                monthly_monitoring: document.getElementById("adjustment_mm").value,
                program_setup: document.getElementById("adjustment_otps").value,
                installation_cost: document.getElementById("adjustment_ic").value,
            };


            const adjustmentSelectors = [{
                id: "adjustment_ic",
                payloadKey: "",
            }, {
                id: "adjustment_otps",
                payloadKey: "program_setup",
            }, {
                id: "adjustment_mm",
                payloadKey: "monthly_monitoring",
            }];
            adjustmentSelectors.forEach(selector => {
                if (!selector.payloadKey || !payload[selector.payloadKey]) return;

                const $element = document.getElementById(selector.id);
                if ($element) {
                    payload[selector.payloadKey] = parseFloat($element.value);
                }
            })


            const itemRows = document.querySelectorAll('#item-table tbody tr.row-item');
            itemRows.forEach(row => {
                const itemName = row.querySelector('.itemname').value;
                const itemType = row.querySelector('.itemtype').value;
                const itemQuantity = row.querySelector('.itemquantity').value;
                const itemPrice = row.querySelector('.itemprice').value;
                const itemDiscount = row.querySelector('.itemdiscount').value;
                const itemTax = row.querySelector('.itemtax').value;
                const itemTotal = row.querySelector('.itemtotal').value;
                const itemId = row.dataset.id;

                payload.items.push({
                    itemid: itemId,
                    name: itemName,
                    type: itemType,
                    quantity: itemQuantity,
                    price: itemPrice,
                    discount: itemDiscount,
                    tax: itemTax,
                    cost: itemTotal,
                    total: itemTotal
                });
            })

            const formData = new FormData;
            Object.entries(payload).forEach(([key, value]) => {
                if (!Array.isArray(value)) {
                    formData.append(key, value);
                    return;
                }
            });

            payload.items.forEach((item, index) => {
                Object.entries(item).forEach(([key, value]) => {
                    formData.append(`${key}[]`, value);
                });
            });

            const $button = document.querySelector("#createinvoiceform button[type=submit]");
            $button.setAttribute("disabled", true);
            $button.textContent = "Saving...";

            try {
                // const response = await fetch(base_url + "/Invoice/addNewInvoice?json=1", {
                //     method: "POST",
                //     body: formData
                // });
                // const jsonData = await response.json();
                // console.log(jsonData);

                // const swalResponse = await Swal.fire({
                //     title: 'Invoice Created',
                //     text: 'Invoice has been created for this job successfully.',
                //     icon: 'success',
                //     showConfirmButton: false,
                //     showCancelButton: true,
                //     // confirmButtonText: 'View Invoice',
                //     cancelButtonText: 'Close this Window',
                // });

                // if (swalResponse.isDismissed) {
                //     window.close();
                // }
                window.close();
                
                // if (swalResponse.isConfirmed) {
                //     window.location.href = `/invoice/genview/${jsonData.id}`;
                // } else {
                //     window.location.href = `/job/new_job1/${payload.job_id}`;
                // }
            } catch (error) {
                console.log(error)
                Swal.fire(
                    'Save Error',
                    'Something went wrong saving this invoice',
                    'error'
                )
            } finally {
                $button.removeAttribute("disabled");
                $button.textContent = "Save";
            }
        });

    })
</script>
<script src="<?= base_url("assets/js/jobs/manage.js") ?>"></script>