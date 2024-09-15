<?php

require_once (__DIR__ . "/../utils/msg.php");
require_once (__DIR__ . "/../db/database.php");
require_once (__DIR__ . "/../utils/sessao.php");


if (!isset($_POST["email"]) || !isset($_POST["senha"]) || !isset($_POST["senha_confirmar"]) || !isset($_POST["apelido"]) || !isset($_POST["nome"]) || !isset($_POST["cpf"]) || !isset($_POST["data_nascimento"]))
    return;

$email = $_POST["email"];
$senha = $_POST["senha"];
$senha_confirmar = $_POST["senha_confirmar"];
$apelido = $_POST["apelido"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$data_nascimento = $_POST["data_nascimento"];

// checar se existe email registrado ok
// se nao tiver registrado usuario com este email, dar hash na senha, guardar o email e o hash da senha no db
// atualizar a sessao trocando o id do usuario para o registrado na etapa anterior

if ($senha != $senha_confirmar) {
    echo criar_erro("As senhas nao sao iguais");
    return;
}

$resultado = Database::usuario()->buscar_email($email);
if ($resultado) {
    echo criar_erro("Ja existe um usuario com este email");
    return;
}

$hash_senha = password_hash($senha, PASSWORD_DEFAULT);

Database::usuario()->inserir($email, $hash_senha, $apelido, $nome, $cpf, $data_nascimento, 0, 0);

$resultado = Database::usuario()->buscar_email($email);
if (!$resultado)
    return;

$sessao = adquirir_sessao();
Database::sessao()->atualizar($sessao["id_sessao"], $resultado["id_usuario"]);

echo json_encode($resultado);
?>