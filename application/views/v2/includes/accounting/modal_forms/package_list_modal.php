<!-- Modal -->
 <style>
#package_list .nsm-table thead td{
    background-color:#6a4a86;
    color:#ffffff;
}
#package-table .nsm-button{
    padding:8px;
}
.collapse:not(.show) {
    display:none !important;
}
</style>
<div class="modal fade nsm-modal" id="package_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="package-list-modal-label">Add/Create Package</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body pt-0 pl-3 pb-3" id="divcreatePackage">

                <section id="tabs" class="project-tab mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs nsm-nav-pills nsm-nav-pill2" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-add-package-tab" data-bs-toggle="tab" href="#nav-add-package" role="tab" aria-controls="nav-add-package" aria-selected="true">Add Package</a>
                                    <a class="nav-item nav-link" id="nav-create-package-tab" data-bs-toggle="tab" href="#nav-create-package" role="tab" aria-controls="nav-create-package" aria-selected="false">Create Package</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active mt-4" id="nav-add-package" role="tabpanel" aria-labelledby="nav-add-package-tab">
                                    <table class="nsm-table" id="package-table">
                                        <thead>
                                            <tr>
                                                <td data-name="PackageName">Package Name</td>
                                                <td data-name="Amount" style="width:15%;text-align:right;">Amount</td>
                                                <td data-name="Action" style="width:15%;"></td>
                                            </tr>
                                        </thead>
                                        <tbody class="panel">
                                        <?php foreach($itemPackages as $pItems) : ?>
                                            <tr>
                                                <td><?= $pItems->name; ?></td>
                                                <td style="text-align:right;"><?= number_format($pItems->amount_set,2,".",""); ?></td>
                                                <td>
                                                    <button id="<?= $pItems->id?>" data-id="<?= $pItems->id?>" type="button" data-bs-dismiss="modal" class="nsm-button addNewPackageToList">
                                                        <span class="bx bx-fw bx-plus"></span>
                                                    </button>
                                                    <button type="button" class="nsm-button" data-bs-toggle="collapse" data-bs-target="#demo<?=$pItems->id?>" data-parent="#package-table" id="packageID" data-id="<?=$pItems->id?>">
                                                        <i class="bx bx-fw bx-caret-down"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="demo<?=$pItems->id?>" class="collapse">
                                                <td colspan="3" class="hiddenRow">
                                                    <div id="packageItems<?=$pItems->id?>">
                                                        <table class="nsm-table">
                                                            <tbody>
                                                            <?php foreach($pItems->items as $item) : ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?=$item->item->title?></td>
                                                                    <td><?=$item->quantity?></td>
                                                                    <td><?=number_format(floatval($item->price), 2, '.', ',')?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade p-3" id="nav-create-package" role="tabpanel" aria-labelledby="nav-create-package-tab" style="width:100%;">
                                    <input type="hidden" name="count" value="0" id="count">
                                    <div class="row grid-mb">
                                        <div class="col-12 col-md-12">
                                            <h6>Package Name</h6> 
                                            <input type="text" class="form-control nsm-field" style="width:100%;" name="package_name" id="package_name">
                                        </div>
                                    </div>
                                    <div class="row grid-mb">
                                        <div class="col-12">
                                            <table class="nsm-table" id="package-items-table" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td style="width:20%">Quantity</td>
                                                        <td style="width:20%">Price</td>
                                                        <td style="width:10%"></td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="4">
                                                            <button type="button" class="nsm-button" id="add_package_item" data-bs-toggle="modal" data-bs-target="#item_list_package">
                                                                Add Items
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-6">
                                            <label for="package_price">Total Price</label>
                                            <input type="number" class="form-control nsm-field mb-2" name="package_price" value="0.00" step="any" id="package_price">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="package_price_set">Set Package Price</label>
                                            <input type="number" class="form-control nsm-field mb-2" name="package_price_set" value="0.00" step="any" id="package_price_set">
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="nsm-button success float-end" id="create-package">Create/Add Package</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<script>
$(function(){
    $("#package-table").nsmPagination({
        itemsPerPage: 20,
    });
});
</script>