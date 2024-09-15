<?php
require_once (__DIR__ . "/../db/database.php");
function adquirir_sessao()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    $id_sessao = session_id();

    return Database::sessao()->adquirir_sessao($id_sessao);
}

function adquirir_usuario()
{
    $sessao = adquirir_sessao();
    if (empty($sessao["id_usuario"])) {
        return null;
    }
    return Database::usuario()->buscar($sessao["id_usuario"]);
}
?>