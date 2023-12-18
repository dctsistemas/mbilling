<?php
	include_once("../config/config.php");
	include_once("magnusBillingAPI.php");
	$magnusBilling             = new MagnusBilling('21232f297a57a5a743894a0e4a801fc2', '21232f297a57a5a743894a0e4a801fc3');
    $magnusBilling->public_url = "http://sip.skynetfibra.net.br"; // Your MagnusBilling URL

	function magnus ($acao,$dados){
		$magnus['acao'] = $acao;		
		include "magnus.php";
		return $retorno;
		}

	$id_group = $_POST['id_group'];
		if($id_group < 4){
			$id_group = 3;
		}
	$id_plan = '3';	
	$email = time() . "@skynetfibra.net.br";
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$doc = $_POST['doc'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$cep = $_POST['cep'];
	$id_did = $_POST['id_did'];
	$numero = $_POST['did'];
	$ddd = $_POST['id_categoria'];


	
    $result = $magnusBilling->createUser([
		'active' => '1',
		'firstname' => $nome,
		'lastname' => $sobrenome, 
		'address' => $endereco,
		'city' => $cidade,
		'state' => $estado,
		'email' => $email,
		'zipcode' => $cep,
		'callerid' => substr($numero, -10),
		'language' => 'br',
		'country' => '55',
		'typepaid' => '1',
		'doc' => $doc,
		'id_group' => $id_group,
		'id_plan' => '3',
		'prefix_local' => '0/55/11,0/55/12,*/55'. $ddd .'/8,*/55'.$ddd.'/9',      
        'credit' => '1000.000',
	  ]);
	  if($result["errors"]){
		if($result["errors"] === 'This email already in use'){
		}
	  
	  }
	  else{
		$username = $result["data"]["username"]; 
		$user = mysqli_query($conn, "SELECT * from pkg_user where username = '".$username."'");
		while($rows_user = mysqli_fetch_assoc($user)){
		  $id_user = $rows_user['id'];

		}
		$sip = mysqli_query($conn, "SELECT * from pkg_sip where `name` = '".$username."'");
		while($rows_sip = mysqli_fetch_assoc($sip)){
		  $id_sip = $rows_sip['id'];

		}

		$did = mysqli_query($conn, "SELECT * from pkg_did where id = '".$id_did."'");
		while($rows_did = mysqli_fetch_assoc($did)){
		  $did = $rows_did['did'];
		  $ddd = "(" . substr($rows_did['did'], -10, 2). ") ";
		  $numero_a = substr($rows_did['did'], -8, 4);
		  $numero_b = "-" . substr($rows_did['did'], -4);
		  $numero_ = $ddd . $numero_a . $numero_b;


		}
		mysqli_query($conn, "UPDATE pkg_did SET id_user = '".$id_user."' WHERE id = '".$id_did."'");
		mysqli_query($conn, "UPDATE pkg_did SET reserved = '1' WHERE id = '".$id_did."'");
		mysqli_query($conn, "INSERT INTO `pkg_did_destination` (`id_user`, `id_ivr`, `id_sip`, `id_queue`, `id_did`, `destination`, `context`, `priority`, `activated`, `secondusedreal`, `voip_call`) VALUES('".$id_user."', NULL, '".$id_sip."', NULL, '".$id_did."', '', NULL, 1, 1, 0, 1)");		
		?>
		<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title></title>		
<link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

	</head>
	<body style="margin:10px; background-color:#f5f5f5;">
	<h1>Sucesso<br></h1>

	<?php  
		echo("HOST: sip.skynetfibra.net.br<br>");
		echo("Conta SIP: " . $result["data"]["username"]. "<br>");
		echo("Senha: " . $result["data"]["password"] . "<br>");
		echo "Numero DID: $numero_ <br><br>";

		echo "Nome: $nome <br>";
		echo "Sobrenome: $sobrenome <br>";
		echo "CPF/CNPJ: $doc <br>";
		echo "Endereço: $endereco <br>";
		echo "Bairro: $bairro <br>";
		echo "Cidade: $cidade <br>";
		echo "Estado: $estado <br>";
		echo "CEP: $cep <br><br>";
		$updid['username'] = $result["data"]["username"];
		$updid['callerid'] = $did;
		$ok = magnus("up_sip",$updid);
	?>
		</script>
		    <script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php } ?>
	</body>
</html>
