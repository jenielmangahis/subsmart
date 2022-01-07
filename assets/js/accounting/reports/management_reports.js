$(document).on("click", function(event) {
    if ($(event.target).closest("#company_overview_modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#company_overview_modal .pint-pries-option-section").hide();
    }
    if ($(event.target).closest("#company_overview_modal #cover-page-section .page-styles-img .logo-style").length === 0) {
        $("#company_overview_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").hide();
    }
    if ($(event.target).closest("#company_overview_modal #cover-page-section .page-styles-img .cover-style").length === 0) {
        $("#company_overview_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").hide();
    }
});

$(document).on('click', 'table#manage_reports_table ul.report_options li.edit', function() {
    $($(this).attr("data-target")).fadeIn();
});
$(document).on('click', 'div#company_overview_modal .the-modal-body .the-header .icons div.close-modal', function() {
    $("#company_overview_modal").fadeOut();
});
$(document).on("click", "#company_overview_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    // $("#company_overview_modal .modal-footer-check .middle-links").hide();
});
$('#company_overview_modal').on('hidden.bs.modal', function() {
    $("#company_overview_modal .modal-footer-check .middle-links").show();
});
$(document).on("click", "#company_overview_modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#company_overview_modal .pint-pries-option-section").show();
});

$(document).on("click", "#company_overview_modal .modal-footer-check button.cancel-button", function(event) {
    event.preventDefault();
    $("#company_overview_modal").fadeOut();
});

$(document).on("click", "#company_overview_modal #cover-page-section .page-styles-img .cover-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#company_overview_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").show();
});
$(document).on("click", "#company_overview_modal #cover-page-section .page-styles-img .logo-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#company_overview_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").show();
});

$(document).on("click", "#company_overview_modal .the-content .report-pages ul li", function(event) {
    $("#" + $("#company_overview_modal .the-content .report-pages ul li.active").attr("data-target")).hide();
    $("#company_overview_modal .the-content .report-pages ul li.active").removeClass("active");
    $("#" + $(this).attr("data-target")).fadeIn();
    $(this).addClass("active");
});

$(document).on("click", "#company_overview_modal #reports .report-section", function(event) {
    console.log($(this).children(".row").children(".col-md-10").children(".content-collapse.hide").length);
    if ($(this).children(".row").children(".col-md-10").children(".content-collapse.hide").length > 0) {
        remove_empty_report();
        close_reports_sections(this);
    }
});

$(document).on("click", "#company_overview_modal #reports .report-section .report-delete-btn", function(event) {
    $(this).parents(".report-section").remove();
});

$(document).on("click", "#company_overview_modal #reports .add-report-btn", function(event) {
    remove_empty_report();
    close_reports_sections(this);
    var data_count = parseInt($("#company_overview_modal #reports .report-section:last-child").attr("data-count")) + 1;;
    $.ajax({
        url: baseURL + "/management-report/company-overview/add-new-report-section",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count
        },
        success: function(data) {
            $("#company_overview_modal #reports .sections").append(data.new_report);
        },
    });
});

function remove_empty_report() {
    if ($('#company_overview_modal #reports .report-section.new_report:last-child select[name="report_type[]"]').val() == "") {
        $('#company_overview_modal #reports .report-section.new_report:last-child').remove();
    }
}

function close_reports_sections(elem) {
    $("#company_overview_modal #reports .report-section .closed-content-view").show();
    $("#company_overview_modal #reports .report-section .content-collapse").hide();
    $("#company_overview_modal #reports .report-section .content-collapse").addClass("hide");
    $("#company_overview_modal #reports .report-section .report-delete-btn").attr("class", "fa fa-pencil report-edit-btn");
    if ($("#company_overview_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse.hide").length > 0) {
        $("#company_overview_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .closed-content-view").hide();
        $("#company_overview_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse").show();
        $("#company_overview_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .content-collapse").removeClass("hide");
        $("#company_overview_modal #reports .report-section .content-collapse").addClass("show");
        $("#company_overview_modal #reports .report-section[data-count='" + $(elem).attr("data-count") + "'] .report-edit-btn").attr("class", "fa fa-trash-o report-delete-btn");
    }
}

$(document).on("change", '#company_overview_modal #reports .report-section.new_report:last-child select[name="report_type[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("input[name='report_title[]']").val($(this).val());
    if ($(this).val() != "") {
        $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html($(this).val());
    } else {
        $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html("New report");
    }

    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("select[name='report_period[]']").val());
});
$(document).on("change", '#company_overview_modal #reports .report-section.new_report:last-child input[name="report_title[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-2").children(".report-title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".title").html($(this).val());
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).parents(".report-section").children(".row").children(".col-md-10").children(".content-collapse").children(".form-group").children("select[name='report_period[]']").val());
});
$(document).on("change", '#company_overview_modal #reports .report-section.new_report:last-child select[name="report_period[]"]', function(event) {
    $(this).parents(".report-section").children(".row").children(".col-md-10").children(".closed-content-view").children(".period").html($(this).val());
});

$(document).on("click", "#company_overview_modal #preliminary-page a.add-new-page", function(event) {
    company_overview_add_preliminary_page();
});

$(document).on("click", "#company_overview_modal #preliminary-page .delete-page-btn", function(event) {
    if ($("#company_overview_modal #preliminary-page .pages .page").length > 1) {
        $(this).parent("div.form-check").parent(".page").remove();
    }
});
company_overview_add_preliminary_page();

function company_overview_add_preliminary_page() {
    var data_count;
    var new_elements;
    if ($("#company_overview_modal #preliminary-page .pages .page:last-child").length > 0) {
        data_count = parseInt($("#company_overview_modal #preliminary-page .pages .page:last-child").attr("data-count")) + 1;
    } else {
        data_count = parseInt($("#company_overview_modal #preliminary-page .pages .page:first-child").attr("data-count")) + 1;
    }

    $.ajax({
        url: baseURL + "/management-report/company_overview/add-preliminary-page",
        type: "POST",
        dataType: "json",
        data: {
            data_count: data_count
        },
        success: function(data) {
            $("#company_overview_modal #preliminary-page .pages").append(data.new_page);
            $("#company_overview_modal #preliminary-page .pages .page:last-child textarea").ckeditor();
        },
    });
}