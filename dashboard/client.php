<?php
include_once("../api/config/config.php");
include_once("../api/config/config.php");
include_once("../api/novo_cliente/magnusBillingAPI.php");

$magnusBilling             = new MagnusBilling('21232f297a57a5a743894a0e4a801fc2', '21232f297a57a5a743894a0e4a801fc3');
$magnusBilling->public_url = "https://sip.skynetfibra.net.br"; // Your MagnusBilling URL

function retornar_uso_cpu(){

    $uso = sys_getloadavg();
    return $uso[0];     
}


// SELECIONANDO OS PARCEIROS
$plataformas = mysqli_query($conn, "SELECT * FROM pkg_group_user WHERE name = '".$_GET['user']."_CLIENT'");
while($rows_plataforma = mysqli_fetch_assoc($plataformas)){

// QUANTIDADE DE CLIENTES
$result_users = mysqli_query($conn, "SELECT * FROM pkg_user WHERE id_group = '".$rows_plataforma['id']."'");
$num_rows_users = mysqli_num_rows($result_users);
while($rows_user = mysqli_fetch_assoc($result_users)){


// QUANTIDADE DE SIPs
$result_sip = mysqli_query($conn, "SELECT * FROM pkg_sip WHERE id_user = '".$rows_user['id']."'");
$num_rows_sip += mysqli_num_rows($result_sip);



// QUANTIDADE DE DID RESERVADOS
$result_did_reser = mysqli_query($conn, "SELECT * from pkg_did WHERE reserved = '1' AND id_user = '".$rows_user['id']."'");
$num_rows_did_reser += mysqli_num_rows($result_did_reser);




}

}
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
</script>

<script>
function pix($id) {
    Swal.fire({
      html: '<iframe scrolling="no" style="overflow-y: hidden; height: 400px; width: 400px;" src="https://sip.skynetfibra.net.br/dashboard/checkout/gerar_update_pix.php?id='+$id+'"</iframe>',
        confirmButtonText: "Ok, Fechar!",
        confirmButtonColor: "#3085d6",
      }).then((result) => {
  if (result) {
    window.location.reload()}
  });
}
</script>

<script>
function excluir_fat($id) {
  Swal.fire({
    title: "Tem certeza?",
  text: "Que eseja realmente excluir esta fatura?",
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

<body class="g-sidenav-show  bg-gray-200">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-4 col-sm-6 mb-xl-0 mb-4">
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
        <div class="col-md-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">phone_forwarded</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">contas SIP</p>
                <h4 class="mb-0"><?php echo($num_rows_sip); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Clientes</p>
                <h4 class="mb-0"><?php echo($num_rows_users); ?></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
          </div>
        </div>
      </div>
      <br />

          <div class="col-lg-12 col-md-6">
          <div class="card h-100">
            <div class="card-header pb-0">
              <h6>Faturas</h6>
              <p class="text-sm">
              </p>
              </div>

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
                            $pix = mysqli_query($conn, "SELECT * FROM pkg_checkout WHERE doc = '".$_GET['user']."'");
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
                       <td>
                            <a href="#" onclick="pix('<?php echo($rows_pix['id'])?>')" id=""><img width="55" height="19" decoding="async" src="assets/img/PIX.png" class="payment-method__icon"></a>
                      </td> 
                      <?php
                       }
                       else{ ?>
                          <td>
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
