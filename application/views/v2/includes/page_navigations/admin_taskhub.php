<div class="nsm-page-nav">
    <ul>
        <li class="<?= $page_title == 'Taskhub' ? 'active' : ''; ?>">
            <a class="nsm-page-link" href="<?= base_url('admin/taskhub') ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Taskhub</span>
            </a>
        </li>
        <li class="<?= $page_title == 'Task Status' ? 'active' : ''; ?>">
            <a class="nsm-page-link" href="<?= base_url('admin/taskhub_status') ?>">
                <i class='bx bx-fw bx-list-ul'></i>
                <span>Task Status</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>