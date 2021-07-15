<!-- Modal for bank deposit-->
<div class="full-screen-modal">
    <div id="successPrintCheck" class="modal fade modal-fluid d-flex" role="dialog">
        <div class="modal-dialog" style="width: 30%; height: 30%; margin: auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Did your checks print OK?</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="card p-0 m-0" style="min-height: 100%">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="print_check_status" id="print-ok" value="ok" checked>
                                                <label class="form-check-label" for="print-ok">Yes, they all printed correctly</label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="print_check_status" id="print-some" value="some">
                                                <label class="form-check-label" for="print-some">Some checks need reprinting, starting with check:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <select name="print_from" id="starting_check" class="form-control">
                                                <?php foreach($checkNos as $checkNo) : ?>
                                                    <option value="<?=$checkNo?>"><?=$checkNo?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="print_check_status" id="print-no" value="no">
                                                <label class="form-check-label" for="print-no">No, keep all checks in the Print Checks list</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 d-flex">
                            <button type="submit" class="btn btn-success m-auto">Done</button>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</div>