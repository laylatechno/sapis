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
    page_setting();
    get_datacounter();
    get_logincounter();
    get_messageunread();
});

// <!-- ====================================================================================== PAGE SETTING ===================================================================================== -->

function page_setting() {
  var currentYear = new Date().getFullYear();
  document.getElementById("graph-year").value = currentYear;
  document.getElementById("percentace-year").value = currentYear;
  graph_render(currentYear);
  percentace_render(currentYear);

  $("#graph-year").on("change", function () {
    var selectedYear = $('[name="graph-year"]').val();
    graph_render(selectedYear);
  });
  $("#percentace-year").on("change", function () {
    var selectedYear = $('[name="percentace-year"]').val();
    percentace_render(selectedYear);
  });
}

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

function get_datacounter(){
  $.ajax({
      url: baseURL+'dashboard/get_datacounter/get',
      type: "GET",
      cache: false,
      async: true,
      dataType: "JSON",
      success: function(data){
        $('.total-inmail').html(data.TotalInMail+' Surat');
        $('.total-outmail').html(data.TotalOutMail+' Surat');
        $('.total-disposition').html(data.TotalDisposition);
      },
  });
}

function get_messageunread(){
  $.ajax({
      url : baseURL+'dashboard/get_messageunread/get',
      type:'GET',
  }).done(function(response){
      $(".show-unread").append(response);
  });
}

function get_logincounter(){
  $.ajax({
      url: baseURL+'dashboard/get_counter/get',
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
                            '<p class="text-muted text-justify mb-2"><strong>'+data[i].FullName+'</strong> telah masuk kedalam aplikasi menggunakan <strong><i>'+data[i].CounterBrowser+'</i></strong> pada perangkat <strong>'+data[i].CounterOS+'</strong>.</p>'+
                            '<div class="float-right"><p class="mb-0"><i class="mdi mdi-clock-outline"></i> <small>'+moment(data[i].CounterLog).fromNow()+'</small></p></div>'+
                          '</div>'+
                      '</div>'+
                  '</li>';
        }
        $('.show-counter').html(html);
      },
  });
}
