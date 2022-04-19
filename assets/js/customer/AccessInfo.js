// https://stackoverflow.com/a/26528271/8062659
const Password = {
  _pattern: /[a-zA-Z0-9_\-\+\.]/,

  _getRandomByte: function () {
    // http://caniuse.com/#feat=getrandomvalues
    if (window.crypto && window.crypto.getRandomValues) {
      var result = new Uint8Array(1);
      window.crypto.getRandomValues(result);
      return result[0];
    } else if (window.msCrypto && window.msCrypto.getRandomValues) {
      var result = new Uint8Array(1);
      window.msCrypto.getRandomValues(result);
      return result[0];
    } else {
      return Math.floor(Math.random() * 256);
    }
  },

  generate: function (length) {
    return Array.apply(null, { length: length })
      .map(function () {
        var result;
        while (true) {
          result = String.fromCharCode(this._getRandomByte());
          if (this._pattern.test(result)) {
            return result;
          }
        }
      }, this)
      .join("");
  },
};

const $password = document.querySelector("[data-type=access_info_pass]");
const $passwordBtn = document.querySelector("[data-action=access_info_generate_pass]"); // prettier-ignore

function setPassword() {
  $password.value = Password.generate(16);
}

setPassword();
$passwordBtn.addEventListener("click", setPassword);
