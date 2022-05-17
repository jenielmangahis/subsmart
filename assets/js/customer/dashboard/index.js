import * as common from "./common.js";

window.document.addEventListener("DOMContentLoaded", async () => {
  common.getCustomer().then(() => {
    import("./modules/profile.js");
    import("./modules/docu.js");
    import("./modules/office.js");
    import("./modules/assign.js");
    import("./modules/tech.js");
  });
});
