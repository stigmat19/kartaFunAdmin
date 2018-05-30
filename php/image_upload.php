<?php

$path = '../images/'; // директория для загрузки

$img_name = $_POST['img_name_hidden'];

$fname = ($_FILES['partner_imgUrl']['name']."");

$ext = substr($fname, -3); // расширение

$new_name = $img_name.'.'.$ext; // новое имя с расширением

$full_path = $path.$new_name; // полный путь с новым именем и расширением

$correctName = 'images/'.$new_name;

if($_FILES['partner_imgUrl']['error'] == 0){
  if(move_uploaded_file($_FILES['partner_imgUrl']['tmp_name'], $full_path)){
    // Если файл успешно загружен, то вносим в БД (надеюсь, что вы знаете как)
    // Можно сохранить $full_path (полный путь) или просто имя файла - $new_name
    include 'connectDB.php';
    //получаем id родителя
    //Получаем идентификатор родителя
    $parent_id = mysqli_query($con, "SELECT MAX(id) FROM Partners");
    $data_result_array = array();
    $current_id = null;//будет лежать ид родителя
    while ($row = mysqli_fetch_assoc($parent_id)){
      $data_result_array[] = $row;
    }
    foreach ($data_result_array as $item) {
      foreach ($item as $_item){
        $current_id = (int)$_item;
      }
    }
    //обновляем строку базы данных
    mysqli_query($con, "UPDATE Partners SET imgUrl = '".$new_name."' WHERE id = '".$current_id."'");

    mysqli_close($con);
  }
  echo "<script>alert('Партнер добавлен')</script>";
  echo '<center><a href="../index.php">назад</a></center>';
}
else{
  echo "Файл не получен </br>";
  echo '<a href="../index.php">назад</a>';
}

