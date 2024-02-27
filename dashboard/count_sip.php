<?php
include_once("../api/config/config.php");

$nome = $_GET['nome'];

$sql_p = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE id_user_type = 1 AND id > 9");
while($rows_pl = mysqli_fetch_assoc($sql_p)){

  $sql_pl = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$rows_pl['name']."_CLIENT'");
  while($rows_pla = mysqli_fetch_assoc($sql_pl)){
  



$sql_c = mysqli_query($conn, "SELECT * FROM pkg_user WHERE id_group = '".$rows_pla['id']."'");
echo("USUARIO: ".$rows_pla['name']."<br>");

while($rows_us = mysqli_fetch_assoc($sql_c)){
  $result_did_reser = mysqli_query($conn, "SELECT * from pkg_did WHERE id_user = '".$rows_us['id']."'");
  $num_rows_did_reser += mysqli_num_rows($result_did_reser);
    
  echo $num_rows_did_reser."<br>";

}
}




}



?>