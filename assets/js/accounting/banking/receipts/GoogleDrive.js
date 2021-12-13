export class GoogleDrive {
  creds = null;
  MAX_FILES = 3;

  constructor() {
    this.$button = $("#googleDriveConnectButton");

    this.loadDeps().then(() => {
      this.addEventListeners();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
    const response = await this.api.getGoogleCreds();
    this.creds = response.data;

    gapi.load("auth");
    gapi.load("picker");
    gapi.client.load("drive", "v3");
  }

  addEventListeners() {
    this.$button.on("click", async () => {
      const scopes = ["https://www.googleapis.com/auth/drive"];

      gapi.auth.authorize(
        {
          client_id: this.creds.client_id,
          scope: scopes.join(" "),
          prompt: "consent",
          access_type: "offline",
          response_type: "code token",
        },
        (result) => this.handleAuthResult(result)
      );
    });
  }

  handleAuthResult(result) {
    this.$button.removeClass("googleDriveConnectButton--error");

    if (!result.access_token) {
      console.error(result);
      this.$button.addClass("googleDriveConnectButton--error");
      return;
    }

    const view = new google.picker.View(google.picker.ViewId.DOCS);
    view.setMimeTypes("image/png,image/jpeg,image/jpg");
    const picker = new google.picker.PickerBuilder()
      .enableFeature(google.picker.Feature.NAV_HIDDEN)
      .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
      .setMaxItems(this.MAX_FILES)
      .setTitle(`Please select up to ${this.MAX_FILES} files`)
      .setOAuthToken(result.access_token)
      .addView(view)
      .addView(new google.picker.DocsUploadView())
      .setCallback((data) => this.onPickFile(data))
      .build();
    picker.setVisible(true);
  }

  async onPickFile(data) {
    if (data[google.picker.Response.ACTION] !== google.picker.Action.PICKED) {
      return;
    }

    const $loader = $("#googleDriveLoader");
    $loader.addClass("show");

    const docs = data[google.picker.Response.DOCUMENTS];
    const ids = docs.map((doc) => doc[google.picker.Document.ID]);

    const promises = ids.map(async (id) => {
      const response = await gapi.client.drive.files.get({ fileId: id, alt: "media" }); // prettier-ignore
      const contentType = response.headers["Content-Type"];
      const encoded = btoa(response.body);
      const dataUrl = `data:${contentType};base64,${encoded}`;
      return { base64: dataUrl };
    });

    const results = await Promise.all(promises);
    const { data: receipts } = await this.api.uploadGoogleDriveImages({
      files: results,
    });

    const $table = $("#receiptsReview");
    receipts.forEach((receipt) => {
      $table.DataTable().row.add(receipt).draw();
    });

    $loader.removeClass("show");
  }
}
