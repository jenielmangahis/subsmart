<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-tags" aria-hidden="true"></i> Tags
        <a href="#" class="float-right text-light">Create Tags</a>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="tagsBody" style="<?= $height; ?> overflow-y: scroll">

                </div>
                <div class="text-center">
                    <a class="text-info" href="#">View All</a>
                </div>

            </div>
        </div>

    </div>
</div>
