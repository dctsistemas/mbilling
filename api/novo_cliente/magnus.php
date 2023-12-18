<?php
error_reporting(0);
set_time_limit(0);

error_reporting(0);

$mysql_mb_user = "root";
$mysql_mb_pass = "P5JkUEYSms4M4Igw";
$mysql_mb_banco = "mbilling";
$mysql_mb_host = "localhost";
$mysql_mb_port = "3306";

// MAGNUS //
$token = "21232f297a57a5a743894a0e4a801fc2";
$tokensenha = "21232f297a57a5a743894a0e4a801fc3";
$urlMB = "http://sip.skynetfibra.net.br";

error_reporting(0);

require_once "magnusbilling.php";

use magnusbilling\api\magnusBilling;

$magnusBilling             = new MagnusBilling($token , $tokensenha);
$magnusBilling->public_url = $urlMB; 


if($_GET['teste'] == "ok"){ 
$id_sip_account = $magnusBilling->getId('sip', 'name', 858585);
$dados['context'] = "billing";
$retorno = $magnusBilling->update('sip', $id_sip_account , $dados);
	print_r($retorno);
}


if($magnus['acao'] == "recarga"){
$id_user = $magnusBilling->getId("user", "username", $dados['username']);
$retorno = $magnusBilling->create('refill',[
      'id_user' => $id_user, 
      'credit' => $dados['credito'],
      'payment' => 0, 
      'description' => "Recarga realizada com sucesso ". date('d.m.Y') . "( ". $dados['username'] ." )"
    ]);

}elseif($magnus['acao'] == "pdidu"){
$magnusBilling->setFilter('id_user', $dados['id_user']);
$retorno = $magnusBilling->read('did');
	
}elseif($magnus['acao'] == "creditos"){
$magnusBilling->setFilter('credit', '-', 'st');
$retorno = $magnusBilling->read('user');
	
}elseif($magnus['acao'] == 'didvr'){

$magnusBilling->setFilter('id', $dados['id']);
$retorno = $magnusBilling->read('did');
$retorno = $retorno['rows']['0'];

}elseif($magnus['acao'] == 'did0800'){

$magnusBilling->setFilter('did', '800','st');
$magnusBilling->setFilter('reserved', '0');

$retorno = $magnusBilling->read('did');
$retorno = $retorno['rows'];

}elseif($magnus['acao'] == 'planos'){

$retorno =  $magnusBilling->read('plan');
$retorno = $retorno['rows'];


}elseif($magnus['acao'] == 'dids'){
	
$magnusBilling->setFilter('activated', '1');
$magnusBilling->setFilter('reserved', '0');
$retorno = $magnusBilling->read('did');
$retorno = $retorno['rows'];
}elseif($magnus['acao'] == 'didescolha'){
	
$magnusBilling->setFilter('id', $dados['did']);
$retorno = $magnusBilling->read('did');
$retorno = $retorno['rows']['0'];

}elseif($magnus['acao'] == 'diddestination'){

$magnusBilling->setFilter('id_user', $dados);
$retorno = $magnusBilling->read("diddestination");


}elseif($magnus['acao'] == 'cadastro'){

print_r(json_encode($magnusBilling->createUser($dados)));
	}elseif($magnus['acao'] == 'cancela_sip'){

$id_sip_account = $magnusBilling->getId('sip', 'name', $dados['usuario']);
$retorno = $magnusBilling->destroy('sip',$id_sip_account);

}elseif($magnus['acao'] == 'editar_conta'){
	
$id_user = $magnusBilling->getId('user', 'username', $dados['usuario']);
$retorno = $magnusBilling->update('user', $id_user , $dados['atualizar']);


}elseif($magnus['acao'] == 'pesquisa_usuario'){
$magnusBilling->setFilter('username',$dados);
$retorno =  $magnusBilling->read('user');
$retorno = $retorno['rows']['0'];


}elseif($magnus['acao'] == 'localiza'){
$id_user = $magnusBilling->getId('user', 'username', $dados);
$retorno =  $magnusBilling->read('user');
$retorno = $retorno['rows']['0'];


}elseif($magnus['acao'] == 'diddestino'){
$retorno = $magnusBilling->create('diddestination',$dados);

// [
      // 'voip_call' => $dados['entrega'],
      // 'destination' => 55 . $dados['destinotel'],
      // 'id_sip' => $dados['id_sip'],
      // 'id_did' => $dados['id_did'],
      // 'priority' => 1,
      // 'id_user' => $dados['id_user'],
// ]


}elseif($magnus['acao'] == 'sip'){
	
$magnusBilling->setFilter("name", "43891");
$retorno = $magnusBilling->read('sip');
	
}elseif($magnus['acao'] == 'criardid'){
	
$retorno = $magnusBilling->create('did',[
      'did' => $dados,
      'minimal_time_charge' => "1", 
      'initblock' => "30", 
      'increment' => "6"
    ]);

}elseif($magnus['acao'] == 'pdid'){
$magnusBilling->setFilter("did", $dados);
$retorno = $magnusBilling->read('did');


}elseif($magnus['acao'] == 'ldid'){
$id_sip_account = $magnusBilling->getId('did', 'did' ,$dados['did']);
$id_sip_account = $magnusBilling->getId('diddestination', 'id_did' ,$id_sip_account);
$retorno = $magnusBilling->destroy('diddestination',$id_sip_account);

}elseif($magnus['acao'] == 'updid'){
$id_user = $magnusBilling->getId('did', 'did', $dados['did']);
$retorno = $magnusBilling->update('did', $id_user , [
 'id_user' => "",    
  'reserved' => "0",
]);

}elseif($magnus['acao'] == 'cancela_user'){
$id_sip_account = $magnusBilling->getId('user', 'username' ,$dados['usuario']);
$retorno = $magnusBilling->destroy('user',$id_sip_account);

}elseif($magnus['acao'] == 'cencela_did'){
$id_sip_account = $magnusBilling->getId('did', 'did' ,$dados);
$retorno = $magnusBilling->destroy('did',$id_sip_account);
}elseif($magnus['acao'] == 'up_sip'){
$id_sip_account = $magnusBilling->getId('sip', 'name', $dados['username']);
unset($dados['username']);
$retorno = $magnusBilling->update('sip', $id_sip_account , $dados);

}



?>

