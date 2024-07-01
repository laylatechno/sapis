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
    var method_type, valId, ef, url, formData, message, html, rolecolor;

    get_dataaccess();
    get_datacounter();

    get_userlist(0);
    show_loadmore();

    if (!id) {

    } else {
      method_grantaccess(id);
    }

    $(".submit-form-eaccess").on("click", function () {
      method_action_eaccess();
    });

    $("#modal_form_eaccess").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form-eaccess");
      ef.classList.remove("was-validated");
      $('[name="input-RoleColor"]').val('primary');
    });

    $(".submit-add-user").on("click", function () {
      method_add_user();
    });

    $('[name="input-Username"]').on("blur", function () {
      check_duplicateid();
    });

    $(".submit-form-user").on("click", function () {
      method_action_user();
    });

    $("#modal_form_user").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form-user");
      ef.classList.remove("was-validated");
      $('[name="input-WorkunitID"]').val('').selectpicker('refresh');
    });

});


// <!-- ====================================================================================== PAGE SETTING ===================================================================================== -->

function get_datacounter(){
  $.ajax({
      url: baseURL+'users/get_datacounter/get',
      type: "GET",
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('[name="view-TotalUser"]').html(data.TotalUser);
        $('[name="view-TotalRole"]').html(data.TotalRole);
        $('[name="view-TotalClassification"]').html(data.TotalClassification);
      },
  });
}

function show_loadmore() {
  $("#load_more").click(function(e){
      e.preventDefault();
      var page = $(this).data('val');
      get_userlist(page);
  });
}

// <!-- ====================================================================================== MODAL SETTING ===================================================================================== -->

function change_color() {
  ef = document.getElementById('input-RoleIcon');
  valId = $('[name="input-RoleColor"]').val();
  ef.classList.remove('bg-soft-'+rolecolor);
  ef.classList.remove('text-'+rolecolor)
  ef.classList.add('bg-soft-'+valId);
  ef.classList.add('text-'+valId)
  rolecolor = valId;
}

function method_grantaccess(id) {
  if (!roleid) {

  } else {
    method_type = 'edit-gaccess';
    $('#modal_form_gaccess').modal('show');

    $.ajax({
        url: baseURL+"users/get_viewaccess/"+id,
        type: "GET",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          $('.modal-title-gaccess').html('Kelola Hak Akses pada '+data.RoleName);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form_gaccess').modal('hide');
          return;
        }
    });
  }
}

// ======================================================================================== BREAK

function method_add_user() {
  method_type = 'add';
  $('#img-profile').attr('src', '');
  $('.modal-title-user').text('Tambah Pengguna Baru');
  $('#form-user')[0].reset();
  $('#modal_form_user').modal('show');
  document.getElementById('group-account').style.display = 'block';
  document.getElementById('error-id-message').style.display = 'none';
  $('.submit-form-user').prop("disabled", false);
  $('.submit-form-user').html('Tambah');
}

function method_edit_user(username) {
  method_type = 'edit';
  valId = username;
  $('#img-profile').attr('src', '');
  $('.modal-title-user').text('Ubah Informasi Pengguna');
  $('#form-user')[0].reset();
  $('#modal_form_user').modal('show');
  document.getElementById('group-account').style.display = 'none';
  document.getElementById('error-id-message').style.display = 'none';
  $('.submit-form-user').prop("disabled", false);
  $('.submit-form-user').html('Simpan');

  $.ajax({
      url: baseURL+"users/get_viewuser/"+username,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        if (data.AccountProfile) {
          $('#img-profile').attr('src', baseURL+'uploads/account/'+data.Username+'/'+data.AccountProfile);
        }

        $('[name="input-Username"]').val(data.Username);
        $('[name="input-FullName"]').val(data.FullName);
        $('[name="input-Email"]').val(data.Email);
        $('[name="input-WorkunitID"]').val(data.WorkunitID).selectpicker('refresh');
        $('[name="input-user-RoleID"]').val(data.RoleID);
        $('[name="input-ActiveStatus"]').val(data.AccountStatus);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('#modal_form_user').modal('hide');
        new Audio(baseURL+'uploads/app/audio/error.mp3').play();
        var notifier = new Notifier();
        var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
        notification.push();
        return;
      }
  });

}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= ACCESS

function get_dataaccess() {
  $.ajax({
      url : baseURL+'users/get_dataaccess/get',
      type:'GET',
  }).done(function(response){
      $("#show-access").html('');
      $("#show-access").append(response);
  });
}

function method_editaccess(id) {
  valId = id;
  $('#form-eaccess')[0].reset();
  $('.submit-form-eaccess').prop("disabled", false);
  $('.submit-form-eaccess').html('Simpan');
  $('#modal_form_eaccess').modal('show');

  $.ajax({
      url: baseURL+"users/get_viewaccess/"+valId,
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        ef = document.getElementById('input-RoleIcon');
        ef.classList.add('bg-soft-'+data.RoleColor);
        ef.classList.add('text-'+data.RoleColor)
        rolecolor = data.RoleColor;

        $('.modal-title-eaccess').text('Ubah Informasi Hak Akses');
        $('[name="input-RoleID"]').val(data.RoleID);
        $('[name="input-RoleName"]').val(data.RoleName);
        $('[name="input-RoleColor"]').val(data.RoleColor);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $('#modal_form_eaccess').modal('hide');
        new Audio(baseURL+'uploads/app/audio/error.mp3').play();
        var notifier = new Notifier();
        var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
        notification.push();
        return;
      }
  });

}

function method_action_eaccess() {
  ef = document.getElementById("form-eaccess");
  formData = new FormData($('#form-eaccess')[0]);

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-form-eaccess').prop("disabled", true);
    $('.submit-form-eaccess').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Saving...`);
    $.ajax({
        url: baseURL+'users/edit_access/'+valId,
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          $('#modal_form_eaccess').modal('hide');
          get_dataaccess();
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil merubah informasi Hak Akses terebut");
          notification.push();
          return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form_eaccess').modal('hide');
          new Audio(baseURL+'uploads/app/audio/error.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
          notification.push();
          return;
        }
    });
  }
}

function grant_access(menuid) {
  $.ajax({
      url: baseURL+'users/grant_access',
      data:"menuid=" + menuid + "&roleid=" + id,
      success: function(data) {
        new Audio(baseURL+'uploads/app/audio/success.mp3').play();
        return;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        new Audio(baseURL+'uploads/app/audio/error.mp3').play();
        return;
      }
  });
}

// ======================================================================================================= USERS =========================================================================

// ================================================================================= CHECK DUPLICATE ID

function check_duplicateid() {
  valId = $('[name="input-Username"]').val();

  if (method_type == 'add' && valId) {
    $.ajax({
        url: baseURL+"users/check_duplicateid/"+valId,
        type: "GET",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          if (data > 0 || valId == 'default') {
            $('.submit-form-user').prop("disabled", true);
            document.getElementById('error-id-message').style.display = 'block';
          } else {
            $('.submit-form-user').prop("disabled", false);
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

function method_action_user() {
  ef = document.getElementById("form-user");
  formData = new FormData($('#form-user')[0]);

  if(method_type == 'add') {
      url = baseURL+'users/add_user';
      message = 'Berhasil menambahkan Pengguna tersebut';
      html = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Adding...';
  } else {
      url = baseURL+'users/edit_user/'+valId;
      message = 'Berhasil mengubah informasi Pengguna tersebut';
      html = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Saving...';
  }

  if (ef.checkValidity() === false) {
    ef.classList.add("was-validated");
  } else {
    ef.classList.remove("was-validated");
    $('.submit-form-user').prop("disabled", true);
    $('.submit-form-user').html(html);
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
          $('#modal_form_user').modal('hide');
          $('#show_userlist').html('');
          get_datacounter();
          get_userlist(0);
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>"+message);
          notification.push();
          return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form_user').modal('hide');
          new Audio(baseURL+'uploads/app/audio/error.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("error", "<b>500 Internal Server Error</b> <br>Terjadi kesalahan pada server/method");
          notification.push();
          return;
        }
     });
   }
}

function method_delete_user(username) {
  Swal.fire({
      title: "Hapus Pengguna yang dipilih?",
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
              url: baseURL+'users/delete_user/'+username,
              type: "POST",
              cache: false,
              async: true,
              dataType: "JSON",
              success: function(data){
                $('#show_userlist').html('');
                get_datacounter();
                get_userlist(0);
                new Audio(baseURL+'uploads/app/audio/success.mp3').play();
                var notifier = new Notifier();
                var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>Berhasil menghapus Pengguna tersebut");
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
