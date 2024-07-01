! function() {
  "use strict";
  window.addEventListener("load", function() {
    var t = document.getElementsByClassName("needs-validation");
    Array.prototype.filter.call(t, function(e) {
      e.addEventListener("submit", function(t) {
        !1 === e.checkValidity() && (t.preventDefault(), t.stopPropagation()), e.classList.add("was-validated")
      }, !1)
    })
  }, !1)
}(), $(document).ready(function(){

});

function validation_auth(action) {
  var ef = document.getElementById("form");
  if (!$('[name="input-Username"]').val() || !$('[name="input-Password"]').val()) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.btn-login').prop("disabled", true);
    $('.btn-login').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Validating...`);
    document.getElementById("form").action = baseURL+"auth/validation_auth";
  }
}
