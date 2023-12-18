<?php include_once("../config/config.php");

	$id_categoria = $_REQUEST['id_categoria'];
	
	$result_sub_cat = "SELECT * FROM pkg_did WHERE reserved = 0 AND did LIKE '".$id_categoria."%' ORDER BY did ASC";
	$resultado_sub_cat = mysqli_query($conn, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$sub_categorias_post[] = array(
			'id'	=> $row_sub_cat['id'],
			'did' => utf8_encode($row_sub_cat['did']),
		);
	}
	
	echo(json_encode($sub_categorias_post));
