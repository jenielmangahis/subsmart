<div class="modal-content" id="group-tag-form">
    <div class="modal-header">
        <a href="#" class="text-info" onclick="showTagsList(this)"><i class="fa fa-chevron-left"></i> Back</a>
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times fa-lg"></i></button>
    </div>
    <div class="modal-body pt-3">
        <div class="row">
            <div class="col-12">
                <h5>Create new group</h5>
            </div>
            <div class="col-12">
                <form class="mb-3" id="tags-group-form">
                    <div class="form-row mb-3">
                        <div class="col-md-8">
                            <label for="tag_group_name">Group name</label>
                            <input type="text" name="tags_group_name" id="tag_group_name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">&nbsp;</label>
                            <select id="e2" class="form-control" name="group_color" style="background-color: green; color: white">
                                <option value="green" style="background-color:green">Green</option>
                                <option value="yellow" style="background-color:yellow; color: black">Yellow</option>
                                <option value="red" style="background-color:red">Red</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Save</button>
                </form>
                <table id="tags_group" class="table table-bordered mb-3 hide">
                    <tbody></tbody>
                </table>
                <h6>Add tags to this group</h6>
                <form class="mb-3" id="tags-form">
                    <div class="form-row mb-3">
                        <div class="col-md-8">
                            <label for="tag-name">Tag name</label>
                            <input type="text" name="tag_name" id="tag-name" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-success w-100">Add</button>
                        </div>
                    </div>
                </form>
                <table id="group_tags" class="table table-bordered mb-3 hide">
                    <tbody></tbody>
                </table>
                <hr>
                <div class="form-group">
                    <label for="" style="position: relative;display: inline-block;">Put similar tags in the same group to get better reports. <a href="#">Find out more</a></label>
                    <p><a href="#">Show me examples of groups</a></p>
                </div>
                <div class="form-group modaldivision">
                    <div class="row">
                        <div class="col-md-6">
                            I have a clothing store. I want to see which seasonal collection sells the best.
                            </div>
                            <div class="col-md-6">
                            Group: Collection
                                <div color="C9007A" class="sc-cbkKFq ilByZK">
                                    <div class="sc-krvtoX bjibjm">
                                        <div class="sc-fYiAbW etmaub">
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>: 
                                            <span class="sc-fOKMvo sc-gHboQg cmJyhn">Spring</span>
                                        </div>
                                    </div>
                                </div>
                                <div color="C9007A" class="sc-cbkKFq ilByZK">
                                    <div class="sc-krvtoX bjibjm">
                                        <div class="sc-fYiAbW etmaub">
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Collection</span>: 
                                            <span class="sc-fOKMvo sc-gHboQg cmJyhn">Summer</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group modaldivision">
                    <div class="row">
                        <div class="col-md-6">
                            I run a gym. I want to see which fitness classes and instructors make the most money.
                        </div>
                        <div class="col-md-6">
                            <p>Group: Fitness class</p>
                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                <div class="sc-krvtoX bjibjm">
                                    <div class="sc-fYiAbW etmaub">
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Yoga</span>
                                    </div>
                                </div>
                            </div>
                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                <div class="sc-krvtoX bjibjm">
                                    <div class="sc-fYiAbW etmaub">
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Fitness class</span>: 
                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Rowing</span>
                                    </div>
                                </div>
                            </div>

                            <p>Group: Instructor</p>
                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                <div class="sc-krvtoX bjibjm">
                                    <div class="sc-fYiAbW etmaub">
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Daniel</span>
                                    </div>
                                </div>
                            </div>
                            <div color="C9007A" class="sc-cbkKFq ilByZK">
                                <div class="sc-krvtoX bjibjm">
                                    <div class="sc-fYiAbW etmaub">
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                            <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                        <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                        <span class="sc-fOKMvo sc-gHboQg cmJyhn">Maria</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success" data-dismiss="modal">Done</button>
    </div>
</div>