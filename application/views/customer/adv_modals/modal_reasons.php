<div class="modal fade" id="modal_reasons" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Manager Reasons</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_reasons">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Reason</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="reason" id="reason_form_id" required/>
                            </div>
                            <div class="col-md-2">
                                <button style="height: 100% !important;padding: 1px 1px 1px 1px !important;width:50px !important;" type="submit" class="btn btn-primary ">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table table-hover" id="reasons_table">
                <thead>
                <tr>
                    <th >Reasons</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reasons as $reason) : ?>
                    <tr>
                        <td><?= $reason->reason; ?></td>
                        <td>
                            <a href="javascript:void(0);" id="<?= $reason->reason_id; ?>" class="delete_reason" style="text-decoration:none;display:inline-block;" title="Delete Reason">
                                <img src="/assets/img/customer/actions/cross.png" width="16" alt="Delete" height="16" border="0" title="Delete Reason">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>