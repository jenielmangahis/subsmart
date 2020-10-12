<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style>
.hide {
    display:none;
}
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/mycrm'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
    <div class="container-page">
    <div class="container-fluid">

<div class="row">
    <div class="col-sm-6">
        <h1>Cards On File</h1>
    </div>
    <div class="col-sm-6">
        <div class="h1-spacer text-right">
            <a class="btn btn-primary btn-md" href="https://www.markate.com/pro/settings/payment_methods/main/add"><span class="fa fa-plus"></span> Add Card</a>
        </div>
    </div>
</div>


<p class="margin-bottom-ter">Listing all your credit cards saved on file.</p>

<div id="validation-container">
    <div class="validation-error hide"></div>
</div>
<div class="card">
<table class="table table-hover table-to-list">
    <thead>
        <tr>
            <th>Card</th>
            <th>Card holder</th>
            <th class="text-center">Primary Card</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
                <tr>
            <td>
                <span class="card-type visa"></span>
                Visa                ****5898                                <span>(expires 06/2024)</span>
                                                <div class="card-help text-ter">This is the card used for membership and purchases.</div>
                            </td>
            <td>
                Tommy Nguyen            </td>
            <td class="text-center">
                <div class="checkbox checkbox-sec">
                    <input type="checkbox" name="is_default" value="1667" checked="checked" id="is_default_1667">
                    <label for="is_default_1667"></label>
                </div>
            </td>
            <td class="text-right">
                <div class="dropdown dropdown-btn">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                                        <li role="presentation"><a role="menurate" tabindex="-1" data-delete-modal="open" data-id="1667" data-name="Visa ****5898" href="#"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                            </ul>
                </div>
            </td>
        </tr>
                <tr>
            <td>
                <span class="card-type visa"></span>
                Visa                ****2483                                <span class="payment-method-expired">(expired on 01/2020)</span>
                                            </td>
            <td>
                Tommy Nguyen            </td>
            <td class="text-center">
                <div class="checkbox checkbox-sec">
                    <input type="checkbox" name="is_default" value="1408" id="is_default_1408">
                    <label for="is_default_1408"></label>
                </div>
            </td>
            <td class="text-right">
                <div class="dropdown dropdown-btn">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-edit" data-toggle="dropdown" aria-expanded="true">
                        <span class="btn-label">Manage</span><span class="caret-holder"><span class="caret"></span></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdown-edit">
                                                <li role="presentation"><a role="menurate" tabindex="-1" href="https://www.markate.com/pro/settings/payment_methods/main/edit/id/1408"><span class="fa fa-pencil-square-o icon"></span> Edit</a></li>
                                                                        <li role="presentation"><a role="menurate" tabindex="-1" data-delete-modal="open" data-id="1408" data-name="Visa ****2483" href="#"><span class="fa fa-trash-o icon"></span> Delete</a></li>
                                            </ul>
                </div>
            </td>
        </tr>
            </tbody>
</table>
</div>
<div class="row pagination-container">
	<div class="col-md-6"><ul class="pagination"><li class="active"><span>1</span></li></ul></div>
    <div class="col-md-6 text-right"><span class="pagination-page-of">Page <b>1</b> of <b>1</b></span></div>
</div>

<div class="modal" data-delete-modal="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Card</h4>
            </div>
            <div class="modal-body">
                <div class="validation-error hide"></div>
                <form name="delete-modal-form">
                    <p>
                        Are you sure you want to delete the card <span class="bold" data-id="name"></span>?
                    </p>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" data-delete-modal="submit">Delete</button>
            </div>
        </div>
    </div>
</div>
    </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>