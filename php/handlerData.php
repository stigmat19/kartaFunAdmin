<?php

include 'connectDB.php';

if(mysqli_connect_errno()){
  echo "error: ".mysqli_connect_error();
}
else{
  echo "success"."\n";
  //print_r($_FILES['partner_imgUrl']['name']);
}

$partner_name = htmlspecialchars($_POST['partner_name']);//название партнера
$partner_tel = htmlspecialchars($_POST['partner_tel']);//список телефонов
$partner_link = htmlspecialchars($_POST['partner_link']);//адреса сайтов
$partner_mount = htmlspecialchars($_POST['partner_mount']);//время рассрочки
$partner_email = htmlspecialchars($_POST['partner_email']);//email
$partner_descr = htmlspecialchars($_POST['partner_descr']);//описание партнера

//информация о партнерах
$info = json_decode($_POST['info']);//массив с данными по магазинам

//записываем в базу новые данные по партнеру без данных о магазине
mysqli_query($con, "INSERT INTO Partners (partner_name, tel, email, link, mount, descr) VALUES ('".$partner_name."','".$partner_tel."','".$partner_email."','".$partner_link."','".$partner_mount."','".$partner_descr."')");

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

foreach ($info as $item){
  mysqli_query($con, "INSERT INTO Information (tel, adress, shedule, partner_id) VALUES ('".$item -> tel."', '".$item -> adress."','".$item -> schedule."','".$current_id."')");
}







mysqli_close($con);






