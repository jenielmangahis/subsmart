<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form action="#" method="post" id="modal-form">
    <div id="add-pay-schedule-modal" class="modal fade modal-fluid" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg w-75 m-auto">
            <!-- Modal content-->
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header" style="background: #f4f5f8;border-bottom: 0">
                    <h4 class="modal-title">Add a pay schedule</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body" style="padding-bottom: 1.25rem">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Select when you pay your employees</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group w-50">
                                                        <label for="pay-frequency">Pay frequency</label>
                                                        <select name="pay_frequency" id="pay-frequency" class="form-control">
                                                            <option value="every-week">Every week</option>
                                                            <option value="every-other-week">Every other week</option>
                                                            <option value="twice-month">Twice a month</option>
                                                            <option value="every-month">Every month</option>
                                                        </select>
                                                        <div class="form-check form-check-inline mt-2 hide">
                                                            <label for="custom-schedule" class="form-check-label mr-2">Custom schedule</label><br>
                                                            <input type="checkbox" name="custom_schedule" id="custom-schedule" class="js-switch"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group w-50">
                                                        <label for="next-payday">Next payday</label>
                                                        <input type="text" name="next_payday" id="next-payday" class="form-control datepicker" value="<?=date('m/d/Y', strtotime("friday"))?>">
                                                        <p class="m-0">Friday</p>
                                                    </div>
                                                    <div class="form-group w-50">
                                                        <label for="next-pay-period-end">End of next pay period</label>
                                                        <input type="text" name="next_pay_period_end" id="next-pay-period-end" class="form-control datepicker" value="<?=date('m/d/Y', strtotime("wednesday"))?>">
                                                        <p class="m-0">Wednesday</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name">Pay schedule name</label>
                                                        <input type="text" name="name" id="name" class="form-control w-50" value="Every Friday">
                                                        <div class="form-check form-check-inline mt-2">
                                                            <input type="checkbox" name="use_for_new_employees" id="use-for-new-emps" class="form-check-input" value="1" checked>
                                                            <label for="use-for-new-emps" class="form-check-label">Use this pay schedule for employees you add after this one</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Upcoming pay periods</h6>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0">03/25/2021 - 03/31/2021</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0">04/02/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0">04/01/2021 - 04/07/2021</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0">04/09/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0">04/08/2021 - 04/14/2021</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0">04/16/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card shadow">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            <p>Pay period</p>
                                                                            <p class="m-0">04/15/2021 - 04/21/2021</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <p>Pay date</p>
                                                                            <p class="m-0">04/23/2021</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-secondary">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-secondary btn-rounded border" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <button type="submit" class="btn btn-success float-right">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>