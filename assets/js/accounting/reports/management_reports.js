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
});
$(document).on('click', 'div#management_reports_modal .the-modal-body .the-header .icons div.close-modal', function() {
    $("#management_reports_modal").fadeOut();
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
    $("#management_reports_modal").fadeOut();
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
    $("#" + $(this).attr("data-target")).fadeIn();
    $(this).addClass("active");
});

$(document).on("click", "#management_reports_modal #reports .report-section", function(event) {
    console.log($(this).children(".row").children(".col-md-10").children(".content-collapse.hide").length);
    if ($(this).children(".row").children(".col-md-10").children(".content-collapse.hide").length > 0) {
        remove_empty_report();
        close_reports_sections(this);
    }
});

$(document).on("click", "#management_reports_modal #reports .report-section .report-delete-btn", function(event) {
    $(this).parents(".report-section").remove();
});

$(document).on("click", "#management_reports_modal #reports .add-report-btn", function(event) {
    remove_empty_report();
    close_reports_sections(this);
    var data_count = parseInt($("#management_reports_modal #reports .report-section:last-child").attr("data-count")) + 1;;
    $.ajax({
        url: baseURL + "/management-report/company-overview/add-new-report-section",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count
        },
        success: function(data) {
            $("#management_reports_modal #reports .sections").append(data.new_report);
        },
    });
});

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
    company_overview_add_preliminary_page();
});

$(document).on("click", "#management_reports_modal #preliminary-page .delete-page-btn", function(event) {
    if ($("#management_reports_modal #preliminary-page .pages .page").length > 1) {
        $(this).parent("div.form-check").parent(".page").remove();
    }
});
company_overview_add_preliminary_page();

function company_overview_add_preliminary_page() {
    var data_count;
    var new_elements;
    if ($("#management_reports_modal #preliminary-page .pages .page:last-child").length > 0) {
        data_count = parseInt($("#management_reports_modal #preliminary-page .pages .page:last-child").attr("data-count")) + 1;
    } else {
        data_count = parseInt($("#management_reports_modal #preliminary-page .pages .page:first-child").attr("data-count")) + 1;
    }

    $.ajax({
        url: baseURL + "/management-report/company_overview/add-preliminary-page",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count
        },
        success: function(data) {
            $("#management_reports_modal #preliminary-page .pages").append(data.new_page);
            $("#management_reports_modal #preliminary-page .pages .page:last-child textarea").ckeditor();
        },
    });
}
$(document).on("click", "#management_reports_modal #cover-page-section .page-styles-img .cover-style .styles-option-section .style-option", function(event) {
    $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .style-icon").attr("class", "style-icon icon-" + $(this).attr("data-count"));
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
            $("#management_reports_modal #cover-page-section .page-styles-img .cover-style .style-icon").attr("class", "style-icon icon-" + data.cover_style);
            $('#management_reports_modal input[name="template_name"]').val(data.template_name);
            $('#management_reports_modal input[name="cover_page_cover_title"]').val(data.cover_title);
            $('#management_reports_modal input[name="cover_page_subtitle"]').val(data.cover_subtitle);
            $('#management_reports_modal input[name="cover_page_report_period"]').val(data.cover_report_period);
            $('#management_reports_modal input[name="cover_page_prepared_by"]').val(data.cover_prepared_by);
            $('#management_reports_modal input[name="cover_page_prepared_date"]').val(data.cover_prepared_date);
            $('#management_reports_modal input[name="cover_page_disclaimer"]').val(data.cover_disclaimer);
            $('#management_reports_modal input[name="include_table_of_contents"]').val(data.table_include_table_of_contents);
            $('#management_reports_modal input[name="cover_page_disclaimer"]').val(data.cover_disclaimer);
            $('#management_reports_modal input[name="table_of_contents_page_title"]').val(data.table_page_title);
            $('#management_reports_modal input[name="end_notes_page_title"]').val(data.endnote_page_title);
            $('#management_reports_modal input[name="end_notes_page_content"]').val(data.endnote_page_content);

            console.log(data.cover_show_logo);
            if (data.cover_show_logo == "0") {
                $('#management_reports_modal input[name="show-logo"]').prop("checked", false);
            } else {
                $('#management_reports_modal input[name="show-logo"]').prop("checked", true);
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
        },
    });
});