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
  $addRuleForm.addEventListener("submit", async function (event) {
    event.preventDefault();

    const payload = {};

    const $dataTypes = this.querySelectorAll("[data-type]");
    [...$dataTypes].forEach(($dataType) => {
      const dataType = $dataType.getAttribute("data-type");
      if (dataType.includes(".")) return;

      if ($dataType.type === "checkbox") {
        payload[dataType] = $dataType.checked;
        return;
      }

      payload[dataType] = $dataType.value;
    });

    const $conditions = this.querySelectorAll(".addCondition-container > div");
    const conditions = [];
    [...$conditions].forEach(($condition) => {
      const $dataTypes = $condition.querySelectorAll("[data-type]");
      const condition = {};

      [...$dataTypes].forEach(($dataType) => {
        const dataTypeTemp = $dataType.getAttribute("data-type");
        const dataType = [...dataTypeTemp.split(".")].pop();
        condition[dataType] = $dataType.value;
      });

      conditions.push(condition);
    });

    const response = await api.saveRate({ ...payload, conditions });
    window.location.reload();
  });

  new RulesTable($("#rulesTable"));
});
