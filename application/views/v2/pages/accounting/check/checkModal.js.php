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


    // $(document).on('shown.bs.modal', '.checkAddModal', function () {
    //     // for future development
    //     // alert(true);
    // });

    // $(document).on('hidden.bs.modal', '.checkAddModal', function () {
    //     $('.checkAddModalContent').hide();
    // });

    // $(document).on('shown.bs.modal', '.checkEditModal', function () {
    // //    for future development
    // // alert(false);
    // });

    // $(document).on('hidden.bs.modal', '.checkEditModal', function () {
    //     $('.checkEditModalContent').hide();
    // });

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