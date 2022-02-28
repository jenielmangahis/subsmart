$(document).on("click", function(event) {

    if ($(event.target).closest("#management_reports_modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#management_reports_modal .pint-pries-option-section").hide();
    }
    if ($(event.target).closest("#management_reports_modal #cover-page-section .page-styles-img .logo-style").length === 0) {
        $("#management_reports_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").hide();
    }
    if ($(event.target).closest("#management_reports_modal #cover-page-section .page-styles-img .cover-style").length === 0) {
        $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").hide();
    }
    if ($(event.target).closest("#advance_field_modal .body .form-group .options-section").length === 0) {
        $("#advance_field_modal .body .form-group .options-section .options").hide();
    }

});
$(document).on('click', 'div#management_reports_modal .the-modal-body .the-header .icons div.close-modal', function() {
    $("#management_reports_modal").fadeOut();
    $('#management_reports_modal form').trigger("reset");
});
$(document).on("click", "#management_reports_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    // $("#management_reports_modal .modal-footer-check .middle-links").hide();
});
$('#management_reports_modal').on('hidden.bs.modal', function() {
    $("#management_reports_modal .modal-footer-check .middle-links").show();
});
$(document).on("click", "#management_reports_modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#management_reports_modal .pint-pries-option-section").show();
});

$(document).on("click", "#management_reports_modal .modal-footer-check button.cancel-button", function(event) {
    event.preventDefault();
    if ($(this).attr("data-submit-type") == null) {
        $("#management_reports_modal").fadeOut();
        $('#management_reports_modal form').trigger("reset");
    }

});

$(document).on("click", "#management_reports_modal #cover-page-section .page-styles-img .cover-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").show();
});
$(document).on("click", "#management_reports_modal #cover-page-section .page-styles-img .logo-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#management_reports_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").show();
});

$(document).on("click", "#management_reports_modal .the-content .report-pages ul li", function(event) {
    $("#" + $("#management_reports_modal .the-content .report-pages ul li.active").attr("data-target")).hide();
    $("#management_reports_modal .the-content .report-pages ul li.active").removeClass("active");
    update_table_contents_sample_page_div();
    $("#" + $(this).attr("data-target")).fadeIn();
    $(this).addClass("active");
});

$(document).on("click", "#management_reports_modal #reports .report-section", function(event) {
    if ($(this).children(".row").children(".col-md-10").children(".content-collapse.hide").length > 0) {
        remove_empty_report();
        close_reports_sections(this);
    }
});

$(document).on("click", "#management_reports_modal #reports .report-section .report-delete-btn", function(event) {
    var report_id = $(this).attr("data-id");
    var deleted = report_id + "," + $("#management_reports_modal input[name='deleted_reports_pages']").val();
    $("#management_reports_modal input[name='deleted_reports_pages']").val(deleted);
    $(this).parents(".report-section").remove();
    update_table_contents_sample_page_div();
});

$(document).on("click", "#management_reports_modal #reports .add-report-btn", function(event) {
    remove_empty_report();
    close_reports_sections(this);
    add_report_page();
});

function add_report_page(count = 0) {
    var management_report_id = $("#management_reports_modal input[name='management_report_id']").val();
    var data_count = parseInt($("#management_reports_modal #reports .report-section:last-child").attr("data-count")) + 1;
    $.ajax({
        url: baseURL + "/management-report/company-overview/add-new-report-section",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count,
            count: count,
            management_report_id: management_report_id
        },
        success: function(data) {
            $("#management_reports_modal #reports .sections").append(data.new_report);
            update_table_contents_sample_page_div();
        },
    });
}

function remove_empty_report() {
    if ($('#management_reports_modal #reports .report-section.new_report:last-child select[name="report_type[]"]').val() == "") {
        $('#management_reports_modal #reports .report-section.new_report:last-child').remove();
    }
}

function close_reports_sections(elem) {
    $("#management_reports_modal #reports .report-section .closed-content-view").show();
    $("#management_reports_modal #reports .report-section .content-collapse").hide();
    $("#management_reports_modal #reports .report-section .content-collapse").addClass("hide");
    $("#management_reports_modal #reports .report-section .report-delete-btn").attr("class", "fa fa-pencil report-edit-btn");
    if ($("#management_reports_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse.hide").length > 0) {
        $("#management_reports_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .closed-content-view").hide();
        $("#management_reports_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse").show();
        $("#management_reports_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse").removeClass("hide");
        $("#management_reports_modal #reports .report-section .content-collapse").addClass("show");
        $("#management_reports_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .report-edit-btn").attr("class", "fa fa-trash-o report-delete-btn");
    }
}

$(document).on("change", '#management_reports_modal #reports .report-section.new_report:last-child select[name="report_type[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("input[name='report_title[]']").val($(this).val());
    if ($(this).val() != "") {
        $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html($(this).val());
    } else {
        $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html("New report");
    }

    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("select[name='report_period[]']").val());
});
$(document).on("change", '#management_reports_modal #reports .report-section.new_report:last-child input[name="report_title[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("select[name='report_period[]']").val());
});
$(document).on("change", '#management_reports_modal #reports .report-section.new_report:last-child select[name="report_period[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).val());
});

$(document).on("click", "#management_reports_modal #preliminary-page a.add-new-page", function(event) {
    event.preventDefault();
    company_overview_add_preliminary_page();
});

$(document).on("click", "#management_reports_modal #preliminary-page .delete-page-btn", function(event) {
    var preliminary_page_id = $(this).attr("data-id");
    var deleted = preliminary_page_id + "," + $("#management_reports_modal input[name='deleted_preliminary_pages']").val();
    $("#management_reports_modal input[name='deleted_preliminary_pages']").val(deleted);
    $(this).parents(".page").remove();
    update_table_contents_sample_page_div();
});


function company_overview_add_preliminary_page(count = 0) {
    var data_count;
    var new_elements;
    if ($("#management_reports_modal #preliminary-page .pages .page:last-child").length > 0) {
        data_count = parseInt($("#management_reports_modal #preliminary-page .pages .page:last-child").attr("data-count")) + 1;
    } else {
        data_count = parseInt($("#management_reports_modal #preliminary-page .pages .page:first-child").attr("data-count")) + 1;
    }
    var management_report_id = $("#management_reports_modal input[name='management_report_id']").val();
    $.ajax({
        url: baseURL + "/management-report/company_overview/add-preliminary-page",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count,
            management_report_id: management_report_id,
            count: count
        },
        success: function(data) {
            $("#management_reports_modal #preliminary-page .pages").append(data.new_page);
            if (count > 0) {
                $("#management_reports_modal #preliminary-page .pages .page textarea").ckeditor();
            } else {
                $("#management_reports_modal #preliminary-page .pages .page:last-child textarea").ckeditor();
            }
            update_table_contents_sample_page_div();
        },
    });
}
$(document).on("click", "#management_reports_modal #cover-page-section .page-styles-img .cover-style .styles-option-section .style-option", function(event) {
    $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .style-icon").attr("class", "style-icon icon-" + $(this).attr("data-count"));
    $("#management_reports_modal form input[name='cover_style']").val($(this).attr("data-count"));
    cover_page_changed();
});

$(document).on('click', 'table#manage_reports_table ul.report_options li.edit', function() {
    $($(this).attr("data-target")).fadeIn();
    var management_report_id = $(this).attr("data-id");
    $.ajax({
        url: baseURL + "/management-report/get-management-report",
        type: "POST",
        dataType: "json",
        data: {
            management_report_id: management_report_id
        },
        success: function(data) {
            $("#management_reports_modal #cover-page-section .cover_page_template_view").html('<iframe src="' + data.file_location + '" title="Cover page template view"></iframe>');
            $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .style-icon").attr("class", "style-icon icon-" + data.cover_style);
            $('#management_reports_modal input[name="cover_style"]').val(data.cover_style);
            $('#management_reports_modal input[name="template_name"]').val(data.template_name);
            $('#management_reports_modal select[name="template_report_period"]').val(data.report_period);
            $('#management_reports_modal input[name="cover_page_cover_title"]').val(data.cover_title);
            $('#management_reports_modal input[name="cover_page_subtitle"]').val(data.cover_subtitle);
            $('#management_reports_modal input[name="cover_page_report_period"]').val(data.cover_report_period);
            $('#management_reports_modal input[name="cover_page_prepared_by"]').val(data.cover_prepared_by);
            $('#management_reports_modal input[name="cover_page_prepared_date"]').val(data.cover_prepared_date);
            $('#management_reports_modal input[name="cover_page_disclaimer"]').val(data.cover_disclaimer);
            $('#management_reports_modal input[name="cover_page_disclaimer"]').val(data.cover_disclaimer);
            $('#management_reports_modal input[name="table_of_contents_page_title"]').val(data.table_page_title);
            $('#management_reports_modal input[name="end_notes_page_title"]').val(data.endnote_page_title);
            $('#management_reports_modal #end-notes .page-content-field').html();
            $('#management_reports_modal #end-notes .page-content-field').html('<textarea class="form-control ckeditor" name="end_notes_page_content" id="end_notes_page_content" cols="40" rows="20">' + data.endnote_page_content + "</textarea>");
            $("#management_reports_modal #end-notes .page .page-content-field textarea").ckeditor();
            $('#management_reports_modal input[name="management_report_id"]').val(management_report_id);

            if (data.cover_show_logo == "0") {
                $('#management_reports_modal input[name="show-logo"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="show-logo"]').prop("checked", true);
            }
            if (data.table_include_table_of_contents == "0") {
                $('#management_reports_modal input[name="include_table_of_contents"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="include_table_of_contents"]').prop("checked", true);
            }
            if (data.cover_disclaimer == "0") {
                $('#management_reports_modal input[name="cover_page_disclaimer"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="cover_page_disclaimer"]').prop("checked", true);
            }
            if (data.endnotes_include_page == "0") {
                $('#management_reports_modal input[name="end_notes_include_this_page"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="end_notes_include_this_page"]').prop("checked", true);
            }
            if (data.endnotes_break_down == "0") {
                $('#management_reports_modal input[name="end_notes_include_breakdown_of_sub_accounts"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="end_notes_include_breakdown_of_sub_accounts"]').prop("checked", true);
            }
            $("#management_reports_modal #preliminary-page .pages").html("");
            if (data.preliminary_pages_ctr == 0) {
                company_overview_add_preliminary_page();
            } else {
                company_overview_add_preliminary_page(data.preliminary_pages_ctr);
            }
            $("#management_reports_modal #reports .sections").html("");
            if (data.reports_ctr == 0) {
                add_report_page();
            } else {
                add_report_page(data.reports_ctr);
            }

            $('#advance_field_modal input[name="af_company_name"]').val(data.af_company_name);
            $('#advance_field_modal input[name="af_header"]').val(data.af_header);
            $('#advance_field_modal input[name="af_footer"]').val(data.af_footer);
            if (data.af_only_zero == 1) {
                $('#advance_field_modal input[name="af_only_zero"]').prop("checked", true);
            } else {
                $('#advance_field_modal input[name="af_only_zero"]').prop("checked", false);
            }
        },
    });
});


$(document).on('click', '#management_reports_modal .modal-footer-check button[data-submit-type="save"]', function(event) {
    event.preventDefault();
    $('#management_reports_modal textarea[name="end_notes_page_content"]').html(CKEDITOR.instances["end_notes_page_content"].getData());
    var ctr = 1;
    $("#management_reports_modal textarea[name='prelimenary_page_content[]']").map(function() {
        $(this).html(CKEDITOR.instances["prelimenary_page_content_" + ctr].getData());
        ctr++;
    }).get();

    Swal.fire({
        title: "",
        html: "Save?",
        showCancelButton: true,
        imageUrl: baseURL + "/assets/img/accounting/customers/folder.png",
        cancelButtonColor: "#d33",
        confirmButtonColor: "#2ca01c",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: baseURL + "/management-report/update",
                type: "POST",
                dataType: "json",
                data: $("#management_reports_modal #management_report_form").serialize(),
                success: function(data) {
                    if (data.result == "success") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Management report has been saved.",
                            icon: "success",
                        });
                    }
                },
            });
        }
    });
});

$(document).on("change", '#management_reports_modal input[name="report_compare_prev_year[]"]', function(event) {

    var val = 0;
    if ($(this).is(":checked")) {
        val = 1;
    }
    $(this).parents(".report-section").children('input[name="input_report_compare_prev_year[]"]').val(val);
});
$(document).on('change', '#management_reports_modal input[name="report_compare_prev_period[]"]', function(event) {
    var val = 0;
    if ($(this).is(":checked")) {
        val = 1;
    }
    $(this).parents(".report-section").children('input[name="input_report_compare_prev_period[]"]').val(val);
});


$(document).on('change', '#management_reports_modal input[name="include_this_page[]"]', function(event) {
    var val = 0;
    if ($(this).is(":checked")) {
        val = 1;
    }
    $(this).parents(".page").children('input[name="input_include_this_page[]"]').val(val);
});
$(document).on('change', '#management_reports_modal input[name="table_of_contents_page_title"]', function(event) {
    $("#management_reports_modal #table-of-contents .page-content .page-content-preview .content-title").html($(this).val());
});

$(document).on('change', '#management_reports_modal input[name="preliminary_page_title[]"]', function(event) {
    update_table_contents_sample_page_div();
});

$(document).on('change', '#management_reports_modal input[name="include_this_page[]"]', function(event) {
    update_table_contents_sample_page_div();
});

function update_table_contents_sample_page_div() {
    $("#management_reports_modal #table-of-contents .page-content .page-content-preview .norms").html("");
    var htmls_ = "";
    $("#management_reports_modal input[name='include_this_page[]']")
        .map(function() {
            if ($(this).is(":checked")) {
                var page_title = $(this).parents(".page").children(".form-group").children("input").val();
                if (page_title != "") {
                    htmls_ += '<div class="norm">' + page_title + '</div>';
                }
            }
        });
    $("#management_reports_modal input[name='report_title[]']")
        .map(function() {
            htmls_ += '<div class="norm">' + $(this).val() + '</div>';
        });

    if ($("#management_reports_modal input[name='end_notes_include_this_page']").is(":checked") && $("#management_reports_modal input[name='end_notes_page_title']").val() != "") {
        htmls_ += '<div class="norm">' + $("#management_reports_modal input[name='end_notes_page_title']").val() + '</div>';
    }

    $("#management_reports_modal #table-of-contents .page-content .page-content-preview .norms").html(htmls_);
}
$(document).on('change', '#management_reports_modal #cover-page-section input', function(event) {
    cover_page_changed();
});

function cover_page_changed() {
    $.ajax({
        url: baseURL + "/management-report/cover-page/changed",
        type: "POST",
        dataType: "json",
        data: $("#management_reports_modal #management_report_form").serialize(),
        success: function(data) {
            if (data.result == "success") {
                $("#management_reports_modal #cover-page-section .cover_page_template_view").html('<iframe src="' + data.file_location + '" title="Cover page template view"></iframe>');
            }
        },
    });
}
$(document).on('click', '#manage_reports_table .view-management_report', function(event) {
    event.preventDefault();
    $("#management_reports_viewer_modal").fadeIn();
    $("#management_reports_viewer_modal .body .iframe").html("");
    var management_report_id = $(this).attr("data-id");
    var report_period = $(this).parents("tr").children("td").children('select[name="filter_date"]').val();
    $.ajax({
        url: baseURL + "management-report/export/pdf",
        type: "POST",
        dataType: "json",
        data: {
            management_report_id: management_report_id,
            template_report_period: report_period
        },
        success: function(data) {
            $("#management_reports_viewer_modal .body .iframe").html('<iframe src="' + data.file_location + '" frameborder="0" class="pdf_viewer"></iframe>');
            $("#loader-modal").hide();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Error",
                html: "Please try again later.",
                icon: "error",
            });
            $("#loader-modal").hide();
        },
    });

});
$(document).on('click', '#management_reports_viewer_modal .cancel-button', function(event) {
    event.preventDefault();
    $("#management_reports_viewer_modal").fadeOut();
});



$(document).on('click', '#advance_field_modal .body .form-group .options-section .label', function(event) {
    event.preventDefault();
    $("#advance_field_modal .body .form-group .options-section .options").hide();
    $(this).parents(".options-section").children('.options').show();
});
$(document).on('click', '#advance_field_modal .cancel-button', function(event) {
    $("#advance_field_modal").hide();
    var default_af_form = $("#advance_field_modal").html();
    $("#advance_field_modal").html("");
    $("#advance_field_modal").html(default_af_form);
});
$(document).on('click', '#advance_field_modal .body .close-btn', function(event) {
    $("#advance_field_modal").hide();
    var default_af_form = $("#advance_field_modal").html();
    $("#advance_field_modal").html("");
    $("#advance_field_modal").html(default_af_form);
});

$(document).on('click', '#management_reports_modal .middle-links.end a', function(event) {
    $("#advance_field_modal").fadeIn();
});

$(document).on('click', '#management_reports_modal .middle-links.end a', function(event) {
    $("#advance_field_modal").fadeIn();
});


$(document).on('click', '#advance_field_modal .print-button', function(event) {
    $("#advance_field_modal").fadeOut();
});

$(document).on('click', '#advance_field_modal .body .form-group .options-section .options .option', function(event) {
    $(this).parents(".form-group").children('input').val($(this).parents(".form-group").children('input').val() + " " + $(this).html());
    $("#advance_field_modal .body .form-group .options-section .options").hide();
});

$(document).on('click', '#manage_reports_table tbody li a.send-email', function(event) {
    $($(this).attr("data-target")).fadeIn();
    $("#management_reports_email_modal input[name='filename']").val($(this).attr("data-company") + "_" + $(this).attr("data-report"));
    $("#management_reports_email_modal input[name='management_report_id']").val($(this).attr("data-id"));
});

$(document).on('click', '#management_reports_email_modal .cancel-button', function(event) {
    $("#management_reports_email_modal").fadeOut();
});
$(document).on('click', '#management_reports_email_modal .body .btn-close-modal', function(event) {
    $("#management_reports_email_modal").fadeOut();
});
$(document).on("click", "#management_reports_email_modal .save-button", function(event) {
    var empty_flds = 0;
    $("#management_reports_email_modal form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });

    if (empty_flds == 0) {
        event.preventDefault();

        Swal.fire({
            title: "Send?",
            html: "Are you sure you want to send this?",
            showCancelButton: true,
            imageUrl: baseURL + "assets/img/accounting/customers/message.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "management-report/send",
                    type: "POST",
                    dataType: "json",
                    data: $("#management_reports_email_modal form").serialize(),
                    success: function(data) {
                        if (data.result == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Email has been sent!",
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Unable to send the reminder.<br>" + data.error,
                                icon: "error",
                            });
                        }
                        $("#loader-modal").hide();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Unsent",
                            html: "Please try again later. <br>",
                            icon: "error",
                        });
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    }
});

$(document).on("click", "#manage_reports_table tbody li a.export-pdf", function(event) {
    var management_report_id = $(this).attr("data-id");
    var company_name = $(this).attr("data-company");
    var template_name = $(this).attr("data-report");
    $("body").css("cursor", "wait");
    $.ajax({
        url: baseURL + "management-report/export/pdf",
        type: "POST",
        dataType: "json",
        data: {
            management_report_id: management_report_id
        },
        success: function(data) {
            fetch(data.file_location)
                .then(resp => resp.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    // the filename you want
                    a.download = company_name + "_" + template_name + ".pdf";
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                })
                .catch(() => Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: "Error",
                    html: "Please try again later.",
                    icon: "error",
                }));
            $("body").css("cursor", "auto");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Error",
                html: "Please try again later.",
                icon: "error",
            });
            $("#loader-modal").hide();
        },
    });
});


$(document).on("click", "#import-customer", function(event) {
    var management_report_id = $(this).attr("data-id");
    $("body").css("cursor", "wait");
    $.ajax({
        url: baseURL + "management-report/export/docx",
        type: "POST",
        dataType: "json",
        data: {
            management_report_id: management_report_id
        },
        success: function(data) {
            $("body").css("cursor", "auto");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Error",
                html: "Please try again later.",
                icon: "error",
            });
            $("#loader-modal").hide();
        },
    });
});

$(document).on('click', '#management_reports_modal .middle-links a.print-preview-option', function(event) {
    event.preventDefault();
    $("body").css("cursor", "wait");
    $("#management_reports_viewer_modal").fadeIn();
    $("#management_reports_viewer_modal .body .iframe").html("");
    $("#management_reports_modal form input[name='action']").val("preview");
    $.ajax({
        url: baseURL + "management-report/generate/preview",
        type: "POST",
        dataType: "json",
        data: $("#management_reports_modal form").serialize(),
        success: function(data) {
            $("#management_reports_viewer_modal .body .iframe").html('<iframe src="' + data.file_location + '" frameborder="0" class="pdf_viewer"></iframe>');
            $("body").css("cursor", "auto");
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Error",
                html: "Please try again later.",
                icon: "error",
            });
            $("#loader-modal").hide();
        },
    });
});