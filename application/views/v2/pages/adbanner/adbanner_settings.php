<?php include viewPath('v2/includes/header'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<style>
    .fw-xnormal {
        font-weight: 500;
    }

    table.dataTable.no-footer {
        border-bottom: 0px solid #dee2e6 !important;
    }

    table.dataTable thead th,
    table.dataTable thead td,
    table.dataTable tbody td {
        padding: 6px !important;
    }

    table.dataTable>thead>tr>th {
        border-bottom: 1px solid lightgray !important;
    }

    /* table>tbody {
        font-size: 16px;
    } */

    .dataTables_length,
    .dataTables_filter {
        display: none;
    }

    .addBannerButton {
        margin-top: -38px;
    }
    
    .actionColumn {
        font-size: 16px;
        font-weight: bolder;
    }
    
    .noWidth {
        width: 0% !important;
    }
    
    /* textarea[name="description"] { 
        height: 140px !important;
    } */

    input[name="link"] {
        width: 100px !important;
    }
</style>
<div class="row page-content g-0">
    <div class="col-sm-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/adbanner_tabs'); ?>
    </div>
    <div class="col-lg-12">
        <div class="nsm-callout primary">
            <button><i class="bx bx-x"></i></button>
            Set up and customize the Discover More ADS.
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row g-3">
            <div class="col-lg-12 mb-3">
                <div class="row g3">
                    <div class="col-lg-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="nsm-card-title">
                                    <span>Banner List</span>
                                </div>
                                <label class="nsm-subtitle">Add an image or video advertisement banner for <a href="<?php echo base_url('dashboard#discover_carousel'); ?>" target="_blank">Discover More</a> widget in Dashboard.</label>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-lg-12">
                                        <input id="bannerlist_table_search" class="form-control mt-0 mb-2 w-25" type="text" placeholder="Search...">
                                        <button type="button" class="nsm-button small primary float-end addBannerButton" data-bs-toggle="modal" data-bs-target=".addBannerModal">Add Banner</button>
                                        <table id="bannerlist_table" class="table table-bordered table-hover w-100" style="background: #00000008;">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Link</th>
                                                    <th>URL Alias</th>
                                                    <th>Duration</th>
                                                    <th class="noWidth"></th>
                                                </tr>
                                            </thead>
                                            <tbody><tr></tr></tbody>
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

<div class="modal fade addBannerModal" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add Banner</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="addBannerForm">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Title</label>
                            <input name="title" type="text" class="form-control" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Description</label>
                            <textarea name="description" class="form-control" style="height: 140px !important;" required></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Link</label> <small class="text-muted">(specify url and its alias. this is optional)</small>
                            <div class="input-group">
                                <input name="link" type="text" class="form-control" placeholder="https://" required>
                                <input name="url_alias" type="text" class="form-control" placeholder="URL Alias" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Duration</label> <small class="text-muted">(how many seconds to display the banner)</small>
                            <select name="duration" class="form-select" required>
                                <option value="duration_3sec">3 seconds</option>
                                <option value="duration_4sec">4 seconds</option>
                                <option value="duration_5sec">5 seconds</option>
                                <option value="duration_6sec">6 seconds</option>
                                <option value="duration_7sec">7 seconds</option>
                                <option value="duration_8sec">8 seconds</option>
                                <option value="duration_9sec">9 seconds</option>
                                <option value="duration_10sec">10 seconds</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">File</label> <small class="text-muted">(only accepts image or video)</small>
                            <input name="banner_file" class="form-control" type="file" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.wmv" required>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="nsm-button primary float-end">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editBannerModal" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Banner</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="editBannerForm">
                    <div class="row">
                        <div class="d-none">
                            <label class="form-label fw-xnormal">ID</label>
                            <input name="id" type="text" class="form-control" readonly>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Title</label>
                            <input name="title" type="text" class="form-control" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Description</label>
                            <textarea name="description" class="form-control" style="height: 140px !important;" required></textarea>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Link</label> <small class="text-muted">(specify url and its alias. this is optional)</small>
                            <div class="input-group">
                                <input name="link" type="text" class="form-control" placeholder="https://" required>
                                <input name="url_alias" type="text" class="form-control" placeholder="URL Alias" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">Duration</label> <small class="text-muted">(how many seconds to display the banner)</small>
                            <select name="duration" class="form-select" required>
                                <option value="duration_3sec">3 seconds</option>
                                <option value="duration_4sec">4 seconds</option>
                                <option value="duration_5sec">5 seconds</option>
                                <option value="duration_6sec">6 seconds</option>
                                <option value="duration_7sec">7 seconds</option>
                                <option value="duration_8sec">8 seconds</option>
                                <option value="duration_9sec">9 seconds</option>
                                <option value="duration_10sec">10 seconds</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label class="form-label fw-xnormal">File</label> <small class="text-muted">(only accepts image or video)</small>
                            <input name="banner_file" class="form-control" type="file" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.wmv">
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

<div class="modal fade viewBannerFileModal" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Preview Banner File</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_preview_modal" data-bs-dismiss="modal" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div id="previewBannerContent" class="text-center">
                    <p class="text-muted">No file selected for preview.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    var BASE_URL = window.origin;

    $(document).ready(function() {
        // DataTable Configuration ===============
        const bannerlist_table = $('#bannerlist_table').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": BASE_URL + "/AdBanner/viewBanner",
                "type": "POST",
            },
            "language": {
                "infoFiltered": "",
            },
            // "order": [[0, 'desc'] ],
        });

        $('#bannerlist_table_search').keyup(function() {
            bannerlist_table.search($(this).val()).draw();
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

        $('input[name="banner_file"]').on('change', function () {
            const file = this.files[0];

            if (file) {
                const validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'avi', 'mov', 'wmv'];
                const maxFileSize = 50 * 1024 * 1024;
                const fileName = file.name.toLowerCase();
                const fileExtension = fileName.split('.').pop();

                if (!validExtensions.includes(fileExtension)) {
                    $(this).val('');

                    Swal.fire({
                        icon: "error",
                        title: "Failed to select File!",
                        html: "Please select a file with a valid format: jpg, jpeg, png, gif, mp4, avi, mov, wmv.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                        showCloseButton: true,
                    });

                    return;
                }

                if (file.size > maxFileSize) {
                    $(this).val(''); 

                    Swal.fire({
                        icon: "error",
                        title: "File is too Big!",
                        html: "Only accepts files up to 50MB.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                        showCloseButton: true,
                    });

                    return;
                }
            }
        });

        $(document).on('submit', '#addBannerForm', function (e) {
            e.preventDefault();
            let addPresetData = new FormData(this); // Use FormData for handling file uploads

            $.ajax({
                type: "POST",
                url: BASE_URL + "/AdBanner/addbanner",
                data: addPresetData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function () {
                    formDisabler($('#addBannerForm'), true); 
                    Swal.fire({
                        icon: "info",
                        title: "Saving Entry!",
                        html: "Please wait while the uploading process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function (response) {
                    if (response.success) {
                        $('#addBannerForm')[0].reset();
                        $('.addBannerModal').modal('hide'); 
                        bannerlist_table.ajax.reload();
                        Swal.fire({
                            icon: "success",
                            title: "Entry Saved!",
                            html: "Your banner has been successfully uploaded.",
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
                    formDisabler($('#addBannerForm'), false);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        html: "An unexpected error occurred: " + error,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler($('#addBannerForm'), false);
                },
            });
        });

        $(document).on('submit', '#editBannerForm', function (e) {
            e.preventDefault();

            const form = $(this);
            const formData = new FormData(this); 
            const bannerFile = form.find('input[name="banner_file"]').get(0).files[0];

            if (!bannerFile) {
                formData.delete("banner_file");
            }

            $.ajax({
                type: "POST",
                url: BASE_URL + "/AdBanner/editBanner",
                data: formData,
                contentType: false,
                processData: false, 
                dataType: "JSON",
                beforeSend: function () {
                    formDisabler(form, true);
                },
                success: function (response) {
                    if (response.success) {
                        bannerlist_table.ajax.reload();
                        $('.editBannerModal').modal('hide'); 
                        Swal.fire({
                            icon: "success",
                            title: "Banner Updated!",
                            text: "Banner has been successfully updated.",
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Failed to Update!",
                            text: "Failed to update the banner.",
                        });
                    }
                    formDisabler(form, false);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        html: "An unexpected error occurred: " + error,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler($(form), false);
                },
            });
        });

        // ========================
        
        $(document).on('click', '.editBannerButton', function () {
            const bannerID = $(this).attr('data-id');
            const editForm = $('#editBannerForm');

            $.ajax({
                type: "POST",
                url: BASE_URL + "/AdBanner/getBannerDetails", 
                data: { id: bannerID },
                dataType: "JSON",
                beforeSend: function () {
                    editForm.find("input, textarea, select").val(null); 
                },
                success: function (response) {
                    if (response.success) {
                        editForm.find('input[name="id"]').val(response.data.id);
                        editForm.find('input[name="title"]').val(response.data.title);
                        editForm.find('textarea[name="description"]').val(response.data.description);
                        editForm.find('input[name="link"]').val(response.data.link);
                        editForm.find('input[name="url_alias"]').val(response.data.url_alias);
                        editForm.find('select[name="duration"]').val(response.data.duration);
                        $('.editBannerModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: response.message || "Failed to fetch banner details.",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An unexpected error occurred while fetching banner details.",
                    });
                },
            });
        });

        $(document).on('click', '.removeBannerButton', function() {
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
                        url: BASE_URL + "/AdBanner/removeBanner",
                        data: "id=" + presetID,
                        dataType: "JSON",
                        success: function (response) {
                            bannerlist_table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: "Banner Removed!",
                                html: "Your banner has been removed successfully.",
                                showConfirmButton: true,
                                confirmButtonText: "Proceed",
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.viewBannerFileButton', function () {
            const fileName = $(this).attr('data-filename');
            const fileUrl = `${BASE_URL}/uploads/BusinessBanner/${fileName}`;
            const fileType = fileName.split('.').pop().toLowerCase();
            const previewContent = $('#previewBannerContent');

            let content = '';
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileType)) {
                content = `<img src="${fileUrl}" class="img-fluid" alt="Banner Image">`;
            } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileType)) {
                content = `
                    <video controls class="w-100">
                        <source src="${fileUrl}" type="video/${fileType}">
                        Your browser does not support the video tag.
                    </video>`;
            } else {
                content = `<p class="text-danger">Unsupported file format for preview.</p>`;
            }

            previewContent.html(content);
            $('.viewBannerFileModal').modal('show');
        });

    });
</script>
<?php include viewPath('v2/includes/footer'); ?>
