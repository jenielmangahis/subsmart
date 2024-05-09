<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Chatbot'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('chatbot/settings') ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Settings</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>