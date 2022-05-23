<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #fff4e6;">
            <i class="fa fa-wrench " aria-hidden="true"></i> Recurring service plans
        </div>
        <div class="card-body">
            <div class="row" style="height:<?= $rawHeight-160; ?>px; overflow:scroll">
                <div class="col-lg-6 text-center">
                    <h2>0</h2>
                    <p>Active Service Plans</p>
                </div>
                <div class="col-lg-6 text-center">
                    <h2>0</h2>
                    <p>Agreements to expire in 30 days</p>
                </div>
                <hr />
            </div>
            <div class="justify-content-center text-center mt-5">
                <button onclick="document.location = '<?= base_url() ?>'" class="btn btn-primary mt-2">Setup a Plan</button>
            </div>
        </div>

    </div>
</div>

