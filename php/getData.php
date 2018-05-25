<?php
/**
 * Created by PhpStorm.
 * User: stigmat19yandex.ru
 * Date: 22.05.2018
 * Time: 18:20
 */

include 'connectDB.php';

if(mysqli_connect_errno()){
  echo "error: ".mysqli_connect_error();
}
$dataResult = array();
$data = mysqli_query($con, "SELECT * FROM Partners");

while ($row = mysqli_fetch_assoc($data)){
  //$row['id'] - идентификатор текущего партнера
  $info_data = mysqli_query($con, "SELECT * FROM Information WHERE partner_id = ".$row['id']);
  while ($info_row = mysqli_fetch_assoc($info_data)){
    $information[] = $info_row;
  }
  $row['information'] = $information;
  $dataResult[] = $row;
}
echo json_encode($dataResult);

mysqli_close($con);


//SELECT P.*,I.* FROM Partners P LEFT JOIN Information I ON I.partner_id = P.id
