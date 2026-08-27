<?php

require_once(__DIR__ . "/php/conexao.php");
require_once(__DIR__ . "/includes/proteger_admin.php");


// ==========================================================
// FILTRO
// ==========================================================

$filtro = $_GET["tipo"] ?? "Todos";


$tiposPermitidos = [
    "Todos",
    "Administrador",
    "Distribuidor",
    "Cliente"
];


if (!in_array($filtro, $tiposPermitidos, true)) {

    $filtro = "Todos";

}


// ==========================================================
// EXCLUIR CONTA
// ==========================================================

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    &&
    isset($_POST["excluir_conta"])
) {

    $id_usuario = filter_input(
        INPUT_POST,
        "id_usuario",
        FILTER_VALIDATE_INT
    );


    if (!$id_usuario) {

        header(
            "Location: ver_contas_usuarios.php?tipo=" .
            urlencode($filtro) .
            "&erro=id_invalido"
        );

        exit;

    }


    mysqli_begin_transaction($conn);


    try {


        // ==================================================
        // BUSCAR TIPO DO USUÁRIO
        // ==================================================

        $sql = "
            SELECT tipo_usuario
            FROM usuario
            WHERE id_usuario = ?
        ";


        $stmt = mysqli_prepare(
            $conn,
            $sql
        );


        if (!$stmt) {

            throw new Exception(
                "Erro ao preparar a consulta."
            );

        }


        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id_usuario
        );


        mysqli_stmt_execute($stmt);


        $resultadoUsuario =
            mysqli_stmt_get_result($stmt);


        $usuario =
            mysqli_fetch_assoc($resultadoUsuario);


        mysqli_stmt_close($stmt);


        if (!$usuario) {

            throw new Exception(
                "Conta não encontrada."
            );

        }


        $tipoUsuario =
            $usuario["tipo_usuario"];


        // ==================================================
        // EXCLUIR CLIENTE
        // ==================================================

        if ($tipoUsuario === "Cliente") {


            $sql = "
                SELECT FK_cliente_id_cliente
                FROM cliente
                WHERE FK_cliente_id_usuario = ?
            ";


            $stmt = mysqli_prepare(
                $conn,
                $sql
            );


            if (!$stmt) {

                throw new Exception(
                    "Erro ao buscar cliente."
                );

            }


            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );


            mysqli_stmt_execute($stmt);


            $resultadoCliente =
                mysqli_stmt_get_result($stmt);


            $cliente =
                mysqli_fetch_assoc(
                    $resultadoCliente
                );


            mysqli_stmt_close($stmt);


            if ($cliente) {


                $id_cliente =
                    $cliente["FK_cliente_id_cliente"];


                // EXCLUI AVALIAÇÕES DO CLIENTE

                $sql = "
                    DELETE FROM avaliacao
                    WHERE FK_avaliacao_id_cliente = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );


                mysqli_stmt_execute($stmt);


                mysqli_stmt_close($stmt);


                // EXCLUI ASSINATURAS

                $sql = "
                    DELETE FROM assinatura
                    WHERE FK_assinatura_id_cliente = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );


                mysqli_stmt_execute($stmt);


                mysqli_stmt_close($stmt);


                // EXCLUI CLIENTE

                $sql = "
                    DELETE FROM cliente
                    WHERE FK_cliente_id_usuario = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );


                mysqli_stmt_execute($stmt);


                mysqli_stmt_close($stmt);

            }

        }


        // ==================================================
        // EXCLUIR ADMINISTRADOR
        // ==================================================

        elseif ($tipoUsuario === "Administrador") {


            $sql = "
                DELETE FROM administrador
                WHERE FK_administrador_id_usuario = ?
            ";


            $stmt = mysqli_prepare(
                $conn,
                $sql
            );


            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );


            mysqli_stmt_execute($stmt);


            mysqli_stmt_close($stmt);

        }


        // ==================================================
        // EXCLUIR DISTRIBUIDOR
        // ==================================================

        elseif ($tipoUsuario === "Distribuidor") {


            // BUSCA O DISTRIBUIDOR

            $sql = "
                SELECT id_distribuidor
                FROM distribuidor
                WHERE FK_distribuidor_id_usuario = ?
            ";


            $stmt = mysqli_prepare(
                $conn,
                $sql
            );


            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );


            mysqli_stmt_execute($stmt);


            $resultadoDistribuidor =
                mysqli_stmt_get_result($stmt);


            $distribuidor =
                mysqli_fetch_assoc(
                    $resultadoDistribuidor
                );


            mysqli_stmt_close($stmt);


            if ($distribuidor) {


                $id_distribuidor =
                    $distribuidor["id_distribuidor"];


                // BUSCA OS CONTEÚDOS DESSE DISTRIBUIDOR

                $sql = "
                    SELECT id_conteudo
                    FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_distribuidor
                );


                mysqli_stmt_execute($stmt);


                $resultadoConteudos =
                    mysqli_stmt_get_result($stmt);


                // EXCLUI AS AVALIAÇÕES DOS CONTEÚDOS

                while (
                    $conteudo =
                    mysqli_fetch_assoc(
                        $resultadoConteudos
                    )
                ) {


                    $id_conteudo =
                        $conteudo["id_conteudo"];


                    $sqlAvaliacao = "
                        DELETE FROM avaliacao
                        WHERE FK_avaliacao_id_conteudo = ?
                    ";


                    $stmtAvaliacao =
                        mysqli_prepare(
                            $conn,
                            $sqlAvaliacao
                        );


                    mysqli_stmt_bind_param(
                        $stmtAvaliacao,
                        "i",
                        $id_conteudo
                    );


                    mysqli_stmt_execute(
                        $stmtAvaliacao
                    );


                    mysqli_stmt_close(
                        $stmtAvaliacao
                    );

                }


                mysqli_stmt_close($stmt);


                // EXCLUI OS CONTEÚDOS

                $sql = "
                    DELETE FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_distribuidor
                );


                mysqli_stmt_execute($stmt);


                mysqli_stmt_close($stmt);


                // EXCLUI O DISTRIBUIDOR

                $sql = "
                    DELETE FROM distribuidor
                    WHERE FK_distribuidor_id_usuario = ?
                ";


                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );


                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );


                mysqli_stmt_execute($stmt);


                mysqli_stmt_close($stmt);

            }

        }


        // ==================================================
        // EXCLUI O USUÁRIO PRINCIPAL
        // ==================================================

        $sql = "
            DELETE FROM usuario
            WHERE id_usuario = ?
        ";


        $stmt = mysqli_prepare(
            $conn,
            $sql
        );


        if (!$stmt) {

            throw new Exception(
                "Erro ao excluir usuário."
            );

        }


        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id_usuario
        );


        mysqli_stmt_execute($stmt);


        $linhasAfetadas =
            mysqli_stmt_affected_rows($stmt);


        mysqli_stmt_close($stmt);


        if ($linhasAfetadas <= 0) {

            throw new Exception(
                "Não foi possível excluir a conta."
            );

        }


        mysqli_commit($conn);


        header(
            "Location: ver_contas_usuarios.php?tipo=" .
            urlencode($filtro) .
            "&sucesso=excluido"
        );


        exit;


    } catch (Throwable $erro) {


        mysqli_rollback($conn);


        header(
            "Location: ver_contas_usuarios.php?tipo=" .
            urlencode($filtro) .
            "&erro=" .
            urlencode(
                $erro->getMessage()
            )
        );


        exit;

    }

}


// ==========================================================
// CONSULTAR AS CONTAS
// ==========================================================

$sql = "

    SELECT

        u.id_usuario,

        u.email,

        u.aniversario,

        u.tipo_usuario,

        a.nome_admin,

        c.nome_cliente,

        c.cpf_cliente,

        c.status_conta_cliente,

        d.empresa_distribuidor,

        d.cnpj_empresa_distribuidor

    FROM usuario AS u

    LEFT JOIN administrador AS a

        ON a.FK_administrador_id_usuario =
        u.id_usuario

    LEFT JOIN cliente AS c

        ON c.FK_cliente_id_usuario =
        u.id_usuario

    LEFT JOIN distribuidor AS d

        ON d.FK_distribuidor_id_usuario =
        u.id_usuario

";


// ==========================================================
// APLICAR FILTRO
// ==========================================================

if ($filtro !== "Todos") {

    $sql .= "

        WHERE u.tipo_usuario = ?

    ";

}


$sql .= "

    ORDER BY u.id_usuario DESC

";


$stmt = mysqli_prepare(
    $conn,
    $sql
);


if (!$stmt) {

    die(
        "Erro ao consultar as contas: " .
        mysqli_error($conn)
    );

}


if ($filtro !== "Todos") {

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $filtro
    );

}


mysqli_stmt_execute($stmt);


$resultado =
    mysqli_stmt_get_result($stmt);


// ==========================================================
// COLOCAR RESULTADOS EM ARRAY
// ==========================================================

$contas = [];


while (
    $linha =
    mysqli_fetch_assoc($resultado)
) {

    $contas[] = $linha;

}


mysqli_stmt_close($stmt);

?>


<!DOCTYPE html>

<html lang="pt-BR">


<head>


    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >


    <title>
        Ver Contas - ORION TV
    </title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>


        * {

            margin: 0;

            padding: 0;

            box-sizing: border-box;

        }


        body {

            background-color: #080808;

            min-height: 100vh;

            color: white;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

        }


        .topo {

            width: 100%;

            min-height: 80px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 15px 5%;

            background-color: #080808;

            border-bottom: 1px solid #292929;

        }


        .logo {

            font-size: 28px;

            font-weight: bold;

            color: #168cff;

            letter-spacing: 1px;

            text-decoration: none;

        }


        .logo:hover {

            color: #168cff;

        }


        .botoes-topo {

            display: flex;

            align-items: center;

            gap: 10px;

        }


        .btn-voltar {

            text-decoration: none;

            color: white;

            background-color: #222;

            border: 1px solid #333;

            padding: 10px 20px;

            border-radius: 6px;

        }


        .btn-voltar:hover {

            background-color: #333;

            color: white;

        }


        .btn-criar {

            text-decoration: none;

            color: white;

            background-color: #168cff;

            padding: 10px 20px;

            border-radius: 6px;

        }


        .btn-criar:hover {

            background-color: #006dcc;

            color: white;

        }


        .pagina-container {

            width: 100%;

            max-width: 1250px;

            margin: 0 auto;

            padding: 45px 20px 70px;

        }


        h1 {

            font-size: 30px;

            margin-bottom: 8px;

        }


        .descricao {

            color: #999;

            margin-bottom: 30px;

        }


        .filtros {

            display: flex;

            flex-wrap: wrap;

            gap: 10px;

            margin-bottom: 25px;

        }


        .filtro {

            text-decoration: none;

            background-color: #1b1b1b;

            border: 1px solid #333;

            color: #ccc;

            padding: 9px 18px;

            border-radius: 6px;

        }


        .filtro:hover {

            border-color: #168cff;

            color: white;

        }


        .filtro.ativo {

            background-color: #168cff;

            border-color: #168cff;

            color: white;

        }


        .lista-card {

            background-color: #111;

            border: 1px solid #292929;

            border-radius: 12px;

            overflow: hidden;

        }


        .tabela-container {

            width: 100%;

            overflow-x: auto;

        }


        .tabela-contas {

            width: 100%;

            min-width: 1000px;

            border-collapse: collapse;

        }


        .tabela-contas th {

            background-color: #171717;

            color: #999;

            font-size: 13px;

            font-weight: normal;

            text-align: left;

            padding: 17px 20px;

            border-bottom: 1px solid #292929;

        }


        .tabela-contas td {

            padding: 18px 20px;

            border-bottom: 1px solid #292929;

            font-size: 14px;

        }


        .tabela-contas tbody tr:hover {

            background-color: #171717;

        }


        .nome-usuario {

            font-weight: bold;

        }


        .email-usuario {

            color: #999;

            font-size: 13px;

            margin-top: 4px;

        }


        .tipo {

            display: inline-block;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

        }


        .tipo-administrador {

            background-color:
                rgba(22, 140, 255, 0.15);

            color: #5db2ff;

        }


        .tipo-distribuidor {

            background-color:
                rgba(130, 90, 255, 0.15);

            color: #b69cff;

        }


        .tipo-cliente {

            background-color:
                rgba(50, 200, 120, 0.12);

            color: #63d99a;

        }


        .status-ativo {

            color: #63d99a;

        }


        .status-inativo {

            color: #999;

        }


        .status-suspenso {

            color: #ff7777;

        }


        .btn-excluir {

            background-color:
                rgba(180, 40, 40, 0.12);

            border: 1px solid #4a2020;

            color: #ff7777;

            padding: 7px 12px;

            border-radius: 6px;

            cursor: pointer;

        }


        .btn-excluir:hover {

            background-color: #b52b2b;

            color: white;

        }


        .sem-contas {

            text-align: center;

            padding: 70px 20px;

            color: #999;

        }


        .sem-contas i {

            display: block;

            font-size: 42px;

            color: #444;

            margin-bottom: 15px;

        }


        .sem-contas strong {

            display: block;

            color: #ccc;

            margin-bottom: 8px;

            font-size: 17px;

        }


        @media (max-width: 768px) {


            .topo {

                padding: 12px 4%;

            }


            .logo {

                font-size: 23px;

            }


            .btn-voltar,
            .btn-criar {

                padding: 8px 12px;

                font-size: 13px;

            }


            .pagina-container {

                padding: 30px 15px 50px;

            }

        }


    </style>


</head>


<body>


<header class="topo">


    <a
        href="tela_inicial_admin.php"
        class="logo"
    >

        ORION TV

    </a>


    <div class="botoes-topo">


        <a
            href="assinaturas_admin.php"
            class="btn-voltar"
        >

            Voltar

        </a>


        <a
            href="criar_contas_admin.php"
            class="btn-criar"
        >

            <i class="bi bi-plus-lg"></i>

            Criar Contas

        </a>


    </div>


</header>



<main class="pagina-container">


    <h1>

        Gerenciar contas

    </h1>


    <p class="descricao">

        Visualize e gerencie todas as contas cadastradas.

    </p>



    <!-- FILTROS -->

    <div class="filtros">


        <a
            href="ver_contas_usuarios.php?tipo=Todos"
            class="filtro <?php
                echo $filtro === "Todos"
                    ? "ativo"
                    : "";
            ?>"
        >

            Todas

        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Administrador"
            class="filtro <?php
                echo $filtro === "Administrador"
                    ? "ativo"
                    : "";
            ?>"
        >

            Administradores

        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Distribuidor"
            class="filtro <?php
                echo $filtro === "Distribuidor"
                    ? "ativo"
                    : "";
            ?>"
        >

            Distribuidores

        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Cliente"
            class="filtro <?php
                echo $filtro === "Cliente"
                    ? "ativo"
                    : "";
            ?>"
        >

            Clientes

        </a>


    </div>



    <!-- LISTA -->

    <div class="lista-card">


        <?php if (!empty($contas)) { ?>


            <div class="tabela-container">


                <table class="tabela-contas">


                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Conta</th>

                            <th>Tipo</th>

                            <th>Informação</th>

                            <th>Status</th>

                            <th>Ação</th>

                        </tr>

                    </thead>


                    <tbody>


                        <?php foreach ($contas as $conta) { ?>


                            <?php


                            $tipo =
                                $conta["tipo_usuario"];


                            if (
                                $tipo === "Administrador"
                            ) {

                                $nome =
                                    $conta["nome_admin"]
                                    ?: "Administrador";

                                $classeTipo =
                                    "tipo-administrador";

                                $informacao =
                                    "Administrador da plataforma";

                                $status =
                                    "Ativo";

                                $classeStatus =
                                    "status-ativo";

                            }


                            elseif (
                                $tipo === "Distribuidor"
                            ) {

                                $nome =
                                    $conta[
                                        "empresa_distribuidor"
                                    ]
                                    ?: "Distribuidor";

                                $classeTipo =
                                    "tipo-distribuidor";

                                $informacao =
                                    !empty(
                                        $conta[
                                            "cnpj_empresa_distribuidor"
                                        ]
                                    )

                                    ? "CNPJ: " .
                                    $conta[
                                        "cnpj_empresa_distribuidor"
                                    ]

                                    : "CNPJ não informado";

                                $status =
                                    "Ativo";

                                $classeStatus =
                                    "status-ativo";

                            }


                            else {

                                $nome =
                                    $conta["nome_cliente"]
                                    ?: "Cliente";

                                $classeTipo =
                                    "tipo-cliente";


                                $informacao =
                                    !empty(
                                        $conta["cpf_cliente"]
                                    )

                                    ? "CPF: " .
                                    $conta["cpf_cliente"]

                                    : "CPF não informado";


                                $status =
                                    $conta[
                                        "status_conta_cliente"
                                    ]
                                    ?: "Inativo";


                                if ($status === "Ativo") {

                                    $classeStatus =
                                        "status-ativo";

                                }


                                elseif (
                                    $status === "Suspenso"
                                ) {

                                    $classeStatus =
                                        "status-suspenso";

                                }


                                else {

                                    $classeStatus =
                                        "status-inativo";

                                }

                            }


                            ?>


                            <tr>


                                <td>

                                    #<?php
                                    echo (int)
                                        $conta["id_usuario"];
                                    ?>

                                </td>


                                <td>


                                    <div class="nome-usuario">

                                        <?php

                                        echo htmlspecialchars(
                                            $nome,
                                            ENT_QUOTES,
                                            "UTF-8"
                                        );

                                        ?>

                                    </div>


                                    <div class="email-usuario">

                                        <?php

                                        echo htmlspecialchars(
                                            $conta["email"],
                                            ENT_QUOTES,
                                            "UTF-8"
                                        );

                                        ?>

                                    </div>


                                </td>


                                <td>


                                    <span
                                        class="tipo <?php
                                            echo $classeTipo;
                                        ?>"
                                    >

                                        <?php

                                        echo htmlspecialchars(
                                            $tipo
                                        );

                                        ?>

                                    </span>


                                </td>


                                <td>

                                    <?php

                                    echo htmlspecialchars(
                                        $informacao,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );

                                    ?>

                                </td>


                                <td>


                                    <span
                                        class="<?php
                                            echo $classeStatus;
                                        ?>"
                                    >

                                        <?php

                                        echo htmlspecialchars(
                                            $status,
                                            ENT_QUOTES,
                                            "UTF-8"
                                        );

                                        ?>

                                    </span>


                                </td>


                                <td>


                                    <form
                                        method="POST"
                                        action="ver_contas_usuarios.php?tipo=<?php
                                            echo urlencode($filtro);
                                        ?>"
                                    >


                                        <input
                                            type="hidden"
                                            name="id_usuario"
                                            value="<?php
                                                echo (int)
                                                    $conta["id_usuario"];
                                            ?>"
                                        >


                                        <button
                                            type="submit"
                                            name="excluir_conta"
                                            value="1"
                                            class="btn-excluir"
                                        >

                                            <i
                                                class="bi bi-trash3"
                                            ></i>

                                            Excluir

                                        </button>


                                    </form>


                                </td>


                            </tr>


                        <?php } ?>


                    </tbody>


                </table>


            </div>


        <?php } else { ?>


            <div class="sem-contas">


                <i class="bi bi-people"></i>


                <strong>

                    Nenhuma conta encontrada

                </strong>


                <p>


                    <?php


                    if ($filtro === "Todos") {

                        echo
                            "Ainda não existem contas cadastradas.";

                    }


                    else {

                        echo
                            "Não existe nenhuma conta do tipo " .
                            htmlspecialchars($filtro) .
                            ".";

                    }


                    ?>


                </p>


            </div>


        <?php } ?>


    </div>


</main>



<?php

// ==========================================================
// ALERTA DE SUCESSO
// ==========================================================

if (
    isset($_GET["sucesso"])
    &&
    $_GET["sucesso"] === "excluido"
) {

?>

    <script>

        mostrarAlerta(

            "Conta excluída com sucesso.",

            "window.location.href = 'ver_contas_usuarios.php?tipo=<?php echo urlencode($filtro); ?>'"

        );

    </script>

<?php

}


// ==========================================================
// ALERTA DE ERRO
// ==========================================================

if (isset($_GET["erro"])) {

    $mensagemErro = $_GET["erro"];


    if ($mensagemErro === "id_invalido") {

        $mensagemErro =
            "ID da conta inválido.";

    }

?>

    <script>

        mostrarAlerta(

            <?php
            echo json_encode(
                $mensagemErro,
                JSON_UNESCAPED_UNICODE
            );
            ?>,

            "window.location.href = 'ver_contas_usuarios.php?tipo=<?php echo urlencode($filtro); ?>'"

        );

    </script>

<?php

}

?>


</body>

</html>