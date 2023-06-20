if (!window.screen.orientation) {
  console.info("using screen.orientation polyfill");
  window.screen.orientation = o9n.orientation;
}

if (isMobile()) {
  window.__ismobile = true;
  console.info("mobile device detected");
}

function Signing(hash) {
  
  const PDFJS = pdfjsLib;

  const $documentContainer = $(".signing__documentContainer");

  const $signatureModal = $("#signatureModal");

  const $signaturePad = $(".signing__signaturePad");
  const $signaturePadCanvas = $signaturePad.find("canvas");
  const $signaturePadClear = $signaturePad.find("a");
  const $signatureApplyButton = $("#signatureApplyButton");

  const $fontSelect = $("#fontSelect");
  const $signatureTextInput = $(".signing__signatureInput");

  const $finishSigning = $("[data-action=finish]");

  const prefixURL = "";

  let data = null;
  let signaturePad = null;

  const $statusIndicator = document.getElementById("statusindicator");

  async function fetchData() {
    const endpoint = `${prefixURL}/DocuSign/apiSigning?hash=${hash}`;
    const response = await fetch(endpoint);
    data = await response.json();
    window.__esigndata = data;
  }

  async function renderPage({ canvas, page, document }) {
    const documentPage = await document.getPage(page);
    const viewport = await documentPage.getViewport({ scale: 1.5 });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    await documentPage.render({
      viewport,
      canvasContext: canvas.getContext("2d"),
    });

    return canvas;
  }

  async function getPage({ page, ...rest }) {
    const html = `
      <div class="signing__documentPage" data-page="${page}">
        <canvas></canvas>
      </div>
    `;

    const $element = createElementFromHTML(html);
    const canvas = $element.find("canvas").get(0);

    await renderPage({ canvas, page, ...rest });
    return $element;
  }

  function getRenderField({ field, recipient }) {
    const { field_name, coordinates, id: fieldId, value: fieldValue, specs } = field;

    const { first_name, last_name, mail_add, city, state, zip_code, phone_h, phone_m, email, country, county_name, date_of_birth, ssn
     } = window.__esigndata.auto_populate_data.client;

    const { emergency_primary_contact_fname, emergency_primary_contact_lname, emergency_primary_contact_phone } = window.__esigndata.auto_populate_data.primary_emergency_contacts;

    const { emergency_secondary_contact_fname, emergency_secondary_contact_lname, emergency_secondary_contact_phone } = window.__esigndata.auto_populate_data.secondary_emergency_contacts;

    const { access_password } = window.__esigndata.auto_populate_data.acs_access;

    const { kw_dc, solar_system_size } = window.__esigndata.auto_populate_data.acs_info_solar;

    const { docusign_envelope_id } = window.__esigndata.auto_populate_data.user_customer_docfile;

    const { alarm_cs_account, monthly_monitoring, otps, passcode, panel_type } = window.__esigndata.auto_populate_data.acs_alarm;    

    const { bill_method, check_num, routing_num, card_fname, card_lname, acct_num, equipment, credit_card_exp, credit_card_exp_mm_yyyy, credit_card_num } = window.__esigndata.auto_populate_data.billing;

    const {  total_due, equipment_cost, first_month_monitoring, one_time_activation } = window.__esigndata.auto_populate_data.cost_due;
    
    let text = recipient[field_name.toLowerCase()];
    let { pageTop: top, left } = JSON.parse(coordinates);
    top = parseInt(top);
    left = parseInt(left);

    const container = document.querySelector(".signing__documentContainer");    
    const a_field_name = field_name;
    
    if ( field_name === "Total Due" ) {
      return total_due;
    }

    if( field_name == "City" ) {
      return city;
    }

    if( field_name == "State" ) {
      return state;
    }

    if( field_name == "County" ) {
      return county_name;
    }

    if( field_name == "ZIP" ) {
      return zip_code;
    }

    if( field_name == "Address" ) {
      return mail_add;
    }

    if( field_name == "Date of Birth" ) {
      return date_of_birth;
    }

    if( field_name == "Social Security Number" ) {
      return ssn;
    }

    if( field_name == "Subscriber Name" ) {
      return first_name + " " + last_name;
    }

    if( field_name == "Subscriber Email" ) {
      return email;
    }

    if( field_name == "Primary Contact Name" ){
      return emergency_primary_contact_fname + " " + emergency_primary_contact_lname;
    }

    if( field_name == "Primary Contact First Name" ){
      return emergency_primary_contact_fname;
    }

    if( field_name == "Primary Contact Last Name" ){
      return emergency_primary_contact_lname;
    }

    if( field_name == "Primary Contact Number" ){
      return emergency_primary_contact_phone;
    }


    if( field_name == "Secondary Contact Name" ){
      return emergency_secondary_contact_fname + " " + emergency_primary_contact_lname;
    }

    if( field_name == "Secondary Contact First Name" ){
      return emergency_secondary_contact_fname;
    }

    if( field_name == "Secondary Contact Last Name" ){
      return emergency_secondary_contact_lname;
    }

    if( field_name == "Secondary Contact Number" ){
      return emergency_secondary_contact_phone;
    }


    if( field_name == "Primary Contact" ){
      return phone_m;
    }

    if( field_name == "Secondary Contact" ){
      return phone_h;
    }

    if( field_name == "Access Password" ){
      return access_password;
    }

    if( field_name == "Equipment" ){
      return equipment;
    }

    if( field_name == "Esign Envelope ID" ){      
      return "Esign Envelope ID : " + docusign_envelope_id;
    }

    if( field_name == "Card Holder Name" ){
      return card_fname + " " + card_lname;
    }

    if( field_name == "Card Number" ){
      return credit_card_num;
    }

    if( field_name == "Checking Account Number" ){
      return check_num;
    }

    if( field_name == "Card Expiration" ){
      return credit_card_exp;
    }

    if( field_name == "ABA" ){
      return routing_num;
    }

    if( field_name == "CS Account Number" ){
      return alarm_cs_account;
    }

    if( field_name == "Abort Code" ){
      return passcode;
    }

    if( field_name == 'Account Number' ){
      return acct_num;
    }

    if( field_name == "Equipment Cost" ){
      return equipment_cost;
    }

    if( field_name == "One Time Activation (OTP)" ){
      return otps;
    }

    if( field_name == "Monthly Monitoring Rate" ){
      return monthly_monitoring;
    }

    if( field_name == "kW DC" ){
      return kw_dc;
    }

    if( field_name == "System Size" ){
      return solar_system_size;
    }
    
    if (field_name === "Text" && fieldValue === null ) {

      let specs_field_name = JSON.parse(specs);
      let unique_key
      if( specs_field_name.name === "card_number" || specs_field_name.name === "card_account_number" ) {
        return acct_num;
      }
      if( specs_field_name.name === "subscriber_name" ) {
        return first_name + " " + last_name;
      }
      
      if( specs_field_name.name === "subscriber_fname" ) {
        return first_name;
      }
      
      if( specs_field_name.name === "subscriber_lname" ) {
        return last_name;
      }
      
      if( specs_field_name.name === "phone_h" ) {
        return phone_h;
      }
      
      if( specs_field_name.name === "phone_m" ) {
        return phone_m;
      }
      
      if( specs_field_name.name === "address" || specs_field_name.name === "Address" ) {
        return mail_add;
      }
      
      if( specs_field_name.name === "city" || specs_field_name.name === "City" ) {
        return city;        
      }
      
      if( specs_field_name.name === "state" ) {
        return state;
      }

      if( specs_field_name.name === "zip_code" || specs_field_name.name === "zip" ) {
        return zip_code;
      }

      if( specs_field_name.name === "password" || specs_field_name.name === "Password" ) {
        return access_password;
      }

      if( specs_field_name.name === "checking_account_n" ) {
        return check_num;
      }

      if( specs_field_name.name === "aba" ) {
        return routing_num;
      }

      if( specs_field_name.name === "equipment_cost" ) {
        return equipment_cost;
      }

      if( specs_field_name.name === "one_time_activation" ) {
        return otps;
      }

      if( specs_field_name.name === "total_due" ) {
        return total_due;
      }

      if( specs_field_name.name === "first_month_monitoring" ) {
        return monthly_monitoring;
      }

      if( specs_field_name.name === "card_security_code" ) {
        return credit_card_exp_mm_yyyy;
      }

      if( specs_field_name.name === "card_expiration" ) {
        return credit_card_exp;
      }

      if( specs_field_name.name === "card_name" ) {
        return card_fname + ' ' + card_lname;
      }

      if( specs_field_name.name === "customer_email" ) {
        return email;
      }

      if( specs_field_name.name === "country" ) {
        return country;
      }
      
    }

    if (field_name === "Card Security Code") {
      return credit_card_exp_mm_yyyy;
    }

    if (field_name === "Date Signed") {
      return moment().format("MM/DD/YYYY");
    }

    if (["Approve", "Decline"].includes(field_name)) {
      const html = `<button class="btn btn-secondary btn-sm docusignField">${field_name}</button>`;
      const $element = createElementFromHTML(html);
      $element.css({ top, left, position: "absolute" });
      return $element;
    }

    if (field_name === "Attachment") {
      const { value } = fieldValue || { value: null };

      const html = `
            <div class="signing__fieldAttachment docusignField" title="Attachment" data-field-type="attachment">
              <input type="file" />
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path fill="currentColor" d="M43.246 466.142c-58.43-60.289-57.341-157.511 1.386-217.581L254.392 34c44.316-45.332 116.351-45.336 160.671 0 43.89 44.894 43.943 117.329 0 162.276L232.214 383.128c-29.855 30.537-78.633 30.111-107.982-.998-28.275-29.97-27.368-77.473 1.452-106.953l143.743-146.835c6.182-6.314 16.312-6.422 22.626-.241l22.861 22.379c6.315 6.182 6.422 16.312.241 22.626L171.427 319.927c-4.932 5.045-5.236 13.428-.648 18.292 4.372 4.634 11.245 4.711 15.688.165l182.849-186.851c19.613-20.062 19.613-52.725-.011-72.798-19.189-19.627-49.957-19.637-69.154 0L90.39 293.295c-34.763 35.56-35.299 93.12-1.191 128.313 34.01 35.093 88.985 35.137 123.058.286l172.06-175.999c6.177-6.319 16.307-6.433 22.626-.256l22.877 22.364c6.319 6.177 6.434 16.307.256 22.626l-172.06 175.998c-59.576 60.938-155.943 60.216-214.77-.485z"/>
              </svg>
            </div>
          `;

      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (value) {
        $element.find("input").addClass("d-none");
        $element.attr("data-value", `${prefixURL}/uploads/docusign/${value}`); // prettier-ignore
      }

      const $input = $element.find("input");
      $input.on("change", async function () {
        const [file] = this.files;
        const ONE_MB = 1048576;

        if (file.size > ONE_MB * 8) {
          alert("Maximum file size is less than 8MB");
          return;
        }

        const { data } = await storeFieldValue({
          id: fieldId,
          value: this.files[0],
        });

        $(this).addClass("d-none");
        $element.attr("data-value", `${prefixURL}/uploads/docusign/${data.value}`); // prettier-ignore
        $element.attr("title", $(this).val());
      });

      $element.on("click", function () {
        const filepath = $(this).attr("data-value");
        if (filepath) {
          window.open(filepath, "_blank").focus();
        }
      });

      return $element;
    }

    if (field_name === "Signature") {
      const { specs: fieldSpecs } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};

      let { value } = fieldValue || { value: null };
      if (specs.value) {
        value = specs.value;
      }

      let html = `
            <div class="signing__fieldSignature docusignField" title="Signature" data-field-type="signature" id="signature${fieldId}">
              <div style="display:flex; flex-direction:column; align-items:center; padding:0 0.5em; border:2px solid #bf1e2e; background-color: #ffea588c;">
                <div style="font-weight:600; font-size:0.9em; font-family: monospace;">Sign here</div>
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" style="enable-background:new 0 0 407.437 407.437" viewBox="0 0 407.437 407.437">
                  <path d="m386.258 91.567-182.54 181.945L21.179 91.567 0 112.815 203.718 315.87l203.719-203.055z"/>
                </svg>
              </div>
            </div>
          `;

      const $element = createElementFromHTML(html);

      if (value) {
        let dateTime = null;
        if (field.value) {
          const { created_at } = field.value;
          if (created_at) {
            const date = moment(created_at);
            dateTime = date.format("MMMM Do YYYY, h:mm:ss A");
          }
        }

        const valueHtml = `
              <div class="fillAndSign__signatureContainer">
                <img class="fillAndSign__signatureDraw" src="${value}"/>
                ${
                  dateTime
                    ? `<span class="fillAndSign__signatureTime">${dateTime}</span>`
                    : ""
                }
              </div>
            `;

        $element.html(createElementFromHTML(valueHtml));
      }

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      $element.on("click touchstart", () => {        
        signaturePad.clear();
        $(".signing__signatureInput").val("");

        $signatureModal.attr("data-field-id", fieldId);
        $signatureModal.modal("show");
      });
      return $element;
    }

    if (["Checkbox", "Radio", "2 GIG Go Panel 2", "2 GIG Go Panel 3"].includes(field_name)) {
      let {
        subCheckbox = [],
        isChecked,
        name,
        is_required,
        value: valueSpec,
      } = JSON.parse(field.specs) || {};

      if (!name) {
        name = field.unique_key;
      }

      let { value } = fieldValue || {};
      value = value ? JSON.parse(value) : {};

      let hasRequested = false;
      const getSubCheckboxes = () => {
        if (value.subCheckbox && value.subCheckbox.length) {
          return value.subCheckbox;
        }

        return hasRequested ? value.subCheckbox : subCheckbox;
      };

      if( field_name === panel_type ){
        isChecked = 'checked';
      }

      if (value.hasOwnProperty("isChecked")) {
        isChecked = value.isChecked;
      }

      console.log('Panel Type' + panel_type);
      console.log('Is Checked' + isChecked);

      //const inputType = field_name.toLowerCase();
      const inputType = field_name === "Checkbox" || field_name === "2 GIG Go Panel 2" || field_name === "2 GIG Go Panel 3"
          ? "checkbox"
          : field_name.toLowerCase();
      const baseClassName =
        field_name === "Checkbox" || field_name === "2 GIG Go Panel 2" || field_name === "2 GIG Go Panel 3"
          ? "docusignField__checkbox"
          : "docusignField__radio";

      const html = `<div class="docusignField ${baseClassName}"></div>`;
      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (is_required) {
        $element.addClass(`${baseClassName}--isRequired`);
      }

      const inputName = `${name}-${field.unique_key}`;
      $element.append(`
            <div class="form-check">
              <input
                class="form-check-input"
                type="${inputType}"
                id="${field.unique_key}"
                ${isChecked ? "checked" : ""}
                name="${inputName}"
                ${valueSpec ? `value="${valueSpec}"` : ""}
                data-is-parent="true"
                data-parent-id="${field.unique_key}"
              >
              <span class="form-check-indicator">x</span>
              <label
                class="form-check-label invisible"
                for="${field.unique_key}"
              ></label>
            </div>
          `);

      if (subCheckbox.length) {
        $element.append(
          subCheckbox.map((option) => {
            const { id, top = 0, left = 0, value: valueOption } = option;
            let { isChecked = false } = option;
            if (value.subCheckbox) {
              const f =
                value.subCheckbox.find(({ id: _id }) => _id === id) || {};
              isChecked = Boolean(f.isChecked);
            }

            // prettier-ignore
            const $currElement = createElementFromHTML(`
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="${inputType}"
                      id="${id}"
                      ${isChecked ? "checked" : ""}
                      name="${inputName}"
                      ${valueOption ? `value="${valueOption}"` : ""}
                      data-parent-id="${field.unique_key}"
                    >
                    <span class="form-check-indicator">x</span>
                    <label class="form-check-label invisible" for="${id}"></label>
                  </div>
                `);

            const topEm = `${pxToEm(parseInt(top))}em`;
            const leftEm = `${pxToEm(parseInt(left))}em`;
            $currElement.css({
              top: topEm,
              left: leftEm,
              position: "absolute",
            });
            return $currElement;
          })
        );
      }

      $element.find(`input:${inputType}`).on("change", async function () {
        /**
         * if not checkbox, make sure to have only one checked
         */

        const $this = $(this);
        const id = $this.attr("id");
        const _isChecked = $this.is(":checked");

        if (id === field.unique_key) {
          let _subCheckbox = getSubCheckboxes();
          if (field_name !== "Checkbox") {
            _subCheckbox = _subCheckbox.map((f) => ({
              ...f,
              isChecked: false,
            }));
          }

          const { data } = await storeFieldValue({
            id: fieldId,
            value: JSON.stringify({
              subCheckbox: _subCheckbox,
              isChecked: _isChecked,
            }),
          });

          value = JSON.parse(data.value);
        } else {
          let newSubCheckbox = [];
          const subCheckbox = getSubCheckboxes();

          if (subCheckbox.find((s) => s.id === id)) {
            newSubCheckbox = subCheckbox.map((s) => {
              if (s.id !== id && field_name !== "Checkbox") {
                return { ...s, isChecked: false };
              }

              return s.id !== id ? s : { ...s, isChecked: _isChecked };
            });
          } else {
            newSubCheckbox = [...subCheckbox, { id, isChecked: _isChecked }];
          }

          let payload = {
            subCheckbox: newSubCheckbox,
            isChecked: Boolean(value.isChecked),
          };

          if (field_name !== "Checkbox") {
            payload = {
              subCheckbox: newSubCheckbox,
              isChecked: false,
            };
          }

          const { data } = await storeFieldValue({
            id: fieldId,
            value: JSON.stringify(payload),
          });

          value = JSON.parse(data.value);
        }

        if ((!subCheckbox || !subCheckbox.length) && name) {
          const $duplicate = $(
            `[type=checkbox][name^="${name}-"]:not([id="${field.unique_key}"])`
          );
          const id = $duplicate.attr("id");
          const duplicateField = data.fields.find((f) => f.unique_key === id);

          if (duplicateField) {
            const { subCheckbox } = JSON.parse(duplicateField.specs) || {};
            if (!subCheckbox || !subCheckbox.length) {
              $duplicate.prop("checked", Boolean(value.isChecked));
              await storeFieldValue({
                id: duplicateField.id,
                value: JSON.stringify({
                  subCheckbox,
                  isChecked: Boolean(value.isChecked),
                }),
              });
            }
          }
        }

        const thisValue = $this.val();
        const thisID = $this.attr("id");
        // handle options with subcheckbox
        if (
          subCheckbox.length &&
          inputType === "radio" &&
          thisValue &&
          thisID
        ) {
          const $duplicate = $(
            `[type=radio][name^="${name}-"][value="${thisValue}"]:not([id="${thisID}"])`
          );

          const parentId = $duplicate.data("parent-id");
          const duplicateField = data.fields.find(
            (f) => f.unique_key === parentId
          );

          if ($duplicate.length && parentId && duplicateField) {
            const isParent = $duplicate.attr("data-is-parent");
            const isChecked = $this.is(":checked");
            const specs = JSON.parse(duplicateField.specs) || {};

            if (isParent) {
              specs.isChecked = isChecked;
            } else {
              const matchedSubCheckbox = specs.subCheckbox.some(
                (s) => s.value === thisValue
              );

              if (matchedSubCheckbox) {
                specs.isChecked = false;
                specs.subCheckbox = specs.subCheckbox.map((s) => {
                  if (s.value !== thisValue) return s;
                  return { ...s, isChecked };
                });
              }
            }

            $duplicate.prop("checked", isChecked);
            await storeFieldValue({
              id: duplicateField.id,
              value: JSON.stringify(specs),
            });
          }
        }

        if (subCheckbox.length && thisValue && thisID) {
          const $duplicate = $(
            `[type="${inputType}"][name^="${name}-"][value="${thisValue}"]:not([id="${thisID}"])`
          );

          const parentId = $duplicate.data("parent-id");
          const duplicateField = data.fields.find(
            (f) => f.unique_key === parentId
          );

          if ($duplicate.length && parentId && duplicateField) {
            const isParent = $duplicate.attr("data-is-parent");
            const isChecked = $this.is(":checked");
            const specs = JSON.parse(duplicateField.specs) || {};

            if (isParent) {
              specs.isChecked = isChecked;
            } else {
              specs.isChecked = $(`#${parentId}`).is(":checked");
            }

            specs.subCheckbox = specs.subCheckbox.map((s) => {
              if (s.value !== thisValue) {
                return { ...s, isChecked: $(`#${s.id}`).is(":checked") };
              }

              return { ...s, isChecked };
            });

            $duplicate.prop("checked", isChecked);
            storeFieldValue({
              id: duplicateField.id,
              value: JSON.stringify(specs),
            });
          }
        }

        hasRequested = true;
      });

      return $element;
    }

    if (field_name === "Dropdown") {
      const { values: options = [], selected: defaultValue, is_required } = JSON.parse(field.specs) || {}; // prettier-ignore
      const { value: selected } = fieldValue || { value: defaultValue };

      const optionsArray = options.map((option) => {
        const isSelected = selected === option;
        return `
              <option value="${option}" ${isSelected ? "selected" : ""}>
                ${option}
              </option>
            `;
      });

      if (!optionsArray.length) {
        return "";
      }

      const html = `
            <div class="docusignField docusignField__dropdown">
              <select>
                <option value="">Select</option>
                ${optionsArray.join("")}
              </select>
            </div>
          `;

      const $element = createElementFromHTML(html);

      if (is_required) {
        $element.addClass("docusignField__dropdown--isRequired");
      }

      $element.find("select").on("change", function () {
        storeFieldValue({ value: this.value, id: fieldId });
      });

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (!selected && recipient.id !== data.recipient.id) {
        $element.css({ opacity: 0 });
      }

      return $element;
    }

    if (field_name === "Formula") {
      let value = "";
      if ("value" in field && field.value && "value" in field.value) {
        value = String(field.value.value);
      }

      const html = `
            <div class="docusignField docusignField--formula" style="position: relative; display: flex; align-items: center;">
              <input
                readonly
                type="text"
                data-key="${field.unique_key}"
                placeholder="${field_name}"
                ${value.length ? `value="${value}"` : ""}
              />
            </div>
          `;

      const $element = createElementFromHTML(html);

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });
      return $element;
    }

    const { decrypted } = data;
    if (decrypted.is_self_signed) {
      text = undefined;
    }

    if (
      field_name === "Text" ||
      field_name === "TextString" ||
      text === undefined
    ) {
      let { value } = fieldValue || { value: "" };
      const { specs: fieldSpecs, unique_key } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};
      const { width, is_required = false, is_read_only = false } = specs;
      const isRequired = is_required.toLocaleString() === "true";
      const isReadOnly = is_read_only.toLocaleString() === "true";

      let { workorder_recipient: customer } = data;
      if (!customer) {
        customer = data.job_recipient;
      }

      const autoPopulateData = getAutoPopulateDataFromFieldSpecs(specs);
      if (autoPopulateData) {
        customer = autoPopulateData;
      }

      const customer_card = window.__esigndata.auto_populate_data.billing;
      const customer_cost_due = window.window.__esigndata.auto_populate_data.cost_due;;

      if (customer && specs.name && !value) {
        if (String(specs.name.toLowerCase()).startsWith("zip")) {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["zip_code"];
        } else if (specs.name.toLowerCase() === "address") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["mail_add"] ||
            customer["subdivision"];
        } else if (specs.name.toLowerCase() === "password") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["password"];
        } else if (specs.name.toLowerCase() === "card_number") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_account_number"];
        } else if (specs.name.toLowerCase() === "card_expiration") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_expiration"];
        } else if (specs.name.toLowerCase() === "card_name") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["card_name"] ||
            customer["card_first_name"] ||
            customer["card_last_name"];
        } else if (specs.name.toLowerCase() === "mobile_number") {
          value =
            customer[specs.name] ||
            customer[specs.name.toLowerCase()] ||
            customer["phone_m"] ||
            customer["phone_h"];
            // added changes\/
        } else if (specs.name.toLowerCase() === "subscriber_fname") {
          value =
            customer[specs.name] ||
            customer["first_name"];
        } else if (specs.name.toLowerCase() === "subscriber_lname") {
          value =
            customer[specs.name] ||
            customer["last_name"];
        } else if (specs.name.toLowerCase() === "phone_h") {
          value =
            customer[specs.name] ||
            customer["phone_h"];
        } else if (specs.name.toLowerCase() === "phone_m") {
          value =
            customer[specs.name] ||
            customer["phone_m"];
        } else if (specs.name.toLowerCase() === "city") {
          value =
            customer[specs.name] ||
            customer["city"];
        } else if (specs.name.toLowerCase() === "state") {
          value =
            customer[specs.name] ||
            customer["state"];
        } else if (specs.name.toLowerCase() === "zip_code") {
          value =
            customer[specs.name] ||
            customer["zip_code"];
        } else if (specs.name.toLowerCase() === "customer_email") {
          value =
            customer[specs.name] ||
            customer["email"];
        } else if (specs.name.toLowerCase() === "country") {
          value =
            customer[specs.name] ||
            customer["country"];
        } else if (specs.name.toLowerCase() === "checking_account_n") {
          value =
            customer[specs.name] ||
            customer_card['check_num'];
        } else if (specs.name.toLowerCase() === "aba") {
          value =
            customer[specs.name] ||
            customer_card['routing_num']
        } else if (specs.name.toLowerCase() === "card_account_number") {
          value =
            customer[specs.name] ||
            customer["card_account_number"];
        } else if (specs.name.toLowerCase() === "card_security_code") {
          value =
            customer[specs.name] ||
            customer["card_expiration_mm_yyyy"];
        } else if (specs.name.toLowerCase() === "equipment_cost") {
          value =
            customer[specs.name] ||
            customer_cost_due['equipment_cost'];
        } else if (specs.name.toLowerCase() === "one_time_activation") {
          value =
            customer[specs.name] ||
            customer_cost_due['one_time_activation'];
        } else if (specs.name.toLowerCase() === "first_month_monitoring") {
          value =
            customer[specs.name] ||
            customer_cost_due['first_month_monitoring'];
        } else if (specs.name.toLowerCase().startsWith("job_")) {
          if (window.__esigndata.job_data) {
            const jobData = window.__esigndata.job_data;
            const jobField = specs.name.toLowerCase().replace("job_", "");
            value = jobData[jobField] || "";
          }
        } else {
          value =
            customer[specs.name] || customer[specs.name.toLowerCase()] || "";
        }
      }

      if (specs.value && !value && data.recipient.id === recipient.id) {
        value = specs.value;
      }

      if (value === undefined || value === null) {
        value = "";
      }

      const placeholder = specs.placeholder || specs.name || field_name;
      let custom_class  = "";
      if( placeholder == "Esign Envelope ID" ){
        custom_class = "docusign-envelope-id-field";
      }
      const html = `
        <div class="docusignField" style="position: relative; display: flex; align-items: center;">
          <input class="${custom_class}" type="text" placeholder="${placeholder}" value="${value}" data-key="${unique_key}" />
          <div class="spinner-border spinner-border-sm d-none" role="status" style="position: absolute; right: 4px;">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      `;
      

      const $element = createElementFromHTML(html);
      const $input = $element.find("input");

      if (field.original_field_name === "Date Signed") {
        $input.attr("data-field-type", "dateSigned");
        $input.attr("data-field-id", fieldId);
      }

      if (field.original_field_name === "Subscriber Name" || field.original_field_name === "City" || field.original_field_name === "State" || field.original_field_name === "Address" || field.original_field_name === "ZIP" || field.original_field_name === "Subscriber Email" || field.original_field_name === "Primary Contact" || field.original_field_name === "Secondary Contact" || field.original_field_name === "Access Password" || field.original_field_name === "County" || field.original_field_name === "Abort Code" || field.original_field_name === 'Social Security Number' || field.original_field_name === 'Date of Birth') {
        $input.attr("data-field-type", "autoPopulateCustomerDetails");
        $input.attr("data-field-id", fieldId);
      }

      if( field.original_field_name === "Primary Contact Name" || field.original_field_name === "Primary Contact Number" || field.original_field_name === "Primary Contact First Name" || field.original_field_name === "Primary Contact Last Name" ){
        $input.attr("data-field-type", "autoPopulateEmergencyContact");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Secondary Contact Name" || field.original_field_name === "Secondary Contact Number" || field.original_field_name === "Secondary Contact First Name" || field.original_field_name === "Secondary Contact Last Name" ){
        $input.attr("data-field-type", "autoPopulateEmergencyContact");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Checking Account Number" || field.original_field_name === "Account Number" || field.original_field_name === "CS Account Number" || field.original_field_name === "ABA" || field.original_field_name === "Card Number" || field.original_field_name === "Card Holder Name" || field.original_field_name === "Card Expiration" || field.original_field_name === "Card Security Code" || field.original_field_name === "Equipment" ){
        $input.attr("data-field-type", "autoPopulateAccountDetails");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "Equipment Cost" || field.original_field_name === "Monthly Monitoring Rate" || field.original_field_name === "One Time Activation (OTP)" || field.original_field_name === "Total Due" ){
        $input.attr("data-field-type", "autoPopulateBilling");
        $input.attr("data-field-id", fieldId); 
      }

      if( field.original_field_name === "System Size" || field.original_field_name === "kW DC" ){
        $input.attr("data-field-type", "autoPopulateSolar");
        $input.attr("data-field-id", fieldId); 
      }

      if (field.original_field_name === "Text" ) {
        let specs_field_name = specs;
        if( specs_field_name.name === "equipment_cost" || specs_field_name.name === "one_time_activation" || specs_field_name.name === "first_month_monitoring" || specs_field_name.name === 'total_due' ) {
          $input.attr("data-field-type", "autoPopulateBilling");
          $input.attr("data-field-id", fieldId); 
        }
      }

      // requires assets/js/esign/docusign/input.autoresize.js
      $input.autoresize({ minWidth: width ? width : 100 });

      $input.prop("required", isRequired);
      $input.prop("readonly", isReadOnly);

      if (isRequired) {
        $element.addClass("docusignField__input--isRequired");
      }

      if (isReadOnly) {
        $element.addClass("docusignField--readOnly");
      }

      if (specs.name) {
        $input.attr("data-name", specs.name);
      }

      let typingTimer;
      let doneTypingInterval = 2500;
      const doneTyping = async (input) => {
        const $input = $(input);
        const $spinner = $input.next(".spinner-border");

        $input.attr("readonly", true);
        // $spinner.removeClass("d-none");

        const value = $input.val().trim();
        await storeFieldValue({ value, id: fieldId });

        $input.attr("readonly", false);
        $spinner.addClass("d-none");

        if (!$input.attr("data-name")) return;

        const name = $input.attr("data-name").toLowerCase();
        const key = $input.attr("data-key");
        const $sameFields = $(`input[data-name='${name}' i]:not([data-key='${key}'])`); // prettier-ignore

        if (!$sameFields.length) return;

        // This will avoid auto-filling, same data-name
        // for different recipients.
        const inputsWithFields = [];

        const promises = [...$sameFields].map((input) => {
          const $input = $(input);
          const key = $input.attr("data-key");
          const field = data.fields.find(({ unique_key }) => unique_key === key); // prettier-ignore
          if (field) {
            inputsWithFields.push($input);
            return storeFieldValue({ value, id: field.id });
          }
        });

        await Promise.all(promises);
        inputsWithFields.forEach(($input) => $input.val(value));
      };

      $element.find("input").keyup(function () {
        clearTimeout(typingTimer);
        if ($(this).val()) {
          typingTimer = setTimeout(() => doneTyping(this), doneTypingInterval);
        }
      });

      const topEm = `${pxToEm(top, container)}em`;
      const leftEm = `${pxToEm(left, container)}em`;
      $element.css({ top: topEm, left: leftEm, position: "absolute" });

      if (field_name === "TextString") {
        // $element.addClass("completed");
        $input.prop("required", false);
        // $input.prop("readonly", true);
      }

      return $element;
    }

    return null;
  }

  function renderField({ fields, recipient, context, $page }) {
    const isOwner = recipient.id === data.recipient.id;

    const $fields = fields.map((field) => {
      field.original_field_name = field.field_name;

      let $element = getRenderField({ field, recipient, $page });
      const isString = typeof $element === "string";

      if ($element === null || isString) {
        const { field_name } = field;
        const text = recipient[field_name.toLowerCase()];

        field.field_name = "TextString";
        field.value = { value: isString ? $element : text };

        $element = getRenderField({ field, recipient, $page });
      }

      if ($element instanceof jQuery && !isOwner) {
        $element.addClass("completed");
        $element.addClass("not-owned");
      }

      return $element;
    });

    $page.append($fields);

    // We wanted to auto-fill name and email fields
    // from recipient data.
    $fields.forEach(($field, index) => {
      const { field_name, specs } = fields[index];
      if (field_name !== "Text") return;
      if (!specs) return;

      const parsedSpecs = JSON.parse(specs);
      if (!parsedSpecs.name) return;

      const nameLower = parsedSpecs.name.toLowerCase();
      if (!["email", "name"].includes(nameLower)) return;

      const $input = $field.find("input[type=text]");
      if ($input.val()) return; // avoid overiding user defined value

      const currentRecipient =
        getAutoPopulateDataFromFieldSpecs(parsedSpecs) || recipient;

      $input.val(currentRecipient[nameLower]);
      $input.keyup(); // manually trigger event, this will make sure to save the value
    });
  }

  function getAutoPopulateDataFromFieldSpecs(specs) {
    if (specs.auto_populate_with && specs.auto_populate_with.length) {
      if (
        window.__esigndata.auto_populate_data &&
        window.__esigndata.auto_populate_data[specs.auto_populate_with]
      ) {
        const match =
          window.__esigndata.auto_populate_data[specs.auto_populate_with];

        if (match.first_name && match.last_name) {
          match.name = `${match.first_name} ${match.last_name}`;
        }

        return match;
      }
    }
  }

  async function renderPDF(file) {
    const { fields, recipient, co_recipients } = data;
    const filepath = file.path.replace(/^\/|\/$/g, "");

    const documentUrl = `${prefixURL}/${filepath}`;
    let document = await PDFJS.getDocument({ url: documentUrl });
    document = await document.promise;

    const $container = createElementFromHTML(
      `<div class="signing__documentPDF" data-file-id="${file.id}"></div>`
    );

    for (let index = 1; index <= document.numPages; index++) {
      const isDocumentField = ({ doc_page, docfile_document_id }) => {
        return doc_page == index && docfile_document_id == file.id;
      };

      const currentFields = fields.filter(isDocumentField);
      const params = { page: index, document };
      const $page = await getPage(params);
      $container.append($page);

      const canvas = $page.find("canvas").get(0);
      const context = canvas.getContext("2d");

      await sleep(1);
      renderField({ fields: currentFields, recipient, context, $page });

      co_recipients.forEach((coRecipient) => {
        const fields = coRecipient.fields.filter(isDocumentField);
        renderField({ ...coRecipient, fields, context, $page });
      });

      $documentContainer.append($container);
    }

    const formulas = fields.filter((field) => {
      const { specs: fieldSpecs } = field;
      const specs = fieldSpecs ? JSON.parse(fieldSpecs) : {};
      return field.field_name === "Formula" && specs.formula;
    });

    formulas.forEach((field) => {
      const specs = JSON.parse(field.specs);
      const regex = /\[(?<fieldname>\w+)]/g;

      const $formula = $(`[data-key="${field.unique_key}"]`);
      $formula.attr("data-field-type", "formula");
      $formula.attr("data-field-id", field.id);

      const setValue = (v) => {
        let formula;
        let hasNonZero = false;

        while ((match = regex.exec(specs.formula))) {
          const { fieldname } = match.groups;

          if (Number(v[fieldname]) > 0) {
            hasNonZero = true;
          }

          if (!formula) {
            formula = specs.formula.replace(`[${fieldname}]`, v[fieldname]);
          } else {
            formula = formula.replace(`[${fieldname}]`, v[fieldname]);
          }
        }

        if (!hasNonZero) {
          return;
        }

        try {
          let value = eval(formula);
          value = Math.round((value + Number.EPSILON) * 100) / 100;

          $formula.val(value);
          $formula.attr("value", $formula.val());
        } catch (error) {
          $formula.val("Invalid");
        }
      };

      let match, values = {}; // prettier-ignore
      while ((match = regex.exec(specs.formula))) {
        const { fieldname } = match.groups;
        const $input = $(`[data-name="${fieldname}"]`);
        values[fieldname] = $input.val() || 0;

        $input.on("keyup", function (event) {
          const { value } = event.target;
          values[fieldname] = value || 0;
          setValue(values);
        });
      }

      setValue(values);
    });
  }

  async function storeFieldValue({ id, value, force = false }) {
    const { recipient } = data;
    const { id: recipient_id } = recipient;

    if (value instanceof File) {
      const formData = new FormData();
      formData.append("attachment", value);
      formData.append("recipient_id", recipient_id);
      formData.append("field_id", id);

      const endpoint = `${prefixURL}/DocuSign/apiUploadAttachment`;

      $statusIndicator.classList.add("show");
      const response = await fetch(endpoint, {
        method: "POST",
        body: formData,
        headers: {
          accepts: "application/json",
        },
      });

      $statusIndicator.classList.remove("show");
      return response.json();
    }

    if (!force) {
      const matchField = window.__esigndata.fields.find((f) => f.id === id);
      if (window.__ismobile && matchField && matchField.field_name === "Text") {
        return;
      }
    }

    const payload = {
      recipient_id,
      field_id: id,
      value,
    };

    $statusIndicator.classList.add("show");
    const response = await fetch(`${prefixURL}/DocuSign/apiStoreFieldValue`, {
      method: "POST",
      body: JSON.stringify(payload),
      headers: {
        accepts: "application/json",
        "content-type": "application/json",
      },
    });

    $statusIndicator.classList.remove("show");
    return response.json();
  }

  function attachEventHandlers() {
    const $fontItems = $fontSelect.find(".dropdown-item");
    const $fontItemText = $fontSelect.find(".dropdown-toggle");
    $fontItems.on("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      const $target = $(event.target);
      const font = $target.data("font");

      $fontItemText.text($target.text().trim());
      $signatureTextInput.attr("data-font", font);
      $fontSelect.removeClass("open");
    });

    $signaturePadClear.on("click", (event) => {
      event.preventDefault();
      signaturePad.clear();
      $signaturePad.get(0).classList.remove("has-content");
    });

    $signatureApplyButton.on("click", async function () {
      const $activeTab = $("#signatureModal .tab-pane.active");
      const signatureType = $activeTab.data("signature-type");

      let $element = null;
      let signatureDataUrl = null;
      const canvas = $signaturePadCanvas.get(0);

      if (signatureType === "type") {
        const signature = $signatureTextInput.val();
        const fontSize = $signatureTextInput.css("font-size");
        const fontFamily = $signatureTextInput.css("font-family");
        const fontWeight = $signatureTextInput.css("font-weight");

        if (isEmptyOrSpaces(signature)) {
          return;
        }

        signaturePad.clear();
        const clonedCanvas = cloneCanvas(canvas);
        const context = clonedCanvas.getContext("2d");

        context.font = `${fontWeight} ${fontSize} ${fontFamily}`;
        const textWidth = context.measureText(signature).width;
        context.fillText(signature, clonedCanvas.width / 2 - textWidth / 2, 100); // prettier-ignore

        trimCanvas(context);
        signatureDataUrl = clonedCanvas.toDataURL("image/png");
      } else {
        if (isCanvasBlank(canvas)) {
          return;
        }

        const clonedCanvas = cloneCanvas(canvas);
        trimCanvas(clonedCanvas.getContext("2d"));
        signatureDataUrl = clonedCanvas.toDataURL("image/png");
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");

      const fieldId = $signatureModal.attr("data-field-id");

      const $signatureFields = $("[data-field-type=signature]");
      const fieldIds = [...$signatureFields].map((e) =>
        $(e).attr("id").replace("signature", "")
      );

      const promises = fieldIds.map((id) => storeFieldValue({ id, value: signatureDataUrl })); // prettier-ignore
      await Promise.all(promises);

      let dateTime = moment();
      const field = window.__esigndata.fields.find((f) => f.id === fieldId);

      if (field && field.value) {
        const { created_at } = field.value;
        if (created_at) {
          dateTime = moment(created_at);
        }
      }

      const dateTimeFormatted = dateTime.format("MMMM Do YYYY, h:mm:ss A");

      const html = `
        <div class="fillAndSign__signatureContainer">
          <img class="fillAndSign__signatureDraw" src="${signatureDataUrl}"/>
          ${
            dateTimeFormatted
              ? `<span class="fillAndSign__signatureTime">${dateTimeFormatted}</span>`
              : ""
          }
        </div>
      `;

      $element = createElementFromHTML(html);
      $("[data-field-type=signature]:not(.not-owned)").html($element);
      // $(`#signature${fieldId}`).html($element);

      $signatureModal.modal("hide");

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
    });

    $signatureModal.on("hidden.bs.modal", function () {
      $(this).removeAttr("data-field-id");
      $signaturePad.get(0).classList.remove("has-content");
    });

    $signatureModal.on("show.bs.modal", function () {
      /*if (!isMobile()) return;

      if (document.documentElement.requestFullscreen) {
        this.requestFullscreen();
      } else if (document.documentElement.webkitRequestFullScreen) {
        this.webkitRequestFullScreen();
      }

      if (screen.orientation) {
        screen.orientation
          .lock("landscape-primary")
          .then(() => {
            const $dialog = this.querySelector(".modal-dialog");
            $dialog.classList.add("max-width-unset");
          })
          .catch((error) => {
            console.error(error);
          });
      }*/
    });

    $signatureModal.on("hide.bs.modal", function () {
      /*if (!isMobile()) return;

      if (document.fullscreenElement) {
        document.exitFullscreen().catch((err) => console.error(err));
      }

      const $dialog = this.querySelector(".modal-dialog");
      $dialog.classList.remove("max-width-unset");
      if (screen.orientation) {
        screen.orientation.unlock();
      }*/
    });

    $finishSigning.on("click", async function () {
      const $fields = $(".docusignField");
      const fields = [...$fields];

      for (let index = 0; index < fields.length; index++) {
        const $element = $(fields[index]);
        const $input = $element.find("input");
        const fieldType = $element.attr("data-field-type");

        const scrollToElement = () => {
          const className = "docusignField--focused";
          $(`.${className}`).removeClass(className);
          $element.addClass(className);

          $("html, body").animate({
            scrollTop: parseInt($element.offset().top - 100),
          });
        };

        if ($element.is("select")) {
          if (
            isEmptyOrSpaces($element.val()) &&
            $element.hasClass("docusignField__dropdown--isRequired")
          ) {
            scrollToElement();
            return;
          }
        }

        if (
          fieldType === "signature" &&
          !$element.find(".fillAndSign__signatureContainer").length
        ) {
          // no signature yet
          scrollToElement();
          return;
        }

        if (fieldType === "attachment" && !$input.hasClass("d-none")) {
          // empty attachment
          scrollToElement();
          return;
        }

        if (
          $input.is("input:text") &&
          $input.prop("required") &&
          isEmptyOrSpaces($input.val())
        ) {
          $input.focus();
          scrollToElement();
          return;
        }

        let inputType = undefined;
        if ($input.is("input:radio")) {
          inputType = "radio";
        } else if ($input.is("input:checkbox")) {
          inputType = "checkbox";
        }

        if (inputType !== undefined) {
          const $parent = $input.closest(
            `.docusignField__${inputType}--isRequired`
          );
          if (
            $parent.length &&
            !$element.find(`input:${inputType}:checked`).length
          ) {
            scrollToElement();
            return;
          }
        }
      }

      if (window.__ismobile && window.__esigndata) {
        const $inputs = [
          ...document.querySelectorAll(".docusignField > [data-key]"),
        ];
        const promises = [];
        
        $inputs.forEach(($input) => {
          if (!$input.value) return;

          const dataKey = $input.dataset.key;
          const matchField = window.__esigndata.fields.find(
            ({ unique_key }) => unique_key === dataKey
          );

          if (!matchField) return;
          if (matchField.field_name !== "Text") return;
          if (
            matchField.user_docfile_recipients_id !==
            window.__esigndata.decrypted.recipient_id
          ) {
            return;
          }

          promises.push(
            storeFieldValue({
              force: true,
              id: matchField.id,
              value: $input.value,
            })
          );
        });

        if (promises.length) {
          await Promise.all(promises);
        }
      }

      $(this).attr("disabled", true);
      $(this).find(".spinner-border").removeClass("d-none");
      $(".loader-finishing").removeClass("d-none");

      const $dateSigned = $("[data-field-type=dateSigned]");
      const dateSignedPromises = [...$dateSigned].map((dateSigned) => {
        const $element = $(dateSigned);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateCustomerDetails = $("[data-field-type=autoPopulateCustomerDetails]");
      const autoPopulateCustomerDetailsPromises = [...$autoPopulateCustomerDetails].map((autoPopulateCustomerDetails) => {
        const $element = $(autoPopulateCustomerDetails);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateEmergencyContact = $("[data-field-type=autoPopulateEmergencyContact]");
      const autoPopulateEmergencyContactPromises = [...$autoPopulateEmergencyContact].map((autoPopulateEmergencyContact) => {
        const $element = $(autoPopulateEmergencyContact);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateAccountDetails = $("[data-field-type=autoPopulateAccountDetails]");
      const autoPopulateAccountDetailsPromises = [...$autoPopulateAccountDetails].map((autoPopulateAccountDetails) => {
        const $element = $(autoPopulateAccountDetails);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateBilling = $("[data-field-type=autoPopulateBilling]");
      const autoPopulateBillingPromises = [...$autoPopulateBilling].map((autoPopulateBilling) => {
        const $element = $(autoPopulateBilling);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $autoPopulateSolar = $("[data-field-type=autoPopulateSolar]");
      const autoPopulateSolarPromises = [...$autoPopulateSolar].map((autoPopulateSolar) => {
        const $element = $($autoPopulateSolar);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      const $formulas = $("[data-field-type=formula]");
      const formulaPromises = [...$formulas].map((formula) => {
        const $element = $(formula);
        const fieldId = $element.attr("data-field-id");

        let value = $element.text().trim();
        if ($element.is("input")) {
          value = $element.val().trim();
        }

        return storeFieldValue({ id: fieldId, value });
      });

      await Promise.all(dateSignedPromises);
      await Promise.all(formulaPromises);

      await Promise.all(autoPopulateCustomerDetailsPromises);
      await Promise.all(autoPopulateEmergencyContactPromises);
      await Promise.all(autoPopulateAccountDetailsPromises);
      await Promise.all(autoPopulateBillingPromises);
      await Promise.all(autoPopulateSolarPromises);

      const response = await fetch(`${prefixURL}/DocuSign/apiComplete`, {
        method: "POST",
        body: JSON.stringify({ hash }),
        headers: {
          accepts: "application/json",
          "content-type": "application/json",
        },
      });

      const data = await response.json();

      // RET*RD ALERT!!! Do this in backend.
      if (data.attach_to_customer) {
        if (
          data.attach_to_customer.customer_id &&
          data.attach_to_customer.esign_id
        ) {
          const response = await fetch(
            `${prefixURL}/Customer/apiAttachGeneratedEsign`,
            {
              method: "POST",
              body: JSON.stringify({
                customer_id: data.attach_to_customer.customer_id,
                esign_id: data.attach_to_customer.esign_id,
              }),
              headers: {
                accepts: "application/json",
                "content-type": "application/json",
              },
            }
          );

          const jsonData = await response.json();
          console.log(jsonData);
        }
      }

      if (data.hash) {
        window.location = `${prefixURL}/eSign/signing?hash=${data.hash}`;
        // console.log('testging...');
        return;
      }

      if (data.has_user) {
        if (window.__esigndata.job_id) {
          // redirect to job and auto-open payment modal
          window.location = `${prefixURL}/job/new_job1/${window.__esigndata.job_id}?modal=approved`;
          return;
        }

        window.location = `${prefixURL}/eSign_v2/manage?view=sent`;
      }

      $(this).attr("disabled", false);
      $(this).find(".spinner-border").addClass("d-none");
      $(".loader-finishing").addClass("d-none");
      markAsFinished();
    });
  }

  function markAsFinished() {
    $(".signing").addClass("signing--finished");
    $(".signing__fieldSignature").off();

    const $fields = $(".docusignField");
    [...$fields].forEach((field) => {
      const $input = $(field).find("input");

      [$(field), $input].forEach(($element) => {
        $element.prop("readonly", true);
        $element.prop("disabled", true);
        $element.css({
          color: "initial",
          backgroundColor: "initial",
          opacity: 1,
        });

        if ($element.hasClass("docusignField__dropdown")) {
          const $select = $element.find("select");
          if (!$select.val().length) {
            $element.css({ opacity: 0 });
          }
        }
      });
    });
  }

  async function init() {
    signaturePad = new SignaturePad($signaturePadCanvas.get(0));
    signaturePad.onBegin = () => {
      $signaturePad.get(0).classList.add("has-content");
    };

    await fetchData();

    const { files } = data;
    for (let index = 0; index < files.length; index++) {
      await renderPDF(files[index]);
    }

    attachEventHandlers();

    const $container = $(".signing__documentContainer");
    const containerWidth = parseInt($container.css("width"));

    const $canvases = $container.find("canvas");
    let canvasMaxWidth = 0;
    $canvases.each((_, c) => {
      const width = parseInt($(c).attr("width"));
      if (width > canvasMaxWidth) {
        canvasMaxWidth = width;
      }
    });

    if ($(window).width() <= 991) {
      const fontSize = (1.7823691460055098 / 100) * containerWidth;
      $container.css({ fontSize });
    }

    $(".loader").addClass("d-none");
    if (data.recipient.completed_at) markAsFinished();
    
    if (data.generated_pdf) {
      // download link
      $("[data-action=download]").on("click touchstart", function () {
        const queryString = new URLSearchParams({
          document_type: "esign",
          generated_esign_id: data.generated_pdf.docfile_id,
        }).toString();

        window.open(
          `${prefixURL}/CustomerDashboardQuickActions/downloadCustomerDocument?${queryString}`,
          "_blank"
        );
      });
    }

    if (window.__ismobile) {
      const $div = document.querySelector(".signing__documentPDF");
      const $text = document.createTextNode(".");
      $div.appendChild($text);
    }
  }

  return { init };
}

$(document).ready(function () {
  const urlParams = new URLSearchParams(window.location.search);
  const hash = urlParams.get("hash");

  if (hash) {
    new Signing(hash).init();
  }
});

// https://stackoverflow.com/a/494348/8062659
function createElementFromHTML(htmlString) {
  var div = document.createElement("div");
  div.innerHTML = htmlString.trim();
  return $(div.firstChild);
}

// https://stackoverflow.com/a/10232792/8062659
function isEmptyOrSpaces(str) {
  return str === null || str.match(/^ *$/) !== null;
}

// https://stackoverflow.com/a/17386803/8062659
function isCanvasBlank(canvas) {
  return !canvas
    .getContext("2d")
    .getImageData(0, 0, canvas.width, canvas.height)
    .data.some((channel) => channel !== 0);
}

// https://stackoverflow.com/a/45873660/8062659
function trimCanvas(ctx) {
  // removes transparent edges
  var x, y, w, h, top, left, right, bottom, data, idx1, idx2, found, imgData;
  w = ctx.canvas.width;
  h = ctx.canvas.height;
  if (!w && !h) {
    return false;
  }
  imgData = ctx.getImageData(0, 0, w, h);
  data = new Uint32Array(imgData.data.buffer);
  idx1 = 0;
  idx2 = w * h - 1;
  found = false;
  // search from top and bottom to find first rows containing a non transparent pixel.
  for (y = 0; y < h && !found; y += 1) {
    for (x = 0; x < w; x += 1) {
      if (data[idx1++] && !top) {
        top = y + 1;
        if (bottom) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2--] && !bottom) {
        bottom = h - y - 1;
        if (top) {
          // top and bottom found then stop the search
          found = true;
          break;
        }
      }
    }
    if (y > h - y && !top && !bottom) {
      return false;
    } // image is completely blank so do nothing
  }
  top -= 1; // correct top
  found = false;
  // search from left and right to find first column containing a non transparent pixel.
  for (x = 0; x < w && !found; x += 1) {
    idx1 = top * w + x;
    idx2 = top * w + (w - x - 1);
    for (y = top; y <= bottom; y += 1) {
      if (data[idx1] && !left) {
        left = x + 1;
        if (right) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      if (data[idx2] && !right) {
        right = w - x - 1;
        if (left) {
          // if left and right found then stop the search
          found = true;
          break;
        }
      }
      idx1 += w;
      idx2 += w;
    }
  }
  left -= 1; // correct left
  if (w === right - left + 1 && h === bottom - top + 1) {
    return true;
  } // no need to crop if no change in size
  w = right - left + 1;
  h = bottom - top + 1;
  ctx.canvas.width = w;
  ctx.canvas.height = h;
  ctx.putImageData(imgData, -left, -top);
  return true;
}

// https://stackoverflow.com/a/8306028/8062659
function cloneCanvas(oldCanvas) {
  //create a new canvas
  var newCanvas = document.createElement("canvas");
  var context = newCanvas.getContext("2d");

  //set dimensions
  newCanvas.width = oldCanvas.width;
  newCanvas.height = oldCanvas.height;

  //apply the old canvas to the new one
  context.drawImage(oldCanvas, 0, 0);

  //return the new canvas
  return newCanvas;
}

// https://stackoverflow.com/a/6860916/8062659
function guidGenerator() {
  var S4 = function () {
    return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
  };
  return (
    S4() +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    "-" +
    S4() +
    S4() +
    S4()
  );
}

// https://stackoverflow.com/a/46741311/8062659
function pxToEm(px, element) {
  element =
    element === null || element === undefined
      ? document.documentElement
      : element;

  var temporaryElement = document.createElement("div");
  temporaryElement.style.setProperty("position", "absolute", "important");
  temporaryElement.style.setProperty("visibility", "hidden", "important");
  temporaryElement.style.setProperty("font-size", "1em", "important");
  element.appendChild(temporaryElement);
  var baseFontSize = parseFloat(getComputedStyle(temporaryElement).fontSize);
  temporaryElement.parentNode.removeChild(temporaryElement);
  return px / baseFontSize;
}

function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

// https://stackoverflow.com/a/11381730/8062659
function isMobile() {
  const params = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
  });

  if (params.app) {
    return true;
  }

  let check = false;
  (function (a) {
    if (
      /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(
        a
      ) ||
      /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
        a.substr(0, 4)
      )
    )
      check = true;
  })(navigator.userAgent || navigator.vendor || window.opera);
  return check;
}
