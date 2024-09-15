<?php
function array_filtrar_null(array $array)
{
    $filtrado = array();
    foreach ($array as $nome => $valor) {
        if (is_null($valor))
            continue;

        $filtrado[$nome] = $valor;
    }

    return $filtrado;
}