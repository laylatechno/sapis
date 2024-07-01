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

    $(".custom-validation").parsley();

    get_datainmail();

});

// <!-- ====================================================================================== AJAX SERVERSIDE ===================================================================================== -->

// ================================================================================= VIEW MAIL

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
              sSearch: "Cari Unit Penerima:",
    },
     "destroy": true,
     "processing": true,
     "serverSide": true,
     "order":[],
     "ajax":{
          url: baseURL+'disposition/get_datainmail/get',
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
