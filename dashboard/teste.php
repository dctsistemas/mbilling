<?php


$context = "nome=04622603306_CLIENT";

$dados = file_get_contents('count_sip.php');

$sip = explode("</body>",$dados);

var_dump($sip);