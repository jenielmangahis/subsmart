<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<style>
    .cke_notification {
        display: none;
    }

    .custom-loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #d3d3d3;
        z-index: 9999;
    }

    .custom-loader p {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .fw-xnormal {
        font-weight: 500;
    }

    #quickresponse_table {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    #quickresponse_table th,
    #quickresponse_table td {
        border: 1px solid lightgray;
        padding: 8px !important;
        text-align: left !important;
    }

    #quickresponse_table th {
        background-color: #f2f2f2 !important;
    }

    .dataTables_length,
    .dataTables_filter {
        display: none;
    }

    .addPresetButton {
        margin-top: -38px;
    }

    .actionColumn {
        font-size: 16px;
        font-weight: bolder;
    }

    .noWidth {
        width: 0% !important;
    }

    textarea[name="response"] {
        height: 100px;
    }
</style>
<div class="row page-content g-0">
    <div class="col-sm-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/chatbot_tabs'); ?>
    </div>
    <div class="col-lg-12">
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            Set up and customize the chatbot's preference and responses.
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row g-3">
            <div class="col-lg-3 mb-3">
                <div class="row g3">
                    <div class="col-lg-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Preference</span>
                                </div>
                                <label class="nsm-subtitle">Set the chatbot name and color.</label>
                            </div>
                            <div class="nsm-card-content">
                                <form id="chatbotPreferenceForm">
                                    <div class="row g-3">
                                        <div class="col-lg-7">
                                            <label class="form-label">Chatbot Name</label>
                                            <input name="chatbot_name" type="text" class="form-control" placeholder="Chatbot (Default)" value="<?php echo ($preference[0]->chatbot_name) ? $preference[0]->chatbot_name : "Chatbot" ?>" required>
                                        </div>
                                        <div class="col-lg-5">
                                            <label class="form-label">Color</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <input type="color" class=" form-control form-control-color chatbot_colorpicker" value="<?php echo ($preference[0]->color) ? $preference[0]->color : "#6a4a86" ?>" title="Choose a color" required>
                                                </div>
                                                <input name="color" type="text" class=" form-control" value="<?php echo ($preference[0]->color) ? $preference[0]->color : "#6a4a86" ?>" required>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <label class="form-label">Image</label>
                                            <input name="chatbot_image" type="file" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="col-lg-12">
                                            <label class="form-label">Main menu</label>
                                            <select name="chatbot_menu" class="form-select" required>
                                                <option value="1">test</option>
                                            </select>
                                        </div> -->
                                        <div class="col-lg-12">
                                            <button type="submit" class="nsm-button primary float-end">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mb-3">
                <div class="row g3">
                    <div class="col-lg-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Preset Response</span>
                                </div>
                                <label class="nsm-subtitle">Add an automatic response for user based on their query.</label>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <input id="quickresponse_table_search" class="form-control mt-0 mb-2 w-25" type="text" placeholder="Search a preset...">
                                        <button type="button" class="nsm-button small float-end mb-3 addPresetButton" data-bs-toggle="modal" data-bs-target=".addPresetModal">Add Preset</button>
                                        <table id="quickresponse_table" class="table table-bordered table-hover table-sm w-100">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Response</th>
                                                    <th class="noWidth"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal addPresetModal" data-bs-backdrop="static" role="dialog" aria-modal="true" data-bs-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Preset Response</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_finish_modal" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="addPresetForm">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Title</label>
                            <textarea name="title" class="form-control" required></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Response</label>
                            <textarea id="addResponseContent" name="response" class="form-control" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="nsm-button primary float-end">Save Preset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal editPresetModal" data-bs-backdrop="static" role="dialog" aria-modal="true" data-bs-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Preset Response</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_finish_modal" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="editPresetForm">
                    <div class="row">
                        <div class="d-none">
                            <input name="id" type="hidden" class="form-control" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Title</label>
                            <textarea name="title" class="form-control" required></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label">Response</label>
                            <textarea id="editResponseContent" name="response" class="form-control" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="nsm-button primary float-end">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var BASE_URL = window.origin;
    const commonConfig = {
        // toolbarGroups: [
        //     { name: 'clipboard', groups: ['clipboard', 'undo'] },
        //     { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        //     { name: 'links', groups: ['links'] },
        // ],
        allowedContent: true,
        height: '165px'
    };

    $(document).ready(function() {
        CKEDITOR.replace('addResponseContent', commonConfig);
        CKEDITOR.replace('editResponseContent', commonConfig);

        // DataTable Configuration ===============
        const quickresponse_table = $('#quickresponse_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": BASE_URL + "/ChatbotSettings/viewPreset",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $('#quickresponse_table_search').keyup(function() {
            quickresponse_table.search($(this).val()).draw();
        });

        // Custom Function ===============
        function formDisabler(selector, state) {
            const element = $(selector);
            const submitButton = element.find('button[type="submit"]');
            element.find("input, button, textarea, select").prop('disabled', state);

            if (state) {
                element.find('a').hide();
                if (!submitButton.data('original-content')) {
                    submitButton.data('original-content', submitButton.html());
                }
                submitButton.prop('disabled', true).html('Processing...');
            } else {
                element.find('a').show();
                const originalContent = submitButton.data('original-content');
                if (originalContent) {
                    submitButton.prop('disabled', false).html(originalContent);
                }
            }
        }

        $(document).on('submit', '#chatbotPreferenceForm', function(e) {
            e.preventDefault();
            let preferenceData = $(this);

            Swal.fire({
                icon: "warning",
                title: "Update Preference",
                html: "Are you sure you want to update chatbot preference?",
                showCancelButton: true,
                confirmButtonText: "Update",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "/ChatbotSettings/savePreference",
                        data: preferenceData.serialize(),
                        dataType: "JSON",
                        beforeSend: function() {
                            formDisabler(preferenceData, true);
                            Swal.fire({
                                icon: "info",
                                title: "Saving Preference!",
                                html: "Please wait while the save process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            formDisabler(preferenceData, false);
                        }
                    });
                }
            });
        });

        $(document).on('submit', '#addPresetForm', function(e) {
            e.preventDefault();
            let addPresetData = $(this);
            let responseContent = CKEDITOR.instances.addResponseContent.getData();
            let formData = addPresetData.serializeArray();
            formData.push({
                name: "response",
                value: responseContent
            });

            $.ajax({
                type: "POST",
                url: BASE_URL + "/ChatbotSettings/addPreset",
                data: $.param(formData),
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(addPresetData, true);
                    CKEDITOR.instances.addResponseContent.setReadOnly(true);
                    Swal.fire({
                        icon: "info",
                        title: "Adding Preset!",
                        html: "Please wait while the add process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    Swal.close();
                    $('.addPresetModal').modal('hide');
                    addPresetData.find("input").val(null);
                    CKEDITOR.instances.addResponseContent.setData('');
                    quickresponse_table.ajax.reload();
                    formDisabler(addPresetData, false);
                    CKEDITOR.instances.addResponseContent.setReadOnly(false);
                }
            });
        });

        $(document).on('submit', '#editPresetForm', function(e) {
            e.preventDefault();
            let editPresetData = $(this);
            let responseContent = CKEDITOR.instances.editResponseContent.getData();
            let formData = editPresetData.serializeArray();
            formData.push({
                name: "response",
                value: responseContent
            });

            Swal.fire({
                icon: "warning",
                title: "Update Preset",
                html: "Are you sure you want to update this preset?",
                showCancelButton: true,
                confirmButtonText: "Update",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "/ChatbotSettings/editPreset",
                        data: $.param(formData),
                        dataType: "JSON",
                        beforeSend: function() {
                            formDisabler(editPresetData, true);
                            CKEDITOR.instances.editResponseContent.setReadOnly(true);
                            Swal.fire({
                                icon: "info",
                                title: "Updating Preset!",
                                html: "Please wait while the update process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            $('.editPresetModal').modal('hide');
                            quickresponse_table.ajax.reload();
                            formDisabler(editPresetData, false);
                            CKEDITOR.instances.editResponseContent.setReadOnly(false);
                        }
                    });
                }
            });
        });

        $(document).on('click', '.editPresetButton', function() {
            const presetID = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: BASE_URL + "/ChatbotSettings/getPreset",
                data: "id=" + presetID,
                dataType: "JSON",
                beforeSend: function() {
                    $('#editPresetForm').find("input, textarea").val(null);
                    CKEDITOR.instances.editResponseContent.setData('');
                    CKEDITOR.instances.editResponseContent.setReadOnly(true);
                },
                success: function(response) {
                    console.log(response);
                    CKEDITOR.instances.editResponseContent.setReadOnly(false);
                    $('#editPresetForm').find('input[name="id"]').val(response[0]['id']);
                    $('#editPresetForm').find('textarea[name="title"]').val(response[0]['title']);
                    CKEDITOR.instances.editResponseContent.setData(response[0]['response']);
                }
            });
        });

        $(document).on('click', '.removePresetButton', function() {
            const presetID = $(this).attr('data-id');
            const presetTitle = $(this).attr('data-title');

            Swal.fire({
                icon: "warning",
                title: "Remove Preset",
                html: "Are you sure you want to remove preset title <br><strong>''" + presetTitle + "''</strong> ?",
                showCancelButton: true,
                confirmButtonText: "Remove",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "/ChatbotSettings/removePreset",
                        data: "id=" + presetID,
                        dataType: "JSON",
                        beforeSend: function() {
                            Swal.fire({
                                icon: "info",
                                title: "Removing Preset!",
                                html: "Please wait while the remove process is running...",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            console.log(response);
                            quickresponse_table.ajax.reload();
                        }
                    });
                }
            });
        });

        $(document).on('change', '.chatbot_colorpicker', function() {
            let color = $(this).val();
            $('#chatbotPreferenceForm').find('input[name="color"]').val(color);
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
