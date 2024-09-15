<?php
require_once (__DIR__ . "/../utils/sessao.php");
require_once (__DIR__ . "/../db/database.php");
$usuario = adquirir_usuario();
if (empty($usuario)) {
    header("Location: ../login.php");
    die();
}
$enviados = Database::historico_transferencia()->buscar_enviados($usuario["id_usuario"]);
$recebidos = Database::historico_transferencia()->buscar_recebidos($usuario["id_usuario"]);


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../static/css/lib/bootstrap.css" />
    <link rel="stylesheet" href="../static/css/historico.css" />
    <link rel="stylesheet" href="../static/css/menu.css">
    <title>Historico</title>
    <script>
        console.log(<?php echo json_encode($recebidos) ?>)
        const perfilUsuario = <?php echo json_encode($usuario) ?>;
    </script>
</head>

<body>
    <div class="container container-corpo">
        <div class="corpo rounded-lg">
            <div id="imagemRoxa" class=""></div>
            <header class="menu">
                <div id="mySidenav" class="sidenav rounded-lg">
                    <a href="javascript:void(0)" class="closebtn">&times;</a>
                    <a class="active" href="index.php">Perfil</a>
                    <a href="transferencia.php">Transferência</a>
                    <a href="deposito.php">Deposito</a>
                    <!-- <a href="emprestimo.php">Emprestimo</a> -->
                    <a href="historico.php">Historico</a>

                    <!-- <a href="#">Cartões</a> -->
                    <!-- <a href="pix.php">PIX</a> -->
                    <a href="javascript:void(0)" id="botao-sair">Sair</a>
                </div>
                <div class="logo">
                    <div class="traco"></div>
                    <div class="traco"></div>
                    <div class="traco"></div>
                </div>
            </header>
            <h2>Enviados</h2>

            <section class="grid-historico">
                <p>Destinatario</p>
                <p>Chave PIX</p>
                <p>CPF</p>
                <p>Valor</p>
                <!-- agencia_destinatario: null

banco_destinatario: null
​​
chave_destinatario: "80229784-5381-464d-a34b-238f32230096"
​​
conta_destinatario: null
​​
cpf_destinatario: null
​​
data_transferencia: null
​​
id: 2
​​
id_destinatario: 1
​​
id_remetente: 1
​​
mensagem: ""
​​
valor: 29 -->
                <?php foreach ($enviados as $valor) {
                    echo ' <div class="column col d-flex flex-column align-items-center"> <p>' . $valor["id_destinatario"] . '</p></div>' .
                        '<div class="column col  d-flex flex-column align-items-center"> <p>' . (!empty($valor["chave_destinatario"]) ? $valor["chave_destinatario"] : "null") . '</p></div>' .
                        '<div class="column col d-flex flex-column align-items-center"> <p>' . (!empty($valor["cpf_destinatario"]) ? $valor["cpf_destinatario"] : "null") . '</p></div>' .
                        '<div class="column col  d-flex flex-column align-items-center"> <p>' . (!empty($valor["valor"]) ? $valor["valor"] : "null") . '</p></div>' .

                        '';
                } ?>


            </section>
            <h2>Recebimentos</h2>
            <section class="grid-historico">
                <p>Remetente</p>
                <p>Chave PIX</p>
                <p>CPF</p>
                <p>Valor</p>
                <?php foreach ($recebidos as $valor) {
                    echo ' <div class="column col d-flex flex-column align-items-center"> <p>' . $valor["id_remetente"] . '</p></div>' .
                        '<div class="column col  d-flex flex-column align-items-center"> <p>' . (!is_null($valor["chave_destinatario"]) ? $valor["chave_destinatario"] : "null") . '</p></div>' .
                        '<div class="column col d-flex flex-column align-items-center"> <p>' . (!is_null($valor["cpf_destinatario"]) ? $valor["cpf_destinatario"] : "null") . '</p></div>' .
                        '<div class="column col  d-flex flex-column align-items-center"> <p>' . (!is_null($valor["valor"]) ? $valor["valor"] : "null") . '</p></div>' .

                        '';
                } ?>
            </section>
        </div>
    </div>

    <script src="../static/js/lib/jquery.js"></script>
    <script src="../static/js/lib/bootstrap.js"></script>
    <script src="../static/js/historico.js"></script>
    <script src="../static/js/menu.js"></script>
</body>

</html>