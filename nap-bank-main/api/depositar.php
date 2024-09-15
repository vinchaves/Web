<?php
include_once (__DIR__ . "/../db/database.php");
include_once (__DIR__ . "/../utils/sessao.php");
include_once (__DIR__ . "/../utils/msg.php");
include_once (__DIR__ . "/../utils/pix.php");


$usuario = adquirir_usuario();
if (!isset($usuario)) {
    echo criar_erro("Nao autorizado, faca login antes de usar essa funcionalidade");
    die();
}

if (!isset($_POST["valor"])) {
    echo criar_erro("Voce precisa definir um valor para gerar pix");
    die();
}

$valor = $_POST["valor"];
if (!is_numeric($valor)) {
    echo criar_erro("Valor deve ser um numero!");
    die();
}
if ($valor <= 0) {
    echo criar_erro("Valor deve ser maior que R$0!");
    die();
}

$chaves = Database::chave()->buscar_usuario($usuario["id_usuario"]);
if ($chaves === false) {
    Database::chave()->criar($usuario["id_usuario"], null);
}

$chave = Database::chave()->buscar_usuario($usuario["id_usuario"]);
// echo json_encode($chave);
// echo json_encode(geraPix($chave["chave"], "", $valor));
Database::historico_transferencia()->criar_interna(null, $usuario["id_usuario"], $usuario["cpf_usuario"], $valor, null, null);
Database::usuario()->atualizar_saldo($usuario["id_usuario"], $usuario["saldo"] + $valor);
echo criar_sucesso("Deposito de R$" . $valor . " efetuado com sucesso!");