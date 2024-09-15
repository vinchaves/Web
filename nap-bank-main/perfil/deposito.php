<?php
require_once (__DIR__ . "/../utils/sessao.php");
$usuario = adquirir_usuario();
if (empty($usuario)) {
  header("Location: ../login.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/css/deposito/dep.css" />
  <link rel="stylesheet" href="../static/css/depTrans.css" />
  <link rel="stylesheet" href="../static/css/lib/bootstrap.css" />
  <link rel="stylesheet" href="../static/css/menu.css">
  <link rel="stylesheet" href="../static/css/geral.css">
  <script>
    const usuario = <?php echo json_encode($usuario); ?>
  </script>

  <title>Depósito</title>
</head>

<body>
  <div class="modal fade" id="janela" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">
            Deposito
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->

        <div class="modal-body d-flex flex-column">
          <div id="modal-load" class="loader-1 center" style="width: 100%"><span></span></div>
          <svg id="modal-ok" class="svg-ok-bad" version="1.1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 130.2 130.2">
            <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1"
              cy="65.1" r="62.1" />
            <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round"
              stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
          </svg>
          <svg id="modal-bad" class="svg-ok-bad" version="1.1" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 130.2 130.2">
            <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1"
              cy="65.1" r="62.1" />
            <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round"
              stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
            <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round"
              stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
          </svg>

          <div class="d-flex flex-column align-items-center">
            <iframe id="qrcode" src="" frameborder="0" width="150"></iframe>
          </div>
          <div class="d-flex flex-column align-items-center">


            <p id="texto-modal">
              Realizando deposito...
            </p>
            <button id="modal-fechar" class="button-6 rounded botao-modal" type="button" data-dismiss="modal"
              aria-label="Close">
              Fechar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container container-corpo">
    <div class="corpo rounded-lg">
      <header class="menu">
        <div class="esquerda">
          <h2 id="titulo">Depósitar em sua conta</h2>
        </div>
        <div class="direita">
          <div id="mySidenav" class="sidenav rounded-lg">
            <a href="javascript:void(0)" class="closebtn">&times;</a>
            <a class="active" href="index.php">Perfil</a>
            <a href="transferencia.php">Transferência</a>
            <a href="#">Deposito</a>
            <!-- <a href="emprestimo.php">Emprestimo</a> -->
            <a href="historico.php">Historico</a>

            <!-- <a href="#">Cartões</a> -->
            <!-- <a href="pix.php">PIX</a> -->
            <a href="javascript:void(0)" id="botao-sair">Sair</a>
          </div>
          <div class="logo">
            <div class="traco"></div>
            <div class="traco"></div>
            <div class="traco"></div>
          </div>
        </div>
      </header>
      <form action="POST" id="form-depositar">
        <div class="row justify-content-around">
          <div class="col-lg-12">
            <div class="form-group">
              <label>Tipo de Deposito</label><br /><br />
              <input id="radio1" name="tipo" type="radio" value="pix" checked />
              <label for="radio1">PIX</label>
              <!-- <input id="radio2" name="tipo" type="radio" value="boleto" />
              <label for="radio2">Boleto</label> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="valor">Valor</label>
              <input name="valor" id="valor" type="number" step="0.01" class="form-control" placeholder="R$0,00" />
            </div>
          </div>
        </div>
        <div class="baixo">
          <!-- <div class="modal fade" id="janela" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  Deposito.
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                  Deposito não realizado!
                </div>
              </div>
            </div>
          </div>
        </div> -->
          <button class="button-6 rounded">
            Depósito
          </button>
          <p>Você passara a ter R$ <span id="novo-valor"><?php echo $usuario["saldo"] ?></span> em sua conta NAP</p>
        </div>
      </form>

    </div>
  </div>

  <script type="text/javascript" src="../static/js/lib/jquery.js"></script>
  <script type="text/javascript" src="../static/js/lib/bootstrap.js"></script>
  <script src="../static/js/deposito.js"></script>
  <script src="../static/js/deptrans.js"></script>
  <script src="../static/js/menu.js"></script>
</body>

</html>

<!--



-->