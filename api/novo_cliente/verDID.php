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
	</head>
	<body>
		<h1>LISTAR DIDs DISPONIVEIS</h1>
		<?php include_once("../config/config.php"); ?>
		
		<form method="POST" action="salvar_post.php">
			<select name="id_categoria" id="id_categoria">
				<option value="">Qual DDD?</option>
				<?php
					$result_cat_post = "SELECT * FROM pkg_ddd ORDER BY nome_ddd ASC";
					$resultado_cat_post = mysqli_query($conn, $result_cat_post);
					while($row_cat_post = mysqli_fetch_assoc($resultado_cat_post) ) {
						echo '<option value="'.$row_cat_post['id'].'">'.$row_cat_post['nome_ddd'].'</option>';
					}
				?>
			</select>
			
			<span class="carregando">Sem Número no DDD escolhido...</span>
			<select name="id_did" id="id_did">
				<option value=""></option>
			</select><br><br>
			
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
					$.getJSON('sub_categorias_post.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
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
		
	</body>
</html>