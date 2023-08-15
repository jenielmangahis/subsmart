<?php include viewPath('v2/includes/header'); ?>
<style>
.nsm-table {
    /*display: none;*/
}
.nsm-badge.primary-enhanced {
    background-color: #6a4a86;
}
    table {
    width: 100% !important;
}
.dataTables_filter, .dataTables_length{
    display: none;
}
table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 1px solid lightgray;
}
table.dataTable.no-footer {
     border-bottom: 0px solid #111; 
     margin-bottom: 10px;
}
#CUSTOM_FILTER_DROPDOWN:hover {
     border-color: gray !important; 
     background-color: white !important; 
     color: black !important; 
     cursor: pointer;
}

.techs {
    display: flex;
    padding-left: 12px;
}
.techs > .nsm-profile {
    border: 2px solid #fff;
    box-sizing: content-box;
    margin-left: -12px;
}
.nsm-profile {
    --size: 35px;
    max-width: var(--size);
    height: var(--size);
    min-width: var(--size);
}
.table-row-icon{
    display: inline-block;
}
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('job/new_job1') ?>'">
        <i class='bx bx-briefcase'></i>
    </div>
</div>

<div class="row page-content g-0">
    <?php if(!empty($this->session->flashdata('alert'))): ?>
        <div class="alert alert-<?= $this->session->flashdata('alert-type') ?>">
            <?= $this->session->flashdata('alert') ?>
        </div>
    <?php endif; ?>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/esign_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                           An effective contract management system should include the ability to support electronic signatures.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 grid-mb">
                        <div class="nsm-field-group search form-group">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="custom-esign-search" placeholder="Search eSign...">
                            
                        </div>
                    </div>
                </div>
                <table id="esignListTable" class="nsm-table">
                    <thead>
                      <tr>
                        <th style="width:2%;"></th>
                        <th>Docfile ID</th>
                        <th>Customer Name</th>
                        <th>Subject</th>                        
                        <th style="width:10%;">Last Changed</th>
                        <th></th>
                      </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
window.addEventListener('DOMContentLoaded', async (event) => {
  const urlParams = new URLSearchParams(window.location.search);
  const prefixURL = "http://127.0.0.1/ci/nsmart_v2";
  const response = await fetch(`${prefixURL}/DocuSign/apiGetDocuSignList`);
  const { data } = await response.json();

  if (data.length === 0) return;
  
});
$(document).ready(function(){
    const $table = $("#esignListTable");
    const prefixURL = "http://127.0.0.1/ci/nsmart_v2";
    const table = $table.DataTable({
        //searching: false,

        ajax: `${prefixURL}/DocuSign/apiListManage/completed`,
        columns: [
          {
            sortable: false,
            render: columns.rowIcon,
          },
          {
            sortable: false,
            render: columns.docfileid,
          },
          {
            sortable: false,
            render: columns.customerName,
          },
          {
            sortable: false,
            render: columns.subject,
          },
          {
            render: columns.lastChanged,
          },
          {
            sortable: false,
            render: columns.managerTools,
          },
        ],
        rowId: function (row) {
          return `row${row.id}`;
        },
        createdRow: function (row, data) {
          $(row).attr("data-id", data.id);
        },
    });

    $("#custom-esign-search").keyup(function() {        
        table.search($(this).val()).draw();
    });

    table.on("draw", function () {
        $table.find('[data-toggle="popover"]').popover({ html: true });
    });

    $table.find("tbody").on("click", ".action", async function (event) {
        const $parent = $(this).closest("tr");
        const rows = table.rows().data().toArray();

        const rowId = $parent.data("id");
        const row = rows.find(({ id }) => id == rowId);

        const action = $(this).data("action");
        await actions[action](row, table, event);
    });
});
</script>
<?php include viewPath('v2/includes/footer'); ?>