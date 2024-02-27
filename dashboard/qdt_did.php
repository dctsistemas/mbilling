<?php
include_once("../api/config/config.php");
include_once("../api/novo_cliente/magnusBillingAPI.php");


// SELECIONANDO OS PARCEIROS
$plataformas = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$_GET['user']."_CLIENT'");
while($rows_plataforma = mysqli_fetch_assoc($plataformas)){

// QUANTIDADE DE CLIENTES
$result_users = mysqli_query($conn, "SELECT * FROM pkg_user WHERE id_group = '".$rows_plataforma['id']."'");
$num_rows_users = mysqli_num_rows($result_users);
while($rows_user = mysqli_fetch_assoc($result_users)){


// QUANTIDADE DE SIPs
$result_sip = mysqli_query($conn, "SELECT * FROM pkg_sip WHERE id_user = '".$rows_user['id']."'");
$num_rows_sip += mysqli_num_rows($result_sip);



// QUANTIDADE DE DID RESERVADOS
$result_did_reser = mysqli_query($conn, "SELECT * from pkg_did WHERE reserved = '1' AND id_user = '".$rows_user['id']."'");
$num_rows_did_reser += mysqli_num_rows($result_did_reser);

echo($num_rows_did_reser);


}
}
