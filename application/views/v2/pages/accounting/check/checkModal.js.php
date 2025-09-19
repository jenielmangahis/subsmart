<!-- Check Add/Edit Modal Script -->
<script>
    var selectizeCache = {};

    function initSelectizeWithCache({
        selector,
        url,
        method = 'POST',
        valueField = 'id',
        labelField = 'name',
        searchField = 'name',
        optgroupField = null,
        placeholder = 'Select an option...',
        renderOptionAttr = null,
        multiple = false,
        create = false,
        onReady = null
    }) {
        if (selectizeCache[url]) {
            applySelectize(selectizeCache[url].data, selectizeCache[url].optgroups);
            return;
        }

        $.ajax({
            url: url,
            type: method,
            dataType: 'json',
            success: function(data) {
                const optgroups = optgroupField ?
                    [...new Set(data.map(item => item[optgroupField]))].map(group => ({
                        value: group,
                        label: group?.charAt(0).toUpperCase() + group?.slice(1),
                    })) :
                    [];

                selectizeCache[url] = {
                    data,
                    optgroups
                };
                applySelectize(data, optgroups);
            }
        });

        function applySelectize(data, optgroups) {
            const $el = $(selector);

            if (multiple && $el.is('select') && !$el.prop('multiple')) {
                $el.prop('multiple', true);
            }

            $el.selectize({
                valueField,
                labelField,
                searchField,
                preload: true,
                options: data,
                optgroups: optgroups,
                optgroupField: optgroupField,
                placeholder: placeholder,
                create: create,
                maxItems: multiple ? null : 1,
                render: renderOptionAttr ? {
                    option: function(item, escape) {
                        const attrValue = item[renderOptionAttr] || '';
                        return `<div class='option' data-${renderOptionAttr}="${escape(attrValue)}">${escape(item[labelField])}</div>`;
                    }
                } : {},
                load: function(query, callback) {
                    if (!query.length) return callback(data);
                    const filtered = data.filter(item =>
                        item[searchField].toLowerCase().includes(query.toLowerCase())
                    );
                    callback(filtered);
                },
                onInitialize: function() {
                    if (typeof onReady === 'function') {
                        onReady(this);
                    }
                }
            });
        }
    }

    function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        // element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            // element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin-pulse"></i> Processing...');
        } else {
            // element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    function virtualNumberToWords(amount) {
        const units = ["", "Thousand", "Million", "Billion", "Trillion", "Quadrillion", "Quintillion", "Sextillion", "Septillion", "Octillion", "Nonillion", "Decillion"];
        const ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
        const teens = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
        const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

        const convertHundreds = (num) => {
            let result = "";
            if (num >= 100) {
                result += ones[Math.floor(num / 100)] + " Hundred";
                num %= 100;
                if (num > 0) result += " ";
            }
            if (num >= 20) {
                result += tens[Math.floor(num / 10)];
                if (num % 10 > 0) result += " " + ones[num % 10];
            } else if (num >= 10) {
                result += teens[num - 10];
            } else if (num > 0) {
                result += ones[num];
            }
            return result;
        };

        const splitIntoGroups = (num) => {
            const groups = [];
            while (num > 0) {
                groups.push(num % 1000);
                num = Math.floor(num / 1000);
            }
            return groups;
        };

        const convertToWords = (num) => {
            if (num === 0) return "Zero";
            const groups = splitIntoGroups(num);
            const words = [];
            for (let i = 0; i < groups.length; i++) {
                if (groups[i] !== 0) {
                    words.unshift(convertHundreds(groups[i]) + (units[i] ? " " + units[i] : ""));
                }
            }
            return words.join(" ");
        };

        const dollars = Math.floor(amount);
        const cents = Math.round((amount - dollars) * 100);
        const dollarText = convertToWords(dollars);

        return `${dollarText} and ${String(cents).padStart(2, '0')}/100`;
    }

    function observePluginInitialization(formSelector, onReady) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        const checkPlugins = () => {
            let filepondInitialized = false;
            let selectizeInitialized = false;

            form.querySelectorAll('input[type="file"]').forEach(input => {
                if (FilePond.find(input) !== undefined) {
                    filepondInitialized = true;
                }
            });

            form.querySelectorAll('select').forEach(select => {
                if (select.selectize) {
                    selectizeInitialized = true;
                }
            });

            if (filepondInitialized && selectizeInitialized) {
                observer.disconnect();
                if (typeof onReady === 'function') {
                    onReady(true);
                }
                return true;
            }

            return false;
        };

        const observer = new MutationObserver(checkPlugins);

        observer.observe(form, {
            childList: true,
            subtree: true,
            attributes: true
        });

        checkPlugins();
    }

    // for add check
    function setLastSettings() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/getLastSettings`,
            dataType: "JSON",
            success: function(response) {
                let check_no = parseInt(response.last_check_no) + 1;
                let permit_no = parseInt(response.last_permit_no) + 1;
                let tags = (response.tags || '').split(',').filter(Boolean);
                observePluginInitialization('.checkAddForm', function(isReady) {
                    if (isReady) {
                        const tagSelectize = $(".checkAddTag")[0]?.selectize;
                        const bankSelectize = $(".checkAddBankAccount")[0]?.selectize;
                        if (tagSelectize) {
                            tagSelectize.setValue(null);
                            tags.forEach(t => {
                                if (tagSelectize.options[t]) {
                                    tagSelectize.addItem(t, true);
                                } else {
                                    tagSelectize.createItem(t, false, true);
                                }
                            });
                        }

                        if (bankSelectize) {
                            bankSelectize.setValue(response.bank_account_id);
                        }

                        if (response.to_print == 1) {
                            $(".checkAddNo").attr("min", check_no).val(check_no).change();
                            $(".checkAddPrintLater").prop("checked", true).change();
                        } else {
                            $(".checkAddPrintLater").prop("checked", false).change();
                            $(".checkAddNo").attr("min", check_no).val(check_no).change();
                        }

                        $('.checkAddPermitNo').attr('min', permit_no).val(permit_no).change();
                        $("#checkAddStandardTab").click();
                        $('.checkAddModalContent').fadeIn('fast');
                        
                        setTimeout(() => {
                            Swal.close();
                            $('.checkAddModal').modal('show');
                        }, 500);
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    }

     // for edit check
    function getCheckDetails(check_id) {
        $.ajax({
            type: "POST",
            data: { check_id: check_id },
            url: `${window.origin}/accounting/v2/check/getCheckDetails`,
            success: function(response) {
                let check_data = JSON.parse(response).check;
                let category_data = JSON.parse(response).category;
                let items_data = JSON.parse(response).items;
                let attachments_data = JSON.parse(response).attachments;

                function populateFilePondAttachments(attachments_data) {
                    const pond = FilePond.find(document.querySelector('.checkEditAttachments'));

                    $('.checkEditAttachments').each(function() {
                        const pond = FilePond.find(this);
                        if (pond) {
                            pond.removeFiles();
                        }
                    });

                    if (pond && attachments_data.length > 0) {
                        attachments_data.forEach(attachment => {
                            fetch(attachment.source).then(res => res.blob()).then(blob => {
                                const file = new File([blob], attachment.options.file.stored_name, {
                                    type: attachment.options.file.type
                                });
                                pond.addFile(file, {
                                    type: 'local',
                                    metadata: attachment.options.metadata
                                });
                            });
                        });
                    }
                }

                function renderCheckCategoryAndItemRows(category_data, items_data) {
                    const categoryContainer = $(".checkEditCategoryTable > tbody");
                    const itemContainer = $(".checkEditItemTable > tbody");

                    categoryContainer.empty();
                    itemContainer.empty();

                    if (category_data.length > 0) {
                        category_data.forEach((cat, index) => {
                            const $row = $(getCheckEditCategoryRowHtml());
                            categoryContainer.append($row);

                            initSelectizeWithCache({
                                selector: $row.find('.checkEditCategoryOptionsRow'),
                                url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                                valueField: 'value',
                                labelField: 'text',
                                searchField: 'text',
                                optgroupField: 'optgroup',
                                placeholder: 'Select Category...',
                                renderOptionAttr: 'balance',
                                onReady: function(selectize) {
                                    if (cat.expense_account_id) {
                                        selectize.setValue(cat.expense_account_id);
                                    }
                                }
                            });

                            initSelectizeWithCache({
                                selector: $row.find('.checkEditCategoryCustomerRow'),
                                url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                                valueField: 'id',
                                labelField: 'payee_name',
                                searchField: 'payee_name',
                                optgroupField: 'payee_type',
                                placeholder: 'Select Customer...',
                                renderOptionAttr: 'payee_type',
                                onReady: function(selectize) {
                                    if (cat.customer_id) {
                                        selectize.setValue(cat.customer_id);
                                    }
                                }
                            });

                            $row.find(".checkEditCategoryDescriptionRow").val(cat.description || "").change();
                            $row.find(".checkEditCategoryAmountRow").val(cat.amount || "").change();
                            $row.find(".checkEditCategoryBillableRow").prop("checked", cat.billable == "1").change();
                            $row.find(".checkEditCategoryTaxRow").prop("checked", cat.tax == "1").change();
                        });
                    } else {
                        const $newRow = $(getCheckEditCategoryRowHtml());
                        categoryContainer.html($newRow);

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkEditCategoryOptionsRow'),
                            url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                            valueField: 'value',
                            labelField: 'text',
                            searchField: 'text',
                            optgroupField: 'optgroup',
                            placeholder: 'Select Category...',
                            renderOptionAttr: 'balance',
                        });

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkEditCategoryCustomerRow'),
                            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                            valueField: 'id',
                            labelField: 'payee_name',
                            searchField: 'payee_name',
                            optgroupField: 'payee_type',
                            placeholder: 'Select Customer...',
                            renderOptionAttr: 'payee_type',
                        });
                    }

                    if (items_data.length > 0) {
                        items_data.forEach((item, index) => {
                            const $row = $(getCheckEditItemRowHtml());
                            itemContainer.append($row);

                            initSelectizeWithCache({
                                selector: $row.find('.checkEditItemOptionsRow'),
                                url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                                valueField: 'id',
                                labelField: 'item_name',
                                searchField: 'item_name',
                                optgroupField: 'item_type',
                                placeholder: 'Select Product/Service...',
                                renderOptionAttr: 'item_type',
                                onReady: function(selectize) {
                                    if (item.item_id) {
                                        selectize.setValue(item.item_id);
                                        $row.find(".checkEditItemQtyRow").val(item.quantity || "").change();
                                        $row.find(".checkEditItemRateRow").val(item.rate || "").change();
                                        $row.find(".checkEditItemAmountRow").val(item.total || "").change();
                                    }
                                }
                            });

                            initSelectizeWithCache({
                                selector: $row.find('.checkEditItemCustomerRow'),
                                url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                                valueField: 'id',
                                labelField: 'payee_name',
                                searchField: 'payee_name',
                                optgroupField: 'payee_type',
                                placeholder: 'Select Customer...',
                                renderOptionAttr: 'payee_type',
                                onReady: function(selectize) {
                                    if (item.customer_id) {
                                        selectize.setValue(item.customer_id);
                                    }
                                }
                            });

                            $row.find(".checkEditItemDescriptionRow").val(item.description || "").change();
                            $row.find(".checkEditItemBillableRow").prop("checked", item.isBillable == "1").change();
                            $row.find(".checkEditItemTaxRow").prop("checked", item.isTax == "1").change();
                        });
                    } else {
                        const $newRow = $(getCheckEditItemRowHtml());
                        itemContainer.html($newRow);

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkEditItemOptionsRow'),
                            url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                            valueField: 'id',
                            labelField: 'item_name',
                            searchField: 'item_name',
                            optgroupField: 'item_type',
                            placeholder: 'Select Product/Service...',
                            renderOptionAttr: 'item_type',
                        });

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkEditItemCustomerRow'),
                            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                            valueField: 'id',
                            labelField: 'payee_name',
                            searchField: 'payee_name',
                            optgroupField: 'payee_type',
                            placeholder: 'Select Customer...',
                            renderOptionAttr: 'payee_type',
                        });
                    }

                    // console.log(`Rendered ${category_data.length || 1} category rows and ${items_data.length || 1} item rows.`);
                }

                function applyCheckData() {
                    let check_no = (check_data.check_no !== null && check_data.check_no != 0)
                        ? parseInt(check_data.check_no)
                        : parseInt(check_data.last_check_no) + 1;

                    let permit_no = (check_data.permit_no !== null && check_data.permit_no != 0)
                        ? parseInt(check_data.permit_no)
                        : parseInt(check_data.last_permit_no) + 1;

                    let tags = (check_data.tags || '').split(',').filter(Boolean);

                    $(".checkEditID").val(check_data.id).change();

                    if (check_data.to_print == 1) {
                        $(".checkEditNo").attr("min", check_no).val(check_no).change();
                        $(".checkEditPrintLater").prop("checked", true).change();
                    } else {
                        $(".checkEditPrintLater").prop("checked", false).change();
                        $(".checkEditNo").attr("min", check_no).val(check_no).change();
                    }

                    $(".checkEditPermitNo").attr("min", permit_no).val(permit_no).change();
                    $(".checkEditPayeeType").val(check_data.payee_type).change();
                    $(".checkEditPaymentDate").val(check_data.payment_date).change();
                    $(".checkEditMemo").val(check_data.memo).change();

                    const payeeSelectize = $(".checkEditPayee")[0]?.selectize;
                    if (payeeSelectize) payeeSelectize.setValue(check_data.payee_id);

                    const bankSelectize = $(".checkEditBankAccount")[0]?.selectize;
                    if (bankSelectize) bankSelectize.setValue(check_data.bank_account_id);

                    const selectedTags = $(".checkEditTag")[0]?.selectize;
                    if (selectedTags) {
                        selectedTags.setValue(null);
                        tags.forEach(t => {
                            if (selectedTags.options[t]) {
                                selectedTags.addItem(t, true);
                            } else {
                                selectedTags.createItem(t, false, true);
                            }
                        });
                    }

                    if (check_data.status == 1) {
                        $('.checkEditBadge').hide();
                        $('.checkEditSubmitButton').show();
                    } else {
                        $('.checkEditBadge').show();
                        $('.checkEditSubmitButton').hide();
                    }

                    renderCheckCategoryAndItemRows(category_data, items_data);
                    populateFilePondAttachments(attachments_data);
                }

                observePluginInitialization('.checkEditForm', function(isReady) {
                    if (isReady) {
                        applyCheckData();
                        $("#checkEditStandardTab").click();
                        $(".checkEditModalContent").fadeIn("fast");

                        setTimeout(() => {
                            Swal.close();
                            $('.checkEditModal').modal('show');
                        }, 500);
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    }

    // for copy check
    function copyCheck(check_id) {
        $.ajax({
            type: "POST",
            data: { check_id: check_id },
            url: `${window.origin}/accounting/v2/check/getCheckDetails`,
            success: function(response) {
                let check_data = JSON.parse(response).check;
                let category_data = JSON.parse(response).category;
                let items_data = JSON.parse(response).items;
                let attachments_data = JSON.parse(response).attachments;

                function populateFilePondAttachments(attachments_data) {
                    const pond = FilePond.find(document.querySelector('.checkAddAttachments'));

                    $('.checkAddAttachments').each(function() {
                        const pond = FilePond.find(this);
                        if (pond) {
                            pond.removeFiles();
                        }
                    });

                    if (pond && attachments_data.length > 0) {
                        attachments_data.forEach(attachment => {
                            fetch(attachment.source).then(res => res.blob()).then(blob => {
                                const file = new File([blob], attachment.options.file.stored_name, {
                                    type: attachment.options.file.type
                                });
                                pond.addFile(file, {
                                    type: 'local',
                                    metadata: attachment.options.metadata
                                });
                            });
                        });
                    }
                }

                function renderCheckCategoryAndItemRows(category_data, items_data) {
                    const categoryContainer = $(".checkAddCategoryTable > tbody");
                    const itemContainer = $(".checkAddItemTable > tbody");

                    categoryContainer.empty();
                    itemContainer.empty();

                    if (category_data.length > 0) {
                        category_data.forEach((cat, index) => {
                            const $row = $(getCheckAddCategoryRowHtml());
                            categoryContainer.append($row);

                            initSelectizeWithCache({
                                selector: $row.find('.checkAddCategoryOptionsRow'),
                                url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                                valueField: 'value',
                                labelField: 'text',
                                searchField: 'text',
                                optgroupField: 'optgroup',
                                placeholder: 'Select Category...',
                                renderOptionAttr: 'balance',
                                onReady: function(selectize) {
                                    if (cat.expense_account_id) {
                                        selectize.setValue(cat.expense_account_id);
                                    }
                                }
                            });

                            initSelectizeWithCache({
                                selector: $row.find('.checkAddCategoryCustomerRow'),
                                url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                                valueField: 'id',
                                labelField: 'payee_name',
                                searchField: 'payee_name',
                                optgroupField: 'payee_type',
                                placeholder: 'Select Customer...',
                                renderOptionAttr: 'payee_type',
                                onReady: function(selectize) {
                                    if (cat.customer_id) {
                                        selectize.setValue(cat.customer_id);
                                    }
                                }
                            });

                            $row.find(".checkAddCategoryDescriptionRow").val(cat.description || "").change();
                            $row.find(".checkAddCategoryAmountRow").val(cat.amount || "").change();
                            $row.find(".checkAddCategoryBillableRow").prop("checked", cat.billable == "1").change();
                            $row.find(".checkAddCategoryTaxRow").prop("checked", cat.tax == "1").change();
                        });
                    } else {
                        const $newRow = $(getCheckAddCategoryRowHtml());
                        categoryContainer.html($newRow);

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkAddCategoryOptionsRow'),
                            url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                            valueField: 'value',
                            labelField: 'text',
                            searchField: 'text',
                            optgroupField: 'optgroup',
                            placeholder: 'Select Category...',
                            renderOptionAttr: 'balance',
                        });

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkAddCategoryCustomerRow'),
                            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                            valueField: 'id',
                            labelField: 'payee_name',
                            searchField: 'payee_name',
                            optgroupField: 'payee_type',
                            placeholder: 'Select Customer...',
                            renderOptionAttr: 'payee_type',
                        });
                    }

                    if (items_data.length > 0) {
                        items_data.forEach((item, index) => {
                            const $row = $(getCheckAddItemRowHtml());
                            itemContainer.append($row);

                            initSelectizeWithCache({
                                selector: $row.find('.checkAddItemOptionsRow'),
                                url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                                valueField: 'id',
                                labelField: 'item_name',
                                searchField: 'item_name',
                                optgroupField: 'item_type',
                                placeholder: 'Select Product/Service...',
                                renderOptionAttr: 'item_type',
                                onReady: function(selectize) {
                                    if (item.item_id) {
                                        selectize.setValue(item.item_id);
                                        $row.find(".checkAddItemQtyRow").val(item.quantity || "").change();
                                        $row.find(".checkAddItemRateRow").val(item.rate || "").change();
                                        $row.find(".checkAddItemAmountRow").val(item.total || "").change();
                                    }
                                }
                            });

                            initSelectizeWithCache({
                                selector: $row.find('.checkAddItemCustomerRow'),
                                url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                                valueField: 'id',
                                labelField: 'payee_name',
                                searchField: 'payee_name',
                                optgroupField: 'payee_type',
                                placeholder: 'Select Customer...',
                                renderOptionAttr: 'payee_type',
                                onReady: function(selectize) {
                                    if (item.customer_id) {
                                        selectize.setValue(item.customer_id);
                                    }
                                }
                            });

                            $row.find(".checkAddItemDescriptionRow").val(item.description || "").change();
                            $row.find(".checkAddItemBillableRow").prop("checked", item.isBillable == "1").change();
                            $row.find(".checkAddItemTaxRow").prop("checked", item.isTax == "1").change();
                        });
                    } else {
                        const $newRow = $(getCheckAddItemRowHtml());
                        itemContainer.html($newRow);

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkAddItemOptionsRow'),
                            url: `${window.origin}/accounting/v2/check/getItemDetails/all`,
                            valueField: 'id',
                            labelField: 'item_name',
                            searchField: 'item_name',
                            optgroupField: 'item_type',
                            placeholder: 'Select Product/Service...',
                            renderOptionAttr: 'item_type',
                        });

                        initSelectizeWithCache({
                            selector: $newRow.find('.checkAddItemCustomerRow'),
                            url: `${window.origin}/accounting/v2/check/getPayeeDetails/customer`,
                            valueField: 'id',
                            labelField: 'payee_name',
                            searchField: 'payee_name',
                            optgroupField: 'payee_type',
                            placeholder: 'Select Customer...',
                            renderOptionAttr: 'payee_type',
                        });
                    }

                    // console.log(`Rendered ${category_data.length || 1} category rows and ${items_data.length || 1} item rows.`);
                }

                function applyCheckData() {
                    let check_no = (check_data.check_no !== null && check_data.check_no != 0)
                        ? parseInt(check_data.check_no)
                        : parseInt(check_data.last_check_no) + 1;

                    let permit_no = (check_data.permit_no !== null && check_data.permit_no != 0)
                        ? parseInt(check_data.permit_no)
                        : parseInt(check_data.last_permit_no) + 1;

                    let tags = (check_data.tags || '').split(',').filter(Boolean);

                    if (check_data.to_print == 1) {
                        $(".checkAddNo").attr("min", check_no).val(check_no).change();
                        $(".checkAddPrintLater").prop("checked", true).change();
                    } else {
                        $(".checkAddPrintLater").prop("checked", false).change();
                        $(".checkAddNo").attr("min", check_no).val(check_no).change();
                    }

                    $(".checkAddPermitNo").attr("min", permit_no).val(permit_no).change();
                    $(".checkAddPayeeType").val(check_data.payee_type).change();
                    $(".checkAddPaymentDate").val(check_data.payment_date).change();
                    $(".checkAddMemo").val(check_data.memo).change();

                    const payeeSelectize = $(".checkAddPayee")[0]?.selectize;
                    if (payeeSelectize) payeeSelectize.setValue(check_data.payee_id);

                    const bankSelectize = $(".checkAddBankAccount")[0]?.selectize;
                    if (bankSelectize) bankSelectize.setValue(check_data.bank_account_id);

                    const selectedTags = $(".checkAddTag")[0]?.selectize;
                    if (selectedTags) {
                        selectedTags.setValue(null);
                        tags.forEach(t => {
                            if (selectedTags.options[t]) {
                                selectedTags.addItem(t, true);
                            } else {
                                selectedTags.createItem(t, false, true);
                            }
                        });
                    }

                    if (check_data.check_no) {
                        $(".checkAddBadge").text(`THIS IS A COPY FROM CHECK #${check_data.check_no}`);
                    } else {
                        $(".checkAddBadge").text(`THIS IS A COPY CHECK`);
                    }

                    renderCheckCategoryAndItemRows(category_data, items_data);
                    populateFilePondAttachments(attachments_data);
                }

                observePluginInitialization('.checkAddForm', function(isReady) {
                    if (isReady) {
                        applyCheckData();
                    }
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Network Error!",
                    html: "An unexpected error occurred. Please try again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    }

    $(document).on('click', '.addCheckModalExitButton', function () {
        $('.checkAddModalContent').hide();
    });

    $(document).on('click', '.editCheckModalExitButton', function () {
        $('.checkEditModalContent').hide();
    });

    $(document).on('click', '.checkAddClearTags', function () {
        $(".checkAddTag")[0].selectize.setValue(null);
    }); 

    $(document).on('click', '.checkEditClearTags', function () {
        $(".checkEditTag")[0].selectize.setValue(null);
    });
</script>