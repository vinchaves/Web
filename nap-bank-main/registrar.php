<?php
require_once (__DIR__ . "/utils/sessao.php");
if (!empty(adquirir_usuario())) {
  header("Location: perfil.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="static/css/cadastro/cadastro.css" />
  <link rel="stylesheet" href="static/css/lib/bootstrap.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="static/css/geral.css">
  <link href="https: //fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet" />
  <title>Registrar NAP</title>
</head>

<body>
  <div class="container container-corpo">

    <div class="modal fade" id="janela" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              Atenção.
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" role="alert" id="alert-erro">
              Senhas nao coincidem!
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="corpo rounded-lg">
      <div id="menu">
        <h2 id="h2">Cadastro</h2>
      </div>
      <form id="form-registro" class="grid">
        <div class="row">
          <div class="form-group col-sm-5">
            <label for="apelido">Usuario</label>
            <input name="apelido" type="text" class="form-control" placeholder="Usuario" />
          </div>
          <div class="form-group col-sm-5">
            <label for="email">Email</label>
            <input required name="email" type="email" class="form-control" placeholder="Digite seu email" />
          </div>
          <div class="form-group col-sm-5">
            <label for="nome">Nome</label>
            <input name="nome" type="text" class="form-control" placeholder="Digite seu nome" />
          </div>
          <div class="form-group col-sm-5">
            <label for="senha">Senha</label>
            <input required name="senha" type="password" class="form-control" placeholder="Senha" />
          </div>
        </div>
        <div class="row">
          <div class="form-group col-sm-5">
            <label for="senha_confirmar">Confimar Senha</label>
            <input required name="senha_confirmar" type="password" class="form-control"
              placeholder="Confirmar sua senha" />
          </div>
          <div class="form-group col-sm-5">
            <label for="cpf">CPF</label>
            <input name="cpf" type="text" id="cpf" class="form-control" placeholder="000.000.000-00" />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-sm-5">
            <label for="data_nascimento">Data de Nascimento</label>
            <input name="data_nascimento" type="date" class="form-control" />
          </div>

        </div>
        <div class="row row-login">

          <a href="entrar.php">Ja tem uma conta? Fazer Login</a>
          <button id="botao" type="submit" class="btn btn-primary">
            Registra
          </button>

        </div>
      </form>
    </div>
  </div>
  <script src="static/js/lib/jquery.js"></script>
  <script src="static/js/lib/bootstrap.js"></script>
  <script src="static/js/registrar.js"></script>
</body>

</html>