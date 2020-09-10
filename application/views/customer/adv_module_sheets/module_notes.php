<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="module_ac_full" style="top:-410px;">
    <div class="row">
        <div class="col-md-12 module_header">
            <p class="module_title">Notes</p>
        </div>
        <div class="col-sm-12" id="access_module">
            <div class="col-sm-12 text-right-sm" style="align:right;">
                <span class="text-ter" style="position: absolute; right: 83px !important; top: 8px;">Customize</span>
                <div class="onoffswitch grid-onoffswitch" style="position: relative; margin-top: 7px;">
                    <input type="checkbox" name="notes_switch" class="onoffswitch-checkbox" data-customize="open" id="onoff-notes">
                    <label class="onoffswitch-label" for="onoff-notes">
                        <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-hover" id="notes_table">
                <thead>
                <tr>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php// foreach ($profiles as $customer) : ?>
                <tr>
                    <td>Hi, I am a sampke note.</td>
                    <td>Jan 30 2015 11:16AM </td>
                    <td>
                        <button type="submit" class="btn btn-primary btn-md" name="" id="" ><span class="fa fa-pencil"></span> Edit</button>
                        <button type="submit" class="btn btn-primary btn-md" name="" id="" ><span class="fa fa-trash-o"></span> Delete</button>
                    </td>
                </tr>
                <?php //endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>