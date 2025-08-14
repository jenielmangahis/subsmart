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
        create = false
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
                }
            });
        }
    }

    function setLastSettings() {
        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/getLastSettings`,
            dataType: "JSON",
            success: function(response) {
                let nextCheckNo = parseInt(response.check_no) + 1;
                let nextPermitNo = parseInt(response.permit_no) + 1;

                $('.checkAddNo').attr('min', nextCheckNo).val(nextCheckNo).change();

                if (response.to_print == 1) {
                    $('.checkAddPrintLater').prop('checked', true).change();
                } else {
                    // $('.checkAddPrintLater').prop('checked', false).change();
                }
                
                $('.checkAddBankAccount')[0].selectize.setValue(response.bank_account_id);
                $('.checkAddPermitNo').attr('min', nextPermitNo).val(nextPermitNo).change();
                
                $('.checkAddContentLoader').remove();
                $('.checkAddModalContent').fadeIn('fast');
            }
        });
    }

    function getCategoryRowHtml() {
        return `<tr>
            <td><select class="form-select checkAddCategoryOptionsRow" required></select></td>
            <td><input type="text" class="form-control checkAddCategoryDescriptionRow"></td>
            <td><input type="number" class="form-control checkAddCategoryAmountRow" step="any" required></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryBillableRow"></td>
            <td class="text-center"><input type="checkbox" class="form-check-input checkAddCategoryTaxRow"></td>
            <td><select class="form-select checkAddCategoryCustomerRow" required></select></td>
            <td><button class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
        </tr>`;
    }

    function getItemRowHtml() {
        return `
            <tr>
                <td><select class="form-select checkAddItemOptionsRow"></select></td>
                <td><input type="text" class="form-control checkAddItemDescriptionRow"></td>
                <td><input type="number" class="form-control checkAddItemQtyRow"></td>
                <td><input type="number" class="form-control checkAddItemRateRow" step="any"></td>
                <td><input type="number" class="form-control checkAddItemAmountRow" step="any"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemBillableRow"></td>
                <td class="text-center"><input type="checkbox" class="form-check-input checkAddItemTaxRow"></td>
                <td><select class="form-select checkAddItemCustomerRow"></select></td>
                <td><button class="border-0 checkAddDeleteLine"><i class="fas fa-minus text-danger"></i></button></td>
            </tr>
        `;
    }
</script>