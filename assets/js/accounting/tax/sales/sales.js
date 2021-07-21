class Accounting__TaxItem {
  constructor() {
    this.$modal = $("#reviewSalesTaxModal");
  }

  createElement(data) {
    const $templateCopy = $(document.importNode(this.$template.get(0).content, true)); // prettier-ignore
    const dataNames = ["date", "address", "due_date", "price"];
    dataNames.forEach((name) => {
      $templateCopy.find(`[data-value=${name}]`).text(data[name]);
    });

    const $button = $templateCopy.find(".btn-primary");
    $button.on("click", () => {
      this.$modal.modal("show");
    });

    return $templateCopy;
  }
}

class Accounting__OverdueItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#overdueItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

class Accounting__DueItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#dueItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

class Accounting__UpcomingItem extends Accounting__TaxItem {
  constructor() {
    super();
    this.$template = $("#upcomingItemTemplate");
    this.createElement = super.createElement.bind(this);
  }
}

(async function Accounting__SalesTax() {
  const data = [
    {
      date: "July 2020",
      address: "Philippines",
      due_date: "August 2020",
      price: "$34.22",
    },
    {
      date: "August 2020",
      address: "Florida",
      due_date: "December 2020",
      price: "$44.30",
    },
    {
      date: "September 2020",
      address: "Canada",
      due_date: "January 2021",
      price: "$12.21",
    },
  ];

  const $overdueContainer = $("#overdueContainer");
  const $dueContainer = $("#dueContainer");
  const $upcomingContainer = $("#upcomingContainer");

  const overdueItem = new Accounting__OverdueItem();
  const dueItem = new Accounting__DueItem();
  const upcoming = new Accounting__UpcomingItem();

  const overdueItems = data.map(overdueItem.createElement);
  const dueItems = data.map(dueItem.createElement);
  const upcomings = data.map(upcoming.createElement);

  await sleep(2500);

  $overdueContainer.html(overdueItems);
  $dueContainer.html(dueItems);
  $upcomingContainer.html(upcomings);

  const $sidebar = $("#addAdjustment");
  const $sidebarCloseBtn = $sidebar.find(".addAdjustment__close");
  const $modal = $("#reviewSalesTaxModal");
  const $addAdjustmentLink = $modal.find("#addAdjustmentLink");

  $addAdjustmentLink.on("click", (event) => {
    event.preventDefault();
    $sidebar.addClass("addAdjustment--show");
  });

  $sidebarCloseBtn.on("click", () => {
    $sidebar.removeClass("addAdjustment--show");
  });

  $modal.on("hidden.bs.modal", () => {
    $sidebar.removeClass("addAdjustment--show");
  });
})();

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}
