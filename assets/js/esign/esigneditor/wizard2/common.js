function clean(string) {
  return string.split("_").join(" ").toLowerCase();
}

export const tableColumns = {
  checkbox: () => {
    return '<input type="checkbox" class="table__checkbox" />';
  },
  creditor: (_, __, row) => {
    return row.creditor;
  },
  accountNumber: (_, __, row) => {
    const elements = row.items.map((item) => {
      return `<div class="accountnum">
        ${item.bureau}: ${item.account_number || ""}
      </div>`;
    });

    return elements.join("");
  },
  reason: (_, __, row) => {
    return `<div class="reason">${row.reason}</div>`;
  },
  isDisputed: (_, __, row) => {
    const value = row.is_disputed ? "Yes" : "No";
    return `<div>${value}</div>`;
  },
  equifax: (_, __, row) => {
    const equifax = row.items.find((item) => {
      return item.bureau === "Equifax";
    });

    if (!equifax) return "";
    const status = clean(equifax.status);

    return `<div class="status status--${status}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${status}</span>
    </div>`;
  },
  experian: (_, __, row) => {
    const experian = row.items.find((item) => {
      return item.bureau === "Experian";
    });

    if (!experian) return "";
    const status = clean(experian.status);

    return `<div class="status status--${status}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${status}</span>
    </div>`;
  },
  transunion: (_, __, row) => {
    const transunion = row.items.find((item) => {
      return item.bureau === "Trans Union";
    });

    if (!transunion) return "";
    const status = clean(transunion.status);

    return `<div class="status status--${status}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${status}</span>
    </div>`;
  },
  remove: () => {
    return `<button class="btn-delete action" type="button" data-action="remove">
        <i class="fa fa-trash">
    </button>`;
  },
};
