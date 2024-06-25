<style>
.dataTables_filter, .dataTables_length{
    display: none;
}
</style>
<?php if( $emailTemplates ){ ?>
    <div class="form-group">
        <input type="text" class="nsm-field nsm-search form-control mb-2" id="email-template-search" placeholder="Search Template..." style="width:100%;">
    </div>
    <table class="nsm-table w-100" id="email-template-list">
        <thead>
            <tr>
                <td style="width:5%;"></td>                
                <td>Template Name</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emailTemplates as $template) { ?>
                <tr>
                    <td style="width:5%;">
                        <div class="table-row-icon">
                            <i class='bx bx-envelope'></i>
                        </div>
                    </td>
                    <td><b><?= $template->title; ?></b></td>
                    <td>
                        <div class="dropdown table-management">
                            <a href="#" name="dropdown_link" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item btn-use-template" href="javascript:void(0);" data-id="<?= $template->id; ?>">Use</a></li>
                                <li><a class="dropdown-item btn-view-template" href="javascript:void(0);" data-subject="<?= $template->subject; ?>" data-id="<?= $template->id; ?>">View</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php } ?>            
        </tbody>
    </table>
<?php }else{ ?>
    <div class="nsm-empty">
        <span>No results found.</span>
    </div>
<?php } ?>
<script>
$(function(){
    <?php if( $emailTemplates ){ ?>
    var emailTemplateListTable = $("#email-template-list").DataTable({
        "ordering": false,
        "info": false,
        language: {
            processing: '<span>Fetching data...</span>'
        },
    });

    $("#email-template-search").keyup(function() {
        emailTemplateListTable.search($(this).val()).draw()
    });
    <?php } ?>
});
</script>