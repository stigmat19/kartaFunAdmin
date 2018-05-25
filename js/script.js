$(document).ready(function() {
  $('#add-info-btn').on('click', function (e) {
    e.preventDefault();
    var parent = $('#add-info-wrap');
    parent.append("<div id='add-info'>" +
      "<label>\n" +
      "Телефоны\n" +
      "<textarea name=\"info_tel\" class=\"form-control\"></textarea>\n" +
      "  </label>\n" +
      "  <label>\n" +
      "  Адреса\n" +
      "  <textarea name=\"info_adress\" class=\"form-control\"></textarea>\n" +
      "  </label>\n" +
      "  <label>\n" +
      "  График работы\n" +
      "<textarea name=\"info_shedule\" class=\"form-control\"></textarea>\n" +
      "  </label>" +
      "</div>")
  })
});


