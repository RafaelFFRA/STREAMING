
<?php

require_once(__DIR__ . "/php/conexao.php");
require_once(__DIR__ . "/includes/proteger_admin.php");


/*
 * FILTRO
 */

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


/*
 * EXCLUSÃO DE CONTA
 */

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

        /*
         * Descobre o tipo do usuário
         */

        $sql = "
            SELECT tipo_usuario
            FROM usuario
            WHERE id_usuario = ?
        ";

        $stmt = mysqli_prepare($conn, $sql);

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


        /*
         * EXCLUI CLIENTE
         */

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
                mysqli_fetch_assoc($resultadoCliente);

            mysqli_stmt_close($stmt);

            if ($cliente) {

                $id_cliente =
                    $cliente["FK_cliente_id_cliente"];


                /*
                 * Exclui avaliações do cliente
                 */

                $sql = "
                    DELETE FROM avaliacao
                    WHERE FK_avaliacao_id_cliente = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao excluir avaliações do cliente."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                /*
                 * Exclui assinatura do cliente
                 */

                $sql = "
                    DELETE FROM assinatura
                    WHERE FK_assinatura_id_cliente = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao excluir assinatura do cliente."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_cliente
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                /*
                 * Exclui cliente
                 */

                $sql = "
                    DELETE FROM cliente
                    WHERE FK_cliente_id_usuario = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao excluir cliente."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }


        /*
         * EXCLUI ADMINISTRADOR
         */

        elseif ($tipoUsuario === "Administrador") {

            $sql = "
                DELETE FROM administrador
                WHERE FK_administrador_id_usuario = ?
            ";

            $stmt = mysqli_prepare(
                $conn,
                $sql
            );

            if (!$stmt) {
                throw new Exception(
                    "Erro ao excluir administrador."
                );
            }

            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );

            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }


        /*
         * EXCLUI DISTRIBUIDOR
         */

        elseif ($tipoUsuario === "Distribuidor") {

            $sql = "
                SELECT id_distribuidor
                FROM distribuidor
                WHERE FK_distribuidor_id_usuario = ?
            ";

            $stmt = mysqli_prepare(
                $conn,
                $sql
            );

            if (!$stmt) {
                throw new Exception(
                    "Erro ao buscar distribuidor."
                );
            }

            mysqli_stmt_bind_param(
                $stmt,
                "i",
                $id_usuario
            );

            mysqli_stmt_execute($stmt);

            $resultadoDistribuidor =
                mysqli_stmt_get_result($stmt);

            $distribuidor =
                mysqli_fetch_assoc($resultadoDistribuidor);

            mysqli_stmt_close($stmt);

            if ($distribuidor) {

                $id_distribuidor =
                    $distribuidor["id_distribuidor"];


                /*
                 * Busca conteúdos
                 */

                $sql = "
                    SELECT id_conteudo
                    FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao buscar conteúdos."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_distribuidor
                );

                mysqli_stmt_execute($stmt);

                $resultadoConteudos =
                    mysqli_stmt_get_result($stmt);

                while (
                    $conteudo =
                    mysqli_fetch_assoc($resultadoConteudos)
                ) {

                    $id_conteudo =
                        $conteudo["id_conteudo"];


                    /*
                     * Exclui avaliações do conteúdo
                     */

                    $sqlAvaliacao = "
                        DELETE FROM avaliacao
                        WHERE FK_avaliacao_id_conteudo = ?
                    ";

                    $stmtAvaliacao =
                        mysqli_prepare(
                            $conn,
                            $sqlAvaliacao
                        );

                    if (!$stmtAvaliacao) {
                        throw new Exception(
                            "Erro ao excluir avaliações."
                        );
                    }

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


                /*
                 * Exclui conteúdos
                 */

                $sql = "
                    DELETE FROM conteudo
                    WHERE FK_conteudo_id_distribuidor = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao excluir conteúdos."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_distribuidor
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);


                /*
                 * Exclui distribuidor
                 */

                $sql = "
                    DELETE FROM distribuidor
                    WHERE FK_distribuidor_id_usuario = ?
                ";

                $stmt = mysqli_prepare(
                    $conn,
                    $sql
                );

                if (!$stmt) {
                    throw new Exception(
                        "Erro ao excluir distribuidor."
                    );
                }

                mysqli_stmt_bind_param(
                    $stmt,
                    "i",
                    $id_usuario
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }


        /*
         * EXCLUI USUÁRIO
         */

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
            urlencode($erro->getMessage())
        );

        exit;
    }
}


/*
 * CONSULTA DAS CONTAS
 *
 * Administrador:
 *     administrador.nome_admin
 *
 * Distribuidor:
 *     distribuidor.empresa_distribuidor
 *     distribuidor.cnpj_empresa_distribuidor
 *
 * Cliente:
 *     cliente.nome_cliente
 *     cliente.cpf_cliente
 */

$sql = "
    SELECT
        u.id_usuario,
        u.email,
        u.tipo_usuario,

        COALESCE(
            a.nome_admin,
            d.empresa_distribuidor,
            c.nome_cliente,
            ''
        ) AS nome,

        COALESCE(
            d.cnpj_empresa_distribuidor,
            c.cpf_cliente,
            ''
        ) AS cpf_cnpj

    FROM usuario AS u

    LEFT JOIN administrador AS a
        ON a.FK_administrador_id_usuario = u.id_usuario

    LEFT JOIN distribuidor AS d
        ON d.FK_distribuidor_id_usuario = u.id_usuario

    LEFT JOIN cliente AS c
        ON c.FK_cliente_id_usuario = u.id_usuario
";


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

    <title>Ver Contas - ORION TV</title>

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
            font-family: Arial, Helvetica, sans-serif;
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
            transition: 0.2s;
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
            white-space: nowrap;
        }

        .tabela-contas td {
            padding: 18px 20px;
            border-bottom: 1px solid #292929;
            font-size: 14px;
            vertical-align: middle;
        }

        .tabela-contas tbody tr:last-child td {
            border-bottom: none;
        }

        .tabela-contas tbody tr:hover {
            background-color: #171717;
        }

        .nome-usuario {
            font-weight: bold;
            color: #fff;
            min-width: 180px;
        }

        .coluna-email,
        .coluna-cpf-cnpj,
        .coluna-tipo,
        .coluna-acao {
            text-align: center !important;
        }

        .coluna-email {
            min-width: 220px;
        }

        .coluna-cpf-cnpj {
            min-width: 150px;
        }

        .coluna-tipo {
            min-width: 130px;
        }

        .coluna-acao {
            min-width: 110px;
        }

        .tipo {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .tipo-administrador {
            background-color: rgba(22, 140, 255, 0.15);
            color: #5db2ff;
        }

        .tipo-distribuidor {
            background-color: rgba(130, 90, 255, 0.15);
            color: #b69cff;
        }

        .tipo-cliente {
            background-color: rgba(50, 200, 120, 0.12);
            color: #63d99a;
        }

        .btn-excluir {
            background-color: rgba(180, 40, 40, 0.12);
            border: 1px solid #4a2020;
            color: #ff7777;
            padding: 7px 12px;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            transition: 0.2s;
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


        /*
         * ================================
         * CARDS MOBILE
         * ================================
         */

        .cards-mobile {
            display: none;
        }

        .conta-card {
            padding: 18px;
            border-bottom: 1px solid #292929;
        }

        .conta-card:last-child {
            border-bottom: none;
        }

        .conta-card-topo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .conta-card-nome {
            font-size: 16px;
            font-weight: bold;
            color: white;
            word-break: break-word;
        }

        .conta-card-id {
            color: #666;
            font-size: 12px;
            flex-shrink: 0;
        }

        .conta-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            color: #777;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-valor {
            color: #ddd;
            font-size: 14px;
            word-break: break-word;
        }

        .conta-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 18px;
        }


        /*
         * ================================
         * RESPONSIVIDADE
         * ================================
         */

        @media (max-width: 768px) {

            .topo {
                min-height: 70px;
                padding: 12px 4%;
            }

            .logo {
                font-size: 22px;
            }

            .botoes-topo {
                gap: 7px;
            }

            .btn-voltar,
            .btn-criar {
                padding: 8px 10px;
                font-size: 12px;
            }

            .btn-criar i {
                margin-right: 2px;
            }

            .pagina-container {
                padding: 28px 12px 50px;
            }

            h1 {
                font-size: 24px;
            }

            .descricao {
                font-size: 14px;
                margin-bottom: 22px;
            }

            .filtros {
                gap: 7px;
                margin-bottom: 18px;
            }

            .filtro {
                padding: 8px 12px;
                font-size: 12px;
            }

            /*
             * Esconde a tabela no celular
             */

            .tabela-container {
                display: none;
            }

            /*
             * Mostra os cards
             */

            .cards-mobile {
                display: block;
            }

            .lista-card {
                border-radius: 10px;
            }

        }


        @media (max-width: 480px) {

            .topo {
                padding: 11px 3%;
            }

            .logo {
                font-size: 20px;
            }

            .btn-voltar,
            .btn-criar {
                padding: 7px 9px;
                font-size: 11px;
            }

            .btn-criar {
                display: flex;
                align-items: center;
                gap: 3px;
            }

            .pagina-container {
                padding: 25px 10px 45px;
            }

            h1 {
                font-size: 22px;
            }

            .descricao {
                font-size: 13px;
            }

            .filtros {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .filtro {
                text-align: center;
                padding: 9px 5px;
            }

            .conta-card {
                padding: 16px;
            }

            .conta-card-nome {
                font-size: 15px;
            }

            .info-valor {
                font-size: 13px;
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


    <div class="filtros">

        <a
            href="ver_contas_usuarios.php?tipo=Todos"
            class="filtro <?php echo $filtro === "Todos" ? "ativo" : ""; ?>"
        >
            Todas
        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Administrador"
            class="filtro <?php echo $filtro === "Administrador" ? "ativo" : ""; ?>"
        >
            Administradores
        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Distribuidor"
            class="filtro <?php echo $filtro === "Distribuidor" ? "ativo" : ""; ?>"
        >
            Distribuidores
        </a>


        <a
            href="ver_contas_usuarios.php?tipo=Cliente"
            class="filtro <?php echo $filtro === "Cliente" ? "ativo" : ""; ?>"
        >
            Clientes
        </a>

    </div>


    <div class="lista-card">


        <?php if (!empty($contas)) { ?>


            <!-- =================================
                 TABELA DESKTOP
                 ================================= -->

            <div class="tabela-container">

                <table class="tabela-contas">

                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Nome
                            </th>

                            <th class="coluna-email">
                                Email
                            </th>

                            <th class="coluna-cpf-cnpj">
                                CPF/CNPJ
                            </th>

                            <th class="coluna-tipo">
                                Tipo
                            </th>

                            <th class="coluna-acao">
                                Ação
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php foreach ($contas as $conta) { ?>

                            <?php

                            $tipo =
                                $conta["tipo_usuario"] ?? "";

                            $nome =
                                $conta["nome"] ?? "";

                            $email =
                                $conta["email"] ?? "";

                            $cpfCnpj =
                                $conta["cpf_cnpj"] ?? "";

                            $classeTipo = "";


                            if ($tipo === "Administrador") {

                                $classeTipo =
                                    "tipo-administrador";

                            } elseif ($tipo === "Distribuidor") {

                                $classeTipo =
                                    "tipo-distribuidor";

                            } elseif ($tipo === "Cliente") {

                                $classeTipo =
                                    "tipo-cliente";
                            }

                            ?>

                            <tr>

                                <td>
                                    #<?php
                                    echo (int) $conta["id_usuario"];
                                    ?>
                                </td>


                                <td class="nome-usuario">

                                    <?php
                                    echo htmlspecialchars(
                                        $nome,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td class="coluna-email">

                                    <?php
                                    echo htmlspecialchars(
                                        $email,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td class="coluna-cpf-cnpj">

                                    <?php
                                    echo htmlspecialchars(
                                        $cpfCnpj,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </td>


                                <td class="coluna-tipo">

                                    <span
                                        class="tipo <?php echo $classeTipo; ?>"
                                    >

                                        <?php
                                        echo htmlspecialchars(
                                            $tipo,
                                            ENT_QUOTES,
                                            "UTF-8"
                                        );
                                        ?>

                                    </span>

                                </td>


                                <td class="coluna-acao">

                                    <form
                                        method="POST"
                                        action="ver_contas_usuarios.php?tipo=<?php echo urlencode($filtro); ?>"
                                    >

                                        <input
                                            type="hidden"
                                            name="id_usuario"
                                            value="<?php echo (int) $conta["id_usuario"]; ?>"
                                        >

                                        <button
                                            type="submit"
                                            name="excluir_conta"
                                            value="1"
                                            class="btn-excluir"
                                        >

                                            <i class="bi bi-trash3"></i>

                                            Excluir

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>


            <!-- =================================
                 CARDS MOBILE
                 ================================= -->

            <div class="cards-mobile">

                <?php foreach ($contas as $conta) { ?>

                    <?php

                    $tipo =
                        $conta["tipo_usuario"] ?? "";

                    $nome =
                        $conta["nome"] ?? "";

                    $email =
                        $conta["email"] ?? "";

                    $cpfCnpj =
                        $conta["cpf_cnpj"] ?? "";

                    $classeTipo = "";


                    if ($tipo === "Administrador") {

                        $classeTipo =
                            "tipo-administrador";

                    } elseif ($tipo === "Distribuidor") {

                        $classeTipo =
                            "tipo-distribuidor";

                    } elseif ($tipo === "Cliente") {

                        $classeTipo =
                            "tipo-cliente";
                    }

                    ?>

                    <div class="conta-card">


                        <div class="conta-card-topo">

                            <div class="conta-card-nome">

                                <?php
                                echo htmlspecialchars(
                                    $nome,
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>

                            </div>


                            <div class="conta-card-id">

                                #<?php
                                echo (int) $conta["id_usuario"];
                                ?>

                            </div>

                        </div>


                        <div class="conta-info">


                            <div class="info-item">

                                <span class="info-label">
                                    Email
                                </span>

                                <span class="info-valor">

                                    <?php
                                    echo htmlspecialchars(
                                        $email,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </span>

                            </div>


                            <div class="info-item">

                                <span class="info-label">

                                    <?php
                                    echo $tipo === "Cliente"
                                        ? "CPF"
                                        : (
                                            $tipo === "Distribuidor"
                                            ? "CNPJ"
                                            : "CPF/CNPJ"
                                        );
                                    ?>

                                </span>

                                <span class="info-valor">

                                    <?php
                                    echo htmlspecialchars(
                                        $cpfCnpj,
                                        ENT_QUOTES,
                                        "UTF-8"
                                    );
                                    ?>

                                </span>

                            </div>

                        </div>


                        <div class="conta-card-footer">


                            <span
                                class="tipo <?php echo $classeTipo; ?>"
                            >

                                <?php
                                echo htmlspecialchars(
                                    $tipo,
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>

                            </span>


                            <form
                                method="POST"
                                action="ver_contas_usuarios.php?tipo=<?php echo urlencode($filtro); ?>"
                            >

                                <input
                                    type="hidden"
                                    name="id_usuario"
                                    value="<?php echo (int) $conta["id_usuario"]; ?>"
                                >

                                <button
                                    type="submit"
                                    name="excluir_conta"
                                    value="1"
                                    class="btn-excluir"
                                >

                                    <i class="bi bi-trash3"></i>

                                    Excluir

                                </button>

                            </form>


                        </div>


                    </div>

                <?php } ?>

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

                        echo "Ainda não existem contas cadastradas.";

                    } else {

                        echo "Não existe nenhuma conta do tipo " .
                            htmlspecialchars(
                                $filtro,
                                ENT_QUOTES,
                                "UTF-8"
                            ) .
                            ".";
                    }

                    ?>

                </p>

            </div>


        <?php } ?>


    </div>


</main>


<?php


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


if (isset($_GET["erro"])) {

    $mensagemErro =
        $_GET["erro"];


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

