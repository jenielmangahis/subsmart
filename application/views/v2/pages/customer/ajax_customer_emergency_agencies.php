<style>
.btn-delete-row-emergency-agency-input{
    margin-left:4px;
}
#tbl-emergency-agencies{
    width:125%;
}
@media only screen and (max-width: 600px) {
    #tbl-emergency-agencies {
        width:220% !important;
    }
}

</style>
<hr />
<div class="mt-4 mb-4 d-block">
    <div class="d-block mb-4">
        <span style="font-size:18px; font-weight:bold;" class="d-block mb-4">Emergency Agencies</span>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 grid-mb">
            <div class="nsm-field-group search">
                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_emergency_agencies_field" for="tbl-emergency-agencies" placeholder="Search Agency">
            </div>
        </div>
        <div class="col-12 col-md-8 grid-mb text-end">
            <div class="dropdown d-inline-block">
                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item btn-with-selected" id="with-selected-delete-amergency-agencies" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                </ul>
            </div>

            <div class="nsm-page-buttons" style="display:inline-block !important;">  
                <div class="btn-group">
                    <button type="button" class="btn btn-nsm" id="btn-add-emergency-agency"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Agency</button>
                    <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class=""><i class='bx bx-chevron-down' ></i></span>
                    </button>
                    <ul class="dropdown-menu">                                 
                        <li><a class="dropdown-item" id="btn-export-emergency-agency-list" href="javascript:void(0);">Export</a></li>                               
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form id="frm-with-selected">
        <div style="overflow-x: auto;">
            <table class="nsm-table table-responsive" id="tbl-emergency-agencies">
                <thead>
                    <tr>
                        <td class="show table-icon text-center sorting_disabled">
                            <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                        </td>
                        <td class="show" data-name="Agency">Agency</td>
                        <td class="show" data-name="Agency Phone">Agency Phone</td>
                        <td class="show" data-name="Agency Name">Agency Name</td>
                        <td class="show" data-name="Permit Number">Permit Number</td>
                        <td class="show" data-name="Permit Exp">Permit Exp</td>
                        <td class="show" data-name="Effective Date">Effective Date</td>
                        <td class="show" data-name="Manage" style="width:5%;"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if( $emergencyAgencies ){ ?>
                        <?php foreach( $emergencyAgencies as $ea ){ ?>
                            <tr>
                                <td class="show">
                                    <input class="show form-check-input row-select table-select" name="emergencyAgencies[]" type="checkbox" value="<?= $ea->id; ?>">
                                </td>
                                <td class="show fw-bold nsm-text-primary"><?= $ea->agency; ?></td>
                                <td class="show"><?= $ea->agency_phone; ?></td>
                                <td class="show"><?= $ea->agency_name; ?></td>
                                <td class="show"><?= $ea->permit_number; ?></td>
                                <td class="show"><?= date("m/d/Y",strtotime($ea->permit_exp)); ?></td>
                                <td class="show"><?= date("m/d/Y",strtotime($ea->effective_date)); ?></td>
                                <td class="show">
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-emergency-agency-item" href="javascript:void(0);" data-id="<?= $ea->id; ?>">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-emergency-agency-item" href="javascript:void(0);" data-id="<?= $ea->id; ?>" data-value="<?= $ea->agency_name; ?>">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>

    <div class="modal fade nsm-modal fade" id="modal-create-emergency-agencies" tabindex="-1" aria-labelledby="modal-create-emergency-agencies_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <input type="hidden" id="customer-esign" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_ea_label">Add Emergency Agencies</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-save-emergency-agencies">
                        <input type="hidden" name="customer_id" value="<?= $customer_id; ?>" />
                        <div class="d-flex justify-content-end mb-4">
                            <button type="button" class="nsm-button btn-small default" id="btn-add-more-emergency-agency-row">Add More</button>
                        </div>                    
                        <div id="emergency-agencies-inputs-container" class="d-block">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Agency</label>
                                        <input type="text" class="form-control" name="agency[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Agency Phone</label>
                                        <input type="text" class="form-control agency_phone_number" maxlength="12" name="agency_phone[]" value="" placeholder="xxx-xxx-xxxx">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Agency Name</label>
                                        <input type="text" class="form-control" name="agency_name[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Permit Number</label>
                                        <input type="text" class="form-control" name="permit_number[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Permit Exp</label>
                                        <input type="date" class="form-control" name="permit_exp[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Effective Date</label>
                                        <input type="date" class="form-control" name="effective_date[]" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-emergency-agencies" form="frm-save-emergency-agencies">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-emergency-agency" tabindex="-1" aria-labelledby="modal-edit-emergency-agency_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_ea_label">Edit Emergency Agency</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-update-emergency-agency">
                        <input type="hidden" name="eaid" id="agency-id" value="" />
                        <div id="edit-emergency-agency-container"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-update-emergency-agency" form="frm-update-emergency-agency">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#tbl-emergency-agencies").nsmPagination();

    $("#search_emergency_agencies_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
        let total= $('#tbl-emergency-agencies tr:visible input[name="emergencyAgencies[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('.agency_phone_number').keydown(function(e) {
        var key = e.charCode || e.keyCode || 0;
        $text = $(this);
        if (key !== 8 && key !== 9) {
            if ($text.val().length === 3) {
                $text.val($text.val() + '-');
            }
            if ($text.val().length === 7) {
                $text.val($text.val() + '-');
            }
        }
        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#tbl-emergency-agencies input[name="emergencyAgencies[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-export-emergency-agency-list').on('click', function(){
        location.href = base_url + 'customer/export_emergency_agency_list/<?= $customer_id; ?>';
    });

    $('#btn-add-emergency-agency').on('click', function(){
        $('#modal-create-emergency-agencies').modal('show');
    });

    $('.edit-emergency-agency-item').on('click', function(){
        let agency_id = $(this).attr('data-id');

        $('#agency-id').val(agency_id);
        $('#modal-edit-emergency-agency').modal('show');

        $.ajax({
            url: base_url + 'customer/_edit_emergency_agency',
            type: "POST",            
            data: {agency_id:agency_id},
            success: function(html) {
                $('#edit-emergency-agency-container').html(html);
            },
            beforeSend: function() {
                $('#edit-emergency-agency-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#btn-add-more-emergency-agency-row').on('click', function(){
        let container = $('#emergency-agencies-inputs-container');

        let row_inputs = `
            <div class="row mt-2">
                <div class="col-12"><hr /></div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Agency</label>
                        <input type="text" class="form-control" name="agency[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Agency Phone</label>
                        <input type="text" class="form-control agency_phone_number" maxlength="12" name="agency_phone[]" value="" placeholder="xxx-xxx-xxxx">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Agency Name</label>
                        <input type="text" class="form-control" name="agency_name[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Permit Number</label>
                        <input type="text" class="form-control" name="permit_number[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Permit Exp</label>
                        <input type="date" class="form-control" name="permit_exp[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Effective Date</label>
                         <div class="input-group mb-3">
                            <input type="date" class="form-control" name="effective_date[]" value="" placeholder="">
                            <div class="input-group-append">
                                <button class="btn-delete-row-emergency-agency-input nsm-button default"><i class='bx bx-trash'></i></button>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        `;

        container.append(row_inputs);

        $('.agency_phone_number').keydown(function(e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }
            }
            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    });

    $(document).on('click', '.btn-delete-row-emergency-agency-input', function(){
        $(this).closest('.row').remove();
    });
});
</script>