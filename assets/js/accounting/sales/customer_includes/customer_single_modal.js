$(document).on("click", ".customer-full-page-btn", function(event) {
    $(".page-notification-section").hide();
    $("#customer-single-modal").fadeIn();
    $(".section-above-table .search-holder ul.dropdown-menu").removeClass("show");
    $("#customers_table").hide();
});