window.addEventListener("DOMContentLoaded", () => {
  initJobType();
  initJobTag();
  initTaxRates();
});

async function initJobType(selector = "#job_type") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  if (!$select.length) {
    return;
  }

  const template = templateResult("icon_marker");

  $($select).select2({
    placeholder: "Select Job Type",
    templateResult: template,
    templateSelection: template,
    ajax: {
      url: base_url + "job/apiGetJobTypes",
      dataType: "json",
      data: (params) => {
        return { search: params.term };
      },
      processResults: (response) => {
        return {
          results: response.data.map((item) => ({
            ...item,
            id: item.id,
            text: item.title,
          })),
        };
      },
    },
  });
}

async function initJobTag(selector = "#job_tag") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  if (!$select.length) {
    return;
  }

  const template = templateResult("marker_icon");
  $($select).select2({
    placeholder: "Select Job Tag",
    templateResult: template,
    templateSelection: template,
    ajax: {
      url: base_url + "job/apiGetJobTags",
      dataType: "json",
      data: (params) => {
        return { search: params.term };
      },
      processResults: (response) => {
        const results = response.data.map((item) => ({
          ...item,
          id: item.id,
          text: item.name,
        }));

        window.__jobTags = results;
        return {
          results,
        };
      },
    },
  });
}

function initTaxRates(selector = "#tax_rate") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  if (!$select.length) {
    return;
  }

  // $($select).select2({
  //   placeholder: "Select Tax Rate",
  //   ajax: {
  //     url: base_url + "job/apiGetJobTaxRates",
  //     dataType: "json",
  //     data: (params) => {
  //       return { search: params.term };
  //     },
  //     processResults: (response) => {
  //       return {
  //         results: response.data.map((item) => ({
  //           ...item,
  //           id: item.rate,
  //           text: `${item.name} (${item.rate}%)`,
  //         })),
  //       };
  //     },
  //   },
  // });

  if ($select.get(0).dataset.value) {
    const value = Number($select.get(0).dataset.value);
    let total = $("#invoice_sub_total").text();
    total = Number(total.replace(/[^0-9.-]+/g, ""));
    const percentage = (value / total) * 100;

    // fetch("/job/apiGetJobTaxRates").then(async (response) => {
    //   const { data } = await response.json();
    //   const match = data.find((tax) => tax.rate === percentage.toFixed(2));
    //   if (match) {
    //     $($select).append(`
    //       <option selected="true">${match.name} (${match.rate}%)</option>
    //     `);
    //   }
    // });
  }
}

function templateResult(iconKey) {
  return function (item) {
    if (typeof item.id !== "string" || !item.id.length) {
      return item.text;
    }

    let icon = item[iconKey] || undefined;

    if (!icon && iconKey === "marker_icon" && Array.isArray(window.__jobTags)) {
      // Fix about weird issue where icon not showing on value
      const match = window.__jobTags.find((tag) => tag.id === item.id);
      if (match.marker_icon) {
        icon = match.marker_icon;
      }
    }

    if (!icon && item.element && item.element.dataset.image) {
      icon = item.element.dataset.image;
    }

    if (typeof icon === "string" && icon.length) {      
      icon = base_url + `/uploads/icons/${icon}`;
    } else {      
      icon = base_url + "/uploads/job_tags/default_no_image.jpg";
    }

    return $(
      `
        <span style="display: grid; grid-template-columns: 20px 1fr; grid-gap: 10px; align-items: center;">
            <img src="${icon}" style="width: 100%;"/>
            <span>${item.text}</span>
        </span>
        `
    );
  };
}
