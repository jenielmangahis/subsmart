<?php include viewPath('v2/includes/header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow">
        <i class='bx bx-message-add'></i>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 grid-mb">
        <div class="nsm-field-group search">
            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search Mail">
        </div>
    </div>
    <div class="col-12 col-md-6 grid-mb text-end nsm-page-buttons">
        <button type="button" class="nsm-button" onclick="">
            <i class='bx bx-fw bx-message-add'></i> Compose
        </button>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="nsm-table">
            <thead>
                <tr>
                    <td class="table-icon"></td>
                    <td>Name</td>
                    <td>Message</td>
                    <td>Attachment</td>
                    <td>Sent</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bxs-star'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary">Alexander Pierce</td>
                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                    <td><i class='bx bx-fw bx-paperclip'></i></td>
                    <td>5 mins ago</td>
                </tr>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bx-star'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary">Alexander Pierce</td>
                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                    <td><i class='bx bx-fw bx-paperclip'></i></td>
                    <td>28 mins ago</td>
                </tr>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bx-star'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary">Alexander Pierce</td>
                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                    <td><i class='bx bx-fw bx-paperclip'></i></td>
                    <td>11 hours ago</td>
                </tr>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bxs-star'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary">Alexander Pierce</td>
                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                    <td><i class='bx bx-fw bx-paperclip'></i></td>
                    <td>15 hours ago</td>
                </tr>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bxs-star'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary">Alexander Pierce</td>
                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                    <td><i class='bx bx-fw bx-paperclip'></i></td>
                    <td>Yesterday</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <nav class="nsm-table-pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link disabled" href="#">Prev</a></li>
                                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                <li class="page-item"><a class="page-link disabled" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>