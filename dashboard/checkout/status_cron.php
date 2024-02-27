<?php include('config/conecta.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Checkout pix Mercado Pago</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php


$sql_pedido = mysqli_query($conexao,"SELECT * FROM pkg_checkout WHERE status = 'pendente' AND codigo_transacao > 0") or die("Erro");
$resultado_pedido	= mysqli_fetch_assoc($sql_pedido);

$sql_cliente = mysqli_query($conexao,"SELECT * FROM pkg_user WHERE username = '".$resultado_pedido['doc']."'") or die("Erro");
$resultado_cliente	= mysqli_fetch_assoc($sql_cliente);

$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mercadopago.com/v1/payments/'.$resultado_pedido['codigo_transacao'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json', 
        'content-type: application/json',
        'Authorization: Bearer '.$access_token
    ),
    ));
    $response = curl_exec($curl);
    $resultado = json_decode($response);
curl_close($curl);
if($resultado->status == 'approved'){
    $update = "UPDATE pkg_checkout SET
        status		= 'aprovado'
    WHERE codigo_transacao='".$resultado_pedido['codigo_transacao']."'";
    mysqli_query($conexao, $update);

    $sql_config = mysqli_query($conexao,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
    $resultado_config	= mysqli_fetch_assoc($sql_config);


    preg_match('/\p{L}+/i', $resultado_cliente['firstname'], $nome);
    $curl = curl_init();
    $api_url = $resultado_config['hostapizap'].'api/messages/send';
    $celular = $resultado_cliente['number'];
    $dia     = substr($resultado_pedido['vencimento'],8,2);
    $mes     = substr($resultado_pedido['vencimento'],5,2);
    $ano     = substr($resultado_pedido['vencimento'],0,4);
    
    $msg = 'Olá *'.$nome[0].'.* tudo bem?

_Agradecemos o pagamento da sua fatura, e esperamos que você conte conosco mais vezes._

*Fatura:* 00'.$resultado_pedido['id'].'
*Status:* PAGO 
*Valor:* R$ '.$resultado_pedido['valor'].'
*Vencimento:* '.$dia.'/'.$mes.'/'.$ano.'

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

}
if($resultado_pedido['status'] == 'aprovado'){?>
    <script>
      setTimeout(function(){ window.location.href = "https://<?php echo $host;?>/pago.php"; }, 3000);
      </script>

<?php


//    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=https://".$host."/obrigado.php?id=".$resultado_pedido['id']."'>";
}
?>