var options = {
    urlGetAll: base_url + 'customer/source/json_list',
    urlAdd: base_url + 'customer/source/save/json',
    urlAddGroup: base_url + 'customer/group/save_json',
    urlServiceAddressForm: base_url + 'customer/service_address_form',
    urlSaveServiceAddress: base_url + 'customer/save_service_address',
    urlGetServiceAddress: base_url + 'customer/json_get_address_services',
    urlRemoveServiceAddress: base_url + 'customer/remove_address_services',
    urlAdditionalContactForm: base_url + 'customer/additional_contact_form',
    urlSaveAdditionalContact: base_url + 'customer/save_additional_contact',
    urlGetAdditionalContacts: base_url + 'customer/json_get_additional_contacts',
    urlRemoveAdditionalContact: base_url + 'customer/remove_additional_contact',
    urlSaveCustomer: base_url + 'customer/save',
    urlServiceGroupForm: base_url + 'customer/group_form',
    urlCustomerTypesGetAll: base_url + 'customer/types/json_list',
    urlCustomerTypesAdd: base_url + 'customer/types/save/json',
};

$(document).ready(function() {

  $("#customerListTable").DataTable({
    ordering: false,
    destroy: true,
  });
    // customer types
    $("#customer_types")
    .select2({
      ajax: {
        url: options.urlCustomerTypesGetAll,
        dataType: "json",
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
            results: data
            // pagination: {
            //   more: (params.page * 30) < data.total_count
            // }
          };
        },
        cache: true
      },
      placeholder: "Search for a source",
      minimumInputLength: 0,
      templateResult: formatRepo,
      templateSelection: formatRepoSelection
    })
    .on("select2:open", function () {
      $(".select2-results:not(:has(a))").append(
        '<a data-toggle="modal" data-target="#modalAddNewCustomerTypes" href="#" style="padding: 8px; border-top: 1px solid #dcdbdc; width: 100%; display: inline-table;">+ Add new source</a>'
      );
    }).on('select2:selecting', function(e) {
      if(e.params.args.data.title != "")
      {
          if (e.params.args.data.title === "Advance") {
            $("#advance_customer_view").show();
            $("#advance_customer_view input, #advance_customer_view select").each(
              function(index, element) {
                $(element).attr("disabled", false);
              }
            );
          } else {
            $("#advance_customer_view").hide();
            $("#advance_customer_view input, #advance_customer_view select").each(
              function(index, element) {
                $(element).attr("disabled", true);
              }
            );
          }
      }
    });

  $(document).on("click", "#modalAddNewCustomerTypes .save", function (e) {
    $("#customer_types").select2("close");
    e.preventDefault();
    $('#frm_add_new_customer_types').submit();
  });

  $(document).on("submit", "#frm_add_new_customer_types", function (e) {
    e.preventDefault();

    var saveButton = $("#modalAddNewCustomerTypes .save");
    var saveButtontext = $(saveButton).html();

    $(saveButton).attr("disabled", true);

    jQuery.ajax({
      url: options.urlCustomerTypesAdd,
      type: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $(saveButton).text("saving...");
      },
      success: function (response) {
        //console.log(response);

        $("#modalAddNewCustomerTypes").modal("hide");
      }
    });
  });
  // source code
  // $(document).on("click", "#modalAddNewSource .save", function (e) {
  //   e.preventDefault();


  $(document).on("submit", "#frm_add_new_source", function (e) {
    e.preventDefault();

    var saveButton = $("#modalAddNewSource .save");
    var saveButtontext = $(saveButton).html();

    $(saveButton).attr("disabled", true);

    jQuery.ajax({
      url: options.urlAdd,
      type: "POST",
      data: $(this).serialize(),
      beforeSend: function () {
        $(saveButton).text("saving...");
      },
      success: function (response) {
        //console.log(response);

        $("#modalAddNewSource").modal("hide");
      }
    });
  });

  $("#customer_source")
    .select2({
      ajax: {
        url: options.urlGetAll,
        dataType: "json",
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
            results: data
            // pagination: {
            //   more: (params.page * 30) < data.total_count
            // }
          };
        },
        cache: true
      },
      placeholder: "Search for a source",
      minimumInputLength: 0,
      templateResult: formatRepo,
      templateSelection: formatRepoSelection
    })
    .on("select2:open", function () {
      $(".select2-results:not(:has(a))").append(
        '<a data-toggle="modal" data-target="#modalAddNewSource" href="#" style="padding: 8px; border-top: 1px solid #dcdbdc; width: 100%; display: inline-table;">+ Add new source</a>'
      );
    });
  
  // open service address form
  $('#modalServiceAddress').on('shown.bs.modal', function (e) {

    var element = $(this);
    $(element).find('.modal-body').html('loading...');
    $.ajax({
      url: options.urlServiceAddressForm,
      type: 'GET',
      success: function (response) {
        $(element).find('.modal-body').html(response);
        $('#frm_serice_address input[name=row-counter]').val($(e.relatedTarget).attr('data-input-counter'));
        $('#frm_serice_address input[name=customer_id]').val($(e.relatedTarget).attr('data-customer-id'));

        if ($(e.relatedTarget).attr('data-id') != '-1' && $(e.relatedTarget).attr('data-id') != -1)
          $('#frm_serice_address input[name=data_index]').val($(e.relatedTarget).attr('data-id'));
        $('#frm_serice_address input[name=address]').val($(e.relatedTarget).attr('data-input-address'));
        $('#frm_serice_address input[name=address_secondary]').val($(e.relatedTarget).attr('data-input-address_secondary'));
        $('#frm_serice_address input[name=city]').val($(e.relatedTarget).attr('data-input-city'));
        $('#frm_serice_address input[name=zip]').val($(e.relatedTarget).attr('data-input-zip'));
        $('#frm_serice_address input[name=name]').val($(e.relatedTarget).attr('data-input-name'));
        $('#frm_serice_address input[name=email]').val($(e.relatedTarget).attr('data-input-email'));
        $('#frm_serice_address input[name=phone]').val($(e.relatedTarget).attr('data-input-phone'));
        $('#frm_serice_address textarea[name=notes]').val($(e.relatedTarget).attr('data-input-notes'));
        $('#frm_serice_address select[name=state]').val($(e.relatedTarget).attr('data-input-state'));
        $(e.relatedTarget).attr('data-input-state_text');
      }
    });
  });
    // open service address form
  $('#modalServiceAddress').on('shown.bs.modal', function (e) {
    if (confirm('Are you sure to delete this item')) {

      var service_address_index = $(this).attr('data-id');
      var counter = $(this).attr('data-input-counter');
      var customer_id = $(this).attr('data-customer-id');
      var row = $(this).closest('li.customer-address-list__item');

      $(row).css('opacity', .50);
      $(row).find('a').attr('disabled', true);


      var deletedAddresses = $('input[name=service_address_container_deleted_addresses]').val();

      if (service_address_index != null && service_address_index != undefined && service_address_index != "") {
        if (deletedAddresses != '' && deletedAddresses != null)
          $('input[name=service_address_container_deleted_addresses]').val(deletedAddresses += ',' + service_address_index);
        else
          $('input[name=service_address_container_deleted_addresses]').val(service_address_index);
      }
      $('#service_address_container #customer-address-list-counter-' + counter).remove();
    }
  });


    // get_service_address();
    // add group 
    $(document).on('click', "#modalAddNewGroup .save", function (e) {
        
        e.preventDefault();

        $('#frm_add_new_group').submit();
    });

    $('#modalServiceAddress').on('shown.bs.modal', function (e) {

        $('#modalAddNewGroup .validation-error').hide();
        $('#modalAddNewGroup .validation-error').html('');

    });


    $(document).on('submit', '#frm_add_new_group', function (e) {

        e.preventDefault();

        var saveButton = $("#modalAddNewGroup .save");
        var saveButtontext = $(saveButton).html();

       $(saveButton).attr('disabled', true);

        jQuery.ajax({
            url: options.urlAddGroup,
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                $(saveButton).text('saving...');
            },
            success: function (response) {

                let resp = jQuery.parseJSON( response );
                if(resp.status == 'success')
                {
                    $('.customer-group-list-div').append('<div class="checkbox checkbox-sec margin-right"><input type="checkbox" name="customer_group[]" value="'+resp.title+'" id="customer_group_'+resp.group_id+'"> <label for="customer_group_'+resp.group_id+'"> <span>'+resp.title+'</span></label></div>')
                    $('#modalAddNewGroup .validation-error').hide();
                    $("#modalAddNewGroup").modal('hide');
                    $(saveButton).attr('disabled', false);
                    $(saveButton).text('Save changes');
                } else {
                    $('#modalAddNewGroup .validation-error').html(resp.errors.title);
                    $('#modalAddNewGroup .validation-error').show();
                    $(saveButton).attr('disabled', false);
                    $(saveButton).text('Save changes');
                }
            }
        });
    });

    /* Contact */

    // open additional contact form
    $('#modalAdditionalContacts').on('shown.bs.modal', function (e) {

        var element = $(this);
        $(element).find('.modal-body').html('loading...');

        var service_address_index = $(e.relatedTarget).attr('data-id');
        var customer_id = $(e.relatedTarget).attr('data-customer-id');

        if (service_address_index && customer_id) {

            $.ajax({
                url: options.urlAdditionalContactForm,
                type: 'GET',
                data: {index: service_address_index, customer_id: customer_id, action: 'edit'},
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


  $(document).on("submit", "#frm_serice_address", function(e) {
    e.preventDefault();

    $.ajax({
      url: options.urlSaveServiceAddress,
      type: "POST",
      data: $(this).serialize(),
      success: function(response) {
        console.log(response);
        var json = JSON.parse(response);

        if (json.customer_id) {
          get_service_address(json.customer_id);
        }

        $("#modalServiceAddress").modal("hide");

        // $(element).find('.modal-body').html(response);
      }
    });
  });

  // remove service address
  $(document).on("click", ".customer-address-list__delete", function() {
    if (confirm("Are you sure to delete this item")) {
      var service_address_index = $(this).attr("data-id");
      var customer_id = $(this).attr("data-customer-id");
      var row = $(this).closest("li.customer-address-list__item");

      $(row).css("opacity", 0.5);
      $(row)
        .find("a")
        .attr("disabled", true);

      $.ajax({
        url: options.urlRemoveServiceAddress,
        type: "POST",
        data: { index: service_address_index, customer_id: customer_id },
        success: function(response) {
          console.log(response);

          var json = JSON.parse(response);

          if (json.status == "success") {
            $(row).remove();
          } else {
            alert("Something went wrong!");
            $(row).css("opacity", 1);
            $(row)
              .find("a")
              .attr("disabled", false);
          }

          // get_service_address();
        }
      });
    }
  });

  // get_service_address();

  /* Contact */

  // open additional contact for
  $("#modalAdditionalContacts").on("shown.bs.modal", function(e) {
    var element = $(this);
    $(element)
      .find(".modal-body")
      .html("loading...");

    var service_address_index = $(e.relatedTarget).attr("data-id");
    var customer_id = $(e.relatedTarget).attr("data-customer-id");

    console.log(service_address_index, customer_id);

    if (service_address_index && customer_id) {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        data: {
          index: service_address_index,
          customer_id: customer_id,
          action: "edit"
        },
        success: function(response) {
          // console.log(response);

          $(element)
            .find(".modal-body")
            .html(response);
        }
      });
    } else {
      $.ajax({
        url: options.urlAdditionalContactForm,
        type: "GET",
        success: function(response) {
          $(element)
            .find(".modal-body")
            .html(response);
        }
      });
    }
  });

  $(document).on(
    "click",
    "#modalAdditionalContacts .modal-footer > button:last-child",
    function(e) {
      e.preventDefault();

      $("#frm_additional_contact").submit();
    }
  );

  $(document).on("submit", "#frm_additional_contact", function(e) {
    e.preventDefault();

    $.ajax({
      url: options.urlSaveAdditionalContact,
      type: "POST",
      data: $(this).serialize(),
      success: function(response) {
        console.log(response);
        var json = JSON.parse(response);

        if (json.customer_id) {
          get_additional_contacts(json.customer_id);
        }

        $("#modalAdditionalContacts").modal("hide");
      }
    });
  });

  // remove service address
  $(document).on("click", ".customer-contact-list__delete", function() {
    if (confirm("Are you sure to delete this item")) {
      var service_address_index = $(this).attr("data-id");
      var customer_id = $(this).attr("data-customer-id");
      var row = $(this).closest("li.customer-contact-list__item");

      $(row).css("opacity", 0.5);
      $(row)
        .find("a")
        .attr("disabled", true);

      $.ajax({
        url: options.urlRemoveAdditionalContact,
        type: "POST",
        data: { index: service_address_index, customer_id: customer_id },
        success: function(response) {
          //console.log(response);

          var json = JSON.parse(response);

          if (json.status == "success") {
            $(row).remove();
          } else {
            alert("Something went wrong!");
            $(row).css("opacity", 1);
            $(row)
              .find("a")
              .attr("disabled", false);
          }
        }
      });
    }
  });

  // get_additional_contacts();

  // save customer
  $(document).on("submit", "#customer_form", function(e) {
    e.preventDefault();

    if (testCreditCard()) {
      var button = $(this).find("button[type='submit']");
      var button_text = $(button).html();
      $(button).text("saving...");
      $(button).attr("disabled", true);

      $.ajax({
        url: $(this).attr("action"),
        type: "POST",
        data: $(this).serialize(),
        success: function(response) {
          console.log(response);

          var json = JSON.parse(response);

          if (json.url) {
            location.href = json.url;
          } else {
            $(button).text(button_text);
            $(button).attr("disabled", false);
          }
        }
      });
     
    }
  });

  toggle_advance_options();

  $("#technician_arrival_time, #technician_departure_time").datetimepicker({
    format: "LT"
  });

  // remove item from list
  $(document).on("click", ".remove-data-item", function (e) {
    e.preventDefault();

    var button = $(this);
    var row = $(this)
      .parent()
      .parent();

    if (confirm("Do you really want to delete this item ?")) {
      $(button).attr("disabled", true);
      $(row).css({ opacity: ".50" });

      jQuery.ajax({
        url: $(this).attr("href"),
        type: "DELETE",
        success: function (response) {
          console.log(response);
          $(row).remove();
        },
        error: function (err) {
          $(button).attr("disabled", false);
          $(row).css({ opacity: "1" });
        }
      });
    }
  });

  // open service address form
  $('#modalServiceGroup').on('shown.bs.modal', function (e) {

      var element = $(this);
      $(element).find('.modal-body').html('loading...');

      // console.log($(e.relatedTarget).attr('data-customer-id'));

      var service_address_index = $(e.relatedTarget).attr('data-id');
      var customer_id = $(e.relatedTarget).attr('data-customer-id');

      if (service_address_index && customer_id) {

          $.ajax({
              url: options.urlServiceGroupForm,
              type: 'GET',
              data: {index: service_address_index, customer_id: customer_id},
              success: function (response) {

                    console.log(response);

                  $(element).find('.modal-body').html(response);
              }
          });
      } else {

          $.ajax({
              url: options.urlServiceGroupForm,
              type: 'GET',
              success: function (response) {

                    console.log(response);

                  $(element).find('.modal-body').html(response);
              }
          });
      }
  });

  $("#exportCustomers").click(function () {
    exportItems();
  });
});

function toggle_advance_options() {
  //
  if (!$("#advance_customer_view").is("hidden")) {
    $("#advance_customer_view input, #advance_customer_view select").each(
      function(index, element) {
        $(element).attr("disabled", false);
      }
    );
  }

  //choose advance customer option
  $(document).on("change", '#customer_type_group input[type="radio"]', function(e) {
    if ($(this).val() === "Advance") {
      $("#advance_customer_view").show();
      $("#advance_customer_view input, #advance_customer_view select").each(
        function(index, element) {
          $(element).attr("disabled", false);
        }
      );
    } else {
      $("#advance_customer_view").hide();
      $("#advance_customer_view input, #advance_customer_view select").each(
        function(index, element) {
          $(element).attr("disabled", true);
        }
      );
    }
  });
}

function testCreditCard() {
  myCardNo = $("#card_no").val();
  myCardType = $(".card-types input").val();

  console.table(myCardNo, myCardType);

  if (checkCreditCard(myCardNo, myCardType)) {
    // alert("Credit card has a valid format");
    return true;
  } else {
    alert(ccErrors[ccErrorNo]);
  }
  return false;
}

function get_service_address(customer_id) {
  $.ajax({
    url: options.urlGetServiceAddress,
    type: "get",
    data: { customer_id: customer_id },
    success: function(response) {
      console.log(response);

      $("#service_address_container").html(response);
    }
  });
}

function get_additional_contacts(customer_id) {
  $.ajax({
    url: options.urlGetAdditionalContacts,
    type: "get",
    data: { customer_id: customer_id },
    success: function(response) {
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

function exportItems() {
  var link = document.createElement("a");
  link.href = base_url + "customer/exportItems";

  document.body.appendChild(link);
  link.click();
}
