<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Estimates'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('estimate') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Estimates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Plans'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('plans') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Plans</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Estimate Settings'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('estimate/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>