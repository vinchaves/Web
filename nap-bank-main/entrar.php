<?php
require_once (__DIR__ . "/utils/sessao.php");
if (!empty(adquirir_usuario())) {
  header("Location: perfil/index.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="static/css/login/login.css" />
  <link rel="stylesheet" href="static/css/lib/bootstrap.css" />
  <link rel="stylesheet" href="static/css/geral.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https: //fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet" />
  <title>Entrar NAP</title>
</head>

<body>

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
            Usuário ou Senha Inválido!
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="main">
    <form id="form-entrar">
      <h2 id="titulo">Entrar</h2>
      <div class="form-group">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Digite seu email" />
      </div>
      <div class="form-group">
        <label for="senha">Senha</label>
        <input name="senha" type="password" class="form-control" id="senha" placeholder="Digite sua senha" />
      </div>
      <div id="mover">
        <a id="a" href="registrar.php">Fazer Cadastro</a>
        <button id="button" class="btn btn-primary">Enviar</button>
      </div>
    </form>
  </div>
  <script src="static/js/lib/jquery.js"></script>
  <script src="static/js/lib/bootstrap.js"></script>
  <script src="static/js/entrar.js"></script>
</body>

</html>