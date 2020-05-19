<ul class="customer-contact-list" data-customer-contact="list">
    <?php if (!empty($additionalContacts)) { ?>
        <?php foreach ($additionalContacts as $key=>$additionalContact) { ?>
            <li class="customer-contact-list__item">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="customer-contact-list__item-name">
                            <?php echo $additionalContact['name'] ?></div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                    <?php echo $additionalContact['email'] ?> </div>
                    <div class="col-md-4 col-sm-8">
                    <?php echo $additionalContact['phone'] ?> </div>
                    <div class="col-md-2 col-sm-4 text-right">
                        <a class="customer-contact-list__edit" data-toggle="modal" data-target="#modalAdditionalContacts" data-customer-id="<?php echo $customer_id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-edit"></span> edit</a>
                        <a class="customer-contact-list__delete" data-customer-contact-delete-modal="open" data-customer-id="<?php echo $customer_id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                    </div>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>