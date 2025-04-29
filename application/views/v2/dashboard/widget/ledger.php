<?php
    $id = trim($thumbnailsWidgetCard->id);
    $title = trim($thumbnailsWidgetCard->title);
    $description = trim($thumbnailsWidgetCard->description);
    $icon = trim($thumbnailsWidgetCard->icon);
    $type = trim($thumbnailsWidgetCard->type);
    $category = trim($thumbnailsWidgetCard->category);
?>
<style>
    .selectize-dropdown .selected {
        background-color: #6a4a8624 !important;
        color: unset !important;
    }

</style>
<div class='card shadow widgetBorder <?php echo "card_$category$id "; ?>'>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mt-0 fw-bold">
                    <a role="button" class="text-decoration-none" href="javascript:void(0)" style="color:#6a4a86 !important">
                        <?php echo "<i class='$icon'></i>&nbsp;&nbsp;$title"; ?> <span class="badge widgetBadge position-absolute opacity-25"><?php echo ucfirst($type); ?></span>
                    </a>
                    <div class="dropdown float-end widgetDropdownMenu display_none">
                        <a href="javascript:void(0)" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item removeDashboardCard" data-id='<?php echo $id; ?>' href="javascript:void(0)">Remove</a></li>
                        </ul>
                    </div>
                </h5>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <span><?php echo $description; ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-nowrap <?php echo "textDataContainer_$id"; ?>">
                <div class="input-group">
                    <select class="form-select <?php echo "widgetFilter3_$id"; ?>">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="col-12 mt-3 text-nowrap <?php echo "tableDataContainer_$id"; ?>">
                <div class="float-start">
                    <div class="dropdown">
                        <button class="btn btn-secondary small dropdown-toggle" type="button" id="ledgerSettings" data-bs-toggle="dropdown" aria-expanded="false" style="background: #6a4a86 !important;"><i class="fas fa-cogs"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="ledgerSettings">
                            <li><a class="dropdown-item" href="#">Export (.xlsx)</a></li>
                            <li><a class="dropdown-item" href="#">Send to Email</a></li>
                            <li><a class="dropdown-item" href="#">Print</a></li>
                        </ul>
                    </div>
                </div>
                <div class="float-end">
                    <span class="fw-bold fs-5">Balance: </span><span class="ledgerCustomerBalance fs-5">$0.00</span>
                </div>
            </div>
            <div class="col mt-3 text-nowrap <?php echo "tableDataContainer_$id"; ?>">
                <div class="table-responsive" style="max-height: 500px;">
                    <table class="table table-bordered <?php echo "tableData_$id"; ?> table-hover w-100 mb-3">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Invoice</th>
                                <th>Payment</th>
                                <th>Method</th>
                                <th>Record Date</th>
                                <th>Entry By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">No Records Found.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mt-2 <?php echo "graphLoaderContainer_$id"; ?> graphLoader display_none">
                <div class="text-center">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="col mt-2 <?php echo "noRecordFoundContainer_$id"; ?> display_none">
                <div class="text-center">No Record Found...</div>
            </div>
            <div class="col mt-2 <?php echo "networkErrorContainer_$id"; ?> display_none">
                <div class="text-center">Unable to retrieve results due to a network error.<br>
                    <small>
                        <a class="text-decoration-none" href="javascript:void(0)" onclick='$(`.<?php echo "widgetFilter1_$id"; ?>`).change();'><i class="fas fa-redo-alt"></i>&nbsp;&nbsp;Refresh</a>
                    </small>
                </div>
            </div>
        </div>
        <strong class="widgetDragHandle">⣿⣿⣿⣿</strong>
        <span class="widgetWidthResizeHandle"></span>
        <span class="widgetHeightResizeHandle"></span>
    </div>
</div>
<script>
    const selectInput = $(".<?php echo "widgetFilter3_$id"; ?>").selectize({
        placeholder: "Search and select customer...",
        valueField: 'id',
        labelField: 'customer',
        searchField: ['customer', 'email', 'phone'],
        render: {
            option: function(item, escape) {
                const name = item.customer.trim();
                const splitName = name.split(' ');
                const initials = (splitName[0]?.charAt(0) || '') + (splitName[1]?.charAt(0) || '');

                const phonePattern = /^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/;
                const phone = phonePattern.test(item.phone) ? item.phone : 'Not Specified';
                const email = item.email ? escape(item.email) : 'Not Specified';
                const recordText = (item.invoice_records && parseInt(item.invoice_records) > 0)
                    ? `${item.invoice_records} record(s) found.`
                    : 'No records.';

                return `
                    <div style="display: flex; align-items: center; padding: 8px;">
                        <div style="
                            width: 40px;
                            height: 40px;
                            background: #6a4a86;
                            color: #fff;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-weight: bold;
                            margin-right: 12px;
                            font-size: 14px;
                        ">${initials.toUpperCase()}</div>
                        <div style="max-width: 250px; word-wrap: break-word;">
                            <div style="font-weight: bold; word-wrap: break-word;">${escape(item.customer)}</div>
                            <div style="font-size: 12px; color: #555; word-wrap: break-word;">${phone} / ${email}</div>
                            <div style="font-size: 12px; color: #888; word-wrap: break-word;">${recordText}</div>
                        </div>
                    </div>
                `;
            },
            item: function(item, escape) {
                return `<div>${escape(item.customer)}</div>`;
            }
        }
    });

    const selectizeInstance = selectInput[0].selectize;

    $.ajax({
        url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
        type: "POST",
        data: {
            category: "customer_list",
            dateFrom: null,
            dateTo: null,
            filter3: null
        },
        beforeSend: function() {
            $('.<?php echo "textDataContainer_$id"; ?>').hide();
            $('.<?php echo "tableDataContainer_$id"; ?>').hide();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
        },
        success: function (response) {
            const customers = JSON.parse(response);
            selectizeInstance.clearOptions();
            customers.forEach(customer => {
                selectizeInstance.addOption(customer);
            });
            selectizeInstance.refreshOptions(false);

            $('.<?php echo "textDataContainer_$id"; ?>').show();
            $('.<?php echo "tableDataContainer_$id"; ?>').show();
            $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
            $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
            $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
        },
        error: function () {
            console.error("Failed to fetch customer data.");
        }
    });

    $(document).on('change', '.<?php echo "widgetFilter3_$id"; ?>', function () {
        const customerID = $(this).val();
        widgetMasonry.destroy();
        if (customerID != "") {
            $.ajax({
                url: `${window.location.origin}/dashboard/thumbnailWidgetRequest`,
                type: "POST",
                data: {
                    category: "ledger_lookup",
                    dateFrom: null,
                    dateTo: null,
                    filter3: customerID
                },
                beforeSend: function() {
                    $('.<?php echo "textDataContainer_$id"; ?>').show();
                    $('.<?php echo "tableDataContainer_$id"; ?>').hide();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').show();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    $('.<?php echo "tableData_$id"; ?> > tbody').html("");
                    $('.<?php echo "tableData_$id"; ?> > tbody').append(data.table_content);
                    $('.ledgerCustomerBalance').html(data.balance_amount);

                    $('.<?php echo "textDataContainer_$id"; ?>').show();
                    $('.<?php echo "tableDataContainer_$id"; ?>').show();
                    $('.<?php echo "graphLoaderContainer_$id"; ?>').hide();
                    $('.<?php echo "noRecordFoundContainer_$id"; ?>').hide();
                    $('.<?php echo "networkErrorContainer_$id"; ?>').hide();
                    widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
                },
                error: function () {
                    widgetMasonry = new Masonry(document.getElementById('widgetMasonry'), { percentPosition: true, horizontalOrder: true, });
                    console.error("Failed to fetch customer data.");
                }
            });
        }
    });
</script>