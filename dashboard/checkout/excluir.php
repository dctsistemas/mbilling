<?php
include('config/conecta.php');



if(isset($_GET['id'])){
    $sql="DELETE FROM pkg_checkout WHERE id = '".$_GET['id']."'";
    mysqli_query($conexao, $sql);
}
else{
    echo("NOT AUTORIZED");
}
?>