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
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>


    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="col-md-12 mb-4">
                    <h5>Customer Details</h5>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Customer</label>
                            <input class="form-control" value="<?= $customer->first_name, " ", $customer->last_name; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Location</label>
                            <input class="form-control" value="<?= $customer->city, " ", $customer->state, " ", $customer->zipcode
                                                                ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Name</label>
                            <input class="form-control" value="<?= $customer->first_name, " ", $customer->last_name; ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Invoice Details</h5>
                    <div class="row form-group mb-3">
                        <div class="col-md-4">
                            <label>Invoice Type</label>
                            <select class="form-select">
                                <option>Deposit</option>
                                <option>Deposit</option>
                                <option>Deposit</option>
                                <option>Deposit</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Job #</label>
                            <input class="form-control" value="<?= $job->job_number ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Invoice #</label>
                            <input class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-md-4">
                            <label>PO #</label>
                            <input class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Date Issued</label>
                            <input type="date" class="form-control" id="date-issued">
                        </div>
                        <div class="col-md-4">
                            <label>Due Date</label>
                            <input type="date" class="form-control" id="due-date">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label>Job Tags</label>
                            <select class="form-select">
                                <option>Job Tags</option>
                                <option>Job Tags</option>
                                <option>Job Tags</option>
                                <option>Job Tags</option>
                            </select>
                        </div>
                    </div>
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
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                    <template id="createinvoiceforjobitemrow">
                        <tr class="row-item">
                            <td>
                                <input type="text" class="form-control itemname">
                            </td>
                            <td>
                                <select class="form-select itemtype">
                                    <option>Item Type</option>
                                    <option>Item Type</option>
                                    <option>Item Type</option>
                                    <option>Item Type</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control itemquantity">
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control itemprice">
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control itemdiscount">
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control itemtax">
                            </td>
                            <td>
                                <input type="number" min="0" class="form-control itemtotal">
                            </td>
                            <td>
                                <button class="nsm-button btn-danger" onclick="removeRow(this)">Remove</button>
                            </td>
                        </tr>
                    </template>
                    <div>
                        <a href="#" class="nsm-link" data-bs-target="#createinvoiceforjobitemsmodal" data-bs-toggle="modal">Add another item</a>
                    </div>
                    <div class="offset-md-8 col-md-4">
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
                                    <span id="taxes">$ 0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Adjustment</span>
                                </td>
                                <td>
                                    <span id="adjustment">$ 0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Grand Total</span>
                                </td>
                                <td>
                                    <span id="grandtotal">$ 0.00</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span style="color:blue;">Request Deposit</span>
                                </td>
                                <td>
                                    <span id="deposit">$ 0.00</span>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Request a Deposit</h5>
                    <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <select class="form-control">
                                <option value="$" selected="selected">Deposit amount $</option>
                                <option value="%">Percentage %</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <h5>Payment Schedule</h5>
                    <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                    <p><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Manage payment schedule </a></p>
                </div>

                <div class="col-md-12">
                    <h5>Accepted payment methods</h5>
                    <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" checked>
                        <label class="form-check-label">
                            Credit Card Payments ()
                        </label>
                    </div>

                    <div>
                        <span class="help help-sm help-block">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically.</span>
                        <div class="float-left mini-stat-img mr-4"><img src="<?= $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
                    </div>
                    <div>
                        <span class="help help-sm help-block">Your payment processor is not set up
                            <a href="">setup payment</a></span>
                    </div>
                    <div class="checkcheckbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                        <input type="checkbox" checked>
                        <label><span>Bank Transfer</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                        <input type="checkbox" checked>
                        <label><span>Instapay</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                        <input type="checkbox" checked>
                        <label><span>Check</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                        <input type="checkbox" checked>
                        <label><span>Cash</span></label>
                    </div>
                    <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                        <input type="checkbox" checked>
                        <label><span>Deposit</span></label>
                    </div>
                    <div class="mb-3">
                        <h5>Message to Customer</h5>
                        <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                        <textarea cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                    </div>
                    <div>
                        <h5>Terms &amp; Conditions</h5>
                        <span class="help help-sm help-block">Mention your company's T&amp;C that will appear on the invoice.</span>
                        <textarea name="terms_and_conditions" cols="40" rows="2" class="form-control ckeditor editor1_tc"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Optionally attach files to this invoice. Allowed type: pdf, doc, docx, png, jpg, gif.</label>
                        <input style="width:40%;" class="form-control" type="file" id="formFile" accept=".pdf,.doc,.docx,.png,.jpg,.gif">
                    </div>
                </div>

                <button class="nsm-button primary">Save</button>
            </div>
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
        const response = await fetch("/job/apiGetJobItems/" + jobId);
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
            row.querySelector(".itemname").value = item.title;
            row.querySelector(".itemquantity").value = item.qty;
            row.querySelector(".itemprice").value = item.price;
            row.querySelector(".itemdiscount").value = item.discount;
            row.querySelector(".itemtax").value = item.tax;

            const total = row.querySelector(".itemtotal");
            total.value = item.qty * item.price;

            const quantity = row.querySelector(".itemquantity");
            const price = row.querySelector(".itemprice");
            quantity.addEventListener("input", updateTotal);
            price.addEventListener("input", updateTotal);
        }

        document.querySelector("#item-table tbody").appendChild(row);

        calculateSummary();
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
            const itemtotal = row.querySelector(".itemtotal");
            itemtotal.value = (quantity * price).toFixed(2);

            subtotal += parseFloat(itemtotal.value) || 0;
            taxes += (subtotal * tax) / 100;
            discount += itemdiscount;
            grandtotal = subtotal + taxes - discount;
        });

        document.getElementById("subtotal").textContent = "$ " + subtotal.toFixed(2);
        document.getElementById("taxes").textContent = "$ " + taxes.toFixed(2);
        document.getElementById("adjustment").textContent = "$ " + discount.toFixed(2);
        document.getElementById("grandtotal").textContent = "$ " + grandtotal.toFixed(2);
        document.getElementById("deposit").textContent = "$ " + (grandtotal / 2).toFixed(2);
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
        const response = await fetch('/job/apiGetItems');
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
    });
</script>