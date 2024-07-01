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
  get_inboxnotif();
  get_disponotif();

  setInterval(function(){
      if (userid) {
        count_inboxnotif();
        get_listnotif();
        if (roleid >= 3) {
          count_disponotif();
          get_listdispo();
        }
      }
 	}, 3000);
});

// ================================================================================= REALTIME NOTIFICATION

function get_inboxnotif() {
  $.ajax({
      url: baseURL+"notification/count_inboxnotif/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        set_notif(data);
        countnotif = data;
        $('.notif-count').html(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function get_disponotif() {
  $.ajax({
      url: baseURL+"notification/count_disponotif/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        set_dispo(data);
        countdispo = data;
        $('.dispo-count').html(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= REALTIME NOTIFICATION

function count_inboxnotif() {
  $.ajax({
      url: baseURL+"notification/count_inboxnotif/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        var ef = document.getElementById("notif-icon");

        if (data > 0) {
          if (data == countnotif) {
            ef.classList.add("bx-tada");
            $('.notif-num').html(data);
            $('.notif-count').html(data);
            set_notif(data);
          } else if (data <= countnotif) {
            ef.classList.add("bx-tada");
            $('.notif-num').html(data);
            $('.notif-count').html(data);
            set_notif(data);
            countnotif = data;
          } else {
            ef.classList.add("bx-tada");
            $('.notif-num').html(data);
            $('.notif-count').html(data);
            set_notif(data);
            countnotif = data;
            get_listnotif();
            new Audio(baseURL+'uploads/app/audio/info.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("info", "<b>System Notification</b> <br> <b>Pemberitahuan</b> ada Surat Masuk yang baru saja didisposisikan untuk Anda");
            notification.push();
            return;
          }
        } else {
          ef.classList.remove("bx-tada");
          $('.notif-num').html('');
          $('.notif-count').html(data);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function count_disponotif() {
  $.ajax({
      url: baseURL+"notification/count_disponotif/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        var ef = document.getElementById("dispo-icon");

        if (data > 0) {
          if (data == countdispo) {
            ef.classList.add("bx-tada");
            $('.dispo-num').html(data);
            $('.dispo-count').html(data);
            set_dispo(data);
          } else if (data <= countdispo) {
            ef.classList.add("bx-tada");
            $('.dispo-num').html(data);
            $('.dispo-count').html(data);
            set_dispo(data);
            countdispo = data;
          } else {
            ef.classList.add("bx-tada");
            $('.dispo-num').html(data);
            $('.dispo-count').html(data);
            set_dispo(data);
            countdispo = data;
            get_listdispo();
            new Audio(baseURL+'uploads/app/audio/info.mp3').play();
            var notifier = new Notifier();
            var notification = notifier.notify("info", "<b>System Notification</b> <br> <b>Pemberitahuan</b> ada Surat Masuk yang baru saja diteruskan dan perlu mendapatkan tindakan");
            notification.push();
            return;
          }
        } else {
          ef.classList.remove("bx-tada");
          $('.dispo-num').html('');
          $('.dispo-count').html(data);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= SET NOTIFICATION

function set_notif(num) {
  $.ajax({
      url: baseURL+"notification/set_notif/"+num,
      type: "POST",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){

      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function set_dispo(num) {
  $.ajax({
      url: baseURL+"notification/set_dispo/"+num,
      type: "POST",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){

      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= GET NOTIFICATION

function get_listnotif() {
  $.ajax({
      url: baseURL+"notification/get_listnotif/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.notif-message').html('');
        var html = '';
        var i;

        if (data.length == 0) {
          $('.notif-message').html('');
          var html = '';
          html += '<div class="text-reset notification-item">'+
                      '<div class="media">'+
                          '<div class="media-body">'+
                              '<div class="font-size-12 text-muted text-center">'+
                                  '<p class="mb-1">Kosong</p>'+
                              '</div>'+
                          '</div>'+
                      '</div>'+
                  '</div>';
          $('.notif-message').html(html);
        } else {
          for(i=0; i<data.length; i++){
              if (data[i].InMailContent) {
                var content = data[i].InMailContent;
              } else {
                var content = '<i>Tidak ada deskripsi</i>';
              }

              html += '<a href="'+baseURL+'inbox/detail/'+data[i].InMailID+'" class="text-reset notification-item" onclick="maskasread('+data[i].DispositionID+')">'+
                          '<div class="media">'+
                              '<div class="avatar-xs mr-3">'+
                                  '<span class="avatar-title bg-soft-danger rounded-circle font-size-16">'+
                                      '<i class="bx bx-envelope text-danger"></i>'+
                                  '</span>'+
                              '</div>'+
                              '<div class="media-body">'+
                                  '<h6 class="mt-0 mb-1">'+data[i].InMailOrigin+' - ('+data[i].WorkunitName+')</h6>'+
                                  '<div class="font-size-12 text-muted">'+
                                      '<p class="mb-1">'+content+'</p>'+
                                      '<p class="mb-0"><i class="mdi mdi-clock-outline"></i> '+moment(data[i].DispositionLog).fromNow()+'</p>'+
                                  '</div>'+
                              '</div>'+
                          '</div>'+
                      '</a>';
          }
          $('.notif-message').html(html);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

function get_listdispo() {
  $.ajax({
      url: baseURL+"notification/get_listdispo/get",
      type: "GET",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.dispo-message').html('');
        var html = '';
        var i;

        if (data.length == 0) {
          $('.dispo-message').html('');
          var html = '';
          html += '<div class="text-reset notification-item">'+
                      '<div class="media">'+
                          '<div class="media-body">'+
                              '<div class="font-size-12 text-muted text-center">'+
                                  '<p class="mb-1">Kosong</p>'+
                              '</div>'+
                          '</div>'+
                      '</div>'+
                  '</div>';
          $('.dispo-message').html(html);
        } else {
          for(i=0; i<data.length; i++){
              if (data[i].InMailContent) {
                var content = data[i].InMailContent;
              } else {
                var content = '<i>Tidak ada deskripsi</i>';
              }

              html += '<a href="'+baseURL+'disposition/action/'+data[i].InMailID+'" class="text-reset notification-item">'+
                          '<div class="media">'+
                              '<div class="avatar-xs mr-3">'+
                                  '<span class="avatar-title bg-soft-primary rounded-circle font-size-18">'+
                                      '<i class="bx bx-error text-primary"></i>'+
                                  '</span>'+
                              '</div>'+
                              '<div class="media-body">'+
                                  '<h6 class="mt-0 mb-1">'+data[i].InMailOrigin+' - ('+data[i].WorkunitName+')</h6>'+
                                  '<div class="font-size-12 text-muted">'+
                                      '<p class="mb-1">'+content+'</p>'+
                                      '<p class="mb-0"><i class="mdi mdi-clock-outline"></i> '+moment(data[i].InMailLog).fromNow()+'</p>'+
                                  '</div>'+
                              '</div>'+
                          '</div>'+
                      '</a>';
            }
          $('.dispo-message').html(html);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}

// ================================================================================= MASK AS READ

function maskasread(id) {
  $.ajax({
      url: baseURL+'notification/maskasread/'+id,
      type: "POST",
      contentType: false,
      processData:false,
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){

      },
      error: function (jqXHR, textStatus, errorThrown) {
        return;
      }
  });
}
