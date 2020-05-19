var options = {
    urlGetAllCustomers: base_url + 'customer/json_dropdown_customer_list',
};

$(document).ready(function() {
  
    $('#customers').select2({
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
});


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