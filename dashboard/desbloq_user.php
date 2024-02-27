<?php

include_once("../api/config/config.php");
include_once("../api/novo_cliente/magnusBillingAPI.php");

$magnusBilling             = new MagnusBilling('21232f297a57a5a743894a0e4a801fc2', '21232f297a57a5a743894a0e4a801fc3');
$magnusBilling->public_url = "https://sip.skynetfibra.net.br"; // Your MagnusBilling URL

if($_GET['username']){
    $id_user = $magnusBilling->getId('user', 'username', $_GET['username']);
    $result = $magnusBilling->update('user',$id_user, [
      'active' => '1',
    ]);
    //print_r($result);
}
else{
    echo("NOT AUTORIZED!");
}

