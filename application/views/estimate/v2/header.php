<div class="col-12 mb-3">
    <div class="nsm-page-nav">
        <ul>
            <li class="active">
                <a class="nsm-page-link" href="#">
                    <i class="bx bx-fw bx-plus estimate-page-tab-icon"></i>
                    <span class="estimate-page-tab-text">Create Estimate</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="/estimate">
                    <i class="bx bx-fw bx-chart"></i>
                    <span>My Estimates</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="/plans">
                    <i class="bx bx-fw bx-cube"></i>
                    <span>Plans</span>
                </a>
            </li>
            <li>
                <a class="nsm-page-link" href="/estimate/settings">
                    <i class="bx bx-fw bx-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <!-- Do not remove the last li -->
            <li><label></label></li>
        </ul>
    </div>
</div>

<script>
    (() => {
        if (window.location.pathname.toLowerCase().includes("edit")) {
            document.querySelector(".estimate-page-tab-text").textContent = "Edit Estimate";
            document.querySelector(".estimate-page-tab-icon").classList.remove("bx-plus");
            document.querySelector(".estimate-page-tab-icon").classList.add("bx-pencil");
        }
    })()
</script>