<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Tags</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Tags are customizable labels that let you track your money however you want. When you put tags into groups, you get deeper insights into how your business is doing. You'll need groups to get reports for your tags. You can tag transactions such as invoices, expenses and bills.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                                    <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                                    <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                                    <a href="<?php echo url('/accounting/tags')?>" class="banking-tab-active text-decoration-none">Tags</a>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6"><a href="#">See all untagged transactions</a></div>
                                        <div class="col-md-6" style="text-align: right">
                                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                                <button style="padding:6px 30px" type="button" class="btn btn-success" data-toggle="dropdown"><span>New</span>&nbsp;&nbsp;<span class="fa fa-caret-down"></span></button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#createTagGroup" >Tag Group</a></li>
                                                    <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#createTag">Tag</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--                        DataTables-->
                                    <table id="rules_table" class="table table-bordered mt-5" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>TAGS AND TAG GROUPS</th>
                                                <th>TRANSACTIONS</i></th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody class="displayRules">
                                        <?php foreach ($tags as $tKey => $tag) : ?>
                                            <tr>
                                                <td>
                                                    <?php if(isset($tag['tags']) && !empty($tag['tags'])) : ?>
                                                        <h5 class="d-inline-block mr-5 <?= isset($tag['tags']) && !empty($tag['tags']) ? 'cursor-pointer' : '' ?>" data-toggle="collapse" data-target="#child-<?= $tKey ?>" data-parent="#rules_table"><i class="fa fa-chevron-circle-down"></i></h5>
                                                    <?php endif; ?>
                                                        <span class="<?= $tag['type']?>-span-<?= $tag['id'] ?>">
                                                            <?= $tag['name'] ?> <?= isset($tag['tags']) && !empty($tag['tags']) ? "(".count($tag['tags']).")" : "" ?>
                                                        </span>
                                                    <?php if($tag['type'] == "group") : ?>
                                                        <div class="form-group-<?= $tag['id'] ?> hide">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="group_name" value="<?= $tag['name'] ?>" data-id="<?= $tag['id'] ?>" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-success" id="submiteUpdateTag" data-type="group" data-id="<?= $tag['id'] ?>">Save</button>
                                                                    <button type="button" class="close float-right text-light" data-type="group" id="closeFormTag" data-id="<?= $tag['id'] ?>" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="form-tag-<?= $tag['id'] ?> hide">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" name="tags_name" value="<?= $tag['name'] ?>" data-id="<?= $tag['id'] ?>" class="form-control">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button class="btn btn-success" id="submiteUpdateTag" data-type="tag" data-id="<?= $tag['id'] ?>">Save</button>
                                                                    <button type="button" class="close float-right text-light" data-type="tag" id="closeFormTag" data-id="<?= $tag['id'] ?>" style="transform: translate(0px, -15px);"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <?php if($tag['type'] == "group") : ?>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                                                            <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                <span class="fa fa-caret-down"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" data-id="<?= $tag['id'] ?>" data-type="group">
                                                                <li><a href="javascript:void(0);" id="addNewTag" class="dropdown-item" >Add tag</a></li>
                                                                <li><a href="javascript:void(0);" id="updateTagGroup" class="dropdown-item">Edit group</a></li>
                                                                <li><a href="javascript:void(0);" id="deleteGroup" class="dropdown-item">Delete group</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                                                            <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                <span class="fa fa-caret-down"></span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right" data-id="<?= $tag['id'] ?>" data-type="tag">
                                                                <li><a href="javascript:void(0);" class="dropdown-item" id="updateTagGroup">Edit tag</a></li>
                                                                <li><a href="javascript:void(0);" class="dropdown-item" id="deleteTag" data-tag_id="<?= $tag['id'] ?>">Delete tag</a></li>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php if (isset($tag['tags'])) : ?>
                                                <?php foreach ($tag['tags'] as $groupTag) : ?>
                                                    <tr id="child-<?= $tKey ?>" class="collapse bg-muted">
                                                        <td colspan="2"><?= $groupTag['name'] ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;">Run report</button>
                                                                <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                                                    <span class="fa fa-caret-down"></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li><a href="#" class="dropdown-item" >Edit tag</a></li>
                                                                    <li><a href="#" class="dropdown-item" data-tag_id="<?= $tag['id'] ?>">Delete tag</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <!--    Modal for creating rules-->
                            <div class="modal-right-side">
                                <div class="modal right fade" id="createTagGroup" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel2" >Create New Group</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                        
                                            <div class="modal-body pt-3">
                                                <!-- <div class="subheader">Rules only apply to unreviewed transactions.</div> -->
                                                    <form class="mb-3" id="tags_group_form">
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
                                                    <table id="tags-group" class="table table-bordered mb-3 hide">
                                                        <tbody></tbody>
                                                    </table>
                                                    <h6>Add tags to this group</h6>
                                                    <form>
                                                        <div class="form-row mb-3">
                                                            <div class="col-md-8">
                                                                <label for="tag_name">Tag name</label>
                                                                <input type="text" name="rules_name" id="tag_name" class="form-control">
                                                            </div>
                                                            <div class="col-md-4 d-flex align-items-end">
                                                                <button class="btn btn-success w-100">Add</button>
                                                            </div>
                                                        </div>
                                                    </form>
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
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Yoga</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
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
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Daniel</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div color="C9007A" class="sc-cbkKFq ilByZK">
                                                                        <div class="sc-krvtoX bjibjm">
                                                                            <div class="sc-fYiAbW etmaub">
                                                                                <span class="sc-fOKMvo sc-dUjcNx hcYmjN">Instructor</span>: 
                                                                                <span class="sc-fOKMvo sc-gHboQg cmJyhn">Maria</span>
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
                                    </div>
                                </div>
                            </div>
                            <!--    end of modal-->


                            <!--    Modal for creating rules-->
                            <div class="modal-right-side">
                                <div class="modal right fade" id="createTag" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="myModalLabel2" >Create New Tag</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="<?php echo site_url()?>accounting/addTags" method="post">
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                            <label for="">Tag name</label>
                                                            <input type="text" name="tag_name" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Group</label>
                                                        <select class="form-control" name="group_id" id="exampleFormControlSelect1">
                                                            <option></option>
                                                            <?php foreach ($tagsGroup as $group): ?>
                                                            <option value="<?= $group['id'] ?>"><?= $group['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--    end of modal-->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

            <div class="row"></div>


        </div>
        <!-- end container-fluid -->
    </div>
</div>

<div class="append-edit-account"></div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    //dropdown checkbox
    var expanded = false;
    function showCheckboxes() {
        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }
    //DataTables JS
    $(document).ready(function() {
        $('#rules_table').DataTable({
            searching:false,
            paging:false,
            ordering:false,
            language: {
                emptyTable: "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>