<?php 
include("../config/checkout/conecta.php");

$sql_config = mysqli_query($conexao,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
$resultado_config	= mysqli_fetch_assoc($sql_config);


$host               = $resultado_config['host'];
$hostnotification   = $resultado_config['hostnotification'];



 return [
    'accesstoken' => $resultado_config['acesstoken'],
    'url_notification_sdk' => $host,
    'url_notification_api' => $hostnotification
];