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
  });

  //отправляем картинку на сервак
  // Переменная куда будут располагаться данные файлов

  var files;

// Вешаем функцию на событие
// Получим данные файлов и добавим их в переменную

  $('input[type=file]').change(function(){
    files = this.files;
  });

  // Вешаем функцию ан событие click и отправляем AJAX запрос с данными файлов

  $('.submit.button').click(function( event ){
    event.stopPropagation(); // Остановка происходящего
    event.preventDefault();  // Полная остановка происходящего

    // Создадим данные формы и добавим в них данные файлов из files

    var data = new FormData();
    console.log('data', data);
    $.each( files, function( key, value ){
      data.append( key, value );
    });

    // Отправляем запрос

    $.ajax({
      url: './submit.php?uploadfiles',
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      processData: false, // Не обрабатываем файлы (Don't process the files)
      contentType: false, // Так jQuery скажет серверу что это строковой запрос
      success: function( respond, textStatus, jqXHR ){

        // Если все ОК

        if( typeof respond.error === 'undefined' ){
          // Файлы успешно загружены, делаем что нибудь здесь

          // выведем пути к загруженным файлам в блок '.ajax-respond'

          var files_path = respond.files;
          var html = '';
          $.each( files_path, function( key, val ){ html += val +'<br>'; } )
          $('.ajax-respond').html( html );
        }
        else{
          console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
        }
      },
      error: function( jqXHR, textStatus, errorThrown ){
        console.log('ОШИБКИ AJAX запроса: ' + textStatus );
      }
    });

  });
});


