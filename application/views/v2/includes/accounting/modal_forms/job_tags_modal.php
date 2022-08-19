<div class="modal right fade nsm-modal" id="tags-modal" tabindex="-1" role="dialog" aria-labelledby="tags-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="tags-list">
            <div class="modal-header">
                <span class="modal-title content-title" id="tags-modal-label">Manage your tags</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-12 col-md-6 d-flex">
                        <button type="button" class="nsm-button m-auto" onclick="getTagForm({}, 'create')">Create Tag</button>
                    </div>
                    <div class="col-12 col-md-6 d-flex">
                        <button type="button" class="nsm-button m-auto" onclick="getGroupTagForm()">Create Group</button>
                    </div>
                    <div class="col-12 py-3">
                        <input type="text" name="search_tag" id="search-tag" class="form-control nsm-field mb-2" placeholder="Find tag by name">
                    </div>
                    <div class="col-12">
                        <table id="tags-table" class="nsm-table">
                            <thead>
                                <tr>
                                    <td>Tags</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($tags)) : ?>
                                    <?php foreach($tags as $index => $tag) : ?>
                                    <tr <?=$tag['type'] === 'group' ? 'data-toggle="collapse" data-target=".collapse-'.$index.'"' : ''?>>
                                        <td>
                                            <span>
                                                <?php if($tag['type'] === 'group') : ?>
                                                    <i class="bx bx-fw bx-chevron-down"></i>
                                                <?php endif; ?>
                                                <?=$tag['name']?> <?=$tag['type'] === 'group' ? '('.count($tag['tags']).')' : '' ?>
                                            </span>
                                        </td>
                                        <td><button class="nsm-button edit float-end" data-group-tag="<?=$tag['group_tag_id']?>" data-type="<?=$tag['type']?>" data-id="<?=$tag['id']?>" data-name="<?=$tag['name']?>">Edit</button></td>
                                    </tr>

                                    <?php if($tag['type'] === 'group') : ?>
                                        <?php foreach($tag['tags'] as $groupTag) : ?>
                                        <tr class="collapse collapse-<?=$index?>">
                                            <td>
                                                <span>&emsp;<?=$groupTag['name']?></span>
                                            </td>
                                            <td><button class="nsm-button edit float-end" data-group-tag="<?=$groupTag['group_tag_id']?>" data-type="<?=$groupTag['type']?>" data-id="<?=$groupTag['id']?>" data-name="<?=$groupTag['name']?>">Edit</button></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td>
                                            <div class="nsm-empty">
                                                <span>No results found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>