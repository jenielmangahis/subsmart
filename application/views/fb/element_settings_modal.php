<div class="modal fade" id="elementSettingsModal" tabindex="-1" role="dialog" aria-labelledby="elementSettingsModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Element Settings</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form onsubmit="handleSaveEelement(event)" id="elementSettings">
                <div class="modal-body">
                    <ul class="nav nav-pills nav-fill">
                        <li class="nav-item">
                            <a class="nav-link active" href="#elementSettingsTab" data-toggle="tab">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementDefaultValueTab" data-toggle="tab">Default Value</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementInventoryTab" data-toggle="tab">Inventory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#elementCalculationsTab" data-toggle="tab">Calculation</a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <input type="hidden" name="id" id="elementID">
                        <input type="hidden" name="element_type" id="elementType">
                        <input type="hidden" name="element_order" id="elementOrder">
                        <input type="hidden" name="save_method" id="saveMethod">
                        <div class="tab-pane active" id="elementSettingsTab">
                            <div class="container mt-0">
                                <div class="elementPreview"></div>
                                <div tag="question" class="element-setting-container">
                                    <textarea name="elementQuestionInput"id="elementQuestionInput" cols="30" rows="100"
                                        class="form-control" placeholder="Question?"></textarea>
                                    <div class="w-100 d-block text-right">                                    
                                        <a href="#">Enable Text Editor</a>
                                    </div>
                                </div>
                                <div class="w-100 row mt-2" id="elementSettingsChoices">
                                    <div class="col-12 col-md-6 element-setting-container" tag="choices">
                                        <h4>Choices</h4>
                                        <ul class="nav nav-pills nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#addChoicesTab" data-toggle="tab">Add
                                                    Choices</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#editChoicesTab" data-toggle="tab">Edit
                                                    Choices</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#funnelChoicesTab" data-toggle="tab">Funnel
                                                    Choices</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content py-4">
                                            <div class="addChoicesTab">
                                                <textarea name="elementChoicesInput" id="elementChoicesInput" cols="30" rows="10"
                                                    class="form-control h-50"></textarea>
                                                <div class="form-group w-50">
                                                    <label for="preFillChoices">Pre-fill choices:</label>
                                                    <select name="prefillChoices" id="prefillChoices" class="form-control">
                                                        <option value="none">none</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="textarea">
                                        <h4>Textarea</h4>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Size:</label>
                                            <div class="row">
                                                <div class="form-group col-6">
                                                    <label>Columns: </label>
                                                    <input type="number" name="columns" id="columns" class="form-control">                                                
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Rows: </label>
                                                    <input type="number" name="rows" id="rows" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Length:</label>
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <label>Min: </label>
                                                    <input type="number" name="min_char" id="minChar" class="form-control">                                                
                                                </div>
                                                <div class="form-group col-3">
                                                    <label>Max: </label>
                                                    <input type="number" name="max_char" id="maxChar" class="form-control">
                                                </div>
                                                <div class="form-group col-6">
                                                    <label>Unit: </label>
                                                    <select name="limit_unit" id="limitUnit" class="form-control">
                                                        <option value="characters">Characters</option>
                                                        <option value="words">Words</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <p><small><em>Amount of text allowed in the text field.
                                                </em></small></p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 element-setting-container" tag="options">
                                        <h4>Options</h4>
                                        <div class="form-group">
                                            <label for="element_span">Width</label>
                                            <select name="element_span" id="elementSpan" class="form-control">
                                            <option value="2">1</option>
                                                <option value="3">2</option>
                                                <option value="4">3</option>
                                                <option value="6">4</option>
                                                <option value="12">5</option>
                                            </select>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input" id="requiredSwitch">
                                            <label class="custom-control-label" for="requiredSwitch">Required</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input" id="readOnlySwitch">
                                            <label class="custom-control-label" for="readOnlySwitch">Read Only</label>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" data-toggle="switch" class="custom-control-input" id="adminItemSwitch">
                                            <label class="custom-control-label" for="adminItemSwitch">Admin Item</label>
                                        </div>
                                        <p><small><em>Admin Items are not shown when users fill out your form.
                                                </em></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>