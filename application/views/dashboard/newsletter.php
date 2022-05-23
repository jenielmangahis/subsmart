<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="col-sm-4" id="newsletter">
    <div class="expenses tile-container">
        <div class="inner-container">
            <div class="tileContent">
                <div class="clear">
                    <div class="inner-content">
                        <div class="header-container" style="border-bottom:1px solid gray;">
                            <h3 class="header-content"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Company Newsletter</h3>
                        </div>
                        <div class="expenses-money-section" style="margin-top:10px;">
                            <div class="inner-news">
                                <p>Welcome to nSmartrac!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Letter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php echo form_open('dashboard/saveFeed', ['class' => 'form-validate require-validation', 'id' => 'feed_form', 'autocomplete' => 'off']); ?>
        </form></div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Subject</label>
                <input type="text" class="form-control" name="feed_subject" id="feed_subject" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="job_name">Description</label>
                <textarea name="feed_description" class="form-control" id="feed_description" cols="30" rows="10"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
          </div>
  </div>
</div>