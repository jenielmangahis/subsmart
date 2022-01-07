$(document).ready(function () {
    let _table = $(".nsm-table");
    let _headCols = _table.find("thead td");
    let _bodyRows = _table.find("tbody tr:not(.nsm-row-collapse)");
    let withIcon = _table.find("thead td:first-child").hasClass("table-icon");

    if (isMobileView()) {
        $.each(_bodyRows, function (idx, obj) {
            let _this = $(this);
            let rowCollapse = '';
            let colspan = _this.find("td").length;
            let headColIndex = 1;

            _this.find("td:nth-child(1)").addClass("show");

            if (withIcon) {
                _this.find("td:nth-child(1)").addClass("table-icon");
                _table.find("thead td:nth-child(1)").addClass("table-icon");

                _table.find("thead td:nth-child(1)").addClass("show");
                _table.find("thead td:nth-child(2)").addClass("show");
                _this.find("td:nth-child(2)").addClass("show");
                _this.find("td:nth-child(2)").append("<i class='bx bx-chevron-down'></i>");
                headColIndex = 2;
            }
            else {
                _table.find("thead td:nth-child(1)").addClass("show");
                _this.find("td:nth-child(1)").append("<i class='bx bx-chevron-down'></i>");
                headColIndex = 1;
            }

            _this.find("td.show").attr("data-bs-toggle", "collapse");
            _this.find("td.show").attr("data-bs-target", "#table_row_" + idx);

            rowCollapse = '<tr class="nsm-row-collapse collapse" id="table_row_' + idx + '">';
            rowCollapse += '<td colspan="' + colspan + '">';

            $.each(_this.find("td:not(.show)"), function (tdIdx, tdObj) {
                rowCollapse += '<div class="row">';
                rowCollapse += '<div class="col-12 col-sm-2">';
                rowCollapse += '<label class="content-subtitle fw-bold">' + _headCols.eq(tdIdx + headColIndex).data("name") + ':</label>';
                rowCollapse += '</div>';
                rowCollapse += '<div class="col-12 col-sm-10">';
                rowCollapse += '<label class="content-subtitle">' + getCollapsedColumns($(this)) + '</label>';
                rowCollapse += '</div>';
                rowCollapse += '</div>';

            });

            rowCollapse += '</td>';
            rowCollapse += '</tr>';

            $(rowCollapse).insertAfter(_this);
        });
    }

    $(".nsm-row-collapse").on("show.bs.collapse", function (e) {
        isMobileView() ? $(this).prev().find(".bx-chevron-down").css("transform", "rotate(180deg)") : e.preventDefault();
    });

    $(".nsm-row-collapse").on("hide.bs.collapse", function (e) {
        $(this).prev().find(".bx-chevron-down").css("transform", "rotate(0deg)");
    });

    $(document).on("click", ".nsm-pagination .page-link", function(e){
        let _this = $(this);
        let disabled = _this.hasClass("disabled");

        if(disabled)
            return false;

        if(_this.hasClass("prev") || _this.hasClass("next")){
            let activePage = _this.closest(".nsm-table").find(".page-link.active").html();
            let activePageNum = activePage != undefined ? activePage : 1;
            let page = _this.hasClass("prev") ? parseInt(activePageNum) - 1 : parseInt(activePageNum) + 1;
            
            changePage(_this.closest(".nsm-table"), page);
        }
        else{
            changePage(_this.closest(".nsm-table"), _this.html());
        }
    });
});

function isMobileView() {
    return windowWidth < mobileWidth;
}

function getCollapsedColumns(_this) {
    let _dropdown = _this.find(".dropdown");
    let _html = _this.html();

    if (_dropdown.length > 0) {
        let _links = _dropdown.find("ul a");
        let buttons = '';

        $.each(_links, function (idx, obj) {
            _linkObj = $(this);
            _linkObj.removeClass("dropdown-item");
            classStr = _linkObj.attr("class") + " nsm-button btn-sm m-0 me-2"
            redirectUrl = _linkObj.attr("href");
            extraAttrs = '';

            $.each(obj.attributes, function () {
                if (this.specified) {
                    attrValue = this.value;

                    if (this.name == "class")
                        attrValue = "nsm-button btn-sm m-0 me-2 d-inline-block mb-2 " + this.value;

                    extraAttrs += " " + this.name + '="' + attrValue + '"';
                }
            });

            _link = '<a role="button" ' + extraAttrs + '>' + $(this).html() + '</a>'
            buttons += _link;
        });

        _html = buttons;
    }

    return _html;
}

// PAGINATION PLUGIN

(function ($) {
    $.fn.nsmPagination = function (options) {
        var _this = this;

        var settings = $.extend({
            page: 1,
            itemsPerPage: 10,
        }, options);
        
        changePage(_this, settings.page, settings.itemsPerPage);
    };
}(jQuery));

function changePage(_table, page=1, itemsPerPage=10){
    var _tableRows = _table.find("tbody tr:not(.nsm-row-collapse)");
    var _tableColCount = _table.find("thead tr:first-child td").length;
    var rowLength = _tableRows.length;
    var rowStart = page > 1 ? (itemsPerPage * (page-1)) : 0;
    var rowEnd = rowStart + itemsPerPage;
    var isFirstPage = page == 1;
    var isLastPage = page > parseInt(rowLength / itemsPerPage);
    var numberOfPages = Math.ceil(rowLength / itemsPerPage);
    var prevIsDisabled = isFirstPage ? "disabled" : "";
    var nextIsDisabled = isLastPage ? "disabled" : "";
    var maxPaginationNum = 4;
    var paginationPages = getPaginationPages(page, maxPaginationNum);
    
    try{
        _table.find("tfoot").remove();
    }
    catch(err){
        console.log(err);
    }

    _tableRows.hide();
    _tableRows.slice(rowStart, rowEnd).show();

    // GENERATE PAGINATION
    var tfoot = '<tfoot>';
    tfoot += '<tr>';
    tfoot += '<td class="nsm-pagination" colspan="' + _tableColCount + '">';
    tfoot += '<nav class="nsm-table-pagination">';
    tfoot += '<ul class="pagination">';
    tfoot += '<li class="page-item"><a class="page-link prev ' + prevIsDisabled + '" href="javascript:void(0);">Prev</a></li>';
    
    $.each(paginationPages, function(i, obj){
        if(obj <= numberOfPages){
            var isActive = obj == page ? "active" : "";
            tfoot += '<li class="page-item"><a class="page-link ' + isActive + '" href="javascript:void(0);">' + obj + '</a></li>';
        }
    });

    tfoot += '<li class="page-item"><a class="page-link next ' + nextIsDisabled + '" href="javascript:void(0);">Next</a></li>';
    tfoot += '</ul>';
    tfoot += '</nav>';
    tfoot += '</tr>';
    tfoot += '</tfoot>';
    _table.append(tfoot);
}

function getPaginationPages(page, length){
    let start = parseInt(page) > 1 ? parseInt(page) - 1 : parseInt(page);

    if(parseInt(page) - 2 > 0)
        start = parseInt(page) - 2;

    if(parseInt(page) - 3 > 0)
        start = parseInt(page) - 3;

    return Array.from({ length: length}, (_, i) => start + (i));
}

function tableSearch(_this){
    let text = _this.val().toLowerCase().trim();
    let table = _this.attr("for") != undefined && _this.attr("for") != "" ? $("#"+_this.attr("for")) : _this.closest(".nsm-page-content").find(".nsm-table");
    let tableContent = table.find("tbody tr");
    let colspan = table.find("thead tr:first-child td").length;
    let count = 0;

    table.find("tbody .nsm-noresult").remove();
    tableContent.each(function(idx){
        let _row = $(this);
        let target = _row.find(".nsm-text-primary").text().toLowerCase().trim();
        
        _row.toggle(target.indexOf(text) !== -1);

        if(target.indexOf(text) !== -1)
            count++;
    });

    if(count == 0){
        let emptyPlaceholder = '<tr class="nsm-noresult"><td colspan="'+colspan+'"><div class="nsm-empty"><span>No results found.</span></div></td></tr>';
        table.find("tbody").append(emptyPlaceholder);
    }
}