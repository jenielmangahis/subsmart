function Pub() {
  const prefixURL = location.hostname === "localhost" ? "/nsmartrac" : "";
  const urlParams = new URLSearchParams(window.location.search);
  const hash = urlParams.get("hash");

  let document = null;
  let fields = [];
  let signatures = [];

  async function fetchDocument() {
    const endpoint = `${prefixURL}/FillAndSignPub/getDocument/${hash}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    document = data.document;
  }

  async function fetchFields() {
    const endpoint = `${prefixURL}/FillAndSign/getFields/${document.id}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    fields = data.fields;
  }

  async function fetchSignatures() {
    const endpoint = `${prefixURL}/FillAndSign/getSignatures/${document.id}`;
    const response = await fetch(endpoint);
    const data = await response.json();
    signatures = data.signatures;
  }

  async function init() {
    await fetchDocument();
    await fetchFields();
    await fetchSignatures();

    console.log({ fields, document, signatures });
  }

  return { init };
}

new Pub().init();
