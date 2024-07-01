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
    var method_type;

    $(".custom-validation").parsley();
    show_loadmore();

    get_datadisposition(0);
    count_inmaildeadline();
});

// <!-- ====================================================================================== PAGE SETTING ===================================================================================== -->

function show_loadmore() {
  $("#load-more").click(function(e){
      e.preventDefault();
      var page = $(this).data('val');
      get_datadisposition(page);
  });
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

function count_inmaildeadline() {
  $.ajax({
      url: baseURL+"inbox/count_inmaildeadline/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data > 0) {
          new Audio(baseURL+'uploads/app/audio/deadline.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("warning", "<b>ALERT !!!</b> <br> Ada pesan yang sudah melebihi <strong>Batas Waktu / Deadline</strong> belum dibaca!");
          notification.push();
          return;
        } else {
          return;
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}
