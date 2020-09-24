<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module_ac">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Notes</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="notes_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-note">
                    <label class="onoffswitch-label" for="onoff-note">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-12 form-line">
            <textarea type="text" class="form-controls" name="notes" id="notes" cols="70" rows="5"> </textarea>
        </div>
        <div class="col-md-12 form-line">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Assign</label>
                </div>
            </div>
        </div>
    </div>
</div>