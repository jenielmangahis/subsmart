import {
  onClickViewEsign,
  importEsignToCustomer,
} from "../../../customer/dashboard/modules/utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const $modal = document.getElementById("searchesignmodal");
  const $input = $modal.querySelector("#esignsearch");
  const $results = $modal.querySelector("#esignsearchresults");
  const $emptyMessage = $modal.querySelector(".nsm-empty");
  const $loader = $modal.querySelector("#esignsearchloader");
  const $template = $modal.querySelector("#esignsearchresulttemplate");  

  let typingTimeout = undefined;

  $input.addEventListener("keyup", function (event) {
    window.clearTimeout(typingTimeout);
    typingTimeout = window.setTimeout(onFinishTyping, 500);
  });

  async function onFinishTyping() {
    const query = $input.value;

    if (!query.length) {
      return;
    }

    showLoader();
    const response = await fetch(`/DocuSign/apiSearchDocument?query=${query}`);
    const jsonData = await response.json();

    if (!Array.isArray(jsonData.data) || !jsonData.data.length) {
      showEmptyMessage();
    } else {
      const $wrapper = document.createDocumentFragment();
      jsonData.data.forEach((item) => {
        const $item = document.importNode($template.content, true);
        if( item.unique_key === null  ){
          $item.querySelector(".docfile-id").textContent = '---';
        }else{
          $item.querySelector(".docfile-id").innerHTML = "<i class='bx bx-file'></i> "+item.unique_key;  
        }
          
        if( item.customer_firstname === null && item.customer_lastname === null ){
          $item.querySelector(".customer").innerHTML = "<i class='bx bx-user'></i> Customer : Customer Not Found";           
        }else{
          $item.querySelector(".customer").innerHTML = "<i class='bx bx-user'></i> Customer : " + item.customer_firstname + ' ' + item.customer_lastname;        
        }     

        $item.querySelector(".subject").innerHTML = "<i class='bx bx-info-circle'></i> Subject : " + item.subject;             

        const actions = {
          view: onClickViewEsign,
          import: importEsignToCustomer,
        };

        const buttons = $item.querySelectorAll("[data-action]");
        buttons.forEach(($button) => {
          const action = actions[$button.dataset.action];
          $button.setAttribute("data-id", item.id);
          $button.setAttribute("data-document-type", "esign");

          if (action) {
            $button.setAttribute("data-id", item.id);
            $button.setAttribute("data-document-type", "esign");
            $button.addEventListener("click", action);
          }
        });

        $wrapper.appendChild($item);
      });

      $results.innerHTML = "";
      $results.appendChild($wrapper);
      showResult();
    }
  }

  function showLoader() {
    $loader.classList.add("d-flex");
    $loader.classList.remove("d-none");

    $results.classList.add("d-none");
    $emptyMessage.classList.add("d-none");
  }

  function showResult() {
    $results.classList.add("d-flex");
    $results.classList.remove("d-none");

    $loader.classList.add("d-none");
    $emptyMessage.classList.add("d-none");
  }

  function showEmptyMessage() {
    $emptyMessage.classList.add("d-flex");
    $emptyMessage.classList.remove("d-none");

    $loader.classList.add("d-none");
    $results.classList.add("d-none");
  }

  $($modal).on("show.bs.modal", function (e) {
    showEmptyMessage();
    $input.value = "";
  });
  $($modal).on("shown.bs.modal", function (e) {
    $input.focus();
  });
});
