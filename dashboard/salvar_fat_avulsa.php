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
title: 'Fatura',
text: 'Gerada com sucesso!',

  });
</script>
</body>
</html>
<?php include('checkout/config/conecta.php');

$string = $_POST['doc'];
$contString = strlen($string);

if ($contString > 11) {
$type = "CNPJ";
} else {
$type = "CPF";
}

$sql="INSERT INTO pkg_checkout(type, doc, email, descricao, referente, vencimento, valor ) VALUES('".$type."','".$_POST['doc']."', 'danielct59@gmail.com', '".$_POST['descricao']."', '".$_POST['referente']."', '".$_POST['vencimento']."', '".$_POST['valor']."')";
mysqli_query($conexao, $sql);




$sql_config = mysqli_query($conexao,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
$resultado_config	= mysqli_fetch_assoc($sql_config);

$sql_cliente = mysqli_query($conexao,"SELECT * FROM pkg_user WHERE username = '".$_POST['doc']."'") or die("Erro");
$resultado_cliente	= mysqli_fetch_assoc($sql_cliente);


preg_match('/\p{L}+/i', $resultado_cliente['firstname'], $nome);
$curl = curl_init();
$api_url = $resultado_config['hostapizap'].'api/messages/send';
$celular = $resultado_cliente['mobile'];
$msg = 'Olá *'.$nome[0].'.* tudo bem? 

Estamos escrevendo para informar que a sua fatura no valor de R$ '.$_POST['valor'].' com vencimento em '.$_POST['vencimento'].', Já está disponivel para pagamento.

pra isso, basta entrar na sua *Plataforma*... Logo na Pagina Principal!
Caso fique alguma *Dúvida*, não exite em nos comunicar!

Atensiosamente:
*SKYNET FIBRA*';          
$msg_ed = preg_replace("/\r|\n/", '\n', $msg);
  
curl_setopt($curl, CURLOPT_URL, $api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, "{\"number\":\"$celular\",\"body\":\"$msg_ed\"}");

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: bearer '.$resultado_config['tokenapizap'];
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($curl);
curl_close($curl);
