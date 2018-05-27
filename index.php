<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>KartaFun admin</title>
</head>
<body>

<div class="wrap">
  <div>
    <h2>Загрузить в базу</h2>
    <form action="php/image_upload.php"
          method="post"
          enctype="multipart/form-data"
          id="form_image">
      <label>
        Здесь будет загрузка картинки
        <input type="file" name="partner_imgUrl" id="partner_imgUrl" class="form-control">
<!--        <input type="submit" value="send" class="btn btn-primary">-->
        <input type="hidden" name="img_name_hidden" id="img_name_hidden">
      </label>
    </form>
    <form id="setData">
      <div class="form-left">
        <label>
          Введите название партнера
          <input type="text" name="partner_name" placeholder="Название партнера" class="form-control">
        </label>
        <label>
          Введите телефоны
          <textarea name="partner_tel" class="form-control"></textarea>
        </label>
        <label>
          Введите адреса сайтов
          <textarea name="partner_link" class="form-control"></textarea>
        </label>
        <label>
          Введите email
          <textarea name="partner_email" class="form-control"></textarea>
        </label>
        <label>
          Выберите время рассрочки
          <select name="partner_mount" class="form-control">
            <option value="1 месяц">1 месяц</option>
            <option value="2 месяца">2 месяца</option>
            <option value="3 месяца">3 месяца</option>
            <option value="4 месяца">4 месяца</option>
            <option value="5 месяцев">5 месяцев</option>
            <option value="6 месяцев">6 месяцев</option>
            <option value="7 месяцев">7 месяцев</option>
            <option value="8 месяцев">8 месяцев</option>
            <option value="9 месяцев">9 месяцев</option>
            <option value="10 месяцев">10 месяцев</option>
            <option value="11 месяцев">11 месяцев</option>
            <option value="12 месяцев">12 месяцев</option>
          </select>
        </label>
        <label>
          Описание партнера
          <textarea name="partner_descr" class="form-control"></textarea>
        </label>
      </div>
      <div class="form-right">
        <p>Информация о магазинах</p>
        <label>
          Телефоны
          <textarea name="info_tel" class="form-control"></textarea>
        </label>
        <label>
          Адреса
          <textarea name="info_adress" class="form-control"></textarea>
        </label>
        <label>
          График работы
          <textarea name="info_shedule" class="form-control"></textarea>
        </label>
        <div id="add-info-wrap"></div>
        <button id="add-info-btn" class="btn btn-primary">Добавить</button>
        <hr>
        <input type="submit" class="btn btn-primary" value="Отправить">
      </div>
    </form>
  </div>
  <div>
    <h2>Получить из базы</h2>
    <form id="getData">
      <input type="submit" value="получить" class="btn btn-primary">
    </form>
  </div>
</div>
<div>
  <input type=button onclick='testLoadData()' value='загрузить JSON'>
</div>


<script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script src="js/script.js"></script>
<script src="js/send.js"></script>
<script src="data/data.json"></script>

<script>

  "use strict";

  function testLoadData() {
    $.ajax("data/data.json",
      { type:'GET', dataType:'json', success:dataLoaded, error:errorHandler }
    );
  }

  function dataLoaded(mydata) {
    console.log('загруженные через AJAX данные:');
    //console.log(JSON.stringify(mydata));

    var newData = JSON.stringify(mydata);

    //console.log(newData);

    $.ajax({
      type: 'POST',
      url: 'php/download.php',
      dataType: 'json',
      data: newData,
      beforeSend: function(data) {

      },
      success: function(data){
        //console.log('new data', data);
        if (data['error']) {
          alert(data['error']);
        } else {
          alert('success');
        }
      },
      error: function (xhr, ajaxOptions, thrownError) { // в случae нeудaчнoгo зaвeршeния зaпрoсa к сeрвeру
        console.log(xhr.status); // пoкaжeм oтвeт сeрвeрa
        console.log(thrownError); // и тeкст oшибки
      },
      complete: function(data) {
        //console.log('Сработал complete');
      }
    });

  }

  function errorHandler(jqXHR,statusStr,errorStr) {
    alert(statusStr+' '+errorStr);
  }

</script>


</body>
</html>