window.document.addEventListener("DOMContentLoaded", async () => {
  import("./BillingInfo.js");
  import("./SubscriptionPayPlan.js");
  import("./OfficeUseInfo.js");
  import("./AccessInfo.js");
  import("./EmergencyContacts.js");
  import("./CustomerProfle.js");
  import("./FundingInfo.js");
  import("./AlarmInfo.js");

  import("./Header.js");
  import("../components/FieldCustomName.js");

  const selects = document.querySelectorAll("select[data-value]");
  selects.forEach(($select) => {
    if ($select.dataset.value.trim().length) {
      $($select).val($select.dataset.value).trigger("change");
    }
  });

  const $form = document.getElementById("customer_form");
  if ($form) {
    const { FormAutoSave, FormAutoSaveConfig } = await import(
      "./FormAutoSave.js"
    );

    const $profileId = $form.querySelector("[name=prof_id]");
    const config = new FormAutoSaveConfig({
      onChange: async () => {
        

  
        // try {
        //   const response = await autoSaveForm();
        //   const { profile_id } = response;

        //   $profileId.value = profile_id;
        //   window.history.replaceState({}, "", `/customer/add_advance/${profile_id}`); // prettier-ignore

        //   let $customerId = $form.querySelector("[name=customer_id]");
        //   if (!$customerId) {
        //     $customerId = document.createElement("input");
        //     $customerId.setAttribute("type", "hidden");
        //     $customerId.setAttribute("name", "customer_id");
        //     $customerId.value = profile_id;
        //     $form.appendChild($customerId);
        //   }
        // } catch (error) {
        //   console.error(error);
          
        // }
      },
    });

    const form = new FormAutoSave($form, config);
    form.listen();
  }
});

$('#customer_form').on("change", function () {
    let customerData = $("#customer_form").serialize();
    const URL_ORIGIN = window.origin;

    // Autosave script
    $.ajax({
      type: "POST",
      url: URL_ORIGIN + "/Customer/save_customer_profile",
      data: customerData,
      success: function (response) {
        // alert('save successfully!');
      }
    });

    // [Disable Temporarily] Check if the Customer already exist in database
    // $.ajax({
    //   type: "POST",
    //   url: URL_ORIGIN + "/Customer/checkCustomerDuplicate",
    //   data: customerData,
    //   success: function (response) {
    //     $('.duplicateEntryTable').html(response);
    //     const tbodyLength = $('.duplicateEntryTable > table > tbody > tr').length;
    //     if (tbodyLength > 1) {
    //       let customer_type = $('#customer_type').val();
    //       let customer_name = $("#customer_form").find('#first_name').val() + " " + $("#customer_form").find('#last_name').val();
    //       let business_name = $("#customer_form").find('#business_name').val()
    //       if (customer_type == "Residential") {
    //         $('.customerNameType').text('Customer');
    //         $('.duplicateCustomer').text(customer_name);
    //       } else if (customer_type == "Commercial" || customer_type == "Business") {
    //         $('.customerNameType').text('Business');
    //         $('.duplicateCustomer').text(business_name);
    //       }
    //       $('.duplicateWarningModal').modal('show');
    //     } else {
    //       $.ajax({
    //           type: "POST",
    //           url: URL_ORIGIN + "/Customer/save_customer_profile",
    //           data: customerData,
    //           success: function (response) {
    //             // alert('save successfully!');
    //           }
    //         });
    //     }
    //   }
    // });
});

function removeCustomer(customerID) {
  const URL_ORIGIN = window.origin;
  Swal.fire({
    icon: "warning",
    title: "Remove Customer",
    text: "Are you sure you want to remove Customer " + $("#customer_form").find('#first_name').val() + " " + $("#customer_form").find('#last_name').val() + "?",
    showCancelButton: true,
    confirmButtonText: "Remove",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: URL_ORIGIN + "/Customer/ajax_delete_customer",
        data: "cid=" + customerID,
        success: function (response) {
          Swal.fire({
            title: "Removed Successfully!",
            icon: "success",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "OK"
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.reload(true);
            }
          });
        }
      });
    } 
  });
}

function viewCustomer(customerID) {
  const URL_ORIGIN = window.origin;
  const left = (screen.width - 1280) / 2;
  const top = (screen.height - 720) / 2;
  window.open(URL_ORIGIN + "/customer/module/" + customerID, "Customer Dashboard", "width=" + 1280 + ", height=" + 720 + ", top=" + top + ", left=" + left);
}

async function autoSaveForm() {
  const customer_form = $("#customer_form").serialize();
  const URL_ORIGIN = window.origin;
  
  // Check if the Customer already exist in database
  // $.ajax({
  //   type: "POST",
  //   url: URL_ORIGIN + "/Customer/checkCustomerDuplicate",
  //   data: customer_form,
  //   success: function (response) {
  //     $('.duplicateEntryTable').html(response);
  //     $('.duplicateWarningModal').modal('show');
  //   }
  // });

  // const formArray = $form.serializeArray();
  // const payload = {};
  // formArray.forEach(({ name, value }) => (payload[name] = value));

  // const prefixURL = "";
  // // const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  // const duplicateResp = await fetch(
  //   `${prefixURL}/Customer_Form/apiCheckDuplicate`,
  //   {
  //     method: "post",
  //     body: JSON.stringify(payload),
  //     headers: {
  //       accept: "application/json",
  //       "content-type": "application/json",
  //     },
  //   }
  // );

  // const duplicateRespJson = await duplicateResp.json();
  // if (duplicateRespJson.data && duplicateRespJson.message) {
  //   return;
  // }


  // const saveResp = await fetch(`${prefixURL}/Customer/save_customer_profile`, {
  //   method: "post",
  //   body: new FormData($form.get(0)),
  // });

  // return saveResp.json();
}
