<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .plans-item-container {
        padding: 10px
    }

    .plans-item-container .item {
        display: block;
        padding: 10px;
        color: #214548;
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        height: 100%;
        margin: auto;
    }

    .plans-item-container .item .first {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 5px;
        justify-content: center;
    }

    .plans-item-container .item .first .icons {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .plans-item-container .item .count {
        width: 100%;
        text-align: left;
        color: #281c2d;
    }

    .plans-item-container .item .first label {
        font-size: 24px;
        font-weight: bold;
        line-height: 1;
    }

    .plans-item-container .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    @media screen and (max-width: 1366px) {
      .plans-item-container .col-4{ 
        width: 100%;
      }
    }
  
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Recurring Service Plans</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('customer/subscriptions') ?>">
                See All Subscriptions
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner mb-4">
                <img src="./assets/img/ytd-stats-banner2.svg" alt="">
            </div>
            <div class="row plans-item-container">
                <div class="col-4 mb-4">
                    <div class="item">
                        <div class="box" style="background:#FEA3032a"></div>
                        <div class="first">
                            <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                <i class='bx bx-check-circle'></i>
                            </div>
                            <label><?= $activeSubscriptions->total_active_subscriptions ?></label>
                        </div>
                        <div class="count">
                            <p>Active Service Plans</p>
                        </div>
                    </div>

                </div>
                <div class="col-4 mb-4">
                    <div class="item">
                        <div class="box" style="background:#d9a1a02a"></div>

                        <div class="first">
                            <div class="icons" style="color:#d9a1a0;background:#d9a1a01a">
                                <i class='bx bx-calendar-exclamation'></i>
                            </div>
                            <label><?= count($activeSubscriptionsWillExpireIn30d) ?></label>
                        </div>
                        <div class="count">
                            <p>Agreements to expire in 30 days</p>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="item">
                        <div class="box" style="background:#A888B52a"></div>
                        <div class="first">
                            <div class="icons" style="color:#A888B5;background:#A888B51a">
                                <i class='bx bx-dollar-circle'></i>
                            </div>
                            <label><?php echo "$" . number_format($totalAmountActiveSubscriptions->total_amount, 2, '.', ','); ?></label>
                        </div>
                        <div class="count">
                            <p>Total $ Recurring Payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>


<div class="modal fade nsm-modal" tabindex="-1" role="dialog" id="rsp_users--modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bx bx-fw bx-x m-0"></i>
                </button>
            </div>
            <div class="modal-body loading">
                <style>
                    #rsp_users--modal .modal-body.loading .users-wrapper {
                        display: none;
                    }

                    #rsp_users--modal .modal-body:not(.loading) .users-loader {
                        display: none !important;
                    }

                    #rsp_users--modal .nsm-empty {
                        min-height: 200px;
                    }
                </style>
                <div>
                    <div class="users-wrapper"></div>

                    <div class="nsm-empty d-none">
                        <i class="bx bx-meh-blank"></i>
                        <span>Customer list is empty</span>
                    </div>

                    <div class="users-loader d-flex align-items-center justify-content-center"
                        style="min-height: 200px;">
                        <div class="spinner-border" role="status"></div>
                    </div>
                </div>

                <template>
                    <div class="nsm-card mb-2 h-auto">
                        <div class="nsm-card-content">
                            <div class="d-flex align-items-center">
                                <div class="nsm-profile me-3">
                                    <span></span>
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <div class="content-title">
                                            <a href="" target="_blank" class="nsm-link"></a>
                                        </div>
                                        <span class="content-info"></span>
                                    </div>
                                    <div class="content-subtitle d-block"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    window.document.addEventListener("DOMContentLoaded", async () => {
        const prefixURL = "";

        const $modal = document.getElementById("rsp_users--modal");
        const $wrapper = $modal.querySelector(".users-wrapper");
        const $template = $modal.querySelector("template");
        const $modalBody = $modal.querySelector(".modal-body");
        const buttons = document.querySelectorAll("[data-action=show_users_modal]");

        buttons.forEach($button => {
            $button.addEventListener("click", showUsersModal);
        });

        const modalConfig = {
            agreement_to_expire_30_days: {
                api: "apiGetAgreementsToExpireIn30DaysCustomers",
            },
            recurring_payment: {
                api: "apiGetRecurringPaymentCustomers",
            },
        };

        async function showUsersModal(event) {
            $($modal).modal("show");

            if (window.__dashboardRSPModalLoading === true) return;
            window.__dashboardRSPModalLoading = true;

            const $modalTitle = $modal.querySelector(".modal-title");
            const $targetTitle = this.querySelector("[data-type=title]");
            const $emptyMessage = $modal.querySelector(".nsm-empty");

            $wrapper.innerHTML = "";
            $modalBody.classList.add("loading");
            $emptyMessage.classList.add("d-none");
            $modalTitle.textContent = $targetTitle.textContent.trim();

            const config = modalConfig[this.dataset.customers];
            const response = await fetch(`${prefixURL}/Dashboard/${config.api}`);
            const json = await response.json();

            const $fragment = document.createDocumentFragment();
            json.data.forEach((customer) => {
                $fragment.appendChild(createCustomer(customer));
            });

            window.__dashboardRSPModalLoading = false;
            $modalBody.classList.remove("loading");
            $wrapper.appendChild($fragment);

            if (json.data.length) {
                $emptyMessage.classList.add("d-none");
            } else {
                $emptyMessage.classList.remove("d-none");
            }
        }

        function createCustomer(customer) {
            const $copy = document.importNode($template.content, true);
            const $title = $copy.querySelector(".content-title a");
            const $subTitle = $copy.querySelector(".content-subtitle");
            const $profile = $copy.querySelector(".nsm-profile span");
            const $info = $copy.querySelector(".content-info");

            if (isCustomerBusiness(customer)) {
                $title.textContent = customer.business_name;
            } else {
                $title.textContent = `${customer.first_name} ${customer.last_name}`;
            }

            if (customer.email && customer.email.length) {
                $subTitle.textContent = customer.email;
            } else {
                $subTitle.textContent = customer.phone_m;
            }

            $profile.textContent = getCustomerInitials(customer);
            $info.textContent = customer.info;
            $title.setAttribute("href", `${prefixURL}/customer/preview_/${customer.prof_id}`);

            return $copy.firstElementChild;
        }

        function getCustomerInitials(customer) {
            if (!isCustomerBusiness(customer)) {
                return `${customer.first_name[0]}${customer.last_name[0]}`;
            }

            const nameParts = customer.business_name.split(" ");
            return nameParts.length > 1 ? `${nameParts.at(0)[0]}${nameParts.at(-1)[0]}` : nameParts.at(0)[
                0];
        }

        function isCustomerBusiness(customer) {
            return customer.customer_type.toLowerCase() === "business";
        }
    });
</script>
