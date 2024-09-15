<?php
require_once (__DIR__ . "/tabela.php");
function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


class ChavePix extends Tabela
{
    public function nome_tabela(): string
    {
        return "chave_pix";
    }

    public function criar(int $id_usuario, string|null $valor, string $tipo = "aleatoria")
    {
        $chave = null;
        if ($tipo == "aleatoria" || $valor === null) {
            $chave = guidv4();
        }
        return $this->__inserir(array("chave" => $chave, "id_usuario" => $id_usuario, "tipo" => $tipo));
    }

    public function buscar_chave(string $chave)
    {
        return $this->__buscar(array("chave" => $chave));
    }

    public function buscar_usuario(int $id_usuario)
    {
        return $this->__buscar(array("id_usuario" => $id_usuario));
    }


    public function atualizar(string $chave, string $nova_chave)
    {
        return $this->__atualizar(array("chave" => $chave), array("chave" => $nova_chave));
    }

    public function remover(string $chave)
    {
        return $this->__remover(array("chave" => $chave));
    }
}
