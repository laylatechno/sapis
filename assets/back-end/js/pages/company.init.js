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

    get_viewcompany();
    get_viewapp();

    $("#modal_form_logo").on("hidden.bs.modal", function () {
      var ef = document.getElementById("form-logo");
      ef.classList.remove("was-validated");
      var drEvent = $('#file-input-Logo').dropify();
      drEvent = drEvent.data('dropify');
      if (drEvent) {
        drEvent.resetPreview();
        drEvent.clearElement();
      }
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

function method_edit() {
  method_type = 'edit';
  $('.modal-title').text('Ubah Informasi Instansi / Badan Usaha');
  $('#form')[0].reset();
  $('#modal_form').modal('show');
  $('.submit-button').prop("disabled", false);
  $('.submit-button').html('Simpan');
  get_viewcompany();
}

function method_logo(type) {
  if (type == 'smsqw') {
    method_type = 'edit-logo-small-w';
    $('.modal-title-logo').text('Ganti Logo Kecil (Kotak - Putih)');
  } else if (type == 'smsqb') {
    method_type = 'edit-logo-small-b';
    $('.modal-title-logo').text('Ganti Logo Kecil (Kotak - Warna)');
  } else if (type == 'lgldw') {
    method_type = 'edit-logo-large-w';
    $('.modal-title-logo').text('Ganti Logo Besar (Landscape - Putih)');
  } else if (type == 'lgldb') {
    method_type = 'edit-logo-large-b';
    $('.modal-title-logo').text('Ganti Logo Besar (Landscape - Warna)');
  } else if (type == 'lghd') {
    method_type = 'edit-login-header';
    $('.modal-title-logo').text('Ganti Login Header');
  }

  $('#form-logo')[0].reset();
  $('#modal_form_logo').modal('show');
  $('.submit-uploads').prop("disabled", false);
  $('.submit-uploads').html('Unggah');
}

function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : event.keyCode;
 console.log(charCode);
  if (charCode != 46 && charCode != 45 && charCode > 31
  && (charCode < 48 || charCode > 57))
   return false;
return true;
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= ACTION METHOD

function action_method() {
  var ef = document.getElementById("form");
  var formData = new FormData($('#form')[0]);

  if (ef.checkValidity() === false) {
    ef.classList.add('was-validated');
  } else {
    ef.classList.remove('was-validated');
    $('.submit-button').prop("disabled", true);
    $('.submit-button').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Saving...`);
    $.ajax({
        url: baseURL+'company/edit_company',
        data: formData,
        type: "POST",
        contentType: false,
        processData:false,
        cache: false,
        async: true,
        dataType: "JSON",
        success: function(data){
          $('#modal_form').modal('hide');
          get_viewcompany();
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br> Berhasil merubah informasi Instansi / Badan Usaha");
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

function action_method_logo() {
  var ef = document.getElementById("form-logo");
  var url, message;
  var formData = new FormData($('#form-logo')[0]);
  message = 'Berhasil mengunggah Logo tersebut';

  if(method_type == 'edit-logo-small-w') {
      url = baseURL+'company/edit_logo/AppSmallLogoWhite';
  } else if(method_type == 'edit-logo-small-b') {
      url = baseURL+'company/edit_logo/AppSmallLogoBlack';
  } else if (method_type == 'edit-logo-large-w') {
      url = baseURL+'company/edit_logo/AppLargeLogoWhite';
  } else if (method_type == 'edit-logo-large-b') {
      url = baseURL+'company/edit_logo/AppLargeLogoBlack';
  } else if (method_type == 'edit-login-header') {
      url = baseURL+'company/edit_logo/AppLoginHeader';
  }

  if (ef.checkValidity() === false) {
    ef.classList.add('was-validated');
  } else {
    ef.classList.remove('was-validated')
    $('.submit-uploads').prop("disabled", true);
    $('.submit-uploads').html(`<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Uploading...`);
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
          $('#modal_form_logo').modal('hide');
          get_viewapp();
          new Audio(baseURL+'uploads/app/audio/success.mp3').play();
          var notifier = new Notifier();
          var notification = notifier.notify("success", "<b>201 Request Successfully Created</b> <br>"+message);
          notification.push();
          return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $('#modal_form_logo').modal('hide');
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
function get_viewcompany() {
  $.ajax({
      url: baseURL+"company/get_viewcompany/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('[name="view-CompanyName"]').html(data.CompanyName+' - <span class="badge badge-pill badge-soft-primary font-size-12">'+data.CompanyType+'</span>');
        $('[name="input-CompanyName"]').val(data.CompanyName);

        $('[name="view-CompanyEmail"]').html(data.CompanyEmail);
        $('[name="input-CompanyEmail"]').val(data.CompanyEmail);

        $('[name="input-CompanyType"]').val(data.CompanyType);
        $('[name="input-CompanyAddress"]').val(data.CompanyAddress);
        $('[name="input-CompanyVillage"]').val(data.CompanyVillage);
        $('[name="input-CompanySubDistrict"]').val(data.CompanySubDistrict);
        $('[name="input-CompanyDistrict"]').val(data.CompanyDistrict);
        $('[name="input-CompanyState"]').val(data.CompanyState);
        $('[name="input-CompanyZIPCode"]').val(data.CompanyZIPCode);
        $('[name="input-CompanyPhone"]').val(data.CompanyPhone);

        // GET Address
        var currentaddress = data.CompanyAddress;
        var village = data.CompanyVillage;
        var subdistrict = data.CompanySubDistrict;
        var district = data.CompanyDistrict;
        var state = data.CompanyState;
        var zipcode = data.CompanyZIPCode;
        var address = currentaddress + ", Kel. " + village + ", Kec. " + subdistrict + ", " + district + ", " + state + " - " + zipcode;
        if (!data.CompanyAddress) {
          $('[name="view-CompanyAddress"]').html('-');
        } else {
          $('[name="view-CompanyAddress"]').html(address);
        }

        // GET Phone
        if (!data.CompanyPhone) {
          $('[name="view-CompanyPhone"]').html('-');
        } else {
          $('[name="view-CompanyPhone"]').html(data.CompanyPhone);
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

// ================================================================================= VIEW INBOX
function get_viewapp() {
  $.ajax({
      url: baseURL+"company/get_viewapp/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('#AppSmallLogoWhite').attr('src', baseURL+'uploads/app/logo/'+data.AppSmallLogoWhite);
        $('#view-AppSmallLogoBlack').attr('src', baseURL+'uploads/app/logo/'+data.AppSmallLogoBlack);
        $('#AppSmallLogoBlack').attr('src', baseURL+'uploads/app/logo/'+data.AppSmallLogoBlack);
        $('#AppLargeLogoWhite').attr('src', baseURL+'uploads/app/logo/'+data.AppLargeLogoWhite);
        $('#AppLargeLogoBlack').attr('src', baseURL+'uploads/app/logo/'+data.AppLargeLogoBlack);
        $('#AppLoginHeader').attr('src', baseURL+'uploads/app/logo/'+data.AppLoginHeader);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}
