<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Recurring Service Plans</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>inventory/plans">
                Setup a Plan
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row h-100 gy-2">
            <div class="col-12">
                <div class="nsm-counter success h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-check-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Active Service Plans</span>
                            <h2><?= $plan_type[0]->totalPlan; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" data-action="show_users_modal" data-customers="agreement_to_expire_30_days">
                <div class="nsm-counter error h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-calendar-exclamation'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span data-type="title">Agreements to expire in 30 days</span>
                            <h2><?= $total_agreements_to_expire_in_30_days; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" data-action="show_users_modal" data-customers="recurring_payment">
                <div class="nsm-counter primary h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span data-type="title">Total $ Recurring Payment</span>
                            <h2><?= $total_recurring_payment; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
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
        </style>
        <div>
            <div class="users-wrapper"></div>
            <div class="users-loader d-flex align-items-center justify-content-center" style="min-height: 200px;">
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
                        <div>
                            <div class="content-title">
                                <a href="" target="_blank" class="nsm-link"></a>
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
        const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";

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
            const $modalTitle = $modal.querySelector(".modal-title");
            const $targetTitle = this.querySelector("[data-type=title]");

            $wrapper.innerHTML = "";
            $modalBody.classList.add("loading");
            $modalTitle.textContent = $targetTitle.textContent.trim();

            const config = modalConfig[this.dataset.customers];
            const response = await fetch(`${prefixURL}/Dashboard/${config.api}`);
            const json = await response.json();

            const $fragment = document.createDocumentFragment();
            json.data.forEach((customer) => {
                $fragment.appendChild(createCustomer(customer));
            });

            $modalBody.classList.remove("loading");
            $wrapper.appendChild($fragment);
            $($modal).modal("show");
        }

        function createCustomer(customer) {
            const $copy = document.importNode($template.content, true);

            const $title = $copy.querySelector(".content-title a");
            const $subTitle = $copy.querySelector(".content-subtitle");
            const $profile = $copy.querySelector(".nsm-profile span");

            if (isCustomerBusiness(customer)) {
                $title.textContent = customer.business_name;
            } else {
                $title.textContent = `${customer.first_name} ${customer.last_name}`;
            }

            $subTitle.textContent = customer.email;
            $profile.textContent = getCustomerInitials(customer);
            $title.setAttribute("href", `${prefixURL}/customer/preview_/${customer.prof_id}`);

            return $copy.firstElementChild;
        }

        function getCustomerInitials(customer) {
            if (!isCustomerBusiness(customer)) {
                return `${customer.first_name[0]}${customer.last_name[0]}`;
            }

            const nameParts = customer.business_name.split(" ");
            return nameParts.length > 1 ? `${nameParts.at(0)[0]}${nameParts.at(-1)[0]}` : nameParts.at(0)[0];
        }

        function isCustomerBusiness(customer) {
            return customer.customer_type.toLowerCase() === "business";
        }
    });
</script>