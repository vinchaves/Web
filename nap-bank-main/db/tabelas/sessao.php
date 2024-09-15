<?php
require_once (__DIR__ . "/tabela.php");
class Sessao extends Tabela
{
    public function nome_tabela(): string
    {
        return "sessao";
    }

    public function inserir(string $id_sessao, int|null $id_usuario = null)
    {
        return $this->__inserir(array("id_sessao" => $id_sessao, "id_usuario" => $id_usuario));
    }

    public function buscar(string $id_sessao)
    {
        return $this->__buscar(array("id_sessao" => $id_sessao));
    }

    public function atualizar(string $id_sessao, int|null $id_usuario)
    {
        return $this->__atualizar(array("id_sessao" => $id_sessao), array("id_usuario" => $id_usuario));
    }

    public function remover(string $id_sessao)
    {
        return $this->__remover(array("id_sessao" => $id_sessao));
    }

    public function adquirir_sessao(string $id_sessao)
    {
        $sessao = $this->buscar($id_sessao);
        if (empty($sessao)) {
            self::inserir($id_sessao);
            return self::buscar($id_sessao);
        }

        return $sessao;
    }
}
?>