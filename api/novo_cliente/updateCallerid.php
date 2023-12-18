<?php
$dbConfig = array(
    'hostname' => "localhost",
    'username' => "root",
    'password' => "P5JkUEYSms4M4Igw",
    'database' => "mbilling"
);

$conn = new mysqli($dbConfig['hostname'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']) or die("Could not connect database");

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

if (!$conn->set_charset("utf8mb4")) {
    printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
    exit();
}
	include_once("magnusBillingAPI.php");
	$magnusBilling             = new MagnusBilling('21232f297a57a5a743894a0e4a801fc2', '21232f297a57a5a743894a0e4a801fc3');
    $magnusBilling->public_url = "http://sip.skynetfibra.net.br";

	function magnus ($acao,$dados){
		$magnus['acao'] = $acao;		
		include "magnus.php";
		return $retorno;
		}

		$callerid = mysqli_query($conn, "SELECT * FROM pkg_sip WHERE callerid LIKE '55%'");
		while($rows_user = mysqli_fetch_assoc($callerid)){
		  $qdt = strlen($rows_user['callerid']);
			
			$updid['username'] = $rows_user['name'];
			$updid['callerid'] = substr($rows_user['callerid'], 2);
			$ok = magnus("up_sip",$updid);
		}

	
	?>