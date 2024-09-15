<?php
require_once (__DIR__ . "/../utils/sessao.php");
$usuario = adquirir_usuario();
$chave = Database::chave()->buscar_usuario($usuario["id_usuario"]);
if (empty($usuario)) {
  header("Location: ../entrar.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/css/lib/bootstrap.css" />
  <link rel="stylesheet" href="../static/css/perfil.css" />
  <link rel="stylesheet" href="../static/css/menu.css">
  <title>Perfil</title>
  <script>
    const perfilUsuario = <?php echo json_encode($usuario) ?>;
  </script>
</head>

<body>
  <div class="container container-corpo">
    <div class="corpo rounded-lg">
      <div id="imagemRoxa" class=""></div>
      <header class="menu">
        <div id="mySidenav" class="sidenav rounded-lg">
          <a href="javascript:void(0)" class="closebtn">&times;</a>
          <a class="active" href="#">Perfil</a>
          <a href="transferencia.php">Transferência</a>
          <a href="deposito.php">Deposito</a>
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
      </header>
      <section class="grid">
        <div class="row">
          <div id="foto-perfil" class="col-md-4">
            <img id="imgPerfil" src="../static/img/perfil/perfil-de-usuario.png" alt="" />
          </div>
          <div id="info-perfil" class="col-md">
            <div id="info-nome" class="row-md">
              <h3><?php echo $usuario["nome_usuario"] ?></h3>
              <h6><?php echo $usuario["email_usuario"] ?></h6>
              <h6><?php echo $usuario["cpf_usuario"] ?></h6>
              <?php
              if ($chave !== false) {
                echo '<h6>pix:' . $chave["chave"] . '</h6>';
              }
              ?>


            </div>
            <div id="info-conta" class="row-md-6">
              <div class="col-md-3">
                <h4>Agência</h4>
                <h5>0001</h5>
              </div>
              <div class="col-md-3">
                <h4>Conta</h4>
                <h5>0000-33</h5>
              </div>
            </div>
            <div id="info-valores" class="row">
              <div id="info-saldo" class="col-md-5 rounded-lg">
                <h5>Saldo</h5>
                <div class="baixo">
                  <label id="sal">●●●●●</label>
                  <button id="btnSaldo" class="button-6 md rounded" role="button" type="button" data-toggle="modal"
                    data-target="#janela" style="margin: 0">
                    Mostrar
                  </button>
                </div>
              </div>


            </div>
          </div>
        </div>
        <div id="rowBaixo" class="row">
          <div class="row">
            <h3 class="col-md" id="acoes">Ações Rápidas</h3>
          </div>
          <div id="botoesAcoes" class="row">
            <a href="transferencia.php" id="btnAcoes" class="button-6 col-md rounded">
              <img class="icone-botao" src="../static/img/perfil/transfer.svg" alt="" />
              Transferência
            </a>
            <a href="pix.php" id="btnAcoes" class="button-6 col-md rounded">
              <img class="icone-botao" src="../static/img/perfil/pay.svg" />Área PIX
            </a>
            <a href="deposito.php" id="btnAcoes" class="button-6 col-md rounded">
              <img class="icone-botao" src="../static/img/perfil/deposit.svg" />Depósito
            </a>
            <a href="emprestimo.php" id="btnAcoes" class="button-6 col-md rounded">
              <img class="icone-botao" src="../static/img/perfil/empres.svg" />Empréstimos
            </a>
            <!-- <a id="btnAcoes" class="button-6 col-md rounded">
              <img class="icone-botao" src="static/img/perfil/credit-card.svg" />Cartões
            </a> -->
          </div>
        </div>
      </section>
    </div>
  </div>

  <script src="../static/js/lib/jquery.js"></script>
  <script src="../static/js/lib/bootstrap.js"></script>
  <script src="../static/js/perfil.js"></script>
  <script src="../static/js/menu.js"></script>
</body>

</html>