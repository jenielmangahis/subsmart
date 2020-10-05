$(document).ready(function () {
    $("#affiliateListTbl").DataTable({
      destroy: true,
    });

    $("#addMailAdd").click(function() {
        $(".hide-address").fadeIn();
        $("#hideMailAdd").show();
        $("#addMailAdd").hide();
    });

    $("#hideMailAdd").click(function() {
        $(".hide-address").hide();
        $("#hideMailAdd").hide();
        $("#addMailAdd").show();
    });

    $("#exportAffiliates").click(function () {
      exportItems();
    });

    $("#importAffiliateBtn").click(function () {
      $("#importAffiliateFile").click();
    });

    $("#importAffiliateFile").change(function() {
      document.getElementById("affiliateImportForm").submit();
    });

    $('#printAffiliateBtn').click(function(){
      window.print();
    });

    $('#checkAffiliateURL').click(function(){
      var link = document.createElement("a");
      link.href = $("#websiteUrl").val();
    
      document.body.appendChild(link);
      link.click();
    });

    $("#searchAffiliate").click(function() {
      getAffiliatesByfilters();
    });
  });
  
  function readURL(input, id) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#" + id)
          .attr("src", e.target.result)
          .height(165);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }

  function exportItems() {
    var link = document.createElement("a");
    link.href = base_url + "affiliate/exportAffiliates";
  
    document.body.appendChild(link);
    link.click();
  }
  
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  function filterReportsByMonths(startDate, endDate) {
    $.ajax({
      url: options.urlFilterReports,
      type: "GET",
      data: { startDate: startDate, endDate: endDate },
      beforeSend: function () {
        $(".loader").show();
        $("#reportTable").fadeOut();
      },
      success: function (response) {
        var obj = JSON.parse(response);
        $("#tableToListReport tbody").empty();
        obj.monthly.forEach(monthlyCloseout);
  
        $(".loader").fadeOut();
        $("#reportTable").fadeIn();
      },
    });
  }
  