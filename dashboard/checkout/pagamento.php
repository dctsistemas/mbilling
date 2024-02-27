<?php include('config/conecta.php');?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
$( document ).ready(function() {
    var tempo = 5000; //Cinco segundos

    (function selectNumUsuarios () {
        $.ajax({
          url: "https://<?php echo $host;?>/status.php?id=<?php echo $_GET['id'];?>",
          success: function (n) {
              //essa é a function success, será executada se a requisição obtiver exito
              $("#status").html(n);
          },
          complete: function () {
              setTimeout(selectNumUsuarios, tempo);
          }
       });
    })();
});
</script>

<span id="status"></span>
<div class="row container">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="border: 1px solid #ccc; border-radius: 10px; padding: 15px;">
        <center>
        <h1 style="color: black; font-size: 35px;" id="countdown"></h1>
        <b style="color: green; font-size: 16px;">Pagar com PIX</b><br>
        <span style="color: black; font-size: 17px;">Total a pagar: </span><b style="color: green; font-size: 19px;">R$ <?php echo number_format($valor,2,",",".");?></b>
        <br>
        <img style='display:block; width: 50%;' id='base64image' src='data:image/jpeg;base64, <?php echo $qrcode;?>' />
        <input type="text" class="form-control" id="linhapix" value="<?php echo $linha;?>" readonly>
        <button class="btn btn-success" style="width:100%; font-size: 16px;" onclick="copiarTexto()">Copiar</button>
        <b style="color: green; font-size: 14px;">Ambiente seguro 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
            </svg>
        </b>
        </center>
    </div>
</div>
</script>
<script>
    function copiarTexto() {
      // Seleciona o campo de entrada de texto
      var campoDeTexto = document.getElementById("linhapix");
    
      // Seleciona o texto no campo de entrada de texto
      campoDeTexto.select();
      campoDeTexto.setSelectionRange(0, 99999); // Para dispositivos móveis
    
      // Copia o texto para a área de transferência
      document.execCommand("copy");
    
      // Exibe a janela de confirmação com Swal.fire
      Swal.fire({
        icon: 'success',
        title: 'Linha do pix',
        text: 'Copiada com sucesso!',
      });
    }
</script>
</body>
</html>