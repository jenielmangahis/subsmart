let mobileWidth = 768;
let windowWidth = $(window).innerWidth();

$(document).ready(function () {

	initializeWindow();
	resizeSidebar();

	$(".sidebar-toggler").on("click", function () {
		toggleSidebar();
	});
	
	$(".nsm-sidebar-bg").on("click", function(){
		toggleSidebar();
	});

	$(window).on("resize", function () {
		let newWindowWidth = $(window).innerWidth();
		let windowIsLarge = windowWidth > 768 ? true : false;

		if (windowIsLarge && newWindowWidth <= 768) {
			location.reload();
		}
		else if (!windowIsLarge && newWindowWidth > 768) {
			location.reload();
		}
	});

	$(".nsm-fab").on("click", function () {
		let _this = $(this);
		let _fabOptions = _this.closest(".nsm-fab-container").find(".nsm-fab-options");
		let isShown = _fabOptions.hasClass("shown");

		if(_fabOptions[0] != undefined){
			if (!isShown) {
				_fabOptions.addClass("shown");
				_this.find(".bx").removeClass("bx-plus").addClass("bx-x");
				return false;
			}
			_fabOptions.removeClass("shown");
			_this.find(".bx").removeClass("bx-x").addClass("bx-plus");
		}
	});

	$(".nsm-sidebar-menu li").on("click", function(){
		let _this = $(this);
		let _menuList = $(".nsm-sidebar-menu").find("li");

		if(_this.hasClass("shown")){
			_this.removeClass("shown");
		}
		else{
			_menuList.removeClass("shown")
			_this.addClass("shown");
		}
	});

	$(".nsm-alert button").on("click", function(){
		$(this).closest(".nsm-alert").fadeOut();
	});
});

function toggleSidebar() {
	let _main = $(".nsm-main");
	let _sidebar = $(".nsm-sidebar");
	let _sidebarBG = $(".nsm-sidebar-bg");
	let isShown = _sidebar.hasClass("shown");
	let sidebarWidth = _sidebar.innerWidth();
	let mobileView = $(".nsm-container").hasClass("nsm-mobile");

	if (mobileView && isShown) {
		_sidebar.removeClass("shown");
		_sidebarBG.removeClass("shown");
	}
	else if (mobileView && !isShown) {
		_sidebar.addClass("shown");
		_sidebarBG.addClass("shown");
	}
	else if (!mobileView && isShown) {
		_sidebar.removeClass("shown");
		_sidebarBG.removeClass("shown");
	}
	else if (!mobileView && !isShown) {
		_sidebar.addClass("shown");
		_sidebarBG.addClass("shown");
	}
}

function initializeWindow() {
	let windowWidth = $(document).innerWidth();
	let _container = $(".nsm-container");
	let _sidebar = $(".nsm-sidebar");

	if (windowWidth <= 768) {
		_container.addClass("nsm-mobile");
		_sidebar.removeClass("shown");
	}
}

function resizeSidebar(){
	$(".nsm-sidebar").innerHeight(
		$(".nsm-main").innerHeight()
	);

	$(".nsm-sidebar-bg").innerHeight(
		$(".nsm-main").innerHeight()
	);
}

function initializeChart(chartType="all") {
	switch(chartType){
		case "sales":
			initializeSalesChart();
			break;
		case "invoices":
			initializeInvoiceChart();
			break;
		case "estimates":
			initializeEstimatesChart();
			break;
		case "expenses":
			initializeExpensesChart();
		case "jobs":
			initializeJobsChart();
		case "lead-source":
			initializeLeadSourceChart();
		default:
			initializeSalesChart();
			initializeInvoiceChart();
			initializeEstimatesChart();
			initializeExpensesChart();
			initializeJobsChart();
			initializeLeadSourceChart();
			break;
	}

	resizeSidebar();
}

function isMobileView(){
    return windowWidth < mobileWidth;
}