window.addEventListener("DOMContentLoaded", () => {
  initJobType();
  initJobTag();
  initTaxRates();
});

async function initJobType(selector = "#job_type_option") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  const template = templateResult("icon_marker");

  $($select).select2({
    placeholder: "Select Job Type",
    templateResult: template,
    templateSelection: template,
    ajax: {
      url: "/job/apiGetJobTypes",
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

  if ($select.get(0).dataset.value) {
    $($select).val($select.dataset.value).trigger("change");
  }
}

async function initJobTag(selector = "#job_tags") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  const template = templateResult("marker_icon");

  $($select).select2({
    placeholder: "Select Job Tag",
    templateResult: template,
    templateSelection: template,
    ajax: {
      url: "/job/apiGetJobTags",
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

  if ($select.get(0).dataset.value) {
    $($select).val($select.dataset.value).trigger("change");
  }
}

function initTaxRates(selector = "#tax_rate") {
  const $select = $(selector);
  if ($select.hasClass("select2-hidden-accessible")) {
    $select.select2("destroy");
  }

  $($select).select2({
    placeholder: "Select Tax Rate",
    ajax: {
      url: "/job/apiGetJobTaxRates",
      dataType: "json",
      data: (params) => {
        return { search: params.term };
      },
      processResults: (response) => {
        return {
          results: response.data.map((item) => ({
            ...item,
            id: item.rate,
            text: `${item.name} (${item.rate}%)`,
          })),
        };
      },
    },
  });

  if ($select.get(0).dataset.value) {
    $($select).val($select.dataset.value).trigger("change");
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
      icon = `/uploads/icons/${icon}`;
    } else {
      icon = "/uploads/job_tags/default_no_image.jpg";
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
