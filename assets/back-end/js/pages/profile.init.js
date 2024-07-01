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

    get_userdata();
    get_logincounter();

    $("#modal_form").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form");
      ef.classList.remove("was-validated");
      $('[name="input-TanggalLahir"]').val('').datepicker('update');
    });

    $(".btn-profile").on("click", function () {
      method_edit();
    });

    $(".btn-cpassword").on("click", function () {
      method_cpassword();
    });

    $(".change-cover").on("click", function () {
      $('#img-input-cover').trigger('click');
    });

    $(".remove-cover").on("click", function () {
      remove_imgcover();
    });

    $(".change-profile").on("click", function () {
      $('#img-input-profile').trigger('click');
    });

    $(".remove-profile").on("click", function () {
      remove_imgprofile();
    });

    $(".delete-loginhistory").on("click", function () {
      delete_loginhistory();
    });

    $(".submit-profile").on("click", function () {
      method_action();
    });

    $(".submit-cpassword").on("click", function () {
      method_caction();
    });

    $('[name="input-Password"]').on("input", function () {
      document.getElementById("error-cpassword-message").style.display = "none";
    });

    $('[name="input-RePassword"]').on("input", function () {
      document.getElementById("error-cpassword-message").style.display = "none";
    });

});

// <!-- ====================================================================================== PAGE SETTING ===================================================================================== -->

function format(inputDate) {
  var date = new Date(inputDate);
  if (!isNaN(date.getTime())) {
    return ("0" + (date.getMonth() + 1)).slice(-2) + '/' + date.getDate() + '/' + date.getFullYear();
  }
}

// ====================================================================================== MODAL SETTING ===================================================================================== -->

function method_edit() {
  method_type = 'edit';
  $('.modal-title').text('Ubah Informasi Anda');
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.submit-profile').prop("disabled", false);
  $('.submit-profile').html('Simpan');

  $.ajax({
      url: baseURL+"profile/get_userdata/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (!data.AccountCover) {
          $('.edit-img-cover').attr('src', baseURL+'uploads/account/default/piccover.jpg');
        } else {
          $('.edit-img-cover').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountCover);
        }

        if (!data.AccountProfile) {
          $('.edit-img-profile').attr('src', baseURL+'uploads/account/default/picprofile.jpg');
        } else {
          $('.edit-img-profile').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountProfile);
        }

        $('[name="input-FullName"]').val(data.FullName);
        $('[name="input-Email"]').val(data.Email);
        $('[name="input-Alamat"]').val(data.Address);
        $('[name="input-Kelurahan"]').val(data.Village);
        $('[name="input-Kecamatan"]').val(data.SubDistrict);
        $('[name="input-Kota"]').val(data.District);
        $('[name="input-Provinsi"]').val(data.State);
        $('[name="input-KodePOS"]').val(data.ZIPCode);
        $('[name="input-TempatLahir"]').val(data.POB);
        $('[name="input-TanggalLahir"]').val(format(data.DOB)).datepicker('update');
        $('[name="input-JenisKelamin"]').val(data.Gender);
        $('[name="input-Agama"]').val(data.Religion);
        $('[name="input-Telepon"]').val(data.Phone);
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

function method_cpassword() {
  var ef = document.getElementById("form-cpassword");
  ef.classList.remove("was-validated");
  $('#form-cpassword')[0].reset();
  document.getElementById("error-cpassword-message").style.display = "none";
  $('#modal_form_cpassword').modal('show');
  $('.submit-cpassword').prop("disabled", false);
  $('.submit-cpassword').html('Simpan');
}

// ====================================================================================== AJAX SERVERSIDE =======================================================================================

function get_userdata() {
  $.ajax({
      url: baseURL+'profile/get_userdata/get',
      type: "GET",
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data) {
        if (!data.AccountCover) {
          $('.img-cover').attr('src', baseURL+'uploads/account/default/piccover.jpg');
        } else {
          $('.img-cover').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountCover);
        }

        if (!data.AccountProfile) {
          $('.img-profile').attr('src', baseURL+'uploads/account/default/picprofile.jpg');
        } else {
          $('.img-profile').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountProfile);
        }

        // GET FullName
        $('[name="user-header-FullName"]').html(data.FullName);
        $('[name="user-personal-FullName"]').html(data.FullName);

        // GET Badge
        $('[name="user-header-Badge"]').html('<span class="badge badge-pill badge-soft-'+data.RoleColor+' font-size-12">'+data.WorkunitName+'</span>');

        // GET Email
        if (!data.Email) {
          $('[name="user-personal-Email"]').html('-');
          $('[name="user-data-Email"]').html(': -');
        } else {
          $('[name="user-personal-Email"]').html(data.Email);
          $('[name="user-data-Email"]').html(': '+data.Email);
        }

        if (!data.Gender) {
          $('[name="user-data-Gender"]').html(': -');
        } else {
          $('[name="user-data-Gender"]').html(': '+data.Gender);
        }

        if (!data.Religion) {
          $('[name="user-data-Religion"]').html(': -');
        } else {
          $('[name="user-data-Religion"]').html(': '+data.Religion);
        }

        // GET Phone
        if (!data.Phone) {
          $('[name="user-data-Phone"]').html(': -');
        } else {
          $('[name="user-data-Phone"]').html(': '+data.Phone);
        }

        // GET Address
        var currentaddress = data.Address;
        var village = data.Village;
        var subdistrict = data.SubDistrict;
        var district = data.District;
        var state = data.State;
        var zipcode = data.ZIPCode;
        var address = currentaddress + ", Kel. " + village + ", Kec. " + subdistrict + ", " + district + ", " + state + " - " + zipcode;
        if (!data.Address) {
          $('[name="user-data-Address"]').html(': -');
        } else {
          $('[name="user-data-Address"]').html(': '+address);
        }

        // GET POB & DOB
        var pob = data.POB;
        const dob = new Date(data.DOB);
        const dtf = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit' });
        const [{ value: da },,{ value: mo },,{ value: ye }] = dtf.formatToParts(dob);
        var birthday = pob + ", " + `${da} ${mo} ${ye}`;
        if (!data.POB) {
          $('[name="user-data-Birthday"]').html(': -');
        } else {
          $('[name="user-data-Birthday"]').html(': '+birthday);
        }

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

// ================================================================================= ACTION METHOD

function method_action() {
  var ef = document.getElementById("form");
  var url;
  var formData = new FormData($('#form')[0]);

  if(method_type == 'edit') {
    url = baseURL+'profile/edit_user/edit';
  }

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-profile').prop("disabled", true);
    $('.submit-profile').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Editing...`);
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
          get_userdata();
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil merubah informasi pribadi Anda");
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

// ================================================================================= UPLOAD IMAGE COVER

function upload_imgcover() {
  var file = event.target.files[0];
  var img = new Image();
  if(file.size>=2*1024*1024) {
    $("#form-img-cover").get(0).reset();
    new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
    var notifier = new Notifier();
    var notification = notifier.notify("warning", "<b>406 Not Acceptable</b> <br>Ukuran maksimal gambar adalah 2MB!");
    notification.push();
    return;
  } else if (!file.type.match('image/jp.*|image/png')) {
    $("#form-img-cover").get(0).reset();
    new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
    var notifier = new Notifier();
    var notification = notifier.notify("warning", "<b>406 Not Acceptable</b> <br>Format gambar yang diizinkan hanya JPG/JPEG/PNG");
    notification.push();
    return;
  } else {
    var fileReader = new FileReader();
    var formData = new FormData($('#form-img-cover')[0]);
    $.ajax({
        url: baseURL+'profile/change_imgcover/edit',
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
            $("#form-img-cover").get(0).reset();
            get_userdata();
            new Audio(baseURL+'uploads/app/audio/success.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil merubah Latar Belakang pada profil Anda");
            notification.push();
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
  fileReader.readAsArrayBuffer(file);
}

function remove_imgcover() {
  Swal.fire({
      title: "Hapus Latar Belakang?",
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
              url: baseURL+'profile/delete_imgcover/delete',
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                get_userdata();
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus Latar Belakang");
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

// ================================================================================= UPLOAD IMAGE PROFIL

function upload_imgprofile() {
  var file = event.target.files[0];
  var img = new Image();
  if(file.size>=2*1024*1024) {
    $("#form-img-profile").get(0).reset();
    new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
    var notifier = new Notifier();
    var notification = notifier.notify("warning", "<b>406 Not Acceptable</b> <br>Ukuran maksimal gambar adalah 2MB!");
    notification.push();
    return;
  } else if (!file.type.match('image/jp.*|image/png')) {
    $("#form-img-profile").get(0).reset();
    new Audio(baseURL+'uploads/app/audio/warning.mp3').play();
    var notifier = new Notifier();
    var notification = notifier.notify("warning", "<b>406 Not Acceptable</b> <br>Format gambar yang diizinkan hanya JPG/JPEG/PNG");
    notification.push();
    return;
  } else {
    var fileReader = new FileReader();
    var formData = new FormData($('#form-img-profile')[0]);
    $.ajax({
        url: baseURL+'profile/change_imgprofile/edit',
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
            $("#form-img-profile").get(0).reset();
            get_userdata();
            new Audio(baseURL+'uploads/app/audio/success.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil merubah Gambar Profil sebagai personalisasi Anda");
            notification.push();
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
  fileReader.readAsArrayBuffer(file);
}

function remove_imgprofile() {
  Swal.fire({
      title: "Hapus Gambar Profil?",
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
              url: baseURL+'profile/delete_imgprofile/delete',
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                get_userdata();
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus Gambar Profil pada akun Anda");
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

// ================================================================================= LOGIN COUNTER

function get_logincounter(){
  $.ajax({
      url: baseURL+'profile/get_counter/get',
      type: "GET",
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.show-counter').html('');
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          const logdate = new Date(data[i].CounterLog);
          const dtf = new Intl.DateTimeFormat('id', { year: 'numeric', month: 'long', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true, weekday: 'long'});
          const [{ value: we },,{ value: da },,{ value: mo },,{ value: ye },,{ value: ho },,{ value: mi },,{ value: h12 }] = dtf.formatToParts(logdate);

          html += '<li class="event-list">'+
                      '<div class="event-timeline-dot">'+
                          '<i class="bx bx-right-arrow-circle font-size-18"></i>'+
                      '</div>'+
                      '<div class="media">'+
                          '<div class="media-body">'+
                            '<p class="text-muted text-justify mb-2"><strong>Anda</strong> telah masuk kedalam aplikasi menggunakan <strong><i>'+data[i].CounterBrowser+'</i></strong> pada perangkat <strong>'+data[i].CounterOS+'</strong>.</p>'+
                            '<div class="float-right"><p class="mb-0"><i class="mdi mdi-clock-outline"></i> <small>'+moment(data[i].CounterLog).fromNow()+'</small></p></div>'+
                          '</div>'+
                      '</div>'+
                  '</li>';
        }
        $('.show-counter').html(html);
      },
  });
}

function delete_loginhistory() {
  Swal.fire({
      title: "Hapus riwayat login selama ini?",
      text: "Anda tidak akan dapat mengembalikan ini!",
      type: "warning",
      showCancelButton: !0,
      confirmButtonText: "Ya, hapus semua!",
      cancelButtonText: "Tidak, batalkan!",
      confirmButtonClass: "btn btn-success mt-2",
      cancelButtonClass: "btn btn-danger ml-2 mt-2",
      buttonsStyling: !1
  }).then((result) => {
      if(result.value) {
          $.ajax({
              url: baseURL+'profile/delete_loginhistory/delete',
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                get_logincounter();
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus semua riwayat login");
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

// ================================================================================= PASSWORD CHANGE

function method_caction() {
  var ef = document.getElementById("form-cpassword");
  var formData = new FormData($('#form-cpassword')[0]);

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else if ($('[name="input-Password"]').val() != $('[name="input-RePassword"]').val()) {
    document.getElementById("error-cpassword-message").style.display = "block";
  } else {
    ef.classList.remove("was-validated");
    document.getElementById("error-cpassword-message").style.display = "none";
    $('.submit-cpassword').prop("disabled", true);
    $('.submit-cpassword').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Updating...`);
    $.ajax({
        url: baseURL+'profile/password_change/edit',
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          $('#modal_form_cpassword').modal('hide');
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil merubah kata sandi Akun Anda");
          notification.push();
          return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form_cpassword').modal('hide');
          new Audio(baseURL+'uploads/app/audio/error.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
          notification.push();
          return;
        }
    });
  }
}
