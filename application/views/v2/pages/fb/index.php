<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/estimate/estimate_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('fb/add') ?>'">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <form action="<?php echo base_url('estimate') ?>" method="GET">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" name="search" placeholder="Search Forms" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Sort by All Forms</span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end select-filter">
                                <li><a class="dropdown-item" href="javascript:void(0);">All Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Uncategorized Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Deleted Forms</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">User Defined Folders</a></li>
                            </ul>
                        </div>
                        
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button primary"  onclick="location.href='<?= base_url('fb/add') ?>'">
                                <i class='bx bx-fw bx-add-to-queue'></i> Create New Form
                            </button>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="formbuildertable">
                    <thead>
                        <tr>
                            <td data-name="Form Name">Form Name</td>
                            <td data-name="Results">Results</td>
                            <td data-name="Favorite">Favorite</td>
                            <td data-name="Daily Results">Daily Results</td>
                            <td data-name="Modified">Modified</td>
                            <td data-name="Actions"></td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<style>
    table.dataTable thead th, table.dataTable thead td,
    table.dataTable tfoot th, table.dataTable tfoot td {
        border-color: rgba(0, 0, 0, 0.3);
    }
</style>

<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="module"  src="<?= base_url("assets/js/formbuilder/index.js") ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".nsm-table").nsmPagination();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>