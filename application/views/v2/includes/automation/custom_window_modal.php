<div class="modal fade" id="addWindow" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addWindowLabel" aria-hidden="true" style="background-color: #58585821;">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
           <div class="modal-header">
                 <h5 class="modal-title nsm-text">Create custom window</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id='windowForm'>
                    <label class="mb-1 fw-xnormal">Modify your automation to a custom time window</label>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <select id="startWindowTime" class="form-select" placeholder="Select Property">
                                    <option value="" disabled selected>Start time</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <select id="endWindowTime" class="form-select" placeholder="Select Property">
                                    <option value="" disabled selected>End time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="windowForm" class="nsm-button primary">
                    <i class='bx bx-fw bx-check'></i> Save
                </button>
            </div>
        </div>
    </div>
</div>