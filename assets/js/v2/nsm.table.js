$(document).ready(function(){
    let _table = $(".nsm-table");
    let _headCols = _table.find("thead td");
    let _bodyRows = _table.find("tbody tr:not(.nsm-row-collapse)");
    let withIcon = _table.find("thead td:first-child").hasClass("table-icon");

    if(isMobileView()){
        $.each(_bodyRows, function(idx, obj){
            let _this = $(this);
            let rowCollapse = '';
            let colspan = _this.find("td").length;
            let headColIndex = 1;
            
            _this.find("td:nth-child(1)").addClass("show");

            if(withIcon){
                _this.find("td:nth-child(1)").addClass("table-icon");
                _table.find("thead td:nth-child(1)").addClass("table-icon");

                _table.find("thead td:nth-child(1)").addClass("show");
                _table.find("thead td:nth-child(2)").addClass("show");
                _this.find("td:nth-child(2)").addClass("show");
                _this.find("td:nth-child(2)").append("<i class='bx bx-chevron-down'></i>");
                headColIndex = 2;
            }
            else{
                _table.find("thead td:nth-child(1)").addClass("show");
                _this.find("td:nth-child(1)").append("<i class='bx bx-chevron-down'></i>");
                headColIndex = 1;
            }

            _this.find("td.show").attr("data-bs-toggle", "collapse");
            _this.find("td.show").attr("data-bs-target", "#table_row_" + idx);

            rowCollapse = '<tr class="nsm-row-collapse collapse" id="table_row_'+idx+'">';
            rowCollapse += '<td colspan="'+colspan+'">';

            $.each(_this.find("td:not(.show)"), function(tdIdx, tdObj){
                rowCollapse += '<div class="row">';
                rowCollapse += '<div class="col-12 col-sm-2">';
                rowCollapse += '<label class="content-subtitle fw-bold">' + _headCols.eq(tdIdx+headColIndex).data("name") + ':</label>';
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

    $(".nsm-row-collapse").on("show.bs.collapse", function(e){
        isMobileView() ? $(this).prev().find(".bx-chevron-down").css("transform", "rotate(180deg)") : e.preventDefault();
    });

    $(".nsm-row-collapse").on("hide.bs.collapse", function(e){
        $(this).prev().find(".bx-chevron-down").css("transform", "rotate(0deg)");
    });
});

function isMobileView(){
    return windowWidth < mobileWidth;
}

function getCollapsedColumns(_this){
    let _dropdown = _this.find(".dropdown");
    let _html = _this.html();

    if(_dropdown.length > 0){
        let _links = _dropdown.find("ul a");
        let buttons = '';

        $.each(_links, function(idx, obj){
            _linkObj = $(this);
            _linkObj.removeClass("dropdown-item");
            classStr = _linkObj.attr("class") + " nsm-button btn-sm m-0 me-2"
            redirectUrl = _linkObj.attr("href");
            extraAttrs = '';

            $.each(obj.attributes, function(){
                if(this.specified){
                    attrValue = this.value;

                    if(this.name == "class")
                        attrValue = "nsm-button btn-sm m-0 me-2 " + this.value;
                    
                    extraAttrs += " " + this.name + '="' + attrValue + '"'; 
                }
            });
            
            _link = '<a role="button" '+extraAttrs+'>'+$(this).html()+'</a>'
            buttons += _link;
        });
        
        _html = buttons;
    }

    return _html;
}