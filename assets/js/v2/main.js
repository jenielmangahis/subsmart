let mobileWidth = 768;
let windowWidth = $(window).innerWidth();

$(document).ready(function () {

	initializeWindow();
	resizeSidebar();

	$(".sidebar-toggler").on("click", function () {
		toggleSidebar();
	});

	$(".nsm-sidebar-bg").on("click", function () {
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
		let _fabOptions = $(".nsm-fab-options");
		let isShown = _fabOptions.hasClass("shown");

		if (!isShown) {
			_fabOptions.addClass("shown");
			_this.find(".bx").removeClass("bx-plus").addClass("bx-x");
			return false;
		}
		_fabOptions.removeClass("shown");
		_this.find(".bx").removeClass("bx-x").addClass("bx-plus");
	});

	$(".nsm-sidebar-menu > li > a").on("click", function (e) {
		let _this = $(this);
		let _menuParentList = _this.closest("li");
		let _menuList = $(".nsm-sidebar-menu").find("li");

		if (!_menuParentList.hasClass("shown")) {
			_menuList.removeClass("shown");
			_menuParentList.addClass("shown");
			e.preventDefault();
		}
		else {
			_menuParentList.removeClass("shown");
		}
		resizeSidebar();
	});

	$(".nsm-sidebar-menu .dropdown-menu#new-popup").on("click", function(e) {
		e.stopPropagation();
	});

	$(".nsm-alert button").on("click", function () {
		let _alert = $(this).closest(".nsm-alert");
		_alert.fadeOut(300, function () {
			resizeSidebar();
		});
	});

	$(".nsm-callout button").on("click", function () {
		let _alert = $(this).closest(".nsm-callout");
		_alert.fadeOut(300, function () {
			resizeSidebar();
		});
	});

	$(".nsm-img-upload").on("click", function () {
		let fileInput = $(this).find("input[type=file]");

	});

	$(document).on("change", ".nsm-img-upload .nsm-upload", function (e) {
		let _this = $(this);
		let reader = new FileReader();

		reader.onload = function () {
			let imgPreview = _this.closest(".nsm-img-upload");
			imgPreview.css("background-image", "url('" + reader.result + "')");
		};
		reader.readAsDataURL(e.target.files[0]);
	});

	$(document).on("click", ".nsm-color-picker li", function () {
		let _this = $(this);
		let _parent = _this.closest(".nsm-color-picker");
		let _input = _parent.find(".nsm-color-field");
		let _colorVal = _this.attr("data-color");

		_parent.find("li").removeClass("active");
		_this.addClass("active");
		_input.val(_colorVal);
	});
});

function toggleSidebar() {
	let _main = $(".nsm-main");
	let _sidebar = $(".nsm-sidebar");
	let _sidebarBG = $(".nsm-sidebar-bg");
	let isShown = _sidebar.hasClass("shown");
	let sidebarWidth = _sidebar.innerWidth();
	let mobileView = $(".nsm-container").hasClass("nsm-mobile");

	resizeSidebar();
	
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

function resizeSidebar() {
	$(".nsm-sidebar").css("height", "auto");
	$(".nsm-sidebar").css("min-height", $(".nsm-main").innerHeight() + "px");
	$(".nsm-sidebar-bg").css("height", $(".nsm-main").innerHeight() + "px");
}

function initializeChart(chartType = "all") {
	switch (chartType) {
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

function debounce(func, wait, immediate) {
	var timeout;

	return function executedFunction() {
		var context = this;
		var args = arguments;

		var later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};

		var callNow = immediate && !timeout;

		clearTimeout(timeout);

		timeout = setTimeout(later, wait);

		if (callNow) func.apply(context, args);
	};
};

function showLoader(_elem) {
	let loader = '<div class="row">' +
		'<div class="col-12">' +
		'<div class="nsm-loader">' +
		'<i class="bx bx-loader-alt bx-spin"></i>' +
		'</div>' +
		'</div>' +
		'</div>';
	_elem.html(loader);
}

function showSwalLoading() {
	Swal.fire({
		title: 'Processing',
		text: 'Request processing, please wait.',
		allowEscapeKey: false,
		allowOutsideClick: false,
		didOpen: () => {
			Swal.showLoading()
		},
	});
}