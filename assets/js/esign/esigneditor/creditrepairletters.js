(async () => {
  async function getLetter(row) {
    const id = row.getAttribute("letter_id");
    const title = row.querySelector("td:nth-child(1) a").textContent.trim();
    const category = row.querySelector("td:nth-child(2)").textContent.trim();

    const endpoint = " https://app.creditrepaircloud.com/mediacenter/view";
    const formData = new FormData();
    formData.append("tid", id);
    const response = await fetch(endpoint, { method: "post", body: formData });
    const text = await response.text();

    const parser = new DOMParser();
    const doc = parser.parseFromString(text, "text/html");
    const $html = doc.firstChild;
    const $chbox = $html.querySelector(".chbox");
    if ($chbox) {
      $chbox.parentNode.removeChild($chbox);
    }

    const $pageBreaks = [...$html.querySelectorAll(".pageBreak")];
    $pageBreaks.forEach(($pageBreak) => {
      $pageBreak.removeAttribute("style");
    });

    // cleanup html :/
    let html = $html.innerHTML.replace(/\n/g, "");
    html = html.split("\\");
    html = html.join("");

    return {
      id,
      title,
      category,
      content: html,
    };
  }

  const rows = [...document.querySelectorAll("#librarylist tr[letter_id]")];
  const letters = await Promise.all(rows.map(getLetter));
  console.log(JSON.stringify(letters));
})();
