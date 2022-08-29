<!-- Modal -->
<div class="modal fade nsm-modal" id="package_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="package-list-modal-label">Add/Create Package</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body pt-0 pl-3 pb-3" id="divcreatePackage">

                <section id="tabs" class="project-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Package</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Create Package</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="nsm-table" id="package-table">
                                        <thead>
                                            <tr>
                                                <td>ID #</td>
                                                <td>Package Name</td>
                                                <td></td>
                                                <td></td>
                                                <td>Amount</td>
                                                <td>Action</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody class="panel">
                                        <?php foreach($itemPackages as $pItems) : ?>
                                            <tr>
                                                <td><?=$pItems->id?></td>
                                                <td><?=$pItems->name?></td>
                                                <td></td>
                                                <td></td>
                                                <td><?=$pItems->amount_set?></td>
                                                <td>
                                                    <button id="<?= $pItems->id?>" data-id="<?= $pItems->id?>" type="button" data-bs-dismiss="modal" class="nsm-button addNewPackageToList">
                                                        <span class="bx bx-fw bx-plus"></span>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="nsm-button" data-bs-toggle="collapse" data-bs-target="#demo<?=$pItems->id?>" data-parent="#package-table" id="packageID" data-id="<?=$pItems->id?>">
                                                        <i class="bx bx-fw bx-caret-down"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr id="demo<?=$pItems->id?>" class="collapse">
                                                <td colspan="7" class="hiddenRow">
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
                                <div class="tab-pane fade p-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="width:100%;">
                                    <input type="hidden" name="count" value="0" id="count">
                                    <div class="row grid-mb">
                                        <div class="col-12 col-md-6">
                                            <h6>Package Name</h6> <input type="text" class="form-control nsm-field" style="width:80%;" name="package_name" id="package_name">
                                        </div>
                                    </div>
                                    <div class="row grid-mb">
                                        <div class="col-12">
                                            <table class="nsm-table" id="package-items-table" style="width:100%;">
                                                <thead>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>Quantity</td>
                                                        <td>Price</td>
                                                        <td></td>
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
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <label for="package_price">Total Price</label>
                                            <input type="text" class="form-control nsm-field mb-2" name="package_price" id="package_price">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label for="package_price_set">Set Package Price</label>
                                            <input type="text" class="form-control nsm-field mb-2" name="package_price_set" id="package_price_set">
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
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>