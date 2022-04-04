function clean(string) {
  return string.split("_").join(" ");
}

export const tableColumns = {
  checkbox: () => {
    return '<input type="checkbox" class="table__checkbox" />';
  },
  creditor: (_, __, row) => {
    return row.creditor;
  },
  accountNumber: (_, __, row) => {
    const accounts = Object.entries(row.account_numbers);
    const elements = accounts.map(([key, value]) => {
      return `<div class="accountnum">${key}: ${value || ""}</div>`;
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
  equifax: (_, __, { equifax }) => {
    if (!equifax) return "";

    return `<div class="status status--${equifax}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${clean(equifax)}</span>
    </div>`;
  },
  experian: (_, __, { experian }) => {
    if (!experian) return "";

    return `<div class="status status--${experian}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${clean(experian)}</span>
    </div>`;
  },
  transunion: (_, __, { transunion }) => {
    if (!transunion) return "";

    return `<div class="status status--${transunion}">
        <span class="status__logo"><i class="fa fa-clock"></i></span>
        <span class="text-muted text-capitalize">${clean(transunion)}</span>
    </div>`;
  },
  remove: () => {
    return `<button class="btn-delete action" type="button" data-action="remove">
        <i class="fa fa-trash">
    </button>`;
  },
};
