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
});

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= ACTION METHOD

function reset_method() {
  var ef = document.getElementById("form");
  var formData = new FormData($('#form')[0]);
  ef.classList.remove("was-validated");
  document.getElementById("report").style.display = "none";
  $('#show_list').html('');
  $('[name="input-DateStart"]').val('').datepicker('update');
  $('[name="input-DateEnd"]').val('').datepicker('update');
  $('[name="input-WorkunitID"]').val('');
}

function action_method() {
  var ef = document.getElementById("form");
  var formData = new FormData($('#form')[0]);

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $.ajax({
        url: baseURL+'incoming_report/report_inmail',
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          document.getElementById("report").style.display = "block";
          $('#show_list').html('');

          const dtawal = new Date($('[name="input-DateStart"]').val());
          const dtfawal = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
          const [{ value: daawal },,{ value: moawal },,{ value: yeawal }] = dtfawal.formatToParts(dtawal);
          $('[name="view-DateStart"]').html('<stong>Dari Tanggal: '+ `${daawal} ${moawal} ${yeawal}`);

          const dtakhir = new Date($('[name="input-DateEnd"]').val());
          const dtfakhir = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
          const [{ value: daakhir },,{ value: moakhir },,{ value: yeakhir }] = dtfakhir.formatToParts(dtakhir);
          $('[name="view-DateEnd"]').html('<stong>Sampai Tanggal: '+ `${daakhir} ${moakhir} ${yeakhir}`);

          var html = '';
          var i;
          var n = 1;
          for(i=0; i<data.length; i++){
              const dtsurat = new Date(data[i].InMailDate);
              const dtfsurat = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
              const [{ value: dasurat },,{ value: mosurat },,{ value: yesurat }] = dtfsurat.formatToParts(dtsurat);

              const dtterima = new Date(data[i].InMailLog);
              const dtfterima = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
              const [{ value: daterima },,{ value: moterima },,{ value: yeterima }] = dtfterima.formatToParts(dtterima);

              html += '<tr>'+
                          '<td><p class="text-muted text-center mb-0">'+(n+i)+'</></td>'+
                          '<td><p class="text-truncate mb-0"><b>'+data[i].InMailOrigin+'</b></p><p class="text-muted mb-0">'+data[i].InMailNumber+'</p></td>'+
                          '<td><p class="text-muted text-center mb-0">'+data[i].WorkunitName+'</p></td>'+
                          '<td><p class="text-muted text-center mb-0"><strong>'+data[i].IndeksName+'</strong></p></td>'+
                          '<td><p class="text-muted text-center mb-0">'+`${dasurat} ${mosurat} ${yesurat}`+'</p></td>'+
                          '<td><p class="text-muted text-center mb-0">'+`${daterima} ${moterima} ${yeterima}`+'</p></td>'+
                      '</tr>';
          }
          $('#show_list').html(html);

          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          return;
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
}
