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
        onReady = null // ✅ new
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
        element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin-pulse"></i> Processing...');
        } else {
            element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    function virtualNumberToWords(amount) {
        const numbersToWords = (num) => {
            const ones = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
            const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
            const teens = ["Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];

            if (num < 10) return ones[num];
            if (num < 20) return teens[num - 10];
            if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? " " + ones[num % 10] : "");
            if (num < 1000) return ones[Math.floor(num / 100)] + " Hundred" + (num % 100 !== 0 ? " " + numbersToWords(num % 100) : "");
            if (num < 1000000) return numbersToWords(Math.floor(num / 1000)) + " Thousand" + (num % 1000 !== 0 ? " " + numbersToWords(num % 1000) : "");
            if (num < 1000000000) return numbersToWords(Math.floor(num / 1000000)) + " Million" + (num % 1000000 !== 0 ? " " + numbersToWords(num % 1000000) : "");
            if (num < 1000000000000) return numbersToWords(Math.floor(num / 1000000000)) + " Billion" + (num % 1000000000 !== 0 ? " " + numbersToWords(num % 1000000000) : "");
            return "Amount Too Large";
        };

        const dollars = Math.floor(amount);
        const cents = Math.round((amount - dollars) * 100);
        const dollarText = dollars > 0 ? numbersToWords(dollars) : "";
        const centText = cents > 0 ? `${cents}/100` : "";

        return dollarText + (dollars > 0 && cents > 0 ? " and " : "") + centText;
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