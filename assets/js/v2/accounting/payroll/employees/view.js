const currUrl = window.location.href;
const urlSplit = currUrl.includes("?")
    ? currUrl.split("?")[0].split("/")
    : currUrl.split("/");
const employeeId = urlSplit[urlSplit.length - 1].replace("#", "");

CKEDITOR.replace("notes");

$(function () {
    $(".date").each(function () {
        if (
            $(this).attr("id") === "next-payday" ||
            $(this).attr("id") === "next-pay-period-end"
        ) {
            $(this).datepicker({
                startDate: new Date(),
                format: "mm/dd/yyyy",
                orientation: "bottom",
                autoclose: true,
            });
        } else {
            $(this).datepicker({
                format: "mm/dd/yyyy",
                orientation: "bottom",
                autoclose: true,
            });
        }
    });
});

$("#table-filters").on("click", function (e) {
    e.stopPropagation();
});

$("#filter-date").select2({
    minimumResultsForSearch: -1,
});

$("#edit-employment-details-modal select").select2({
    minimumResultsForSearch: -1,
    dropdownParent: $("#edit-employment-details-modal"),
});

$("#edit-payment-method-modal select").select2({
    minimumResultsForSearch: -1,
    dropdownParent: $("#edit-payment-method-modal"),
});

$("#edit-pay-types-modal select").select2({
    minimumResultsForSearch: -1,
    dropdownParent: $("#edit-pay-types-modal"),
});

$("#edit_employee_modal select").select2({
    minimumResultsForSearch: -1,
    dropdownParent: $("#edit_employee_modal"),
});

$("#work-location")
    .select2({ dropdownParent: $(".work-location-grp") })
    .on("select2:open", function () {
        var a = $(this).data("select2");
        if (!$(".select2-link").length) {
            a.$results
                .parents(".select2-results")
                .append(
                    '<div class="select2-link"><a href="javascript:void(0);">+ Add New</a></div>'
                )
                .on("click", function (b) {
                    $("#edit-employment-details-modal").modal("hide");
                    $("#add-worksite-modal").modal("show");
                });
        }
    });

$("#work-location").on("change", function () {
    if ($(this).val() === "add") {
        $("#edit-employment-details-modal").modal("hide");
        $("#add-worksite-modal").modal("show");
    }
});

$("#add-worksite-form").on("submit", function (e) {
    e.preventDefault();

    var data = new FormData(this);

    $.ajax({
        url: base_url + "/accounting/employees/add-work-location",
        data: data,
        type: "post",
        processData: false,
        contentType: false,
        success: function (res) {
            var result = JSON.parse(res);

            $(
                "#edit-employment-details-modal #work-location option:selected"
            ).removeAttr("selected");
            $("#edit-employment-details-modal #work-location").append(
                `<option value="${result.id}" selected>${result.name}</option>`
            );
            $("#edit-employment-details-modal #work-location").trigger("change");

            $("#add-worksite-modal").modal("hide");
            $("#edit-employment-details-modal").modal("show");
        },
    });
});

$(".edit-emp-payscale").change(function () {
    var psid = $(this).val();
    var url = base_url + "payscale/_get_details";
    $.ajax({
        type: "POST",
        url: url,
        data: { psid: psid },
        dataType: "json",
        success: function (result) {
            if (result.pay_type == "Commission Only") {
                $(".edit-pay-type-container").hide();
            } else {
                var rate_label = result.pay_type + " Rate";
                $(".edit-pay-type-container").show();
                $(".edit-payscale-pay-type").html(rate_label);
            }
        },
    });
});

$(document).on("click", ".update_deductions_contributions", function (e) {
    e.preventDefault();

    var id = $(this).attr("data-val");

    $.ajax({
        url: base_url + "/accounting/employees/edit-deductions-and-contributions",
        data: { id: id },
        type: "post",
        dataType: "json",
        success: function (res) {
            if (res) {
                $("#update-deductions-and-contributions").modal("show");
                $("#deduction_contributions_lists").modal("hide");
                res.forEach(function (item, index) {
                    // Process each item here
                    // console.log("Index: " + index + ", Item: ", item);
                    $(".update_deduction_id").val(item.id);

                    handleDeductionContributionTypeMain(item.deduction_contribution_type);
                    $(".update_deduction_type").val(item.type);

                    $(".update_deduction_description").val(item.description);
                    $(".update_deductions_calculated_as").val(
                        item.deductions_calculated_as
                    );
                    $(".update_deductions_amount").val(
                        parseFloat(item.deductions_amount).toFixed(2)
                    );
                    $(".update_annual_maximum").val(
                        parseFloat(item.annual_maximum).toFixed(2)
                    );

                    $(".update_contribution_annual_maximum").val(
                        parseFloat(item.contribution_annual_maximum).toFixed(2)
                    );

                    $(".update_calculated_contribution_amount").val(
                        parseFloat(item.calculated_contribution_amount).toFixed(2)
                    );

                    $(".update_contribution_calculated_as").val(
                        item.contribution_calculated_as
                    );

                    $(".update_contribution_calculated_as2").val(
                        item.contribution_calculated_as
                    );

                    $(".update_contributions_amount").val(
                        parseFloat(item.contributions_amount).toFixed(2)
                    );

                    $(".update_tax_option").filter(`[value="${item.tax_options}"]`).prop('checked', true);
                    handleCalculatedContribution(item.contribution_calculated_as)
                    handleEmployeeDeductionfield(item.deductions_calculated_as)
                    handleDeductionContributionType(item.type);
                });


            }
        },
    });
});

function hide401contributions() {
    $(".401_contribution_section").hide();
}

function show401contributions() {
    $(".401_contribution_section").show();
}

function showCompanyContributionSection() {
    $(".company-contribution-section").show();
}

function hideCompanyContributionSection() {
    $(".company-contribution-section").hide();
}


function showEmployeeDeductionSection() {
    $(".employee-deductions-section").show();
}

function hideEmployeeDeductionSection() {
    $(".deduction-type-section").hide();
}

function showCalculatedAsLabel() {
    $(".calculated_as_label").show();
}

function hideCalculatedAsLabel() {
    $(".calculated_as_label").hide();
}

function hideTypeOption() {
    $(".tax-option-section").hide();
}
function showTypeOption() {
    $(".tax-option-section").show();
}

function handleHealthInsuranceField() {
    hide401contributions();
    showTypeOption();
}

function handleOtherDeductionsFields() {
    hide401contributions();
    hideCompanyContributionSection();
}

function handleDeductionContributionType(type) {
    $(".deduction-type-section").show();
    showEmployeeDeductionSection();
    showCompanyContributionSection();
    hideCalculatedAsLabel();
    hideTypeOption();
    switch (type) {
        case "Vision Insurance":
            handleHealthInsuranceField();
            break;
        case "Medical Insurance":
            handleHealthInsuranceField();
            break;
        case "Dental Insurance":
            handleHealthInsuranceField();
            break;
        case "Cash Advance Repayment":
            handleOtherDeductionsFields();
            break;
        case "Loan Repayment":
            handleOtherDeductionsFields();
            break;
        case "Other after tax deductions":
            handleOtherDeductionsFields();
            showCalculatedAsLabel();
            break;
        case "Wage Garnishment":
            handleOtherDeductionsFields();
            break;
        case "Pretax HSA":
            hide401contributions();
            hideCompanyContributionSection();
            break;
        case "Taxable HSA":
            hide401contributions();
            hideCompanyContributionSection();
            break;
        case "Dependent Care FSA":
            hide401contributions();
            hideCompanyContributionSection();
            break;
        case "Medical Expense FSA":
            hide401contributions();
            hideCompanyContributionSection();
            break;
        case "401(k)":
            show401contributions();
            break;
        case "401(k) Catch-up":
            show401contributions();
            break;
        case "403(b)":
            hide401contributions();
            break;
        case "403(b) Catch-up":
            hide401contributions();
            break;
        case "After-tax Roth 401(k)":
            show401contributions();
            break;
        case "After-tax Roth 401(k) Catch-up":
            show401contributions();
            break;
        case "After-tax Roth 403(b)":
            hide401contributions();
            break;
        case "Company-only plan":
            $(".employee-deductions-section").hide();
            $('input[name="deductions_amount"]').removeAttr("required");
            hide401contributions();
            break;
        case "SARSEP":
            hide401contributions();
            break;
        case "SARSEP Catch-up":
            hide401contributions();
            break;
        case "SIMPLE 401(k) Catch-up":
            hide401contributions();
            break;
        case "SIMPLE IRA":
            break;
        case "SIMPLE IRA Catch-up":
            show401contributions();
            break;

        default:
            hideEmployeeDeductionSection();
            break;
    }
}

$(".edit-deductions-and-contributions-name").change(function () {
    var type = $(this).val();

    if (type == "") {
        $(".deductions-contribution-section").hide();
    } else {
        $(".deductions-contribution-section").show();
    }
});

function handleHSAplans(type) {
    $(".deduction-type-section").hide();
    $(".edit_deduction_contribution_type").html(`
         <option value="">Select one</option>
        <option value="Pretax HSA">Pretax HSA</option>
        <option value="Taxable HSA">Taxable HSA</option>`);

    $(".update_deduction_contribution_type").val(type);
}

function handleOtherDeductions(type) {
    $(".deduction-type-section").hide();
    $(".edit_deduction_contribution_type").html(`
         <option value="">Select one</option>
        <option value="Cash Advance Repayment">Cash Advance Repayment</option>
        <option value="Loan Repayment">Loan Repayment</option>
        <option value="Other after tax deductions">Other after tax deductions</option>
        <option value="Wage Garnishment">Wage Garnishment</option>`);

    $(".update_deduction_contribution_type").val(type);
}

function handleHealthInsurance(type) {
    $(".deduction-type-section").hide();
    $(".edit_deduction_contribution_type").html(`
         <option value="">Select one</option>
        <option value="Dental Insurance">Dental Insurance</option>
        <option value="Medical Insurance">Medical Insurance</option>
        <option value="Vision Insurance">Vision Insurance</option>
        `);

    $(".update_deduction_contribution_type").val(type);
}

function handleFlexibleSpendingAccounts(type) {
    $(".deduction-type-section").hide();
    $(".edit_deduction_contribution_type").html(`
         <option value="">Select one</option>
        <option value="Dependent Care FSA">Dependent Care FSA</option>
        <option value="Medical Expense FSA">Medical Expense FSA</option>`);

    $(".update_deduction_contribution_type").val(type);
}

function handleRetirementPlan(type) {
    $(".deduction-type-section").hide();
    $(".edit_deduction_contribution_type").html(`
        <option value="">Select one</option>
        <option value="401(k)">401(k)</option>
        <option value="401(k) Catch-up">401(k) Catch-up</option>
        <option value="403(b)">403(b)</option>
        <option value="403(b) Catch-up">403(b) Catch-up</option>
        <option value="After-tax Roth 401(k)">After-tax Roth 401(k)</option>
        <option value="After-tax Roth 401(k) Catch-up">After-tax Roth 401(k)
            Catch-up
        </option>
        <option value="After-tax Roth 403(b)">After-tax Roth 403(b)</option>
        <option value="Company-only plan">Company-only plan</option>
        <option value="SARSEP">SARSEP</option>
        <option value="SARSEP Catch-up">SARSEP Catch-up</option>
        <option value="SIMPLE 401(k) Catch-up">SIMPLE 401(k) Catch-up</option>
        <option value="SIMPLE IRA">SIMPLE IRA</option>
        <option value="SIMPLE IRA Catch-up">SIMPLE IRA Catch-up</option>
       `);
    $(".update_deduction_contribution_type").val(type);
}
$(".contribution_calculated_as").change(function () {
    var val = $(this).val();
    handleEmployeeDeductionfield(val)
});

function handleEmployeeDeductionfield(val) {
    switch (val) {
        case "Flat amount":
            $(".calculated_label").html("Amount per paycheck *");
            $('.employee_deductions_amount').removeAttr('disabled')
            $('.employee_annual_maximum').removeAttr('disabled')

            break;
        case "Percent of gross pay":
            $(".calculated_label").html("Percent per paycheck *");
            $('.employee_deductions_amount').removeAttr('disabled')
            $('.employee_annual_maximum').removeAttr('disabled')

            break;
        case "Per hour worked":
            $(".calculated_label").html("Amount per hour worked *");
            $('.employee_deductions_amount').removeAttr('disabled')
            $('.employee_annual_maximum').removeAttr('disabled')

            break;
        default:
            $(".calculated_label").html("Amount per paycheck *");
            $('.employee_deductions_amount').attr('disabled', 'disabled');
            $('.employee_annual_maximum').attr('disabled', 'disabled');
            $('.employee_deductions_amount').val(0)
            $('.employee_annual_maximum').val(0)

            break;
    }
}

function handleCalculatedContribution(val) {
    switch (val) {
        case "Flat amount":
            $(".calculated_label2").html("Amount per paycheck *");
            $('.update_calculated_contribution_amount').removeAttr('disabled')
            $('.update_contribution_annual_maximum').removeAttr('disabled')
            break;
        case "Percent of gross pay":
            $(".calculated_label2").html("Percent per paycheck *");
            $('.update_calculated_contribution_amount').removeAttr('disabled')
            $('.update_contribution_annual_maximum').removeAttr('disabled')
            break;
        case "Per hour worked":
            $(".calculated_label2").html("Amount per hour worked *");
            $('.update_calculated_contribution_amount').removeAttr('disabled')
            $('.update_contribution_annual_maximum').removeAttr('disabled')
            break;
        default:
            $(".calculated_label2").html("Amount per paycheck *");
            $('.update_calculated_contribution_amount').attr('disabled', 'disabled');
            $('.update_calculated_contribution_amount').val(0)
            $('.update_contribution_annual_maximum').attr('disabled', 'disabled');
            $('.update_contribution_annual_maximum').val(0)

            break;
    }
}

$(".contribution_calculated_as2").change(function () {
    var val = $(this).val();

    $('.add_contribution_calculated_as').val(val)
    handleCalculatedContribution(val)

});



$(".update_calculated_contribution_amount").change(function () {
    var val = $(this).val();
    $('.add_calculated_contribution_amount').val(val)

});

function handleHideResetFields() {
    $(".edit-deduction-contribution-type-section").hide();
    $(".deduction-type-section").hide();
    $(".deductions-contribution-section-add").hide();
    handleCalculatedContribution('')
    handleEmployeeDeductionfield('')
}

function handleDeductionContributionTypeMain(type) {
    switch (type) {
        case "Retirement plans":
            $(".edit-deduction-contribution-type-section").show();
            handleRetirementPlan(type);
            break;
        case "Flexible spending accounts":
            $(".edit-deduction-contribution-type-section").show();
            handleFlexibleSpendingAccounts(type);
            break;
        case "HSA plans":
            $(".edit-deduction-contribution-type-section").show();
            handleHSAplans(type);
            break;
        case "Other deductions":
            $(".edit-deduction-contribution-type-section").show();
            handleOtherDeductions(type);
            break;
        case "Health insurance":
            $(".edit-deduction-contribution-type-section").show();
            handleHealthInsurance(type);

            break;
        default:
            hideTypeOption();
            $(".edit-deduction-contribution-type-section").hide();
            break;
    }
}

$(".deduction_contribution_type").change(function () {
    var type = $(this).val();
    handleDeductionContributionTypeMain(type);
});

$(".edit_deduction_contribution_type").change(function () {
    var type = $(this).val();

    handleDeductionContributionType(type);
});

$("#deductions_contributions_form").on("submit", function (e) {
    e.preventDefault();

    var data = new FormData(this);
    $(".btn_modal_save_deductions").html(
        `<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving...`
    );

    $.ajax({
        url: base_url + "/accounting/employees/add-deductions-and-contributions",
        data: data,
        type: "post",
        processData: false,
        contentType: false,
        success: function (res) {
            $(".btn_modal_save_deductions").html("Save");
            $("#edit-deductions-and-contributions").modal("hide");
            handleHideResetFields();
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Deductions and Contributions Successfully Saved!",
            }).then((result) => {
                $("#deductions_contributions_form")[0].reset();
                $("#deduction_contributions_lists").modal("show");
                var data = JSON.parse(res);
                get_deductions_and_contributions_item(parseInt(data.employee_id, 10));
            });
        },
    });
});

$(document).on("click", ".delete-deductions-and-contributions", function (e) {
    e.preventDefault();

    var id = $(this).attr("data-val");
    var employee_id = $(this).attr("data-employee_id");

    Swal.fire({
        icon: "warning",
        title: "Confirmation",
        text: "Are you sure you want to delete this item?",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:
                    base_url +
                    "/accounting/employees/delete-deductions-and-contributions",
                data: { id: id },
                type: "post",
                dataType: "json",
                success: function (res) {
                    get_deductions_and_contributions_item(parseInt(employee_id, 10));
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Deductions and Contributions Successfully Deleted!",
                    });
                },
            });
        }
    });
});

$("#update_deductions_contributions_form").on("submit", function (e) {
    e.preventDefault();

    var data = new FormData(this);
    $(".btn_modal_save_deductions").html(
        `<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving...`
    );

    $.ajax({
        url: base_url + "/accounting/employees/update-deductions-and-contributions",
        data: data,
        type: "post",
        processData: false,
        contentType: false,
        success: function (res) {
            $(".btn_modal_save_deductions").html("Save");
            $("#edit-deductions-and-contributions").modal("hide");
            var result = JSON.parse(res);
            get_deductions_and_contributions_item(parseInt(result.employee_id, 10));
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Deductions and Contributions Successfully Updated!",
            }).then(() => {
                $("#edit-deductions-and-contributions").find("form").trigger("reset");
                $("#deductions_contributions_form")[0].reset();
                $("#update-deductions-and-contributions").modal("hide");
                $("#deduction_contributions_lists").modal("show");
                handleHideResetFields();
            });
        },
    });
});

function get_deductions_and_contributions_item(employee_id) {
    $.ajax({
        url: base_url + "/accounting/employees/get-deductions-and-contributions",
        data: { employee_id: employee_id },
        type: "post",
        dataType: "json",
        success: function (res) {
            $(".deductions_contributions_list_items").html("");
            $(".deductions_contributions_list_data").html("");
            res.forEach(function (item, index) {
                $(".deductions_contributions_list_items").append(`
                  <div class="col-md-12 mb-3">
                    <div class="row" style="align-items:center">
                        <div class="col-md-9">
                            <p class="text_value">
                                ${item.deduction_contribution_type
                    } - ${item.type}</p>
                            <strong class="text-muted">${item.description
                    }</strong>
                            <p class="text_value">
                                Deduction: $${parseFloat(
                        item.deductions_amount
                    ).toFixed(2)}/paycheck ,
                                outside contribution: $${parseFloat(
                        item.contributions_amount
                    ).toFixed(2)},
                                annual maximum: $${parseFloat(
                        item.annual_maximum
                    ).toFixed(2)}
                            </p>
                        </div>
                        <div class="col-md-3">

                            <a class="nsm-button border-0  pointerCursor update_deductions_contributions"
                                style="font-size: 20px" data-val="${item.id}"><i
                                    class="bx bx-fw bx-pencil"></i></a>

                            <a class="nsm-button border-0  pointerCursor delete-deductions-and-contributions"
                                style="font-size: 20px" data-val="${item.id
                    }" data-employee_id="${item.employee_id}"><i class="bx bx-fw bx-trash"></i></a>
                        </div>
                    </div>
                 </div>
                `);

                $(".deductions_contributions_list_data").append(`
                    <div class="col-md-4">
                        <strong class="text-muted">${item.type
                    }-${item.description}</strong>
                        <p class="text_value">
                            $${parseFloat(item.deductions_amount).toFixed(
                        2
                    )}/paycheck(Deduction)</p>
                    </div>
            `);

            });
        },
    });
}

$(document).on("click", ".btn-edit-add-new-commision", function (e) {
    let url = base_url + "user/_add_commission_form";
    $.ajax({
        type: "POST",
        url: url,
        success: function (o) {
            $("#edit-commission-settings tbody")
                .append(o)
                .children(":last")
                .hide()
                .fadeIn(400);
            $("#edit-commission-settings tbody tr:last-child select").each(
                function () {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $("#edit-pay-types-modal"),
                    });
                }
            );
        },
    });
});

$(document).on("click", ".update-deductions-and-contributions-close", function (e) {
    $("#edit-deductions-and-contributions").find("form").trigger("reset");
    $("#deductions_contributions_form")[0].reset();
    $("#update-deductions-and-contributions").modal("hide");
    $("#deduction_contributions_lists").modal("show");
    handleHideResetFields();
}
);

$(document).on("click", ".add-deduction-and-contributions-modal", function (e) {
    $("#edit-deductions-and-contributions").modal("show");
    $("#deduction_contributions_lists").modal("hide");
});

$(document).on(
    "click",
    ".edit-deductions-contributions-close-modal",
    function (e) {
        $("#edit-deductions-and-contributions").modal("hide");
        $("#deduction_contributions_lists").modal("show");
    }
);

$(document).on("click", ".btn-delete-commission-setting-row", function (e) {
    var tableRow = $(this).closest("tr");
    tableRow.find("td").fadeOut("fast", function () {
        tableRow.remove();
    });
});

$("#user-profile-photo").on("change", function () {
    var data = new FormData();

    data.append("userfile", $(this)[0].files[0]);

    $.ajax({
        url: `/accounting/employees/update-profile-photo/${employeeId}`,
        data: data,
        type: "post",
        processData: false,
        contentType: false,
        success: function (result) {
            var res = JSON.parse(result);

            Swal.fire({
                title: res.success ? "Success" : "Error",
                html: res.message,
                icon: res.success ? "success" : "error",
                showCloseButton: false,
                showCancelButton: false,
                confirmButtonColor: "#2ca01c",
                confirmButtonText: "Okay",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        },
    });
});

$("#remove-photo").on("click", function () {
    Swal.fire({
        title: "Are you sure you want remove the profile photo?",
        icon: "warning",
        showCloseButton: false,
        confirmButtonColor: "#2ca01c",
        confirmButtonText: "Yes",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: "#d33",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/accounting/employees/remove-profile-photo/${employeeId}`,
                type: "DELETE",
                success: function (res) {
                    var result = JSON.parse(res);

                    Swal.fire({
                        title: result.success ? "Success" : "Error",
                        html: result.message,
                        icon: result.success ? "success" : "error",
                        showCloseButton: false,
                        showCancelButton: false,
                        confirmButtonColor: "#2ca01c",
                        confirmButtonText: "Done",
                    }).then((r) => {
                        if (r.isConfirmed) {
                            location.reload();
                        }
                    });
                },
            });
        }
    });
});

$("#filter-date-range").select2({
    minimumResultsForSearch: -1,
});

$("#filter-date-range").on("change", function (e) {
    var dates = get_start_and_end_dates($(this).val());

    $("#filter-from-date").val(dates.start_date);
    $("#filter-to-date").val(dates.end_date);
});

$("#filter-from-date, #filter-to-date").on("change", function (e) {
    $("#filter-date-range").val("custom").trigger("change");
});

$("#apply-button").on("click", function (e) {
    e.preventDefault();

    var filterDate = $("#filter-date-range").val();
    var url = `${base_url}accounting/employees/view/${employeeId}?`;

    url += filterDate !== "this-quarter" ? `date=${filterDate}&` : "";
    url +=
        filterDate !== "this-quarter"
            ? `from=${$("#filter-from-date").val().replaceAll("/", "-")}&to=${$(
                "#filter-to-date"
            )
                .val()
                .replaceAll("/", "-")}`
            : "";

    if (url.slice(-1) === "?" || url.slice(-1) === "&" || url.slice(-1) === "#") {
        url = url.slice(0, -1);
    }

    location.href = url;
});

$("#transactions-table .select-all").on("change", function () {
    $("#transactions-table .select-one")
        .prop("checked", $(this).prop("checked"))
        .trigger("change");
});

$("#transactions-table .select-one").on("change", function () {
    $("#transactions-table .select-all").prop(
        "checked",
        $("#transactions-table .select-one:checked").length ===
        $("#transactions-table .select-one").length
    );

    if ($("#transactions-table .select-one:checked").length > 0) {
        $(".print-paychecks-button").attr("id", "print-paychecks");
        $(".print-paychecks-button").prop("disabled", false);
    } else {
        $(".print-paychecks-button").removeAttr("id");
        $(".print-paychecks-button").prop("disabled", true);
    }
});

$(document).on("click", "#print-paychecks", function (e) {
    e.preventDefault();

    if ($("#print-paycheck-form").length < 1) {
        let url = base_url + "accounting/print-multiple";
        $("body").append(
            `<form action="${url}" method="post" id="print-paycheck-form" target="_blank"></form>`
        );
    }

    $("#transactions-table .select-one:checked").each(function () {
        var row = $(this).closest("tr");
        var id = row.find(".select-one").val();

        $("#print-paycheck-form").append(
            `<input type="hidden" name="paycheck_id[]" value="${id}">`
        );
    });

    $("#print-paycheck-form").submit();
    $("#print-paycheck-form").remove();
});

$('#transactions-table [name="check_number[]"]').on("change", function () {
    var checkNum = $(this).val();
    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();

    var data = new FormData();
    data.set("check_number", checkNum);

    $.ajax({
        url: `/accounting/update-paycheck-num/${id}`,
        data: data,
        type: "post",
        processData: false,
        contentType: false,
        success: function (res) { },
    });
});

$("#transactions-table .print-paycheck").on("click", function (e) {
    e.preventDefault();

    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();

    if ($("#print-paycheck-form").length < 1) {
        $("body").append(
            `<form action="/accounting/print-paycheck" method="post" id="print-paycheck-form" target="_blank"></form>`
        );
    }

    $("#print-paycheck-form").append(
        `<input type="hidden" name="paycheck_id" value="${id}">`
    );

    $("#print-paycheck-form").submit();
    $("#print-paycheck-form").remove();
});

$("#transactions-table .delete-paycheck").on("click", function (e) {
    e.preventDefault();

    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();

    Swal.fire({
        title: 'Delete Paycheck',
        html: `Are you sure you want to delete selected paycheck? <br/><br/>Note : This cannot be undone.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: base_url + 'accounting/delete-paycheck/' + id,
                dataType:'json',
                success: function(result) {
                    if( result.success ) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Delete Paycheck',
                        text: 'Paycheck was successfully deleted.',
                        }).then((result) => {
                            location.reload();                            
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something is wrong in the process.',
                        });
                    }
                }
            });
        }
    });
});

$("#transactions-table .void-paycheck").on("click", function (e) {
    e.preventDefault();

    var row = $(this).closest("tr");
    var id = row.find(".select-one").val();

    Swal.fire({
        title: 'Void Paycheck',
        html: `Are you sure you want to void selected paycheck? <br/><br/>Note : This cannot be undone.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: base_url + 'accounting/void-paycheck/' + id,
                dataType:'json',
                success: function(result) {
                    if( result.success ) {
                        Swal.fire({
                        icon: 'success',
                        title: 'Void Paycheck',
                        text: 'Paycheck was successfully voided.',
                        }).then((result) => {
                            location.reload();                            
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something is wrong in the process.',
                        });
                    }
                }
            });
        }
    });
});

function get_start_and_end_dates(val) {
    switch (val) {
        case "custom":
            startDate = $(`#filter-from-date`).val();
            endDate = $(`#filter-to-date`).val();
            break;
        case "this-month":
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

            startDate =
                String(date.getMonth() + 1).padStart(2, "0") +
                "/" +
                String(1).padStart(2, "0") +
                "/" +
                date.getFullYear();
            endDate =
                String(to_date.getMonth() + 1).padStart(2, "0") +
                "/" +
                String(to_date.getDate()).padStart(2, "0") +
                "/" +
                to_date.getFullYear();
            break;
        case "this-quarter":
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);

            switch (currQuarter) {
                case 1:
                    startDate = "01/01/" + date.getFullYear();
                    endDate = "03/31/" + date.getFullYear();
                    break;
                case 2:
                    startDate = "04/01/" + date.getFullYear();
                    endDate = "06/30/" + date.getFullYear();
                    break;
                case 3:
                    startDate = "07/01/" + date.getFullYear();
                    endDate = "09/30/" + date.getFullYear();
                    break;
                case 4:
                    startDate = "10/01/" + date.getFullYear();
                    endDate = "12/31/" + date.getFullYear();
                    break;
            }
            break;
        case "this-year":
            var date = new Date();

            startDate =
                String(1).padStart(2, "0") +
                "/" +
                String(1).padStart(2, "0") +
                "/" +
                date.getFullYear();
            endDate =
                String(12).padStart(2, "0") +
                "/" +
                String(31).padStart(2, "0") +
                "/" +
                date.getFullYear();
            break;
        case "last-month":
            var date = new Date();
            var to_date = new Date(date.getFullYear(), date.getMonth(), 0);

            startDate =
                String(date.getMonth()).padStart(2, "0") +
                "/" +
                String(1).padStart(2, "0") +
                "/" +
                date.getFullYear();
            endDate =
                String(to_date.getMonth() + 1).padStart(2, "0") +
                "/" +
                String(to_date.getDate()).padStart(2, "0") +
                "/" +
                to_date.getFullYear();
            break;
        case "last-quarter":
            var date = new Date();
            var currQuarter = Math.floor(date.getMonth() / 3 + 1);

            switch (currQuarter) {
                case 1:
                    var from_date = new Date("01/01/" + date.getFullYear());
                    var to_date = new Date("03/31/" + date.getFullYear());
                    break;
                case 2:
                    var from_date = new Date("04/01/" + date.getFullYear());
                    var to_date = new Date("06/30/" + date.getFullYear());
                    break;
                case 3:
                    var from_date = new Date("07/01/" + date.getFullYear());
                    var to_date = new Date("09/30/" + date.getFullYear());
                    break;
                case 4:
                    var from_date = new Date("10/01/" + date.getFullYear());
                    var to_date = new Date("12/31/" + date.getFullYear());
                    break;
            }

            from_date.setMonth(from_date.getMonth() - 3);
            to_date.setMonth(to_date.getMonth() - 3);

            if (to_date.getDate() === 1) {
                to_date.setDate(to_date.getDate() - 1);
            }

            startDate =
                String(from_date.getMonth() + 1).padStart(2, "0") +
                "/" +
                String(from_date.getDate()).padStart(2, "0") +
                "/" +
                from_date.getFullYear();
            endDate =
                String(to_date.getMonth() + 1).padStart(2, "0") +
                "/" +
                String(to_date.getDate()).padStart(2, "0") +
                "/" +
                to_date.getFullYear();
            break;
        case "last-year":
            var date = new Date();
            date.setFullYear(date.getFullYear() - 1);

            startDate =
                String(1).padStart(2, "0") +
                "/" +
                String(1).padStart(2, "0") +
                "/" +
                date.getFullYear();
            endDate =
                String(12).padStart(2, "0") +
                "/" +
                String(31).padStart(2, "0") +
                "/" +
                date.getFullYear();
            break;
        case "first-quarter":
            var date = new Date();

            startDate = "01/01/" + date.getFullYear();
            endDate = "03/31/" + date.getFullYear();
            break;
        case "second-quarter":
            var date = new Date();

            startDate = "04/01/" + date.getFullYear();
            endDate = "06/30/" + date.getFullYear();
            break;
        case "third-quarter":
            var date = new Date();

            startDate = "07/01/" + date.getFullYear();
            endDate = "09/30/" + date.getFullYear();
            break;
        case "fourth-quarter":
            var date = new Date();

            startDate = "10/01/" + date.getFullYear();
            endDate = "12/31/" + date.getFullYear();
            break;
    }

    return {
        start_date: startDate,
        end_date: endDate,
    };
}

function addLocationForm() {
    $("#edit-employment-details-modal").modal("hide");
    $("#add-worksite-modal").modal("show");
}
