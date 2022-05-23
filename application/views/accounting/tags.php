<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                        <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                        <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab">Receipts</a>
                        <a href="<?php echo url('/accounting/tags')?>" class="banking-tab">Tags</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6"><h2>Tags</h2></div>
                            <div class="col-md-6" style="text-align: right">
                                <a href="" style="font-size: 14px;line-height: 40px;">Give Feedback</a>
                            </div>
                        </div>
                        <div class="row" id="div">
                            <div class="col-md-5" id="division">
                                <p>MONEY IN</p>
                                <p>Get more details about what you earn</p>
                                <div class="to-hide-div">
                                    <p>$0.00 Aerobics classes</p>
                                    <!-- <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100" style="width:110%">
                                        </div>
                                    </div> -->
                                    <p>$0.00 Yoga classes</p>
                                    <!-- <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100" style="width:89%">
                                        </div>
                                    </div> --><br>
                                </div>
                                <div class="to-show-div" style="display:none;">
                                    <p>$110.00 Aerobics classes</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100" style="width:110%">
                                        </div>
                                    </div>
                                    <p>$89.00 Yoga classes</p>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                        aria-valuemin="0" aria-valuemax="100" style="width:89%">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div align="center">
                                    <button class="btn btn-success">Start tagging transactions</button>
                                </div>
                            </div>
                            <div class="col-md-5" id="division">
                            <p>MONEY OUT</p>
                            <div class="col-md-3">
                                <select class="form-control">
                                    <option>This month</option>
                                    <option>a</option>
                                    <option>a</option>
                                    <option>a</option>
                                    <option>a</option>
                                </select>
                            </div>
                            
                                <!-- <p>See a breakdown of what you spend</p> -->

                                <h2>$765.00</h2>
                                Total money out

                                <p>$765.00 11</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40"
                                    aria-valuemin="0" aria-valuemax="100" style="width:110%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>


                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6"><a href="#">See all untagged transactions</a></div>
                            <div class="col-md-6" style="text-align: right">
                            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                                    <button type="button" class="btn btn-success" style="border-radius: 36px 0 0 36px;width:100px;">New</button>
                                    <button class="btn btn-success" type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#createTagGroup" >Tag Group</a></li>
                                        <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#createTag">Tag</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                                <!--                        DataTables-->
                                    <table id="rules_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>TAGS AND TAG GROUPS</th>
                                            <th>TRANSACTIONS</i></th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody class="displayRules">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>

                        </div>
                    </div>
                <!-- </div> -->



    <!--    Modal for creating rules-->
    <div class="modal-right-side">
        <div class="modal right fade" id="createTagGroup" tabindex="" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel2" >Create New Group</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                   
                    <div class="modal-body">
                        <!-- <div class="subheader">Rules only apply to unreviewed transactions.</div> -->
                            <div class="form-group">
                                <form action="<?php echo site_url()?>accounting/addTagsGroup" method="post">
                                    <label for="">Group name</label>
                                    <input type="text" name="tags_group_name" class="form-control">
                                    <select class="form-control" id="e2" style="width:100px;">
                                        <option value="green"></option>
                                        <option value="yellow"></option>
                                        <option value="red"></option>
                                    </select>
                                    <button class="btn btn-success">Save</button>
                                </form>
                            </div>
                            <div class="form-group">
                                <form action="<?php echo site_url()?>accounting/addTagsGroupThis" method="post">
                                    <label for="">Add tags to this group</label>
                                    <p>Tag name</p>
                                    <input type="text" name="rules_name" class="form-control">
                                    <button class="btn btn-success" >Add</button>
                                </form>
                            </div>
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
                                <input type="text" name="group_name" class="form-control">
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
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
    </div>
        <!-- end container-fluid -->

	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper end -->
</div>
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
            "paging":false,
            "language": {
                "emptyTable": "<h5>Use rules to save time</h5> <span>Make rules for your frequently occurring transactions and tell nSmartrac exactly what should happen when conditions are met. <a href='#' data-toggle=\"modal\" data-target=\"#createRules\" style='color: #0b97c4'>Create a rule</a></span>"
            }
        });
    } );
</script>
