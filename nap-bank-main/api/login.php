<?php

require_once (__DIR__ . "/../db/database.php");
require_once (__DIR__ . "/../utils/msg.php");
require_once (__DIR__ . "/../utils/sessao.php");

echo "oi", json_encode($_POST);
if (!isset($_POST["email"]) || !isset($_POST["senha"]))
    return;


$email = $_POST["email"];
$senha = $_POST["senha"];

// Buscar o usuario pelo email
// checar se a senha enviada corresponde ao hash guardado no usuario
// caso sim, atualizar id_usuario na sessao

$resultado = Database::usuario()->buscar_email($email);

if (!$resultado) {
    echo criar_erro("Email nao existe");
    return;
}
if (!password_verify($senha, $resultado["senha_usuario"])) {
    echo criar_erro("Senha incorreta");
    return;
}

$sessao = adquirir_sessao();
Database::sessao()->atualizar($sessao["id_sessao"], $resultado["id_usuario"]);

echo "Email: " . $email . "Senha:" . $senha;
?>