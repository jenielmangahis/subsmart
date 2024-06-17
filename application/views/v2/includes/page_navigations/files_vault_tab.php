<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Files Vault'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('files_vault') ?>">
                <i class='bx bx-fw bx-folder'></i>
                <span>Files Vault</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Before and After Photos'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('before_after_photos') ?>">
                <i class='bx bx-fw bx-camera'></i>
                <span>Before and After Photos</span>
            </a>
        </li>
        <li><label></label></li>
    </ul>
</div>