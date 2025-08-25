<!-- Check Index Script -->
<script>
    var checkTable;
    var cachedCategoryData = null;
    var cachedOptgroupData = null;

    $(document).ready(function() {
        checkTable = $('.checkTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": `${window.origin}/accounting/v2/check/getChecksServerside`,
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
                // "processing": "<div class='custom-loader'><p>Processing, please wait...</p></div>",
            },
            // "order": [[0, 'desc'] ],
        }).on('draw', function() {
            initializeSelectize();
            $('.checkSelectAll').prop('checked', false);
            $('#checkBatchActions').attr('disabled', 'disabled');
        });

        $('.checkTableSearch').keyup(function() {
            checkTable.search($(this).val()).draw(false);
        });

        $('.checkShowEntries').on('change', function() {
            var selectedValue = $(this).val();
            checkTable.page.len(selectedValue).draw(false);
        });
    });

    function updateAccountCategory(check_id, chart_of_account_id) {
        $.ajax({
            type: "POST",
            url: `${window.origin}/accounting/v2/check/updateAccountCategory`,
            data: {
                check_id: check_id,
                chart_of_account_id: chart_of_account_id
            },
            dataType: "JSON",
            beforeSend: function() {
                Swal.fire({
                    icon: "info",
                    title: "Updating Entry!",
                    html: "Please wait while the uploading process is running...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            },
            success: function(response) {
                if (response == 1) {
                    Swal.fire({
                        icon: "success",
                        title: "Entry Saved!",
                        html: "Check category has been updated successfully.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Upload Failed!",
                        html: response.message || "An error occurred while saving the entry.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    html: "An unexpected error occurred: " + error,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                });
            },
        });
    }

    function initializeSelectize() {
        const applySelectize = (categoryData, optgroupData) => {
            $('.checkExpenseCategory').each(function() {
                const $this = $(this);
                const defaultId = $this.data('id');

                if ($this.hasClass('selectized')) return;

                $this.selectize({
                    options: categoryData,
                    optgroups: optgroupData,
                    optgroupField: 'optgroup',
                    labelField: 'text',
                    valueField: 'value',
                    searchField: ['text'],
                    sortField: 'text',
                    onInitialize: function() {
                        const instance = this;
                        const defaultId = $this.data('chart_of_account_id');
                        const check_id = $this.data('check_id');
                        const status = $this.data('status');

                        instance._defaultId = defaultId;
                        instance._lastSelectedValue = defaultId;

                        if (defaultId) {
                            instance.setValue(defaultId, true);
                        }

                    },
                    onChange: function(value) {
                        const check_id = this.$input[0].dataset.check_id;
                        const status = this.$input[0].dataset.status;
                        const chart_of_account_id = value;
                        if (chart_of_account_id == "" || status == 2 || status == 0) return;
                        if (chart_of_account_id !== this._lastSelectedValue) {
                            updateAccountCategory(check_id, chart_of_account_id);
                        }
                    }
                });
            });
        };

        if (cachedCategoryData && cachedOptgroupData) {
            applySelectize(cachedCategoryData, cachedOptgroupData);
        } else {
            $.ajax({
                url: `${window.origin}/accounting/v2/check/getAccountDetails/all`,
                type: 'POST',
                dataType: 'json',
                success: function(categoryData) {
                    cachedCategoryData = categoryData;
                    cachedOptgroupData = [...new Set(categoryData.map(item => item.optgroup))]
                        .map(group => ({
                            value: group,
                            label: group
                        }));

                    applySelectize(cachedCategoryData, cachedOptgroupData);
                },
                error: function() {
                    console.error('Failed to load category data.');
                }
            });
        }
    };
    initializeSelectize();

    function getSelectedCheckIds() {
        let ids = [];
        $('.checkEntryCheckbox:checked').each(function() {
            ids.push($(this).data('check_id'));
        });
        return ids;
    }

    $(document).on('focus', '.selectized + .selectize-control input', function() {
        $('.selectized').each(function() {
            const instance = this.selectize;
            if (instance && !$(this).is(':focus')) {
                instance.close();
            }
        });
    });

    $(document).on('click', '.checkSelectAll', function() {
        let isChecked = $(this).is(':checked');
        $('.checkEntryCheckbox').prop('checked', isChecked).trigger('change');
    });

    $(document).on('change', '.checkEntryCheckbox', function() {
        const total = $('.checkEntryCheckbox').length;
        const checked = $('.checkEntryCheckbox:checked').length;

        if (checked === 0) {
            $('.checkSelectAll').prop('checked', false);
        }

        if (checked === total) {
            $('.checkSelectAll').prop('checked', true);
        }

        if (checked > 0) {
            $('#checkBatchActions').removeAttr('disabled');
        } else {
            $('#checkBatchActions').attr('disabled', 'disabled');
        }
    });

    $(document).on('click', '.checkAdd', function() {
        Swal.fire({
            icon: "info",
            title: "Fetching content!",
            html: "Please wait while the process is running...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        const content = $('.checkAddModal').find('.checkAddModalContent').length;
        if (content == 0) {
            $.ajax({
                type: "POST",
                url: `${window.origin}/accounting/v2/check/checkAddModal`,
                success: function(response) {
                    $('.checkAddModal').find('.modal-body').append(response);
                    setLastSettings();
                },
            });
        } else {
            setLastSettings();
        }
    });

    $(document).on('click', '.editCheck', function() {
        Swal.fire({
            icon: "info",
            title: "Fetching content!",
            html: "Please wait while the process is running...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        const check_id = $(this).attr('data-check_id');
        const content = $('.checkEditModal').find('.checkEditModalContent').length;
        if (content == 0) {
            $.ajax({
                type: "POST",
                data: {
                    check_id: check_id,
                },
                url: `${window.origin}/accounting/v2/check/checkEditModal`,
                success: function(response) {
                    $('.checkEditModal').find('.modal-body').append(response);
                    getCheckDetails(check_id);
                },
            });
        } else {
            getCheckDetails(check_id);
        }
    });

    $(document).on('click', '.voidCheck', function() {
        let check_id = $(this).attr('data-check_id');
        Swal.fire({
            icon: "warning",
            title: "Void Check",
            html: "Are you sure you want to void this check?",
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `${window.origin}/accounting/v2/check/voidCheck`,
                    data: {
                        check_id: check_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Voiding Check!",
                            html: "Please wait while the remove process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        checkTable.ajax.reload(null, false);
                        Swal.fire({
                            icon: "success",
                            title: "Entry Voided!",
                            html: "Check has been voided successfully.",
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.deleteCheck', function() {
        let check_id = $(this).attr('data-check_id');
        Swal.fire({
            icon: "warning",
            title: "Delete Check",
            html: "Are you sure you want to delete this check?",
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `${window.origin}/accounting/v2/check/deleteCheck`,
                    data: {
                        check_id: check_id
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Deleting Check!",
                            html: "Please wait while the remove process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        checkTable.ajax.reload(null, false);
                        Swal.fire({
                            icon: "success",
                            title: "Entry Deleted!",
                            html: "Check has been deleted successfully.",
                            showConfirmButton: false,
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.checkBatchVoid', function() {
        let ids = getSelectedCheckIds();

        if (ids.length === 0) return;

        Swal.fire({
            icon: "warning",
            title: "Void Selected Checks",
            html: `Are you sure you want to void <b>${ids.length}</b> check(s)?`,
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `${window.origin}/accounting/v2/check/voidMultipleChecks`,
                    data: {
                        check_ids: ids
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Voiding Multiple Checks!",
                            html: "Please wait while the remove process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        checkTable.ajax.reload(null, false);
                        $('.checkSelectAll').prop('checked', false);
                        Swal.fire({
                            icon: "success",
                            title: "Entry Voided!",
                            html: "Multiple Checks has been voided successfully.",
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                        });
                    }
                });
            }
            $('#checkBatchActions').attr('disabled', 'disabled');
        });
    });

    $(document).on('click', '.checkBatchDelete', function() {
        let ids = getSelectedCheckIds();

        if (ids.length === 0) return;

        Swal.fire({
            icon: "warning",
            title: "Delete Selected Checks",
            html: `Are you sure you want to delete <b>${ids.length}</b> check(s)?`,
            showCancelButton: true,
            confirmButtonText: "Proceed",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `${window.origin}/accounting/v2/check/deleteMultipleChecks`,
                    data: {
                        check_ids: ids
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        Swal.fire({
                            icon: "info",
                            title: "Deleting Multiple Checks!",
                            html: "Please wait while the remove process is running...",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                    success: function(response) {
                        checkTable.ajax.reload(null, false);
                        $('.checkSelectAll').prop('checked', false);
                        Swal.fire({
                            icon: "success",
                            title: "Entry Deleted!",
                            html: "Multiple Checks has been deleted successfully.",
                            showConfirmButton: false,
                        });
                    }
                });
            }
            $('#checkBatchActions').attr('disabled', 'disabled');
        });
    });
</script>