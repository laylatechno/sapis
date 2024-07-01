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

    get_viewoutmail(id);
    get_viewoutmailattachment(id);

    $('[name="input-AttachmentName"]').on("blur", function () {
      check_duplicatename(id);
    });

    $(".submit-attachment").on("click", function () {
      method_actionattachment(id);
    });

    $("#modal_form_attachment").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form-attachment");
      ef.classList.remove("was-validated");
      $('.dropify-clear').click();
    });

    $(".dropify").dropify({
      messages: {
        default: "Drag and drop a file here or click",
        replace: "Drag and drop or click to replace",
        remove: "Remove",
        error: "Ooops, something wrong appended."
      },
      error: {
        fileSize: "The file size is too big (5M max)."
      }
    });

});

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_addattachment() {
  method_type = 'add_attachment';
  $('.modal-title-attachment').text('Unggah Lampiran Surat');
  $('#form-attachment')[0].reset();
  document.getElementById('error-filename-message').style.display = 'none';
  $('#modal_form_attachment').modal('show');
  $('.submit-attachment').prop("disabled", false);
  $('.submit-attachment').html('Unggah');
}

// ====================================================================================== AJAX SERVERSIDE =====================================================================================

// ================================================================================= ACTION METHOD

function method_actionattachment(id) {
  var ef = document.getElementById("form-attachment");
  var url;
  var formData = new FormData($('#form-attachment')[0]);
  url = baseURL+'outgoing_mail/add_outmailattachment//'+id;

  if (ef.checkValidity() === false) {
      ef.classList.add("was-validated");
  } else {
      ef.classList.remove("was-validated");
      $('.submit-attachment').prop("disabled", true);
      $('.submit-attachment').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Uploading...`);
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
            $('#modal_form_attachment').modal('hide');
            get_viewoutmailattachment(id);
            new Audio(baseURL+'uploads/app/audio/success.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil mengunggah lampiran pada surat keluar tersebut");
            notification.push();
            return;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            $('#modal_form_attachment').modal('hide');
            new Audio(baseURL+'uploads/app/audio/error.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
            notification.push();
            return;
          }
      });
  }
}

// ================================================================================= VIEW INBOX

function get_viewoutmail(id) {
  $.ajax({
      url: baseURL+"outgoing_mail/get_viewoutmail/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        var valTrait = data.OutMailTrait;
        var trait;
        if(valTrait == "Rahasia"){
            trait = '<span class="badge badge-pill badge-soft-primary font-size-12 ml-2">'+valTrait+'</span>';
        } else if(valTrait == "Penting"){
            trait = '<span class="badge badge-pill badge-soft-danger font-size-12 ml-2">'+valTrait+'</span>';
        } else {
            trait = '<span class="badge badge-pill badge-soft-secondary font-size-12 ml-2">'+valTrait+'</span>';
        }

        $('[name="view-OutMailTrait"]').html(trait);
        $('[name="view-OutMailDestination"]').html(data.OutMailDestination);
        $('[name="view-OutMailNumber"]').html('No Surat: '+data.OutMailNumber+' - <strong>'+data.IndeksName+'</strong>');

        if (data.OutMailContent) {
          $('[name="view-OutMailContent"]').html(data.OutMailContent);
        } else {
          $('[name="view-OutMailContent"]').html('<i>Tidak ada deskripsi</i>');
        }

        const dtd = new Date(data.OutMailDate);
        const dtfd = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit', weekday: 'long' });
        const [{ value: wed },,{ value: dad },,{ value: mod },,{ value: yed }] = dtfd.formatToParts(dtd);
        $('[name="view-OutMailDate"]').html(`${wed}`+', '+`${dad} ${mod} ${yed}`);

        $('[name="view-WorkunitName"]').html(data.WorkunitName);

        get_viewoutmailregister(id);
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

function get_viewoutmailregister(id) {
  $.ajax({
      url: baseURL+"outgoing_mail/get_viewoutmailregister/"+id,
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
        $('[name="view-register-FullName"]').html(data.FullName);
        $('[name="view-register-WorkunitName"]').html('<span class="badge badge-pill badge-soft-'+data.RoleColor+' font-size-12">'+data.WorkunitName+'</span>');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= VIEW ATTACHMENT

function check_duplicatename(id) {
  var name = $('[name="input-AttachmentName"]').val();
  if (method_type == 'add_attachment' && name) {
    $.ajax({
        url: baseURL+"outgoing_mail/check_duplicatename/"+id,
        type: "GET",
        data:"name=" + name,
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          if (data > 0) {
            $('.submit-attachment').prop("disabled", true);
            document.getElementById('error-filename-message').style.display = 'block';
          } else {
            $('.submit-attachment').prop("disabled", false);
            document.getElementById('error-filename-message').style.display = 'none';
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          return;
        }
    });
  } else {

  }
}

function get_viewoutmailattachment(id) {
  $.ajax({
      url: baseURL+"outgoing_mail/get_viewoutmailattachment/"+id,
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
                          '<td>'+
                            '<button type="button" class="close" aria-label="Close" onclick="delete_outmailattachment('+data[i].AttachmentID+')">'+
                                '<span aria-hidden="true">&times;</span>'+
                            '</button>'+
                          '</td>'+
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
                                  '<a href="'+baseURL+'download/outgoing_mail/'+data[i].AttachmentFile+'" target="_blank" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>'+
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

function delete_outmailattachment(idatt) {
  Swal.fire({
      title: "Hapus Lampiran yang dipilih?",
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
              url: baseURL+'outgoing_mail/delete_outmailattachment/'+idatt,
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                get_viewoutmailattachment(id);
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil menghapus Lampiran pada Surat tersebut");
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
