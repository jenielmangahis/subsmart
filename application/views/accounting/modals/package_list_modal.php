<!-- Modal -->
<div class="modal fade" id="package_list" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add/Create Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0 pl-3 pb-3" id="divcreatePackage">
                <section id="tabs" class="project-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Add Package</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Create Package</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table table-condensed"  id="package-table">
                                        <thead>
                                            <tr>
                                                <th>ID #</th>
                                                <th>Package Name</th>
                                                <th></th>
                                                <th></th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="panel">
                                        <?php foreach($itemPackages as $pItems) : ?>
                                            <tr>
                                                <td><?=$pItems->id?></td>
                                                <td><?=$pItems->name?></td>
                                                <td></td>
                                                <td class="text-success"></td>
                                                <td class="text-success"><?=$pItems->amount_set?></td>
                                                <td class="text-error">
                                                    <button id="<?= $pItems->id?>" data-id="<?= $pItems->id?>" type="button" data-dismiss="modal" class="btn btn-sm btn-default addNewPackageToList">
                                                        <span class="fa fa-plus"></span>
                                                    </button>
                                                </td>
                                                <td><a href="#" data-toggle="collapse" data-target="#demo<?=$pItems->id?>" data-parent="#package-table" id="packageID" data-id="<?=$pItems->id?>"><i class="fa fa-sort-down" style="font-size:24px"></i></a></td>
                                            </tr>
                                            <tr id="demo<?=$pItems->id?>" class="collapse">
                                                <td colspan="6" class="hiddenRow">
                                                    <div id="packageItems<?=$pItems->id?>">
                                                        <table>
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
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="width:100%;">
                                    <input type="hidden" name="count" value="0" id="count">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <h6>Package Name</h6> <input type="text" class="form-control" style="width:80%;" name="package_name" id="package_name">
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-hover" id="package-items-table" style="width:100%;">
                                        <!-- <input type="hidden" name="count" value="0" id="count"> -->
                                        <thead style="background-color:#E9E8EA;">
                                            <tr>
                                                <th>Name</th>
                                                <th width="150px">Quantity</th>
                                                <th width="150px">Price</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <a class="link-modal-open" href="#" id="add_package_item" data-toggle="modal" data-target="#item_list_package" style="float:left;"><span class="fa fa-plus-square fa-margin-right"></span>Add Items</a>
                                    <br>
                                    <br>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><b>Total Price</b></th>
                                                <th><b>Set Package Price</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="text" class="form-control" style="width:90%;" name="package_price" id="package_price"></td>
                                                <td><input type="text" class="form-control" style="width:90%;" name="package_price_set" id="package_price_set"></td>
                                            <tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6" align="right">
                                            <button type="button" class="btn btn-primary addCreatePackage">Create/Add Package</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>