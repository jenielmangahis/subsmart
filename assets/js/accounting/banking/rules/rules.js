window.addEventListener("DOMContentLoaded", async () => {
  const { SelectWithCheckbox } = await import("./SelectWithCheckbox.js");
  const { RulesTable } = await import("./RulesTable.js");
  const api = await import("./api.js");

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

  const getFormElementValue = ($element) => {
    if ($element.type === "checkbox") {
      return $element.checked;
    }

    return $element.value;
  };

  function isEmpty(string) {
    // https://stackoverflow.com/a/3261380/8062659
    return !string || string.length === 0;
  }

  $addRuleBtn.addEventListener("click", async function () {
    if (this.hasAttribute("data-id")) {
      return; // TODO: implement update
    }

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

      if (!dataType.startsWith("assignment.")) {
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
        percentage: 100,
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

      conditions.push(condition);
    });

    const _payload = { ...payload, conditions, assignments };
    const response = await api.saveRule(_payload);
    window.location.reload();
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
        const $input = $addRuleForm.querySelector(`[data-type='assignment.${assignment.type}']`); // prettier-ignore
        if ($input) {
          $input.value = assignment.value;
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
