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
    var method_type, loc, dir;
});

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= BACKUP DATABASE

function database_backup() {
  $.ajax({
      url: baseURL+"mdatabase/backup",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        loc = window.location.href;
        dir = loc.substring(0, loc.lastIndexOf('/'));

        new Audio(baseURL+'uploads/app/audio/success.mp3').play();
        Swal.fire({
            title: "<b>201 Request Successfully Created</b>",
            text: "Database berhasil dibackup kedalam folder "+dir+"/database/backup",
            type: "success"
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        new Audio(baseURL+'uploads/app/audio/error.mp3').play();
        var notifier = new Notifier();
        var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
        notification.push();
        return;
      }
  });
}
