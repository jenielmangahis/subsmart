<div class="card">
    <div class="card-body hid-desk" style="padding-bottom:0px;">
        <div class="col-lg-12">
            <div> <b>Internal notes: not seen by client</b> (<?= isset($profile_info) ?  $profile_info->first_name.' '.$profile_info->last_name : '';  ?>) </div>


            <div class="float-right d-md-block">
                <div class="dropdown">
                    <a class="btn btn-primary btn-md" href="#"><span class="fa fa-plus"></span> Add Internal Notes</a>
                </div>
            </div>

            <br> <br>
            <table class="table table-hover" id="internal_notes_table">
                <thead>
                <tr>
                    <th >Date</th>
                    <th>Note</th>
                    <th>Added By</th>
                    <th>Attach</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php //foreach ($profiles as $customer) : ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                            <img src="/assets/img/customer/actions/ac_edit.png" width="16px" height="16px" border="0" title="Edit Customer">
                        </a>
                        <a href="javascript:void(0);" id="" class="delete_lead" style="text-decoration:none;display:inline-block;" title="Edit Customer">
                            <img src="/assets/img/customer/actions/cross.png" width="16px" height="16px" border="0" title="Delete Lead">
                        </a>
                    </td>
                </tr>
                <?php //endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>