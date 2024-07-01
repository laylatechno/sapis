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
    var method_type, num_attach;

    count_disposition(id);
    count_viewinmailattachment(id);

    get_viewinmail(id);
    get_viewdisposition(id);
    get_viewinmailattachment(id);

    setInterval(function(){
        realtime_viewinmailattachment(id);
    }, 3000);

    $("#modal_form").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form");
      ef.classList.remove("was-validated");
      $('#input-Username').val('').selectpicker('refresh');
      $('[name="input-DispositionDeadline"]').val('').datepicker('update');
    });

});

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_add() {
  method_type = 'add';
  $('.modal-title').text('Tambahkan Disposisi');
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.submit-button').prop("disabled", false);
  $('.submit-button').html('Tambah');
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= VIEW INBOX

function get_viewinmail(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmail/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        var valTrait = data.InMailTrait;
        var trait;
        if(valTrait == "Rahasia"){
            trait = '<span class="badge badge-pill badge-soft-primary font-size-12 ml-2">'+valTrait+'</span>';
        } else if(valTrait == "Penting"){
            trait = '<span class="badge badge-pill badge-soft-danger font-size-12 ml-2">'+valTrait+'</span>';
        } else {
            trait = '<span class="badge badge-pill badge-soft-secondary font-size-12 ml-2">'+valTrait+'</span>';
        }

        $('[name="view-InMailTrait"]').html(trait);
        $('[name="view-InMailOrigin"]').html(data.InMailOrigin);
        $('[name="view-InMailNumber"]').html('No Surat: '+data.InMailNumber+' - <strong>'+data.IndeksName+'</strong>');

        if (data.InMailContent) {
          $('[name="view-InMailContent"]').html(data.InMailContent);
        } else {
          $('[name="view-InMailContent"]').html('<i>Tidak ada deskripsi</i>');
        }

        const dtd = new Date(data.InMailDate);
        const dtfd = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit', weekday: 'long' });
        const [{ value: wed },,{ value: dad },,{ value: mod },,{ value: yed }] = dtfd.formatToParts(dtd);
        $('[name="view-InMailDate"]').html(`${wed}`+', '+`${dad} ${mod} ${yed}`);

        $('[name="view-WorkunitName"]').html(data.WorkunitName);

        get_viewinmailregister(id);
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

function get_viewinmailregister(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmailregister/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (!data.AccountProfile) {
          $('#view-register-AccountProfile').attr('src', '');
        } else {
          $('#view-register-AccountProfile').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountProfile);
        }
        $('[name="view-register-FullName"]').html('<a href="javascript:void(0)" class="text-dark" onclick="view_detailuser(\''+data.Username+'\');">'+data.FullName+'</a>');
        $('[name="view-register-WorkunitName"]').html('<span class="badge badge-pill badge-soft-'+data.RoleColor+' font-size-12">'+data.WorkunitName+'</span>');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= COUNT DISPOSISI
function count_disposition(id) {
  $.ajax({
      url: baseURL+"mail_detail/count_datadisposition/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('[name="count-disposisi"]').html(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= VIEW DISPOSITION

function get_viewdisposition(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_datadisposition/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.show-list').html('');

        var html = '';
        var i;
        var n = 1;
        for(i=0; i<data.length; i++){
            const dt = new Date(data[i].DispositionDeadline);
            const dtf = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
            const [{ value: da },,{ value: mo },,{ value: ye }] = dtf.formatToParts(dt);;

            if (!data[i].DispositionNote) {
              var disnote = 'Tidak ada catatan';
            } else {
              var disnote = data[i].DispositionNote;
            }

            html += '<tr>'+
                        '<td><p class="text-muted text-center mb-0">'+(n+i)+'</></td>'+
                        '<td><h5 class="text-truncate text-center font-size-14 mb-0">'+data[i].FullName+'</h5><p class="text-muted text-center mb-0">'+data[i].WorkunitName+'</p></td>'+
                        '<td><p class="text-muted text-center mb-0">'+disnote+'</p></td>'+
                        '<td><p class="text-muted text-center mb-0">'+`${da} ${mo} ${ye}`+'</p></td>'+
                        '<td class="d-print-none"><p class="text-muted text-center mb-0"><button type="button" class="btn btn-danger btn-sm" onclick="delete_disposition('+data[i].DispositionID+')"><i class="fa fa-trash"></i></button></p></td>'+
                    '</tr>';
        }
        $('.show-list').html(html);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= ACTION METHOD

function action_method() {
  var ef = document.getElementById("form");
  var url, message;
  var formData = new FormData($('#form')[0]);

  if(method_type == 'add') {
      url = baseURL+'disposition/add_disposition/'+id;
      message = 'Berhasil memberikan Disposisi kepada Pengguna tersebut';
  }

  if (!$('[name="input-Username"]').val() || !$('[name="input-DispositionDeadline"]').val()) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-button').prop("disabled", true);
    $('.submit-button').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Adding...`);
    $.ajax({
        url: url,
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          if (data.Message == "no") {
            new Audio(baseURL+'uploads/app/audio/cancel.mp3').play();
            Swal.fire({
                title: "Pengguna tersebut sudah di disposisikan pada Surat ini!",
                text: "Aksi tersebut tidak dapat dilakukan",
                type: "warning"
            });
            $('.submit-button').prop("disabled", false);
            $('.submit-button').html('Tambah');
          } else {
            $('#modal_form').modal('hide');
            count_disposition(id);
            get_viewdisposition(id);
            new Audio(baseURL+'uploads/app/audio/success.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>"+message);
            notification.push();
            return;
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form').modal('hide');
          new Audio(baseURL+'uploads/app/audio/error.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
          notification.push();
          return;
        }
    });
  }
}

// ================================================================================= DELETE COMMENTAR

function delete_disposition(iddis) {
  Swal.fire({
      title: "Hapus Disposisi pada Pengguna tersebut?",
      text: "Anda tidak akan dapat mengembalikan ini!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Ya, hapus saja!",
      cancelButtonText: "Tidak, batalkan!",
      confirmButtonClass: "btn btn-success mt-2",
      cancelButtonClass: "btn btn-danger ml-2 mt-2",
      buttonsStyling: !1
  }).then((result) => {
      if(result.value) {
          $.ajax({
              url: baseURL+'disposition/delete_disposition/'+iddis,
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                count_disposition(id);
                get_viewdisposition(id);
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil menghapus Disposisi pada Pengguna tersebut");
                notification.push();
                return;
              },
              error: function (jqXHR, textStatus, errorThrown){
                new Audio(baseURL+'uploads/app/audio/error.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
                notification.push();
                return;
              }
          });
      } else {
        new Audio(baseURL+'uploads/app/audio/cancel.mp3').play();
        Swal.fire({
            title: "Membatalkan!",
            text: "Aksi tersebut dibatalkan",
            type: "error"
        });
      }
  });
}

// ================================================================================= VIEW ATTACHMENT

function count_viewinmailattachment(id){
  $.ajax({
      url: baseURL+"mail_detail/count_viewinmailattachment/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        num_attach = data;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function realtime_viewinmailattachment(id){
  $.ajax({
      url: baseURL+"mail_detail/count_viewinmailattachment/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data == num_attach) {

        } else {
          get_viewinmailattachment(id);
          num_attach = data;
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function get_viewinmailattachment(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmailattachment/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.show-attachment').html('');
        var html = '';
        var i;

        if (data.length == 0) {
          html += '<tr>'+
                      '<td>'+
                          '<p class="text-muted text-center mb-0">Tidak ada lampiran</p>'+
                      '</td>'+
                  '</tr>';
          $('.show-attachment').html(html);
        } else {
          for(i=0; i<data.length; i++){
              if (data[i].AttachmentFile.split('.').pop() == 'doc' || data[i].AttachmentFile.split('.').pop() == 'docx') {
                var icon = 'bx bxs-file-doc';
              } else if (data[i].AttachmentFile.split('.').pop() == 'jpg' || data[i].AttachmentFile.split('.').pop() == 'jpeg') {
                var icon = 'bx bxs-file-jpg';
              } else {
                var icon = 'bx bxs-file-'+data[i].AttachmentFile.split('.').pop();
              }

              html += '<tr>'+
                          '<td style="width: 45px;">'+
                              '<div class="avatar-sm">'+
                                  '<span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">'+
                                      '<i class="'+icon+'"></i>'+
                                  '</span>'+
                              '</div>'+
                          '</td>'+
                          '<td>'+
                              '<h5 class="font-size-14 mb-1">'+data[i].AttachmentName+'.'+data[i].AttachmentFile.split('.').pop()+'</h5>'+
                              '<small><i class="mdi mdi-clock-outline"></i> '+moment(data[i].AttachmentLog).fromNow()+'</small>'+
                          '</td>'+
                          '<td>'+
                              '<div class="text-center">'+
                                  '<a href="'+baseURL+'download/incoming_mail/'+data[i].AttachmentFile+'" target="_blank" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>'+
                              '</div>'+
                          '</td>'+
                      '</tr>';
          }
          $('.show-attachment').html(html);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}
