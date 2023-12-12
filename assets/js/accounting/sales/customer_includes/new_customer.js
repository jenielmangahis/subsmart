$(document).on("click", "#import-customer", function(event) {
    $("#import-customers-modal").fadeIn();
});
$(document).on("click", "#import-customers-modal .close-modal", function(event) {
    $("#import-customers-modal").fadeOut();
});
$(document).on("click", "#import-customers-modal #close", function(event) {
    // get_load_customers_table();
    $("#import-customers-modal").fadeOut();
    location.reload();
});



$(document).ready(function() {

    var counter = 0;

    // DISABLE TEMPORARY TO AVOID JS ERRORS
    // var checkDropzone = new Dropzone('div#import_customer', {
    //     url: baseURL + "accounting/import_customers",
    //     autoProcessQueue: false,
    //     uploadMultiple: false,
    //     maxFilesize: 128,
    //     addRemoveLinks: true,
    //     acceptedFiles: ".xlsx, .xls, .csv",
    //     init: function() {
    //         var submitButton = document.querySelector("#submit-imported-customer-file");
    //         myDropzone = this;
    //         submitButton.addEventListener("click", function() {
    //             if ($("#import-customers-modal .dz-error-message span").html() == "") {
    //                 $("#loader-modal").show();
    //                 myDropzone.processQueue();
    //             }
    //         });
    //         this.on("complete", function() {
    //             if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0 && $("#import-customers-modal .dz-error-message span").html() == "") {
    //                 var file_elem = this;
    //                 $.ajax({
    //                     url: baseURL + "accounting/imported_customer_title_covert_to_json",
    //                     type: "POST",
    //                     dataType: "json",
    //                     data: { filename: file_elem.files[0]["upload"]["filename"] },
    //                     success: function(data) {
    //                         var html_temp = "";
    //                         var html_temp2 = "";
    //                         data.titles.length;
    //                         var html_temp3 = "";

    //                         html_temp3 += `
    //                         <div class="row">
    //                             <div class="col-md-12">
    //                                 <input style="display:none" class="file_name" name="file_name" value="` + data.filename + `">
    //                             </div>
    //                         </div>`;

    //                         for (let index = 0; index < data.titles.length; index++) {
    //                             html_temp2 = "";
    //                             counter++;
    //                             var count = 0;
    //                             var cont;
    //                             html_temp += `
    //                             <div class="row">
    //                             <div class="col-md-6" >
    //                                 <div class="checkbox checkbox-sec margin-right " style="margin-left:60px; margin-top:20px;">
    //                                     <input class="colTable" type="checkbox" name="temp` + index + `" value="` + data.titles[index] + `" id="temp` + index + `" checked="">
    //                                     <label for="temp` + index + `">
    //                                         <span>` + data.titles[index] + `</span>
    //                                     </label>
    //                                 </div>
    //                             </div>
    //                             <div class="col-md-6 align">
    //                                 <select class="selected` + index + `" required>`;
    //                             for (let index1 = 0; index1 < data.table_column_names.length; index1++) {
    //                                 var holder = "";
    //                                 var count;
    //                                 var indexHolder;
    //                                 var selected = "";

    //                                 if ((data.titles[index].split(' ').join('_') == data.table_column_names[index1]) || (data.titles[index].split('-').join('_') == data.table_column_names[index1])) {
    //                                     selected = "selected";
    //                                     cont = count;
    //                                 } else {
    //                                     count++;
    //                                 }

    //                                 if (index1 == data.table_column_names.length - 2) {
    //                                     break;
    //                                 } else {
    //                                     html_temp2 += ` <option value = "` + data.table_column_names[index1] + `"
    //                                                                     ` + selected + `> ` + data.table_column_names[index1] + ` </option>
    //                                                                     `;

    //                                 }


    //                                 if (index1 == data.table_column_names.length - 1) {
    //                                     data.table_column_names[indexHolder] = data.table_column_names[0]
    //                                     data.table_column_names[0] = holder;
    //                                     holder = "";
    //                                     count = 0;
    //                                     indexHolder = 0;
    //                                 }




    //                             }


    //                             html_temp += html_temp2 + `</select> <div class="label"><p class="label` + index + `"></p></div><input style="display:none;" name="column` + index + `" type="text" class="send` + index + `" value="` + data.table_column_names[cont] + `">

    //                             </div>
    //                             </div>
    //                          `;
    //                             $("body").delegate("#holder-step-2 select", "change", function() {
    //                                 var select = $(this).val();
    //                                 var cName = $(this).attr('class');
    //                                 var num = cName.substring(8);
    //                                 var column_N = data.titles[num];
    //                                 var selection = ""

    //                                 for (let index2 = 0; index2 < data.table_column_names.length; index2++) {
    //                                     if ((data.titles[index].split(' ').join('_') == data.table_column_names[index2]) || (data.titles[index].split('-').join('_') == data.table_column_names[index2])) {
    //                                         selection = "selected";

    //                                     }
    //                                 }

    //                                 if (select == "Add Column" && selection == "selected") {
    //                                     column_N += "_1"
    //                                     $("#holder-step-2 .label" + num + "").text(column_N.toLowerCase());
    //                                     $("#holder-step-2 .send" + num + "").val(column_N);


    //                                 } else if (select == "Add Column" && selection == "") {

    //                                     $("#holder-step-2 .label" + num + "").text(column_N);
    //                                     $("#holder-step-2 .send" + num + "").val(column_N);


    //                                 } else if (select != "Add Column") {
    //                                     for (index3 = 1; index3 < data.table_column_names.length; index3++) {
    //                                         if (select != " ") {
    //                                             if (select == data.table_column_names[index3]) {
    //                                                 $("#holder-step-2 .send" + num + "").val(data.table_column_names[index3]);
    //                                             }
    //                                         }
    //                                     }

    //                                 }
    //                             });

    //                         }

    //                         html_temp += html_temp3;
    //                         $("#holder-step-2 .form-check").html(html_temp);

    //                         // $("#holder-step-2 .form-check #t_columns").html(html_temp2);


    //                         file_elem.removeFile(file_elem.files[0]);
    //                         $("#loader-modal").hide();
    //                         next_step("#holder-step-1 .next-step");

    //                     },
    //                 });


    //             }

    //         });
    //         this.on("addedfile", function() {
    //             $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/excel.png");
    //             if (this.files[1] != null) {
    //                 this.removeFile(this.files[0]);
    //             }
    //         });


    //     },
    //     error(file, message) {
    //         $("#import-customers-modal .dz-image img").attr("src", baseURL + "assets/img/accounting/customers/error.png");
    //         if (file.previewElement) {
    //             file.previewElement.classList.add("dz-error");
    //             if (typeof message !== "string" && message.error) {
    //                 message = message.error;
    //             }
    //             for (let node of file.previewElement.querySelectorAll(
    //                     "[data-dz-errormessage]"
    //                 )) {
    //                 node.textContent = message;
    //             }
    //         }
    //     },


    // });


    //get values of hidden input
    var hmtl_in = "";
    $('#holder-step-2 .next-step').click(function() {
        $holder = this;
        var tables = [];
        var selCol = [];
        var filename = ($("input[name=file_name]").val());



        for (index1 = 0; index1 < counter; index1++) { //loop
            if ($("input[name=temp" + index1 + "]").is(":checked") && $("input[name=column" + index1 + "]").val() != "") {
                //modified progress
                selCol.push($("input[name=temp" + index1 + "]").val());
                tables.push($("input[name=column" + index1 + "]").val());
            }




        }
        $.ajax({
            url: baseURL + "accounting/exported_data_from_forms",
            type: "POST",
            dataType: "json",
            data: { tables: tables, filename: filename, selCol: selCol },
            success: function(data) {

            }
        });
        next_step(this);
        //Progress
        console.log(tables);


    });




    // $('#holder-step-3 .next-step').click(function() {
    //     $("#import-customers-modal").fadeOut();
    // });
    //close of the getter

    /*get value of selected option*/

    // $("body").delegate("#holder-step-2 select", "change", function() {

    //     var select = $(this).val();
    //     if (select == "Add Column") {
    //         $("#holder-step-2 .label").text(select);
    //     } else if (select != "Add Column") {
    //         $("#holder-step-2 .label").text(" ");
    //     }
    // });


    /* For Progress Bar Javascript*/

    var currentGfgStep, nextGfgStep, previousGfgStep;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length - 1;
    setProgressBar(current);

    // $(".next-step").click(function() {
    //     next_step(this);
    // });

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