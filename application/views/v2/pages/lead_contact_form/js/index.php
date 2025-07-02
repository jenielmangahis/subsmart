<script>
$(function(){
    $('#popover-custom-form-fields').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Select the fields that will be part of the form and required ones.';
        } 
    });

    $('#popover-custom-form-appearance').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Change the color and size of the font.';
        } 
    });

    $('#popover-custom-form-notification').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Select how you want to be notified on a new inquiry.';
        } 
    });

    $('#popover-custom-form-google-analytics').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Optionally you can enable Google Analytics for this widget. Google analytics tracking is the unique id set on your Google tracking code. e.g. UA-12345-1.';
        } 
    });

    $('#popover-custom-form-snippet-code').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Copy paste code and have your form embed to your site.';
        } 
    });

    $('#btn-add-new-custom-field').on('click', function(){
        $('#modal-add-custom-field').modal('show');
    });
    
});
</script>