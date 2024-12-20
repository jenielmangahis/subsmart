<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Customer Info'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('/')?>">
                <i class='bx bx-fw bx-tachometer'></i>
                <span>Info</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Jobs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('/') ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Invoice'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('/') ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Invoice</span>
            </a>
        </li>
        <li><label></label></li>
    </ul>
</div>