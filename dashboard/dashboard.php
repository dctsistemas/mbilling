<?php
include_once("../api/config/config.php");
include_once("../api/novo_cliente/magnusBillingAPI.php");

$magnusBilling             = new MagnusBilling('21232f297a57a5a743894a0e4a801fc2', '21232f297a57a5a743894a0e4a801fc3');
$magnusBilling->public_url = "https://sip.skynetfibra.net.br"; // Your MagnusBilling URL


// SELECIONANDO OS PARCEIROS
$plataformas = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE id_user_type = 1 AND id > 9");
$ulti_cli = mysqli_query($conn, "SELECT * FROM pkg_user WHERE id_plan > 0 ORDER BY id DESC LIMIT 8");


// QUANTIDADE DE DID RESERVADOS
$result_did_reser = mysqli_query($conn, "SELECT * from pkg_did WHERE reserved = '1'");
$num_rows_did_reser = mysqli_num_rows($result_did_reser);


// QUANTIDADE DE DID DISPONIVEL
$result_did_dispon = mysqli_query($conn, "SELECT * from pkg_did WHERE reserved = '0'");
$num_rows_did_dispon = mysqli_num_rows($result_did_dispon);


// QUANTIDADE DE SIPs
$result_sip = mysqli_query($conn, "SELECT * FROM pkg_sip");
$num_rows_sip = mysqli_num_rows($result_sip);


// QUANTIDADE DE CLIENTES
$result_users = mysqli_query($conn, "SELECT * FROM pkg_user WHERE id_plan > 0");
$num_rows_users = mysqli_num_rows($result_users);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
  </title>
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  <link rel="stylesheet" href="assets/css/datatables.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">


</head>


<script>
function nova_fat($id) {
    Swal.fire({
      width: 410,
      showCloseButton: true,
      showConfirmButton: false,

      html: '<iframe scrolling="no" style="overflow-y: hidden;  height: 400px; width: 345px;" src="https://sip.skynetfibra.net.br/dashboard/nova_fat_avulsa.php"</iframe>',
      }).then((result) => {
  if (result) {
    window.location.reload()}
  });
}
function config($id) {
    Swal.fire({
      width: 700,
      showCloseButton: true,
      showConfirmButton: false,

      html: '<iframe scrolling="no" style="overflow-y: hidden;  height: 410px; width: 635px;" src="https://sip.skynetfibra.net.br/dashboard/config_checkout.php"</iframe>',
      }).then((result) => {
  if (result) {
    window.location.reload()}
  });
}
</script>

<script>
function zap($id) {
  Swal.fire({
    showCloseButton: true,
    title: "Tem certeza?",
    confirmButtonText: "Sim, Exclui!",

  text: "Que deseja realmente enviar esta fatura?",
  icon: "warning",
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Sim, Envia!",
  cancelButtonText: "Cancelar",
  showCancelButton: true
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      showCloseButton: true,
      showConfirmButton: false,
      html: '<iframe scrolling="no" style="overflow-y: hidden; height: 400px; width: 400px;" src="https://sip.skynetfibra.net.br/dashboard/sendWhatsManual.php?id_fat='+$id+'"</iframe>',
    });
    setInterval(function(){ tr.hide(); }, 3000);
  }
});
}
</script>






<script>
function pix($id) {
    Swal.fire({
      html: '<iframe scrolling="no" style="overflow-y: hidden; height: 400px; width: 400px;" src="https://sip.skynetfibra.net.br/dashboard/checkout/gerar_update_pix.php?id='+$id+'"</iframe>',
        confirmButtonText: "Ok, Fechar!",
        confirmButtonColor: "#3085d6",
      }).then((result) => {
  if (result.isConfirmed) {
    window.location.reload()}
  });
}
</script>

<script>
function excluir_fat($id) {
  Swal.fire({
    title: "Tem certeza?",
  text: "Que deseja realmente excluir esta fatura?",
  icon: "warning",
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Sim, Exclui!",
  cancelButtonText: "Cancelar",
  showCancelButton: true
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      showConfirmButton:false,
      title: "Excluido!",
      html: '<iframe style="height: 20px;" src="https://sip.skynetfibra.net.br/dashboard/checkout/excluir.php?id='+$id+'"</iframe>',
      icon: "success"
    });
    setInterval(function(){ window.location.reload() }, 1000);
  }
});
}
</script>




<script>
function ativaCliente($nome) {
  Swal.fire({
    title: "Tem certeza?",
  text: "Deseja realmente desbloquear esse usuário?",
  icon: "warning",
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Sim, Desbloqueia!",
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Desbloqueado!",
      html: '<iframe style="height: 20px;" src="https://sip.skynetfibra.net.br/dashboard/desbloq_user.php?username='+$nome+'"</iframe>',
      icon: "success"
    });
    setInterval(function(){ window.location.reload() }, 1000);
  }
});
}

</script>
<script language="javascript" type="text/javascript">
function bloqueiaCliente($nome) {
  Swal.fire({
  title: "Tem certeza?",
  text: "Deseja realmente bloquear esse usuário?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  cancelButtonText: "Cancelar",
  confirmButtonText: "Sim, Bloqueia!"
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire({
      title: "Bloqueado!",
      html: '<iframe style="height: 20px;" src="https://sip.skynetfibra.net.br/dashboard/bloq_user.php?username='+$nome+'"</iframe>',
      icon: "success"
    });
    setInterval(function(){ window.location.reload() }, 1000);
    
  }
});
}
</script>

<body class="g-sidenav-show  bg-gray-200" >
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
            <li class="nav-item d-flex align-items-center">
            <a href="#" onclick="config('<?php echo($rows_pix['id'])?>')">
              <i style="font-size:26px; color:black;" class="material-icons py-2">settings</i>
            </a>



          </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">phone_in_talk</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">DIDs Ativos</p>
                <h4 class="mb-0"><?php echo($num_rows_did_reser); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">phone_forwarded</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">DIDs Disponiveis</p>
                <h4 class="mb-0"><?php echo($num_rows_did_dispon); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">dialer_sip</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">contas SIP</p>
                <h4 class="mb-0"><?php echo($num_rows_sip); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Usuários</p>
                <h4 class="mb-0"><?php echo($num_rows_users); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
      </div>
      <br />
      <div class="row mb-3">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-2">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Parceiros</h6>
                  <p class="text-sm mb-0">
                </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">                  
                  </div>
                </div>
              </div>
            </div>
            <div style="height: 400px;" class="card-body px-2 pb-2">
              <div class="table-responsive">
                <table  id="parceiros" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CPF/CNPJ</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome / Raz. Social</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Clientes Cadastrados</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <?php
                      		while($rows_plat = mysqli_fetch_assoc($plataformas)){
                            $user = mysqli_query($conn, "SELECT * FROM pkg_user WHERE username = '".$rows_plat['name']."'");
                            while($rows_user = mysqli_fetch_assoc($user)){
                            
                            ?>

<?php
                      // CODIGO DOS STATUS COM CORES CORRESPONDENTES
                      if($rows_user['active'] === '1'){
                        ?>
                        <td style=" background-color:#04ff0042;">

                        <h6 class="mb-0 text-sm"><?php echo($rows_user['username'])?></h6>

                      </td>

                      <?php }

                      else if($rows_user['active'] === '2'){
                        ?>
                        <td style=" background-color:#ddb833a1;" >
                        <h6 class="mb-0 text-sm"><?php echo($rows_user['username'])?></h6>
                      </td>

                      <?php }



                      else{
                        ?>
                        <td style=" background-color:#ff2f0042;">
                        <h6 class="mb-0 text-sm"><?php echo($rows_user['username'])?></h6>

                      </td>

                      <?php } ?>
                      <?php
                      // CODIGO DOS STATUS COM CORES CORRESPONDENTES
                      if($rows_user['active'] === '1'){
                        ?>
                        <td style=" background-color:#04ff0042;">

                        <h6 class="mb-0 text-sm"><?php echo($rows_user['firstname'])?></h6>

                      </td>

                      <?php }

                      else if($rows_user['active'] === '2'){
                        ?>
                        <td style=" background-color:#ddb833a1;" >
                        <h6 class="mb-0 text-sm"><?php echo($rows_user['firstname'])?></h6>
                      </td>

                      <?php }



                      else{
                        ?>
                        <td style=" background-color:#ff2f0042;">
                        <h6 class="mb-0 text-sm"><?php echo($rows_user['firstname'])?></h6>

                      </td>

                      <?php } ?>


                    
                      <?php
                      // CODIGO DOS STATUS COM CORES CORRESPONDENTES
                      if($rows_user['active'] === '1'){
                        ?>
                        <td style="text-align:center; background-color:#04ff0042;">

                        <?php
                          $sql_pl = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$rows_user['username']."_CLIENT'");
                          while($rows_pla = mysqli_fetch_assoc($sql_pl)){
                          
                        $sql_sip="SELECT COUNT(id) AS qtdRegistros FROM pkg_user WHERE id_group = '".$rows_pla['id']."'";
                        $qdt_sip = $conn->query( $sql_sip )->fetch_object()->qtdRegistros;
                        ?>

                        <h6 class="mb-0 text-sm"><?php echo ($qdt_sip)?></h6>
                      </td>

                      <?php }}

                      else if($rows_user['active'] === '2'){
                        ?>
                        <td style="text-align:center; background-color:#ddb833a1;" >

                        <?php
                          $sql_pl = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$rows_user['username']."_CLIENT'");
                          while($rows_pla = mysqli_fetch_assoc($sql_pl)){
                          
                        $sql_sip="SELECT COUNT(id) AS qtdRegistros FROM pkg_user WHERE id_group = '".$rows_pla['id']."'";
                        $qdt_sip = $conn->query( $sql_sip )->fetch_object()->qtdRegistros;
                        ?>

                        <h6 class="mb-0 text-sm"><?php echo ($qdt_sip)?></h6>



                      </td>

                      <?php }}



                      else{
                        ?>
                        <td style="text-align:center; background-color:#ff2f0042;">

                        <?php
                          $sql_pl = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$rows_user['username']."_CLIENT'");
                          while($rows_pla = mysqli_fetch_assoc($sql_pl)){
                          
                        $sql_sip="SELECT COUNT(id) AS qtdRegistros FROM pkg_user WHERE id_group = '".$rows_pla['id']."'";
                        $qdt_sip = $conn->query( $sql_sip )->fetch_object()->qtdRegistros;
                        ?>

                        <h6 class="mb-0 text-sm"><?php echo ($qdt_sip)?></h6>
                      </td>

                      <?php }} ?>

                      <?php
                      // CODIGO DOS STATUS COM CORES CORRESPONDENTES
                      if($rows_user['active'] === '1'){
                        ?>

                      <?php }

                      else if($rows_user['active'] === '2'){
                        ?>
                        <td style="text-align:center; background-color:#ddb833a1;" >

                      </td>



<?php }



                      else{
                        ?>


                      <?php } ?>








                      <?php
                      // CODIGO DOS STATUS COM CORES CORRESPONDENTES
                      if($rows_user['active'] === '1'){
                        ?>
                        <td style="text-align:center; background-color:#04ff0042;">

                        <button onclick="bloqueiaCliente('<?php echo($rows_user['username'])?>')" class="icon-cart" style="background: #f44335; color: #fff; border: none; border-radius: 0.14cm; width: 75px; height: 22px; font-size: 11px;">Bloquear</button>

                      </td>

                      <?php }

                      else if($rows_user['active'] === '2'){
                        ?>
                        <td style="text-align:center; background-color:#ddb833a1;" >
                        <button onclick="bloqueiaCliente('<?php echo($rows_user['username'])?>')" class="icon-cart" style="background: #f44335; color: #fff; border: none; border-radius: 0.14cm; width: 75px; height: 22px; font-size: 11px;">Bloquear</button>
                      </td>

                      <?php }



                      else{
                        ?>
                        <td style="text-align:center; background-color:#ff2f0042;">
                        <button onclick="ativaCliente('<?php echo($rows_user['username'])?>')" class="icon-cart" style="background: #2ecc71; color: #fff; border: none; border-radius: 0.14cm; width: 75px; height: 22px; font-size: 11px;">Desbloquear</button>

                      </td>

                      <?php } ?>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>



<br>
</div>

          <div class="col-lg-8 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Faturas</h6>
              <p class="text-sm">
              </p>
              </div>
              <button onclick="nova_fat('<?php echo($rows_user['username'])?>')" class="btn btn-success icon-cart" style="margin-left:15px; margin-top: 19px;  color: #fff; border: none; border-radius: 0.14cm; width: 75px; height: 28px; font-size: 11px;">+ Inserir</button>

              <div style="height: 370px;" class="card-body px-2 pb-2">
              <div class="table-responsive">

                <table  id="faturas" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CPF/CNPJ</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vencimento</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Valor R$</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                            $pix = mysqli_query($conn, "SELECT * FROM pkg_checkout");
                            while($rows_pix = mysqli_fetch_assoc($pix)){
                    ?>
                    <tr>
                  <td style=" ">
                        <h6 class="mb-0 text-sm"><?php echo($rows_pix['doc']);?></h6>
                      </td>
                      <td style=" ">
                      <h6 class="mb-0 text-sm"><?php echo($rows_pix['vencimento']);?></h6>
                      </td>
                      <td style=" ">
                      <h6 class="mb-0 text-sm"><?php echo('R$ ' . $rows_pix['valor']);?></h6>
                      </td>
                      <?php
                       if($rows_pix['status'] == 'pendente'){?>
                                             <td ><h6 style="color:red;" class="mb-0 text-sm">Pendente</h6>
                      </td>
                      <?php
                       }
                       else{ ?>
                          <td><h6 style="color:green;" class="mb-0 text-sm">Pago</h6>
                      </td>
                      <?php
                       }?>  

                      <?php
                       if($rows_pix['status'] == 'pendente'){                
                        ?>
                       <td style="text-align:right;">
                          <a href="#" onclick="zap('<?php echo($rows_pix['id'])?>')" id=""><img width="19" height="19" decoding="async" src="https://www.svgrepo.com/show/217789/whatsapp.svg" class="payment-method__icon"></a>
                          <a href="#" onclick="baixar('<?php echo($rows_pix['id'])?>')" id=""><img width="19" height="19" decoding="async" src="https://cdn.icon-icons.com/icons2/3923/PNG/512/payment_business_bill_invoice_icon_250218.png" class="payment-method__icon"></a>
                          <a href="#" onclick="excluir_fat('<?php echo($rows_pix['id'])?>')" id=""><img width="19" height="19" decoding="async" src="https://cdn-icons-png.flaticon.com/512/3625/3625005.png" class="payment-method__icon"></a>
                      </td> 
                      <?php
                       }
                       else{ ?>
                          <td style="text-align:right;">
                          <img width="19" height="19" decoding="async" src="https://www.crmv.am.gov.br/wp-content/uploads/2018/07/Fundo-transparente-1900x1900-1.png" class="payment-method__icon">
                          <img width="19" height="19" decoding="async" src="https://www.crmv.am.gov.br/wp-content/uploads/2018/07/Fundo-transparente-1900x1900-1.png" class="payment-method__icon">
                          <img width="19" height="19" decoding="async" src="https://www.crmv.am.gov.br/wp-content/uploads/2018/07/Fundo-transparente-1900x1900-1.png" class="payment-method__icon">
                          <a href="#" onclick="excluir_fat('<?php echo($rows_pix['id'])?>')" id=""><img width="19" height="19" decoding="async" src="https://cdn-icons-png.flaticon.com/512/3625/3625005.png" class="payment-method__icon"></a>

                      </td>
                      <?php
                       }?>


                      </tr>
                      <?php }?>
                      
                  </tbody>
                </table>
              </div>
            </div>
          </div>
                      </div>
        
          <div class="col-lg-4 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Últimos Clientes</h6>
              <p class="text-sm">
              </p>
            </div>
            <div class="card-body p-3">
            <?php while($rows_cli = mysqli_fetch_assoc($ulti_cli)){ ?>
              <div class="timeline timeline-one-side">
                  <span class="timeline-step">
                    <i class="material-icons text-dark text-gradient">contact_phone</i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0"><?php echo($rows_cli['firstname'])?></h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php 
                    
                    $dia = substr($rows_cli['creationdate'],8,2);
                    $mes = substr($rows_cli['creationdate'],5,2);
                    $ano = substr($rows_cli['creationdate'],0,4);
                    $hora = substr($rows_cli['creationdate'],-8);
                    $data = $dia."/".$mes."/".$ano." as ".$hora;

                    echo($data)?>
                    
                  </p>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </main>


  <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/custom.js"></script>


<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>



</body>
</html>
