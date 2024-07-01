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
    var method_type, valId, ef, url, formData, message;

    get_dataworkunit();

    $(".submit-add").on("click", function () {
      method_add();
    });

    $('[name="input-WorkunitCode"]').on("blur", function () {
      check_duplicateid();
    });

    $(".submit-form").on("click", function () {
      method_action();
    });

    $("#modal_form").on("hidden.bs.modal", function () {
      ef = document.getElementById("form");
      ef.classList.remove("was-validated");
    });
});

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_add() {
  method_type = 'add';
  $('.modal-title').text('Tambah Satuan Kerja');
  $('#form')[0].reset();
  document.getElementById('info-message').style.display = 'block';
  document.getElementById('error-id-message').style.display = 'none';
  $('.submit-form').prop("disabled", false);
  $('.submit-form').html('Tambah');
  $('#modal_form').modal('show');
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= VIEW INDEKS

function get_dataworkunit(){
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
          url: baseURL+'workunit/get_dataworkunit/get',
          type: "POST",
     },
     "columnDefs":[{
              "targets": [0,3,4], // Column yg ga bisa di klik
             "orderable": false,
          },
     ],
     lengthMenu: [
      [ 10, 25, 50, 100, -1 ],
      [ '10', '25', '50', '100', 'Show all' ]
      ],
  });
  var tp = document.getElementById("tableon_paginate");
  tp.classList.add("pagination-rounded");
}

// ================================================================================= CHECK DUPLICATE ID

function check_duplicateid() {
  valId = $('[name="input-WorkunitCode"]').val();

  if (method_type == 'add' && valId) {
    $.ajax({
        url: baseURL+"workunit/check_duplicateid/"+valId,
        type: "GET",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          if (data > 0) {
            $('.submit-form').prop("disabled", true);
            document.getElementById('error-id-message').style.display = 'block';
          } else {
            $('.submit-form').prop("disabled", false);
            document.getElementById('error-id-message').style.display = 'none';
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          return;
        }
    });
  } else {

  }
}

// ================================================================================= ACTION METHOD

function method_action() {
  ef = document.getElementById("form");
  formData = new FormData($('#form')[0]);

  if(method_type == 'add') {
      url = baseURL+'workunit/add_workunit';
      message = 'Berhasil menambahkan Satuan Kerja tersebut';
  }

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-form').prop("disabled", true);
    $('.submit-form').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Adding...`);
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
          get_dataworkunit();
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

// ================================================================================= DELETE INDEKS

function method_delete(id) {
  Swal.fire({
      title: "Hapus Klasifikasi tersebut?",
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
              url: baseURL+'workunit/delete_workunit/'+id,
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                get_dataworkunit();
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus Klasifikasi tersebut");
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
