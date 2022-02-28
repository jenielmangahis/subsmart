$(document).on("click", "#import-customer", function(event) {
    $("#import-customers-modal").fadeIn();
});
$(document).on("click", "#import-customers-modal .close-modal", function(event) {
    $("#import-customers-modal").fadeOut();
});

$(document).ready(function() {

    var checkDropzone = new Dropzone('div#import_customer', {
        url: baseURL + "accounting/import_customers",
        autoProcessQueue: false,
        uploadMultiple: false,
        maxFilesize: 128,
        addRemoveLinks: true,
        acceptedFiles: ".xlsx, .xls, .csv",
        init: function() {
            var submitButton = document.querySelector("#submit-imported-customer-file");
            myDropzone = this;
            submitButton.addEventListener("click", function() {
                if ($("#import-customers-modal .dz-error-message span").html() == "") {
                    $("#loader-modal").show();
                    myDropzone.processQueue();
                }
            });
            this.on("complete", function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0 && $("#import-customers-modal .dz-error-message span").html() == "") {
                    var file_elem = this;
                    $.ajax({
                        url: baseURL + "accounting/imported_customer_title_covert_to_json",
                        type: "POST",
                        dataType: "json",
                        data: { filename: file_elem.files[0]["upload"]["filename"] },
                        success: function(data) {
                            var html_temp = "";
                            var html_temp2 = "";

                            for (let index = 0; index < data.titles.length; index++) {
                                html_temp += `
                                <div class="col-md-6">
                                    <div class="checkbox checkbox-sec margin-right ">
                                        <input type="checkbox" name="temp` + index + `" value="` + index + `" id="temp` + index + `" checked="">
                                        <label for="temp` + index + `">
                                            <span>` + data.titles[index] + `</span>
                                        </label>
                                    </div>
                                </div>`;
                            }
                            for (let index = 0; index < data.table_column_names.length; index++) {
                                html_temp2 +=
                            }
                            $("#holder-step-2 .form-check .row").html(html_temp);
                            file_elem.removeFile(file_elem.files[0]);
                            $("#loader-modal").hide();
                            next_step("#holder-step-1 .next-step");
                        },
                    });

                }
            });
            this.on("addedfile", function() {
                $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/excel.png");
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                }
            });


        },
        error(file, message) {
            $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/error.png");
            if (file.previewElement) {
                file.previewElement.classList.add("dz-error");
                if (typeof message !== "string" && message.error) {
                    message = message.error;
                }
                for (let node of file.previewElement.querySelectorAll(
                        "[data-dz-errormessage]"
                    )) {
                    node.textContent = message;
                }
            }
        },


    });



    /* For Progress Bar Javascript*/

    var currentGfgStep, nextGfgStep, previousGfgStep;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $("#holder-step-2 .next-step").click(function() {
        next_step(this);
    });

    function next_step(elem) {
        currentGfgStep = $(elem).parent();
        nextGfgStep = $(elem).parent().next();

        $("#progressbar li").eq($("fieldset")
            .index(nextGfgStep)).addClass("active");

        nextGfgStep.show();

        currentGfgStep.animate({ opacity: 0 }, {
            step: function(now) {
                opacity = 1 - now;


                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                nextGfgStep.css({ 'opacity': opacity });
            },
            duration: 100


        });
        setProgressBar(++current);
    }

    $(".previous-step").click(function() {
        previous_step(this);
    });

    function previous_step(elem) {
        currentGfgStep = $(elem).parent();
        previousGfgStep = $(elem).parent().prev();

        $("#progressbar li").eq($("fieldset")
            .index(currentGfgStep)).removeClass("active");

        previousGfgStep.show();

        currentGfgStep.animate({ opacity: 0 }, {
            step: function(now) {
                opacity = 1 - now;

                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previousGfgStep.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    }

    function setProgressBar(currentStep) {
        var percent = parseFloat(100 / steps) * current;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function() {
        return false;
    })




    /* For Dropzone */


});