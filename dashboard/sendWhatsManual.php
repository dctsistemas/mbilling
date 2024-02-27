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
    title: 'Mensagem',
    text: 'Enviada com Sucesso!',
    
  });
</script>
</body>
</html>
<?php
include_once("../api/config/config.php"); 

if(isset($_GET['id_fat'])){

$sql_config = mysqli_query($conn,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
$resultado_config	= mysqli_fetch_assoc($sql_config);

$sql_fatura = mysqli_query($conn,"SELECT * FROM pkg_checkout WHERE id = '".$_GET['id_fat']."'") or die("Erro");
$resultado_fatura	= mysqli_fetch_assoc($sql_fatura);



$sql_cliente = mysqli_query($conn,"SELECT * FROM pkg_user WHERE username = '".$resultado_fatura['doc']."'") or die("Erro");
$resultado_cliente	= mysqli_fetch_assoc($sql_cliente);


// CHECANDO SE ENCONTROU O USSUARIO NO MAGNUS
if($resultado_cliente){
        preg_match('/\p{L}+/i', $resultado_cliente['firstname'], $nome);
        $curl = curl_init();
        $api_url = $resultado_config['hostapizap'].'api/messages/send';
        $celular = $resultado_cliente['mobile'];
        $msg = 'Prezado *'.$nome[0].'.* Como vai? 
Gostaríamos de lembrar da sua fatura em aberto!

Estamos enviando esta mensagem para informar que não recebemos o pagamento da fatura no valor de R$ '.$resultado_fatura['valor'].' com vencimento em '.$resultado_fatura['vencimento'].'. Aconteceu alguma coisa ou você deseja alterar a forma de pagamento? Se sim, nos escreva para conversarmos!
        
Caso você já tenha realizado o acerto do valor, por favor, desconsidere a comunicação.
        
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
else{
        echo("USUARIO NAO ENCONTRADO");

}	
}
else{
        echo("NOT AUTOEIZED");
}
?>
