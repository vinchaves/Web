<?php
require_once (__DIR__ . "/../../utils/array.php");
abstract class Tabela
{
    public static PDO $db;


    public function __construct(PDO $db)
    {
        self::$db = $db;
    }

    abstract function nome_tabela(): string;

    private function gerar_arg_igual_sql(array $argumentos, bool $ignorar_null = true)
    {
        $formatacao_sql = array();
        foreach ($argumentos as $nome_argumento => $valor_argumento) {
            if (is_null($valor_argumento) && $ignorar_null)
                continue;

            array_push($formatacao_sql, $nome_argumento . " = :" . $nome_argumento);
        }

        return $formatacao_sql;
    }
    public function __inserir(array $argumentos_values)
    {
        $values = array();
        $argumentos_values_filtrados = array_filtrar_null($argumentos_values);
        if (empty($argumentos_values))
            return false;

        foreach ($argumentos_values as $nome_argumento => $valor_argumento) {
            if (is_null($valor_argumento))
                continue;

            array_push($values, $nome_argumento);
        }
        $string_values = "(" . join(", ", $values) . ") VALUES (:" . join(", :", $values) . ")";
        $string_sql = "INSERT INTO " . $this->nome_tabela() . $string_values;

        $comando = self::$db->prepare($string_sql);
        return $comando->execute($argumentos_values_filtrados);
    }
    public function __buscarTodas(array $argumentos_where, array|null $argumentos_select = null)
    {
        $where = $this->gerar_arg_igual_sql($argumentos_where);
        $argumentos_where_filtrado = array_filtrar_null($argumentos_where);
        if (empty($where))
            return false;

        $string_where = " WHERE " . join(" AND ", $where);
        $string_sql = "SELECT " . ($argumentos_select ? join(", ", $argumentos_select) : "*") . " FROM " . $this->nome_tabela() . $string_where;
        $comando = self::$db->prepare($string_sql);
        // echo ($string_sql);
        $comando->execute($argumentos_where_filtrado);
        return $comando->fetchAll(PDO::FETCH_ASSOC);
    }
    public function __buscar(array $argumentos_where, array|null $argumentos_select = null)
    {
        $where = $this->gerar_arg_igual_sql($argumentos_where);
        $argumentos_where_filtrado = array_filtrar_null($argumentos_where);
        if (empty($where))
            return false;

        $string_where = " WHERE " . join(" AND ", $where);
        $string_sql = "SELECT " . ($argumentos_select ? join(", ", $argumentos_select) : "*") . " FROM " . $this->nome_tabela() . $string_where;
        $comando = self::$db->prepare($string_sql);
        // echo ($string_sql);
        $comando->execute($argumentos_where_filtrado);
        return $comando->fetch(PDO::FETCH_ASSOC);
    }
    public function __remover(array $argumentos_where)
    {
        $where = $this->gerar_arg_igual_sql($argumentos_where);
        $argumentos_where_filtrado = array_filtrar_null($argumentos_where);
        if (empty($where))
            return false;

        $string_where = " WHERE " . join(" AND ", $where);
        $string_sql = "DELETE FROM " . $this->nome_tabela() . $string_where;

        $comando = self::$db->prepare($string_sql);
        return $comando->execute($argumentos_where_filtrado);
    }
    public function __atualizar(array $argumentos_where, array $argumentos_set)
    {
        $set = $this->gerar_arg_igual_sql($argumentos_set, false);
        $where = $this->gerar_arg_igual_sql($argumentos_where);

        $argumentos_set_filtrado = array_filtrar_null($argumentos_set);
        $argumentos_where_filtrado = array_filtrar_null($argumentos_where);

        if (empty($set) || empty($where))
            return false;

        $string_set = join(", ", $set);
        $string_where = " WHERE " . join(" AND ", $where);
        $string_sql = "UPDATE " . $this->nome_tabela() . " SET " . $string_set . $string_where;

        $comando = self::$db->prepare($string_sql);
        // var_dump($argumentos_set);
        return $comando->execute(array_merge($argumentos_set, $argumentos_where_filtrado));
    }
}
?>