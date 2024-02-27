<?php
date_default_timezone_set('America/Fortaleza');

//include('pix/AppConfig.php');

$servername = "localhost";
$username   = "root";
$password   = "eZf8lxBkibktEnjs";
$db_name    = "mbilling";

$conexao = mysqli_connect($servername, $username, $password, $db_name);
if (!$conexao->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
    exit();
}


$sql_config = mysqli_query($conexao,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
$resultado_config	= mysqli_fetch_assoc($sql_config);


$host               = $resultado_config['host'];
$hostnotification   = $resultado_config['hostnotification'];
$access_token       = $resultado_config['accesstoken'];

$sql_pedido = mysqli_query($conexao,"SELECT * FROM pkg_checkout WHERE id = '".$_GET['id']."'") or die("Erro");
$resultado_pedido	= mysqli_fetch_assoc($sql_pedido);
$id                 = $resultado_pedido['id'];
$type               = $resultado_pedido['type'];
$doc                = $resultado_pedido['doc'];
$desc               = $resultado_pedido['descricao'];
$ref                = $resultado_pedido['referente'];
$hora               = $resultado_pedido['hora'];
$minuto             = $resultado_pedido['minuto'];
$linha              = $resultado_pedido['linha'];
$qrcode             = $resultado_pedido['qrcode'];
$valor              = $resultado_pedido['valor'];
$status             = $resultado_pedido['status'];
$datetime           = $resultado_pedido['datetime'];    
$codigo_transacao   = $resultado_pedido['codigo_transacao'];
?>