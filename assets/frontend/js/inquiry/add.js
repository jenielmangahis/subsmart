var options = {
    urlGetAll: base_url + 'inquiries/source/json_list',
    urlAdd: base_url + 'inquiries/source/save/json',
    urlServiceAddressForm: base_url + 'inquiries/service_address_form',
    urlSaveServiceAddress: base_url + 'inquiries/save_service_address',
    urlGetServiceAddress: base_url + 'inquiries/json_get_address_services',
    urlRemoveServiceAddress: base_url + 'inquiries/remove_address_services',
    urlAdditionalContactForm: base_url + 'inquiries/additional_contact_form',
    urlSaveAdditionalContact: base_url + 'inquiries/save_additional_contact',
    urlGetAdditionalContacts: base_url + 'inquiries/json_get_additional_contacts',
    urlRemoveAdditionalContact: base_url + 'inquiries/remove_additional_contact',
    urlSaveInquiry: base_url + 'inquiries/save',
};

$(document).ready(function () {

    $(document).on('click', "#modalAddNewSource .save", function (e) {

        e.preventDefault();

        $('#frm_add_new_source').submit();
    });

    $(document).on('submit', '#frm_add_new_source', function (e) {

        e.preventDefault();

        var saveButton = $("#modalAddNewSource .save");
        var saveButtontext = $(saveButton).html();

        $(saveButton).attr('disabled', true);

        jQuery.ajax({
            url: options.urlAdd,
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                $(saveButton).text('saving...');
            },
            success: function (response) {

                console.log(response);

                $("#modalAddNewSource").modal('hide');
            }
        });
    });

    $('#inquiry_source').select2({
        ajax: {
            url: options.urlGetAll,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data,
                    // pagination: {
                    //   more: (params.page * 30) < data.total_count
                    // }
                };
            },
            cache: true
        },
        placeholder: 'Search for a source',
        minimumInputLength: 0,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    }).on('select2:open', function () {
        $(".select2-results:not(:has(a))").append('<a data-toggle="modal" data-target="#modalAddNewSource" href="#" style="padding: 8px; border-top: 1px solid #dcdbdc; width: 100%; display: inline-table;">+ Add new source</a>');
    });


    // open service address form
    $('#modalServiceAddress').on('shown.bs.modal', function (e) {

        var element = $(this);
        $(element).find('.modal-body').html('loading...');

        // console.log($(e.relatedTarget).attr('data-inquiry-id'));

        var service_address_index = $(e.relatedTarget).attr('data-id');
        var inquiry_id = $(e.relatedTarget).attr('data-inquiry-id');

        if (service_address_index && inquiry_id) {

            $.ajax({
                url: options.urlServiceAddressForm,
                type: 'GET',
                data: {index: service_address_index, inquiry_id: inquiry_id},
                success: function (response) {

                    // console.log(response);

                    $(element).find('.modal-body').html(response);
                }
            });
        } else {

            $.ajax({
                url: options.urlServiceAddressForm,
                type: 'GET',
                success: function (response) {

                    // console.log(response);

                    $(element).find('.modal-body').html(response);
                }
            });
        }
    });

    $(document).on('click', '#modalServiceAddress .modal-footer > button:last-child', function (e) {

        e.preventDefault();

        $("#frm_serice_address").submit();

    });

    $(document).on('submit', '#frm_serice_address', function (e) {

        e.preventDefault();

        $.ajax({
            url: options.urlSaveServiceAddress,
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                console.log(response);
                var json = JSON.parse(response);

                if (json.inquiry_id) {
                    get_service_address(json.inquiry_id);
                }

                $("#modalServiceAddress").modal('hide');

                // $(element).find('.modal-body').html(response);
            }
        });
    });

    // remove service address
    $(document).on('click', '.inquiry-address-list__delete', function () {

        if (confirm('Are you sure to delete this item')) {

            var service_address_index = $(this).attr('data-id');
            var inquiry_id = $(this).attr('data-inquiry-id');
            var row = $(this).closest('li.inquiry-address-list__item');

            $(row).css('opacity', .50);
            $(row).find('a').attr('disabled', true);

            $.ajax({
                url: options.urlRemoveServiceAddress,
                type: 'POST',
                data: {index: service_address_index, inquiry_id: inquiry_id},
                success: function (response) {

                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {

                        $(row).remove();
                    } else {

                        alert("Something went wrong!");
                        $(row).css('opacity', 1);
                        $(row).find('a').attr('disabled', false);
                    }

                    // get_service_address();
                }
            });
        }
    });


    // get_service_address();


    /* Contact */

    // open additional contact form
    $('#modalAdditionalContacts').on('shown.bs.modal', function (e) {

        var element = $(this);
        $(element).find('.modal-body').html('loading...');

        var service_address_index = $(e.relatedTarget).attr('data-id');
        var inquiry_id = $(e.relatedTarget).attr('data-inquiry-id');

        console.log(service_address_index, inquiry_id);

        if (service_address_index && inquiry_id) {

            $.ajax({
                url: options.urlAdditionalContactForm,
                type: 'GET',
                data: {index: service_address_index, inquiry_id: inquiry_id, action: 'edit'},
                success: function (response) {

                    // console.log(response);

                    $(element).find('.modal-body').html(response);
                }
            });
        } else {

            $.ajax({
                url: options.urlAdditionalContactForm,
                type: 'GET',
                success: function (response) {

                    $(element).find('.modal-body').html(response);
                }
            });
        }
    });


    $(document).on('click', '#modalAdditionalContacts .modal-footer > button:last-child', function (e) {

        e.preventDefault();

        $("#frm_additional_contact").submit();

    });

    $(document).on('submit', '#frm_additional_contact', function (e) {

        e.preventDefault();

        $.ajax({
            url: options.urlSaveAdditionalContact,
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                console.log(response);
                var json = JSON.parse(response);

                if (json.inquiry_id) {
                    get_additional_contacts(json.inquiry_id);
                }

                $("#modalAdditionalContacts").modal('hide');
            }
        });
    });

    // remove service address
    $(document).on('click', '.inquiry-contact-list__delete', function () {

        if (confirm('Are you sure to delete this item')) {

            var service_address_index = $(this).attr('data-id');
            var inquiry_id = $(this).attr('data-inquiry-id');
            var row = $(this).closest('li.inquiry-contact-list__item');

            $(row).css('opacity', .50);
            $(row).find('a').attr('disabled', true);

            $.ajax({
                url: options.urlRemoveAdditionalContact,
                type: 'POST',
                data: {index: service_address_index, inquiry_id: inquiry_id},
                success: function (response) {

                    console.log(response);

                    var json = JSON.parse(response);

                    if (json.status == 'success') {

                        $(row).remove();
                    } else {

                        alert("Something went wrong!");
                        $(row).css('opacity', 1);
                        $(row).find('a').attr('disabled', false);
                    }
                }
            });
        }
    });

    // get_additional_contacts();


    // save inquiry
    $(document).on('submit', '#inquiry_form', function (e) {

        e.preventDefault();
        var button = $(this).find("button[type='submit']");
        var button_text = $(button).html();
        $(button).text('saving...');
        $(button).attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {

                console.log(response);

                var json = JSON.parse(response);

                if (json.url) {

                    location.href = json.url;
                } else {
                    $(button).text(button_text);
                    $(button).attr('disabled', false);
                }
            }
        });
    });


    toggle_advance_options();


    $('#technician_arrival_time, #technician_departure_time').datetimepicker({
        format: 'LT'
    });


    // remove item from list
    $(document).on("click", ".remove-data-item", function (e) {

        e.preventDefault();

        var button = $(this);
        var row = $(this).parent().parent();

        if (confirm("Do you really want to delete this item ?")) {

            $(button).attr('disabled', true);
            $(row).css({'opacity': '.50'});

            jQuery.ajax({
                url: $(this).attr('href'),
                type: 'DELETE',
                success: function (response) {

                    console.log(response);
                    $(row).remove();
                },
                error: function (err) {

                    $(button).attr('disabled', false);
                    $(row).css({'opacity': '1'});
                }
            });
        }
    });
});


function toggle_advance_options() {

    //
    if (!$("#company_div").is('hidden')) {

        $("#company_div, #company_div span").each(function (index, element) {

            $(element).attr('disabled', false);
        });
        
    }

    //choose advance inquiry option
    $(document).on('change', '#inquiry_type_group input[type="radio"]', function (e) {

        if ($(this).val() === 'Commercial') {

            $("#company_div, #company_div_empty").show();
            $("#company_div, #company_div_empty").each(function (index, element) {

                $(element).attr('disabled', false);
            });

            $("#company_div span").each(function (index, element) {

                $(element).attr('disabled', true);
            });
        } else {

            $("#company_div, #company_div_empty").hide();
            $("#company_div, #company_div_empty").each(function (index, element) {

                $(element).attr('disabled', true);
            });

            $("#company_div span").each(function (index, element) {

                $(element).attr('disabled', false);
            });
        }
    });
}

function get_service_address(inquiry_id) {

    $.ajax({
        url: options.urlGetServiceAddress,
        type: 'get',
        data: {inquiry_id: inquiry_id},
        success: function (response) {

            console.log(response);

            $("#service_address_container").html(response);
        }
    });
}


function get_additional_contacts(inquiry_id) {

    $.ajax({
        url: options.urlGetAdditionalContacts,
        type: 'get',
        data: {inquiry_id: inquiry_id},
        success: function (response) {

            console.log(response);

            $("#additional_contacts_container").html(response);
        }
    });
}


function formatRepo(repo) {

    console.log(repo);
    if (repo) {
        return repo.title;
    }

    var $container = $(
        "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.title);

    return $container;
}


function formatRepoSelection(repo) {
    console.log(repo);
    return repo.title || repo.text;
}
