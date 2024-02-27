<?php include_once("../api/config/config.php"); ?>
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

        <script>
            jQuery(document).ready(function ($) {
                $('.money').mask('000.000.000.000.000.00', {reverse: true});
            });
        </script>

    </head>
    <body>
 
    <form method="POST" autocomplete="off" action="salvar_fat_avulsa.php">
        <div class="row">
            <div class='col-sm-8'>
            <select name="doc" id="doc" required>>
				<option value="">Selecione o CPF/CNPJ:</option>
				<?php
                
					$result_cat_post = "SELECT * FROM pkg_group_user WHERE id_user_type = 1 AND id > 9";
					$resultado_cat_post = mysqli_query($conn, $result_cat_post);
					while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
                        // QUANTIDADE DE CLIENTES
                        $result_cli_post = "SELECT * FROM pkg_user WHERE id_group = '".$row_cat_post['id']."'";
                        $resultado_cli_post = mysqli_query($conn, $result_cli_post);
                        while($row_cli_post = mysqli_fetch_assoc($resultado_cli_post) ) {
    

                        

						echo '<option value="'.$row_cat_post['name'].'">'.$row_cat_post['name'].' - '.$row_cli_post['firstname'].'</option>';
                }
            }
				?>
			</select>
            <div class="form-group">
                    <label for="formGroupExampleInput">Vencimento:</label>
                    <div class='input-group'>
                        <input type='date' name="vencimento" id="vencimento" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
    <label>Valor:</label>
    <div class="input-group">
    <span class="input-group-text" id="basic-addon1">R$</span>
  <input type="text" class="form-control money" placeholder="0,00" aria-label="Valor" name="valor" id="valor" aria-describedby="basic-addon1" required>
</div>
  </div>
  <div class="form-group">
    <label>Referente a:</label>
    <input type="text" class="form-control" name="referente" id="referente" placeholder="" required>
  </div>
  <div class="form-group">
    <label>Descrição:</label>
    <textarea  type="text" class="form-control" name="descricao" id="descricao" cols="30" rows="6" placeholder="" required></textarea>
  </div>
            </div>
            <script type="text/javascript">
            $(function () {
                $('#data').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'pt-br'
                });
            });
            </script>
        </div>
        <button type="submit" value="Cadastrar" class="btn btn-success" style="position:absolute; margin-left:273px; border-radius: 5px;">CADASTRAR</button>
        </form>
    </body>
</html>