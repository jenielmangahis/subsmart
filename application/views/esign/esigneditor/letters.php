<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper wrapper--loading" role="wrapper">
    <div class="esigneditor__loader">
        <div class="esigneditor__loaderInner">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            Loading...
        </div>
    </div>

    <div class="container mt-4">
        <div>
            <h1>eSign Editor Letters</h1>
            <div class="alert alert-warning" role="alert">
                <p>These letter templates with parameters are used by the Dispute Wizard. Never type customer information directly into these templates. Modifying templates may prevent them from functioning.</p>
            </div>

            <div class="esignEditorLetters">
                <div class="d-flex justify-content-between mb-3">
                    <div class="d-flex">
                        <select class="form-control" id="category">
                            <option value="all">All Categories</option>
                        </select>
                        <select class="form-control" id="status">
                            <option value="all">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <a class="btn btn-primary" href="<?=base_url()?>esigneditor/create">
                        <i class="fa fa-plus mr-1"></i>
                        Create Letter
                    </a>
                </div>
                <table id="letters" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Letter Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include viewPath('includes/footer');?>