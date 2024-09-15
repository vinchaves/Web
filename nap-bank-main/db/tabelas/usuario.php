<?php
require_once (__DIR__ . "/tabela.php");
class Usuario extends Tabela
{
    public function nome_tabela(): string
    {
        return "usuario";
    }
    public function inserir(string $email_usuario, string $senha_usuario, string $apelido_usuario, string $nome_usuario, string $cpf_usuario, string $data_nascimento, float $saldo, float $fatura)
    {
        // INSERT INTO "usuario" VALUES (
        //     0,
        //     "teste",
        //     "teste@teste.com",
        //     "teste",
        //     "Teste da Silva Nunes",
        //     "111.222.333-44",
        //     "01/01/1990"
        // );
        return $this->__inserir(
            array(
                "email_usuario" => $email_usuario,
                "senha_usuario" => $senha_usuario,
                "apelido_usuario" => $apelido_usuario,
                "nome_usuario" => $nome_usuario,
                "cpf_usuario" => $cpf_usuario,
                "data_nascimento" => $data_nascimento,
                "saldo" => $saldo,
                "fatura" => $fatura
            )
        );
    }
    public function buscar(int $id_usuario, bool $incluir_senha = false)
    {
        $colunas_incluidas = array("id_usuario", "apelido_usuario", "email_usuario", "cpf_usuario", "nome_usuario", "data_nascimento", "saldo", "fatura");
        if ($incluir_senha)
            array_push($colunas_incluidas, "senha_usuario");

        return $this->__buscar(array("id_usuario" => $id_usuario), $colunas_incluidas);
    }
    public function buscar_email(string $email_usuario)
    {
        return $this->__buscar(array("email_usuario" => $email_usuario));
    }
    public function buscar_apelido(string $apelido_usuario)
    {
        return $this->__buscar(array("apelido_usuario" => $apelido_usuario));
    }
    public function buscar_cpf(string $cpf_usuario)
    {
        return $this->__buscar(array("cpf_usuario" => $cpf_usuario));
    }
    private function remover(int $id_usuario)
    {
        $this->__remover(array("id_usuario" => $id_usuario));
    }
    public function atualizar(int $id_usuario, string|null $apelido_usuario = null, string|null $email_usuario = null, string|null $senha_usuario = null)
    {
        $this->__atualizar(array("id_usuario" => $id_usuario), array("apelido_usuario" => $apelido_usuario, "email_usuario" => $email_usuario, "senha_usuario" => $senha_usuario));
    }

    public function atualizar_saldo(int $id_usuario, float|null $saldo)
    {
        $this->__atualizar(array("id_usuario" => $id_usuario), array("saldo" => $saldo));
    }
}
?>