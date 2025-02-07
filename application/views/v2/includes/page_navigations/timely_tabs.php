<style>
    @media (max-width: 768px) {
    .nsm-page-link span {
        display: none;
    }

    .nsm-page-link:focus span,
    .nsm-page-link:active span {
        display: inline-block;
    }
}

</style>
<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Timely'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('timely') ?>">
                <i class='bx bx-fw bx-bot'></i>
                <span>Timely</span>
            </a>
        </li>
    
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>
