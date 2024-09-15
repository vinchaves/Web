<?php
require_once (__DIR__ . "/tabelas/sessao.php");
require_once (__DIR__ . "/tabelas/usuario.php");
require_once (__DIR__ . "/tabelas/chave_pix.php");
require_once (__DIR__ . "/tabelas/historico_transferencia.php");

$diretorio_db = __DIR__ . "/database.db";

class Database
{
    private static PDO $db;
    private static Sessao $sessao;
    private static Usuario $usuario;

    private static ChavePix $chave;
    private static HistoricoTransferencia $historicoTransferencia;

    private function __construct()
    {
    }
    private static function setar_schema_db()
    {
        $query = file_get_contents(__DIR__ . "/creation.sql");
        self::$db->exec($query);

        file_put_contents(__DIR__ . "/current.sql", $query);
    }

    private static function checar_schema_atualizada()
    {
        $new = file_get_contents(__DIR__ . "/creation.sql");
        $current = file_get_contents(__DIR__ . "/current.sql");
        return $new === $current;
    }

    public static function unlink_db()
    {
        if (isset($db)) {
            unset(self::$db);
            return true;
        }
        return false;
    }

    private static function adquirir_db()
    {
        global $diretorio_db;

        if (!isset(self::$db)) {
            // TODO: Remover sobescrever se schema desatualizada em PROD 
            if (!self::checar_schema_atualizada()) {
                unlink($diretorio_db);
            }

            $setar_schema = !file_exists($diretorio_db);

            try {
                self::$db = new PDO("sqlite:" . $diretorio_db);
            } catch (PDOException $e) {
                $error = $e->getCode();
                var_dump($error);
                exit();
            }

            if ($setar_schema)
                self::setar_schema_db();

        }

        return self::$db;
    }
    static function sessao()
    {
        $db = self::adquirir_db();
        if (!isset(self::$sessao)) {
            self::$sessao = new Sessao($db);
        }
        return self::$sessao;
    }
    static function usuario()
    {
        $db = self::adquirir_db();
        if (!isset(self::$usuario)) {
            self::$usuario = new Usuario($db);
        }
        return self::$usuario;
    }

    static function chave()
    {
        $db = self::adquirir_db();
        if (!isset(self::$chave)) {
            self::$chave = new ChavePix($db);
        }
        return self::$chave;
    }
    public static function historico_transferencia()
    {
        $db = self::adquirir_db();
        if (!isset(self::$historicoTransferencia)) {
            self::$historicoTransferencia = new HistoricoTransferencia($db);
        }
        return self::$historicoTransferencia;
    }
}
