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
    var method_type, num_attach, num_coment;

    count_viewinmailattachment(id);
    count_viewinmailcommentar(id);

    get_viewinmail(id);
    get_viewinmaildisposition(id);
    get_viewinmailattachment(id);
    get_viewinmailcommentar(id);

    setInterval(function(){
        realtime_viewinmailattachment(id);
        realtime_viewinmailcommentar(id);
    }, 3000);

    $(".submit-button").on("click", function () {
      method_action(id);
    });

});

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_resetcomment() {
  var ef = document.getElementById("form");
  ef.classList.remove("was-validated");
  $('#form')[0].reset();
  $('[name="input-CommentarDesc"]').prop("disabled", false);
  $('.submit-button').prop("disabled", false);
  $('.submit-button').html('Kirim <i class="bx bx-send font-size-16 align-middle ml-2"></i>');
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

function view_detailuser(username) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewuser/"+username,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (!data.AccountCover) {
          $('.user-cover').attr('src', baseURL+'uploads/account/default/piccover.jpg');
        } else {
          $('.user-cover').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountCover);
        }

        if (!data.AccountProfile) {
          $('.user-profile').attr('src', baseURL+'uploads/account/default/picprofile.jpg');
        } else {
          $('.user-profile').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountProfile);
        }

        $('.user-fullname').html(data.FullName);
        $('.user-workunit').html('<span class="badge badge-pill badge-soft-'+data.RoleColor+' font-size-12">'+data.WorkunitName+'</span>');

        // GET POB & DOB
        var pob = data.POB;
        const dob = new Date(data.DOB);
        const dtf = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
        const [{ value: da },,{ value: mo },,{ value: ye }] = dtf.formatToParts(dob);
        if (!data.POB) {
          $('.user-birthday').html(': -');
        } else {
          $('.user-birthday').html(': '+pob+', '+ `${da} ${mo} ${ye}`);
        }

        // GET Address
        var currentaddress = data.Address;
        var village = data.Village;
        var subdistrict = data.SubDistrict;
        var district = data.District;
        var state = data.State;
        var zipcode = data.ZIPCode;
        if (!data.Address) {
          $('.user-address').html(': -');
        } else {
          $('.user-address').html(': '+currentaddress+", Kel. "+ village+", Kec. "+subdistrict+", "+ district+","+ state+" - "+zipcode);
        }

        if (!data.Gender) {
          $('.user-gender').html(': -');
        } else {
          $('.user-gender').html(': '+data.Gender);
        }

        if (!data.Religion) {
          $('.user-religion').html(': -');
        } else {
          $('.user-gender').html(': '+data.Religion);
        }

        if (!data.Email) {
          $('.user-email').html(': -');
        } else {
          $('.user-email').html(': <a href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to='+data.Email+'&amp;body=" target="_blank" class="text-danger"><strong>'+data.Email+'</strong></a>');
        }

        if (!data.Phone) {
          $('.user-phone').html(': -');
        } else {
          $('.user-phone').html(': '+data.Phone);
        }

        $('.modal-title-user').text('Informasi Pendisposisi');
        $('#modal_user').modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('#modal_user').modal('hide');
        new Audio(baseURL+'uploads/app/audio/error.mp3').play();
        var notifier = new Notifier();
        var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
        notification.push();
        return;
      }
  });
}


// ================================================================================= ACTION METHOD

function method_action(id) {
  var ef = document.getElementById("form");
  var url;
  var formData = new FormData($('#form')[0]);
  url = baseURL+'mail_detail/add_inmailcommentar/'+id;

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('[name="input-CommentarDesc"]').prop("disabled", true);
    $('.submit-button').prop("disabled", true);
    $('.submit-button').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Sending...`);
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
          return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          method_resetcomment();
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

// ================================================================================= VIEW DISPOSITION

function get_viewinmaildisposition(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_userdisposition/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        const dtdd = new Date(data.DispositionDeadline);
        const dtfdd = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit', weekday: 'long' });
        const [{ value: wedd },,{ value: dadd },,{ value: modd },,{ value: yedd }] = dtfdd.formatToParts(dtdd);

        const dtdl = new Date(data.DispositionLog);
        const dtfdl = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit', weekday: 'long', hour: '2-digit', minute: '2-digit', timeZoneName: 'short' });
        const [{ value: wedl },,{ value: dadl },,{ value: modl },,{ value: yedl },,{ value: hodl },,{ value: midl },,{ value: tzdl }] = dtfdl.formatToParts(dtdl);

        $('[name="view-DispositionDeadline"]').html(': '+`${wedd}`+', '+`${dadd} ${modd} ${yedd}`);

        if (data.DispositionNote) {
          $('[name="view-DispositionNote"]').html(': '+data.DispositionNote);
        } else {
          $('[name="view-DispositionNote"]').html(': <i>Tidak ada catatan</i>');
        }

        $('[name="view-DispositionUser"]').html('<a href="javascript:void(0)" onclick="view_detailuser(\''+data.Username+'\');">: <strong class="text-primary">'+data.FullName+'</strong></a>');
        $('[name="view-DispositionLog"]').html(`${wedl}`+', '+`${dadl} ${modl} ${yedl}`+' at '+`${hodl}`+':'+`${midl}`+' '+`${tzdl}`+' ('+moment(data.DispositionLog).fromNow()+')');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
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

// ================================================================================= VIEW COMMENTAR

function count_viewinmailcommentar(id){
  $.ajax({
      url: baseURL+"mail_detail/count_viewinmailcommentar/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        num_coment = data;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function realtime_viewinmailcommentar(id){
  $.ajax({
      url: baseURL+"mail_detail/count_viewinmailcommentar/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data == num_coment) {

        } else {
          new Audio(baseURL+'uploads/app/audio/comment.mp3').play();
          method_resetcomment();
          get_viewinmailcommentar(id);
          num_coment = data;
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function get_viewinmailcommentar(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmailcommentar/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.show-commentar').html('');
        var html = '';
        var i;
        var imgurl;
        for(i=0; i<data.length; i++){
          if (!data[i].AccountProfile) {
            imgurl = baseURL+'uploads/account/default/picprofile.jpg';
          } else {
            imgurl = baseURL+'uploads/account/'+data[i].Username+'/'+data[i].AccountProfile;
          }

            if (userid == data[i].Username) {
              html += '<li class="right">'+
                          '<div class="conversation-list">'+
                              '<div class="dropdown">'+
                                  '<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></a>'+
                                  '<div class="dropdown-menu">'+
                                      '<a class="dropdown-item" href="javascript:void(0);" onclick="delete_inmailcommentar('+data[i].CommentarID+')">Hapus</a>'+
                                  '</div>'+
                              '</div>'+
                              '<div class="ctext-wrap">'+
                                '<div class="media">'+
                                  '<div class="media-body">'+
                                    '<div class="conversation-name text-'+data[i].RoleColor+' mt-1 mb-0">'+data[i].FullName+'</div>'+
                                    '<p class="text-muted mb-0"><span class="badge badge-pill badge-soft-'+data[i].RoleColor+'">'+data[i].WorkunitName+'</span></p>'+
                                  '</div>'+
                                  '<div class="ml-2">'+
                                    '<img class="media-object rounded-circle avatar-sm" alt="" src="'+imgurl+'">'+
                                  '</div>'+
                                '</div>'+
                                  '<p class="mt-4">'+data[i].CommentarDesc+'</p>'+
                                  '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle mr-1"></i> '+moment(data[i].CommentarLog).fromNow()+'</p>'+
                              '</div>'+
                          '</div>'+
                      '</li>';
            } else {
              html += '<li>'+
                          '<div class="conversation-list">'+
                              '<div class="ctext-wrap">'+
                                '<div class="media">'+
                                  '<div class="mr-2">'+
                                    '<img class="media-object rounded-circle avatar-sm" alt="" src="'+imgurl+'">'+
                                  '</div>'+
                                  '<div class="media-body">'+
                                    '<div class="conversation-name mt-1 mb-0"><a href="javascript:void(0)" onclick="view_detailuser(\''+data[i].Username+'\');"><strong class="text-'+data[i].RoleColor+'">'+data[i].FullName+'</strong></a></div>'+
                                    '<p class="text-muted mb-0"><span class="badge badge-pill badge-soft-'+data[i].RoleColor+'">'+data[i].ClassificationName+'</span></p>'+
                                  '</div>'+
                                '</div>'+
                                  '<p class="mt-4">'+data[i].CommentarDesc+'</p>'+
                                  '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle mr-1"></i> '+moment(data[i].CommentarLog).fromNow()+'</p>'+
                              '</div>'+
                          '</div>'+
                      '</li>';
            }
        }
        $('.show-commentar').html(html);
        var container = document.querySelector('.list-unstyled .simplebar-content-wrapper'); container.scrollTo({ top: $('.show-commentar').height(), behavior: "smooth" });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function delete_inmailcommentar(idcom) {
  Swal.fire({
      title: "Hapus Komentar tersebut?",
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
              url: baseURL+'mail_detail/delete_inmailcommentar/'+idcom,
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
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
