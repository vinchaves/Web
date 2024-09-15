<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../static/css/depTrans.css" />
  <link rel="stylesheet" href="../static/css/menu.css">
  <link rel="stylesheet" href="../static/css/transferencia/tran.css" />
  <link rel="stylesheet" href="../static/css/lib/bootstrap.css" />
  <link rel="stylesheet" href="../static/css/geral.css">
  <title>Transferencia</title>
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
          <h2 id="titulo">Transfêrencia</h2>
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
          <div class="logo">
            <div class="traco"></div>
            <div class="traco"></div>
            <div class="traco"></div>
          </div>
        </div>
      </header>

      <form class="grid" id="form-transferir">
        <div class="d-flex " style="gap:50px">

          <div>
            <input class="radio-tipo" type="radio" name="tipo" id="ted-checkbox" checked value="TED">
            <label for="TED">TED</label>
            <input class="radio-tipo" type="radio" name="tipo" id="pix-checkbox" value="PIX">
            <label for="pix">PIX</label>
          </div>
          <div>
            <input type="checkbox" name="externa" id="externa-checkbox">
            <label for="externa">Transferencia Externa</label>
          </div>


        </div>

        <div id="row-externo" class="row justify-content-between ">
          <div class="col-lg-3">
            <div class="form-group">
              <label for="banco">Banco</label>
              <input id="banco" name="banco" type="text" class="form-control" placeholder="000-1" />
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="agencia">Agência</label>
              <input id="agencia" name="agencia" type="text" class="form-control" placeholder="0000-2" />
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="conta">Conta</label>
              <input id="conta" name="conta" type="text" class="form-control" placeholder="0000-33" />
            </div>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-3" id="container-chave">
            <div class="form-group">
              <label for="chave">Chave</label>
              <input name="chave" id="chave" type="text" class="form-control" placeholder="chave pix" />
            </div>
          </div>
          <div class="col-lg-3" id="container-cpf">
            <div class="form-group">
              <label for="cpf">CPF</label>
              <input name="cpf" id="cpf" type="text" name="cpf" class="form-control" placeholder="123.456.789-10" />
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="data">Data</label>
              <input name="data" id="data" type="date" class="form-control" />
            </div>
          </div>
          <div class="col-lg-3">
            <div class="form-group">
              <label for="valor">Valor</label>
              <input name="valor" id="valor" type="text" class="form-control" placeholder="R$0,00"
                onkeyup="mascara(this)" />
            </div>
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-3">
            <div class="form-group">
              <label>Tipo de conta</label><br /><br />
              <div>
                <input name="rad" id="radio1" type="radio" />
                <label for="radio1">Corrente</label>
              </div>
              <div>
                <input name="rad" id="radio2" type="radio" />
                <label for="radio2">Poupança</label>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-group">
              <textarea cols="65" rows="6" placeholder="Resumo" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <button class="button-6 rounded">
          Transferência
        </button>
      </form>



    </div>
  </div>

  <script type="text/javascript" src="../static/js/lib/jquery.js"></script>
  <script type="text/javascript" src="../static/js/lib/bootstrap.js"></script>
  <script src="../static/js/transferencia.js"></script>

  <script src="../static/js/deptrans.js"></script>
  <script src="../static/js/menu.js"></script>

</body>


</html>