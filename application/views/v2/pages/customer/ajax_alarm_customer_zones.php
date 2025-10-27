<style>
.btn-delete-row-zone-input{
    margin-left:4px;
}
</style>
<hr />
<div class="mt-4 mb-4 d-block">
    <div class="d-block mb-4">
        <span style="font-size:18px; font-weight:bold;" class="d-block mb-4">Zone Information</span>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 grid-mb">
            <div class="nsm-field-group search">
                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_zone_field" for="tbl-alarm-zones" placeholder="Search Zones">
            </div>
        </div>
        <div class="col-12 col-md-8 grid-mb text-end">
            <div class="dropdown d-inline-block">
                <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                    <span id="num-checked"></span> With Selected  <i class='bx bx-fw bx-chevron-down'></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item btn-with-selected" id="with-selected-delete-zones" href="javascript:void(0);" data-action="delete">Delete</a></li>                                
                </ul>
            </div>

            <div class="nsm-page-buttons" style="display:inline-block !important;">  
                <div class="btn-group">
                    <button type="button" class="btn btn-nsm" id="btn-add-zone"><i class='bx bx-plus' style="position:relative;top:1px;"></i> Zone</button>
                    <button type="button" class="btn btn-nsm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class=""><i class='bx bx-chevron-down' ></i></span>
                    </button>
                    <ul class="dropdown-menu">                                 
                        <li><a class="dropdown-item" id="btn-export-zone-list" href="javascript:void(0);">Export</a></li>                               
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nsm-page">
    <div class="nsm-page-content">
        <form id="frm-with-selected">
            <table class="nsm-table w-100" id="tbl-alarm-zones">
                <thead>
                    <tr>
                        <td class="table-icon text-center sorting_disabled show">
                            <input class="form-check-input select-all table-select" type="checkbox" name="id_selector" value="0" id="select-all">
                        </td>
                        <td class="show" data-name="Zone ID">Zone ID</td>
                        <td class="show" data-name="Zone Type">Type</td>
                        <td class="show" data-name="Event Code">Event Code</td>
                        <td class="show" data-name="Location">Location</td>
                        <td class="show" data-name="Manage" style="width:5%;"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if( $alarmZones ){ ?>
                        <?php foreach( $alarmZones as $zone ){ ?>
                            <tr>
                                <td class="show">
                                    <input class="form-check-input row-select table-select" name="alarmZones[]" type="checkbox" value="<?= $zone->id; ?>">
                                </td>
                                <td class="fw-bold show nsm-text-primary"><?= $zone->zone_id; ?></td>
                                <td class="show"><?= $zone->type; ?></td>
                                <td class="show"><?= $zone->event_code; ?></td>
                                <td class="show"><?= $zone->location; ?></td>
                                <td class="show">     
                                    <div class="dropdown table-management">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-dots-vertical-rounded'></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-zone-item" href="javascript:void(0);" data-id="<?= $zone->id; ?>">Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item delete-zone-item" href="javascript:void(0);" data-id="<?= $zone->id; ?>" data-value="<?= $zone->zone_id; ?>">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </form>
    </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-create-zone" tabindex="-1" aria-labelledby="modal-create-zone_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <input type="hidden" id="customer-esign" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_cc_label">Add Zones</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-save-zones">
                        <input type="hidden" name="customer_id" value="<?= $customer_id; ?>" />
                        <div class="d-flex justify-content-end mb-4">
                            <button type="button" class="nsm-button btn-small default" id="btn-add-more-zone-row">Add More</button>
                        </div>                    
                        <div id="zone-inputs-container" class="d-block">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Zone ID</label>
                                        <input type="text" class="form-control" name="zone_id[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="zone_type[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Event Code</label>
                                        <input type="text" class="form-control" name="zone_event_code[]" value="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Location</label>
                                        <input type="text" class="form-control" name="zone_location[]" value="" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-save-zones" form="frm-save-zones">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-edit-zone" tabindex="-1" aria-labelledby="modal-edit-zone_label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title" id="edit_cc_label">Edit Zone</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <form id="frm-update-zones">
                        <input type="hidden" name="zid" id="zone-id" value="" />
                        <div id="edit-zone-container"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="nsm-button primary" id="btn-update-zones" form="frm-update-zones">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
    $("#tbl-alarm-zones").nsmPagination();

    $("#search_zone_field").on("input", debounce(function() {
        tableSearch($(this));
    }, 1000));

    $(document).on('change', '#select-all', function(){
        $('tr:visible .row-select:checkbox').prop('checked', this.checked);  
        let total= $('#tbl-alarm-zones tr:visible input[name="alarmZones[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $(document).on('change', '.row-select', function(){
        let total= $('#tbl-alarm-zones input[name="alarmZones[]"]:checked').length;
        if( total > 0 ){
            $('#num-checked').text(`(${total})`);
        }else{
            $('#num-checked').text('');
        }
    });

    $('#btn-export-zone-list').on('click', function(){
        location.href = base_url + 'customer/export_zones_list/<?= $customer_id; ?>';
    });

    $('#btn-add-zone').on('click', function(){
        $('#modal-create-zone').modal('show');
    });

    $('.edit-zone-item').on('click', function(){
        let zone_id = $(this).attr('data-id');

        $('#zone-id').val(zone_id);
        $('#modal-edit-zone').modal('show');

        $.ajax({
            url: base_url + 'customer/_edit_alarm_zone',
            type: "POST",            
            data: {zone_id:zone_id},
            success: function(html) {
                $('#edit-zone-container').html(html);
            },
            beforeSend: function() {
                $('#edit-zone-container').html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#btn-add-more-zone-row').on('click', function(){
        let container = $('#zone-inputs-container');

        let row_inputs = `
            <div class="row">
                <div class="col-12 col-md-12"><hr /></div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Zone ID</label>
                        <input type="text" class="form-control" name="zone_id[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Type</label>
                        <input type="text" class="form-control" name="zone_type[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Event Code</label>
                        <input type="text" class="form-control" name="zone_event_code[]" value="" placeholder="">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="form-group mb-3">
                        <label>Location</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="zone_location[]" value="" placeholder="">
                            <div class="input-group-append">
                                <button class="btn-delete-row-zone-input nsm-button default"><i class='bx bx-trash'></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.append(row_inputs);
    });

    $(document).on('click', '.btn-delete-row-zone-input', function(){
        $(this).closest('.row').remove();
    });
});
</script>