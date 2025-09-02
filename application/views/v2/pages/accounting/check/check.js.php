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
            // $('#checkBatchActions').attr('disabled', 'disabled');
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
        });
    });

    $(document).on('click', '.checkBatchPrint', function () {
        function fileID(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        const filename = `[${fileID(6)}] Selected Checks`;
        const originalTable = document.querySelector('.checkTable');
        if (!originalTable) {
            alert("No table found to export.");
            return;
        }

        const clonedTable = originalTable.cloneNode(true);

        clonedTable.querySelectorAll('tbody tr').forEach(row => {
            const checkbox = row.querySelector('.checkEntryCheckbox');
            if (!checkbox || !checkbox.checked) {
                row.remove();
            }
        });

        const removeColumns = (row) => {
            const cells = row.children;
            if (cells.length >= 3) {
                cells[0].remove(); 
                cells[cells.length - 2].remove();
                cells[cells.length - 1].remove();
            }
        };
        clonedTable.querySelectorAll('tr').forEach(removeColumns);

        const left = (screen.width - 1280) / 2;
        const top = (screen.height - 720) / 2;
        const win = window.open("", "Selected Checks", `width=1280,height=720,top=${top},left=${left}`);

        const baseStyle = `
            <style>
                table { width: 100% !important; }
                * { font-family: SEGOE UI; }

                table, th, td {
                    border: solid 1px gray;
                    border-collapse: collapse;
                    padding: 3px 5px;
                    text-align: left;
                    font-size: 15px;
                }

                th, h2, h4 {
                    text-transform: uppercase;
                }
                h4 {
                    font-size: 15px !important;
                    margin: -20px 0px 15px 0px;
                    font-weight: normal;
                }

                .checkTable>tbody>tr>td,
                .checkTable>thead>tr>th {
                    font-family: SEGOE UI !important;
                }
            </style>
        `;

        win.document.write(`<h2><strong>NSMARTRAC</strong></h2>`);
        win.document.write(`<h4>Selected Check Entries</h4>`);
        win.document.write(clonedTable.outerHTML);
        win.document.write(baseStyle);
        win.document.title = filename;

        setTimeout(() => {
            win.print();
            win.close();
        }, 500);
    });

    $(document).on('click', '.checkExportPDF', function() {
        function fileID(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        const filename = `[${fileID(6)}] Check list`;
        const originalTable = document.querySelector('.checkTable');
        if (!originalTable) {
            alert("No table found to export.");
            return;
        }

        const clonedTable = originalTable.cloneNode(true);
        const removeColumns = (row) => {
            const cells = row.children;
            if (cells.length >= 3) {
                cells[0].remove();
                cells[cells.length - 2].remove();
                cells[cells.length - 1].remove();
            }
        };

        clonedTable.querySelectorAll('tr').forEach(removeColumns);

        const left = (screen.width - 1280) / 2;
        const top = (screen.height - 720) / 2;
        const win = window.open("", "Check List", `width=1280,height=720,top=${top},left=${left}`);
        const baseStyle = `
            <style>
                table { width: 100% !important; }
                * { font-family: SEGOE UI; }

                table, th, td {
                    border: solid 1px gray;
                    border-collapse: collapse;
                    padding: 3px 5px;
                    text-align: left;
                    font-size: 15px;
                }

                th, h2, h4 {
                    text-transform: uppercase;
                }
                h4 {
                    font-size: 15px !important;
                    margin: -20px 0px 15px 0px;
                    font-weight: normal;
                }

                .checkTable>tbody>tr>td,
                .checkTable>thead>tr>th {
                    font-family: SEGOE UI !important;
                }
            </style>
        `;

        win.document.write(`<h2><strong>NSMARTRAC</strong></h2>`);
        win.document.write(`<h4>Check list</h4>`);
        win.document.write(clonedTable.outerHTML);
        win.document.write(baseStyle);
        win.document.title = filename;

        setTimeout(() => {
            win.print();
            win.close();
        }, 500);
    });

    $(document).on('click', '.checkExportXLSX', function() {
        function fileID(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        const filename = `[${fileID(6)}] Check list.xlsx`;
        const originalTable = document.querySelector('.checkTable');
        if (!originalTable) {
            alert("No table found to export.");
            return;
        }

        const clonedTable = originalTable.cloneNode(true);
        const removeColumns = (row) => {
            const cells = row.children;
            if (cells.length >= 3) {
                cells[0].remove();
                cells[cells.length - 2].remove();
                cells[cells.length - 1].remove();
            }
        };
        clonedTable.querySelectorAll('tr').forEach(removeColumns);

        clonedTable.querySelectorAll('select').forEach(select => {
            const selectedOption = select.selectedOptions[0];
            const text = selectedOption ? selectedOption.textContent : '';
            const cell = select.closest('td');
            if (cell) {
                cell.textContent = text;
            }
        });

        const headerRow = clonedTable.querySelector('thead tr');
        if (headerRow) {
            headerRow.querySelectorAll('th').forEach(th => {
                th.style.fontSize = '13px';
                th.style.fontWeight = 'bold';
            });
        }

        const worksheet = XLSX.utils.table_to_sheet(clonedTable);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Check List");
        XLSX.writeFile(workbook, filename);
    });
</script>