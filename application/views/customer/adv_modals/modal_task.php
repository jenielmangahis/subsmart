<div class="modal fade" id="modal_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="task_form">
                <div class="modal-body">
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Task Type</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <select id="task_type" name="task_type" data-customer-source="dropdown" class="form-control" >
                                    <option value="General">General</option>
                                    <option value="Billing">Billing</option>
                                    <option value="Send Invoice">Send Invoice</option>
                                    <option value="Follow Up">Follow Up</option>
                                    <option value="Appointment">Appointment</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Subject</label><span class="required"> *</span>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="subject" id="subject" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Due Date</label>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control date_picker" name="due_date" id="due_date" />
                                    </div>
                                    <div class="col-md-6">
                                        <select id="due_time" name="due_time" class="form-control">
                                            <option value="00:00:00" selected="selected"></option>
                                            <option value="00:00:00">12:00 am</option>
                                            <option value="00:30:00">12:30 am</option>
                                            <option value="01:00:00">1:00 am</option>
                                            <option value="01:30:00">1:30 am</option>
                                            <option value="02:00:00">2:00 am</option>
                                            <option value="02:30:00">2:30 am</option>
                                            <option value="03:00:00">3:00 am</option>
                                            <option value="03:30:00">3:30 am</option>
                                            <option value="04:00:00">4:00 am</option>
                                            <option value="04:30:00">4:30 am</option>
                                            <option value="05:00:00">5:00 am</option>
                                            <option value="05:30:00">5:30 am</option>
                                            <option value="06:00:00">6:00 am</option>
                                            <option value="06:30:00">6:30 am</option>
                                            <option value="07:00:00">7:00 am</option>
                                            <option value="07:30:00">7:30 am</option>
                                            <option value="08:00:00">8:00 am</option>
                                            <option value="08:30:00">8:30 am</option>
                                            <option value="09:00:00">9:00 am</option>
                                            <option value="09:30:00">9:30 am</option>
                                            <option value="10:00:00">10:00 am</option>
                                            <option value="10:30:00">10:30 am</option>
                                            <option value="11:00:00">11:00 am</option>
                                            <option value="11:30:00">11:30 am</option>
                                            <option value="12:00:00">12:00 pm</option>
                                            <option value="12:30:00">12:30 pm</option>
                                            <option value="13:00:00">1:00 pm</option>
                                            <option value="13:30:00">1:30 pm</option>
                                            <option value="14:00:00">2:00 pm</option>
                                            <option value="14:30:00">2:30 pm</option>
                                            <option value="15:00:00">3:00 pm</option>
                                            <option value="15:30:00">3:30 pm</option>
                                            <option value="16:00:00">4:00 pm</option>
                                            <option value="16:30:00">4:30 pm</option>
                                            <option value="17:00:00">5:00 pm</option>
                                            <option value="17:30:00">5:30 pm</option>
                                            <option value="18:00:00">6:00 pm</option>
                                            <option value="18:30:00">6:30 pm</option>
                                            <option value="19:00:00">7:00 pm</option>
                                            <option value="19:30:00">7:30 pm</option>
                                            <option value="20:00:00">8:00 pm</option>
                                            <option value="20:30:00">8:30 pm</option>
                                            <option value="21:00:00">9:00 pm</option>
                                            <option value="21:30:00">9:30 pm</option>
                                            <option value="22:00:00">10:00 pm</option>
                                            <option value="22:30:00">10:30 pm</option>
                                            <option value="23:00:00">11:00 pm</option>
                                            <option value="23:30:00">11:30 pm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Client</label>
                            </div>
                            <div class="col-md-8">
                                <?= isset($profile_info) ? $profile_info->first_name.' '.$profile_info->last_name : '' ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Assign to: <span class="required"> *</span></label>
                            </div>
                            <div class="col-md-8">
                                <select id="assign_to" name="assign_to"  class="form-control" required>
                                    <option value="">Select</option>.l
                                    <?php foreach ($users as $user): ?>
                                        <option <?php if(isset($office_info)){ echo $office_info->assign_to ==  $user->id ? 'selected' : ''; } ?> value="<?= $user->id; ?>"><?= $user->FName.' '.$user->LName; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-line">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Notes: </label>
                            </div>
                            <div class="col-md-8">
                                <textarea type="text" class="form-controls" name="notes" id="notes" cols="40" rows="5"> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="fk_prof_id" id="fk_prof_id" value="<?= isset($profile_info) ? $profile_info->prof_id : '' ?>" />
                <input type="hidden" class="form-control" name="task_id" id="task_id" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>