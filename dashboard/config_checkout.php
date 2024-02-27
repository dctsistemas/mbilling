<?php include_once("../api/config/config.php"); 


$sql_config = mysqli_query($conn,"SELECT * FROM pkg_checkout_config WHERE id = '1'") or die("Erro");
$resultado_config	= mysqli_fetch_assoc($sql_config);







?>

<html>
    <head>
        <title>Bootstrap com datetimepicker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/datetimepicker.js"></script>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    </head>
    <body>
 
    <form method="POST" autocomplete="off" action="salvar_config_checkout.php">
        <div class="row">
        <h3>Configuração do Modulo PIX</h3>
        <div class='col-sm-12'>
    <div class="form-group">
    <label>Host:</label>
    <div class="input-group">
        <input value="<?php echo($resultado_config['host']); ?>" type="text" class="form-control" aria-label="host" name="host" id="host" aria-describedby="basic-addon1" required>
    </div>




  <div class="form-group">
    <label>Host de notificação:</label>
    <input value="<?php echo($resultado_config['hostnotification']); ?>" type="text" class="form-control" name="hostnotification" id="hostnotification" placeholder="" required>
  </div>


  <div class="form-group">
    <label>Token de acesso:</label>
    <input value="<?php echo($resultado_config['accesstoken']); ?>" type="text" class="form-control" name="accesstoken" id="accesstoken" placeholder="" required>
  </div>






</div>
</div>
<h3>Configuração do Modulo WhatsApp</h3>
<div class='col-sm-12'>

<div class="form-group">
    <label>Host API:</label>
    <input value="<?php echo($resultado_config['hostapizap']); ?>" type="text" class="form-control" name="hostapizap" id="hostapizap" placeholder="" required>
  </div>


  <div class="form-group">
    <label>Token:</label>
    <input value="<?php echo($resultado_config['tokenapizap']); ?>" type="text" class="form-control" name="tokenapizap" id="tokenapizap" placeholder="" required>
  </div>



</div>
</div>
        <button type="submit" value="Cadastrar" class="btn btn-success" style="position:absolute; margin-left:584px; border-radius: 5px;">SALVAR</button>
        </form>
    </body>
</html>