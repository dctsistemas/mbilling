<?php
/* Conectar com o servidor FTP */
$conecta = ftp_connect('172.31.255.254');
if(!$conecta) die('Erro ao conectar com o servidor');
 
/* Autenticar no servidor */
$login = ftp_login($conecta, 'voip', 'Mel@2307');
if(!$login) die('Erro ao autenticar');
 
ftp_pasv($conecta, true);
$data = date("d-m-Y");
$arquivo = "backup_voip_Magnus.tgz";
$destino = '/usr/local/src/magnus/backup/backup_voip_Magnus.'.$data.'.tgz';
$envia = ftp_put($conecta, $arquivo, $destino, FTP_ASCII);
 
if(!$envia){
    die('Erro ao enviar arquivo!');
}
else{
}
 
/* Desconecta do servidor */
ftp_close($conecta);
?>