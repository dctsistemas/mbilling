<?php
require_once("../config/config.php");
$user = $_GET['user'] . "_CLIENT";

// SELECIONANDO O ID DO GRUPO PARA CLIENTES
$result_group = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE `name` = '$user'");
while($rows_group = mysqli_fetch_assoc($result_group)){
    $id_group = $rows_group['id'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title></title>		
		<style type="text/css">
			.carregando{
				color:#ff0000;
				display:none;
			}
		</style>
		<style>
			textarea:focus, input:focus, select:focus {
				box-shadow: 0 0 0 0;
				border: 0 none;
				outline: 0;
			} 
		</style>
<link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

	</head>
	<body style="margin:10px; background-color:#f5f5f5;">
	<div style="color:blue;"><h5>Preencha todos os campos corretamente</h5></div>
		<?php include_once("../config/config.php"); ?>
		
		<form method="POST" autocomplete="off" action="salvar.php">

	<div style="display:none">
		<input type="text" name="id_group" value='<?php echo $id_group; ?>'> <br><br>
	</div>
	<div class="input-group mb-3"><input type="text" name="nome" placeholder="Nome/Raz. Social" style="width:850px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="sobrenome" placeholder="Sobrenome" style="width:600px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="doc" placeholder="CPF/CNPJ" style="width:250px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="endereco" placeholder="Endereço" style="width:300px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="bairro" placeholder="Bairro" style="width:150px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="estado" placeholder="Estado" style="width:300px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="cidade" placeholder="Cidade" style="width:300px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div class="input-group mb-3"><input type="text" name="cep" placeholder="CEP" style="width:110px;border: 0 none; box-shadow: 10 10 0 0; outline: 0; border-radius: 10px; background-color:#00000014; font-size: 15px; text-transform: uppercase; font-family:arial;font-weight: bold; padding-left: 7px;" required> <br><br></div>
	<div style="color:blue;"><h5>Selecione abaixo o Número desejado:</h5></div>
	<div class="input-group mb-3"><select name="id_categoria" id="id_categoria" required>>
				<option value="">Qual DDD?</option>
				<?php
					$result_cat_post = "SELECT * FROM pkg_ddd ORDER BY nome_ddd ASC";
					$resultado_cat_post = mysqli_query($conn, $result_cat_post);
					while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
						echo '<option value="'.$row_cat_post['id'].'">'.$row_cat_post['nome_ddd'].'</option>';
					}
				?>
			</select>
			<span class="carregando">&nbsp;&nbsp;Sem Número no DDD escolhido...</span>
			&nbsp;<select name="id_did" id="id_did" required>
				<option value=""></option>
			</select><br><br><button type="submit" value="Cadastrar" class="btn btn-outline-primary" style="position:absolute; margin-left:740px; border-radius: 10px;">CADASTRAR</button></br></br></div>
			<div style="color:red;"><h5>ATENÇÃO: Click somente uma vez no botao Cadastrar e Aguarde.</h5></div>

			

		</form>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script type="text/javascript">
		  google.load("jquery", "3.6.0");
		</script>
		
		<script type="text/javascript">
		$(function(){
			$('#id_categoria').change(function(){
				if( $(this).val() ) {
					$('#id_did').hide();
					$('.carregando').show();
					$.getJSON('selectDID.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Número</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id + '">' + j[i].did + '</option>';
						}	
						$('#id_did').html(options).show();
						$('.carregando').hide();
					});
				} else {
					$('#id_did').html('<option value="">– Escolha Subcategoria –</option>');
				}
			});
		});
		</script>
		    <script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	</body>
</html>
