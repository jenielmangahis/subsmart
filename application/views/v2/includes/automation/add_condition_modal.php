<div class="modal fade" id="addCondition" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addSmsLabel" aria-hidden="true" style="background-color: #58585821;">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
           
            <div class="modal-body">
                <div class="row h-100">
                    <form id='conditionForm'>
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <select id="conditionSelect" class="form-select" placeholder="Select Property">
                                    <option value="" disabled selected>Select Property</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="btn-group operator-btns d-flex w-100 mr-2 mb-3" role="group" aria-label="First group">
                                <button type="button" class="btn nsm-button-outlined primary fw-bold" data-value="=">= is</button>
                                <button type="button" class="btn nsm-button-outlined primary fw-bold" data-value="!=">!= is</button>
                                <button type="button" class="btn nsm-button-outlined primary fw-bold" data-value=">">> greater</button>
                                <button type="button" class="btn nsm-button-outlined primary fw-bold" data-value="<">< less</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group mb-3 cond-value-select-container">
                                <select id="conditionValueSelect" class="form-select" placeholder="Select Property">
                                    <option value="" disabled selected>Select Property</option>
                                  
                                </select>
                            </div>

                            <div class="input-group mb-3 cond-value-amount-container d-none">
                                <div class="nsm-field-group icon-right">
                                    <input type="number" class="nsm-field form-control mb-2" >
                                </div>
                            </div>
                        </div>

                         <div class="col-12  d-flex justify-content-end align-items-center">
                            <h6 class="nsm-text primary cursor-pointer fw-bold or-condition">
                                <i class="bx bx-fw bx-plus primary"></i> Add 'or' condition
                            </h6>
                        </div>

                        <div class="col-12 ">
                            <label class="mb-1 fw-xnormal ">Only if...</label>
                            <div class="list-condition">

                            </div>
                        </div>
                    
                       
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="conditionForm" class="nsm-button primary">
                    <i class='bx bx-fw bx-check'></i> Apply
                </button>
            </div>
        </div>
    </div>
</div>