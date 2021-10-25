window.addEventListener("DOMContentLoaded", async () => {
  const { SelectWithCheckbox } = await import("./SelectWithCheckbox.js");
  const { RulesTable } = await import("./RulesTable.js");
  const api = await import("./api.js");
  const utils = await import("./utils.js");

  utils.initSelect({
    $select: $("#mainCategory"),
    field: "bank-account",
  });
  utils.initSelect({
    $select: $('[data-type="assignment.payee"]'),
    field: "payee",
  });

  const $newRuleButton = document.getElementById("newRuleButton");
  $newRuleButton.addEventListener("click", () => {
    window.openRuleForm();
  });

  const $selectWithCheckbox = document.querySelector("#transactionsBankSelect");
  const $checkboxes = $selectWithCheckbox.querySelectorAll("[type=checkbox]");

  const bankSelect = new SelectWithCheckbox($selectWithCheckbox);
  bankSelect.onSelect = function (event) {
    const $text = bankSelect.$text;

    if (event.target.checked) {
      $text.setAttribute("data-prev-text", $text.textContent);
      $text.textContent = "All bank accounts";
    } else {
      $text.textContent = $text.getAttribute("data-prev-text");
    }

    [...$checkboxes].forEach(($checkbox) => {
      $checkbox.checked = event.target.checked;
    });
  };

  const $addRuleForm = document.getElementById("addRuleForm");
  const $addRuleBtn = $addRuleForm.querySelector("[data-action=save]");

  function isEmpty(string) {
    // https://stackoverflow.com/a/3261380/8062659
    return !string || string.length === 0;
  }

  $addRuleBtn.addEventListener("click", async function () {
    const ruleId = this.getAttribute("data-id");

    const payload = {};
    const assignments = [];
    const conditions = [];

    const $dataTypes = $addRuleForm.querySelectorAll("[data-type]");
    const $errorMessage = $addRuleForm.querySelector(".formError");
    $errorMessage.classList.remove("formError--show");

    for (let index = 0; index < $dataTypes.length; index++) {
      const $element = $dataTypes[index];
      $element.classList.remove("inputError");

      if ($addRuleForm.hasAttribute("data-add-split")) {
        if ($element.hasAttribute("data-main-category")) {
          continue;
        }
      } else {
        if ($element.closest(".add-split-section")) {
          continue;
        }
      }

      if ($element.type === "checkbox") {
        continue;
      }

      if (!$element.hasAttribute("required")) {
        continue;
      }

      if (isEmpty(getFormElementValue($element))) {
        $element.focus();
        $element.classList.add("inputError");
        $errorMessage.classList.add("formError--show");
        return;
      }
    }

    $errorMessage.classList.remove("formError--show");

    [...$dataTypes].forEach(($dataType) => {
      const dataType = $dataType.getAttribute("data-type");
      const value = getFormElementValue($dataType);

      if (dataType.startsWith("conditions.")) {
        return;
      }

      if (!dataType.startsWith("assignments.")) {
        payload[dataType] = value;
        return;
      }

      if (isEmpty(value)) {
        return;
      }

      const [, assignmentType] = dataType.split(".");
      const assignment = {
        value,
        type: assignmentType,
        percentage: null,
      };

      if ($addRuleForm.hasAttribute("data-add-split")) {
        if ($dataType.hasAttribute("data-main-category")) {
          return;
        }

        if (assignmentType === "category_percent") {
          return; //skip category_percent
        }

        if (assignmentType === "category") {
          // get category_percent value
          const $parent = $dataType.closest(".add-split-section");
          const $percent = $parent.querySelector("[data-type='assignment.category_percent']"); // prettier-ignore
          assignment.percentage = $percent.value;
        }
      } else {
        if ($dataType.closest(".add-split-section")) {
          return;
        }
      }

      if ($dataType.hasAttribute("data-id")) {
        assignment.id = $dataType.getAttribute("data-id");
      }

      assignments.push(assignment);
    });

    const $conditions = $addRuleForm.querySelectorAll(".addCondition-container > div"); // prettier-ignore
    [...$conditions].forEach(($condition) => {
      const $dataTypes = $condition.querySelectorAll("[data-type]");
      const condition = {};

      [...$dataTypes].forEach(($dataType) => {
        const dataTypeTemp = $dataType.getAttribute("data-type");
        const [, dataType] = dataTypeTemp.split(".");
        condition[dataType] = getFormElementValue($dataType);
      });

      if ($condition.hasAttribute("data-id")) {
        condition.id = $condition.getAttribute("data-id");
      }

      conditions.push(condition);
    });

    const _payload = { ...payload, conditions, assignments };
    let response = null;

    if (ruleId === null) {
      response = await api.saveRule(_payload);
    } else {
      response = await api.editRule(ruleId, _payload);
    }

    if (response.success === false) {
      alert(response.message || "Something went wrong.");
      return;
    }

    window.location.reload();
  });

  const $exportLink = document.getElementById("exportRules");
  $exportLink.addEventListener("click", async (event) => {
    event.preventDefault();
    await api.exportRules();
    await utils.sleep(0.5);

    Swal.fire({
      title: "What’s next?",
      html: `
        <ol>
          <li>Switch to the company you want these rules for.</li>
          <li>From the Banking page, go to your Rules list. Click New Rule > Import rules.</li>
          <li>Step through the workflow to upload and import your rules.</li>
        </ol>
      `,
      showCloseButton: true,
      confirmButtonText: "Close",
      customClass: {
        container: "exportRulesPrompt",
      },
    });
  });

  setupImportRulesForm();

  $("#createRules").on("hidden.bs.modal", () => {
    window.resetRuleForm();
  });

  new RulesTable($("#rulesTable"));
});

window.openRuleForm = async (data = null) => {
  const $newRuleModal = document.getElementById("createRules");
  const $parent = $newRuleModal.closest("#createRuleModalRight");

  $parent.classList.remove("createRuleModalRight--edit");

  if (data === null) {
    $($newRuleModal).modal("show");
    return;
  }

  $parent.classList.add("createRuleModalRight--edit");

  const $addRuleForm = document.getElementById("addRuleForm");
  const $dataTypes = $addRuleForm.querySelectorAll("[data-type]");
  const $conditions = $addRuleForm.querySelectorAll(".addCondition-container > div"); // prettier-ignore
  const $conditionsWrapper = $addRuleForm.querySelector(".addCondition-container"); // prettier-ignore
  const $saveBtn = $addRuleForm.querySelector("[data-action=save]");

  $saveBtn.setAttribute("data-id", data.id);

  const assignCondition = ($element, conditionData) => {
    const { description, contain, comment } = conditionData;
    $element.setAttribute("data-id", conditionData.id);
    $element.querySelector("[data-type='conditions.description']").value = description; // prettier-ignore
    $element.querySelector("[data-type='conditions.contain']").value = contain;
    $element.querySelector("[data-type='conditions.comment']").value = comment;
  };

  Object.keys(data).forEach((key) => {
    const value = data[key];
    const isNonEmptyArray = Array.isArray(value) && value.length >= 1;

    if (key === "conditions" && isNonEmptyArray) {
      const [firstCondition, ...rest] = value;
      assignCondition($conditions[0], firstCondition);

      if (rest.length) {
        rest.forEach((condition) => {
          const $condition = $conditions[0].cloneNode(true);
          assignCondition($condition, condition);
          $($conditionsWrapper).append($condition);
        });
      }
      return;
    }

    if (key === "assignments" && isNonEmptyArray) {
      value.forEach((assignment) => {
        const $input = $addRuleForm.querySelector(`[data-type='assignments.${assignment.type}']`); // prettier-ignore
        if ($input) {
          $input.value = assignment.value;
          $input.setAttribute("data-id", assignment.id);
          if ($input.classList.contains("select2-hidden-accessible")) {
            $($input).val(assignment.value).trigger("change");
          }
        }
      });
      return;
    }

    $input = [...$dataTypes].find(($dataType) => {
      return $dataType.getAttribute("data-type") === key;
    });

    if (!$input) {
      return;
    }

    if ($input.matches('[type="checkbox"]')) {
      $input.checked = value == 0;
    } else {
      $input.value = value;
    }
  });

  $($newRuleModal).modal("show");
};

window.resetRuleForm = () => {
  const $newRuleModal = document.getElementById("createRules");
  const $parent = $newRuleModal.closest("#createRuleModalRight");
  const $dataTypes = $newRuleModal.querySelectorAll("[data-type]");
  const $formError = $newRuleModal.querySelector(".formError");
  const $form = $newRuleModal.querySelector("#addRuleForm");

  $parent.classList.remove("createRuleModalRight--edit");
  $formError.classList.remove("formError--show");

  for (let index = 0; index < $dataTypes.length; index++) {
    const $element = $dataTypes[index];
    $element.classList.remove("inputError");

    if ($element.type === "checkbox") {
      $element.checked = false;
      continue;
    }

    if ($element.type !== "select-one") {
      $element.value = "";
      continue;
    }

    const $firstOption = $element.querySelector("option");
    if ($firstOption) {
      const firstOptionValue = $firstOption.textContent;
      $element.value = firstOptionValue;
    }

    if ($element.classList.contains("select2-hidden-accessible")) {
      $($element).val("").trigger("change");
    }
  }

  // assignments
  if ($form.hasAttribute("data-add-split")) {
    const $$form = $($form);
    $$form.removeAttr("data-add-split");
    $$form.find("#mainCategory").attr("name", "category[]");
    $$form.find(".add-split-container").hide();
    $$form.find("#categoryDefault").show();
    $$form.find("#btnAddLine").hide();
  }

  // conditions
  const $conditions = $newRuleModal.querySelectorAll(".addCondition-container > div"); // prettier-ignore
  if ($conditions.length === 1) {
    return;
  }
  for (let index = 0; index < $conditions.length; index++) {
    const $condition = $conditions[index];

    if (index === 1) {
      $condition.removeAttribute("data-id");
      continue;
    }

    $condition.remove();
  }
};

window.setupImportRulesForm = async () => {
  const api = await import("./api.js");
  const utils = await import("./utils.js");
  const { RulesImportTable } = await import("./RulesImportTable.js");

  const $error = document.querySelector(".stepperError");
  const $stepper = document.getElementById("importRulesStepper");
  const $importLink = document.getElementById("importRulesLink");
  const $importModal = document.getElementById("importRules");
  const $importNext = document.getElementById("importRulesNext");
  const $stepRulesFile = document.getElementById("stepRulesFile");
  const $cancelBtn = document.getElementById("importRulesCancel");
  const $table = document.getElementById("stepRulesTable");
  const $payee = document.getElementById("importRulesPayee");
  const $category = document.getElementById("importRulesCategory");

  utils.initSelect({ $select: $($payee), field: "payee" });
  utils.initSelect({ $select: $($category), field: "bank-account" });

  const handleCheckboxChange = () => {
    $importNext.disabled = !$table.querySelector(".rulesTable__row--selected");
  };

  const resetForm = () => {
    stepper.reset();
    data = null;
    importResponse = null;
    $stepRulesFile.value = null;
    $stepRulesFile.nextElementSibling.textContent = "No file selected";
    $importNext.disabled = true;
    $($error).hide();
    $($payee).val("").trigger("change");
    $($category).val("").trigger("change");
  };

  const setupFinishMessage = ({ success, failed }) => {
    const $success = document.querySelector(".stepperComplete");
    const $failed = document.querySelector(".stepperComplete--error");

    const getCountElement = ($parent) => {
      return $parent.querySelector(".stepperComplete__count");
    };

    $($success).hide();
    $($failed).hide();

    if (success.length > 0) {
      $($success).show();
      getCountElement($success).textContent = success.length;
    }

    if (failed.length > 0) {
      $($failed).show();
      getCountElement($failed).textContent = failed.length;
    }
  };

  const table = new RulesImportTable($($table));
  table.onCheckboxChange = handleCheckboxChange;
  const stepper = new Stepper($stepper);
  let data = null;
  let importResponse = null;

  resetForm();

  $importLink.addEventListener("click", (event) => {
    event.preventDefault();
    $($importModal).modal("show");
  });

  $importNext.addEventListener("click", async () => {
    if (stepper._currentIndex === 0) {
      if (data === null) {
        return;
      }
    }

    if (stepper._currentIndex === 1) {
      if (!$table.querySelector(".rulesTable__row--selected")) {
        return;
      }
    }

    if (stepper._currentIndex === 2) {
      let selected = $.map(
        table.table.rows(".rulesTable__row--selected").data(),
        (item) => item
      );

      if (selected.length === 0) {
        return;
      }

      const category = getFormElementValue($category);
      const payee = getFormElementValue($payee);

      selected = selected.map((item) => {
        return {
          ...item,
          ["Rule Outputs"]: [
            ...item["Rule Outputs"],
            {
              type: "category",
              value: category,
              percentage: null,
            },
            {
              type: "payee",
              value: payee,
              percentage: null,
            },
          ],
        };
      });

      $importNext.disabled = true;
      importResponse = await api.apiImportRules({ rules: selected });
      setupFinishMessage(importResponse);
      $importNext.disabled = false;
    }

    if (stepper._currentIndex === 3) {
      window.location.reload();
      return;
    }

    stepper.next();
  });

  $stepRulesFile.addEventListener("change", async function (event) {
    const [file] = this.files;
    const { name: fileName } = file;
    this.nextElementSibling.textContent = fileName;

    const response = await api.parseFile(file);

    if (!response.success) {
      $($error).show();
      return;
    }

    data = response.data;
    $importNext.disabled = false;
    $($error).hide();
  });

  $stepper.addEventListener("shown.bs-stepper", function (event) {
    const { indexStep: step } = event.detail;

    if (step !== 1) {
      return;
    }

    table.render(data);
  });

  $($importModal).on("hidden.bs.modal", () => {
    resetForm();
  });

  $cancelBtn.addEventListener("click", () => {
    $($importModal).modal("hide");
  });
};

window.getFormElementValue = ($element) => {
  if ($element.type === "checkbox") {
    return $element.checked;
  }

  if ($($element).hasClass("select2-hidden-accessible")) {
    const data = $($element).select2("data");
    const value = data.find(({ id }) => id === $element.value);
    return value ? value.text : "";
  }

  return $element.value;
};
