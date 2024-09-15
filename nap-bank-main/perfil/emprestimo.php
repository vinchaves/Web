<!DOCTYPE html>
<html lang="PT-BR">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Emprestimo</title>
  <link rel="stylesheet" href="../static/css/emprestimo.css" />
  <link rel="stylesheet" href="../static/css/lib/bootstrap.css">
  <link rel="stylesheet" href="../static/css/menu.css">
  <link rel="stylesheet" href="../static/css/geral.css">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container container-corpo">
    <div class="corpo rounded-lg">
      <header class="menu">
        <div class="esquerda">
          <h2 id="h2">Emprestimos</h2>
        </div>
        <div class="direita">
          <div id="mySidenav" class="sidenav rounded-lg">
            <a href="javascript:void(0)" class="closebtn">&times;</a>
            <a class="active" href="index.php">Perfil</a>
            <a href="transferencia.php">Transferência</a>
            <a href="deposito.php">Deposito</a>
            <!-- <a href="emprestimo.php">Emprestimo</a> -->
            <a href="historico.php">Historico</a>

            <!-- <a href="#">Cartões</a> -->
            <!-- <a href="pix.php">PIX</a> -->
            <a href="javascript:void(0)" id="botao-sair">Sair</a>
          </div>
          <div class="logo" onclick="openNav()">
            <div class="traco"></div>
            <div class="traco"></div>
            <div class="traco"></div>
          </div>
        </div>
      </header>

      <p>
        Pegue um emprestimo na sua conta <span class="roxo"><b>NAP</b></span>
      </p>

      <form class="grid">
        <div id="input_box" class="row">
          <div class="input-field col-sm-3  form-group">
            <label for="value" class="label-input">Valor:</label>
            <input type="text" id="value" class="form-control" onkeyup="mascara(this)" placeholder="Digite o valor" />
          </div>

          <div class="input-field col-sm-3 form-group">
            <label for="fee" class="label-input">Parcelas:</label>
            <input type="number" id="fee" min="1" max="12" class=" form-control" placeholder="Até 12 meses" />
          </div>

          <p>Você passará a ter um emprestimo no valor total de<span class="vermelho" id="total"> R$ 0,00 </span></p>

          <button class="button col-sm-3" role="button" type="button" data-toggle="modal" data-target="#janela"
            id="calculate">Emprestimo</button>

        </div>
      </form>
      <div class="modal fade" id="janela" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">
                Transferência
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success" role="alert">
                Emprestimo realizado com sucesso!
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script type="text/javascript" src="../static/js/emprestimo.js"></script>
  <script src="../static/js/lib/jquery.js"></script>
  <script src="../static/js/lib/bootstrap.js"></script>
  <script src="../static/js/menu.js"></script>
</body>

</html>