export function sleep(seconds) {
  return new Promise((resolve) => setTimeout(resolve, seconds * 1000));
}

export function confirmDelete() {
  return Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#2ca01c",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete!",
  });
}

export function initSelect(options = null) {
  if (options === null) {
    return;
  }

  const { $select, field } = options;
  const modal = "expenseModal";

  const formatResult = (optionElement) => {
    var searchField = $(".select2-search__field");
    var text = optionElement.text;
    var searchVal = $(searchField[searchField.length - 1]).val();
    if (searchVal === "") {
      return text;
    }

    return $(`<span>${text}</span>`);
  };

  const optionSelect = (data) => {
    var text = data.text;
    text = text.replaceAll("<strong>", "");
    text = text.replaceAll("</strong>", "");
    text = $.trim(text);
    return text;
  };

  $select.select2({
    templateResult: formatResult,
    templateSelection: optionSelect,
    ajax: {
      url: "/accounting/get-dropdown-choices",
      dataType: "json",
      data: (params) => ({
        search: params.term,
        type: "public",
        field,
        modal,
      }),
    },
  });

  const $modalContainer = $("#modal-container div.full-screen-modal");
  $select.on("change", function () {
    if ($(this).val() !== "add-new") {
      return;
    }

    if (field === "bank-account") {
      $.get(
        `/accounting/get-dropdown-modal/account_modal?modal=${modal}&field=${field}`,
        (result) => {
          $modalContainer.html(result);
          initAccountModal(); // global function

          $("#account-modal").on("hide.bs.modal", function () {
            // Assign value to nonexisting option, this is the only
            // way I was able to successfully empty the value.
            $select.select2("val", "_");
          });
        }
      );
    }
  });
}
