<?php include viewPath('v2/includes/header');
?>

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
                            <input class="form-control" value="<?php echo $customer->first_name, " ", $customer->last_name; ?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Location</label>
                            <input class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Job Name</label>
                            <input class="form-control" readonly>
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
                            <input class="form-control" value="<?php echo $job->job_number ?>" readonly>
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
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Due Date</label>
                            <input type="date" class="form-control">
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

                    <div class="col-md-12">
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
                        <template id="rowtemplate">
                            <tr>
                                <th>
                                    <input type="text" class="form-control itemname">
                                </th>
                                <th>
                                    <select class="form-select itemtype">
                                        <option>Item Type</option>
                                        <option>Item Type</option>
                                        <option>Item Type</option>
                                        <option>Item Type</option>
                                    </select>
                                </th>
                                <th>
                                    <input type="number" class="form-control itemquantity">
                                </th>
                                <th>
                                    <input type="number" class="form-control itemprice">
                                </th>
                                <th>
                                    <input type="number" class="form-control itemdiscount">
                                </th>
                                <th>
                                    <input type="number" class="form-control itemtax">
                                </th>
                                <th>
                                    <input type="number" class="form-control itemtotal">
                                </th>
                                <th>
                                    <button class="nsm-button btn-danger" onclick="removeRow(this)">Remove</button>
                                </th>
                            </tr>
                        </template>
                        <div>
                            <a href="#" class="nsm-link" onclick="addNewItemV2(); return false;">Add another item</a>
                        </div>
                    </div>
                    <div class="offset-md-8 col-md-4">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <span>Subtotal</span>
                                </td>
                                <td>$ 0.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Taxes</span>
                                </td>
                                <td>$ 0.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Adjustment</span>
                                </td>
                                <td>$ 0.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Grand Total</span>
                                </td>
                                <td>$ 0.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Request Deposit</span>
                                </td>
                                <td>$ 0.00</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h5>Request a Deposit</h5>
                        <span class="help help-sm help-block">You can request an upfront payment on accept estimate.</span>
                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control">
                            <option value="$" selected="selected">Deposit amount $</option>
                            <option value="%">Percentage %</option>
                        </select>
                    </div>
                    <br>
                    <div class="row" style="background-color:white;">
                        <div class="col-md-12">
                            <h5>Payment Schedule</h5>
                            <span class="help help-sm help-block">Split the balance into multiple payment milestones.</span>
                            <p><a href="#" id="" style="color:#02A32C;"><i class="fa fa-plus-square" aria-hidden="true"></i> Manage payment schedule </a></p>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <h5>Accepted payment methods</h5>
                        <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" checked>
                        <label class="form-check-label">
                            Credit Card Payments ()
                        </label>
                    </div>

                    <span class="help help-sm help-block">Your client can pay your invoice using credit card or bank account online. You will be notified when your client makes a payment and the money will be transferred to your bank account automatically.</span>
                    <div class="float-left mini-stat-img mr-4"><img src="<?php echo $url->assets ?>frontend/images/credit_cards.png" alt=""></div>
                    <div class="col-md-12">
                        <span class="help help-sm help-block">Your payment processor is not set up
                            <a href="">setup payment</a></span>
                    </div>
                    <div class="col-md-12">
                        <div class="checkcheckbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                            <input type="checkbox" checked>
                            <label><span>Bank Transfer</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                            <input type="checkbox" checked>
                            <label><span>Instapay</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                            <input type="checkbox" checked>
                            <label><span>Check</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                            <input type="checkbox" checked>
                            <label><span>Cash</span></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox checkbox-sec margin-right my-0 mr-3 pt-2 pb-2">
                            <input type="checkbox" checked>
                            <label><span>Deposit</span></label>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="col-md-12">
                        <h5>Message to Customer</h5>
                        <span class="help help-sm help-block">Select the payment methods that will appear on this invoice.</span>
                        <textarea cols="40" rows="2" class="form-control">Thank you for your business.</textarea>
                    </div>
                    <div class="col-md-12">
                        <br>
                        <br>
                        <h5>Terms &amp; Conditions</h5>
                        <span class="help help-sm help-block">Mention your company's T&C that will appear on the invoice.</span>
                        <textarea cols="40" rows="2" class="form-control"></textarea>
                    </div>
                    <br>
                    <button class="nsm-button primary">Save</button>
                    <button class="nsm-button primary">Preview</button>
                    <a href="" class="nsm-button btn-danger">cancel this</a>
                </div>
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
        console.log(json)
        json.data.forEach((item) => {
            addNewItemV2(item);
        })
    })()

    function addNewItemV2(item) {
        const template = document.getElementById("rowtemplate");
        const templateContent = template.content;
        const row = document.importNode(templateContent, true)

        if (item) {
            row.querySelector(".itemname").value = item.title;
            row.querySelector(".itemquantity").value = item.quantity;
            row.querySelector(".itemprice").value = item.price;
            row.querySelector(".itemdiscount").value = item.discount;
            row.querySelector(".itemtax").value = item.tax;



            const total = row.querySelector(".itemtotal");
            total.value = item.quantity * item.price;


            const quantity = row.querySelector(".itemquantity");
            const price = row.querySelector(".itemprice");
            quantity.addEventListener("input", updateTotal);
            price.addEventListener("input", updateTotal);
        }

        document.getElementById("item-table").appendChild(row);
    }

    function updateTotal(event) {
        const input = event.target;
        const row = input.parentNode.parentNode;
        const quantity = parseInt(row.querySelector(".itemquantity").value);
        const price = parseFloat(row.querySelector(".itemprice").value);
        const discount = parseFloat(row.querySelector(".itemdiscount").value) || 0;
        const total = row.querySelector(".itemtotal");
        total.value = (quantity * price).toFixed(2);
    }


    function removeRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const $jobNavItem = $("a.nsm-page-link:contains('Jobs')");
        $jobNavItem.closest("li").addClass("active");
    });
</script>