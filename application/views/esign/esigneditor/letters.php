<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header');
ini_set('max_input_vars', 30000);
?>

<div class="wrapper" role="wrapper">
    <div class="container mt-4">
        <div>
            <h1>eSign Editor Letters</h1>
            <div class="alert alert-warning" role="alert">
                <p>These letter templates with parameters are used by the Dispute Wizard. Never type customer information directly into these templates. Modifying templates may prevent them from functioning.</p>
            </div>

            <div>
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