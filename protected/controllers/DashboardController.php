<?php
require_once("api/config/config.php");
$result = mysqli_query($conn, "SELECT * FROM pkg_configuration WHERE id='5'");
while($rows = mysqli_fetch_assoc($result)){
    $url = $rows['config_value'];
}
$username=Yii::app()->session['username'];

$result_nome = mysqli_query($conn, "SELECT * FROM pkg_user WHERE username='".$username."'");
while($rows = mysqli_fetch_assoc($result_nome)){
    $id_group = $rows['id_group'];
}

?>
<iframe width="100%" height="100%" src="https://<?php 
if ($id_group < "4"){echo($url);?>/dashboard/admin.php?user=<?php echo($username);}else{echo($url);?>/dashboard/client.php?user=<?php echo($username);} ?>" 
    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; 
    gyroscope; picture-in-picture" allowfullscreen></iframe>

<?php
class DashboardController extends Controller{
    public $attributeOrder = 't.id';
    public function actionIndex(){
    }
}