<ul class="customer-address-list">
    <?php if (!empty($serviceAddresses)) { ?>
        <?php foreach ($serviceAddresses as $key=>$serviceAddress) { ?>
            <li class=" customer-address-list__item">
                <div class="row">
                    <div class="col-md-5">
                        <span class="customer-address-list__item-name">
                            <?php echo $serviceAddress['address'] ?>, <?php echo $serviceAddress['address_secondary'] ?> <br>
                            <?php echo $serviceAddress['city'] ?>, <?php echo $serviceAddress['zip'] ?>, <?php echo $serviceAddress['state'] ?> </span>
                    </div>
                    <div class="col-md-5">
                    <?php echo $serviceAddress['name'] ?><br> <?php echo $serviceAddress['email'] ?>, <?php echo $serviceAddress['phone'] ?> </div>
                    <div class="col-md-2 text-right">
                        <a class="customer-address-list__edit"  data-toggle="modal" data-target="#modalServiceAddress" data-customer-id="<?php echo $customer_id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-edit"></span> edit</a>
                        <a class="customer-address-list__delete" data-customer-id="<?php echo $customer_id ?>" data-id="<?php echo $key ?>" href="javascript:void(0)"><span class="fa fa-trash"></span></a>
                    </div>
                </div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>