Array.from(document.querySelectorAll(".auth-pass-input")).forEach(function (e) {
  Array.from(e.querySelectorAll(".password-addon")).forEach(function (r) {
    r.addEventListener("click", function (r) {
      var o = e.querySelector(".password-input");
      "password" === o.type ? (o.type = "text") : (o.type = "password");
    });
  });
});
