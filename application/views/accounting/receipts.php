<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_accounting'); ?>
<div class="wrapper" role="wrapper">
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row" style="margin-left: 50px;padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/accounting/link_bank')?>" class="banking-tab" style="text-decoration: none">Banking</a>
                        <a href="<?php echo url('/accounting/rules')?>" class="banking-tab">Rules</a>
                        <a href="<?php echo url('/accounting/receipts')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="receipts")?:'-active';?>">Receipts</a>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12" style="padding: 0 70px 10px;">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="/file-upload" class="dropzone" method="post" enctype="multipart/form-data" style="border: 2px grey dashed;">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div style="border: 2px solid #d4d7dc;padding: 10px 10px 10px 10px;width: 100%;height: 100%">
                                    <h5>RECEIPT AND BILL FORWARDING</h5>
                                    <div class="row">
                                        <div class="col-sm-6"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNzYiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA3NiA1MCI+CiAgICA8ZGVmcz4KICAgICAgICA8cGF0aCBpZD0iYSIgZD0iTS4wMzEuNDNoMzguMjA0djM4LjIwM0guMDN6Ii8+CiAgICA8L2RlZnM+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxwYXRoIGZpbGw9IiNGRkYiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxwYXRoIHN0cm9rZT0iIzAwODQ4MSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIiBzdHJva2Utd2lkdGg9IjMiIGQ9Ik00LjE4NCA0Ny43MThhMS41OTggMS41OTggMCAwIDEtMS4xOTEtLjM5NiAxLjY2IDEuNjYgMCAwIDEtLjU1Ni0xLjE0NlYzLjA4NmExLjY2IDEuNjYgMCAwIDEgLjU1Ni0xLjE0NmMuMzI4LS4yOS43NTgtLjQzMyAxLjE5MS0uMzk2aDY3LjY5NWMuNDM0LS4wMzcuODYzLjEwNiAxLjE5Mi4zOTYuMzI4LjI5LjUyOS43MDMuNTU2IDEuMTQ2djQyLjg3NmMtLjA5OSAxLjA2LTEuMDE0IDEuODQyLTIuMDU1IDEuNzU2SDQuMTg0eiIvPgogICAgICAgIDxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDMyIDQuMDk5KSI+CiAgICAgICAgICAgIDxtYXNrIGlkPSJiIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgICAgIDx1c2UgeGxpbms6aHJlZj0iI2EiLz4KICAgICAgICAgICAgPC9tYXNrPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjMDBDMUJGIiBmaWxsLW9wYWNpdHk9Ii4xNSIgZD0iTTM4LjIzNS40M3YzOC4yMDNILjAzeiIgbWFzaz0idXJsKCNiKSIvPgogICAgICAgIDwvZz4KICAgICAgICA8cGF0aCBzdHJva2U9IiMwMEMxQkYiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCIgc3Ryb2tlLXdpZHRoPSIyLjEyIiBkPSJNNyA3LjA5OWwzMC4zMTEgMTdMNjcgNy4wOTkiLz4KICAgIDwvZz4KPC9zdmc+Cg==" alt="Email" height="100" width="200"></div>
                                        <div class="col-sm-6">Email your receipts and bills, and we’ll create transactions from them. Ask your master admin to set up receipt forwarding.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px">
                            <ul class="nav nav-tabs banking-tab-container">
                                <li class="banking-sub-active"><a data-toggle="tab" href="#forReview" class="banking-sub-tab">For Review</a></li>
                                <li><a data-toggle="tab" href="#reviewed" class="banking-sub-tab">Reviewed</a></li>
                            </ul>
                            <div class="tab-content" style="padding-top: 20px">
                                <div id="forReview" class="tab-pane fade in active">
                                    <table id="receipts_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Payee</th>
                                            <th>Category or Match</th>
                                            <th>Spent</th>
                                            <th>Received</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>06/29/2020</td>
                                            <td>CHECK #2701 2701</td>
                                            <td>Mike Bell Jr</td>
                                            <td></td>
                                            <td>$320</td>
                                            <td></td>
                                            <td><a href="">View</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="reviewed" class="tab-pane fade">
                                    <h3>Menu 1</h3>
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row"></div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
	<?php include viewPath('includes/sidebars/accounting/accounting'); ?>
</div>
<?php include viewPath('includes/footer_accounting'); ?>
<script>
    // DataTable JS
    $(document).ready(function() {
        $('#receipts_table').DataTable();
    } );
    // Active menu jquery
    $('.banking-sub-tab').click(function(){
        $(this).parent().addClass('banking-sub-active').siblings().removeClass('banking-sub-active')
    });
    //Bootstrap tabs toggle js
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });

</script>


