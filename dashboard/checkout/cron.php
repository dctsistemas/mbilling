<?php

$url = "https://processa.skynetfibra.net.br/checkout/status_cron.php";
$res = json_decode(file_get_contents($url));
