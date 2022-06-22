<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Calls and Logs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('calls') ?>">
                <i class='bx bx-phone-call' ></i>
                <span>Make Call</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Call Logs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('calls/logs') ?>">
                <i class='bx bx-list-ul' ></i>
                <span>Call Logs</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>