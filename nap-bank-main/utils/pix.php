<?php

function formataCampo($id, $valor)
{
    return $id . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
}

function calculaCRC16($dados)
{
    $resultado = 0xFFFF;
    for ($i = 0; $i < strlen($dados); $i++) {
        $resultado ^= (ord($dados[$i]) << 8);
        for ($j = 0; $j < 8; $j++) {
            if ($resultado & 0x8000) {
                $resultado = ($resultado << 1) ^ 0x1021;
            } else {
                $resultado <<= 1;
            }
            $resultado &= 0xFFFF;
        }
    }
    return strtoupper(str_pad(dechex($resultado), 4, '0', STR_PAD_LEFT));
}

function geraPix($chave, $idTx = '', $valor = 0.00)
{
    $resultado = "000201";
    $resultado .= formataCampo("26", "0014br.gov.bcb.pix" . formataCampo("01", $chave));
    $resultado .= "52040000"; // Código fixo
    $resultado .= "5303986";  // Moeda (Real)
    if ($valor > 0) {
        $resultado .= formataCampo("54", number_format($valor, 2, '.', ''));
    }
    $resultado .= "5802BR"; // País
    $resultado .= "5901N";  // Nome
    $resultado .= "6001C";  // Cidade
    $resultado .= formataCampo("62", formataCampo("05", $idTx ?: '***'));
    $resultado .= "6304"; // Início do CRC16
    $resultado .= calculaCRC16($resultado); // Adiciona o CRC16 ao final
    return $resultado;
}

// Exemplos de chave PIX
//
// E-mail: nome@exemplo.com.br
// CPF: 12345678901 (só números)
// CNPJ: 12345678000123 (só números)
// Celular: +5511912345678 (+55 + DDD + número)
//
// $chave = "nome@exemplo.com.br";

// // Valor da transação
// $valorTransacao = 1.23;

// // Identificador único da transação, caso exista
// $idTransacao = "";

// // Obtem código copia e cola do PIX
// $codigoPix = geraPix($chave, $idTransacao, $valorTransacao);

// // Exibe o QRCode com o PIX
// echo '<p><img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=' . urlencode($codigoPix) . '"></p>';

// // Exibe o Código PIX (copia e cola)
// echo "<p>Código PIX: " . $codigoPix . "<p>";

?>