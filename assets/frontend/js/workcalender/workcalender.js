var options = {
    urlEventForm: base_url + 'event/get_event_form',
    urlGetAllCustomers: base_url + 'customer/json_dropdown_customer_list',
    urlGetAllUsers: base_url + 'users/json_dropdown_user_list',
    urlSaveEvent: base_url + 'event/save',
    urlRemoveEvent: base_url + 'event/remove/',
    urlEvents: base_url + 'event/json_events/'
};

$(document).ready(function() {


    // open event popup
    $('#modalCreateEvent').on('shown.bs.modal', function (e) {

        var element = $(this);

        $.ajax({
            url: options.urlEventForm,
            type: 'GET',
            // data: {index: service_address_index, customer_id: customer_id},
            success: function(response) {

                // console.log(response);

                $(element).find('.modal-body').html(response);

                // load customers
                $('#business-customer').select2({
                    ajax: {
                        url: options.urlGetAllCustomers,
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
                      placeholder: 'Select customer',
                      minimumInputLength: 0,
                      templateResult: formatRepo,
                      templateSelection: formatRepoSelection
                });

                // load users
                $('#assign_users').select2({
                    ajax: {
                        url: options.urlGetAllUsers,
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
                      placeholder: 'Select user',
                      minimumInputLength: 0,
                      templateResult: formatRepoUser,
                      templateSelection: formatRepoSelectionUser
                });

                $('#datepicker_starttime, #datepicker_endtime').datetimepicker({
                    format: 'LT'
                });

                $('#datepicker_startdate, #datepicker_enddate').datetimepicker({
                    format: 'L'
                });
            }
        });
    });


    // color selector
    $(document).on('click', '.calendar-modal-color-selector > .calendar-modal-color-sq', function(e) {

        e.preventDefault();

        // clear all selection
        $('.calendar-modal-color-selector > .calendar-modal-color-sq').each(function(index, element) {

            $(this).find('i').remove();
        });

        console.log($(this).attr('data-calendar-color-id'));
        var color_name = $(this).attr('data-calendar-color-name');
        $(this).html('<i class="calendar-modal-color-icon fa fa-check " aria-hidden="true"></i><span class="color-name">'+color_name+'</span>');

        // add color code to input element for form submit
        $(this).parent().next().val($(this).attr('data-calendar-color-id'))
    });


    $(document).on('click', '#button_submit_form', function(e) {

        e.preventDefault();
        $("#frm_create_event").submit();
    });


    $(document).on('submit', '#frm_create_event', function(e) {

        e.preventDefault();

        var saveButton = $("#modalCreateEvent #button_submit_form");
        var saveButtontext = $(saveButton).html();
        var event_description = $("#event-description").val();

        if( event_description != '' ){
          $(saveButton).attr('disabled', true);

          $("#calendar").css('opacity', '.5');
          $("#calendar").attr('disabled', true);

          jQuery.ajax({
              url: options.urlSaveEvent,
              type: 'POST',
              data: $(this).serialize(),
              beforeSend: function() {
                 $(saveButton).text('saving...');
              },
              success: function(response) {

                  console.log(response);

                  jQuery.ajax({
                      url: options.urlEvents,
                      type: 'GET',
                      success: function(response) {

                          console.log(response);

                          $(".event-form-description").html('');

                          $("#calendar").css('opacity', '1');
                          $("#calendar").attr('disabled', false);

                          $("#modalCreateEvent").modal('hide');

                          var calendarEl = document.getElementById('calendar');
                          var timeZoneSelectorEl = document.getElementById('time-zone-selector');

                          $(calendarEl).empty();

                          render_calender(calendarEl, timeZoneSelectorEl, JSON.parse(response));

                          $(saveButton).html(saveButtontext);

                          $(saveButton).attr('disabled', false);
                      }
                  });

                  load_upcoming_events();
              },
              error: function(er) {

                $(saveButton).html(saveButtontext);

                $(saveButton).attr('disabled', false);
              }
          });
        }else{
          $(saveButton).html(saveButtontext);
          $(saveButton).attr('disabled', false);
          $(".event-form-message").html('<div class="alert alert-danger" role="alert">Please specify event description</div>');
        }        
    });

    function load_upcoming_events(){
      var url = base_url + '/calendar/_load_upcoming_events';
       $("#upcoming-events-container").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Upcoming Events...</div>');

      $.ajax({
         type: "POST",
         url: url,
         data: {},
         success: function(o)
         {
            $("#upcoming-events-container").html(o);
         }
      });
    }


    // delete schedule
    $(document).on('click', '#delete_schedule', function(e) {

        e.preventDefault();

        var button = $(this);

        console.log($(this).parent().parent().find('.modal-body input[name="hid_event_id"]').val());

        if ( confirm("Are you sure to remove the schedule?") ) {

            $("#calendar").css('opacity', '.5');
            $("#calendar").attr('disabled', true);

            jQuery.ajax({
                url: options.urlRemoveEvent,
                type: 'POST',
                data: {event_id: $(this).parent().parent().find('.modal-body input[name="hid_event_id"]').val()},
                beforeSend: function() {
                   $(button).text('removing...');
                },
                success: function(response) {

                    console.log(response);

                    jQuery.ajax({
                        url: options.urlEvents,
                        type: 'GET',
                        success: function(response) {

                            console.log(response);

                            $("#calendar").css('opacity', '1');
                            $("#calendar").attr('disabled', false);

                            $("#modalEventDetails").modal('hide');

                            var calendarEl = document.getElementById('calendar');
                            var timeZoneSelectorEl = document.getElementById('time-zone-selector');

                            $(calendarEl).empty();

                            render_calender(calendarEl, timeZoneSelectorEl, JSON.parse(response));
                        }
                    });
                }
            });
        }
    });


    // edit button click on the event popup for the workorder
    // it will redirect the page to the partiular workorder edit page
    $(document).on("click", "#edit_workorder", function() {

      location.href = base_url + 'workorder/edit/' + $(this).attr('data-workorder-id');
    });


    // edit button click on the event popup for the event
    // it will open the popup of the event
    // and close the current popup
    $(document).on("click", "#edit_schedule", function() {

      $("#modalEventDetails").modal('hide');

      var element = $(this);

      // $('#modalEventDetails').on('hidden.bs.modal', function (e) {

      //   open_create_event_modal_for_event($(element).attr('data-event-id'), true);
      // });

      open_create_event_modal_for_event($(element).attr('data-event-id'), true);

    });
});



function open_create_event_modal_for_customer(customer_id, customer) {

    $('#modalCreateEvent').modal('show');

    $('#modalCreateEvent').on('shown.bs.modal', function (e) {

        var element = $(this);
        // var customer = JSON.parse(customer);

        $(element).find('.modal-body').html("loading...");

        $.ajax({
            url: options.urlEventForm,
            type: 'GET',
            data: {customer_id: customer_id},
            success: function(response) {

                // console.log(response);

                $(element).find('.modal-body').html(response);

                // load customers
                $('#business-customer').select2({
                    ajax: {
                        url: options.urlGetAllCustomers,
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
                      placeholder: 'Select customer',
                      minimumInputLength: 0,
                      templateResult: formatRepo,
                      templateSelection: formatRepoSelection
                });

                // load users
                $('#assign_users').select2({
                    ajax: {
                        url: options.urlGetAllUsers,
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
                      placeholder: 'Select user',
                      minimumInputLength: 0,
                      templateResult: formatRepoUser,
                      templateSelection: formatRepoSelectionUser
                });

                $('#datepicker_starttime, #datepicker_endtime').datetimepicker({
                    format: 'LT'
                });

                $('#datepicker_startdate, #datepicker_enddate').datetimepicker({
                    format: 'L'
                });

                // select the customer
                $('#business-customer')
                .empty() //empty select
                .append($("<option/>") //add option tag in select
                    .val(customer_id) //set value for option to post it
                    .text(customer.contact_name + ',' + customer.contact_email)) //set a text for show in select
                .val(customer_id) //select option of select2
                .trigger("change"); //apply to select2
            }
        });
    });

}



function open_create_event_modal_for_event(event_id, open_edit_modal) {

  $('#modalCreateEvent').modal('show');

  if ( open_edit_modal ) {

    $('#modalCreateEvent').on('shown.bs.modal', function (e) {

        var element = $(this);
        // var customer = JSON.parse(customer);

        $(element).find('.modal-body').html("loading...");

        $.ajax({
            url: options.urlEventForm,
            type: 'GET',
            data: {event_id: event_id},
            success: function(response) {

                // console.log(response);

                $(element).find('.modal-body').html(response);

                // load customers
                $('#business-customer').select2({
                    ajax: {
                        url: options.urlGetAllCustomers,
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
                      placeholder: 'Select customer',
                      minimumInputLength: 0,
                      templateResult: formatRepo,
                      templateSelection: formatRepoSelection
                });

                // load users
                $('#assign_users').select2({
                    ajax: {
                        url: options.urlGetAllUsers,
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
                      placeholder: 'Select user',
                      minimumInputLength: 0,
                      templateResult: formatRepoUser,
                      templateSelection: formatRepoSelectionUser
                });

                $('#datepicker_starttime, #datepicker_endtime').datetimepicker({
                    format: 'LT'
                });

                $('#datepicker_startdate, #datepicker_enddate').datetimepicker({
                    format: 'L'
                });

                // select the customer
                // $('#business-customer')
                // .empty() //empty select
                // .append($("<option/>") //add option tag in select
                //     .val(customer_id) //set value for option to post it
                //     .text(customer.contact_name + ',' + customer.contact_email)) //set a text for show in select
                // .val(customer_id) //select option of select2
                // .trigger("change"); //apply to select2
            }
        });
    });
  }
}


function formatRepo (repo) {

    console.log(repo);
    if (repo) {
      return repo.contact_name;
    }

    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "</div>" +
        "</div>" +
      "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.contact_name);

    return $container;
}


function formatRepoSelection (repo) {
      console.log(repo);
    return repo.contact_name || repo.text;
}

function formatRepoUser (repo) {

    console.log(repo);
    if (repo) {
      return repo.FName + ' ' + repo.LName;
    }

    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__meta'>" +
          "<div class='select2-result-repository__title'></div>" +
          "</div>" +
        "</div>" +
      "</div>"
    );

    $container.find(".select2-result-repository__title").text(repo.name);

    return $container;
}


function formatRepoSelectionUser (repo) {
      console.log(repo);
    return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
}
