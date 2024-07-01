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
    var method_type, valId, ef, url, formData, message, html;

    get_datainmail();

    $(".submit-add").on("click", function () {
      method_add();
    });

    $("#modal_form").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form");
      ef.classList.remove("was-validated");
      $('[name="input-IndeksID"]').val('').selectpicker('refresh');
      $('[name="input-WorkunitID"]').val('').selectpicker('refresh');
      $('[name="input-InMailDate"]').val('').datepicker('update');
    });
});

// <!-- ====================================================================================== PAGE SETTING ===================================================================================== -->

function format(inputDate) {
  var date = new Date(inputDate);
  if (!isNaN(date.getTime())) {
    return ("0" + (date.getMonth() + 1)).slice(-2) + '/' + date.getDate() + '/' + date.getFullYear();
  }
}

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_add() {
  method_type = 'add';
  $('.modal-title').text('Registrasi Surat Masuk');
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.submit-button').prop("disabled", false);
  $('.submit-button').html('Tambah');
}

function method_edit(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmail/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data.InMailTrait == 'Rahasia' && data.Username != userid) {
          new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
          Swal.fire({
              title: "Akses ditolak!",
              text: "Aksi tersebut hanya dapat dilakukan oleh Operator/Administrator yang mendaftarkan karena bersifat Rahasia",
              type: "warning"
          });
        } else {
          method_type = 'edit';
          valId = id;
          $('#form')[0].reset();
          $('#modal_form').modal('show');
          $('.submit-button').prop("disabled", false);
          $('.submit-button').html('Simpan');

          $.ajax({
              url: baseURL+"mail_detail/get_viewinmail/"+valId,
              type: "GET",
              contentType: false,
              processData:false,
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                $('.modal-title').text('Ubah Informasi Surat dari '+data.InMailOrigin);
                $('[name="input-InMailID"]').val(data.InMailID);
                $('[name="input-InMailNumber"]').val(data.InMailNumber);
                $('[name="input-IndeksID"]').val(data.IndeksID).selectpicker('refresh');
                $('[name="input-InMailTrait"]').val(data.InMailTrait).selectpicker('refresh');
                $('[name="input-InMailOrigin"]').val(data.InMailOrigin);
                $('[name="input-WorkunitID"]').val(data.WorkunitID).selectpicker('refresh');
                $('[name="input-InMailDate"]').val(format(data.InMailDate)).datepicker('update');
                document.getElementById("input-InMailContent").value = data.InMailContent;
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
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });

}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= VIEW MAIN

function get_datainmail(){
  var dataTable = $('#tableon').DataTable({
  initComplete: function() {
    var api = this.api();
    $('#tableon_filter input')
      .off('.DT')
      .on('keyup.DT', function(e) {
                    api.search(this.value).draw();
                });
    },
    oLanguage: {
              sProcessing: "Loading...",
              sSearch: "Cari:",
    },
     "destroy": true,
     "processing": true,
     "serverSide": true,
     "order":[],
     "ajax":{
          url: baseURL+'incoming_mail/get_datainmail/get',
          type: "POST",
     },
     "columnDefs":[{
              "targets": [4,5,6,7], // Column yg ga bisa di klik
             "orderable": false,
          },
     ],
     lengthMenu: [
      [ 10, 25, 50, 100, -1 ],
      [ '10', '25', '50', '100', 'Show all' ]
      ],
  });
  var ef = document.getElementById("tableon_paginate");
  ef.classList.add("pagination-rounded");
}

// ================================================================================= ACTION METHOD

function action_method() {
  ef = document.getElementById("form");
  formData = new FormData($('#form')[0]);

  if(method_type == 'add') {
      url = baseURL+'incoming_mail/add_inmail';
      message = 'Berhasil mendaftarkan Surat Masuk tersebut';
      var html = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Adding...';
  } else {
      url = baseURL+'incoming_mail/edit_inmail/'+valId;
      message = 'Berhasil merubah informasi Surat Masuk tersebut';
      var html = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Saving...';
  }

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-button').prop("disabled", true);
    $('.submit-button').html(html);
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
          $('#modal_form').modal('hide');
          get_datainmail();
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>"+message);
          notification.push();
          return;
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

// ================================================================================= FORWARDED MAIL

function method_forwarded(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmail/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data.InMailTrait == 'Rahasia' && data.Username != userid) {
          new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
          Swal.fire({
              title: "Akses ditolak!",
              text: "Aksi tersebut hanya dapat dilakukan oleh Operator/Administrator yang mendaftarkan karena bersifat Rahasia",
              type: "warning"
          });
        } else {
          Swal.fire({
              title: "Teruskan Surat ini ke Pimpinan?",
              text: "Teruskan surat ini agar Pimpinan dapat menindaklanjuti surat tersebut!",
              type: "warning",
              showCancelButton: !0,
              confirmButtonText: "Ya, teruskan!",
              cancelButtonText: "Tidak, batalkan!",
              confirmButtonClass: "btn btn-success mt-2",
              cancelButtonClass: "btn btn-danger ml-2 mt-2",
              buttonsStyling: !1
          }).then((result) => {
              if(result.value) {
                  $.ajax({
                      url: baseURL+'incoming_mail/forwarded_inmail/'+id,
                      type: "POST",
                      cache: false,
                      async: true,
                      dataType: "JSON",
                      success: function(data){
                        if (data.Message == 'yes') {
                          new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
                          Swal.fire({
                              title: "Surat tersebut sudah pernah diteruskan!",
                              text: "Aksi tersebut tidak dapat dilakukan",
                              type: "warning"
                          });
                        } else {
                          get_datainmail();
                          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                          var notifier = new Notifier();
                          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Surat tersebut sudah diteruskan ke Pimpinan");
                          notification.push();
                          return;
                        }
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

      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= DELETE MAIL

function method_delete(id) {
  $.ajax({
      url: baseURL+"mail_detail/get_viewinmail/"+id,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){

        if (data.InMailTrait == 'Rahasia' && data.Username != userid) {
          new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
          Swal.fire({
              title: "Akses ditolak!",
              text: "Aksi tersebut hanya dapat dilakukan oleh Operator/Administrator yang mendaftarkan karena bersifat Rahasia",
              type: "warning"
          });
        } else {
          Swal.fire({
              title: "Hapus Surat Masuk tersebut?",
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
                      url: baseURL+'incoming_mail/delete_inmail/'+id,
                      type: "POST",
                      cache: false,
                      async: true,
                      dataType: "JSON",
                      success: function(data){
                        get_datainmail();
                        new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                        var notifier = new Notifier();
                        var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus Indeks tersebut");
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

      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });

}
