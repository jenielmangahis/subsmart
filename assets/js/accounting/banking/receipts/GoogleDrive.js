export class GoogleDrive {
  constructor() {
    this.$button = $("#googleDriveConnectButton");

    this.loadDeps().then(() => {
      this.addEventListeners();
    });
  }

  async loadDeps() {
    this.api = await import("./api.js");
  }

  addEventListeners() {
    this.$button.on("click", async (event) => {
      const { data: creds } = await this.api.geetGoogleCreds();
      const scopes = [
        "https://www.googleapis.com/auth/userinfo.profile",
        "https://www.googleapis.com/auth/userinfo.email",
        "https://www.googleapis.com/auth/drive.metadata.readonly",
      ];

      gapi.auth.authorize(
        {
          client_id: creds.client_id,
          scope: scopes.join(" "),
          prompt: "consent",
          access_type: "offline",
          response_type: "code token",
        },
        this.handleAuthResult
      );
    });
  }

  handleAuthResult(auth) {
    console.log(auth);
  }
}
