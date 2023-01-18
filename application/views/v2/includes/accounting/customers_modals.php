<div class="modal fade nsm-modal" id="print_customers_modal" tabindex="-1" aria-labelledby="print_customers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_customers_modal_label">Print Customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td data-name="Customer/Company">CUSTOMER/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Customer Type">CUSTOMER TYPE</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($customers) > 0) : ?>
						<?php foreach($customers as $customer) : ?>
                        <tr>
                            <td><?=$customer->last_name.', '.$customer->first_name?></td>
                            <td>
                                <?php
                                    $address = '';
                                    $address .= $customer->mail_add !== "" ? $customer->mail_add : "";
                                    $address .= $customer->city !== "" ? '<br />' . $customer->city : "";
                                    $address .= $customer->state !== "" ? ', ' . $customer->state : "";
                                    $address .= $customer->zip_code !== "" ? ' ' . $customer->zip_code : "";

                                    echo $address;
                                ?>
                            </td>
                            <td><?=$customer->phone_h?></td>
                            <td><?=$customer->email?></td>
                            <td><?=$customer->customer_type?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_customers">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_customers_modal" tabindex="-1" aria-labelledby="print_preview_customers_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_customers_modal_label">Print Customers List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="customers_table_print">
                    <thead>
                        <tr>
                            <td data-name="Customer/Company">CUSTOMER/COMPANY</td>
                            <td data-name="Address">ADDRESS</td>
                            <td data-name="Phone">PHONE</td>
                            <td data-name="Email">EMAIL</td>
                            <td data-name="Customer Type">CUSTOMER TYPE</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Open Balance">OPEN BALANCE</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($customers) > 0) : ?>
						<?php foreach($customers as $customer) : ?>
                        <tr>
                            <td><?=$customer->last_name.', '.$customer->first_name?></td>
                            <td>
                                <?php
                                    $address = '';
                                    $address .= $customer->mail_add !== "" ? $customer->mail_add : "";
                                    $address .= $customer->city !== "" ? '<br />' . $customer->city : "";
                                    $address .= $customer->state !== "" ? ', ' . $customer->state : "";
                                    $address .= $customer->zip_code !== "" ? ' ' . $customer->zip_code : "";

                                    echo $address;
                                ?>
                            </td>
                            <td><?=$customer->phone_h?></td>
                            <td><?=$customer->email?></td>
                            <td><?=$customer->customer_type?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="19">
								<div class="nsm-empty">
									<span>No results found.</span>
								</div>
							</td>
						</tr>
						<?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="select-customer-type-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Customer Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <select name="customer_type" id="customer-type" class="form-select nsm-field">
                            <option value="Residential">Residential</option>
                            <option value="Business">Business</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="apply-customer-type">Apply</button>
            </div>
        </div>
    </div>
</div>
