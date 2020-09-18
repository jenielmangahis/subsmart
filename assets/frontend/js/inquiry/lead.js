$(document).ready(function () {
    var count = 0;
    $('input[type=checkbox]').each(function () {
        setCheckboxData($(this));

        $($(this)).click(function() {
            setCheckboxData($(this));
        })
    });

    $("#addFormField").click(function () {
        count += 1;
        $("#customFieldList").append('<li>' +
        '<div class="row">' +
            '<div class="col-sm-6">' +
                '<div class="fields-list__name-cnt">' +
                    '<div class="fields-list__sortable_handle">' +
                        '<span class="fa fa-ellipsis-v"></span>' +
                        '<span class="fa fa-ellipsis-v"></span>' +
                    '</div>' + 
                    '<div class="fields-list__name"><input type="text" class="form-control"></div>' +
                '</div>' +
            '</div>' + 
            '<div class="col-sm-3">' +
                '<div class="checkbox checkbox-sec no-margin pt-2">' + 
                    '<input type="checkbox" id="visible'+ count +'" data-name="add'+ count +'" data-type="visible" data-prefix="pf" true-value="1">' + 
                    '<label for="visible'+ count +'"></label>' +
                '</div>' +
            '</div>' + 
            '<div class="col-sm-3">' +
                '<div class="fields-list__col-last">' +
                    '<div class="checkbox checkbox-sec no-margin pt-2">' + 
                        '<input type="checkbox" id="required'+ count +'" data-name="add_req'+ count +'" data-type="required" data-prefix="pf_req" true-value="1">' + 
                        '<label for="required'+ count +'"></label>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>' +
    '</li>');
    });
});

function setCheckboxData(form) {
    if (form.data('name')) {
        var type = form.data('type');
        var name = form.data('name');
        var prefix = form.data('prefix');
        var id = '#' + type + name;
        
        console.log(id);

        if ($(id).is(":checked")) {
            $("#" + prefix + name).fadeIn();
        } else {
            $("#" + prefix + name).hide();
        }
    }
}
