window.addEventListener("DOMContentLoaded", async () => {
  const { SelectWithCheckbox } = await import("./SelectWithCheckbox.js");
  const { RulesTable } = await import("./RulesTable.js");
  const api = await import("./api.js");

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

  $addRuleBtn.addEventListener("click", async function (event) {
    const payload = {};
    const assignment = {};
    const conditions = [];

    const $dataTypes = $addRuleForm.querySelectorAll("[data-type]");
    const $errorMessage = $addRuleForm.querySelector(".formError");
    $errorMessage.classList.remove("formError--show");

    for (let index = 0; index < $dataTypes.length; index++) {
      const $element = $dataTypes[index];
      $element.classList.remove("inputError");

      if ($element.type === "checkbox") {
        continue;
      }

      if (!$element.hasAttribute("required")) {
        continue;
      }

      if (isEmpty(getFormElementValue($element))) {
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

      const [, assignmentKey] = dataType.split(".");
      assignment[assignmentKey] = value;
    });

    const $conditions = this.querySelectorAll(".addCondition-container > div");
    [...$conditions].forEach(($condition) => {
      const $dataTypes = $condition.querySelectorAll("[data-type]");
      const condition = {};

      [...$dataTypes].forEach(($dataType) => {
        const dataTypeTemp = $dataType.getAttribute("data-type");
        const dataType = [...dataTypeTemp.split(".")].pop();
        condition[dataType] = getFormElementValue($dataType);
      });

      conditions.push(condition);
    });

    const _payload = { ...payload, conditions, assignment };
    const response = await api.saveRate(_payload);
    window.location.reload();
  });

  new RulesTable($("#rulesTable"));
});
