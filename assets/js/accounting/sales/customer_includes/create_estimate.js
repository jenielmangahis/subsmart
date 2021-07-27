$(document).on("click", ".create-estimate-btn", function(event) {
    $("#newJobModal a[data-estimate-type='standard']").attr('href', baseURL + "/accounting/addNewEstimate/" + $(this).attr("data-customer-id"));
    $("#newJobModal a[data-estimate-type='options']").attr('href', baseURL + "/accounting/addNewEstimateOptions/" + $(this).attr("data-customer-id") + "?type=2");
    $("#newJobModal a[data-estimate-type='bundle']").attr('href', baseURL + "/accounting/addNewEstimateBundle/" + $(this).attr("data-customer-id") + "?type=3");
});