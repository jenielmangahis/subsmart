
<!-- <?php if( $this->session->flashdata('message') != '' ){ ?> -->

<div class="row page-content g-0">
    <div class="row">
        <div class="col-12">
            <div class="nsm-callout primary">
                <button><i class='bx bx-x'></i></button>
                <?php echo $this->session->flashdata('message'); ?>
                </div>
        </div>
    </div>
</div>
<!-- <?php } ?> -->