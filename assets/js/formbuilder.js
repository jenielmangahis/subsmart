// import "https://formio.github.io/formio.js/#";

// const formBaseUrl = "http://localhost/nsmartrac/"; // local
const formBaseUrl = `${window.location.origin}/`; // online
let form = null;
let formElements = null;
// =====================================
//     GLOBAL VALUES AND FUNCTIONS
// =====================================
const elementsList = [
  {
    id: 1,
    type: "radio-button",
    category: "common",
  },
  {
    id: 2,
    type: "dropdown",
    category: "common",
  },
  {
    id: 3,
    type: "checkbox",
    category: "common",
  },
  {
    id: 4,
    type: "email-address",
    category: "common",
  },
  {
    id: 5,
    type: "long-answer",
    category: "common",
  },
  {
    id: 6,
    type: "short-answer",
    category: "common",
  },
  {
    id: 7,
    type: "calendar",
    category: "common",
  },
  {
    id: 8,
    type: "number",
    category: "common",
  },
  {
    id: 9,
    type: "file-upload",
    category: "common",
  },
  {
    id: 10,
    type: "text-list",
    category: "common",
  },
  {
    id: 11,
    type: "rating",
    category: "common",
  },
  {
    id: 12,
    type: "ranking",
    category: "common",
  },
  {
    id: 13,
    type: "hidden-field",
    category: "common",
  },
  {
    id: 14,
    type: "signature",
    category: "common",
  },
  {
    id: 15,
    type: "image-list",
    category: "common",
  },
  {
    id: 16,
    type: "calculation",
    category: "common",
  },
  {
    id: 17,
    type: "credit-card",
    category: "common",
  },
  {
    id: 18,
    type: "contact-block",
    category: "common",
  },
  {
    id: 19,
    type: "save-and-return",
    category: "common",
  },
  {
    id: 20,
    type: "heading",
    category: "format",
  },
  {
    id: 21,
    type: "formatted-text",
    category: "format",
  },
  {
    id: 22,
    type: "image",
    category: "format",
  },
  {
    id: 23,
    type: "link",
    category: "format",
  },
  {
    id: 24,
    type: "custom-code",
    category: "format",
  },
  {
    id: 25,
    type: "blank-space",
    category: "format",
  },
  {
    id: 26,
    type: "page-break",
    category: "format",
  },
  {
    id: 27,
    type: "block-text",
    category: "format",
  },
  {
    id: 29,
    type: "dropdown-email-routing",
    category: "email",
  },
  {
    id: 30,
    type: "order-form-table-list",
    category: "order-form",
  },
  {
    id: 31,
    type: "order-form-table-list",
    category: "order-form-table",
  },
  {
    id: 32,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 33,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 34,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 35,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 36,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 37,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 38,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 39,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 40,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 41,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 42,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 43,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 44,
    type: "checkbox-email-routing",
    category: "email",
  },
  {
    id: 45,
    type: "radio-button-matrix",
    category: "matrix-items",
  },
  {
    id: 46,
    type: "radio-button-multi-scale",
    category: "matrix-items",
  },
  {
    id: 47,
    type: "dropdown-matrix",
    category: "matrix-items",
  },
  {
    id: 48,
    type: "dropdown-multi-scale",
    category: "matrix-items",
  },
  {
    id: 49,
    type: "checkbox-matrix",
    category: "matrix-items",
  },
  {
    id: 50,
    type: "checkbox-multi-scale",
    category: "matrix-items",
  },
  {
    id: 51,
    type: "short-answer-matrix",
    category: "matrix-items",
  },
  {
    id: 52,
    type: "long-answer-matrix",
    category: "matrix-items",
  },
  {
    id: 53,
    type: "star-matrix",
    category: "matrix-items",
  },
  {
    id: 54,
    type: "zone-information-table",
    category: "matrix-items",
  },
  {
    id: 55,
    type: "container-block",
    category: "containers",
  },
];

let bInfo = null;
// =====================================
//            VIEW PAGE
// =====================================

// for signature canvas

// this function runs upon page load
loadFormSettings = async (id) => {
  await $.ajax({
    url: `${formBaseUrl}formbuilder/form/view/${id}`,
    dataType: "json",
    type: "GET",
    success: function (res) {
      form = res.data;
      document.querySelector("#txtFormName").value = res.data.forms_title;
      document.querySelector("#txtPrivateNotes").value =
        res.data.forms_private_note;
      document.querySelector("#txtSocialDescription").value =
        res.data.forms_social_desc;
      document.querySelector("#txtFormToggleStart").checked =
        res.data.forms_use_start_date == 1 ? true : false;
      document.querySelector("#txtFormToggleEnd").checked =
        res.data.forms_use_closing_date == 1 ? true : false;
      document.querySelector("#txtFormToggleResult").checked =
        res.data.forms_use_results_limit == 1 ? true : false;
      document.querySelector("#txtStartDate").value = res.data.forms_start_date;
      document.querySelector("#txtStartTime").value = res.data.forms_start_time;
      document.querySelector("#txtStartMessageTitle").value =
        res.data.forms_start_title;
      document.querySelector("#txtStartMessageContent").value =
        res.data.forms_start_message;
      document.querySelector("#txtEndDate").value = res.data.forms_end_date;
      document.querySelector("#txtEndTime").value = res.data.forms_end_time;
      document.querySelector("#txtEndMessageTitle").value =
        res.data.forms_end_title;
      document.querySelector("#txtEndMessageContent").value =
        res.data.forms_end_message;
      document.querySelector("#txtResultsLimit").value =
        res.data.forms_results_limit;
      document.querySelector("#txtResultsMessageTitle").value =
        res.data.forms_results_max_title;
      document.querySelector("#txtResultsMessageContent").value =
        res.data.forms_results_max_message;
      document.querySelector("#txtResultsMessageContent").value =
        res.data.forms_results_max_message;

      document.querySelector("#txtRedirectLink").value =
        res.data.forms_redirect_link;
      document.querySelector("#txtSuccessTitle").value =
        res.data.forms_success_title;
      document.querySelector("#txtSuccessMessage").value =
        res.data.forms_success_message;
      document.querySelector("#chkSubmitAnotherResponse").checked =
        res.data.forms_show_repeat_form_check == 1 ? true : false;
      document.querySelector("#fTFontFamily").value =
        res.data.forms_title_font_family;
      document.querySelector("#fTFontSize").value =
        res.data.forms_title_font_size;
      document.querySelector("#fLFontFamily").value =
        res.data.forms_label_font_family;
      document.querySelector("#fLFontSize").value =
        res.data.forms_label_font_size;
      document.querySelector("#formsTermsAndConditions").value =
        res.data.forms_terms_and_conditions_id;

      return;
    },
  });
};

const loadFormElements = async (id, mode = null, isOnLoad = false) => {
  // document.querySelector("#windowPreviewContent").innerHTML = "";
  // const titlesFontFamily = document.getElementById("fTFontFamily").value;
  // const titlesFontSize = document.getElementById('fTFontSize').value;
  // const labelsFontFamily = document.getElementById('fLFontFamily').value;
  // const labelsFontSize = document.getElementById('fLFontSize').value;
  isOnLoad ? await loadImageHeader() : "";
  document.querySelector("#windowPreviewContent").innerHTML = "";
  getTermsAndConditionsByCompany();
  await $.ajax({
    url: `${formBaseUrl}formbuilder/form/element/get/${id}`,
    dataType: "json",
    type: "GET",
    success: function (res) {
      const titlesFontFamily = res.form.forms_title_font_family || "";
      const titlesFontSize = res.form.forms_title_font_size || "";
      const labelsFontFamily = res.form.forms_label_font_family || "";
      const labelsFontSize = res.form.forms_label_font_size || "";
      formElements = res.form_elements;
      res.form_elements.forEach((el) => {
        const elementType = el.fe_element_id;
        let choices = [];
        let zoneLength = el.fe_zone_length;
        let zoneTBody = "";
        for (let index = 0; index < zoneLength; index++) {
          zoneTBody += `
              <tr>
                <td class="p-2 text-center"><input type="checkbox" id="entryExitChk${
                  el.fe_id
                }I${index}" name="entryExitChk${
            el.fe_id
          }I${index}" value="entryExitChk${el.fe_id}I${index}"></td>
                <td class="p-2 text-center">${index + 1}</td>
                <td class="p-2 text-center"><input type="checkbox" id="verified${
                  el.fe_id
                }I${index}" name="verified${
            el.fe_id
          }I${index}" value="verified${el.fe_id}I${index}"></td>
                <td class="p-2"><input class="form-control bg-whitesmoke" type="text" id="location${
                  el.fe_id
                }I${index}" name="location${el.fe_id}I${index}"></td> 
              </tr>
          `;
        }

        if (mode !== "edit") {
          setTimeout(() => {
            getProductSelection(el.fe_id);
          }, 500);
        }

        if (
          elementType == 1 ||
          elementType == 2 ||
          elementType == 3 ||
          elementType >= 44
        ) {
          choices = JSON.parse(
            $.ajax({
              url: `${formBaseUrl}formbuilder/form/element/choices/${el.fe_id}`,
              dataType: "json",
              type: "GET",
              async: false,
            }).responseText
          ).data;
        }

        if (elementType >= 15 && elementType < 30) {
          let container = (el.fe_block_id != 0 && el.fe_block_id != null)
            ? `#form-element-${el.fe_block_id} .droppable`
            : "#windowPreviewContent";
          document.querySelector(container).innerHTML += `
          
            ${
              elementType == 14
                ? `
              <!-- Image -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                    el.fe_span == 6 ? "col-sm-4" : ""
                  } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                    el.fe_span == 3 ? "col-sm-8" : ""
                  } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2 " ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                
                <img src="${formBaseUrl}uploads/formbuilder/db/img/img_${
                    el.fe_id
                  }_${
                    el.fe_form_id
                  }.jpg" class="img-fluid w-100 form-user-elements">
              </div>
            `
                : ""
            }
            
            ${
              elementType == 20
                ? `
              <!-- Header -->
              <div id="form-element-${
                el.fe_id
              }" class="draggable bg-primary text-white col-xs-12 col-sm-12 px-2" ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                <h1 class="form-user-elements">${el.fe_label}</h1>
              </div>
            `
                : ""
            }

            ${
              elementType == 21
                ? `
              <!-- Text -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""}  ${
                    el.fe_span == 6 ? "col-sm-4" : ""
                  } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                    el.fe_span == 3 ? "col-sm-8" : ""
                  } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2 " ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                  
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                ${
                  el.fe_is_title == 1
                    ? `
                  <p class="${titlesFontFamily} ${titlesFontSize}" class="form-user-elements mt-3 ">${el.fe_label}</p>
                `
                    : ""
                }
                ${
                  el.fe_is_title == 0
                    ? `
                  <p class="${labelsFontFamily} ${labelsFontSize}" class="form-user-elements mt-3 ">${el.fe_label}</p>
                `
                    : ""
                }                
              </div>
            `
                : ""
            }

            ${
              elementType == 22
                ? `
              <!-- Image -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                    el.fe_span == 6 ? "col-sm-4" : ""
                  } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                    el.fe_span == 3 ? "col-sm-8" : ""
                  } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2 " ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                  <img src="https://via.placeholder.com/150" alt="image" class="form-user-elements" style="width: 100%; height; 300px;">
              </div>
            `
                : ""
            }

            ${
              elementType == 23
                ? `
              <!-- Link -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                    el.fe_span == 6 ? "col-sm-4" : ""
                  } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                    el.fe_span == 3 ? "col-sm-8" : ""
                  } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2 " ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                <a href="${el.fe_default_value}" class="form-user-elements">${
                    el.fe_label
                  }</a>
              </div>
            `
                : ""
            }

            ${
              elementType == 25
                ? `
              <!-- Blank space -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                    el.fe_is_pagebreak == 1 ? "pdf-pagebreak" : ""
                  } ${el.fe_span == 6 ? "col-sm-4" : ""} ${
                    el.fe_span == 2 ? "col-sm-6" : ""
                  } ${el.fe_span == 3 ? "col-sm-8" : ""} ${
                    el.fe_span == 4 ? "col-sm-12" : ""
                  } form-user-elements" ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>
                <span class="form-user-elements"></span>
                ${mode == "edit" ? "/ Blank space /" : ""}
                <br/>
              </div>
            `
                : ""
            }

            ${
              elementType == 27
                ? `
              <!-- Block Text -->
              <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
                    el.fe_span == 5 ? "col-sm-2" : ""
                  } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                    el.fe_span == 6 ? "col-sm-4" : ""
                  } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                    el.fe_span == 3 ? "col-sm-8" : ""
                  } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2" ${
                    mode == "edit"
                      ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                      : ""
                  }>
                <div id="form-elements-settings-${
                  el.fe_id
                }" class="form-elements-settings-hover" style="position: absolute; display: none">
                  <div class="btn-group" style="margin-y: auto">
                    <button class="btn btn-sm btn-info" onclick="editElement(${
                      el.fe_id
                    })"><i class="fa fa-edit"></i> Edit</button>
                    <button class="btn btn-sm btn-info" onclick="copyElement(${
                      el.fe_id
                    })"><i class="fa fa-copy"></i> Copy</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                      el.fe_id
                    })"><i class="fa fa-trash"></i> Delete</button>
                  </div>
                </div>

                <div class="border p-2 form-user-elements">
                  <p>
                    ${el.fe_label}
                  </p>
                </div>
                
              </div>
            `
                : ""
            }

          `;
        } else if (elementType >= 54 && elementType <= 54) {
          let container = (el.fe_block_id != 0 && el.fe_block_id != null)
            ? `#form-element-${el.fe_block_id} .droppable`
            : "#windowPreviewContent";
          document.querySelector(container).innerHTML += `
          ${
            elementType == 54
              ? `
          <!-- Container -->
          <div id="form-element-${el.fe_id}" class="draggable col-12 px-2 sortable">
              <div class="container" id="containerBlockWrappwer">
                <div class="row droppable bg-lgray py-2" id="containerBlockDroppable">
                    
                </div>
              </div>
          </div>
        `
              : ""
          }
        `;
        } else {
          let container = (el.fe_block_id != 0 && el.fe_block_id != null)
            ? `#form-element-${el.fe_block_id} .droppable`
            : "#windowPreviewContent";
          document.querySelector(container).innerHTML += `
            <div id="form-element-${el.fe_id}" class="draggable col-xs-12 ${
            el.fe_span == 5 ? "col-sm-2" : ""
          } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
            el.fe_span == 6 ? "col-sm-4" : ""
          } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
            el.fe_span == 3 ? "col-sm-8" : ""
          } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2" ${
            mode == "edit"
              ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
              : ""
          }>
              ${
                mode == "edit"
                  ? `
                  <div id="form-elements-settings-${el.fe_id}" class="form-elements-settings-hover" style="position: absolute; display: none">
                    <div class="btn-group" style="margin-y: auto">
                      <button class="btn btn-sm btn-info" onclick="editElement(${el.fe_id})"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-info" onclick="copyElement(${el.fe_id})"><i class="fa fa-copy"></i> Copy</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteElement(${el.fe_id})"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                  </div>
                `
                  : ""
              }
  
              ${
                elementType == 1
                  ? `
                <!-- Radio -->
                <label class="${titlesFontFamily} ${titlesFontSize}" for="feinput-${
                      el.fe_id
                    }"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                ${choices
                  .map(
                    (choice, i) => `
                  <div class="form-check form-user-elements">
                    <input type="radio" name="feinput-${
                      el.fe_id
                    }" id="feinput-${el.fe_id}-${i}" class="form-check-input" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  placeholder="${
                      el.fe_placeholder_text
                    }" value="choice.fc_choice">
                    <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${
                      el.fe_id
                    }-${i}">${choice.fc_choice}</label>
                  </div>
                `
                  )
                  .join("")}
                
              `
                  : ""
              }
  
              ${
                elementType == 2
                  ? `
                <!-- dropdown -->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${
                      el.fe_id
                    }">${el.fe_label}</label>
                  <select id="feinput-${el.fe_id}" name="feinput-${
                      el.fe_id
                    }" class="custom-select" ${
                      el.fe_is_required == 1 ? "required" : ""
                    } >
                    ${choices
                      .map(
                        (choice) => `
                      <option>${choice.fc_choice}</option>
                    `
                      )
                      .join("")}
                  </select>
                </div>
              `
                  : ""
              }
              
              ${
                elementType == 3
                  ? `
                <!-- Checkbox -->
                <label class="${titlesFontFamily} ${titlesFontSize}" for="feinput-${
                      el.fe_id
                    }"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                ${
                  el.fe_span == 1
                    ? `
                  ${choices
                    .map(
                      (choice, i) => `
                    <div class="form-check form-user-elements">
                      <input type="checkbox" name="feinput-${el.fe_id}-chk-${i}" id="feinput-${el.fe_id}-chk" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="${choice.fc_choice}">
                      <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                    </div>
                    `
                    )
                    .join("")}
                `
                    : `
                  <div class="row container-fluid form-user-elements">
                    ${choices
                      .map(
                        (choice, i) => `
                      <div class="col text-left form-check form-check-inline ">
                        <input type="checkbox" name="feinput-${el.fe_id}-chk-${i}" id="feinput-${el.fe_id}-chk" class="form-check-input" placeholder="${el.fe_placeholder_text}" value="${choice.fc_choice}">
                        <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${el.fe_id}-${i}">${choice.fc_choice}</label>
                      </div>
                    `
                      )
                      .join("")}
                  </div>
                `
                }
              `
                  : ""
              }
              
              
              ${
                elementType == 6 || elementType == 4
                  ? `
                <!-- Short answer / Email -->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize} text-nowrap" for="feinput-${
                      el.fe_id
                    }"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                  <input type="text" name="feinput-${el.fe_id}" id="feinput-${
                      el.fe_id
                    }" class="form-control" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  placeholder="${el.fe_placeholder_text}" value="${
                      el.fe_default_value
                    }">
                </div>
              `
                  : ""
              }

              ${
                elementType == 5 || elementType == 10
                  ? `
                <!-- Long answer / Email List -->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${
                      el.fe_id
                    }"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                  <textarea name="feinput-${el.fe_id}" id="feinput-${
                      el.fe_id
                    }" class="form-control" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  placeholder="${el.fe_placeholder_text}" value="${
                      el.fe_default_value
                    }"></textarea>
                </div>
              `
                  : ""
              }
  
              ${
                elementType == 7
                  ? `
                <!-- Date -->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${
                      el.fe_id
                    }-date"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                  <input type="date" name="feinput-${
                    el.fe_id
                  }-date" id="feinput-${el.fe_id}-date" class="form-control" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  placeholder="${el.fe_placeholder_text}" value="${
                      el.fe_default_value
                    }"/>
                </div>
              `
                  : ""
              }
              
              ${
                elementType == 8
                  ? `
                <!-- Number -->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize}" for="feinput-${
                      el.fe_id
                    }"> ${
                      el.fe_is_required == 1
                        ? `<span class="text-danger"><strong>*</strong></span>`
                        : ""
                    } ${el.fe_label}</label>
                  <input type="number" name="feinput-${el.fe_id}" id="feinput-${
                      el.fe_id
                    }" class="form-control" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  placeholder="${el.fe_placeholder_text}" value="${
                      el.fe_default_value
                    }">
                </div>
              `
                  : ""
              } 
  
              ${
                elementType == 9
                  ? `
                <!-- fix this part -->
                <!-- File Upload-->
                <div class="form-group form-user-elements">
                  <label class="${labelsFontFamily} ${labelsFontSize}" for="${
                      el.fe_id
                    }">${el.fe_label}</label>
                  <input type="file" name="feinput-${el.fe_id}" ${
                      el.fe_is_required == 1 ? "required" : ""
                    }  id="feinput-${el.fe_id}" >
                </div>
              `
                  : ""
              }

              ${
                elementType == 14
                  ? `
                <!-- Signature -->
                <div el_id="${el.fe_id}" id="form-element-${
                      el.fe_id
                    }" class="draggable signature-canvas-container col-xs-12 ${
                      el.fe_span == 5 ? "col-sm-2" : ""
                    } ${el.fe_span == 1 ? "col-sm-3" : ""} ${
                      el.fe_span == 6 ? "col-sm-4" : ""
                    } ${el.fe_span == 2 ? "col-sm-6" : ""} ${
                      el.fe_span == 3 ? "col-sm-8" : ""
                    } ${el.fe_span == 4 ? "col-sm-12" : ""} px-2 d-block" ${
                      mode == "edit"
                        ? `onmouseover="toggleElementSettings(${el.fe_id}, 1)" onmouseleave="toggleElementSettings(${el.fe_id}, 0)"`
                        : ""
                    }>
                  <div id="form-elements-settings-${
                    el.fe_id
                  }" class="form-elements-settings-hover" style="position: absolute; display: none">
                    <div class="btn-group" style="margin-y: auto">
                      <button class="btn btn-sm btn-info" onclick="editElement(${
                        el.fe_id
                      })"><i class="fa fa-edit"></i> Edit</button>
                      <button class="btn btn-sm btn-info" onclick="copyElement(${
                        el.fe_id
                      })"><i class="fa fa-copy"></i> Copy</button>
                      <button class="btn btn-sm btn-danger" onclick="deleteElement(${
                        el.fe_id
                      })"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                  </div>

                    <label class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-nowrap" for="${
                      el.fe_id
                    }">${el.fe_label}</label>
                    <canvas id="feinput-${el.fe_id}" name="feinput-${
                      el.fe_id
                    }" class="border" height="150" ></canvas>
                    <div class="container mt-1">
                      <div class="btn-group mx-auto signature-button-container">
                          <button onclick="clearCanvas(${
                            el.fe_id
                          })" type="button" class="btn btn-sm btn-secondary">clear</button>
                          <button onclick="enableCanvas(${
                            el.fe_id
                          })" type="button" class="btn btn-sm btn-primary">Sign</button>
                          <button onclick="disableCanvas(${
                            el.fe_id
                          })" type="button" class="btn btn-sm btn-success">done</button>
                      </div>
                  </div>
                </div>
              `
                  : ""
              }
              

              ${
                elementType == 44
                  ? `
                <!-- Radio Button Matrix -->
                <table class="table table-hover form-user-elements">
                  <thead>
                    <tr>
                      <th>${el.fe_label}</th>
                      ${choices
                        .map(
                          (choice, i) => `
                        ${
                          choice.fc_row == null
                            ? `<th>${choice.fc_choice}</th>`
                            : ""
                        }
                      `
                        )
                        .join("")}
                      </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ${choices
                        .map(
                          (choice, rowIndex) =>
                            `<tr>
                          ${
                            choice.fc_column == null
                              ? `
                            <td>${choice.fc_choice}</td>
                            ${choices
                              .map(
                                (cell, columnIndex) =>
                                  `
                                ${
                                  cell.fc_row == null
                                    ? `
                                <td>
                                <div class="form-check">
                                  ${columnIndex}
                                  <input class="form-check-input" type="radio" name="feinput-${el.fe_id}-radmtx-${rowIndex}" id="feinput-${el.fe_id}-radmtx-${rowIndex}-${columnIndex}" value="${choice.fc_choice}">
                                </div>
                              </td>
                                `
                                    : ``
                                }
                              `
                              )
                              .join("")}
                          `
                              : ""
                          }
                        </tr>`
                        )
                        .join("")}
                    </tr>
                  </tbody>
                </table>
              `
                  : ""
              }

              ${
                elementType == 30
                  ? `
              <!-- product table list-->
                <div class="container-fluid ">
                  <p class="${titlesFontFamily} ${titlesFontFamily}">${el.fe_label}</p>
                  <table class="table form-user-elements" id="table-${el.fe_id}">
                    <thead>
                        <tr>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Product</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Quantity</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Location</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Price (Tax: +7.5%)</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="table-product-list-${el.fe_id}"></tbody>
                  </table>
                  <div class="d-flex w-100 justify-content-between">
                    <div class="form-group">
                      <select name="selProduct-${el.fe_id}" id="selProduct-${el.fe_id}" class="product-dropdowns custom-select-sm">
                        
                      </select>
                    </div>
                    <button type="button" onclick="addProductToTable(${el.fe_id})" id="btnAddProduct" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Product</button>
                  </div>
                  <hr/>
                  <div class="text-right">
                    <!--
                      <span id="table-product-tax-addition-${el.fe_id}" class="text-left">Tax: <strong>25%</strong> (+ $0.00)</span><br/>
                    -->
                    <span id="table-product-total-price-all-${el.fe_id}" class="text-left">Total: <strong>$0.0</strong></span>
                  </div>
                </div>
                
              `
                  : ""
              }
              ${
                elementType == 31
                  ? `
              <!-- equipment table list-->
                ${
                  mode == "edit"
                    ? ""
                    : `
                    ${setTimeout(() => {
                      getProductSelection(el.fe_id);
                    }, 500)}
                  `
                }
                <div class="container-fluid ">
                  <p class="${titlesFontFamily} ${titlesFontFamily}">${
                      el.fe_label
                    }</p>
                  <table class="table form-user-elements" id="table-${
                    el.fe_id
                  }">
                    <thead>
                        <tr>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Product</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">QTY</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Price</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-left">Total</th>
                            <th class="${labelsFontFamily} ${labelsFontSize} font-weight-bold text-right">Stock</th>
                        </tr>
                    </thead>
                    <tbody id="table-product-list-${el.fe_id}"></tbody>
                  </table>
                  <div class="d-flex w-100 justify-content-between">
                    <div class="form-group">
                      <select name="selProduct-${el.fe_id}" id="selProduct-${
                      el.fe_id
                    }" class="product-dropdowns custom-select-sm">
                        
                      </select>
                    </div>
                    <button type="button" onclick="addProductToTable(${
                      el.fe_id
                    })" id="btnAddProduct" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add New Product</button>
                  </div>
                  <hr/>
                  <div class="text-right">
                    <!--
                      <span id="table-product-tax-addition-${
                        el.fe_id
                      }" class="text-left">Tax: <strong>25%</strong> (+ $0.00)</span><br/>
                    -->
                    <span id="table-product-total-price-all-${
                      el.fe_id
                    }" class="text-left">Total: <strong>$0.0</strong></span>
                  </div>
                </div>
                
              `
                  : ""
              }
              ${
                elementType == 48
                  ? `
                <!-- Checkbox Matrix -->
                <table class="table table-hover form-user-elements">
                  <thead>
                    <tr>
                      <th>${el.fe_label}</th>
                      ${choices
                        .map((choice, i) =>
                          choice.fc_row == null
                            ? `<th>${choice.fc_choice}</th>`
                            : ""
                        )
                        .join("")}
                      </tr>
                  </thead>
                  <tbody>
                      ${choices
                        .map(
                          (choice, rowIndex) =>
                            `<tr>
                          ${
                            choice.fc_column == null
                              ? `
                            <td>${choice.fc_choice}</td>
                            ${choices
                              .map(
                                (cell, columnIndex) =>
                                  `
                                ${
                                  cell.fc_row == null
                                    ? `
                                <td>
                                <div class="form-check">
                                  <input class="form-check-input custom-input" type="checkbox" name="feinput-${el.fe_id}-chkmtx-${rowIndex}-${columnIndex}" id="feinput-${el.fe_id}-chkmtx-${rowIndex}-${columnIndex}">
                                </div>
                              </td>
                                `
                                    : ``
                                }
                              `
                              )
                              .join("")}
                          `
                              : ""
                          }
                        </tr>`
                        )
                        .join("")}
                  </tbody>
                  
                </table>
                
              `
                  : ""
              }
              ${
                elementType == 50
                  ? `
                <!-- Short Answer Matrix -->
                <table class="table table-hover form-user-elements">
                <h5>${el.fe_label}</h5>
                  <thead>
                    <tr>
                      <th>No.</th>
                      ${choices
                        .map((choice, i) =>
                          choice.fc_row == null
                            ? `<th>${choice.fc_choice}</th>`
                            : ""
                        )
                        .join("")}
                      </tr>
                  </thead>
                  <tbody>
                      ${choices
                        .map(
                          (choice, rowIndex) =>
                            `<tr>
                          ${
                            choice.fc_column == null
                              ? `
                            <td>${rowIndex + 1}</td>
                            ${choices
                              .map(
                                (cell, columnIndex) =>
                                  `
                                ${
                                  cell.fc_row == null
                                    ? `
                                  <td>
                                    <div class="form-group">
                                      <input class="form-control" type="text" name="feinput-${el.fe_id}-txtmtx-${rowIndex}-${columnIndex}" id="feinput-${el.fe_id}-txtmtx-${rowIndex}-${columnIndex}">
                                    </div>
                                  </td>
                                `
                                    : ``
                                }
                              `
                              )
                              .join("")}
                          `
                              : ""
                          }
                        </tr>`
                        )
                        .join("")}
                  </tbody>
                </table>
                
              `
                  : ""
              }

              ${
                elementType == 53
                  ? `
              <!-- Zone Information Table -->
              <div class="bg-lgray p-2">
                <table class="table table-hover form-user-elements">
                ${
                  el.fe_label
                    ? `<p class="${titlesFontFamily} ${titlesFontSize}">${el.fe_label}</p>`
                    : ""
                }
                  <thead>
                    <tr>
                      <th class="text-center ${labelsFontFamily} font-weight-bold" style="width: 10%">Entry/Exit</th>
                      <th class="text-center ${labelsFontFamily} font-weight-bold" style="width: 10%">Zn #</th>
                      <th class="text-center ${labelsFontFamily} font-weight-bold" style="width: 10%">Verified</th>
                      <th class="text-center ${labelsFontFamily} font-weight-bold" style="width: 70%">Location</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ${zoneTBody}
                    </tr>
                  </tbody>
                </table>
              </div>
            `
                  : ""
              }
            </div>
          `;
        }

        // setup canvas
        if (elementType == 14) {
          loadSignatureCanvas(elementType, el.fe_id);
        }
      });

      initCanvas();
      return;
    },
  });
};
if (form && form.forms_terms_and_conditions_id) {
  console.log(form.forms_terms_and_conditions_id);
  document.querySelector("#windowPreviewContent").innerHTML += `
        <div class="col-12 mt-2 text-center form-group">
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="companyTNCs">
            <label class="form-check-label" for="companyTNCs">I have read and agree to the <a class="text-info" target="_blank" onclick="window.open('${formBaseUrl}terms-and-conditions/view', '_blank')">Terms and Conditions</a>.
            </label>
          </div>
        </div>
      `;
}

loadSignatureCanvas = (elementType, id, size) => {
  setTimeout(() => {
    window[`signPad${id}`] = new SignaturePad(
      document.querySelector(`canvas#feinput-${id}`),
      {
        backgroundColor: "rgb(255, 255, 255)",
      }
    );
  }, 1000);
};

clearCanvas = (id) => {
  window[`signPad${id}`].clear();
};

const initCanvas = () => {
  const collection = $(".signature-canvas-container");
  for (let el of collection) {
    const elID = $(el).attr("el_id");
    const canvas = window[`signPad${elID}`];
    if (canvas) {
      const ratio = Math.max(window.devicePixelRatio || 1, 1);
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
      // canvas.height(150)
    }
  }
};

const disableCanvas = (id) => {
  window[`signPad${id}`].off();
};

const enableCanvas = (id) => {
  window[`signPad${id}`].on();
};

const loadImageHeader = async () => {
  await $.ajax({
    url: `${formBaseUrl}formbuilder/get-active-company-data`,
    dataType: "json",
    type: "GET",
    success: function (res) {
      bInfo = res;
      document.querySelector("#headerImgContainer").innerHTML = `
        <div class="container py-2" id="header-img-container">
            <img src="${res.business_image}" alt="${res.business_name} logo" class="mx-auto d-block" width="60px">
        </div>
        `;
    },
  });
};

const getTermsAndConditionsByCompany = () => {
  $.ajax({
    url: `/terms-and-conditions/get-all`,
    method: "GET",
    success: (res) => {
      const data = res.data;
      data.forEach((el) => {
        $("#formsTermsAndConditions").append(`
              <option value="${el.id}">${el.title}</option>
          `);
      });
    },
  });
};
// =====================================
//            EDIT PAGE
// =====================================
