<div class="modal fade" id="addEmail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addEmailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title nsm-text">Email Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <form id='emailForm'>
                        <div class="col-12 ">
                            <label class="mb-1 fw-xnormal">Subject</label>
                            <div class="input-group">
                                <div class="input-group">
                                    <input name="subject" class="form-control mt-0" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="mb-1 fw-xnormal">From</label>
                            <div class="input-group mb-3">
                                <div class="input-group">
                                    <input name="sender" class="form-control mt-0" type="email" value="<?php echo logged('email'); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="mb-1 fw-xnormal">Smart Tags</label>
                            <div class="input-group mb-3">
                                <select id="smartTags" class="form-select">
                                    <option value="" disabled selected>Insert Smart Tag</option>
                                    <optgroup label="Client">
                                        <option value="{first_name}">First Name</option>
                                        <option value="{last_name}">Last Name</option>
                                        <option value="{email}">Email</option>
                                        <option value="{company_name}">Company Name</option>
                                        <option value="{mail_add}">Billing Address</option>
                                        <option value="{phone_h}">Phone</option>
                                    </optgroup>
                                    
                                    
                                    <optgroup label="Business">
                                        <option value="{business_name}">Business Name</option>
                                        <option value="{business_address}">Business Address</option>
                                    </optgroup>
                                    
                                    <optgroup label="Job">
                                        <option value="{job_number}">Job Number</option>
                                        <option value="{job_location}">Job Location</option>
                                        <option value="{job_type}">Job Type</option>
                                        <option value="{job_description}">Job Description</option>
                                        <option value="{start_time}">Job Start Time</option>
                                        <option value="{end_time}">Job End Time</option>
                                        <option value="{amount}">Job Total</option>
                                        <option value="{status}">Job Status</option>
                                        <option value="{techs}">Assigned Techs</option>
                                    </optgroup>
                                  

                                </select>
                                <button type="button" class="btn btn-primary" id="insertTagButton">Insert</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="message" id="automation_msg" cols="30" rows="2" class="form-control ckeditor"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="emailForm" class="nsm-button primary">
                    <i class='bx bx-fw bx-check'></i> Save and close
                </button>
            </div>
        </div>
    </div>
</div>