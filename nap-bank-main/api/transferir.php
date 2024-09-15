<?php
include_once (__DIR__ . "/../db/database.php");
include_once (__DIR__ . "/../utils/sessao.php");
include_once (__DIR__ . "/../utils/msg.php");
include_once (__DIR__ . "/../utils/pix.php");

$transferencia_externa = true;
if (isset($_POST["externa"])) {
    $transferencia_externa = false;
}

$tipo_transferencia = $_POST["tipo"];

$usuario = adquirir_usuario();
if (!isset($usuario)) {
    echo criar_erro("Nao autorizado, faca login antes de usar essa funcionalidade");
    die();
}

if (!isset($_POST["valor"])) {
    echo criar_erro("Voce precisa definir um valor valido para gerar uma transferencia!");
    die();
}
$valor = $_POST["valor"];

if (!isset($_POST["cpf"])) {
    echo criar_erro("Voce precisa definir um cpf para envio");
    die();
}
$cpf = $_POST["cpf"];

if (!isset($_POST["data"])) {
    echo criar_erro("Voce precisa definir uma data para envio");
    die();
}
$data = $_POST["data"];

if (!is_numeric($valor)) {
    echo criar_erro("Valor deve ser um numero!");
    die();
}
if ($valor <= 0) {
    echo criar_erro("Valor deve ser maior que R$0!");
    die();
}

if ($usuario["saldo"] < $valor) {
    echo criar_erro("Voce nao tem saldo suficiente, saldo disponivel: R$" . $usuario["saldo"]);
    die();
}

$destinatario = null;
if ($tipo_transferencia === "TED") {
    $destinatario = Database::usuario()->buscar_cpf($cpf);
    if (empty($destinatario) && $transferencia_externa !== false) {
        echo criar_erro("Usuario com cpf " . $cpf . " nao existe!");
        die();
    }
} else {
    $chave = Database::chave()->buscar_chave($_POST["chave"]);
    if ($chave === false) {
        echo criar_erro("Chave pix " . $_POST["chave"] . " inexistente!");
        die();
    }
    $destinatario = Database::usuario()->buscar($chave["id_usuario"]);
    if (empty($destinatario)) {
        echo criar_erro("Usuario com chave pix " . $_POST["chave"] . " nao existe!");
        die();
    }
}


Database::usuario()->atualizar_saldo($usuario["id_usuario"], $usuario["saldo"] - $valor);
if ($tipo_transferencia === "TED") {
    if ($transferencia_externa !== false) {
        if ($usuario["id_usuario"] === $destinatario["id_usuario"]) {
            echo criar_erro("Voce nao pode enviar uma transferencia para si mesmo");
            die();
        }
        Database::usuario()->atualizar_saldo($destinatario["id_usuario"], $destinatario["saldo"] + $valor);
        echo criar_sucesso("Voce transferiu R$" . $valor . " para " . $destinatario["nome_usuario"] . "!");
        Database::historico_transferencia()->criar_interna($usuario["id_usuario"], $destinatario["id_usuario"], $destinatario["cpf_usuario"], $valor, "", "");
    } else {
        echo criar_sucesso("Voce transferiu R$" . $valor . " para cpf: " . $cpf . ", banco: " . $_POST["banco"] . ", agencia: " . $_POST["agencia"] . ", conta: " . $_POST["conta"] . "!");
        Database::historico_transferencia()->criar_externa($usuario["id_usuario"], $_POST["banco"], $_POST["agencia"], $_POST["conta"], $cpf, $valor, "", "");

    }
} else {

    Database::usuario()->atualizar_saldo($destinatario["id_usuario"], $destinatario["saldo"] + $valor);
    echo criar_sucesso("Voce transferiu R$" . $valor . " para " . $destinatario["nome_usuario"] . "!");
    if ($transferencia_externa !== false) {
        if ($usuario["id_usuario"] === $destinatario["id_usuario"]) {
            echo criar_erro("Voce nao pode enviar uma transferencia para si mesmo");
            die();
        }
        // interna
        Database::historico_transferencia()->criar_pix_interno($usuario["id_usuario"], $destinatario["id_usuario"], $_POST["chave"], $valor, "", "");

    } else {
        Database::historico_transferencia()->criar_pix_externo($usuario["id_usuario"], $_POST["chave"], $valor, "", "");


    }
}
