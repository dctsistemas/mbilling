<?php
include_once("../api/config/config.php");
mysqli_query($conn,"UPDATE pkg_checkout_config 
SET host = '".$_POST['host']."',
    hostnotification = '".$_POST['hostnotification']."',
    accesstoken = '".$_POST['accesstoken']."',
    hostapizap = '".$_POST['hostapizap']."',
    tokenapizap = '".$_POST['tokenapizap']."'
    WHERE id = '1'") or die("Erro");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Checkout pix Mercado Pago</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="checkout/css/sweetalert.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<script>
Swal.fire({
    showConfirmButton: false,
    icon: 'success',
    title: 'Configuração',
    text: 'Aplicada com sucesso!',
    
  });
</script>
</body>
</html>
